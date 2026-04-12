<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\KelulusanController;
use App\Http\Controllers\KonfigurasiController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PeriodeDaftarController;
use App\Http\Controllers\PesertaController;
// use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SambutanController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WilayahController;
use App\Models\Slider;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'index'])->name('home');

Route::get('juknis', function () {
    return view('frontend.juknis');
})->name('juknis');

Route::get('persyaratan', function () {
    return view('frontend.persyaratan');
})->name('persyaratan');

// Data Sekolah
Route::get('sekolah-sd', [FrontendController::class, 'sekolah_sd'])->name('sekolah-sd');
Route::get('sekolah-sd/{id}', [FrontendController::class, 'detail_sekolah_sd'])->name('sekolah-sd.detail');
Route::get('sekolah-smp', [FrontendController::class, 'sekolah_smp'])->name('sekolah-smp');
Route::get('sekolah-smp/{id}', [FrontendController::class, 'detail_sekolah_smp'])->name('sekolah-smp.detail');

Route::get('berita/{slug}', [FrontendController::class, 'showPost'])->name('post.detail');

Route::get('hasil-seleksi', function () {
    return view('frontend.hasil_seleksi');
})->name('hasil-seleksi');

// zonasi sd
Route::get('zonasi-sd', [FrontendController::class, 'zonasi_sd'])->name('zonasi-sd');

// zonasi smp
Route::get('zonasi-smp', [FrontendController::class, 'zonasi_smp'])->name('zonasi-smp');

Route::get('kontak', function () {
    return view('frontend.kontak');
})->name('kontak');

Route::middleware('auth')->group(function () {

    // Home
    Route::get('/dashboard', function () {
        return view('backend.home');
    })->name('dashboard');

    Route::get('konfigurasi', [KonfigurasiController::class, 'index'])->name('konfigurasi.index');
    Route::put('konfigurasi', [KonfigurasiController::class, 'update'])->name('konfigurasi.update');

    Route::resource('sekolah', SekolahController::class);

    // resource periode
    Route::resource('periode', PeriodeDaftarController::class);

    Route::get('peserta/sd', [PesertaController::class, 'peserta_sd'])->name('peserta.sd');
    Route::get('peserta/smp', [PesertaController::class, 'peserta_smp'])->name('peserta.smp');
    Route::get('peserta/{id}/verifikasi', [PesertaController::class, 'detail_verifikasi'])->name('peserta.verifikasi');
    Route::resource('peserta', PesertaController::class);

    Route::get('kelulusan/sd', [KelulusanController::class, 'kelulusan_sd'])->name('kelulusan.sd');
    Route::get('kelulusan/smp', [KelulusanController::class, 'kelulusan_smp'])->name('kelulusan.smp');

    Route::resource('pengguna', UserController::class);

    Route::prefix('pendaftaran')->group(function () {
        Route::get('/', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
        Route::get('/create', [PendaftaranController::class, 'create'])->name('pendaftaran.create');
        Route::post('/', [PendaftaranController::class, 'store'])->name('pendaftaran.store');

        Route::get('/{id}/edit', [PendaftaranController::class, 'edit'])->name('pendaftaran.edit');
        Route::get('/{id}/print', [PendaftaranController::class, 'print'])->name('pendaftaran.print');
        Route::put('/{id}', [PendaftaranController::class, 'update'])->name('pendaftaran.update');
        Route::get('/sekolah/jalur/{jalur_id}', [PendaftaranController::class, 'getSekolahByJalur'])->name('pendaftaran.sekolah_jalur');
        Route::get('/berkas/{id}', [PendaftaranController::class, 'showBerkas'])->name('pendaftaran.berkas.show');
    });

    Route::prefix('wilayah')->group(function () {
        Route::get('/kabupaten/{id}', [WilayahController::class, 'getKabupaten'])->name('wilayah.kabupaten');
        Route::get('/kecamatan/{id}', [WilayahController::class, 'getKecamatan'])->name('wilayah.kecamatan');
        Route::get('/desa/{id}', [WilayahController::class, 'getDesa'])->name('wilayah.desa');
    });

    // Post
    Route::resource('posts', PostController::class);
    Route::get('/search-post', [PostController::class, 'search_post'])->name('search-post');

    // Sambutan
    Route::get('sambutan', [SambutanController::class, 'index'])->name('sambutan.index');
    Route::get('sambutan/create', [SambutanController::class, 'create'])->name('sambutan.create');
    Route::post('sambutan/destroy/{id}', [SambutanController::class, 'destroy'])->name('sambutan.destroy');
    Route::get('sambutan/edit/{id}', [SambutanController::class, 'edit'])->name('sambutan.edit');
    Route::put('sambutan/update/{id}', [SambutanController::class, 'update'])->name('sambutan.update');
    Route::post('sambutan/store', [SambutanController::class, 'store'])->name('sambutan.store');

    // Slider
    Route::get('slider', [SliderController::class, 'index'])->name('slider.index');
    Route::get('slider/create', [SliderController::class, 'create'])->name('slider.create');
    Route::post('slider/destroy/{id}', [SliderController::class, 'destroy'])->name('slider.destroy');
    Route::get('slider/edit/{id}', [SliderController::class, 'edit'])->name('slider.edit');
    Route::put('slider/update/{id}', [SliderController::class, 'update'])->name('slider.update');
    Route::post('slider/store', [SliderController::class, 'store'])->name('slider.store');

    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
