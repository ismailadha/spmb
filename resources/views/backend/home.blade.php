@extends('backend.main')

@section('home-menu-active')
    active
@endsection

@section('content')
    <!--begin::Row - Hero Stats-->
    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
        <!--begin::Col - Total Seluruh-->
        <div class="col-lg-4">
            <div class="card card-flush h-md-100" style="background-color: #F8F5FF; border: 1px solid #E1D9FE;">
                <div class="card-header pt-5">
                    <div class="card-title d-flex flex-column">
                        <div class="d-flex align-items-center mb-2">
                             <i class="bi bi-people-fill fs-2hx text-primary me-3"></i>
                             <span class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2">{{ number_format($stats['total']) }}</span>
                        </div>
                        <span class="text-gray-600 pt-1 fw-bold fs-7 text-uppercase">Total Seluruh Peserta</span>
                    </div>
                </div>
                <div class="card-body d-flex align-items-end pt-0 pb-6">
                    <span class="text-muted fs-8">Seluruh Jalur Pendaftaran</span>
                </div>
            </div>
        </div>
        <!--end::Col-->

        <!--begin::Col - Total SD-->
        <div class="col-lg-4">
            <div class="card card-flush h-md-100" style="background-color: #E8FFF3; border: 1px solid #50CD89;">
                <div class="card-header pt-5">
                    <div class="card-title d-flex flex-column">
                        <div class="d-flex align-items-center mb-2">
                             <i class="bi bi-mortarboard-fill fs-2hx text-success me-3"></i>
                             <span class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2">{{ number_format($stats['jenjang']['sd']) }}</span>
                        </div>
                        <span class="text-success pt-1 fw-bold fs-7 text-uppercase">Total Jenjang SD</span>
                    </div>
                </div>
                <div class="card-body d-flex align-items-end pt-0 pb-6">
                    <span class="text-muted fs-8">Calon Peserta Didik Baru SD</span>
                </div>
            </div>
        </div>
        <!--end::Col-->

        <!--begin::Col - Total SMP-->
        <div class="col-lg-4">
            <div class="card card-flush h-md-100" style="background-color: #F1FAFF; border: 1px solid #009EF7;">
                <div class="card-header pt-5">
                    <div class="card-title d-flex flex-column">
                        <div class="d-flex align-items-center mb-2">
                             <i class="bi bi-mortarboard fs-2hx text-info me-3"></i>
                             <span class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2">{{ number_format($stats['jenjang']['smp']) }}</span>
                        </div>
                        <span class="text-info pt-1 fw-bold fs-7 text-uppercase">Total Jenjang SMP</span>
                    </div>
                </div>
                <div class="card-body d-flex align-items-end pt-0 pb-6">
                    <span class="text-muted fs-8">Calon Peserta Didik Baru SMP</span>
                </div>
            </div>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->

    <!--begin::Row - Verification Stats-->
    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
        <!--begin::Col-->
        <div class="col-md-6 col-lg-3">
            <div class="card card-flush h-md-100" style="background-color: #fff8dd; border: 1px dashed #ffc700;">
                <div class="card-header pt-5">
                    <div class="card-title d-flex flex-column">
                        <span class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2">{{ $stats['verification']['submit'] }}</span>
                        <span class="text-gray-600 pt-1 fw-bold fs-7 text-uppercase">Perlu Verifikasi</span>
                    </div>
                </div>
                <div class="card-body pt-0 pb-6 d-flex align-items-center">
                    <span class="badge badge-warning fs-8 fw-bold">Status: Submit</span>
                </div>
            </div>
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-6 col-lg-3">
            <div class="card card-flush h-md-100" style="background-color: #f3f1ff; border: 1px dashed #7239ea;">
                <div class="card-header pt-5">
                    <div class="card-title d-flex flex-column">
                        <span class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2">{{ $stats['verification']['verifikasi'] }}</span>
                        <span class="text-gray-600 pt-1 fw-bold fs-7 text-uppercase">Terverifikasi</span>
                    </div>
                </div>
                <div class="card-body pt-0 pb-6 d-flex align-items-center">
                    <span class="badge badge-primary fs-8 fw-bold" style="background-color: #7239ea;">Status: Verified</span>
                </div>
            </div>
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-6 col-lg-3">
            <div class="card card-flush h-md-100" style="background-color: #fff4e1; border: 1px dashed #ff8c00;">
                <div class="card-header pt-5">
                    <div class="card-title d-flex flex-column">
                        <span class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2">{{ $stats['verification']['perbaikan'] }}</span>
                        <span class="text-gray-600 pt-1 fw-bold fs-7 text-uppercase">Minta Perbaikan</span>
                    </div>
                </div>
                <div class="card-body pt-0 pb-6 d-flex align-items-center">
                    <span class="badge badge-warning fs-8 fw-bold" style="background-color: #ff8c00;">Status: Pending</span>
                </div>
            </div>
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-6 col-lg-3">
            <div class="card card-flush h-md-100" style="background-color: #e8fff3; border: 1px dashed #50cd89;">
                <div class="card-header pt-5">
                    <div class="card-title d-flex flex-column">
                        <span class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2">{{ $stats['verification']['hasil'] }}</span>
                        <span class="text-gray-600 pt-1 fw-bold fs-7 text-uppercase">Selesai Seleksi</span>
                    </div>
                </div>
                <div class="card-body pt-0 pb-6 d-flex align-items-center">
                    <span class="badge badge-success fs-8 fw-bold">Status: Final</span>
                </div>
            </div>
        </div>
        <!--end::Col-->
    </div>

    <!--begin::Row - Path Breakdown-->
    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
        <!--begin::Col - Domisili-->
        <div class="col-md-6 col-lg-3">
            <div class="card card-flush h-md-100 bg-light-primary border-primary border-opacity-25 border-dashed position-relative overflow-hidden">
                <i class="bi bi-geo-alt-fill text-primary position-absolute opacity-10 end-0 bottom-0 me-n5 mb-n5" style="font-size: 8rem;"></i>
                <div class="card-header pt-5">
                    <div class="card-title d-flex flex-column">
                        <div class="d-flex align-items-center mb-1">
                            <i class="bi bi-geo-alt-fill fs-2hx text-primary me-2"></i>
                            <span class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2">{{ $stats['domisili']['total'] }}</span>
                        </div>
                        <span class="text-primary fw-bold fs-7 text-uppercase">Jalur Domisili</span>
                    </div>
                </div>
                <div class="card-body pt-2 pb-4">
                    <div class="d-flex flex-column w-100 position-relative z-index-1">
                        <div class="d-flex flex-stack fs-6 fw-semibold mb-2">
                            <div class="text-gray-600">Jenjang SD</div>
                            <div class="fw-bolder text-gray-800">{{ $stats['domisili']['sd'] }}</div>
                        </div>
                        <div class="h-6px w-100 bg-primary bg-opacity-50 rounded mb-5">
                            <div class="bg-primary rounded h-6px" role="progressbar" style="width: {{ $stats['domisili']['total'] > 0 ? ($stats['domisili']['sd'] / $stats['domisili']['total']) * 100 : 0 }}%"></div>
                        </div>
                        <div class="d-flex flex-stack fs-6 fw-semibold mb-2">
                            <div class="text-gray-600">Jenjang SMP</div>
                            <div class="fw-bolder text-gray-800">{{ $stats['domisili']['smp'] }}</div>
                        </div>
                        <div class="h-6px w-100 bg-dark bg-opacity-50 rounded">
                            <div class="bg-info rounded h-6px" role="progressbar" style="width: {{ $stats['domisili']['total'] > 0 ? ($stats['domisili']['smp'] / $stats['domisili']['total']) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Col-->

        <!--begin::Col - Afirmasi-->
        <div class="col-md-6 col-lg-3">
            <div class="card card-flush h-md-100 bg-light-success border-success border-opacity-25 border-dashed position-relative overflow-hidden">
                <i class="bi bi-heart-fill text-success position-absolute opacity-10 end-0 bottom-0 me-n5 mb-n5" style="font-size: 8rem;"></i>
                <div class="card-header pt-5">
                    <div class="card-title d-flex flex-column">
                        <div class="d-flex align-items-center mb-1">
                            <i class="bi bi-heart-fill fs-2hx text-success me-2"></i>
                            <span class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2">{{ $stats['afirmasi']['total'] }}</span>
                        </div>
                        <span class="text-success fw-bold fs-7 text-uppercase">Jalur Afirmasi</span>
                    </div>
                </div>
                <div class="card-body pt-2 pb-4">
                    <div class="d-flex flex-column w-100 position-relative z-index-1">
                        <div class="d-flex flex-stack fs-6 fw-semibold mb-2">
                            <div class="text-gray-600">Jenjang SD</div>
                            <div class="fw-bolder text-gray-800">{{ $stats['afirmasi']['sd'] }}</div>
                        </div>
                        <div class="h-6px w-100 bg-success bg-opacity-50 rounded mb-5">
                            <div class="bg-success rounded h-6px" role="progressbar" style="width: {{ $stats['afirmasi']['total'] > 0 ? ($stats['afirmasi']['sd'] / $stats['afirmasi']['total']) * 100 : 0 }}%"></div>
                        </div>
                        <div class="d-flex flex-stack fs-6 fw-semibold mb-2">
                            <div class="text-gray-600">Jenjang SMP</div>
                            <div class="fw-bolder text-gray-800">{{ $stats['afirmasi']['smp'] }}</div>
                        </div>
                        <div class="h-6px w-100 bg-dark bg-opacity-50 rounded">
                            <div class="bg-teal rounded h-6px" role="progressbar" style="width: {{ $stats['afirmasi']['total'] > 0 ? ($stats['afirmasi']['smp'] / $stats['afirmasi']['total']) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Col-->

        <!--begin::Col - Mutasi-->
        <div class="col-md-6 col-lg-3">
            <div class="card card-flush h-md-100 bg-light-warning border-warning border-opacity-25 border-dashed position-relative overflow-hidden">
                <i class="bi bi-arrow-left-right text-warning position-absolute opacity-10 end-0 bottom-0 me-n5 mb-n5" style="font-size: 8rem;"></i>
                <div class="card-header pt-5">
                    <div class="card-title d-flex flex-column">
                        <div class="d-flex align-items-center mb-1">
                            <i class="bi bi-arrow-left-right fs-2hx text-warning me-2"></i>
                            <span class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2">{{ $stats['mutasi']['total'] }}</span>
                        </div>
                        <span class="text-warning fw-bold fs-7 text-uppercase">Jalur Mutasi</span>
                    </div>
                </div>
                <div class="card-body pt-2 pb-4">
                    <div class="d-flex flex-column w-100 position-relative z-index-1">
                        <div class="d-flex flex-stack fs-6 fw-semibold mb-2">
                            <div class="text-gray-600">Jenjang SD</div>
                            <div class="fw-bolder text-gray-800">{{ $stats['mutasi']['sd'] }}</div>
                        </div>
                        <div class="h-6px w-100 bg-warning bg-opacity-50 rounded mb-5">
                            <div class="bg-warning rounded h-6px" role="progressbar" style="width: {{ $stats['mutasi']['total'] > 0 ? ($stats['mutasi']['sd'] / $stats['mutasi']['total']) * 100 : 0 }}%"></div>
                        </div>
                        <div class="d-flex flex-stack fs-6 fw-semibold mb-2">
                            <div class="text-gray-600">Jenjang SMP</div>
                            <div class="fw-bolder text-gray-800">{{ $stats['mutasi']['smp'] }}</div>
                        </div>
                        <div class="h-6px w-100 bg-dark bg-opacity-50 rounded">
                            <div class="bg-orange rounded h-6px" role="progressbar" style="width: {{ $stats['mutasi']['total'] > 0 ? ($stats['mutasi']['smp'] / $stats['mutasi']['total']) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Col-->

        <!--begin::Col - Prestasi-->
        <div class="col-md-6 col-lg-3">
            <div class="card card-flush h-md-100 bg-light-danger border-danger border-opacity-25 border-dashed position-relative overflow-hidden">
                <i class="bi bi-trophy-fill text-danger position-absolute opacity-10 end-0 bottom-0 me-n5 mb-n5" style="font-size: 8rem;"></i>
                <div class="card-header pt-5">
                    <div class="card-title d-flex flex-column">
                        <div class="d-flex align-items-center mb-1">
                            <i class="bi bi-trophy-fill fs-2hx text-danger me-2"></i>
                            <span class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2">{{ $stats['prestasi']['total'] }}</span>
                        </div>
                        <span class="text-danger fw-bold fs-7 text-uppercase">Jalur Prestasi</span>
                    </div>
                </div>
                <div class="card-body pt-2 pb-4">
                    <div class="d-flex flex-column w-100 position-relative z-index-1">
                        <div class="d-flex flex-stack fs-6 fw-semibold mb-2">
                            <div class="text-gray-600">SMP Only</div>
                            <div class="fw-bolder text-gray-800">{{ $stats['prestasi']['smp'] }}</div>
                        </div>
                        <div class="h-6px w-100 bg-white bg-opacity-50 rounded">
                            <div class="bg-danger rounded h-6px" role="progressbar" style="width: 100%"></div>
                        </div>
                        <div class="pt-8 text-center">
                            <span class="text-gray-400 fs-8 italic">Prestasi tidak tersedia untuk SD</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Row-->
@endsection

@section('scripts')
<script>
    // Simple charts initialization if needed
    // Metronic 8 usually uses KTCards and ApexCharts
    // For now we use the static layout as requested "dummy data first"
</script>
@endsection
