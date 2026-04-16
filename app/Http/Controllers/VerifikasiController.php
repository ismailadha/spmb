<?php

namespace App\Http\Controllers;

use App\Models\NilaiSeleksi;
use App\Models\Pendaftaran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VerifikasiController extends Controller
{
    public function setuju_verifikasi(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $peserta = $pendaftaran->peserta;
        $periode = $pendaftaran->periode;

        // Start Transaction
        DB::beginTransaction();
        try {
            // Update Status
            $pendaftaran->update(['status' => 'verifikasi']);

            // Handle Scoring
            $nilaiData = [
                'pendaftaran_id' => $id,
                'nilai_akhir' => 0,
            ];

            if ($pendaftaran->jalur_id == 3) { // Prestasi
                $nr = $request->input('rata_rapor', 0);
                $nhtka = $request->input('nilai_tes_akademik', 0);
                $np = $request->input('nilai_prestasi', 0);

                $na = ($nr * 0.4) + ($nhtka * 0.3) + ($np * 0.3);

                $nilaiData['rata_rapor'] = $nr;
                $nilaiData['nilai_tes_akademik'] = $nhtka;
                $nilaiData['nilai_prestasi'] = $np;
                $nilaiData['nilai_akhir'] = $na;

                // Save or Update NilaiSeleksi only for Prestasi
                NilaiSeleksi::updateOrCreate(
                    ['pendaftaran_id' => $id],
                    $nilaiData
                );
            }

            DB::commit();

            return redirect()->back()->with('success', 'Pendaftaran berhasil diverifikasi dan nilai telah disimpan.');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Gagal memverifikasi: '.$e->getMessage());
        }
    }

    public function tolak_verifikasi($id) {}
}
