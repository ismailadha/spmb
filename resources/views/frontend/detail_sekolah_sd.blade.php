@extends('frontend.main')

@section('content')
<!-- Detail Hero Header -->
<section class="breadcrumb_area breadcrumb2 bgimage" style="background-image: url('https://images.unsplash.com/photo-1510531704581-5b2870972060?auto=format&fit=crop&w=1920&q=80'); background-size: cover; padding: 100px 0; position: relative;">
    <div class="overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(to right, rgba(30, 42, 74, 0.9), rgba(231, 76, 60, 0.6));"></div>
    <div class="container position-relative" style="z-index: 2;">
        <div class="row align-items-center">
            <div class="col-lg-8 text-center text-lg-left">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent p-0 mb-3 justify-content-center justify-content-lg-start">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('sekolah-sd') }}" class="text-white-50">Sekolah Dasar</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Detail Sekolah</li>
                    </ol>
                </nav>
                <h1 class="text-white font-weight-bold display-4 mb-3 animate__animated animate__fadeInLeft">{{ $sekolah->nama_sekolah }}</h1>
                <div class="d-flex flex-wrap justify-content-center justify-content-lg-start align-items-center">
                    <span class="badge badge-danger px-3 py-2 mr-3 mb-2 shadow-sm" style="border-radius: 8px; font-size: 0.9rem;">
                        <i class="la la-graduation-cap mr-1"></i> {{ $sekolah->jenjang }}
                    </span>
                    <span class="text-white-50 mb-2">
                        <i class="la la-map-marker mr-1"></i> {{ $sekolah->kecamatan->nama_kecamatan ?? '-' }}, Indonesia
                    </span>
                </div>
            </div>
            @if(Auth::guest())
            <div class="col-lg-4 text-center text-lg-right mt-4 mt-lg-0 animate__animated animate__fadeInRight">
                <a href="{{ route('register-peserta') }}" class="btn btn-light btn-lg px-4 py-3 rounded-pill font-weight-bold shadow" style="color: #e74c3c; border: none;">
                    Daftar Sekarang <i class="la la-arrow-right ml-2"></i>
                </a>
            </div>
            @endif
        </div>
    </div>
</section>

