@extends('frontend.main')

@section('content')
<!-- Breadcrumb Area -->
<section class="breadcrumb_area breadcrumb2 bgimage" style="background-image: url('{{ asset('front/img/bg.jpg') }}'); background-size: cover; padding: 100px 0;">
    <div class="bg_image_holder">
        <img src="https://images.unsplash.com/photo-1510531704581-5b2870972060?w=600&q=80" alt="">
    </div>
</section>

<!-- Search & Filter Area -->
<section class="filter-area section-padding py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <!-- Filter Card -->
        <div class="row mb-5">
            <div class="col-lg-12">
                <div class="card shadow border-0" style="border-radius: 15px; margin-top: -80px; z-index: 10;">
                    <div class="card-body p-4 p-md-5">
                        <h5 class="mb-4 font-weight-bold" style="color: #1e2a4a;"><i class="la la-filter mr-2 text-primary"></i> Filter Pencarian</h5>
                        <form action="#" method="GET">
                            <div class="row">
                                <div class="col-md-4 mb-3 mb-md-0">
                                    <label class="font-weight-bold text-muted" style="font-size: 0.9rem;">Nama Sekolah</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-light border-right-0" style="border-radius: 8px 0 0 8px;"><i class="la la-search text-muted"></i></span>
                                        </div>
                                        <input type="text" class="form-control bg-light border-left-0 pl-0" placeholder="Ketik nama sekolah..." name="search" style="border-radius: 0 8px 8px 0; box-shadow: none;">
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3 mb-md-0">
                                    <label class="font-weight-bold text-muted" style="font-size: 0.9rem;">Jenjang</label>
                                    <select class="form-control custom-select bg-light" name="jenjang" style="border-radius: 8px; box-shadow: none;">
                                        <option value="">Semua Jenjang</option>
                                        <option value="SD">Sekolah Dasar (SD)</option>
                                        <option value="SMP">Sekolah Menengah Pertama (SMP)</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3 mb-md-0">
                                    <label class="font-weight-bold text-muted" style="font-size: 0.9rem;">Kecamatan</label>
                                    <select class="form-control custom-select bg-light" name="kecamatan" style="border-radius: 8px; box-shadow: none;">
                                        <option value="">Semua Kecamatan</option>
                                        <option value="Kecamatan A">Kecamatan A</option>
                                        <option value="Kecamatan B">Kecamatan B</option>
                                        <option value="Kecamatan C">Kecamatan C</option>
                                    </select>
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary d-block w-100" style="border-radius: 8px; font-weight: 600; padding: 10px 15px; background: linear-gradient(135deg, #1abc9c 0%, #3498db 100%); border: none;">
                                        Tampilkan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- School List -->
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <h4 class="font-weight-bold" style="color: #1e2a4a;">Menampilkan Sekolah</h4>
            <span class="text-muted">6 Data Ditemukan</span>
        </div>

        <div class="row">
            <!-- Dummy Data 1 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card school-card h-100 shadow-sm border-0 transition-hover" style="border-radius: 15px; overflow: hidden;">
                    <div class="position-relative">
                        <img src="https://images.unsplash.com/photo-1546410531-bb4caa6b424d?w=600&q=80" class="card-img-top" alt="Sekolah" style="height: 200px; object-fit: cover;">
                        <span class="badge position-absolute" style="top: 15px; right: 15px; padding: 8px 12px; border-radius: 6px; font-weight: 600; background-color: #2ecc71; color: white; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">Akreditasi A</span>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="font-weight-bold" style="font-size: 0.85rem; color: #3498db; background: rgba(52, 152, 219, 0.1); padding: 5px 10px; border-radius: 6px;">Sekolah Dasar</span>
                            <span class="text-muted" style="font-size: 0.85rem;"><i class="la la-map-marker text-danger"></i> Kecamatan A</span>
                        </div>
                        <h5 class="card-title font-weight-bold text-dark mb-3" style="font-size: 1.25rem;">SD Negeri 1 Contoh</h5>
                        <p class="card-text text-muted" style="font-size: 0.95rem; line-height: 1.6;">
                            <i class="la la-building mr-2 text-primary"></i> Jl. Pendidikan No. 123, Desa Maju, Kecamatan A
                        </p>
                        
                        <hr class="my-3">
                        
                        <div class="d-flex justify-content-between text-muted" style="font-size: 0.9rem;">
                            <div class="text-center">
                                <span class="d-block font-weight-bold text-dark h5 mb-0">150</span>
                                <span style="font-size: 0.8rem;">Kuota Total</span>
                            </div>
                            <div class="text-center">
                                <span class="d-block font-weight-bold text-warning h5 mb-0">120</span>
                                <span style="font-size: 0.8rem;">Pendaftar</span>
                            </div>
                            <div class="text-center">
                                <span class="d-block font-weight-bold text-success h5 mb-0">30</span>
                                <span style="font-size: 0.8rem;">Sisa Kuota</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top-0 pb-4 pt-0 px-4">
                        <a href="#" class="btn btn-outline-primary btn-block text-uppercase" style="border-radius: 8px; font-weight: 600; letter-spacing: 0.5px;">Lihat Detail</a>
                    </div>
                </div>
            </div>

            <!-- Dummy Data 2 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card school-card h-100 shadow-sm border-0 transition-hover" style="border-radius: 15px; overflow: hidden;">
                    <div class="position-relative">
                        <img src="https://images.unsplash.com/photo-1577896851231-70ef18881754?w=600&q=80" class="card-img-top" alt="Sekolah" style="height: 200px; object-fit: cover;">
                        <span class="badge position-absolute" style="top: 15px; right: 15px; padding: 8px 12px; border-radius: 6px; font-weight: 600; background-color: #2ecc71; color: white; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">Akreditasi A</span>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="font-weight-bold" style="font-size: 0.85rem; color: #e74c3c; background: rgba(231, 76, 60, 0.1); padding: 5px 10px; border-radius: 6px;">Sekolah Menengah Pertama</span>
                            <span class="text-muted" style="font-size: 0.85rem;"><i class="la la-map-marker text-danger"></i> Kecamatan B</span>
                        </div>
                        <h5 class="card-title font-weight-bold text-dark mb-3" style="font-size: 1.25rem;">SMP Negeri 2 Teladan</h5>
                        <p class="card-text text-muted" style="font-size: 0.95rem; line-height: 1.6;">
                            <i class="la la-building mr-2 text-primary"></i> Jl. Ki Hajar Dewantara No. 45, Kecamatan B
                        </p>
                        
                        <hr class="my-3">
                        
                        <div class="d-flex justify-content-between text-muted" style="font-size: 0.9rem;">
                            <div class="text-center">
                                <span class="d-block font-weight-bold text-dark h5 mb-0">250</span>
                                <span style="font-size: 0.8rem;">Kuota Total</span>
                            </div>
                            <div class="text-center">
                                <span class="d-block font-weight-bold text-warning h5 mb-0">210</span>
                                <span style="font-size: 0.8rem;">Pendaftar</span>
                            </div>
                            <div class="text-center">
                                <span class="d-block font-weight-bold text-success h5 mb-0">40</span>
                                <span style="font-size: 0.8rem;">Sisa Kuota</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top-0 pb-4 pt-0 px-4">
                        <a href="#" class="btn btn-outline-primary btn-block text-uppercase" style="border-radius: 8px; font-weight: 600; letter-spacing: 0.5px;">Lihat Detail</a>
                    </div>
                </div>
            </div>

            <!-- Dummy Data 3 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card school-card h-100 shadow-sm border-0 transition-hover" style="border-radius: 15px; overflow: hidden;">
                    <div class="position-relative">
                        <img src="https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=600&q=80" class="card-img-top" alt="Sekolah" style="height: 200px; object-fit: cover;">
                        <span class="badge position-absolute" style="top: 15px; right: 15px; padding: 8px 12px; border-radius: 6px; font-weight: 600; background-color: #3498db; color: white; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">Akreditasi B</span>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="font-weight-bold" style="font-size: 0.85rem; color: #3498db; background: rgba(52, 152, 219, 0.1); padding: 5px 10px; border-radius: 6px;">Sekolah Dasar</span>
                            <span class="text-muted" style="font-size: 0.85rem;"><i class="la la-map-marker text-danger"></i> Kecamatan C</span>
                        </div>
                        <h5 class="card-title font-weight-bold text-dark mb-3" style="font-size: 1.25rem;">SD Negeri 5 Harapan</h5>
                        <p class="card-text text-muted" style="font-size: 0.95rem; line-height: 1.6;">
                            <i class="la la-building mr-2 text-primary"></i> Jl. Merdeka No. 10, Kecamatan C
                        </p>
                        
                        <hr class="my-3">
                        
                        <div class="d-flex justify-content-between text-muted" style="font-size: 0.9rem;">
                            <div class="text-center">
                                <span class="d-block font-weight-bold text-dark h5 mb-0">100</span>
                                <span style="font-size: 0.8rem;">Kuota Total</span>
                            </div>
                            <div class="text-center">
                                <span class="d-block font-weight-bold text-warning h5 mb-0">85</span>
                                <span style="font-size: 0.8rem;">Pendaftar</span>
                            </div>
                            <div class="text-center">
                                <span class="d-block font-weight-bold text-success h5 mb-0">15</span>
                                <span style="font-size: 0.8rem;">Sisa Kuota</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top-0 pb-4 pt-0 px-4">
                        <a href="#" class="btn btn-outline-primary btn-block text-uppercase" style="border-radius: 8px; font-weight: 600; letter-spacing: 0.5px;">Lihat Detail</a>
                    </div>
                </div>
            </div>

            <!-- Dummy Data 4 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card school-card h-100 shadow-sm border-0 transition-hover" style="border-radius: 15px; overflow: hidden;">
                    <div class="position-relative">
                        <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?w=600&q=80" class="card-img-top" alt="Sekolah" style="height: 200px; object-fit: cover;">
                        <span class="badge position-absolute" style="top: 15px; right: 15px; padding: 8px 12px; border-radius: 6px; font-weight: 600; background-color: #2ecc71; color: white; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">Akreditasi A</span>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="font-weight-bold" style="font-size: 0.85rem; color: #e74c3c; background: rgba(231, 76, 60, 0.1); padding: 5px 10px; border-radius: 6px;">Sekolah Menengah Pertama</span>
                            <span class="text-muted" style="font-size: 0.85rem;"><i class="la la-map-marker text-danger"></i> Kecamatan A</span>
                        </div>
                        <h5 class="card-title font-weight-bold text-dark mb-3" style="font-size: 1.25rem;">SMP Negeri 3 Bangsa</h5>
                        <p class="card-text text-muted" style="font-size: 0.95rem; line-height: 1.6;">
                            <i class="la la-building mr-2 text-primary"></i> Jl. Sudirman No. 88, Kecamatan A
                        </p>
                        
                        <hr class="my-3">
                        
                        <div class="d-flex justify-content-between text-muted" style="font-size: 0.9rem;">
                            <div class="text-center">
                                <span class="d-block font-weight-bold text-dark h5 mb-0">300</span>
                                <span style="font-size: 0.8rem;">Kuota Total</span>
                            </div>
                            <div class="text-center">
                                <span class="d-block font-weight-bold text-warning h5 mb-0">290</span>
                                <span style="font-size: 0.8rem;">Pendaftar</span>
                            </div>
                            <div class="text-center">
                                <span class="d-block font-weight-bold text-success h5 mb-0">10</span>
                                <span style="font-size: 0.8rem;">Sisa Kuota</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top-0 pb-4 pt-0 px-4">
                        <a href="#" class="btn btn-outline-primary btn-block text-uppercase" style="border-radius: 8px; font-weight: 600; letter-spacing: 0.5px;">Lihat Detail</a>
                    </div>
                </div>
            </div>

            <!-- Dummy Data 5 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card school-card h-100 shadow-sm border-0 transition-hover" style="border-radius: 15px; overflow: hidden;">
                    <div class="position-relative">
                        <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=600&q=80" class="card-img-top" alt="Sekolah" style="height: 200px; object-fit: cover;">
                        <span class="badge position-absolute" style="top: 15px; right: 15px; padding: 8px 12px; border-radius: 6px; font-weight: 600; background-color: #2ecc71; color: white; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">Akreditasi A</span>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="font-weight-bold" style="font-size: 0.85rem; color: #3498db; background: rgba(52, 152, 219, 0.1); padding: 5px 10px; border-radius: 6px;">Sekolah Dasar</span>
                            <span class="text-muted" style="font-size: 0.85rem;"><i class="la la-map-marker text-danger"></i> Kecamatan B</span>
                        </div>
                        <h5 class="card-title font-weight-bold text-dark mb-3" style="font-size: 1.25rem;">SD Negeri 2 Pelita</h5>
                        <p class="card-text text-muted" style="font-size: 0.95rem; line-height: 1.6;">
                            <i class="la la-building mr-2 text-primary"></i> Jl. Kartini No. 21, Kecamatan B
                        </p>
                        
                        <hr class="my-3">
                        
                        <div class="d-flex justify-content-between text-muted" style="font-size: 0.9rem;">
                            <div class="text-center">
                                <span class="d-block font-weight-bold text-dark h5 mb-0">120</span>
                                <span style="font-size: 0.8rem;">Kuota Total</span>
                            </div>
                            <div class="text-center">
                                <span class="d-block font-weight-bold text-warning h5 mb-0">60</span>
                                <span style="font-size: 0.8rem;">Pendaftar</span>
                            </div>
                            <div class="text-center">
                                <span class="d-block font-weight-bold text-success h5 mb-0">60</span>
                                <span style="font-size: 0.8rem;">Sisa Kuota</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top-0 pb-4 pt-0 px-4">
                        <a href="#" class="btn btn-outline-primary btn-block text-uppercase" style="border-radius: 8px; font-weight: 600; letter-spacing: 0.5px;">Lihat Detail</a>
                    </div>
                </div>
            </div>

            <!-- Dummy Data 6 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card school-card h-100 shadow-sm border-0 transition-hover" style="border-radius: 15px; overflow: hidden;">
                    <div class="position-relative">
                        <img src="https://images.unsplash.com/photo-1510531704581-5b2870972060?w=600&q=80" class="card-img-top" alt="Sekolah" style="height: 200px; object-fit: cover;">
                        <span class="badge position-absolute" style="top: 15px; right: 15px; padding: 8px 12px; border-radius: 6px; font-weight: 600; background-color: #f39c12; color: white; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">Akreditasi Belum</span>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="font-weight-bold" style="font-size: 0.85rem; color: #e74c3c; background: rgba(231, 76, 60, 0.1); padding: 5px 10px; border-radius: 6px;">Sekolah Menengah Pertama</span>
                            <span class="text-muted" style="font-size: 0.85rem;"><i class="la la-map-marker text-danger"></i> Kecamatan C</span>
                        </div>
                        <h5 class="card-title font-weight-bold text-dark mb-3" style="font-size: 1.25rem;">SMP Negeri 1 Cemerlang</h5>
                        <p class="card-text text-muted" style="font-size: 0.95rem; line-height: 1.6;">
                            <i class="la la-building mr-2 text-primary"></i> Jl. Pahlawan No. 7, Kecamatan C
                        </p>
                        
                        <hr class="my-3">
                        
                        <div class="d-flex justify-content-between text-muted" style="font-size: 0.9rem;">
                            <div class="text-center">
                                <span class="d-block font-weight-bold text-dark h5 mb-0">200</span>
                                <span style="font-size: 0.8rem;">Kuota Total</span>
                            </div>
                            <div class="text-center">
                                <span class="d-block font-weight-bold text-warning h5 mb-0">45</span>
                                <span style="font-size: 0.8rem;">Pendaftar</span>
                            </div>
                            <div class="text-center">
                                <span class="d-block font-weight-bold text-success h5 mb-0">155</span>
                                <span style="font-size: 0.8rem;">Sisa Kuota</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top-0 pb-4 pt-0 px-4">
                        <a href="#" class="btn btn-outline-primary btn-block text-uppercase" style="border-radius: 8px; font-weight: 600; letter-spacing: 0.5px;">Lihat Detail</a>
                    </div>
                </div>
            </div>

        </div>

        <!-- Pagination -->
        <div class="row mt-5">
            <div class="col-lg-12">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true" style="border-radius: 8px 0 0 8px; font-weight: 500;">Sebelumnya</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#" style="background: linear-gradient(135deg, #1abc9c 0%, #3498db 100%); border: none;">1</a></li>
                        <li class="page-item"><a class="page-link text-primary" href="#">2</a></li>
                        <li class="page-item"><a class="page-link text-primary" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link text-primary" href="#" style="border-radius: 0 8px 8px 0; font-weight: 500;">Berikutnya</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>

<style>
    .transition-hover {
        transition: all 0.3s ease;
    }
    .transition-hover:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
    }
    .school-card .btn-outline-primary {
        border-color: #3498db;
        color: #3498db;
        transition: all 0.3s ease;
    }
    .school-card .btn-outline-primary:hover {
        background: linear-gradient(135deg, #1abc9c 0%, #3498db 100%);
        border-color: transparent;
        color: #fff;
        box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
    }
</style>
@endsection