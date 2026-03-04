<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.index');
});

Route::get('juknis', function () {
    return view('frontend.juknis');
});

Route::get('persyaratan', function () {
    return view('frontend.persyaratan');
});

Route::get('datasekolah', function () {
    return view('frontend.datasekolah');
});

Route::get('/dashboard', function () {
    return view('backend.main');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