<!-- Detail Content Area -->
<section class="detail-content-area py-5" style="background-color: #f8fafc;">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8 mb-4">
                <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px;">
                    <div class="card-body p-4 p-md-5">
                        <div class="section-title mb-4">
                            <h4 class="font-weight-bold" style="color: #1e2a4a;">
                                <span class="d-inline-block p-2 rounded-lg bg-danger-soft mr-2"><i class="la la-chart-bar text-danger"></i></span>
                                Daya Tampung Sekolah
                            </h4>
                            <p class="text-muted small">Rincian kuota pendaftaran berdasarkan jalur masuk.</p>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="quota-item p-4 border rounded-xl bg-white transition-hover h-100">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="icon-circle mr-3" style="background: rgba(52, 152, 219, 0.1); color: #3498db;">
                                            <i class="la la-trophy" style="font-size: 1.5rem;"></i>
                                        </div>
                                        <h6 class="mb-0 font-weight-bold text-dark">Jalur Prestasi</h6>
                                    </div>
                                    <div class="display-4 font-weight-bold mb-1" style="font-size: 2rem;">{{ $sekolah->daya_tampung_prestasi ?? 0 }}</div>
                                    <p class="text-muted small mb-0">Peserta Didik</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="quota-item p-4 border rounded-xl bg-white transition-hover h-100">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="icon-circle mr-3" style="background: rgba(46, 204, 113, 0.1); color: #2ecc71;">
                                            <i class="la la-home" style="font-size: 1.5rem;"></i>
                                        </div>
                                        <h6 class="mb-0 font-weight-bold text-dark">Jalur Domisili</h6>
                                    </div>
                                    <div class="display-4 font-weight-bold mb-1" style="font-size: 2rem;">{{ $sekolah->daya_tampung_domisili ?? 0 }}</div>
                                    <p class="text-muted small mb-0">Peserta Didik</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="quota-item p-4 border rounded-xl bg-white transition-hover h-100">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="icon-circle mr-3" style="background: rgba(243, 156, 18, 0.1); color: #f39c12;">
                                            <i class="la la-users" style="font-size: 1.5rem;"></i>
                                        </div>
                                        <h6 class="mb-0 font-weight-bold text-dark">Jalur Afirmasi</h6>
                                    </div>
                                    <div class="display-4 font-weight-bold mb-1" style="font-size: 2rem;">{{ $sekolah->daya_tampung_afirmasi ?? 0 }}</div>
                                    <p class="text-muted small mb-0">Peserta Didik</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="quota-item p-4 border rounded-xl bg-white transition-hover h-100">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="icon-circle mr-3" style="background: rgba(155, 89, 182, 0.1); color: #9b59b6;">
                                            <i class="la la-exchange-alt" style="font-size: 1.5rem;"></i>
                                        </div>
                                        <h6 class="mb-0 font-weight-bold text-dark">Jalur Mutasi</h6>
                                    </div>
                                    <div class="display-4 font-weight-bold mb-1" style="font-size: 2rem;">{{ $sekolah->daya_tampung_mutasi ?? 0 }}</div>
                                    <p class="text-muted small mb-0">Peserta Didik</p>
                                </div>
                            </div>
                        </div>

                        <div class="total-quota bg-danger-soft p-4 rounded-xl mt-2 text-center">
                            <h5 class="mb-1 font-weight-bold text-danger">Total Daya Tampung</h5>
                            <div class="h2 font-weight-bold mb-0">{{ $sekolah->total_daya_tampung }} Kuota</div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                    <div class="card-body p-4 p-md-5">
                        <div class="section-title mb-4">
                            <h4 class="font-weight-bold" style="color: #1e2a4a;">
                                <span class="d-inline-block p-2 rounded-lg bg-danger-soft mr-2"><i class="la la-info-circle text-danger"></i></span>
                                Informasi Tambahan
                            </h4>
                        </div>
                        <div class="info-list">
                            <div class="row no-gutters mb-4 pb-3 border-bottom">
                                <div class="col-sm-4 text-muted font-weight-bold mb-1 mb-sm-0">Status Perbatasan</div>
                                <div class="col-sm-8 text-dark font-weight-bold">{{ $sekolah->status_perbatasan == 1 ? 'Menerima Perbatasan' : 'Tidak Menerima Perbatasan' }}</div>
                            </div>
                            <div class="row no-gutters mb-4 pb-3 border-bottom">
                                <div class="col-sm-4 text-muted font-weight-bold mb-1 mb-sm-0">Status Pilihan 1</div>
                                <div class="col-sm-8 text-dark font-weight-bold">{{ $sekolah->status_pilihan_1 == 1 ? 'Wajib Pilihan 1' : 'Opsional' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px; overflow: hidden;">
                    <div class="image-wrapper" style="height: 200px; overflow: hidden;">
                        @if($sekolah->thumbnail)
                            <img src="{{ asset($sekolah->thumbnail) }}" class="w-100 h-100 object-fit-cover" alt="{{ $sekolah->nama_sekolah }}">
                        @else
                            <img src="https://images.unsplash.com/photo-1510531704581-5b2870972060?auto=format&fit=crop&w=600&q=80" class="w-100 h-100 object-fit-cover" alt="Default School">
                        @endif
                    </div>
                    <div class="card-body p-4">
                        <h5 class="font-weight-bold mb-4" style="color: #1e2a4a;">Identitas Sekolah</h5>
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-square mr-3 bg-light text-primary"><i class="la la-fingerprint"></i></div>
                            <div>
                                <div class="small text-muted">NPSN</div>
                                <div class="font-weight-bold">{{ $sekolah->npsn }}</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-square mr-3 bg-light text-success"><i class="la la-map-marker"></i></div>
                            <div>
                                <div class="small text-muted">Alamat</div>
                                <div class="font-weight-bold small">{{ $sekolah->alamat }}</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-4">
                            <div class="icon-square mr-3 bg-light text-warning"><i class="la la-phone"></i></div>
                            <div>
                                <div class="small text-muted">Kontak Telepon</div>
                                <div class="font-weight-bold">{{ $sekolah->telepon ?? 'Tidak Tersedia' }}</div>
                            </div>
                        </div>
                        <hr>
                        <div class="contact-buttons">
                            @if($sekolah->website)
                                <a href="{{ Str::startsWith($sekolah->website, 'http') ? $sekolah->website : 'https://' . $sekolah->website }}" target="_blank" class="btn btn-outline-danger btn-block rounded-pill mb-2 font-weight-bold">
                                    <i class="la la-globe mr-2"></i> Kunjungi Website
                                </a>
                            @endif
                            @if($sekolah->email)
                                <a href="mailto:{{ $sekolah->email }}" class="btn btn-outline-secondary btn-block rounded-pill font-weight-bold">
                                    <i class="la la-envelope mr-2"></i> Kirim Email
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Google Maps Link -->
                @if($sekolah->latitude && $sekolah->longitude)
                <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                    <div class="card-body p-4">
                        <h5 class="font-weight-bold mb-3" style="color: #1e2a4a;">Navigasi Lokasi</h5>
                        <p class="text-muted small mb-4">Klik tombol di bawah untuk petunjuk arah melalui Google Maps.</p>
                        <a href="https://www.google.com/maps/dir/?api=1&destination={{ $sekolah->latitude }},{{ $sekolah->longitude }}" target="_blank" class="btn btn-danger btn-block py-3 rounded-xl font-weight-bold">
                            <i class="la la-directions mr-2"></i> Lihat di Google Maps
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<style>
    .rounded-xl { border-radius: 15px !important; }
    .bg-danger-soft { background-color: rgba(231, 76, 60, 0.08); }
    .icon-circle { width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; }
    .icon-square { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; }
    .transition-hover { transition: all 0.3s ease; }
    .transition-hover:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.05) !important; border-color: #e74c3c !important; }
    .object-fit-cover { object-fit: cover; }
    .breadcrumb-item + .breadcrumb-item::before { color: rgba(255,255,255,0.5); }
</style>
@endsection
