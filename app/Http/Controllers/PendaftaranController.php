<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PendaftaranController extends Controller
{
    public function index()
    {
        return view('backend.pendaftaran.index');
    }

    public function create()
    {
        // cek apakah user sudah pernah membuat pendaftaran sebelumnya
        $user_id = Auth::user()->id;

        // query builder version
        $pendaftaran = DB::table('pendaftaran')
            ->join('peserta', 'pendaftaran.peserta_id', '=', 'peserta.id')
            ->where('peserta.user_id', $user_id)
            ->first();

        if ($pendaftaran) {
            // jika status = draft, lanjut edit
            if ($pendaftaran->status == 'draft') {
                return redirect()->route('pendaftaran.edit', $pendaftaran->id);
            } else {
                return redirect()->route('pendaftaran.index')->with('error', 'Anda sudah menyelesaikan pendaftaran');
            }
        }

        // tanggal hari ini dari Carbon
        $tanggal_hari_ini = Carbon::now()->format('Y-m-d');

        // cek apakah periode pendaftaran masih dibuka
        $jadwal = DB::table('periode_pendaftaran')
            ->where('status_aktif', 1)
            ->where('tanggal_mulai', '<=', $tanggal_hari_ini)
            ->where('tanggal_selesai', '>=', $tanggal_hari_ini)
            ->first();

        if (! $jadwal) {
            return redirect()->route('pendaftaran.index')->with('error', 'Jadwal pendaftaran sudah ditutup');
        }

        // ambil data provinsi untuk ditaruh di create
        $provinsi = DB::table('provinsi')->get();

        // ambil semua data jalur_id dari tabel sekolah_jalur sebagai data pilihan jalur lainnya (distinct)
        $jalur_pendaftaran = DB::table('sekolah_jalur')
            ->join('jalur_pendaftaran', 'sekolah_jalur.jalur_id', '=', 'jalur_pendaftaran.id')
            ->join('jadwal_pendaftaran', 'sekolah_jalur.id', '=', 'jadwal_pendaftaran.sekolah_jalur_id')
            ->where('jadwal_pendaftaran.status', 'open')
            ->select('sekolah_jalur.jalur_id', 'jalur_pendaftaran.nama_jalur')
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

        // jika belum daftar, tampilkan form pendaftaran dengan status create
        return view('backend.pendaftaran.form_pendaftaran', [
            'mode' => 'create',
            'data' => $data,
            'provinsi' => $provinsi,
            'jalur_pendaftaran' => $jalur_pendaftaran,
            'peserta' => $peserta,
            // Karena ini data baru (create), biarkan yang lain kosong
            // dan akan dimuat lewat ajax jika provinsi dipilih
            'kabupaten' => [],
            'kecamatan' => [],
            'desa' => [],
        ]);
    }

    public function store(Request $request)
    {
        return view('backend.pendaftaran.index');
    }

    public function edit($id)
    {
        // tabel pendaftaran, periode_pendaftaran, peserta, orang_tua, sekolah, jalurDaftar
        $pendaftaran = DB::table('pendaftaran')
            ->join('periode_pendaftaran', 'pendaftaran.periode_id', '=', 'periode_pendaftaran.id')
            ->join('sekolah', 'pendaftaran.sekolah_id', '=', 'sekolah.id')
            ->join('jalur_pendaftaran', 'pendaftaran.jalur_id', '=', 'jalur_pendaftaran.id')
            ->where('pendaftaran.id', $id)
            ->select('pendaftaran.*', 'sekolah.*', 'jalur_pendaftaran.*', 'periode_pendaftaran.*')
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

        // dd($peserta);

        // ambil semua data jalur_id dari tabel sekolah_jalur sebagai data pilihan jalur lainnya (distinct)
        $jalur_pendaftaran = DB::table('sekolah_jalur')
            ->join('jalur_pendaftaran', 'sekolah_jalur.jalur_id', '=', 'jalur_pendaftaran.id')
            ->join('jadwal_pendaftaran', 'sekolah_jalur.id', '=', 'jadwal_pendaftaran.sekolah_jalur_id')
            ->where('jadwal_pendaftaran.status', 'open')
            ->select('sekolah_jalur.jalur_id', 'jalur_pendaftaran.nama_jalur')
            ->distinct()
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

        return view('backend.pendaftaran.form_pendaftaran', [
            'mode' => 'edit',
            'data' => $pendaftaran,
            'peserta' => $peserta,
            'jalur_pendaftaran' => $jalur_pendaftaran,
            'provinsi' => $provinsi,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            'desa' => $desa,
        ]);
    }

    public function update(Request $request, $id)
    {
        return view('backend.pendaftaran.index');
    }

    public function destroy($id)
    {
        return view('backend.pendaftaran.index');
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
}
