@extends('backend.main')

@section('statistik-menu-active')
    active
@endsection

@section('content')
    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
        <div class="col-md-6 col-lg-3">
            <div class="card card-flush h-md-100" style="background-color: #F1BC08; background-image:url('{{ asset('back/media/svg/shapes/top-right-curve.svg') }}')">
                <div class="card-header pt-5">
                    <div class="card-title d-flex flex-column">
                        <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{ number_format($stats['total']) }}</span>
                        <span class="text-white opacity-75 pt-1 fw-semibold fs-6">Total Pendaftar ({{ $stats['periode']->tahun_ajaran }})</span>
                    </div>
                </div>
                <div class="card-body d-flex align-items-end pt-0 pb-6">
                    <div class="d-flex align-items-center flex-wrap">
                        <span class="fs-7 text-white fw-bold">Seluruh Jenjang & Jalur</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card card-flush h-md-100" style="background-color: #7239EA">
                <div class="card-header pt-5">
                    <div class="card-title d-flex flex-column">
                        <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{ number_format($stats['by_jenjang']['SD']) }}</span>
                        <span class="text-white opacity-75 pt-1 fw-semibold fs-6">Pendaftar SD</span>
                    </div>
                </div>
                <div class="card-body d-flex align-items-end pt-0 pb-6">
                    <div class="d-flex align-items-center flex-wrap">
                        <span class="fs-7 text-white fw-bold">Sekolah Dasar</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card card-flush h-md-100" style="background-color: #50CD89">
                <div class="card-header pt-5">
                    <div class="card-title d-flex flex-column">
                        <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{ number_format($stats['by_jenjang']['SMP']) }}</span>
                        <span class="text-white opacity-75 pt-1 fw-semibold fs-6">Pendaftar SMP</span>
                    </div>
                </div>
                <div class="card-body d-flex align-items-end pt-0 pb-6">
                    <div class="d-flex align-items-center flex-wrap">
                        <span class="fs-7 text-white fw-bold">Sekolah Menengah Pertama</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card card-flush h-md-100" style="background-color: #F1416C">
                <div class="card-header pt-5">
                    <div class="card-title d-flex flex-column">
                        <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{ number_format($stats['by_status']['verifikasi'] ?? 0) }}</span>
                        <span class="text-white opacity-75 pt-1 fw-semibold fs-6">Menunggu Verifikasi</span>
                    </div>
                </div>
                <div class="card-body d-flex align-items-end pt-0 pb-6">
                    <div class="d-flex align-items-center flex-wrap">
                        <span class="fs-7 text-white fw-bold">Perlu Segera Diproses</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-5 g-xl-10">
        <div class="col-12">
            <div class="card card-flush h-xl-100">
                <div class="card-header pt-7">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800">Statistik Pendaftaran Per Sekolah</span>
                        <span class="text-gray-400 mt-1 fw-semibold fs-6">Data kuota dan jumlah pendaftar per jalur ({{ $stats['periode']->tahun_ajaran }})</span>
                    </h3>
                    @if(auth()->user()->role == 'admin_dinas')
                    <div class="card-toolbar">
                        <form action="{{ route('statistik.index') }}" method="GET" class="d-flex align-items-center">
                            <select name="jenjang" class="form-select form-select-solid form-select-sm w-150px me-3" data-control="select2" data-hide-search="true" onchange="this.form.submit()">
                                <option value="">Semua Jenjang</option>
                                <option value="SD" {{ $stats['filter_jenjang'] == 'SD' ? 'selected' : '' }}>Jenjang SD</option>
                                <option value="SMP" {{ $stats['filter_jenjang'] == 'SMP' ? 'selected' : '' }}>Jenjang SMP</option>
                            </select>
                            @if($stats['filter_jenjang'])
                                <a href="{{ route('statistik.index') }}" class="btn btn-sm btn-light-danger fw-bold">Reset</a>
                            @endif
                        </form>
                    </div>
                    @endif
                </div>
                <div class="card-body pt-2">
                    <div class="table-responsive">
                        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                            <thead>
                                <tr class="fw-bold text-muted bg-light">
                                    <th class="ps-4 min-w-250px rounded-start">Nama Sekolah</th>
                                    @foreach($stats['jalurs'] as $jalur)
                                        <th class="text-center min-w-100px">{{ str_replace('Jalur ', '', $jalur->nama_jalur) }}</th>
                                    @endforeach
                                    <th class="text-center min-w-100px rounded-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stats['sekolahs'] as $sekolah)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-35px me-3">
                                                    <span class="symbol-label bg-light-{{ $sekolah->jenjang == 'SD' ? 'primary' : 'success' }} text-{{ $sekolah->jenjang == 'SD' ? 'primary' : 'success' }} fw-bold fs-8">
                                                        {{ $sekolah->jenjang }}
                                                    </span>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <span class="text-gray-800 fw-bold fs-6">{{ $sekolah->nama_sekolah }}</span>
                                                    <span class="text-muted fw-semibold fs-7">{{ $sekolah->npsn }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        @php $totalPendaftar = 0; $totalKuota = 0; @endphp
                                        @foreach($stats['jalurs'] as $jalur)
                                            @php 
                                                $d = $sekolah->stats_jalur[$jalur->id];
                                                $totalPendaftar += $d['count'];
                                                $totalKuota += $d['quota'];
                                                $isFull = $d['quota'] > 0 && $d['count'] >= $d['quota'];
                                                $percent = $d['quota'] > 0 ? min(($d['count'] / $d['quota']) * 100, 100) : 0;
                                            @endphp
                                            <td class="text-center">
                                                <div class="d-flex flex-column w-100">
                                                    <div class="d-flex flex-stack mb-1">
                                                        <span class="text-gray-800 fw-bold fs-7">{{ $d['count'] }} <span class="text-muted">/ {{ $d['quota'] }}</span></span>
                                                        <span class="text-muted fs-8 fw-bold">{{ round($percent) }}%</span>
                                                    </div>
                                                    <div class="progress h-4px w-100 bg-light-{{ $isFull ? 'danger' : 'primary' }}">
                                                        <div class="progress-bar bg-{{ $isFull ? 'danger' : 'primary' }}" role="progressbar" style="width: {{ $percent }}%"></div>
                                                    </div>
                                                </div>
                                            </td>
                                        @endforeach
                                        <td class="text-center">
                                            <div class="d-flex flex-column align-items-center">
                                                <span class="badge badge-light-{{ $totalPendaftar > $totalKuota ? 'danger' : 'info' }} fs-7 fw-bold px-4 py-3">
                                                    {{ $totalPendaftar }} / {{ $totalKuota }}
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
