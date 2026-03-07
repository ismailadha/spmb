<?php


use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SliderController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'index'])->name('home');

Route::get('juknis', function () {
    return view('frontend.juknis');
});

Route::get('persyaratan', function () {
    return view('frontend.persyaratan');
});

Route::get('datasekolah', function () {
    return view('frontend.datasekolah');
});

Route::middleware('auth')->group(function () {

    //Home
    Route::get('/dashboard', function () {
        return view('backend.home');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Slider
	Route::get('slider', [SliderController::class, 'index'])->name('slider.index');
	Route::get('slider/create', [SliderController::class, 'create'])->name('slider.create');
	Route::post('slider/destroy/{id}', [SliderController::class, 'destroy'])->name('slider.destroy');
	Route::get('slider/edit/{id}', [SliderController::class, 'edit'])->name('slider.edit');
	Route::put('slider/update/{id}', [SliderController::class, 'update'])->name('slider.update');
	Route::post('slider/store', [SliderController::class, 'store'])->name('slider.store');
});

require __DIR__.'/auth.php';
