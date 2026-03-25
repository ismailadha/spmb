@extends('frontend.main')

@section('content')
    <section class="breadcrumb_area breadcrumb2 bgimage biz_overlay">
        <div class="bg_image_holder">
            <img src="{{ asset('front/img/breadbg.jpg') }}" alt="">
        </div>
        <div class="container content_above">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb_wrapper d-flex flex-column align-items-center">
                        <h3 class="page_title">Persyaratan Pendaftaran</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="persyaratan_area section-padding" style="padding: 80px 0; background-color: #f8f9fa;">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <h2 class="mb-3" style="color: #1e2a4a; font-weight: 700;">Syarat dan Ketentuan Pendaftaran</h2>
                    <p class="text-muted" style="font-size: 1.1rem; line-height: 1.8;">Berikut adalah persyaratan lengkap yang harus dipenuhi oleh calon siswa baru untuk dapat mengikuti proses seleksi penerimaan. Pastikan seluruh dokumen disiapkan dengan baik sebelum melanjutkan pendaftaran.</p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 mb-5">
                    <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; border-top: 5px solid #3498db !important;">
                        <div class="card-body p-5">
                            <div class="d-flex align-items-center mb-4">
                                <div class="icon-box mr-3" style="width: 50px; height: 50px; background: rgba(52, 152, 219, 0.1); border-radius: 50%; line-height: 50px; text-align: center;">
                                    <i class="la la-user-check" style="font-size: 2rem; color: #3498db;"></i>
                                </div>
                                <h3 class="font-weight-bold mb-0" style="color: #1e2a4a;">Persyaratan Umum</h3>
                            </div>
                            <ul class="list-unstyled">
                                <li class="mb-3 d-flex" style="line-height: 1.7; color: #555;">
                                    <i class="la la-check-circle mr-3 mt-1" style="color: #2ecc71; font-size: 1.3rem;"></i>
                                    Berusia maksimal 15 tahun pada tanggal 1 Juli tahun berjalan (untuk SMP) atau maksimal 12 tahun (untuk SD).
                                </li>
                                <li class="mb-3 d-flex" style="line-height: 1.7; color: #555;">
                                    <i class="la la-check-circle mr-3 mt-1" style="color: #2ecc71; font-size: 1.3rem;"></i>
                                    Memiliki Ijazah / Surat Tanda Tamat Belajar (STTB) dari jenjang pendidikan sebelumnya (SD/MI untuk pendaftar SMP).
                                </li>
                                <li class="mb-3 d-flex" style="line-height: 1.7; color: #555;">
                                    <i class="la la-check-circle mr-3 mt-1" style="color: #2ecc71; font-size: 1.3rem;"></i>
                                    Warga Negara Indonesia (WNI) dibuktikan dengan dokumen kependudukan (KTP Orang Tua dan Kartu Keluarga) yang sah.
                                </li>
                                <li class="mb-3 d-flex" style="line-height: 1.7; color: #555;">
                                    <i class="la la-check-circle mr-3 mt-1" style="color: #2ecc71; font-size: 1.3rem;"></i>
                                    Bagi peserta luar kota/provinsi atau lulusan tahun sebelumnya wajib menyertakan surat rekomendasi pindah rayon dari instansi asal.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-5">
                    <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; border-top: 5px solid #1abc9c !important;">
                        <div class="card-body p-5">
                            <div class="d-flex align-items-center mb-4">
                                <div class="icon-box mr-3" style="width: 50px; height: 50px; background: rgba(26, 188, 156, 0.1); border-radius: 50%; line-height: 50px; text-align: center;">
                                    <i class="la la-file-alt" style="font-size: 2rem; color: #1abc9c;"></i>
                                </div>
                                <h3 class="font-weight-bold mb-0" style="color: #1e2a4a;">Persyaratan Dokumen</h3>
                            </div>
                            <ul class="list-unstyled">
                                <li class="mb-3 d-flex" style="line-height: 1.7; color: #555;">
                                    <i class="la la-check-circle mr-3 mt-1" style="color: #2ecc71; font-size: 1.3rem;"></i>
                                    <div><span class="font-weight-bold text-dark">Pas Foto:</span> Foto terbaru ukuran 3x4 dan 4x6 (masing-masing 3 lembar, latar belakang menyesuaikan jenjang merah/biru).</div>
                                </li>
                                <li class="mb-3 d-flex" style="line-height: 1.7; color: #555;">
                                    <i class="la la-check-circle mr-3 mt-1" style="color: #2ecc71; font-size: 1.3rem;"></i>
                                    <div><span class="font-weight-bold text-dark">Kartu Keluarga (KK):</span> Fotokopi KK asli (diterbitkan paling singkat 1 tahun sebelum tanggal pendaftaran).</div>
                                </li>
                                <li class="mb-3 d-flex" style="line-height: 1.7; color: #555;">
                                    <i class="la la-check-circle mr-3 mt-1" style="color: #2ecc71; font-size: 1.3rem;"></i>
                                    <div><span class="font-weight-bold text-dark">Akta Kelahiran:</span> Fotokopi akta kelahiran / surat keterangan lahir pendaftar yang dilegalisir dari instansi berwenang.</div>
                                </li>
                                <li class="mb-3 d-flex" style="line-height: 1.7; color: #555;">
                                    <i class="la la-check-circle mr-3 mt-1" style="color: #2ecc71; font-size: 1.3rem;"></i>
                                    <div><span class="font-weight-bold text-dark">Nilai Rapor:</span> Fotokopi raport semester 1 s.d. 5 yang telah dilegalisir oleh kepala sekolah (khusus jalur prestasi akademik).</div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card border-0 shadow-sm mb-5" style="border-radius: 15px; border-left: 5px solid #f39c12 !important;">
                        <div class="card-body p-5">
                            <h3 class="font-weight-bold mb-4" style="color: #1e2a4a;"><i class="la la-map-marker text-warning mr-2"></i> Jalur Zonasi</h3>
                            <div class="row align-items-center">
                                <div class="col-md-9">
                                    <p class="text-muted" style="line-height: 1.8; font-size: 1.05rem;">
                                        Bagi pendaftar jalur zonasi, penentuan kelulusan sangat dipengaruhi oleh jarak dari domisili peserta (berdasarkan alamat pada Kartu Keluarga) ke sekolah tujuan. Domisili tersebut berupa Kartu Keluarga (KK) yang <strong>minimal sudah diterbitkan 1 (satu) tahun</strong> sebelum pelaksanaan pendaftaran.
                                    </p>
                                    <div class="row mt-3">
                                        <div class="col-sm-6 mb-2 text-muted">
                                            <div class="d-flex align-items-center">
                                                <i class="la la-angle-right mr-2 text-primary font-weight-bold"></i> 
                                                <span><strong>Zona 1:</strong> Beririsan langsung kelurahan</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-2 text-muted">
                                            <div class="d-flex align-items-center">
                                                <i class="la la-angle-right mr-2 text-primary font-weight-bold"></i> 
                                                <span><strong>Zona 2:</strong> Beririsan langsung kecamatan</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-2 text-muted">
                                            <div class="d-flex align-items-center">
                                                <i class="la la-angle-right mr-2 text-primary font-weight-bold"></i> 
                                                <span><strong>Zona 3:</strong> Satu kabupaten / kota</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-2 text-muted">
                                            <div class="d-flex align-items-center">
                                                <i class="la la-angle-right mr-2 text-primary font-weight-bold"></i> 
                                                <span><strong>Luar Zona:</strong> Luar wilayah kabupaten/kota</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 text-center mt-4 mt-md-0">
                                    <div style="background-color: #fcebeb; color: #e74c3c; width: 120px; height: 120px; border-radius: 50%; line-height: 120px; text-align: center; margin: 0 auto; box-shadow: 0 4px 15px rgba(231, 76, 60, 0.2);">
                                        <i class="la la-compass" style="font-size: 4rem; vertical-align: middle;"></i>
                                    </div>
                                    <b class="d-block mt-3 text-danger">Kalkulasi Jarak Udara</b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card border-0 shadow-sm" style="border-radius: 15px; border-left: 5px solid #9b59b6 !important;">
                        <div class="card-body p-5">
                            <h3 class="font-weight-bold mb-4" style="color: #1e2a4a;"><i class="la la-certificate mr-2" style="color: #9b59b6;"></i> Jalur Prestasi (Khusus SMP)</h3>
                            <p class="text-muted mb-4" style="line-height: 1.8; font-size: 1.05rem;">
                                Dikhususkan bagi calon siswa yang memiliki prestasi akademik maupun non-akademik di tingkat regional, nasional, maupun internasional. Adapun bukti fisik tambahan yang harus disiapkan peserta meliputi:
                            </p>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex bg-light p-4 rounded h-100 align-items-center shadow-sm" style="border-left: 3px solid #ffca28;">
                                        <i class="la la-trophy text-warning" style="font-size: 2.5rem; margin-right: 20px;"></i>
                                        <div>
                                            <h5 class="font-weight-bold mb-1" style="color: #1e2a4a;">Sertifikat Kejuaraan ASLI</h5>
                                            <p class="text-muted text-sm mb-0" style="font-size: 0.9rem;">Menunjukkan Piagam/Sertifikat asli (Juara 1, 2, atau 3) berjenjang minimal tingkat Kabupaten.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex bg-light p-4 rounded h-100 align-items-center shadow-sm" style="border-left: 3px solid #29b6f6;">
                                        <i class="la la-file-signature text-info" style="font-size: 2.5rem; margin-right: 20px;"></i>
                                        <div>
                                            <h5 class="font-weight-bold mb-1" style="color: #1e2a4a;">Surat Keterangan Penyelenggara</h5>
                                            <p class="text-muted text-sm mb-0" style="font-size: 0.9rem;">Surat dilegalisir oleh pihak panitia pelaksana/induk organisasi terkait sesuai cabang perlombaannya.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="row mt-5 pt-4">
                <div class="col-lg-12 text-center">
                    <div class="p-5 d-flex flex-column flex-md-row justify-content-between align-items-center" style="background: linear-gradient(135deg, #1e2a4a 0%, #2c3e50 100%); border-radius: 15px; color: white;">
                        <div class="text-left mb-4 mb-md-0">
                            <h2 class="font-weight-bold mb-2 text-white">Sudah Membaca Persyaratan?</h2>
                            <p class="mb-0" style="font-size: 1.1rem; opacity: 0.9;">Jika semua dokumen Anda siap, mari mulai pendaftaran sekarang!</p>
                        </div>
                        <div class="d-flex flex-column flex-sm-row">
                            <a href="{{ route('juknis') }}" class="btn btn-outline-light px-4 py-3 mb-2 mb-sm-0 mr-sm-3" style="border-radius: 50px; font-weight: 600; font-size: 1rem;">
                                <i class="la la-book mr-2"></i> Baca Petunjuk Teknis
                            </a>
                            <a href="{{ route('register-peserta') }}" class="btn btn-primary px-4 py-3 shadow" style="border-radius: 50px; font-weight: 700; font-size: 1rem; background-color: #1abc9c; border: none; box-shadow: 0 4px 15px rgba(26, 188, 156, 0.4);">
                                <i class="la la-user-plus mr-2"></i> Mulai Pendaftaran
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
