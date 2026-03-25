@extends('backend.main')

@section('jadwal-menu-active')
    active
@endsection

@section('jadwal-menu-open')
    show
@endsection

@section('content')
<!--begin::Layout-->
<div class="d-flex flex-column flex-lg-row">
    <!--begin::Sidebar-->
    <div class="flex-column flex-lg-row-auto w-100 w-lg-250px w-xl-300px mb-10 mb-lg-0">
        <!--begin::Card-->
        <div class="card card-flush mb-0" data-kt-sticky="true" data-kt-sticky-name="jadwal-detail-sidebar" data-kt-sticky-offset="{default: false, lg: '200px'}" data-kt-sticky-width="{lg: '250px', xl: '300px'}" data-kt-sticky-left="auto" data-kt-sticky-top="150px" data-kt-sticky-animation="false" data-kt-sticky-zindex="95">
            <!--begin::Card header-->
            <div class="card-header border-0 pt-6">
                <!--begin::Card title-->
                <div class="card-title">
                    <h2>Informasi Jadwal</h2>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            
            <!--begin::Card body-->
            <div class="card-body pt-0 pb-5">
                <!--begin::Details-->
                <div class="d-flex flex-column mb-5">
                    <span class="fw-bold text-gray-400">Status</span>
                    <span class="badge badge-light-success text-success fw-bolder mt-1 px-3 py-2">Open</span>
                </div>
                <!--end::Details-->
                
                <div class="separator separator-dashed my-5"></div>

                <!--begin::Details-->
                <div class="d-flex flex-column mb-5">
                    <span class="fw-bold text-gray-400">Tahun Ajaran</span>
                    <span class="fw-bolder fs-6 text-gray-800">2025/2026</span>
                </div>
                <!--end::Details-->

                <!--begin::Details-->
                <div class="d-flex flex-column mb-5">
                    <span class="fw-bold text-gray-400">Sekolah</span>
                    <span class="fw-bolder fs-6 text-gray-800">SMA Negeri 1 Example</span>
                </div>
                <!--end::Details-->

                <!--begin::Details-->
                <div class="d-flex flex-column mb-5">
                    <span class="fw-bold text-gray-400">Jalur Pendaftaran</span>
                    <span class="fw-bolder fs-6 text-gray-800">Jalur Prestasi</span>
                </div>
                <!--end::Details-->

                <!--begin::Details-->
                <div class="d-flex flex-column mb-5">
                    <span class="fw-bold text-gray-400">Periode Pendaftaran</span>
                    <span class="fw-bolder fs-6 text-gray-800">01 Jan 2025 - 31 Jan 2025</span>
                </div>
                <!--end::Details-->

                <!--begin::Details-->
                <div class="d-flex flex-column mb-5">
                    <span class="fw-bold text-gray-400">Batas Kuota</span>
                    <span class="fw-bolder fs-6 text-gray-800">150 Siswa</span>
                </div>
                <!--end::Details-->

                <div class="separator separator-dashed my-5"></div>

                <div class="d-flex w-100 flex-stack">
                    <a href="{{ route('jadwal.index') ?? '#' }}" class="btn btn-light btn-sm w-100 me-2"><i class="fas fa-arrow-left"></i> Kembali</a>
                    <a href="#" class="btn btn-primary btn-sm w-100"><i class="fas fa-edit"></i> Edit</a>
                </div>
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Sidebar-->

    <!--begin::Content-->
    <div class="flex-lg-row-fluid ms-lg-15">
        <!--begin::Card Tahapan-->
        <div class="card card-flush mb-6 mb-xl-9">
            <!--begin::Card header-->
            <div class="card-header mt-6">
                <!--begin::Card title-->
                <div class="card-title flex-column">
                    <h2 class="mb-1">Tahapan Pendaftaran</h2>
                    <div class="fs-6 fw-bold text-muted">Daftar tahapan seleksi untuk jadwal ini</div>
                </div>
                <!--end::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <button type="button" class="btn btn-light-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal_tambah_tahapan">
                        <i class="fas fa-plus"></i> Tambah Tahapan
                    </button>
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->
            
            <!--begin::Card body-->
            <div class="card-body p-9 pt-4">
                <!--begin::Timeline-->
                <div class="timeline-label">
                    <!--begin::Item-->
                    <div class="timeline-item">
                        <div class="timeline-label fw-bolder text-gray-800 fs-6">01 Jan 2025</div>
                        <div class="timeline-badge">
                            <i class="fa fa-genderless text-success fs-1"></i>
                        </div>
                        <div class="timeline-content d-flex align-items-center justify-content-between flex-grow-1">
                            <div>
                                <span class="fw-bolder text-gray-800 ps-3 fs-5">Pendaftaran & Submit Berkas</span>
                                <div class="text-muted fw-bold ps-3 fs-7">Siswa melakukan pendaftaran dan upload berkas persyaratan (01 Jan - 10 Jan 2025).</div>
                            </div>
                            <div class="ms-3">
                                <button class="btn btn-icon btn-light btn-sm me-1"><i class="fas fa-edit text-warning"></i></button>
                                <button class="btn btn-icon btn-light btn-sm"><i class="fas fa-trash text-danger"></i></button>
                            </div>
                        </div>
                    </div>
                    <!--end::Item-->

                    <!--begin::Item-->
                    <div class="timeline-item">
                        <div class="timeline-label fw-bolder text-gray-800 fs-6">11 Jan 2025</div>
                        <div class="timeline-badge">
                            <i class="fa fa-genderless text-primary fs-1"></i>
                        </div>
                        <div class="timeline-content d-flex align-items-center justify-content-between flex-grow-1">
                            <div>
                                <span class="fw-bolder text-gray-800 ps-3 fs-5">Seleksi Administrasi</span>
                                <div class="text-muted fw-bold ps-3 fs-7">Panitia memverifikasi berkas yang telah diupload (11 Jan - 15 Jan 2025).</div>
                            </div>
                            <div class="ms-3">
                                <button class="btn btn-icon btn-light btn-sm me-1"><i class="fas fa-edit text-warning"></i></button>
                                <button class="btn btn-icon btn-light btn-sm"><i class="fas fa-trash text-danger"></i></button>
                            </div>
                        </div>
                    </div>
                    <!--end::Item-->

                    <!--begin::Item-->
                    <div class="timeline-item">
                        <div class="timeline-label fw-bolder text-gray-800 fs-6">18 Jan 2025</div>
                        <div class="timeline-badge">
                            <i class="fa fa-genderless text-warning fs-1"></i>
                        </div>
                        <div class="timeline-content d-flex align-items-center justify-content-between flex-grow-1">
                            <div>
                                <span class="fw-bolder text-gray-800 ps-3 fs-5">Ujian Seleksi / Tes Wawancara</span>
                                <div class="text-muted fw-bold ps-3 fs-7">Ujian tertulis atau wawancara bagi pendaftar yang lolos administrasi (18 Jan - 20 Jan 2025).</div>
                            </div>
                            <div class="ms-3">
                                <button class="btn btn-icon btn-light btn-sm me-1"><i class="fas fa-edit text-warning"></i></button>
                                <button class="btn btn-icon btn-light btn-sm"><i class="fas fa-trash text-danger"></i></button>
                            </div>
                        </div>
                    </div>
                    <!--end::Item-->

                    <!--begin::Item-->
                    <div class="timeline-item">
                        <div class="timeline-label fw-bolder text-gray-800 fs-6">25 Jan 2025</div>
                        <div class="timeline-badge">
                            <i class="fa fa-genderless text-danger fs-1"></i>
                        </div>
                        <div class="timeline-content d-flex align-items-center justify-content-between flex-grow-1">
                            <div>
                                <span class="fw-bolder text-gray-800 ps-3 fs-5">Pengumuman Kelulusan</span>
                                <div class="text-muted fw-bold ps-3 fs-7">Pengumuman akhir siswa yang diterima.</div>
                            </div>
                            <div class="ms-3">
                                <button class="btn btn-icon btn-light btn-sm me-1"><i class="fas fa-edit text-warning"></i></button>
                                <button class="btn btn-icon btn-light btn-sm"><i class="fas fa-trash text-danger"></i></button>
                            </div>
                        </div>
                    </div>
                    <!--end::Item-->
                </div>
                <!--end::Timeline-->
                
                <!--begin::Notice-->
                <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed mt-10 p-6">
                    <i class="fas fa-info-circle fs-2tx text-primary me-4"></i>
                    <div class="d-flex flex-stack flex-grow-1 flex-wrap flex-md-nowrap">
                        <div class="mb-3 mb-md-0 fw-bold">
                            <h4 class="text-gray-900 fw-bolder">Informasi Tahapan</h4>
                            <div class="fs-6 text-gray-700 pe-7">Tahapan di atas berjalan sesuai urutan tanggal pendaftaran. Pastikan tidak ada tanggal yang tumpang tindih secara tidak logis.</div>
                        </div>
                    </div>
                </div>
                <!--end::Notice-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card Tahapan-->
        
        <!--begin::Card Persyaratan (Contoh Tambahan)-->
        <div class="card card-flush">
            <div class="card-header mt-6">
                <div class="card-title flex-column">
                    <h2 class="mb-1">Persyaratan Dokumen</h2>
                    <div class="fs-6 fw-bold text-muted">Dokumen yang wajib diunggah pendaftar</div>
                </div>
                <div class="card-toolbar">
                    <button type="button" class="btn btn-light-info btn-sm">
                        <i class="fas fa-plus"></i> Tambah Persyaratan
                    </button>
                </div>
            </div>
            <div class="card-body p-9 pt-0">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                        <thead>
                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                <th>Nama Dokumen</th>
                                <th>Tipe File</th>
                                <th>Wajib</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-bold">
                            <tr>
                                <td>Kartu Keluarga</td>
                                <td>PDF, JPG, PNG</td>
                                <td><span class="badge badge-light-success">Ya</span></td>
                                <td class="text-end">
                                    <button class="btn btn-icon btn-light btn-sm"><i class="fas fa-trash text-danger"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>Ijazah Terakhir / SKL</td>
                                <td>PDF</td>
                                <td><span class="badge badge-light-success">Ya</span></td>
                                <td class="text-end">
                                    <button class="btn btn-icon btn-light btn-sm"><i class="fas fa-trash text-danger"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>Piagam Penghargaan</td>
                                <td>PDF, JPG</td>
                                <td><span class="badge badge-light-secondary">Tidak</span></td>
                                <td class="text-end">
                                    <button class="btn btn-icon btn-light btn-sm"><i class="fas fa-trash text-danger"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--end::Card Persyaratan-->
    </div>
    <!--end::Content-->
