<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Kabupaten;
use App\Models\Kecamatan;

class WilayahController extends Controller
{
    public function getKabupaten($provinsi_id)
    {
        $kabupaten = Kabupaten::where('id_provinsi', $provinsi_id)->get();

        return response()->json($kabupaten);
    }

    public function getKecamatan($kabupaten_id)
    {
        $kecamatan = Kecamatan::where('id_kabupaten', $kabupaten_id)->get();

        return response()->json($kecamatan);
    }

    public function getDesa($kecamatan_id)
    {
        $desa = Desa::where('id_kecamatan', $kecamatan_id)->get();

        return response()->json($desa);
    }
}
