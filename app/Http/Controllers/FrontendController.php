<?php

namespace App\Http\Controllers;

use App\Models\PeriodeDaftar;
use App\Models\Post;
use App\Models\Sambutan;
use App\Models\Slider;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        $sambutans = Sambutan::where('is_active', 1)->orderBy('sort_order', 'asc')->take(2)->get();
        $posts = Post::whereIn('status', ['Publish', 'Published'])->orderBy('tanggal', 'desc')->take(3)->get();
        $activePeriode = PeriodeDaftar::where('status_aktif', 1)->first();

        return view('frontend.index', compact('sliders', 'sambutans', 'posts', 'activePeriode'));
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

    public function datasekolah()
    {
        return view('frontend.daftar_cari_sekolah');
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
}
