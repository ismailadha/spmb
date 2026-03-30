<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
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
            }
            // jika status = submit, tampilkan pesan
            if ($pendaftaran->status == 'submit') {
                return redirect()->route('pendaftaran.index')->with('error', 'Anda sudah menyelesaikan pendaftaran');
            }
        }

        // jika belum daftar, tampilkan form pendaftaran dengan status create
        return view('backend.pendaftaran.form_pendaftaran', [
            'mode' => 'create',
            'data' => null,
        ]);
    }

    public function store(Request $request)
    {
        return view('backend.pendaftaran.index');
    }

    public function edit($id)
    {
        // tabel pendaftaran, peserta, orang_tua, sekolah_jalur, sekolah, provinsi, kabupaten, kecamatan, desa
        $pendaftaran = DB::table('pendaftaran')
            ->join('peserta', 'pendaftaran.peserta_id', '=', 'peserta.id')
            ->join('orang_tua', 'peserta.id', '=', 'orang_tua.peserta_id')
            ->join('sekolah_jalur', 'pendaftaran.sekolah_jalur_id', '=', 'sekolah_jalur.id')
            ->join('sekolah', 'sekolah_jalur.sekolah_id', '=', 'sekolah.id')
            ->join('provinsi', 'peserta.provinsi_id', '=', 'provinsi.id')
            ->join('kabupaten', 'peserta.kabupaten_id', '=', 'kabupaten.id')
            ->join('kecamatan', 'peserta.kecamatan_id', '=', 'kecamatan.id')
            ->join('desa', 'peserta.desa_id', '=', 'desa.id')
            ->where('pendaftaran.id', $id)
            ->select('pendaftaran.*', 'peserta.*', 'orang_tua.*', 'sekolah_jalur.*', 'sekolah.*', 'provinsi.*', 'kabupaten.*', 'kecamatan.*', 'desa.*')
            ->first();

        return view('backend.pendaftaran.form_pendaftaran', [
            'mode' => 'edit',
            'data' => $pendaftaran,
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
