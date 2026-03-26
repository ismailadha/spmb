@extends('frontend.main')

@section('content')
<style>
    /* Styling components for rich aesthetics */
    .glass-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.4);
        box-shadow: 0 8px 32px rgba(31, 38, 135, 0.08);
        border-radius: 20px;
    }
    .gradient-text {
        background-color: #1e2a4a;
        background-image: linear-gradient(135deg, #1abc9c 0%, #3498db 100%);
        background-size: 100%;
        -webkit-background-clip: text;
        -moz-background-clip: text;
        -webkit-text-fill-color: transparent; 
        -moz-text-fill-color: transparent;
    }
    .hero-bg {
        background: linear-gradient(135deg, rgba(30, 42, 74, 0.88) 0%, rgba(52, 152, 219, 0.80) 100%), url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=2070&auto=format&fit=crop') no-repeat center center;
        background-size: cover;
        background-attachment: fixed;
    }
    .info-icon-wrapper {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #1abc9c 0%, #3498db 100%);
        color: white;
        font-size: 1.15rem;
        box-shadow: 0 4px 12px rgba(52, 152, 219, 0.35);
    }
    .facility-card {
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        border-radius: 16px;
        overflow: hidden;
        border: none !important;
        box-shadow: 0 6px 15px rgba(0,0,0,0.04);
    }
    .facility-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        border-bottom: 4px solid #3498db !important;
    }
    .facility-icon {
        font-size: 3rem;
        margin-bottom: 1.25rem;
        color: #3498db;
        transition: all 0.3s ease;
    }
    .facility-card:hover .facility-icon {
        transform: scale(1.1);
        color: #1abc9c;
    }
    .stats-card {
        background: white;
        border-radius: 20px;
        padding: 2.5rem 1rem;
        text-align: center;
        box-shadow: 0 8px 25px rgba(0,0,0,0.06);
        transition: transform 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    .stats-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 6px;
        background: linear-gradient(90deg, #1abc9c, #3498db);
    }
    .stats-card:hover {
        transform: translateY(-8px);
    }
    .stats-value {
        font-size: 3rem;
        font-weight: 800;
        color: #1e2a4a;
        margin-bottom: 0.25rem;
        line-height: 1;
    }
    .stats-label {
        color: #7f8c8d;
        font-weight: 600;
        font-size: 1.05rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .section-title {
        color: #1e2a4a;
        font-weight: 800;
        margin-bottom: 2rem;
        position: relative;
        display: inline-block;
        padding-bottom: 10px;
    }
    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, #1abc9c, #3498db);
        border-radius: 2px;
    }
    
    .gallery-img {
        border-radius: 12px;
        overflow: hidden;
        position: relative;
        cursor: pointer;
    }
    .gallery-img img {
        transition: all 0.5s ease;
        width: 100%;
        height: 180px;
        object-fit: cover;
    }
    .gallery-img:hover img {
        transform: scale(1.1);
    }
    .gallery-overlay {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(30, 42, 74, 0.4);
        opacity: 0;
        transition: opacity 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .gallery-img:hover .gallery-overlay {
        opacity: 1;
    }
    
    .detail-list li {
        padding-top: 1rem;
        padding-bottom: 1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .detail-list li:last-child {
        border-bottom: none !important;
    }
</style>

<!-- Hero Section -->
<section class="hero-bg position-relative py-5" style="min-height: 480px; display: flex; align-items: center; justify-content: center; text-align: center;">
    <div class="container position-relative" style="z-index: 2;">
        <span class="badge badge-primary px-3 py-2 rounded-pill mb-3" style="background: rgba(255,255,255,0.2); backdrop-filter: blur(5px); font-size: 0.9rem; font-weight: 600; letter-spacing: 1px;">INFORMASI SEKOLAH</span>
        <h1 class="text-white font-weight-bold mb-4" style="font-size: 3.5rem; text-shadow: 0 4px 15px rgba(0,0,0,0.4); letter-spacing: -1px;">Profil Institusi Pendidikan</h1>
        <p class="text-white mx-auto mb-0" style="max-width: 650px; font-size: 1.25rem; font-weight: 300; line-height: 1.6; text-shadow: 0 2px 10px rgba(0,0,0,0.3);">
            Mengenal lebih dekat lingkungan, fasilitas, dan keunggulan tempat belajar yang membentuk generasi emas di masa depan.
        </p>
    </div>
    <!-- Simple wave divider at bottom -->
    <div style="position: absolute; bottom: -1px; left: 0; width: 100%; overflow: hidden; line-height: 0; transform: rotate(180deg);">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none" style="position: relative; display: block; width: calc(100% + 1.3px); height: 60px;">
            <path d="M1200 120L0 16.48 0 0 1200 0 1200 120z" style="fill: #f4f6f9;"></path>
        </svg>
    </div>
</section>

<!-- Main Content Area -->
<section class="py-5" style="background-color: #f4f6f9;">
    <div class="container" style="margin-top: -80px; position: relative; z-index: 10;">
        
        <!-- School Profile Header Card -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="glass-card p-4 p-md-5 position-relative overflow-hidden">
                    <!-- Decorative blur circles -->
                    <div style="position: absolute; top: -50px; right: -50px; width: 250px; height: 250px; background: rgba(52, 152, 219, 0.08); border-radius: 50%; filter: blur(20px);"></div>
                    <div style="position: absolute; bottom: -30px; left: 5%; width: 150px; height: 150px; background: rgba(26, 188, 156, 0.08); border-radius: 50%; filter: blur(15px);"></div>
                    
                    <div class="row align-items-center position-relative" style="z-index: 1;">
                        <div class="col-md-3 text-center mb-4 mb-md-0">
                            <!-- Dummy Logo -->
                            <div class="bg-white rounded-circle d-inline-flex align-items-center justify-content-center shadow" style="width: 170px; height: 170px; border: 5px solid #fff;">
                                <img src="https://ui-avatars.com/api/?name=NB&background=1e2a4a&color=fff&size=120&font-size=0.4&rounded=true" alt="Logo Sekolah" class="img-fluid rounded-circle" style="width: 100%; height: 100%;">
                            </div>
                        </div>
                        <div class="col-md-9 text-center text-md-left">
                            <span class="badge badge-success mb-3 px-3 py-2 rounded-pill shadow-sm" style="background-color: #1abc9c; font-size: 0.9rem;"><i class="la la-check-circle mr-1"></i> Akreditasi A (Unggul)</span>
                            <h2 class="font-weight-bold mb-3 gradient-text" style="font-size: 2.5rem; letter-spacing: -0.5px;">SMA Negeri 1 Nusa Bangsa</h2>
                            <p class="text-secondary mb-4 pr-md-5" style="font-size: 1.15rem; line-height: 1.7;">
                                Mendedikasikan diri untuk mencetak generasi penerus bangsa yang unggul dalam prestasi, berkarakter mulia, dan berwawasan global melalui pembelajaran yang inovatif dan interaktif.
                            </p>
                            <div class="d-flex flex-wrap justify-content-center justify-content-md-start">
                                <div class="d-flex align-items-center mr-4 mb-3 bg-white px-3 py-2 rounded-pill shadow-sm">
                                    <div class="info-icon-wrapper mr-2" style="width: 32px; height: 32px; font-size: 0.9rem;"><i class="la la-map-marker"></i></div>
                                    <span class="text-dark font-weight-bold" style="font-size: 0.95rem;">Jl. Pendidikan No. 123, Kota Cerdas</span>
                                </div>
                                <div class="d-flex align-items-center mb-3 bg-white px-3 py-2 rounded-pill shadow-sm">
                                    <div class="info-icon-wrapper mr-2" style="width: 32px; height: 32px; font-size: 0.9rem;"><i class="la la-phone"></i></div>
                                    <span class="text-dark font-weight-bold" style="font-size: 0.95rem;">(021) 1234-5678</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="row mb-5">
            <div class="col-lg-3 col-sm-6 mb-4 mb-lg-0">
                <div class="stats-card">
                    <div class="stats-value">1,250</div>
                    <div class="stats-label">Siswa Aktif</div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-4 mb-lg-0">
                <div class="stats-card">
                    <div class="stats-value">85</div>
                    <div class="stats-label">Guru & Staf</div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-4 mb-lg-0">
                <div class="stats-card">
                    <div class="stats-value">42</div>
                    <div class="stats-label">Ruang Kelas</div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="stats-card">
                    <div class="stats-value">24</div>
                    <div class="stats-label">Ekstrakurikuler</div>
                </div>
            </div>
        </div>

        <!-- Details Grid -->
        <div class="row">
            <!-- Left Column: Identitas & Fasilitas -->
            <div class="col-lg-8 mb-5 mb-lg-0 pr-lg-4">
                
                <!-- Fasilitas -->
                <div class="mb-5">
                    <h3 class="section-title">Fasilitas Utama</h3>
                    <div class="row">
                        <!-- Facility Item -->
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="facility-card bg-white p-4 text-center h-100">
                                <i class="la la-book facility-icon text-primary"></i>
                                <h5 class="font-weight-bold mb-2">Perpustakaan Digital</h5>
                                <p class="text-secondary small mb-0">Ribuan koleksi e-book & buku cetak dengan area baca super nyaman.</p>
                            </div>
                        </div>
                        <!-- Facility Item -->
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="facility-card bg-white p-4 text-center h-100">
                                <i class="la la-laptop facility-icon text-info"></i>
                                <h5 class="font-weight-bold mb-2">Lab Komputer</h5>
                                <p class="text-secondary small mb-0">PC spesifikasi tinggi, AC, & koneksi internet fiber optic 1 Gbps.</p>
                            </div>
                        </div>
                        <!-- Facility Item -->
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="facility-card bg-white p-4 text-center h-100">
                                <i class="la la-flask facility-icon text-warning"></i>
                                <h5 class="font-weight-bold mb-2">Lab Sains Modern</h5>
                                <p class="text-secondary small mb-0">Peralatan standar industri untuk praktik Fisika, Kimia, & Biologi.</p>
                            </div>
                        </div>
                        <!-- Facility Item -->
                        <div class="col-md-4 col-sm-6 mb-4 mb-md-0">
                            <div class="facility-card bg-white p-4 text-center h-100">
                                <i class="la la-mosque facility-icon text-success"></i>
                                <h5 class="font-weight-bold mb-2">Masjid Raya</h5>
                                <p class="text-secondary small mb-0">Masjid luas 2 lantai untuk mendukung kegiatan spiritual siswa.</p>
                            </div>
                        </div>
                        <!-- Facility Item -->
                        <div class="col-md-4 col-sm-6 mb-4 mb-md-0">
                            <div class="facility-card bg-white p-4 text-center h-100">
                                <i class="la la-futbol-o facility-icon text-danger"></i>
                                <h5 class="font-weight-bold mb-2">Sport Center</h5>
                                <p class="text-secondary small mb-0">Indoor gym, lapangan basket, voli, dan lapangan sepak bola rumput sintetis.</p>
                            </div>
                        </div>
                        <!-- Facility Item -->
                        <div class="col-md-4 col-sm-6">
                            <div class="facility-card bg-white p-4 text-center h-100">
                                <i class="la la-medkit facility-icon text-dark"></i>
                                <h5 class="font-weight-bold mb-2">Poliklinik Mini</h5>
                                <p class="text-secondary small mb-0">Dokter jaga dan perawat profesional, obat-obatan standar lengkap.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Galeri -->
                <div>
                    <h3 class="section-title">Galeri Kegiatan</h3>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="gallery-img shadow-sm">
                                <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=600&auto=format&fit=crop" alt="Lingkungan Sekolah">
                                <div class="gallery-overlay">
                                    <h5 class="text-white font-weight-bold mb-0">Gedung Utama</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="gallery-img shadow-sm">
                                <img src="https://images.unsplash.com/photo-1427504494785-319ce8372ac0?q=80&w=600&auto=format&fit=crop" alt="Kegiatan Belajar">
                                <div class="gallery-overlay">
                                    <h5 class="text-white font-weight-bold mb-0">PBM Interaktif</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4 mb-md-0">
                            <div class="gallery-img shadow-sm">
                                <img src="https://images.unsplash.com/photo-1577896851231-70ef18881754?q=80&w=400&auto=format&fit=crop" alt="Ekstrakurikuler">
                                <div class="gallery-overlay">
                                    <h6 class="text-white font-weight-bold mb-0">Seni Budaya</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4 mb-md-0">
                            <div class="gallery-img shadow-sm">
                                <img src="https://images.unsplash.com/photo-1546410531-bea5aadcb6ce?q=80&w=400&auto=format&fit=crop" alt="Olahraga">
                                <div class="gallery-overlay">
                                    <h6 class="text-white font-weight-bold mb-0">Eskul Basket</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="gallery-img shadow-sm">
                                <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?q=80&w=400&auto=format&fit=crop" alt="Kelulusan">
                                <div class="gallery-overlay">
                                    <h6 class="text-white font-weight-bold mb-0">Wisuda</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Informasi Detail & Kontak -->
            <div class="col-lg-4">
                <!-- Identitas List -->
                <div class="card border-0 shadow-lg rounded-lg mb-5" style="border-radius: 20px; overflow: hidden;">
                    <div class="card-header border-0 py-4" style="background: linear-gradient(135deg, #1e2a4a 0%, #2c3e50 100%);">
                        <h4 class="font-weight-bold text-white mb-0 text-center"><i class="la la-info-circle mr-2"></i>Identitas Sekolah</h4>
                    </div>
                    <div class="card-body px-4">
                        <ul class="list-unstyled mb-0 detail-list">
                            <li class="border-bottom">
                                <span class="text-secondary font-weight-bold">NPSN</span>
                                <strong class="text-dark bg-light px-2 py-1 rounded">20101234</strong>
                            </li>
                            <li class="border-bottom">
                                <span class="text-secondary font-weight-bold">Status</span>
                                <span class="badge badge-primary px-3 py-1 rounded-pill">Negeri</span>
                            </li>
                            <li class="border-bottom">
                                <span class="text-secondary font-weight-bold">Jenjang</span>
                                <strong class="text-dark">SMA / Sederajat</strong>
                            </li>
                            <li class="border-bottom text-right d-block">
                                <span class="text-secondary font-weight-bold d-block text-left mb-1">Kepala Sekolah</span>
                                <strong class="text-dark">Dr. H. Budi Santoso, M.Pd.</strong>
                            </li>
                            <li class="border-bottom">
                                <span class="text-secondary font-weight-bold">Kurikulum</span>
                                <strong class="text-dark">Kurikulum Merdeka</strong>
                            </li>
                            <li class="text-right d-block">
                                <span class="text-secondary font-weight-bold d-block text-left mb-1">Waktu Belajar</span>
                                <strong class="text-dark">Pagi (5 Hari Kerja)<br><small class="text-muted">Senin - Jumat | 07:00 - 15:30</small></strong>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Kontak -->
                <div class="card border-0 shadow-lg mb-5" style="border-radius: 20px; overflow: hidden; background: linear-gradient(135deg, #1abc9c 0%, #16a085 100%); color: white;">
                    <div class="card-body p-4 p-lg-5">
                        <h4 class="font-weight-bold mb-4 border-bottom border-light pb-3">Hubungi Kami</h4>
                        
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-white text-success rounded-circle d-flex align-items-center justify-content-center shadow-sm mr-3" style="width: 50px; height: 50px; font-size: 1.5rem;">
                                <i class="la la-whatsapp"></i>
                            </div>
                            <div>
                                <span class="d-block text-white-50 font-weight-bold small text-uppercase">Layanan 24 Jam</span>
                                <h5 class="mb-0 font-weight-bold">+62 812-3456-7890</h5>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-white text-primary rounded-circle d-flex align-items-center justify-content-center shadow-sm mr-3" style="width: 50px; height: 50px; font-size: 1.5rem;">
                                <i class="la la-envelope"></i>
                            </div>
                            <div>
                                <span class="d-block text-white-50 font-weight-bold small text-uppercase">Email Resmi</span>
                                <h6 class="mb-0 font-weight-bold">info@sman1nusabangsa.sch.id</h6>
                            </div>
                        </div>

                        <div class="d-flex align-items-center">
                            <div class="bg-white text-danger rounded-circle d-flex align-items-center justify-content-center shadow-sm mr-3" style="width: 50px; height: 50px; font-size: 1.5rem;">
                                <i class="la la-instagram"></i>
                            </div>
                            <div>
                                <span class="d-block text-white-50 font-weight-bold small text-uppercase">Social Media</span>
                                <h6 class="mb-0 font-weight-bold">@sman1nusabangsa</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Maps Card -->
                <div class="card border-0 shadow-lg rounded-lg overflow-hidden" style="border-radius: 20px;">
                    <div class="bg-dark text-white p-3 text-center" style="background-color: #1e2a4a !important;">
                        <h5 class="font-weight-bold mb-0">Titik Lokasi</h5>
                    </div>
                    <div class="position-relative" style="height: 250px;">
                        <!-- Embed Google Maps Dummy / Image -->
                        <img src="https://images.unsplash.com/photo-1524661135-423995f22d0b?q=80&w=600&auto=format&fit=crop" class="img-fluid w-100 h-100" style="object-fit: cover; opacity: 0.8;" alt="Peta Lokasi">
                        
                        <div class="position-absolute d-flex flex-column align-items-center justify-content-center" style="top: 0; left: 0; right: 0; bottom: 0; background: rgba(30, 42, 74, 0.4);">
                            <div class="text-danger mb-2" style="font-size: 3rem; text-shadow: 0 4px 10px rgba(0,0,0,0.5); animation: bounce 2s infinite;">
                                <i class="la la-map-marker"></i>
                            </div>
                            <button class="btn btn-light rounded-pill font-weight-bold shadow-lg px-4 d-flex align-items-center">
                                Buka di Google Maps <i class="la la-external-link ml-2"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <style>
                    @keyframes bounce {
                        0%, 20%, 50%, 80%, 100% {transform: translateY(0);}
                        40% {transform: translateY(-20px);}
                        60% {transform: translateY(-10px);}
                    }
                </style>
            </div>
        </div>

    </div>
</section>
@endsection