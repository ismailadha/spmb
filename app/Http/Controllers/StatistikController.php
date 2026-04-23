<?php

namespace App\Http\Controllers;

use App\Models\JalurDaftar;
use App\Models\Pendaftaran;
use App\Models\PeriodeDaftar;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class StatistikController extends Controller
{
    /**
     * Display a listing of the statistics.
     */
    public function index(Request $request): View
    {
        $activePeriode = PeriodeDaftar::where('status_aktif', true)->first() ?? PeriodeDaftar::latest()->first();
        $jalurs = JalurDaftar::all();

        $jenjang = $request->get('jenjang');

        // Filter Sekolah
        $sekolahsQuery = Sekolah::orderBy('jenjang')->orderBy('nama_sekolah');
        if ($jenjang) {
            $sekolahsQuery->where('jenjang', $jenjang);
        }
        $sekolahs = $sekolahsQuery->get();

        // Filter Pendaftaran base query
        $pendaftaranBase = Pendaftaran::where('periode_id', $activePeriode->id);
        if ($jenjang) {
            $pendaftaranBase->where('jenjang', $jenjang);
        }

        $counts = (clone $pendaftaranBase)
            ->where('status', '!=', 'draft')
            ->select('sekolah_pilihan_1', 'jalur_id', DB::raw('count(*) as total'))
            ->groupBy('sekolah_pilihan_1', 'jalur_id')
            ->get()
            ->groupBy('sekolah_pilihan_1');

        foreach ($sekolahs as $sekolah) {
            $sekolahStats = [];
            $sekolahCounts = $counts->get($sekolah->id) ?? collect();

            foreach ($jalurs as $jalur) {
                $count = $sekolahCounts->where('jalur_id', $jalur->id)->first()?->total ?? 0;

                // Map jalur ID to Sekolah table columns
                $columnMap = [
                    1 => 'daya_tampung_domisili',
                    2 => 'daya_tampung_afirmasi',
                    3 => 'daya_tampung_prestasi',
                    4 => 'daya_tampung_mutasi',
                ];
                $col = $columnMap[$jalur->id] ?? null;
                $quota = $col ? $sekolah->$col : 0;

                $sekolahStats[$jalur->id] = [
                    'count' => $count,
                    'quota' => $quota ?? 0,
                ];
            }
            $sekolah->stats_jalur = $sekolahStats;
        }

        $stats = [
            'total' => (clone $pendaftaranBase)->count(),
            'by_jalur' => $jalurs->map(function ($j) use ($pendaftaranBase) {
                $j->pendaftaran_count = (clone $pendaftaranBase)
                    ->where('jalur_id', $j->id)
                    ->where('status', '!=', 'draft')
                    ->count();

                return $j;
            }),
            'by_jenjang' => [
                'SD' => Pendaftaran::where('jenjang', 'SD')->where('periode_id', $activePeriode->id)->where('status', '!=', 'draft')->count(),
                'SMP' => Pendaftaran::where('jenjang', 'SMP')->where('periode_id', $activePeriode->id)->where('status', '!=', 'draft')->count(),
            ],
            'by_status' => (clone $pendaftaranBase)
                ->select('status', DB::raw('count(*) as total'))
                ->groupBy('status')
                ->get()
                ->pluck('total', 'status')
                ->toArray(),
            'harian' => (clone $pendaftaranBase)
                ->select(DB::raw('DATE(created_at) as tanggal'), DB::raw('count(*) as total'))
                ->where('status', '!=', 'draft')
                ->where('created_at', '>=', now()->subDays(14))
                ->groupBy('tanggal')
                ->orderBy('tanggal', 'asc')
                ->get(),
            'sekolahs' => $sekolahs,
            'jalurs' => $jalurs,
            'periode' => $activePeriode,
            'filter_jenjang' => $jenjang,
        ];

        return view('backend.statistik', compact('stats'));
    }
}
