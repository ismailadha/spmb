<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\PostController;
// use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\SliderController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'index'])->name('home');

Route::get('juknis', function () {
    return view('frontend.juknis');
})->name('juknis');

Route::get('persyaratan', function () {
    return view('frontend.persyaratan');
})->name('persyaratan');

Route::get('datasekolah', function () {
    return view('frontend.datasekolah');
})->name('datasekolah');

Route::middleware('auth')->group(function () {

    // Home
    Route::get('/dashboard', function () {
        return view('backend.home');
    })->name('dashboard');

    Route::resource('sekolah', SekolahController::class);

    Route::resource('peserta', PesertaController::class);

    Route::get('registrasi-sd', function () {
        return view('frontend.registrasi_sd');
    })->name('registrasi-sd');

    Route::get('registrasi-smp', function () {
        return view('frontend.registrasi_smp');
    })->name('registrasi-smp');

    // Post
    Route::resource('posts', PostController::class);
    Route::get('/search-post', [PostController::class, 'search_post'])->name('search-post');

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
