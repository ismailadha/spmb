<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class VerifikasiController extends Controller
{
    public function setuju_verifikasi($id)
    {
        DB::table('pendaftaran')
            ->where('id', $id)
            ->update(['status' => 'verifikasi']);

        return redirect()->back()->with('success', 'Status pendaftaran berhasil diubah menjadi verifikasi.');
    }

    public function tolak_verifikasi($id) {}
}