</div>
<!--end::Layout-->

<!--begin::Modal Tambah Tahapan-->
<div class="modal fade" id="modal_tambah_tahapan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content rounded">
            <!--begin::Modal header-->
            <div class="modal-header pb-0 border-0 justify-content-end">
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="fas fa-times fs-1"></i>
                </div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->
            
            <!--begin::Modal body-->
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                <!--begin::Form-->
                <form id="form_tambah_tahapan" class="form" action="#">
                    <!--begin::Heading-->
                    <div class="mb-13 text-center">
                        <h1 class="mb-3">Tambah Tahapan Baru</h1>
                        <div class="text-muted fw-bold fs-5">
                            Tambahkan tahapan seleksi untuk <span class="fw-bolder text-gray-800">Jalur Prestasi</span>
                        </div>
                    </div>
                    <!--end::Heading-->
                    
                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Nama Tahapan</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Contoh: Seleksi Administrasi, Tes Tulis, Wawancara, dll."></i>
                        </label>
                        <input type="text" class="form-control form-control-solid" placeholder="Masukkan nama tahapan" name="nama_tahapan" />
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="row g-9 mb-8">
                        <!--begin::Col-->
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-bold mb-2">Tanggal Mulai</label>
                            <div class="position-relative d-flex align-items-center">
                                <i class="fas fa-calendar-alt position-absolute ms-4 fs-5 text-gray-500"></i>
                                <input class="form-control form-control-solid ps-12" placeholder="Pilih tanggal mulai" name="tanggal_mulai" type="date" />
                            </div>
                        </div>
                        <!--end::Col-->
                        
                        <!--begin::Col-->
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-bold mb-2">Tanggal Selesai</label>
                            <div class="position-relative d-flex align-items-center">
                                <i class="fas fa-calendar-check position-absolute ms-4 fs-5 text-gray-500"></i>
                                <input class="form-control form-control-solid ps-12" placeholder="Pilih tanggal selesai" name="tanggal_selesai" type="date" />
                            </div>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-8">
                        <label class="fs-6 fw-bold mb-2">Deskripsi / Keterangan</label>
                        <textarea class="form-control form-control-solid" rows="3" name="deskripsi" placeholder="Jelaskan detail mengenai tahapan ini secara singkat"></textarea>
                    </div>
                    <!--end::Input group-->
                    
                    <!--begin::Input group-->
                    <div class="d-flex flex-stack mb-8">
                        <!--begin::Label-->
                        <div class="me-5">
                            <label class="fs-6 fw-bold">Status Aktif</label>
                            <div class="fs-7 fw-bold text-muted">Tahapan akan langsung berjalan bila sudah waktu pendaftarannya</div>
                        </div>
                        <!--end::Label-->
                        <!--begin::Switch-->
                        <label class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="1" checked="checked" />
                            <span class="form-check-label fw-bold text-muted">Aktif</span>
                        </label>
                        <!--end::Switch-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Actions-->
                    <div class="text-center">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" id="btn_submit_tahapan">
                            <span class="indicator-label">Simpan Data</span>
                            <span class="indicator-progress">Tunggu sebentar...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
    </div>
</div>
<!--end::Modal Tambah Tahapan-->
@endsection

@section('scripts')
<script>
    // Initialize tooltips within modal
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Simple loading state simulation for UI eval
    document.getElementById('btn_submit_tahapan').addEventListener('click', function() {
        var btn = this;
        btn.setAttribute('data-kt-indicator', 'on');
        btn.disabled = true;

        setTimeout(function() {
            btn.removeAttribute('data-kt-indicator');
            btn.disabled = false;
            $('#modal_tambah_tahapan').modal('hide');
            // Assuming sweetalert2 is included in the project for metronic
            if(typeof Swal !== 'undefined') {
                Swal.fire({
                    text: "Data Tahapan berhasil ditambahkan (Dummy)!",
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, mengerti!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });
            } else {
                alert("Data berhasil ditambahkan!");
            }
        }, 1500);
    });
</script>
@endsection
