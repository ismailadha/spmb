@extends('backend.main')

@section('home-menu-active')
    active
@endsection

@section('content')
    <!--begin::Row-->
    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
        <!--begin::Col-->
        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3">
            <!--begin::Card widget 4-->
            <div class="card card-flush h-md-100">
                <!--begin::Header-->
                <div class="card-header pt-5">
                    <!--begin::Title-->
                    <div class="card-title d-flex flex-column">
                        <!--begin::Info-->
                        <div class="d-flex align-items-center">
                            <!--begin::Currency-->
                            <span class="fs-4 fw-semibold text-gray-400 align-self-start me-1"></span>
                            <!--end::Currency-->
                            <!--begin::Amount-->
                            <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">1,284</span>
                            <!--end::Amount-->
                            <!--begin::Badge-->
                            <span class="badge badge-light-success fs-base">
                            <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>2.2%</span>
                            <!--end::Badge-->
                        </div>
                        <!--end::Info-->
                        <!--begin::Subtitle-->
                        <span class="text-gray-400 pt-1 fw-semibold fs-6">Total Pendaftar Terverifikasi</span>
                        <!--end::Subtitle-->
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::Header-->
                <!--begin::Card body-->
                <div class="card-body pt-2 pb-4 d-flex align-items-center">
                    <!--begin::Chart-->
                    <div class="d-flex flex-center me-5 pt-2">
                        <div id="kt_card_widget_4_chart" style="min-width: 70px; min-height: 70px" data-kt-size="70" data-kt-line="11"></div>
                    </div>
                    <!--end::Chart-->
                    <!--begin::Labels-->
                    <div class="d-flex flex-column content-justify-center w-100">
                        <!--begin::Label-->
                        <div class="d-flex fs-6 fw-semibold align-items-center">
                            <!--begin::Bullet-->
                            <div class="bullet w-8px h-6px rounded-2 bg-danger me-3"></div>
                            <!--end::Bullet-->
                            <!--begin::Label-->
                            <div class="text-gray-500 flex-grow-1 me-4">Laki-laki</div>
                            <!--end::Label-->
                            <!--begin::Stats-->
                            <div class="fw-bolder text-gray-700 text-xxl-end">762</div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Label-->
                        <!--begin::Label-->
                        <div class="d-flex fs-6 fw-semibold align-items-center my-1">
                            <!--begin::Bullet-->
                            <div class="bullet w-8px h-6px rounded-2 bg-primary me-3"></div>
                            <!--end::Bullet-->
                            <!--begin::Label-->
                            <div class="text-gray-500 flex-grow-1 me-4">Perempuan</div>
                            <!--end::Label-->
                            <!--begin::Stats-->
                            <div class="fw-bolder text-gray-700 text-xxl-end">522</div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Label-->
                    </div>
                    <!--end::Labels-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card widget 4-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3">
            <!--begin::Card widget 5-->
            <div class="card card-flush h-md-100">
                <!--begin::Header-->
                <div class="card-header pt-5">
                    <!--begin::Title-->
                    <div class="card-title d-flex flex-column">
                        <!--begin::Info-->
                        <div class="d-flex align-items-center">
                            <!--begin::Amount-->
                            <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">156</span>
                            <!--end::Amount-->
                            <!--begin::Badge-->
                            <span class="badge badge-light-warning fs-base">Pending</span>
                            <!--end::Badge-->
                        </div>
                        <!--end::Info-->
                        <!--begin::Subtitle-->
                        <span class="text-gray-400 pt-1 fw-semibold fs-6">Menunggu Verifikasi</span>
                        <!--end::Subtitle-->
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::Header-->
                <!--begin::Card body-->
                <div class="card-body d-flex align-items-end pt-0">
                    <!--begin::Progress-->
                    <div class="d-flex align-items-center flex-column mt-3 w-100">
                        <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                            <span class="fw-boldest fs-6 text-dark">Berkas Masuk Hari Ini</span>
                            <span class="fw-bolder fs-6 text-gray-400">12 Berkas</span>
                        </div>
                        <div class="h-8px mx-3 w-100 bg-light-warning rounded">
                            <div class="bg-warning rounded h-8px" role="progressbar" style="width: 76%; shadow: 0 0 10px rgba(0,0,0,0.1);" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <!--end::Progress-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card widget 5-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3">
            <!--begin::Card widget 7-->
            <div class="card card-flush h-md-100">
                <!--begin::Header-->
                <div class="card-header pt-5">
                    <!--begin::Title-->
                    <div class="card-title d-flex flex-column">
                        <!--begin::Info-->
                        <div class="d-flex align-items-center">
                            <!--begin::Amount-->
                            <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">892</span>
                            <!--end::Amount-->
                            <!--begin::Badge-->
                            <span class="badge badge-light-primary fs-base">SMA/SMK</span>
                            <!--end::Badge-->
                        </div>
                        <!--end::Info-->
                        <!--begin::Subtitle-->
                        <span class="text-gray-400 pt-1 fw-semibold fs-6">Kapasitas Kursi Tersedia</span>
                        <!--end::Subtitle-->
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::Header-->
                <!--begin::Card body-->
                <div class="card-body d-flex flex-column justify-content-end pe-0">
                    <!--begin::Title-->
                    <span class="fs-6 fw-bolder text-gray-800 d-block mb-2">Pendaftar Terakhir</span>
                    <!--end::Title-->
                    <!--begin::Users group-->
                    <div class="symbol-group symbol-hover mb-3">
                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Alan Warden">
                            <span class="symbol-label bg-warning text-inverse-warning fw-bold">A</span>
                        </div>
                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Michael Eberon">
                            <img alt="Pic" src="{{ asset('back/media/avatars/300-11.jpg') }}" />
                        </div>
                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Susan Redwood">
                            <span class="symbol-label bg-primary text-inverse-primary fw-bold">S</span>
                        </div>
                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Melody Macy">
                            <img alt="Pic" src="{{ asset('back/media/avatars/300-2.jpg') }}" />
                        </div>
                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Perry Matthew">
                            <span class="symbol-label bg-danger text-inverse-danger fw-bold">P</span>
                        </div>
                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Barry Walter">
                            <img alt="Pic" src="{{ asset('back/media/avatars/300-12.jpg') }}" />
                        </div>
                        <a href="#" class="symbol symbol-35px symbol-circle" data-bs-toggle="modal" data-bs-target="#kt_modal_view_users">
                            <span class="symbol-label bg-dark text-gray-300 fs-8 fw-bold">+42</span>
                        </a>
                    </div>
                    <!--end::Users group-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card widget 7-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3">
            <!--begin::Card widget 17-->
            <div class="card card-flush h-md-100">
                <!--begin::Header-->
                <div class="card-header pt-5">
                    <!--begin::Title-->
                    <div class="card-title d-flex flex-column">
                        <!--begin::Info-->
                        <div class="d-flex align-items-center">
                            <!--begin::Amount-->
                            <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">95%</span>
                            <!--end::Amount-->
                            <!--begin::Badge-->
                            <span class="badge badge-light-success fs-base">Sangat Baik</span>
                            <!--end::Badge-->
                        </div>
                        <!--end::Info-->
                        <!--begin::Subtitle-->
                        <span class="text-gray-400 pt-1 fw-semibold fs-6">Kelengkapan Berkas</span>
                        <!--end::Subtitle-->
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::Header-->
                <!--begin::Card body-->
                <div class="card-body pt-2 pb-4 d-flex flex-wrap align-items-center">
                    <!--begin::Chart-->
                    <div class="d-flex flex-center me-5 pt-2">
                        <div id="kt_card_widget_17_chart" style="min-width: 70px; min-height: 70px" data-kt-size="70" data-kt-line="11"></div>
                    </div>
                    <!--end::Chart-->
                    <!--begin::Labels-->
                    <div class="d-flex flex-column content-justify-center flex-row-fluid">
                        <!--begin::Label-->
                        <div class="d-flex fw-semibold align-items-center">
                            <!--begin::Bullet-->
                            <div class="bullet w-8px h-3px rounded-2 bg-success me-3"></div>
                            <!--end::Bullet-->
                            <!--begin::Label-->
                            <div class="text-gray-500 flex-grow-1 me-4">Lengkap</div>
                            <!--end::Label-->
                            <!--begin::Stats-->
                            <div class="fw-bolder text-gray-700 text-xxl-end">1,120</div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Label-->
                        <!--begin::Label-->
                        <div class="d-flex fw-semibold align-items-center my-1">
                            <!--begin::Bullet-->
                            <div class="bullet w-8px h-3px rounded-2 bg-warning me-3"></div>
                            <!--end::Bullet-->
                            <!--begin::Label-->
                            <div class="text-gray-500 flex-grow-1 me-4">Belum Lengkap</div>
                            <!--end::Label-->
                            <!--begin::Stats-->
                            <div class="fw-bolder text-gray-700 text-xxl-end">164</div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Label-->
                    </div>
                    <!--end::Labels-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card widget 17-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->

    <!--begin::Row-->
    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
        <!--begin::Col-->
        <div class="col-xl-8">
            <!--begin::Table widget 14-->
            <div class="card card-flush h-md-100">
                <!--begin::Header-->
                <div class="card-header pt-7">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800">Pendaftar Terbaru</span>
                        <span class="text-gray-400 mt-1 fw-semibold fs-6">Update terakhir hari ini jam 12:00</span>
                    </h3>
                    <!--end::Title-->
                    <!--begin::Toolbar-->
                    <div class="card-toolbar">
                        <a href="{{ route('peserta.index') }}" class="btn btn-sm btn-light">Lihat Semua</a>
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-6">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                            <!--begin::Table head-->
                            <thead>
                                <tr class="fw-bold text-muted">
                                    <th class="min-w-150px">Nama Siswa</th>
                                    <th class="min-w-120px">Nomor Reg</th>
                                    <th class="min-w-120px">Jalur</th>
                                    <th class="min-w-120px">Status</th>
                                    <th class="min-w-100px text-end">Aksi</th>
                                </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-45px me-5">
                                                <img src="{{ asset('back/media/avatars/300-1.jpg') }}" alt="" />
                                            </div>
                                            <div class="d-flex flex-column">
                                                <a href="#" class="text-dark fw-bold text-hover-primary fs-6">Ahmad Fauzan</a>
                                                <span class="text-muted fw-semibold d-block fs-7">Lhokseumawe</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-dark fw-bold d-block fs-6">2024/001/012</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-light-primary">Zonasi</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-light-success">Terverifikasi</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                            <i class="ki-duotone ki-eye fs-3">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-45px me-5">
                                                <img src="{{ asset('back/media/avatars/300-2.jpg') }}" alt="" />
                                            </div>
                                            <div class="d-flex flex-column">
                                                <a href="#" class="text-dark fw-bold text-hover-primary fs-6">Siti Aminah</a>
                                                <span class="text-muted fw-semibold d-block fs-7">Aceh Utara</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-dark fw-bold d-block fs-6">2024/001/013</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-light-warning">Afirmasi</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-light-warning">Pending</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                            <i class="ki-duotone ki-eye fs-3">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-45px me-5">
                                                <img src="{{ asset('back/media/avatars/300-5.jpg') }}" alt="" />
                                            </div>
                                            <div class="d-flex flex-column">
                                                <a href="#" class="text-dark fw-bold text-hover-primary fs-6">Rizki Ramadhan</a>
                                                <span class="text-muted fw-semibold d-block fs-7">Bireuen</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-dark fw-bold d-block fs-6">2024/001/014</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-light-info">Prestasi</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-light-success">Terverifikasi</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                            <i class="ki-duotone ki-eye fs-3">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Table container-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Table widget 14-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xl-4">
            <!--begin::List widget 5-->
            <div class="card card-flush h-md-100">
                <!--begin::Header-->
                <div class="card-header pt-7">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800">Timeline Pendaftaran</span>
                        <span class="text-gray-400 mt-1 fw-semibold fs-6">Jadwal penting pendaftaran</span>
                    </h3>
                    <!--end::Title-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-5">
                    <!--begin::Timeline-->
                    <div class="timeline-label">
                        <!--begin::Item-->
                        <div class="timeline-item">
                            <!--begin::Label-->
                            <div class="timeline-label fw-bold text-gray-800 fs-6">08:42</div>
                            <!--end::Label-->
                            <!--begin::Badge-->
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-warning fs-1"></i>
                            </div>
                            <!--end::Badge-->
                            <!--begin::Text-->
                            <div class="fw-mormal timeline-content text-muted ps-3">Pendaftaran Gelombang 1 Dibuka</div>
                            <!--end::Text-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="timeline-item">
                            <!--begin::Label-->
                            <div class="timeline-label fw-bold text-gray-800 fs-6">10:00</div>
                            <!--end::Label-->
                            <!--begin::Badge-->
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-success fs-1"></i>
                            </div>
                            <!--end::Badge-->
                            <!--begin::Content-->
                            <div class="timeline-content d-flex">
                                <span class="fw-bold text-gray-800 ps-3">Verifikasi Berkas Manual</span>
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="timeline-item">
                            <!--begin::Label-->
                            <div class="timeline-label fw-bold text-gray-800 fs-6">14:30</div>
                            <!--end::Label-->
                            <!--begin::Badge-->
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-danger fs-1"></i>
                            </div>
                            <!--end::Badge-->
                            <!--begin::Text-->
                            <div class="timeline-content fw-bold text-gray-800 ps-3">Batas Akhir Upload Berkas Afirmasi</div>
                            <!--end::Text-->
                        </div>
                        <!--end::Item-->
                    </div>
                    <!--end::Timeline-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::List widget 5-->
        </div>
        <!--end::Col-->
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
