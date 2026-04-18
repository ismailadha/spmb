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
                'pendaftaran.jarak_sekolah_2'
            );

        // Conditional Ranking & Scoring
        if ($jalurId == 1) {
            // Domisili: Use stored score or fallback
            $data->selectRaw("$distanceScoreCol as skor_jarak")
                ->selectRaw('nilai_seleksi.skor_usia')
                ->selectRaw("($distanceScoreCol + nilai_seleksi.skor_usia) as total_skor")
                ->orderBy('total_skor', 'desc');
        } elseif (in_array($jalurId, [1, 2, 4])) {
            // Domisili, Afirmasi, Mutasi: Use stored score (Distance + Age)
            $data->selectRaw("$distanceScoreCol as skor_jarak")
                ->selectRaw('nilai_seleksi.skor_usia')
                ->selectRaw("($distanceScoreCol + nilai_seleksi.skor_usia) as total_skor")
                ->orderBy('total_skor', 'desc');
        } elseif ($jalurId == 3) {
            // Prestasi: Must use stored score
            $data->selectRaw('nilai_seleksi.rata_rapor')
                ->selectRaw('nilai_seleksi.nilai_tes_akademik')
                ->selectRaw('nilai_seleksi.nilai_prestasi')
                ->selectRaw('nilai_seleksi.skor_jarak')
                ->selectRaw('nilai_seleksi.skor_usia')
                ->selectRaw('COALESCE(nilai_seleksi.nilai_akhir, 0) as total_skor')
                ->orderBy('total_skor', 'desc')
                ->orderBy('nilai_seleksi.skor_usia', 'desc')
                ->orderBy('nilai_seleksi.skor_jarak', 'desc');
        } else {
            // Standard: Distance then Age
            $data->selectRaw('nilai_seleksi.skor_jarak')
                ->selectRaw('nilai_seleksi.skor_usia')
                ->selectRaw('COALESCE(nilai_seleksi.nilai_akhir, 0) as total_skor')
                ->orderBy('pendaftaran.jarak_sekolah_1', 'asc')
                ->orderBy('peserta.tanggal_lahir', 'asc');
        }

        $quota = 0;
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
            }
        }

        $counter = $request->get('start', 0);

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('hasil', function ($row) use (&$counter, $quota) {
                $counter++;
                if ($quota > 0) {
                    if ($counter <= $quota) {
                        return '<span class="badge badge-light-success fw-bolder px-4 py-3">Lulus</span>';
                    } else {
                        return '<span class="badge badge-light-danger fw-bolder px-4 py-3">Cadangan</span>';
                    }
                }

                return '<span class="badge badge-light-secondary fw-bolder px-4 py-3">-</span>';
            })
            ->editColumn('status', function ($row) {
                if ($row->status == 'Selesai') {
                    return '<span class="badge badge-light-success fw-bolder px-4 py-3">Selesai</span>';
                } elseif ($row->status == 'Draft') {
                    return '<span class="badge badge-light-warning fw-bolder px-4 py-3">Draft</span>';
                } else {
                    return '<span class="badge badge-light-info fw-bolder px-4 py-3">'.$row->status.'</span>';
                }
            })
            ->addColumn('action', function ($row) {
                return '<button type="button" class="btn btn-sm btn-primary btn-luluskan" data-id="'.$row->id.'">Luluskan</button>';
            })
            ->with('quota', $quota)
            ->rawColumns(['status', 'action', 'hasil'])
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
                'pendaftaran.jarak_sekolah_2'
            );

        // Conditional Ranking & Scoring
        if (in_array($jalurId, [1, 2, 4])) {
            // Domisili, Afirmasi, Mutasi: Use stored score (Distance + Age)
            $data->selectRaw("$distanceScoreCol as skor_jarak")
                ->selectRaw('nilai_seleksi.skor_usia')
                ->selectRaw("($distanceScoreCol + nilai_seleksi.skor_usia) as total_skor")
                ->orderBy('total_skor', 'desc');
        } elseif ($jalurId == 3) {
            // Prestasi: Must use stored score
            $data->selectRaw('nilai_seleksi.rata_rapor')
                ->selectRaw('nilai_seleksi.nilai_tes_akademik')
                ->selectRaw('nilai_seleksi.nilai_prestasi')
                ->selectRaw('nilai_seleksi.skor_jarak')
                ->selectRaw('nilai_seleksi.skor_usia')
                ->selectRaw('COALESCE(nilai_seleksi.nilai_akhir, 0) as total_skor')
                ->orderBy('total_skor', 'desc')
                ->orderBy('nilai_seleksi.skor_usia', 'desc')
                ->orderBy('nilai_seleksi.skor_jarak', 'desc');
        } else {
            // All other SMP paths: Distance then Age
            $data->selectRaw('nilai_seleksi.skor_jarak')
                ->selectRaw('nilai_seleksi.skor_usia')
                ->selectRaw('COALESCE(nilai_seleksi.nilai_akhir, 0) as total_skor')
                ->orderBy('pendaftaran.jarak_sekolah_1', 'asc')
                ->orderBy('peserta.tanggal_lahir', 'asc');
        }

        $quota = 0;
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
            }
        }

        $counter = $request->get('start', 0);

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('hasil', function ($row) use (&$counter, $quota) {
                $counter++;
                if ($quota > 0) {
                    if ($counter <= $quota) {
                        return '<span class="badge badge-light-success fw-bolder px-4 py-3">Lulus</span>';
                    } else {
                        return '<span class="badge badge-light-danger fw-bolder px-4 py-3">Cadangan</span>';
                    }
                }

                return '<span class="badge badge-light-secondary fw-bolder px-4 py-3">-</span>';
            })
            ->editColumn('status', function ($row) {
                if ($row->status == 'Selesai') {
                    return '<span class="badge badge-light-success fw-bolder px-4 py-3">Selesai</span>';
                } elseif ($row->status == 'Draft') {
                    return '<span class="badge badge-light-warning fw-bolder px-4 py-3">Draft</span>';
                } else {
                    return '<span class="badge badge-light-info fw-bolder px-4 py-3">'.$row->status.'</span>';
                }
            })
            ->addColumn('action', function ($row) {
                return '<button type="button" class="btn btn-sm btn-primary btn-luluskan" data-id="'.$row->id.'">Luluskan</button>';
            })
            ->with('quota', $quota)
            ->rawColumns(['status', 'action', 'hasil'])
            ->make(true);
    }
}
