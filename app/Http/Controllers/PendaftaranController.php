<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Peserta;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PendaftaranController extends Controller
{
    public function index()
    {
        // tanggal hari ini dari Carbon
        $tanggal_hari_ini = Carbon::now()->format('Y-m-d');

        // cek apakah periode pendaftaran masih dibuka
        $jadwal = DB::table('periode_pendaftaran')
            ->where('status_aktif', 1)
            ->where('peserta_daftar_mulai', '<=', $tanggal_hari_ini)
            ->where('peserta_daftar_selesai', '>=', $tanggal_hari_ini)
            ->first();

        if ($jadwal) {
            // cek apakah user sudah pernah membuat pendaftaran sebelumnya
            $user_id = Auth::user()->id;

            $pendaftaran = DB::table('pendaftaran')
                ->join('peserta', 'pendaftaran.peserta_id', '=', 'peserta.id')
                ->where('peserta.user_id', $user_id)
                ->select('pendaftaran.id', 'pendaftaran.status')
                ->first();

            if ($pendaftaran) {
                // jika status = draft, lanjut edit
                if ($pendaftaran->status == 'draft') {
                    return redirect()->route('pendaftaran.edit', $pendaftaran->id);
                } else {
                    // ambil data pendaftaran berdasarkan user_id pada periode aktif yang statusnya sudah submit dengan query builder
                    $pendaftaran = DB::table('pendaftaran')
                        ->join('peserta', 'pendaftaran.peserta_id', '=', 'peserta.id')
                        ->join('periode_pendaftaran', 'pendaftaran.periode_id', '=', 'periode_pendaftaran.id')
                        ->join('provinsi', 'peserta.provinsi_id', '=', 'provinsi.id')
                        ->join('kabupaten', 'peserta.kabupaten_id', '=', 'kabupaten.id')
                        ->join('kecamatan', 'peserta.kecamatan_id', '=', 'kecamatan.id')
                        ->join('desa', 'peserta.desa_id', '=', 'desa.id')
                        ->join('jalur_pendaftaran', 'pendaftaran.jalur_id', '=', 'jalur_pendaftaran.id')
                        ->join('sekolah as sekolah1', 'pendaftaran.sekolah_pilihan_1', '=', 'sekolah1.id')
                        ->join('sekolah as sekolah2', 'pendaftaran.sekolah_pilihan_2', '=', 'sekolah2.id')
                        ->join('orang_tua_wali', 'peserta.id', '=', 'orang_tua_wali.peserta_id')
                        ->where('peserta.user_id', Auth::id())
                        ->where('periode_pendaftaran.status_aktif', 1)
                        ->where('pendaftaran.status', 'submit')
                        ->select(
                            'pendaftaran.id',
                            'pendaftaran.status',
                            'pendaftaran.nomor_pendaftaran',
                            'pendaftaran.tanggal_daftar',
                            'pendaftaran.jalur_id',
                            'pendaftaran.jenjang',
                            'pendaftaran.sekolah_pilihan_1',
                            'pendaftaran.sekolah_pilihan_2',
                            'peserta.id as peserta_id',
                            'peserta.user_id',
                            'peserta.nik',
                            'peserta.nisn',
                            'peserta.nama_lengkap',
                            'peserta.jenis_kelamin',
                            'peserta.agama',
                            'peserta.tempat_lahir',
                            'peserta.tanggal_lahir',
                            'peserta.nomor_kk',
                            'peserta.tanggal_terbit_kk',
                            'peserta.provinsi_id',
                            'peserta.kabupaten_id',
                            'peserta.kecamatan_id',
                            'peserta.desa_id',
                            'peserta.alamat',
                            'peserta.latitude',
                            'peserta.longitude',
                            'periode_pendaftaran.id as periode_id',
                            'periode_pendaftaran.tahun_ajaran',
                            'periode_pendaftaran.status_aktif',
                            'periode_pendaftaran.peserta_daftar_mulai',
                            'periode_pendaftaran.peserta_daftar_selesai',
                            'provinsi.id as provinsi_id',
                            'provinsi.nama_provinsi',
                            'kabupaten.id as kabupaten_id',
                            'kabupaten.nama_kabupaten',
                            'kecamatan.id as kecamatan_id',
                            'kecamatan.nama_kecamatan',
                            'desa.id as desa_id',
                            'desa.nama_desa',
                            'jalur_pendaftaran.id as jalur_id',
                            'jalur_pendaftaran.nama_jalur',
                            'sekolah1.id as sekolah_pilihan_1_id',
                            'sekolah1.nama_sekolah as sekolah_pilihan_1_nama',
                            'sekolah1.jenjang as sekolah_pilihan_1_jenjang',
                            'sekolah2.id as sekolah_pilihan_2_id',
                            'sekolah2.nama_sekolah as sekolah_pilihan_2_nama',
                            'sekolah2.jenjang as sekolah_pilihan_2_jenjang',
                            'orang_tua_wali.id as orang_tua_wali_id',
                            'orang_tua_wali.nama_wali',
                            'orang_tua_wali.pekerjaan_wali',
                            'orang_tua_wali.no_hp',
                            'orang_tua_wali.alamat_wali',
                        )
                        ->first();
                    
                    $berkas = $pendaftaran ? DB::table('berkas_pendaftaran')->where('pendaftaran_id', $pendaftaran->id)->get() : collect([]);

                    return view('backend.pendaftaran.index', compact('pendaftaran', 'berkas'));
                }
            }
        } else {
            return redirect()->route('pendaftaran.index')->with('error', 'Jadwal pendaftaran sudah ditutup');
        }
    }

    public function create()
    {
        // tanggal hari ini dari Carbon
        $tanggal_hari_ini = Carbon::now()->format('Y-m-d');

        // cek apakah periode pendaftaran masih dibuka
        $jadwal = DB::table('periode_pendaftaran')
            ->where('status_aktif', 1)
            ->where('peserta_daftar_mulai', '<=', $tanggal_hari_ini)
            ->where('peserta_daftar_selesai', '>=', $tanggal_hari_ini)
            ->first();

        // cek apakah user sudah pernah membuat pendaftaran sebelumnya
        $user_id = Auth::user()->id;

        $pendaftaran = DB::table('pendaftaran')
            ->join('peserta', 'pendaftaran.peserta_id', '=', 'peserta.id')
            ->where('peserta.user_id', $user_id)
            ->select('pendaftaran.id', 'pendaftaran.status')
            ->first();

        // ambil data provinsi untuk ditaruh di create
        $provinsi = DB::table('provinsi')->get();

        // ambil semua data jalur_id dari tabel periode_jalur
        $jalur_pendaftaran = DB::table('periode_jalur')
            ->join('jalur_pendaftaran', 'periode_jalur.jalur_id', '=', 'jalur_pendaftaran.id')
            ->where('periode_jalur.periode_id', $jadwal->id)
            ->select('periode_jalur.jalur_id', 'jalur_pendaftaran.nama_jalur')
            ->distinct()
            ->get();

        // Jika tidak ada jalur pendaftaran yang dibuka
        if ($jalur_pendaftaran->isEmpty()) {
            return redirect()->route('pendaftaran.index')->with('info', 'Pendaftaran sedang dalam proses persiapan. Belum ada jadwal jalur pendaftaran yang dibuka saat ini.');
        }

        // buat dummy data object untuk menampung field-field di view
        $data = new \stdClass;
        $data->tahun_ajaran = $jadwal->tahun_ajaran;
        $data->jalur_id = '';
        $data->sekolah_id = '';
        $data->id = '';

        $peserta = new \stdClass;
        $peserta->nik = '';
        $peserta->nisn = '';
        $peserta->nama_lengkap = '';
        $peserta->jenis_kelamin = '';
        $peserta->agama = '';
        $peserta->tempat_lahir = '';
        $peserta->tanggal_lahir = '';
        $peserta->nomor_kk = '';
        $peserta->tanggal_terbit_kk = '';
        $peserta->provinsi_id = '';
        $peserta->kabupaten_id = '';
        $peserta->kecamatan_id = '';
        $peserta->desa_id = '';
        $peserta->alamat = '';
        $peserta->latitude = '';
        $peserta->longitude = '';
        $peserta->nama_wali = '';
        $peserta->pekerjaan_wali = '';
        $peserta->no_hp_wali = '';
        $peserta->alamat_wali = '';

        // load semua sekolah dan group by jenjang dan kecamatan
        $semuaSekolah = DB::table('sekolah')
            ->join('kecamatan', 'sekolah.id_kecamatan', '=', 'kecamatan.id')
            ->select('sekolah.id', 'sekolah.nama_sekolah', 'sekolah.jenjang', 'kecamatan.nama_kecamatan')
            ->get();

        $sekolahGrouped = [];
        foreach ($semuaSekolah as $s) {
            $sekolahGrouped[$s->jenjang][$s->nama_kecamatan][] = $s;
        }

        // jika belum daftar, tampilkan form pendaftaran dengan status create
        return view('backend.pendaftaran.form_pendaftaran', [
            'mode' => 'create',
            'data' => $data,
            'provinsi' => $provinsi,
            'jalur_pendaftaran' => $jalur_pendaftaran,
            'peserta' => $peserta,
            'sekolahGrouped' => $sekolahGrouped,
            // dan akan dimuat lewat ajax jika provinsi dipilih
            'kabupaten' => [],
            'kecamatan' => [],
            'desa' => [],
            'berkas' => collect([]),
        ]);
    }

    public function store(Request $request)
    {
        $isSubmitted = $request->status == 'submit';

        $request->validate([
            'status' => 'required|in:draft,submit',
            'jalur' => 'required',
            'jenjang' => 'required',
            'nik' => $isSubmitted ? 'required' : 'nullable',
            'nisn' => $isSubmitted ? 'required' : 'nullable',
            'nama_lengkap' => 'required', // Tetap wajib untuk identitas draf
            'tempat_lahir' => $isSubmitted ? 'required' : 'nullable',
            'tanggal_lahir' => $isSubmitted ? 'required' : 'nullable',
            'jenis_kelamin' => $isSubmitted ? 'required' : 'nullable',
            'agama' => $isSubmitted ? 'required' : 'nullable',
            'provinsi' => $isSubmitted ? 'required' : 'nullable',
            'kabupaten' => $isSubmitted ? 'required' : 'nullable',
            'kecamatan' => $isSubmitted ? 'required' : 'nullable',
            'desa' => $isSubmitted ? 'required' : 'nullable',
            'alamat' => $isSubmitted ? 'required' : 'nullable',
            'nomor_kk' => $isSubmitted ? 'required' : 'nullable',
            'tanggal_terbit_kk' => $isSubmitted ? 'required' : 'nullable',
            'latitude' => $isSubmitted ? 'required' : 'nullable',
            'longitude' => $isSubmitted ? 'required' : 'nullable',
            'nama_wali' => $isSubmitted ? 'required' : 'nullable',
            'pekerjaan_wali' => $isSubmitted ? 'required' : 'nullable',
            'no_hp_wali' => $isSubmitted ? 'required' : 'nullable',
            'alamat_wali' => $isSubmitted ? 'required' : 'nullable',
            'sekolah_pilihan_1' => $isSubmitted ? 'required' : 'nullable',

            // Validasi Berkas (Upload)
            'pasfoto' => ($isSubmitted ? 'required|' : 'nullable|').'file|mimes:jpg,jpeg,png,pdf|max:2048',
            'akta_lahir' => ($isSubmitted ? 'required|' : 'nullable|').'file|mimes:jpg,jpeg,png,pdf|max:2048',
            'kk' => ($isSubmitted ? 'required|' : 'nullable|').'file|mimes:jpg,jpeg,png,pdf|max:2048',
            'ktp_orang_tua' => ($isSubmitted ? 'required|' : 'nullable|').'file|mimes:jpg,jpeg,png,pdf|max:2048',
            'kartu_pkh' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'surat_dokter' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'surat_pindah' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'dokumen_tka' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'sertifikat_penghargaan' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        try {
            DB::beginTransaction();

            // 1. Create Peserta (menggunakan query builder)
            $peserta = DB::table('peserta')->insert([
                'user_id' => Auth::id(),
                'nik' => $request->nik,
                'nisn' => $request->nisn,
                'nama_lengkap' => $request->nama_lengkap,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'agama' => $request->agama,
                'provinsi_id' => $request->provinsi,
                'kabupaten_id' => $request->kabupaten,
                'kecamatan_id' => $request->kecamatan,
                'desa_id' => $request->desa,
                'alamat' => $request->alamat,
                'nomor_kk' => $request->nomor_kk,
                'tanggal_terbit_kk' => $request->tanggal_terbit_kk,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);

            $peserta_id = DB::table('peserta')->where('user_id', Auth::id())->first()->id;

            // 2. Create Orang Tua / Wali (menggunakan query builder)
            DB::table('orang_tua_wali')->insert([
                'peserta_id' => $peserta_id,
                'nama_wali' => $request->nama_wali,
                'pekerjaan_wali' => $request->pekerjaan_wali,
                'no_hp' => $request->no_hp_wali,
                'alamat_wali' => $request->alamat_wali,
            ]);

            // 3. Get Periode Aktif
            $jadwal = DB::table('periode_pendaftaran')->where('status_aktif', 1)->first();

            // 4. Create Pendaftaran (menggunakan query builder)
            $nomor_pendaftaran = null;
            if ($request->status == 'submit') {
                $nomor_pendaftaran = $this->generateNomorPendaftaran($request->jalur, $jadwal->id);
            }

            // Gunakan insertGetId untuk mendapatkan ID pendaftaran
            $pendaftaran_id = DB::table('pendaftaran')->insertGetId([
                'peserta_id' => $peserta_id,
                'periode_id' => $jadwal->id,
                'jalur_id' => $request->jalur,
                'jenjang' => $request->jenjang,
                'nomor_pendaftaran' => $nomor_pendaftaran,
                'tanggal_daftar' => now(),
                'sekolah_pilihan_1' => $request->sekolah_pilihan_1,
                'sekolah_pilihan_2' => $request->sekolah_pilihan_2,
                'status' => $request->status,
            ]);

            // 5. Handle File Uploads (Upload Berkas)
            $this->uploadBerkas($request, $pendaftaran_id);

            DB::commit();

            $message = $request->status == 'submit'
                ? 'Pendaftaran berhasil dikirim! Data Anda telah dikunci untuk proses verifikasi.'
                : 'Progres pendaftaran berhasil disimpan sebagai draf.';

            return redirect()->route('pendaftaran.index')->with('success', $message);
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Terjadi kesalahan saat menyimpan data: '.$e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        // tabel pendaftaran, periode_pendaftaran, peserta, orang_tua, sekolah, jalurDaftar
        $pendaftaran = DB::table('pendaftaran')
            ->join('periode_pendaftaran', 'pendaftaran.periode_id', '=', 'periode_pendaftaran.id')
            ->leftJoin('sekolah as sekolah1', 'pendaftaran.sekolah_pilihan_1', '=', 'sekolah1.id')
            ->leftJoin('sekolah as sekolah2', 'pendaftaran.sekolah_pilihan_2', '=', 'sekolah2.id')
            ->join('jalur_pendaftaran', 'pendaftaran.jalur_id', '=', 'jalur_pendaftaran.id')
            ->where('pendaftaran.id', $id)
            ->select(
                'pendaftaran.*',
                'sekolah1.nama_sekolah as sekolah1_nama',
                'sekolah2.nama_sekolah as sekolah2_nama',
                'jalur_pendaftaran.nama_jalur',
                'periode_pendaftaran.tahun_ajaran',
            )
            ->first();

        $peserta = DB::table('peserta')
            ->join('provinsi', 'peserta.provinsi_id', '=', 'provinsi.id')
            ->join('kabupaten', 'peserta.kabupaten_id', '=', 'kabupaten.id')
            ->join('kecamatan', 'peserta.kecamatan_id', '=', 'kecamatan.id')
            ->join('desa', 'peserta.desa_id', '=', 'desa.id')
            ->join('orang_tua_wali', 'peserta.id', '=', 'orang_tua_wali.peserta_id')
            ->where('peserta.id', $pendaftaran->peserta_id)
            ->select('peserta.*', 'provinsi.*', 'kabupaten.*', 'kecamatan.*', 'desa.*', 'orang_tua_wali.*')
            ->first();

        $jalur_pendaftaran = DB::table('periode_jalur')
            ->join('jalur_pendaftaran', 'periode_jalur.jalur_id', '=', 'jalur_pendaftaran.id')
            ->where('periode_jalur.periode_id', $pendaftaran->periode_id)
            ->select('periode_jalur.jalur_id', 'jalur_pendaftaran.nama_jalur')
            ->get();

        $berkas = DB::table('berkas_pendaftaran')
            ->where('pendaftaran_id', $pendaftaran->id)
            ->get();

        // ambil semua data provinsi
        $provinsi = DB::table('provinsi')->get();

        // ambil data kabupaten berdasarkan provinsi peserta
        $kabupaten = DB::table('kabupaten')
            ->where('id_provinsi', $peserta->provinsi_id)
            ->get();

        // ambil data kecamatan berdasarkan kabupaten peserta
        $kecamatan = DB::table('kecamatan')
            ->where('id_kabupaten', $peserta->kabupaten_id)
            ->get();

        // ambil data desa berdasarkan kecamatan peserta
        $desa = DB::table('desa')
            ->where('id_kecamatan', $peserta->kecamatan_id)
            ->get();

        // load semua sekolah dan group by jenjang dan kecamatan
        $semuaSekolah = DB::table('sekolah')
            ->join('kecamatan', 'sekolah.id_kecamatan', '=', 'kecamatan.id')
            ->select('sekolah.id', 'sekolah.nama_sekolah', 'sekolah.jenjang', 'kecamatan.nama_kecamatan')
            ->get();

        $sekolahGrouped = [];
        foreach ($semuaSekolah as $s) {
            $sekolahGrouped[$s->jenjang][$s->nama_kecamatan][] = $s;
        }

        return view('backend.pendaftaran.form_pendaftaran', [
            'mode' => 'edit',
            'data' => $pendaftaran,
            'peserta' => $peserta,
            'jalur_pendaftaran' => $jalur_pendaftaran,
            'sekolahGrouped' => $sekolahGrouped,
            'provinsi' => $provinsi,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            'desa' => $desa,
            'berkas' => $berkas, // Terkirim ke view
        ]);
    }

    public function update(Request $request, $id)
    {
        $isSubmitted = $request->status == 'submit';

        $request->validate([
            'status' => 'required|in:draft,submit',
            'jalur' => 'required',
            'jenjang' => 'required',
            'nik' => $isSubmitted ? 'required' : 'nullable',
            'nisn' => $isSubmitted ? 'required' : 'nullable',
            'nama_lengkap' => 'required',
            'tempat_lahir' => $isSubmitted ? 'required' : 'nullable',
            'tanggal_lahir' => $isSubmitted ? 'required' : 'nullable',
            'jenis_kelamin' => $isSubmitted ? 'required' : 'nullable',
            'agama' => $isSubmitted ? 'required' : 'nullable',
            'provinsi' => $isSubmitted ? 'required' : 'nullable',
            'kabupaten' => $isSubmitted ? 'required' : 'nullable',
            'kecamatan' => $isSubmitted ? 'required' : 'nullable',
            'desa' => $isSubmitted ? 'required' : 'nullable',
            'alamat' => $isSubmitted ? 'required' : 'nullable',
            'nomor_kk' => $isSubmitted ? 'required' : 'nullable',
            'tanggal_terbit_kk' => $isSubmitted ? 'required' : 'nullable',
            'latitude' => $isSubmitted ? 'required' : 'nullable',
            'longitude' => $isSubmitted ? 'required' : 'nullable',
            'nama_wali' => $isSubmitted ? 'required' : 'nullable',
            'pekerjaan_wali' => $isSubmitted ? 'required' : 'nullable',
            'no_hp_wali' => $isSubmitted ? 'required' : 'nullable',
            'alamat_wali' => $isSubmitted ? 'required' : 'nullable',
            'sekolah_pilihan_1' => $isSubmitted ? 'required' : 'nullable',

            // Validasi Berkas (Update) - Selalu nullable karena berkas mungkin sudah ada
            'pasfoto' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'akta_lahir' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'kk' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'ktp_orang_tua' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'kartu_pkh' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'surat_dokter' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'surat_pindah' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'dokumen_tka' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'sertifikat_penghargaan' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        try {
            DB::beginTransaction();

            // Handle File Uploads (Upload Berkas)
            $this->uploadBerkas($request, $id);

            // ambil data pendaftaran dan peserta menggunakan query builder
            $pendaftaran = DB::table('pendaftaran')->where('id', $id)->first();
            $peserta = DB::table('peserta')->where('id', $pendaftaran->peserta_id)->first();

            // 1. Update Peserta, gunakan query builder
            DB::table('peserta')->where('id', $peserta->id)->update([
                'nik' => $request->nik,
                'nisn' => $request->nisn,
                'nama_lengkap' => $request->nama_lengkap,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'agama' => $request->agama,
                'provinsi_id' => $request->provinsi,
                'kabupaten_id' => $request->kabupaten,
                'kecamatan_id' => $request->kecamatan,
                'desa_id' => $request->desa,
                'alamat' => $request->alamat,
                'nomor_kk' => $request->nomor_kk,
                'tanggal_terbit_kk' => $request->tanggal_terbit_kk,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);

            // 2. Update Orang Tua / Wali, gunakan query builder
            DB::table('orang_tua_wali')->where('peserta_id', $peserta->id)->update([
                'nama_wali' => $request->nama_wali,
                'pekerjaan_wali' => $request->pekerjaan_wali,
                'no_hp' => $request->no_hp_wali,
                'alamat_wali' => $request->alamat_wali,
            ]);

            // 3. Update Pendaftaran, gunakan query builder
            $dataPendaftaran = [
                'jalur_id' => $request->jalur,
                'jenjang' => $request->jenjang,
                'sekolah_pilihan_1' => $request->sekolah_pilihan_1,
                'sekolah_pilihan_2' => $request->sekolah_pilihan_2,
                'status' => $request->status,
            ];

            // Generate nomor pendaftaran jika belum ada dan status adalah submit
            if ($request->status == 'submit' && empty($pendaftaran->nomor_pendaftaran)) {
                $dataPendaftaran['nomor_pendaftaran'] = $this->generateNomorPendaftaran($request->jalur, $pendaftaran->periode_id);
            }

            DB::table('pendaftaran')->where('id', $pendaftaran->id)->update($dataPendaftaran);

            DB::commit();

            $message = $request->status == 'submit'
                ? 'Pendaftaran berhasil dikirim! Data Anda telah dikunci untuk proses verifikasi.'
                : 'Progres pendaftaran berhasil diperbarui sebagai draf.';

            return redirect()->route('pendaftaran.index')->with('success', $message);
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Terjadi kesalahan saat memperbarui data: '.$e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        return view('backend.pendaftaran.index');
    }

    public function print($id)
    {
        $pendaftaran = DB::table('pendaftaran')
            ->join('peserta', 'pendaftaran.peserta_id', '=', 'peserta.id')
            ->join('periode_pendaftaran', 'pendaftaran.periode_id', '=', 'periode_pendaftaran.id')
            ->join('jalur_pendaftaran', 'pendaftaran.jalur_id', '=', 'jalur_pendaftaran.id')
            ->join('sekolah as sekolah1', 'pendaftaran.sekolah_pilihan_1', '=', 'sekolah1.id')
            ->join('sekolah as sekolah2', 'pendaftaran.sekolah_pilihan_2', '=', 'sekolah2.id')
            ->where('pendaftaran.id', $id)
            ->where('pendaftaran.status', 'submit')
            ->select(
                'pendaftaran.nomor_pendaftaran',
                'pendaftaran.tanggal_daftar',
                'pendaftaran.jalur_id',
                'pendaftaran.jenjang',
                'pendaftaran.sekolah_pilihan_1',
                'pendaftaran.sekolah_pilihan_2',
                'peserta.nisn',
                'peserta.nama_lengkap',
                'peserta.tempat_lahir',
                'peserta.tanggal_lahir',
                'peserta.jenis_kelamin',
                'periode_pendaftaran.id as periode_id',
                'periode_pendaftaran.tahun_ajaran',
                'jalur_pendaftaran.id as jalur_id',
                'jalur_pendaftaran.nama_jalur',
                'sekolah1.nama_sekolah as sekolah_pilihan_1_nama',
                'sekolah2.nama_sekolah as sekolah_pilihan_2_nama',
            )
            ->first();

        // dd($pendaftaran);

        if (! $pendaftaran) {
            abort(404);
        }

        if (empty($pendaftaran->nomor_pendaftaran)) {
            return back()->with('error', 'Nomor pendaftaran belum tersedia. Silakan hubungi admin.');
        }

        return view('backend.pendaftaran.print_kartu', compact('pendaftaran'));
    }

    public function getSekolahByJalur($jalur_id)
    {
        $query = DB::table('sekolah')
            ->join('sekolah_jalur', 'sekolah.id', '=', 'sekolah_jalur.sekolah_id')
            ->join('kecamatan', 'sekolah.id_kecamatan', '=', 'kecamatan.id')
            ->join('jadwal_pendaftaran', 'sekolah_jalur.id', '=', 'jadwal_pendaftaran.sekolah_jalur_id')
            ->select('sekolah.id', 'sekolah.nama_sekolah', 'kecamatan.nama_kecamatan')
            ->where('sekolah_jalur.jalur_id', $jalur_id)
            ->where('jadwal_pendaftaran.status', 'open');

        $sekolah = $query->get();

        // Group by kecamatan
        $grouped = [];
        foreach ($sekolah as $s) {
            $grouped[$s->nama_kecamatan][] = $s;
        }

        return response()->json($grouped);
    }

    private function generateNomorPendaftaran($jalur_id, $periode_id): string
    {
        $jalur = [
            1 => 'DOM',
            2 => 'AFI',
            3 => 'PRE',
            4 => 'MUT',
        ];

        $kode_jalur = $jalur[$jalur_id] ?? 'XXX';

        // Ambil tahun dari periode_pendaftaran (misal 2026/2027 -> 26)
        $periode = DB::table('periode_pendaftaran')->where('id', $periode_id)->first();
        $tahun = substr(explode('/', $periode->tahun_ajaran)[0], -2);

        // Hitung jumlah pendaftaran yang sudah memiliki nomor di periode ini
        $count = DB::table('pendaftaran')
            ->where('periode_id', $periode_id)
            ->whereNotNull('nomor_pendaftaran')
            ->count();

        $sequence = str_pad($count + 1, 4, '0', STR_PAD_LEFT);

        return "SPMB-{$kode_jalur}-{$tahun}{$sequence}";

        return "SPMB-{$kode_jalur}-{$tahun}{$sequence}";
    }

    private function uploadBerkas(Request $request, $pendaftaran_id): void
    {
        $inputFiles = [
            'pasfoto',
            'akta_lahir',
            'kk',
            'ktp_orang_tua',
            'kartu_pkh',
            'surat_dokter',
            'surat_pindah',
            'dokumen_tka',
            'sertifikat_penghargaan',
        ];

        foreach ($inputFiles as $fileInput) {
            if ($request->hasFile($fileInput)) {
                $file = $request->file($fileInput);
                $filename = time().'_'.$fileInput.'.'.$file->getClientOriginalExtension();
                $destPath = 'berkas/'.$pendaftaran_id;

                // 1. Cek apakah berkas lama sudah ada, jika ada maka hapus filenya
                $existing = DB::table('berkas_pendaftaran')
                    ->where('pendaftaran_id', $pendaftaran_id)
                    ->where('jenis_berkas', $fileInput)
                    ->first();

                if ($existing && $existing->file_path && File::exists(storage_path('app/'.$existing->file_path))) {
                    File::delete(storage_path('app/'.$existing->file_path));
                }

                // 2. Simpan file baru ke storage/app (privat)
                $file->move(storage_path('app/'.$destPath), $filename);

                $filePath = $destPath.'/'.$filename;

                // 3. Update data di tabel berkas_pendaftaran
                DB::table('berkas_pendaftaran')->updateOrInsert(
                    [
                        'pendaftaran_id' => $pendaftaran_id,
                        'jenis_berkas' => $fileInput,
                    ],
                    [
                        'file_path' => $filePath,
                        'status_verifikasi' => 'pending',
                    ]
                );
            }
        }
    }

    public function showBerkas($id)
    {
        $berkas = DB::table('berkas_pendaftaran')->where('id', $id)->first();

        if (! $berkas || ! file_exists(storage_path('app/'.$berkas->file_path))) {
            abort(404);
        }

        // Opsional: Cek otorisasi di sini (misal: hanya pemilik pendaftaran atau admin)
        // if (Auth::id() !== $pendaftaran->user_id && !Auth::user()->isAdmin()) abort(403);

        return response()->file(storage_path('app/'.$berkas->file_path));
    }
}
