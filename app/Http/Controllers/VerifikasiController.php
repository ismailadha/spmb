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

            // 2. Identify Age parameters
            $tanggalBatas = $pendaftaran->jenjang == 'SD'
                ? ($periode->tanggal_batas_usia_sd ?? '2026-07-01')
                : ($periode->tanggal_batas_usia_smp ?? '2026-07-01');

            $birthDate = Carbon::parse($peserta->tanggal_lahir);
            $limitDate = Carbon::parse($tanggalBatas);

            // 3. Calculated Scores (Always recorded, but used differently per path)
            $nilaiData['skor_usia'] = $birthDate->diffInDays($limitDate, false);
            $nilaiData['skor_jarak'] = $this->calculateDistanceScore($pendaftaran->jarak_sekolah_1);

            // Prestasi, Afirmasi, and Mutasi only have 1 school choice, so skip choice 2
            $nilaiData['skor_jarak_2'] = in_array($pendaftaran->jalur_id, [2, 3, 4]) ? 0 : $this->calculateDistanceScore($pendaftaran->jarak_sekolah_2);

            // 4. Path-specific logic
            if ($pendaftaran->jalur_id == 3) { // Jalur Prestasi
                $nr = $request->input('rata_rapor', 0);
                $nhtka = $request->input('nilai_tes_akademik', 0);
                $np = $request->input('nilai_prestasi', 0);

                // For Prestasi, score is strictly based on academic/achievement points
                $na = ($nr * 0.4) + ($nhtka * 0.3) + ($np * 0.3);

                $nilaiData['rata_rapor'] = $nr;
                $nilaiData['nilai_tes_akademik'] = $nhtka;
                $nilaiData['nilai_prestasi'] = $np;
                $nilaiData['nilai_akhir'] = $na; // Distance/Age NOT included here
            } elseif (in_array($pendaftaran->jalur_id, [1, 2, 4])) { // Domisili, Afirmasi, Mutasi
                // For these paths, score is the sum of Distance + Age
                $nilaiData['nilai_akhir'] = $nilaiData['skor_jarak'] + $nilaiData['skor_usia'];
            } else {
                // Other paths recorded but no combined score by default
                $nilaiData['nilai_akhir'] = 0;
            }

            // Save or Update NilaiSeleksi
            NilaiSeleksi::updateOrCreate(
                ['pendaftaran_id' => $id],
                $nilaiData
            );

            DB::commit();

            return redirect()->back()->with('success', 'Pendaftaran berhasil diverifikasi dan nilai telah disimpan.');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Gagal memverifikasi: '.$e->getMessage());
        }
    }

    public function minta_perbaikan(Request $request, $id)
    {
        $request->validate([
            'catatan_perbaikan' => 'required',
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->update([
            'status' => 'perbaikan',
            'catatan_perbaikan' => $request->catatan_perbaikan,
        ]);

        return redirect()->back()->with('success', 'Permintaan perbaikan pendaftaran berhasil dikirim ke pendaftar.');
    }

    public function tolak_verifikasi($id) {}

    /**
     * Helper to calculate score based on distance.
     */
    private function calculateDistanceScore(?float $distance): int
    {
        if ($distance === null) {
            return 100;
        }

        if ($distance <= 0.5) {
            return 800;
        } elseif ($distance <= 1.0) {
            return 600;
        } elseif ($distance <= 3.0) {
            return 400;
        } elseif ($distance <= 5.0) {
            return 300;
        } elseif ($distance <= 7.5) {
            return 200;
        }

        return 100;
    }
}
