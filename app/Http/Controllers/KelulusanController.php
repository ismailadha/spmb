<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class KelulusanController extends Controller
{
    /**
     * Display a listing of SD graduation.
     */
    public function kelulusan_sd()
    {
        $periode = DB::table('periode_pendaftaran')
            ->where('status_aktif', 1)
            ->first();

        $semuaJalur = DB::table('jalur_pendaftaran')->get();
        $semuaSekolah = DB::table('sekolah')->where('jenjang', 'SD')
            ->when(auth()->user()->role == 'admin_sekolah', function ($query) {
                return $query->where('id', auth()->user()->sekolah_id);
            })
            ->get();

        return view('backend.kelulusan.kelulusan_sd', compact('periode', 'semuaJalur', 'semuaSekolah'));
    }

    /**
     * Get data for SD graduation DataTable.
     */
    public function data_sd(Request $request)
    {
        $periode = DB::table('periode_pendaftaran')
            ->where('status_aktif', 1)
            ->first();

        $periodeId = $periode->id ?? null;
        $jalurId = $request->get('jalur_id');
        $sekolahId = $request->get('sekolah_id');

        if (auth()->user()->role == 'admin_sekolah') {
            $sekolahId = auth()->user()->sekolah_id;
        } elseif (auth()->user()->role == 'admin_dinas' && empty($sekolahId)) {
            $sekolahId = null;
        }

        $pilihanKe = $request->get('pilihan_ke', '1');
        $distanceCol = ($pilihanKe == '2') ? 'jarak_sekolah_2' : 'jarak_sekolah_1';
        $distanceScoreCol = ($pilihanKe == '2') ? 'nilai_seleksi.skor_jarak_2' : 'nilai_seleksi.skor_jarak';
        $tanggalBatas = $periode->tanggal_batas_usia_sd ?? '2026-07-01';

        $data = DB::table('pendaftaran')
            ->join('peserta', 'pendaftaran.peserta_id', '=', 'peserta.id')
            ->join('jalur_pendaftaran', 'pendaftaran.jalur_id', '=', 'jalur_pendaftaran.id')
            ->leftJoin('sekolah as sek1', 'pendaftaran.sekolah_pilihan_1', '=', 'sek1.id')
            ->leftJoin('sekolah as sek2', 'pendaftaran.sekolah_pilihan_2', '=', 'sek2.id')
            ->leftJoin('nilai_seleksi', 'pendaftaran.id', '=', 'nilai_seleksi.pendaftaran_id')
            ->where('pendaftaran.periode_id', $periodeId)
            ->where('pendaftaran.jenjang', 'SD')
            ->where('pendaftaran.status', 'verifikasi')
            ->when($jalurId, function ($query, $jalurId) {
                return $query->where('pendaftaran.jalur_id', $jalurId);
            })
            ->when($sekolahId, function ($query, $sekolahId) use ($pilihanKe) {
                if ($pilihanKe == '1') {
                    $query->where('pendaftaran.sekolah_pilihan_1', $sekolahId);
                } elseif ($pilihanKe == '2') {
                    $query->where('pendaftaran.sekolah_pilihan_2', $sekolahId);
                } else {
                    $query->where(function ($q) use ($sekolahId) {
                        $q->where('pendaftaran.sekolah_pilihan_1', $sekolahId)
                            ->orWhere('pendaftaran.sekolah_pilihan_2', $sekolahId);
                    });
                }

                return $query;
            });

        $data->select(
            'pendaftaran.id as pendaftaran_id',
            'peserta.id as id',
            'pendaftaran.nomor_pendaftaran',
            'peserta.nama_lengkap',
            'peserta.tanggal_lahir',
            'jalur_pendaftaran.id as jalur_id',
            'jalur_pendaftaran.nama_jalur',
            'pendaftaran.jenjang',
            'pendaftaran.status',
            'sek1.nama_sekolah as pilihan_1',
            'pendaftaran.jarak_sekolah_1',
            'sek2.nama_sekolah as pilihan_2',
            'pendaftaran.jarak_sekolah_2',
            'nilai_seleksi.skor_usia',
            DB::raw("$distanceScoreCol as skor_jarak"),
            DB::raw("CASE 
                WHEN pendaftaran.jalur_id = 3 THEN nilai_seleksi.nilai_akhir 
                ELSE (nilai_seleksi.skor_usia + $distanceScoreCol) 
            END as nilai_akhir")
        );

        $data->when($jalurId, function ($query, $jalurId) use ($distanceScoreCol) {
            if ($jalurId == 1) {
                // Domisili: Total Skor (usia + jarak) DESC, Skor Jarak DESC
                $totalExpr = DB::raw("(nilai_seleksi.skor_usia + $distanceScoreCol)");

                return $query->orderBy($totalExpr, 'desc')
                    ->orderBy($distanceScoreCol, 'desc');
            } elseif ($jalurId == 3) {
                // Prestasi: Nilai Akhir DESC, Skor Jarak DESC
                return $query->orderBy('nilai_seleksi.nilai_akhir', 'desc')
                    ->orderBy($distanceScoreCol, 'desc');
            } elseif ($jalurId == 2 || $jalurId == 4) {
                // Afirmasi or Mutasi: Skor Usia DESC, Skor Jarak DESC
                return $query->orderBy('nilai_seleksi.skor_usia', 'desc')
                    ->orderBy($distanceScoreCol, 'desc');
            }
        }, function ($query) use ($distanceCol) {
            // Default sorting if no jalur selected
            return $query->orderBy($distanceCol, 'asc')
                ->orderBy('peserta.tanggal_lahir', 'asc');
        });

        $quota = 0;
        $remainingQuota = 0;
        if ($sekolahId && $jalurId) {
            $sekolah = DB::table('sekolah')->where('id', $sekolahId)->first();
            if ($sekolah) {
                switch ($jalurId) {
                    case 1: $quota = $sekolah->daya_tampung_domisili;
                        break;
                    case 2: $quota = $sekolah->daya_tampung_afirmasi;
                        break;
                    case 3: $quota = $sekolah->daya_tampung_prestasi;
                        break;
                    case 4: $quota = $sekolah->daya_tampung_mutasi;
                        break;
                }

                // Calculate remaining quota
                $existingCount = DB::table('pendaftaran')
                    ->where('sekolah_diterima_id', $sekolahId)
                    ->where('jalur_id', $jalurId)
                    ->where('status', 'lulus')
                    ->count();

                $remainingQuota = max(0, $quota - $existingCount);
            }
        }

        $counter = $request->get('start', 0);

        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('status', function ($row) use (&$counter, $remainingQuota) {
                $counter++;
                if ($remainingQuota > 0 && $counter <= $remainingQuota) {
                    return '<span class="badge badge-light-success fw-bolder px-4 py-3" style="background-color: #e8fff3; color: #50cd89;">Calon Lulus</span>';
                }

                return '<span class="badge badge-light-danger fw-bolder px-4 py-3">Calon Tidak Lulus</span>';
            })
            ->addColumn('action', function ($row) {
                return '<button type="button" class="btn btn-sm btn-primary btn-luluskan" data-id="'.$row->id.'">Luluskan</button>';
            })
            ->with('quota', $quota)
            ->with('remaining_quota', $remainingQuota)
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    /**
     * Display a listing of SMP graduation.
     */
    public function kelulusan_smp()
    {
        $periode = DB::table('periode_pendaftaran')
            ->where('status_aktif', 1)
            ->first();

        $semuaJalur = DB::table('jalur_pendaftaran')->get();
        $semuaSekolah = DB::table('sekolah')->where('jenjang', 'SMP')
            ->when(auth()->user()->role == 'admin_sekolah', function ($query) {
                return $query->where('id', auth()->user()->sekolah_id);
            })
            ->get();

        return view('backend.kelulusan.kelulusan_smp', compact('periode', 'semuaJalur', 'semuaSekolah'));
    }

    /**
     * Get data for SMP graduation DataTable.
     */
    public function data_smp(Request $request)
    {
        $periode = DB::table('periode_pendaftaran')
            ->where('status_aktif', 1)
            ->first();

        $periodeId = $periode->id ?? null;
        $jalurId = $request->get('jalur_id');
        $sekolahId = $request->get('sekolah_id');

        if (auth()->user()->role == 'admin_sekolah') {
            $sekolahId = auth()->user()->sekolah_id;
        } elseif (auth()->user()->role == 'admin_dinas' && empty($sekolahId)) {
            $sekolahId = null;
        }

        $pilihanKe = $request->get('pilihan_ke', '1');
        $distanceCol = ($pilihanKe == '2') ? 'jarak_sekolah_2' : 'jarak_sekolah_1';
        $distanceScoreCol = ($pilihanKe == '2') ? 'nilai_seleksi.skor_jarak_2' : 'nilai_seleksi.skor_jarak';
        $tanggalBatas = $periode->tanggal_batas_usia_smp ?? '2026-07-01';

        $data = DB::table('pendaftaran')
            ->join('peserta', 'pendaftaran.peserta_id', '=', 'peserta.id')
            ->join('jalur_pendaftaran', 'pendaftaran.jalur_id', '=', 'jalur_pendaftaran.id')
            ->leftJoin('sekolah as sek1', 'pendaftaran.sekolah_pilihan_1', '=', 'sek1.id')
            ->leftJoin('sekolah as sek2', 'pendaftaran.sekolah_pilihan_2', '=', 'sek2.id')
            ->leftJoin('nilai_seleksi', 'pendaftaran.id', '=', 'nilai_seleksi.pendaftaran_id')
            ->where('pendaftaran.periode_id', $periodeId)
            ->where('pendaftaran.jenjang', 'SMP')
            ->where('pendaftaran.status', 'verifikasi')
            ->when($jalurId, function ($query, $jalurId) {
                return $query->where('pendaftaran.jalur_id', $jalurId);
            })
            ->when($sekolahId, function ($query, $sekolahId) use ($pilihanKe) {
                if ($pilihanKe == '1') {
                    $query->where('pendaftaran.sekolah_pilihan_1', $sekolahId);
                } elseif ($pilihanKe == '2') {
                    $query->where('pendaftaran.sekolah_pilihan_2', $sekolahId);
                } else {
                    $query->where(function ($q) use ($sekolahId) {
                        $q->where('pendaftaran.sekolah_pilihan_1', $sekolahId)
                            ->orWhere('pendaftaran.sekolah_pilihan_2', $sekolahId);
                    });
                }

                return $query;
            })
            ->select(
                'pendaftaran.id as pendaftaran_id',
                'peserta.id as id',
                'pendaftaran.nomor_pendaftaran',
                'peserta.nama_lengkap',
                'peserta.tanggal_lahir',
                'jalur_pendaftaran.id as jalur_id',
                'jalur_pendaftaran.nama_jalur',
                'pendaftaran.jenjang',
                'pendaftaran.status',
                'sek1.nama_sekolah as pilihan_1',
                'pendaftaran.jarak_sekolah_1',
                'sek2.nama_sekolah as pilihan_2',
                'pendaftaran.jarak_sekolah_2',
                'nilai_seleksi.skor_usia',
                DB::raw("$distanceScoreCol as skor_jarak"),
                DB::raw("CASE 
                    WHEN pendaftaran.jalur_id = 3 THEN nilai_seleksi.nilai_akhir 
                    ELSE (nilai_seleksi.skor_usia + $distanceScoreCol) 
                END as nilai_akhir")
            );

        $data->when($jalurId, function ($query, $jalurId) use ($distanceScoreCol) {
            if ($jalurId == 1) {
                // Domisili: Total Skor (usia + jarak) DESC, Skor Jarak DESC
                $totalExpr = DB::raw("(nilai_seleksi.skor_usia + $distanceScoreCol)");

                return $query->orderBy($totalExpr, 'desc')
                    ->orderBy($distanceScoreCol, 'desc');
            } elseif ($jalurId == 3) {
                // Prestasi: Nilai Akhir DESC, Skor Jarak DESC
                return $query->orderBy('nilai_seleksi.nilai_akhir', 'desc')
                    ->orderBy($distanceScoreCol, 'desc');
            } elseif ($jalurId == 2 || $jalurId == 4) {
                // Afirmasi or Mutasi: Skor Usia DESC, Skor Jarak DESC
                return $query->orderBy('nilai_seleksi.skor_usia', 'desc')
                    ->orderBy($distanceScoreCol, 'desc');
            }
        }, function ($query) use ($distanceCol) {
            // Default sorting if no jalur selected
            return $query->orderBy($distanceCol, 'asc')
                ->orderBy('peserta.tanggal_lahir', 'asc');
        });

        $quota = 0;
        $remainingQuota = 0;
        if ($sekolahId && $jalurId) {
            $sekolah = DB::table('sekolah')->where('id', $sekolahId)->first();
            if ($sekolah) {
                switch ($jalurId) {
                    case 1: $quota = $sekolah->daya_tampung_domisili;
                        break;
                    case 2: $quota = $sekolah->daya_tampung_afirmasi;
                        break;
                    case 3: $quota = $sekolah->daya_tampung_prestasi;
                        break;
                    case 4: $quota = $sekolah->daya_tampung_mutasi;
                        break;
                }

                // Calculate remaining quota
                $existingCount = DB::table('pendaftaran')
                    ->where('sekolah_diterima_id', $sekolahId)
                    ->where('jalur_id', $jalurId)
                    ->where('status', 'lulus')
                    ->count();

                $remainingQuota = max(0, $quota - $existingCount);
            }
        }

        $counter = $request->get('start', 0);

        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('status', function ($row) use (&$counter, $remainingQuota) {
                $counter++;
                if ($remainingQuota > 0 && $counter <= $remainingQuota) {
                    return '<span class="badge badge-light-success fw-bolder px-4 py-3" style="background-color: #e8fff3; color: #50cd89;">Calon Lulus</span>';
                }

                return '<span class="badge badge-light-danger fw-bolder px-4 py-3">Calon Tidak Lulus</span>';
            })
            ->addColumn('action', function ($row) {
                return '<button type="button" class="btn btn-sm btn-primary btn-luluskan" data-id="'.$row->id.'">Luluskan</button>';
            })
            ->with('quota', $quota)
            ->with('remaining_quota', $remainingQuota)
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    /**
     * Set graduation status for selected participants.
     */
    public function setLulus(Request $request)
    {
        $request->validate([
            'pendaftaran_ids' => 'required|array',
            'pendaftaran_ids.*' => 'exists:pendaftaran,id',
            'sekolah_id' => 'required|exists:sekolah,id',
        ]);

        $pendaftaranIds = $request->pendaftaran_ids;
        $sekolahId = $request->sekolah_id;

        try {
            DB::beginTransaction();

            // 1. Group candidates by Jalur ID and validate quota
            $pendaftarans = DB::table('pendaftaran')
                ->whereIn('id', $pendaftaranIds)
                ->get();

            $pendaftaranByJalur = $pendaftarans->groupBy('jalur_id');
            $sekolah = DB::table('sekolah')->where('id', $sekolahId)->first();

            foreach ($pendaftaranByJalur as $jalurId => $group) {
                $newCount = count($group);

                // Get quota definition
                $quota = 0;
                $jalurNama = DB::table('jalur_pendaftaran')->where('id', $jalurId)->value('nama_jalur');

                switch ($jalurId) {
                    case 1: $quota = $sekolah->daya_tampung_domisili;
                        break;
                    case 2: $quota = $sekolah->daya_tampung_afirmasi;
                        break;
                    case 3: $quota = $sekolah->daya_tampung_prestasi;
                        break;
                    case 4: $quota = $sekolah->daya_tampung_mutasi;
                        break;
                }

                // Count existing graduated for this path and school
                $existingCount = DB::table('pendaftaran')
                    ->where('sekolah_diterima_id', $sekolahId)
                    ->where('jalur_id', $jalurId)
                    ->where('status', 'lulus')
                    ->count();

                $available = $quota - $existingCount;

                if ($newCount > $available) {
                    return response()->json([
                        'success' => false,
                        'message' => "Gagal: Kuota untuk Jalur $jalurNama tidak mencukupi. Sisa kuota: $available, jumlah yang dipilih: $newCount.",
                    ], 422);
                }
            }

            // 2. Process graduation
            foreach ($pendaftarans as $pendaftaran) {
                $id = $pendaftaran->id;
                // Determine which choice this school is
                $pilihan = 1;
                if ($pendaftaran->sekolah_pilihan_2 == $sekolahId) {
                    $pilihan = 2;
                }

                // 1. Update status pendaftaran
                DB::table('pendaftaran')
                    ->where('id', $id)
                    ->update([
                        'status' => 'lulus',
                        'sekolah_diterima_id' => $sekolahId,
                        'updated_at' => now(),
                    ]);

                // 2. Insert or Update HasilSeleksi
                DB::table('hasil_seleksi')->updateOrInsert(
                    ['pendaftaran_id' => $id],
                    [
                        'status' => 'lulus',
                        'keterangan' => "Selamat, Anda diterima di pilihan $pilihan.",
                    ]
                );
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => count($pendaftaranIds).' peserta berhasil diluluskan.',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Gagal meluluskan peserta: '.$e->getMessage(),
            ], 500);
        }
    }

    /**
     * Set graduation status to 'Tidak Lulus'.
     */
    public function setTidakLulus($id)
    {
        if (auth()->user()->role != 'admin_dinas') {
            return redirect()->back()->with('error', 'Hanya Admin Dinas yang dapat membatalkan kelulusan.');
        }

        try {
            DB::beginTransaction();

            // 1. Update status pendaftaran
            DB::table('pendaftaran')
                ->where('id', $id)
                ->update([
                    'status' => 'tidak_lulus',
                    'sekolah_diterima_id' => null,
                    'updated_at' => now(),
                ]);

            // 2. Insert or Update HasilSeleksi
            DB::table('hasil_seleksi')->updateOrInsert(
                ['pendaftaran_id' => $id],
                [
                    'status' => 'tidak_lulus',
                    'keterangan' => 'Mohon maaf, Anda belum berhasil lulus pada seleksi ini.',
                ]
            );

            DB::commit();

            return redirect()->back()->with('success', 'Status kelulusan berhasil dibatalkan.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Gagal memproses: '.$e->getMessage());
        }
    }
}
