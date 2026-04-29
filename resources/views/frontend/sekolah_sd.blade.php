@extends('frontend.main')

@section('content')
<!-- Hero Area / Breadcrumb -->
<section class="breadcrumb_area breadcrumb2 bgimage" style="background-image: url('{{ asset('images/sekolah.jpg') }}'); background-size: cover; padding: 120px 0; background-position: center; position: relative; overflow: hidden;">
    <div class="overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(to right, rgba(30, 42, 74, 0.8), rgba(231, 76, 60, 0.4));"></div>
    <div class="container text-center position-relative" style="z-index: 2;">
        <h1 class="text-white font-weight-bold display-4 mb-2 animate__animated animate__fadeInDown">Informasi Sekolah Dasar</h1>
        <p class="text-white-50 lead animate__animated animate__fadeInUp">Temukan data sekolah dasar (SD) terdekat di wilayah Anda</p>
    </div>
</section>

<!-- Main Content Area -->
<section class="filter-area section-padding py-5" style="background-color: #fcfdfe;">
    <div class="container">
        <!-- Modern Filter Card -->
        <div class="row mb-5">
            <div class="col-lg-12">
                <div class="card shadow-lg border-0 bg-white translate-y-minus80" style="border-radius: 20px; z-index: 10;">
                    <div class="card-body p-4 p-md-5">
                        <div class="row align-items-center mb-4">
                            <div class="col-md-6">
                                <h5 class="mb-0 font-weight-bold" style="color: #1e2a4a; font-size: 1.25rem;">
                                    <span class="d-inline-block px-3 py-2 rounded-lg bg-danger-soft mr-2">
                                        <i class="la la-filter text-danger"></i>
                                    </span>
                                    Filter Pencarian
                                </h5>
                            </div>
                            <div class="col-md-6 text-md-right mt-2 mt-md-0">
                                <span class="badge badge-light p-2 px-3 text-muted" style="border-radius: 10px; font-weight: 500;">
                                    <i class="la la-info-circle mr-1"></i> {{ $sekolah->total() }} Sekolah Ditemukan
                                </span>
                            </div>
                        </div>

                        <form action="{{ route('sekolah-sd') }}" method="GET" class="filter-form">
                            <div class="row">
                                <div class="col-lg-5 col-md-4 mb-3 mb-lg-0">
                                    <div class="form-group mb-0 position-relative">
                                        <label class="small font-weight-bold text-uppercase text-muted tracking-wider mb-2" style="font-size: 0.75rem;">Nama Sekolah</label>
                                        <div class="search-input-wrapper">
                                            <i class="la la-search input-icon text-danger"></i>
                                            <input type="text" class="form-control custom-input" placeholder="Cari nama sekolah..." name="search" value="{{ request('search') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 mb-3 mb-lg-0">
                                    <div class="form-group mb-0">
                                        <label class="small font-weight-bold text-uppercase text-muted tracking-wider mb-2" style="font-size: 0.75rem;">Kecamatan</label>
                                        <select class="form-control custom-select-premium" name="kecamatan">
                                            <option value="">Semua Kecamatan</option>
                                            @foreach($kecamatan as $kec)
                                                <option value="{{ $kec->id }}" {{ request('kecamatan') == $kec->id ? 'selected' : '' }}>
                                                    {{ $kec->nama_kecamatan }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 d-flex align-items-end">
                                    <button type="submit" class="btn btn-premium-danger w-100 shadow-sm py-3" style="border-radius: 12px; font-weight: 700;">
                                        <i class="la la-sync-alt mr-2"></i> Tampilkan Hasil
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- School Grid -->
        <div class="row card-grid animate__animated animate__fadeIn">
            @forelse($sekolah as $s)
            <div class="col-lg-4 col-md-6 mb-5">
                <div class="card school-card h-100 border-0 shadow-sm" style="border-radius: 20px; overflow: hidden; background: #fff; transition: all 0.4s ease;">
                    <div class="image-container overflow-hidden position-relative" style="height: 230px;">
                        @if($s->thumbnail)
                            <img src="{{ asset($s->thumbnail) }}" class="card-img-top w-100 h-100 object-fit-cover transition-scale" alt="{{ $s->nama_sekolah }}">
                        @else
                            <img src="https://images.unsplash.com/photo-1510531704581-5b2870972060?auto=format&fit=crop&w=1920&q=80" class="card-img-top w-100 h-100 object-fit-cover transition-scale" alt="Default School">
                        @endif
                        <div class="card-overlay p-3 d-flex flex-column justify-content-between position-absolute w-100 h-100" style="top:0; left:0; background: linear-gradient(to top, rgba(0,0,0,0.6) 0%, transparent 60%);">
                            <div class="d-flex justify-content-end">
                                <span class="npsn-badge shadow-sm">NPSN: {{ $s->npsn }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <span class="jenjang-badge">
                                <i class="la la-graduation-cap mr-1"></i> {{ $s->jenjang }}
                            </span>
                            <span class="location-label text-muted small">
                                <i class="la la-map-pin text-danger mt-1"></i> {{ $s->kecamatan->nama_kecamatan ?? '-' }}
                            </span>
                        </div>

                        <h5 class="card-title font-weight-bold text-dark mb-3 card-title-hover" style="font-size: 1.25rem; line-height: 1.4; min-height: 3.5rem;">
                            {{ $s->nama_sekolah }}
                        </h5>

                        <p class="text-muted mb-4 school-address" style="font-size: 0.95rem; min-height: 2.8rem; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                            <i class="la la-map-marker-alt text-danger mr-1"></i> {{ $s->alamat }}
                        </p>

                        <div class="quota-info p-3 bg-light rounded-lg">
                            <div class="row no-gutters text-center">
                                <div class="col-4 border-right">
                                    <div class="small text-muted mb-1 font-weight-bold text-uppercase" style="font-size: 0.65rem;">Kuota</div>
                                    <div class="h6 font-weight-bold text-dark mb-0 font-italic">{{ $s->total_daya_tampung }}</div>
                                </div>
                                <div class="col-4 border-right">
                                    <div class="small text-muted mb-1 font-weight-bold text-uppercase" style="font-size: 0.65rem;">Daftar</div>
                                    <div class="h6 font-weight-bold text-warning mb-0 font-italic">{{ $s->pendaftar_count }}</div>
                                </div>
                                <div class="col-4">
                                    <div class="small text-muted mb-1 font-weight-bold text-uppercase" style="font-size: 0.65rem;">Sisa</div>
                                    <div class="h6 font-weight-bold text-success mb-0 font-italic">{{ max(0, $s->total_daya_tampung - $s->lulus_count) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-white border-top-0 px-4 pb-4">
                        <a href="{{ route('sekolah-sd.detail', $s->id) }}" class="btn btn-outline-premium-danger btn-block rounded-pill font-weight-bold text-uppercase py-2 small tracking-wider">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <div class="empty-state animate__animated animate__bounceIn">
                    <div class="mb-4">
                        <i class="la la-search text-muted" style="font-size: 5rem; opacity: 0.3;"></i>
                    </div>
                    <h3 class="mt-4 font-weight-bold text-dark">Data Tidak Ditemukan</h3>
                    <p class="text-muted lead">Maaf, kami tidak menemukan sekolah yang sesuai dengan pencarian Anda.</p>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Custom Styled Pagination -->
        @if($sekolah->hasPages())
        <div class="row mt-5">
            <div class="col-12 d-flex justify-content-center">
                <div class="pagination-wrapper">
                    {{ $sekolah->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>
</section>

<style>
    :root {
        --danger-gradient: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
        --danger-soft: rgba(231, 76, 60, 0.1);
        --dark-navy: #1e2a4a;
    }

    .translate-y-minus80 {
        transform: translateY(-80px);
    }

    .bg-danger-soft {
        background-color: var(--danger-soft);
    }

    .tracking-wider {
        letter-spacing: 0.1em;
    }

    .object-fit-cover {
        object-fit: cover;
    }

    /* Input Styling */
    .custom-input, .custom-select-premium {
        height: 55px;
        border: 1px solid #e1e8ef;
        border-radius: 12px;
        padding-left: 20px;
        background-color: #f8fafc;
        transition: all 0.3s ease;
        font-weight: 500;
        box-shadow: none !important;
    }

    .search-input-wrapper {
        position: relative;
    }

    .search-input-wrapper .input-icon {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        z-index: 5;
        font-size: 1.2rem;
    }

    .search-input-wrapper .custom-input {
        padding-left: 50px;
    }

    .custom-input:focus, .custom-select-premium:focus {
        border-color: #e74c3c;
        background-color: #fff;
        box-shadow: 0 0 0 4px rgba(231, 76, 60, 0.1) !important;
    }

    /* Buttons */
    .btn-premium-danger {
        background: var(--danger-gradient);
        color: #fff;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-premium-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(231, 76, 60, 0.4);
        color: #fff;
    }

    .btn-outline-premium-danger {
        border: 2px solid #e74c3c;
        color: #e74c3c;
        transition: all 0.3s ease;
    }

    .btn-outline-premium-danger:hover {
        background: var(--danger-gradient);
        color: #fff;
        border-color: transparent;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(231, 76, 60, 0.3);
    }

    /* Card Enhancements */
    .school-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 30px 60px rgba(30, 42, 74, 0.12) !important;
    }

    .transition-scale {
        transition: transform 0.6s ease;
    }

    .school-card:hover .transition-scale {
        transform: scale(1.1);
    }

    .npsn-badge {
        background: rgba(255, 255, 255, 0.95);
        color: var(--dark-navy);
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 800;
        backdrop-filter: blur(4px);
    }

    .jenjang-badge {
        background-color: var(--danger-soft);
        color: #e74c3c;
        padding: 5px 15px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Pagination Styling */
    .pagination-wrapper nav svg {
        width: 20px;
    }

    .pagination-wrapper nav .flex.items-center.justify-between {
        display: none;
    }

    .page-item .page-link {
        border: none;
        margin: 0 5px;
        border-radius: 12px !important;
        background-color: #f1f5f9;
        color: var(--dark-navy);
        font-weight: 600;
        padding: 12px 20px;
        transition: all 0.3s ease;
    }

    .page-item.active .page-link {
        background: var(--danger-gradient);
        color: #fff;
        box-shadow: 0 8px 15px rgba(231, 76, 60, 0.3);
    }

    .page-link:hover:not(.active) {
        background-color: #e2e8f0;
        transform: translateY(-3px);
    }
</style>
@endsection
