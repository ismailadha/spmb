<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HasilSeleksiController;
use App\Http\Controllers\KelulusanController;
use App\Http\Controllers\KonfigurasiController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PeriodeDaftarController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SambutanController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerifikasiController;
use App\Http\Controllers\WilayahController;
use App\Models\Pendaftaran;
use App\Models\Slider;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'index'])->name('home');

Route::get('juknis', [FrontendController::class, 'juknis'])->name('juknis');

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

Route::post('cek-hasil-seleksi', [FrontendController::class, 'cekHasilSeleksi'])->name('cek.hasil.seleksi');
Route::get('hasil-seleksi/cetak/{id}', [FrontendController::class, 'printLulusPublic'])->name('hasil-seleksi.cetak');
Route::get('hasil-seleksi/download/{id}', [FrontendController::class, 'downloadLulusPublic'])->name('hasil-seleksi.download');

// zonasi sd
Route::get('zonasi-sd', [FrontendController::class, 'zonasi_sd'])->name('zonasi-sd');

// zonasi smp
Route::get('zonasi-smp', [FrontendController::class, 'zonasi_smp'])->name('zonasi-smp');

Route::get('kontak', [FrontendController::class, 'kontak'])->name('kontak');

Route::middleware('auth')->group(function () {

    // Home
    Route::get('/dashboard', function () {
        $stats = [
            'total' => Pendaftaran::count(),
            'domisili' => [
                'total' => Pendaftaran::where('jalur_id', 1)->count(),
                'sd' => Pendaftaran::where('jalur_id', 1)->where('jenjang', 'SD')->count(),
                'smp' => Pendaftaran::where('jalur_id', 1)->where('jenjang', 'SMP')->count(),
            ],
            'afirmasi' => [
                'total' => Pendaftaran::where('jalur_id', 2)->count(),
                'sd' => Pendaftaran::where('jalur_id', 2)->where('jenjang', 'SD')->count(),
                'smp' => Pendaftaran::where('jalur_id', 2)->where('jenjang', 'SMP')->count(),
            ],
            'prestasi' => [
                'total' => Pendaftaran::where('jalur_id', 3)->count(),
                'smp' => Pendaftaran::where('jalur_id', 3)->where('jenjang', 'SMP')->count(),
            ],
            'mutasi' => [
                'total' => Pendaftaran::where('jalur_id', 4)->count(),
                'sd' => Pendaftaran::where('jalur_id', 4)->where('jenjang', 'SD')->count(),
                'smp' => Pendaftaran::where('jalur_id', 4)->where('jenjang', 'SMP')->count(),
            ],
        ];

        return view('backend.home', compact('stats'));
    })->name('dashboard');

    Route::prefix('wilayah')->group(function () {
        Route::get('/kabupaten/{id}', [WilayahController::class, 'getKabupaten'])->name('wilayah.kabupaten');
        Route::get('/kecamatan/{id}', [WilayahController::class, 'getKecamatan'])->name('wilayah.kecamatan');
        Route::get('/desa/{id}', [WilayahController::class, 'getDesa'])->name('wilayah.desa');
    });

    Route::middleware('role:admin_dinas,admin_sekolah')->group(function () {
        // sekolah
        Route::get('sekolah/sd', [SekolahController::class, 'sekolah_sd'])->name('sekolah.sd');
        Route::get('sekolah/smp', [SekolahController::class, 'sekolah_smp'])->name('sekolah.smp');
        Route::resource('sekolah', SekolahController::class);

        // peserta
        Route::get('peserta/sd', [PesertaController::class, 'peserta_sd'])->name('peserta.sd');
        Route::get('peserta/sd/export/excel', [PesertaController::class, 'exportExcel_sd'])->name('peserta.sd.export.excel');
        Route::get('peserta/sd/export/pdf', [PesertaController::class, 'exportPdf_sd'])->name('peserta.sd.export.pdf');
        Route::get('peserta/smp', [PesertaController::class, 'peserta_smp'])->name('peserta.smp');
        Route::get('peserta/smp/export/excel', [PesertaController::class, 'exportExcel_smp'])->name('peserta.smp.export.excel');
        Route::get('peserta/smp/export/pdf', [PesertaController::class, 'exportPdf_smp'])->name('peserta.smp.export.pdf');
        Route::get('peserta/{id}/verifikasi', [PesertaController::class, 'detail_verifikasi'])->name('peserta.verifikasi');
        Route::post('peserta/{id}/setuju-verifikasi', [VerifikasiController::class, 'setuju_verifikasi'])->name('peserta.verifikasi.setuju');
        Route::get('peserta/detail/{id}', [PesertaController::class, 'show'])->name('peserta.detail');
        Route::resource('peserta', PesertaController::class);

        // kelulusan
        Route::get('kelulusan/sd', [KelulusanController::class, 'kelulusan_sd'])->name('kelulusan.sd');
        Route::get('kelulusan/sd/data', [KelulusanController::class, 'data_sd'])->name('kelulusan.sd.data');
        Route::post('kelulusan/sd/sahkan', [KelulusanController::class, 'sahkan_sd'])->name('kelulusan.sd.sahkan');
        Route::get('kelulusan/smp', [KelulusanController::class, 'kelulusan_smp'])->name('kelulusan.smp');
        Route::get('kelulusan/smp/data', [KelulusanController::class, 'data_smp'])->name('kelulusan.smp.data');
        Route::post('kelulusan/smp/sahkan', [KelulusanController::class, 'sahkan_smp'])->name('kelulusan.smp.sahkan');
        Route::post('kelulusan/luluskan', [KelulusanController::class, 'setLulus'])->name('kelulusan.luluskan');

        // hasil seleksi
        Route::get('hasil-seleksi/sd', [HasilSeleksiController::class, 'hasil_seleksi_sd'])->name('hasil-seleksi.sd');
        Route::get('hasil-seleksi/sd/export/excel', [HasilSeleksiController::class, 'exportExcel_sd'])->name('hasil-seleksi.sd.export.excel');
        Route::get('hasil-seleksi/sd/export/pdf', [HasilSeleksiController::class, 'exportPdf_sd'])->name('hasil-seleksi.sd.export.pdf');
        Route::get('hasil-seleksi/smp', [HasilSeleksiController::class, 'hasil_seleksi_smp'])->name('hasil-seleksi.smp');
        Route::get('hasil-seleksi/smp/export/excel', [HasilSeleksiController::class, 'exportExcel_smp'])->name('hasil-seleksi.smp.export.excel');
        Route::get('hasil-seleksi/smp/export/pdf', [HasilSeleksiController::class, 'exportPdf_smp'])->name('hasil-seleksi.smp.export.pdf');
    });

    // Route berkas bisa diakses oleh admin dan peserta
    Route::get('/pendaftaran/berkas/{id}', [PendaftaranController::class, 'showBerkas'])->name('pendaftaran.berkas.show');

    Route::middleware('role:peserta')->group(function () {

        // pendaftaran
        Route::prefix('pendaftaran')->group(function () {
            Route::get('/', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
            Route::get('/create', [PendaftaranController::class, 'create'])->name('pendaftaran.create');
            Route::post('/', [PendaftaranController::class, 'store'])->name('pendaftaran.store');

            Route::get('/{id}/edit', [PendaftaranController::class, 'edit'])->name('pendaftaran.edit');
            Route::get('/{id}/print', [PendaftaranController::class, 'print'])->name('pendaftaran.print');
            Route::get('/{id}/print-lulus', [PendaftaranController::class, 'printLulus'])->name('pendaftaran.lulus.print');
            Route::get('/{id}/download', [PendaftaranController::class, 'downloadPdf'])->name('pendaftaran.download');
            Route::get('/{id}/download-lulus', [PendaftaranController::class, 'downloadLulusPdf'])->name('pendaftaran.lulus.download');
            Route::put('/{id}', [PendaftaranController::class, 'update'])->name('pendaftaran.update');
            Route::get('/sekolah/jalur/{jalur_id}', [PendaftaranController::class, 'getSekolahByJalur'])->name('pendaftaran.sekolah_jalur');
        });
    });

    Route::middleware('role:admin_dinas')->group(function () {
        // konfigurasi
        Route::get('konfigurasi', [KonfigurasiController::class, 'index'])->name('konfigurasi.index');
        Route::put('konfigurasi', [KonfigurasiController::class, 'update'])->name('konfigurasi.update');
        Route::get('konfigurasi/juknis', [KonfigurasiController::class, 'konfig_juknis'])->name('konfigurasi.juknis');
        Route::post('konfigurasi/juknis', [KonfigurasiController::class, 'konfig_juknis'])->name('konfigurasi.juknis.update');

        // resource periode
        Route::resource('periode', PeriodeDaftarController::class);

        // pengguna
        Route::resource('pengguna', UserController::class);

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
    });
});

require __DIR__.'/auth.php';
