@extends('frontend.main')

@section('content')
<style>
    .hover-shadow {
        transition: all 0.3s ease;
    }
    .hover-shadow:hover {
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
        transform: translateY(-3px);
    }
    .card-img-wrapper {
        height: 200px;
        overflow: hidden;
        position: relative;
    }
    .card-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .school-card:hover .card-img-wrapper img {
        transform: scale(1.05);
    }
    .distance-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(5px);
        font-weight: 600;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .rounded-xl {
        border-radius: 1rem !important;
    }
    .rounded-top-xl {
        border-top-left-radius: 1rem !important;
        border-top-right-radius: 1rem !important;
    }
    .badge-soft-success {
        background-color: rgba(40, 167, 69, 0.1);
        color: #28a745;
        border: 1px solid rgba(40, 167, 69, 0.2);
    }
    .badge-soft-primary {
        background-color: rgba(0, 123, 255, 0.1);
        color: #007bff;
        border: 1px solid rgba(0, 123, 255, 0.2);
    }
    .form-label {
        font-weight: 600;
        color: #6c757d;
        margin-bottom: 0.5rem;
        display: inline-block;
    }
    /* Soft Colors */
    .soft-header {
        background-color: #f0f7fb; /* Light pastel blue */
        border-bottom: 1px solid #e1eef4;
    }
    .soft-title {
        color: #2c5282; /* Muted dark blue */
    }
    .soft-icon {
        color: #63b3ed; /* Soft light blue */
    }
    .soft-check-icon {
        color: #68d391; /* Soft green */
    }
    .soft-badge {
        background-color: #ebf4ff;
        color: #3182ce;
        font-weight: 600;
    }
    .table-soft-header th {
        background-color: #f8fafc;
        color: #4a5568;
        font-weight: 600;
    }
</style>

<!-- Hero Area / Breadcrumb -->
<section class="breadcrumb_area breadcrumb2 bgimage" style="background-image: url('{{ asset('images/zona.jpg') }}'); background-size: cover; padding: 120px 0; background-position: center; position: relative; overflow: hidden;">
    <div class="overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(to right, rgba(30, 42, 74, 0.8), rgba(26, 188, 156, 0.4));"></div>
    <div class="container text-center position-relative" style="z-index: 2;">
        <h1 class="text-white font-weight-bold display-4 mb-2 animate__animated animate__fadeInDown">Informasi Zonasi Sekolah Menengah Pertama</h1>
        <p class="text-white-50 lead animate__animated animate__fadeInUp">Informasi zonasi sekolah jenjang SMP di Kota Lhokseumawe berdasarkan aturan zonasi PPDB</p>
    </div>
</section>

<div class="container pb-5">

    <!-- Data Sekolah per Kecamatan -->
    <div class="sekolah-list mt-5">
        @php
            // Mengelompokkan data sekolah berdasar nama kecamatan
            $sekolahGrouped = $sekolah->groupBy('nama_kecamatan');
        @endphp

        @if($sekolahGrouped->isEmpty())
            <div class="alert alert-info text-center shadow-sm rounded-xl py-4">
                <i class="fas fa-info-circle mr-2"></i> Belum ada data sekolah jenjang SMP yang tersedia.
            </div>
        @else
            @foreach($sekolahGrouped as $kecamatan => $sekolahs)
                <div class="card border-0 shadow-sm rounded-xl mb-4 hover-shadow">
                    <div class="card-header soft-header rounded-top-xl py-3 px-4 d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="mr-2 soft-icon" viewBox="0 0 16 16">
                            <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                        </svg>
                        <h5 class="mb-0 font-weight-bold soft-title">Kecamatan {{ $kecamatan }}</h5>
                        <span class="badge soft-badge badge-pill border ml-auto px-3 py-2" style="border-color: #bee3f8 !important;">{{ $sekolahs->count() }} Sekolah</span>
                    </div>
                    <div class="card-body p-0">
                        @php
                            $idKecamatan = $sekolahs->first()->id_kecamatan;
                            $desaList = isset($desa[$idKecamatan]) ? $desa[$idKecamatan] : [];
                        @endphp

                        <!-- Informasi Wilayah Domisili (Daftar Kolom) -->
                        <div class="p-4 border-bottom" style="background-color: #fcfdfe;">
                            <h6 class="font-weight-bold mb-4 soft-title">
                                <i class="fas fa-map-signs mr-2 soft-icon"></i>
                                Cakupan Wilayah Domisili <span class="badge soft-badge badge-pill ml-2 px-2 py-1">{{ count($desaList) }} Desa/Kelurahan</span>
                            </h6>
                            <div class="row">
                                @if(count($desaList) > 0)
                                    @foreach($desaList as $d)
                                        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                                            <div class="d-flex align-items-start">
                                                <i class="fas fa-check-circle soft-check-icon mt-1 mr-2" style="font-size: 0.9rem;"></i>
                                                <span class="text-secondary">{{ $d->nama_desa }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-12 text-muted font-italic">
                                        <i class="fas fa-info-circle mr-1"></i> Data desa untuk wilayah kecamatan ini belum tersedia.
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Daftar Sekolah -->
                        <div class="p-4">
                            <h6 class="font-weight-bold mb-3 soft-title"><i class="fas fa-school mr-2 soft-icon"></i>Daftar Sekolah Penyelenggara</h6>
                            <div class="table-responsive rounded border" style="border-color: #e2e8f0 !important;">
                                <table class="table table-hover mb-0">
                                    <thead class="table-soft-header">
                                        <tr>
                                            <th width="5%" class="text-center border-top-0 py-3">No</th>
                                            <th width="35%" class="border-top-0 py-3">Nama Sekolah</th>
                                            <th width="20%" class="border-top-0 py-3">NPSN</th>
                                            <th width="40%" class="border-top-0 py-3">Alamat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sekolahs as $index => $s)
                                            <tr>
                                                <td class="text-center align-middle py-3 text-secondary">{{ $index + 1 }}</td>
                                                <td class="align-middle py-3">
                                                    <span class="font-weight-bold text-dark">{{ $s->nama_sekolah }}</span>
                                                </td>
                                                <td class="align-middle py-3 text-secondary">{{ $s->npsn ? $s->npsn : '-' }}</td>
                                                <td class="align-middle py-3 text-secondary">{{ $s->alamat ? $s->alamat : 'Alamat belum tersedia' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

</div>
@endsection
