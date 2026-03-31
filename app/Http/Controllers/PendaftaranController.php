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
        } else {
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
            } else {
                // jika belum daftar, tampilkan form pendaftaran dengan status create
                return view('backend.pendaftaran.form_pendaftaran', [
                    'mode' => 'create',
                    'data' => null,
                ]);
            }
        }
    }

    public function store(Request $request)
    {
        return view('backend.pendaftaran.index');
    }

    public function edit($id)
    {
        // tabel pendaftaran, periode_pendaftaran, peserta, orang_tua, sekolah, provinsi, kabupaten, kecamatan, desa, jalurDaftar
        $pendaftaran = DB::table('pendaftaran')
            ->join('periode_pendaftaran', 'pendaftaran.periode_id', '=', 'periode_pendaftaran.id')
            ->join('peserta', 'pendaftaran.peserta_id', '=', 'peserta.id')
            ->join('orang_tua', 'peserta.id', '=', 'orang_tua.peserta_id')
            ->join('sekolah', 'pendaftaran.sekolah_id', '=', 'sekolah.id')
            ->join('provinsi', 'peserta.provinsi_id', '=', 'provinsi.id')
            ->join('kabupaten', 'peserta.kabupaten_id', '=', 'kabupaten.id')
            ->join('kecamatan', 'peserta.kecamatan_id', '=', 'kecamatan.id')
            ->join('desa', 'peserta.desa_id', '=', 'desa.id')
            ->join('jalur_pendaftaran', 'pendaftaran.jalur_id', '=', 'jalur_pendaftaran.id')
            ->where('pendaftaran.id', $id)
            ->select('pendaftaran.*', 'peserta.*', 'orang_tua.*', 'sekolah.*', 'provinsi.*', 'kabupaten.*', 'kecamatan.*', 'desa.*', 'jalur_pendaftaran.*', 'periode_pendaftaran.*')
            ->first();

        // dd($pendaftaran);

        // ambil semua data jalur_id dari tabel sekolah_jalur sebagai data pilihan jalur lainnya (distinct)
        $jalur_pendaftaran = DB::table('sekolah_jalur')
            ->join('jalur_pendaftaran', 'sekolah_jalur.jalur_id', '=', 'jalur_pendaftaran.id')
            ->select('sekolah_jalur.jalur_id', 'jalur_pendaftaran.nama_jalur')
            ->distinct()
            ->get();

        return view('backend.pendaftaran.form_pendaftaran', [
            'mode' => 'edit',
            'data' => $pendaftaran,
            'jalur_pendaftaran' => $jalur_pendaftaran,
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
}
