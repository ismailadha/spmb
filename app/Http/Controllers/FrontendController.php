<?php

namespace App\Http\Controllers;

use App\Models\JalurDaftar;
use App\Models\Juknis;
use App\Models\Kecamatan;
use App\Models\Konfigurasi;
use App\Models\Pendaftaran;
use App\Models\PeriodeDaftar;
use App\Models\Persyaratan;
use App\Models\Post;
use App\Models\Sambutan;
use App\Models\Sekolah;
use App\Models\Slider;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class FrontendController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        $sambutans = Sambutan::where('is_active', 1)->orderBy('sort_order', 'asc')->take(2)->get();
        $posts = Post::whereIn('status', ['Publish', 'Published'])->orderBy('tanggal', 'desc')->take(6)->get();
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
        $activePeriode = PeriodeDaftar::where('status_aktif', 1)->first();
        $query = Sekolah::query()->where('jenjang', 'SD')
            ->withCount(['sekolahPilihan1 as pendaftar_count' => function ($q) use ($activePeriode) {
                if ($activePeriode) {
                    $q->where('periode_id', $activePeriode->id);
                }
            }])
            ->withCount(['pendaftarDiterima as lulus_count' => function ($q) use ($activePeriode) {
                $q->where('status', 'lulus');
                if ($activePeriode) {
                    $q->where('periode_id', $activePeriode->id);
                }
            }]);

        $query->join('kecamatan', 'sekolah.id_kecamatan', '=', 'kecamatan.id')
            ->select('sekolah.*');

        if ($request->filled('search')) {
            $query->where('sekolah.nama_sekolah', 'like', '%'.$request->search.'%');
        }

        if ($request->filled('kecamatan')) {
            $query->where('sekolah.id_kecamatan', $request->kecamatan);
        }

        $sekolah = $query->orderBy('kecamatan.nama_kecamatan', 'asc')
            ->orderBy('sekolah.status_pilihan_1', 'desc')
            ->orderBy('sekolah.nama_sekolah', 'asc')
            ->paginate(9)
            ->withQueryString();
        $kecamatan = Kecamatan::orderBy('nama_kecamatan', 'asc')->get();

        return view('frontend.sekolah_sd', compact('sekolah', 'kecamatan'));
    }

    public function sekolah_smp(Request $request)
    {
        $activePeriode = PeriodeDaftar::where('status_aktif', 1)->first();
        $query = Sekolah::query()->where('jenjang', 'SMP')
            ->withCount(['sekolahPilihan1 as pendaftar_count' => function ($q) use ($activePeriode) {
                if ($activePeriode) {
                    $q->where('periode_id', $activePeriode->id);
                }
            }])
            ->withCount(['pendaftarDiterima as lulus_count' => function ($q) use ($activePeriode) {
                $q->where('status', 'lulus');
                if ($activePeriode) {
                    $q->where('periode_id', $activePeriode->id);
                }
            }]);

        $query->join('kecamatan', 'sekolah.id_kecamatan', '=', 'kecamatan.id')
            ->select('sekolah.*');

        if ($request->filled('search')) {
            $query->where('sekolah.nama_sekolah', 'like', '%'.$request->search.'%');
        }

        if ($request->filled('kecamatan')) {
            $query->where('sekolah.id_kecamatan', $request->kecamatan);
        }

        $sekolah = $query->orderBy('kecamatan.nama_kecamatan', 'asc')
            ->orderBy('sekolah.status_pilihan_1', 'desc')
            ->orderBy('sekolah.nama_sekolah', 'asc')
            ->paginate(9)
            ->withQueryString();
        $kecamatan = Kecamatan::orderBy('nama_kecamatan', 'asc')->get();

        return view('frontend.sekolah_smp', compact('sekolah', 'kecamatan'));
    }

    public function detail_sekolah_sd($id)
    {
        $sekolah = Sekolah::with('kecamatan')->findOrFail($id);
        $activePeriode = PeriodeDaftar::where('status_aktif', 1)->first();

        $stats = [
            'prestasi' => $this->getStatsJalur($id, 3, $sekolah->daya_tampung_prestasi, $activePeriode),
            'domisili' => $this->getStatsJalur($id, 1, $sekolah->daya_tampung_domisili, $activePeriode),
            'afirmasi' => $this->getStatsJalur($id, 2, $sekolah->daya_tampung_afirmasi, $activePeriode),
            'mutasi' => $this->getStatsJalur($id, 4, $sekolah->daya_tampung_mutasi, $activePeriode),
        ];

        return view('frontend.detail_sekolah_sd', compact('sekolah', 'stats'));
    }

    public function detail_sekolah_smp($id)
    {
        $sekolah = Sekolah::with('kecamatan')->findOrFail($id);
        $activePeriode = PeriodeDaftar::where('status_aktif', 1)->first();

        $stats = [
            'prestasi' => $this->getStatsJalur($id, 3, $sekolah->daya_tampung_prestasi, $activePeriode),
            'domisili' => $this->getStatsJalur($id, 1, $sekolah->daya_tampung_domisili, $activePeriode),
            'afirmasi' => $this->getStatsJalur($id, 2, $sekolah->daya_tampung_afirmasi, $activePeriode),
            'mutasi' => $this->getStatsJalur($id, 4, $sekolah->daya_tampung_mutasi, $activePeriode),
        ];

        return view('frontend.detail_sekolah_smp', compact('sekolah', 'stats'));
    }

    private function getStatsJalur($sekolahId, $jalurId, $kuota, $activePeriode): array
    {
        $count = 0;
        $lulus = 0;
        if ($activePeriode) {
            $count = Pendaftaran::where('sekolah_pilihan_1', $sekolahId)
                ->where('jalur_id', $jalurId)
                ->where('periode_id', $activePeriode->id)
                ->count();

            $lulus = Pendaftaran::where('sekolah_diterima_id', $sekolahId)
                ->where('jalur_id', $jalurId)
                ->where('status', 'lulus')
                ->where('periode_id', $activePeriode->id)
                ->count();
        }

        $kuota = $kuota ?? 0;
        $sisa = max(0, $kuota - $lulus);
        $persen = $kuota > 0 ? min(100, round(($lulus / $kuota) * 100)) : 0;

        return [
            'kuota' => $kuota,
            'pendaftar' => $count,
            'lulus' => $lulus,
            'sisa' => $sisa,
            'persen' => $persen,
        ];
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

    public function posts()
    {
        $posts = Post::whereIn('status', ['Publish', 'Published'])
            ->orderBy('tanggal', 'desc')
            ->paginate(12);

        return view('frontend.berita', compact('posts'));
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

    /**
     * Check selection result for a participant.
     */
    public function cekHasilSeleksi(Request $request)
    {
        $request->validate([
            'no_pendaftaran' => 'required|string',
        ]);

        $result = DB::table('pendaftaran')
            ->join('peserta', 'pendaftaran.peserta_id', '=', 'peserta.id')
            ->leftJoin('hasil_seleksi', 'pendaftaran.id', '=', 'hasil_seleksi.pendaftaran_id')
            ->leftJoin('sekolah', 'pendaftaran.sekolah_diterima_id', '=', 'sekolah.id')
            ->leftJoin('jalur_pendaftaran', 'pendaftaran.jalur_id', '=', 'jalur_pendaftaran.id')
            ->select(
                'pendaftaran.id',
                'pendaftaran.nomor_pendaftaran',
                'pendaftaran.status as pendaftaran_status',
                'peserta.nama_lengkap',
                'peserta.nisn',
                'peserta.tanggal_lahir',
                'jalur_pendaftaran.nama_jalur',
                'sekolah.nama_sekolah as sekolah_diterima',
                'hasil_seleksi.status as seleksi_status',
                'hasil_seleksi.keterangan'
            )
            ->where('pendaftaran.nomor_pendaftaran', $request->no_pendaftaran)
            ->first();

        if (! $result) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan. Pastikan Nomor Pendaftaran sudah benar.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $result,
        ]);
    }

    /**
     * Public print graduation card.
     */
    public function printLulusPublic($id)
    {
        $pendaftaran = DB::table('pendaftaran')
            ->join('peserta', 'pendaftaran.peserta_id', '=', 'peserta.id')
            ->join('periode_pendaftaran', 'pendaftaran.periode_id', '=', 'periode_pendaftaran.id')
            ->join('jalur_pendaftaran', 'pendaftaran.jalur_id', '=', 'jalur_pendaftaran.id')
            ->join('sekolah as sekolah1', 'pendaftaran.sekolah_pilihan_1', '=', 'sekolah1.id')
            ->leftJoin('sekolah as sekolah2', 'pendaftaran.sekolah_pilihan_2', '=', 'sekolah2.id')
            ->leftJoin('sekolah as sekolah_diterima', 'pendaftaran.sekolah_diterima_id', '=', 'sekolah_diterima.id')
            ->where('pendaftaran.id', $id)
            ->where('pendaftaran.status', 'lulus')
            ->select(
                'pendaftaran.id',
                'pendaftaran.nomor_pendaftaran',
                'pendaftaran.tanggal_daftar',
                'pendaftaran.jalur_id',
                'pendaftaran.jenjang',
                'pendaftaran.sekolah_pilihan_1',
                'pendaftaran.sekolah_pilihan_2',
                'pendaftaran.sekolah_diterima_id',
                'peserta.nisn',
                'peserta.nama_lengkap',
                'peserta.tempat_lahir',
                'peserta.tanggal_lahir',
                'peserta.jenis_kelamin',
                'periode_pendaftaran.id as periode_id',
                'periode_pendaftaran.tahun_ajaran',
                'jalur_pendaftaran.id as jalur_id',
                'jalur_pendaftaran.nama_jalur',
                'sekolah1.nama_sekolah as sekolah_pilihan_1_nama',
                'sekolah2.nama_sekolah as sekolah_pilihan_2_nama',
                'sekolah_diterima.nama_sekolah as sekolah_diterima_nama',
            )
            ->first();

        if (! $pendaftaran) {
            abort(404, 'Data pendaftaran tidak ditemukan atau belum dinyatakan lulus.');
        }

        $pasfoto = DB::table('berkas_pendaftaran')
            ->where('pendaftaran_id', $id)
            ->where('jenis_berkas', 'pasfoto')
            ->first();

        $qrCode = QrCode::size(100)->margin(1)->generate($pendaftaran->nomor_pendaftaran);
        $qrCodeBase64 = 'data:image/svg+xml;base64,'.base64_encode($qrCode);

        // Pass flag isPublic so the view can adjust download link
        $isPublic = true;

        return view('backend.kelulusan.kartu_lulus', compact('pendaftaran', 'pasfoto', 'qrCodeBase64', 'isPublic'));
    }

    /**
     * Public download graduation card PDF.
     */
    public function downloadLulusPublic($id)
    {
        $pendaftaran = DB::table('pendaftaran')
            ->join('peserta', 'pendaftaran.peserta_id', '=', 'peserta.id')
            ->join('periode_pendaftaran', 'pendaftaran.periode_id', '=', 'periode_pendaftaran.id')
            ->join('jalur_pendaftaran', 'pendaftaran.jalur_id', '=', 'jalur_pendaftaran.id')
            ->join('sekolah as sekolah1', 'pendaftaran.sekolah_pilihan_1', '=', 'sekolah1.id')
            ->leftJoin('sekolah as sekolah2', 'pendaftaran.sekolah_pilihan_2', '=', 'sekolah2.id')
            ->leftJoin('sekolah as sekolah_diterima', 'pendaftaran.sekolah_diterima_id', '=', 'sekolah_diterima.id')
            ->where('pendaftaran.id', $id)
            ->where('pendaftaran.status', 'lulus')
            ->select(
                'pendaftaran.id',
                'pendaftaran.nomor_pendaftaran',
                'pendaftaran.tanggal_daftar',
                'pendaftaran.jalur_id',
                'pendaftaran.jenjang',
                'pendaftaran.sekolah_pilihan_1',
                'pendaftaran.sekolah_pilihan_2',
                'pendaftaran.sekolah_diterima_id',
                'peserta.nisn',
                'peserta.nama_lengkap',
                'peserta.tempat_lahir',
                'peserta.tanggal_lahir',
                'peserta.jenis_kelamin',
                'periode_pendaftaran.id as periode_id',
                'periode_pendaftaran.tahun_ajaran',
                'jalur_pendaftaran.id as jalur_id',
                'jalur_pendaftaran.nama_jalur',
                'sekolah1.nama_sekolah as sekolah_pilihan_1_nama',
                'sekolah2.nama_sekolah as sekolah_pilihan_2_nama',
                'sekolah_diterima.nama_sekolah as sekolah_diterima_nama',
            )
            ->first();

        if (! $pendaftaran) {
            abort(404, 'Data pendaftaran tidak ditemukan atau belum dinyatakan lulus.');
        }

        $appConfig = Konfigurasi::pluck('nilai', 'kunci')->toArray();

        // Convert logos to base64 for PDF compatibility
        $logoBase64 = null;
        if (! empty($appConfig['logo_path']) && File::exists(public_path($appConfig['logo_path']))) {
            $logoData = File::get(public_path($appConfig['logo_path']));
            $logoType = File::extension(public_path($appConfig['logo_path']));
            $logoBase64 = 'data:image/'.$logoType.';base64,'.base64_encode($logoData);
        }

        $logoDaerahBase64 = null;
        if (! empty($appConfig['logo_daerah']) && File::exists(public_path($appConfig['logo_daerah']))) {
            $logoData = File::get(public_path($appConfig['logo_daerah']));
            $logoType = File::extension(public_path($appConfig['logo_daerah']));
            $logoDaerahBase64 = 'data:image/'.$logoType.';base64,'.base64_encode($logoData);
        }

        $logoSuratBase64 = null;
        if (! empty($appConfig['logo_surat']) && File::exists(public_path($appConfig['logo_surat']))) {
            $logoData = File::get(public_path($appConfig['logo_surat']));
            $logoType = File::extension(public_path($appConfig['logo_surat']));
            $logoSuratBase64 = 'data:image/'.$logoType.';base64,'.base64_encode($logoData);
        }

        $pasfotoBase64 = null;
        $pasfoto = DB::table('berkas_pendaftaran')
            ->where('pendaftaran_id', $id)
            ->where('jenis_berkas', 'pasfoto')
            ->first();

        if ($pasfoto && File::exists(storage_path('app/'.$pasfoto->file_path))) {
            $pasfotoData = File::get(storage_path('app/'.$pasfoto->file_path));
            $pasfotoType = File::extension(storage_path('app/'.$pasfoto->file_path));
            $pasfotoBase64 = 'data:image/'.$pasfotoType.';base64,'.base64_encode($pasfotoData);
        }

        $qrCode = QrCode::size(100)->margin(1)->generate($pendaftaran->nomor_pendaftaran);
        $qrCodeBase64 = 'data:image/svg+xml;base64,'.base64_encode($qrCode);

        $pdf = Pdf::loadView('backend.kelulusan.kartu_lulus', [
            'pendaftaran' => $pendaftaran,
            'isPdf' => true,
            'logoBase64' => $logoBase64,
            'logoDaerahBase64' => $logoDaerahBase64,
            'logoSuratBase64' => $logoSuratBase64,
            'pasfotoBase64' => $pasfotoBase64,
            'qrCodeBase64' => $qrCodeBase64,
        ]);

        $pdf->setPaper('a4', 'portrait');

        return $pdf->download('Kartu-Kelulusan-'.$pendaftaran->nomor_pendaftaran.'.pdf');
    }

    public function juknis()
    {
        $juknis = Juknis::where('kunci', 'juknis')->first();

        return view('frontend.juknis', compact('juknis'));
    }

    public function persyaratan()
    {
        $persyaratan = Persyaratan::where('kunci', 'persyaratan')->first();

        return view('frontend.persyaratan', compact('persyaratan'));
    }
}
