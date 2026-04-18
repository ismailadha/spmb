<?php

namespace App\Http\Controllers;

use App\Models\JalurDaftar;
use App\Models\Kecamatan;
use App\Models\Konfigurasi;
use App\Models\Pendaftaran;
use App\Models\PeriodeDaftar;
use App\Models\Post;
use App\Models\Sambutan;
use App\Models\Sekolah;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        $sambutans = Sambutan::where('is_active', 1)->orderBy('sort_order', 'asc')->take(2)->get();
        $posts = Post::whereIn('status', ['Publish', 'Published'])->orderBy('tanggal', 'desc')->take(3)->get();
        $activePeriode = PeriodeDaftar::where('status_aktif', 1)->first();

        // Get Statistics
        $stats = [
            'total_sekolah' => Sekolah::count(),
            'total_kecamatan' => Kecamatan::count(),
            'total_pendaftar' => 0,
            'jalur' => [],
        ];

        if ($activePeriode) {
            $stats['total_pendaftar'] = Pendaftaran::where('periode_id', $activePeriode->id)->count();

            // Map Jalur Stats: 1: Domisili, 2: Afirmasi, 3: Prestasi, 4: Mutasi
            $jalurIds = [1, 2, 4, 3]; // Order requested in view: Zonasi, Afirmasi, Mutasi, Prestasi
            foreach ($jalurIds as $id) {
                $jalur = JalurDaftar::find($id);
                if ($jalur) {
                    $stats['jalur'][$id] = [
                        'nama' => ($id == 4) ? 'Jalur Mutasi' : (($id == 1) ? 'Jalur Zonasi' : $jalur->nama_jalur),
                        'sd' => Pendaftaran::where('periode_id', $activePeriode->id)
                            ->where('jalur_id', $id)
                            ->where('jenjang', 'SD')
                            ->count(),
                        'smp' => Pendaftaran::where('periode_id', $activePeriode->id)
                            ->where('jalur_id', $id)
                            ->where('jenjang', 'SMP')
                            ->count(),
                        'icon' => match ($id) {
                            1 => 'la-map-marked-alt',
                            2 => 'la-hand-holding-heart',
                            3 => 'la-star',
                            4 => 'la-exchange-alt',
                            default => 'la-info-circle'
                        },
                    ];
                }
            }
        }

        return view('frontend.index', compact('sliders', 'sambutans', 'posts', 'activePeriode', 'stats'));
    }

    public function sekolah_sd(Request $request)
    {
        $query = Sekolah::query()->where('jenjang', 'SD');

        if ($request->filled('search')) {
            $query->where('nama_sekolah', 'like', '%'.$request->search.'%');
        }

        if ($request->filled('kecamatan')) {
            $query->where('id_kecamatan', $request->kecamatan);
        }

        $sekolah = $query->orderBy('nama_sekolah', 'asc')->paginate(9)->withQueryString();
        $kecamatan = Kecamatan::orderBy('nama_kecamatan', 'asc')->get();

        return view('frontend.sekolah_sd', compact('sekolah', 'kecamatan'));
    }

    public function sekolah_smp(Request $request)
    {
        $query = Sekolah::query()->where('jenjang', 'SMP');

        if ($request->filled('search')) {
            $query->where('nama_sekolah', 'like', '%'.$request->search.'%');
        }

        if ($request->filled('kecamatan')) {
            $query->where('id_kecamatan', $request->kecamatan);
        }

        $sekolah = $query->orderBy('nama_sekolah', 'asc')->paginate(9)->withQueryString();
        $kecamatan = Kecamatan::orderBy('nama_kecamatan', 'asc')->get();

        return view('frontend.sekolah_smp', compact('sekolah', 'kecamatan'));
    }

    public function detail_sekolah_sd($id)
    {
        $sekolah = Sekolah::with('kecamatan')->findOrFail($id);

        return view('frontend.detail_sekolah_sd', compact('sekolah'));
    }

    public function detail_sekolah_smp($id)
    {
        $sekolah = Sekolah::with('kecamatan')->findOrFail($id);

        return view('frontend.detail_sekolah_smp', compact('sekolah'));
    }

    public function showPost($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $recent_posts = Post::whereIn('status', ['Publish', 'Published'])
            ->where('id', '!=', $post->id)
            ->orderBy('tanggal', 'desc')
            ->take(5)
            ->get();

        return view('frontend.detail_post', compact('post', 'recent_posts'));
    }

    public function zonasi_sd()
    {
        // ambil data sekolah berdasarkan jenjang SD, terurut berdasarkan kode kecamatan
        $sekolah = DB::table('sekolah')
            ->join('kecamatan', 'sekolah.id_kecamatan', '=', 'kecamatan.id')
            ->select('sekolah.*', 'kecamatan.nama_kecamatan')
            ->where('jenjang', 'SD')
            ->orderBy('id_kecamatan', 'asc')
            ->get();

        // ambil data desa untuk wilayah domisili
        $desa = DB::table('desa')->get()->groupBy('id_kecamatan');

        return view('frontend.zonasi_sd', compact('sekolah', 'desa'));
    }

    public function zonasi_smp()
    {
        $sekolah = DB::table('sekolah')
            ->join('kecamatan', 'sekolah.id_kecamatan', '=', 'kecamatan.id')
            ->select('sekolah.*', 'kecamatan.nama_kecamatan')
            ->where('jenjang', 'SMP')
            ->orderBy('id_kecamatan', 'asc')
            ->get();

        $desa = DB::table('desa')->get()->groupBy('id_kecamatan');

        return view('frontend.zonasi_smp', compact('sekolah', 'desa'));
    }

    public function kontak()
    {
        $appConfig = Konfigurasi::pluck('nilai', 'kunci')->toArray();

        return view('frontend.kontak', compact('appConfig'));
    }
}
