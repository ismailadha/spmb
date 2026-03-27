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
                    <span class="fw-bolder fs-6 text-gray-800">{{ $jadwal->tahun_ajaran }}</span>
                </div>
                <!--end::Details-->

                <!--begin::Details-->
                <div class="d-flex flex-column mb-5">
                    <span class="fw-bold text-gray-400">Sekolah</span>
                    <span class="fw-bolder fs-6 text-gray-800">{{ $jadwal->nama_sekolah }}</span>
                </div>
                <!--end::Details-->

                <!--begin::Details-->
                <div class="d-flex flex-column mb-5">
                    <span class="fw-bold text-gray-400">Jalur Pendaftaran</span>
                    <span class="fw-bolder fs-6 text-gray-800">{{ $jadwal->nama_jalur }}</span>
                </div>
                <!--end::Details-->

                <!--begin::Details-->
                <div class="d-flex flex-column mb-5">
                    <span class="fw-bold text-gray-400">Periode Pendaftaran</span>
                    <span class="fw-bolder fs-6 text-gray-800">{{ \Carbon\Carbon::parse($jadwal->periode_mulai)->locale('id')->isoFormat('D MMMM YYYY') }} - {{ \Carbon\Carbon::parse($jadwal->periode_selesai)->locale('id')->isoFormat('D MMMM YYYY') }}</span>
                </div>
                <!--end::Details-->

                <!--begin::Details-->
                <div class="d-flex flex-column mb-5">
                    <span class="fw-bold text-gray-400">Batas Kuota</span>
                    <span class="fw-bolder fs-6 text-gray-800">{{ $jadwal->kuota }} Siswa</span>
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
                    @forelse($tahapan as $index => $item)
                        <!--begin::Item-->
                        <div class="timeline-item">
                            <div class="timeline-label fw-bolder text-gray-800 fs-6">{{ \Carbon\Carbon::parse($item->tanggal_mulai)->locale('id')->isoFormat('DD MMM YYYY') }}</div>
                            <div class="timeline-badge">
                                @php
                                    $colors = ['success', 'primary', 'warning', 'danger', 'info'];
                                    $color = $colors[$index % count($colors)];
                                @endphp
                                <i class="fa fa-genderless text-{{ $color }} fs-1"></i>
                            </div>
                            <div class="timeline-content d-flex align-items-center justify-content-between flex-grow-1">
                                <div>
                                    <span class="fw-bolder text-gray-800 ps-3 fs-5">{{ $item->nama_tahapan }}</span>
                                    <div class="text-muted fw-bold ps-3 fs-7">
                                        {{ $item->keterangan ?? 'Tidak ada keterangan.' }} 
                                        @if($item->tanggal_selesai && $item->tanggal_selesai != $item->tanggal_mulai)
                                            <br>({{ \Carbon\Carbon::parse($item->tanggal_mulai)->locale('id')->isoFormat('DD MMM YYYY') }} - {{ \Carbon\Carbon::parse($item->tanggal_selesai)->locale('id')->isoFormat('DD MMM YYYY') }})
                                        @else
                                            <br>({{ \Carbon\Carbon::parse($item->tanggal_mulai)->locale('id')->isoFormat('DD MMM YYYY') }})
                                        @endif
                                    </div>
                                </div>
                                <div class="ms-3 d-flex">
                                    <button class="btn btn-icon btn-light btn-sm me-1" data-bs-toggle="modal" data-bs-target="#modal_edit_tahapan" data-id="{{ $item->id }}" data-nama="{{ $item->nama_tahapan }}" data-mulai="{{ $item->tanggal_mulai }}" data-selesai="{{ $item->tanggal_selesai }}" data-keterangan="{{ $item->keterangan }}"><i class="fas fa-edit text-warning"></i></button>
                                    <form action="{{ route('jadwal.destroyTahapan', $item->id) }}" method="POST" class="form-delete-tahapan">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-icon btn-light btn-sm"><i class="fas fa-trash text-danger"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--end::Item-->
                    @empty
                        <div class="text-center text-muted mb-5">Belum ada tahapan yang ditambahkan.</div>
                    @endforelse
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
                <form id="form_tambah_tahapan" class="form" action="{{ route('jadwal.storeTahapan') }}" method="POST">
                    @csrf
                    <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">
                    <!--begin::Heading-->
                    <div class="mb-13 text-center">
                        <h1 class="mb-3">Tambah Tahapan Baru</h1>
                        <div class="text-muted fw-bold fs-5">
                            Tambahkan tahapan seleksi untuk <span class="fw-bolder text-gray-800">{{ $jadwal->nama_jalur }}</span>
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
                        <textarea class="form-control form-control-solid" rows="3" name="keterangan" placeholder="Jelaskan detail mengenai tahapan ini secara singkat"></textarea>
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

<!--begin::Modal Edit Tahapan-->
<div class="modal fade" id="modal_edit_tahapan" tabindex="-1" aria-hidden="true">
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
            <!--end::Modal header-->
            
            <!--begin::Modal body-->
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                <!--begin::Form-->
                <form id="form_edit_tahapan" class="form" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="tahapan_id" id="edit_tahapan_id">
                    <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">
                    <!--begin::Heading-->
                    <div class="mb-13 text-center">
                        <h1 class="mb-3">Edit Tahapan</h1>
                        <div class="text-muted fw-bold fs-5">
                            Edit tahapan seleksi untuk <span class="fw-bolder text-gray-800">{{ $jadwal->nama_jalur }}</span>
                        </div>
                    </div>
                    <!--end::Heading-->
                    
                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Nama Tahapan</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Contoh: Seleksi Administrasi, Tes Tulis, Wawancara, dll."></i>
                        </label>
                        <input type="text" class="form-control form-control-solid" placeholder="Masukkan nama tahapan" name="nama_tahapan" id="edit_nama_tahapan" />
                    </div>
                    <!--end::Input group-->
                    
                    <!--begin::Input group-->
                    <div class="row g-9 mb-8">
                        <!--begin::Col-->
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-bold mb-2">Tanggal Mulai</label>
                            <div class="position-relative d-flex align-items-center">
                                <i class="fas fa-calendar-alt position-absolute ms-4 fs-5 text-gray-500"></i>
                                <input class="form-control form-control-solid ps-12" placeholder="Pilih tanggal mulai" name="tanggal_mulai" type="date" id="edit_tanggal_mulai" />
                            </div>
                        </div>
                        <!--end::Col-->
                        
                        <!--begin::Col-->
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-bold mb-2">Tanggal Selesai</label>
                            <div class="position-relative d-flex align-items-center">
                                <i class="fas fa-calendar-check position-absolute ms-4 fs-5 text-gray-500"></i>
                                <input class="form-control form-control-solid ps-12" placeholder="Pilih tanggal selesai" name="tanggal_selesai" type="date" id="edit_tanggal_selesai" />
                            </div>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    
                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-8">
                        <label class="fs-6 fw-bold mb-2">Deskripsi / Keterangan</label>
                        <textarea class="form-control form-control-solid" rows="3" name="keterangan" id="edit_keterangan" placeholder="Jelaskan detail mengenai tahapan ini secara singkat"></textarea>
                    </div>
                    <!--end::Input group-->
                    
                    <!--begin::Actions-->
                    <div class="text-center">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" id="btn_update_tahapan">
                            <span class="indicator-label">Simpan Perubahan</span>
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
<!--end::Modal Edit Tahapan-->
@endsection

@section('scripts')
<script>
    // Initialize tooltips within modal
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    document.getElementById('btn_submit_tahapan').addEventListener('click', function() {
        var btn = this;
        var form = document.getElementById('form_tambah_tahapan');
        
        // Basic HTML5 validation trigger
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        btn.setAttribute('data-kt-indicator', 'on');
        btn.disabled = true;

        form.submit();
    });

    @if(session('success'))
    if(typeof Swal !== 'undefined') {
        Swal.fire({
            text: "{{ session('success') }}",
            icon: "success",
            buttonsStyling: false,
            confirmButtonText: "Ok, mengerti!",
            customClass: {
                confirmButton: "btn btn-primary"
            }
        });
    }
    @endif

    @if($errors->any())
    if(typeof Swal !== 'undefined') {
        Swal.fire({
            text: "{{ $errors->first() }}",
            icon: "error",
            buttonsStyling: false,
            confirmButtonText: "Ok, mengerti!",
            customClass: {
                confirmButton: "btn btn-danger"
            }
        });
    }
    @endif

    // Handle delete confirmation
    var deleteForms = document.querySelectorAll('.form-delete-tahapan');
    deleteForms.forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: "Apakah Anda yakin?",
                    text: "Data tahapan ini akan dihapus secara permanen!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Ya, Hapus!",
                    cancelButtonText: "Batal",
                    customClass: {
                        confirmButton: "btn btn-danger",
                        cancelButton: "btn btn-light"
                    }
                }).then(function(result) {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            } else {
                if (confirm("Apakah Anda yakin ingin menghapus tahapan ini?")) {
                    form.submit();
                }
            }
        });
    });
    // Handle Edit Modal Data Population
    var modalEditTahapan = document.getElementById('modal_edit_tahapan');
    if (modalEditTahapan) {
        modalEditTahapan.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');
            var nama = button.getAttribute('data-nama');
            var mulai = button.getAttribute('data-mulai');
            var selesai = button.getAttribute('data-selesai');
            var keterangan = button.getAttribute('data-keterangan');

            document.getElementById('edit_tahapan_id').value = id;
            document.getElementById('edit_nama_tahapan').value = nama;
            document.getElementById('edit_tanggal_mulai').value = mulai;
            document.getElementById('edit_tanggal_selesai').value = selesai;
            document.getElementById('edit_keterangan').value = keterangan;

            var form = document.getElementById('form_edit_tahapan');
            var baseUrl = "{{ url('jadwal/updateTahapan') }}";
            form.action = baseUrl + '/' + id;
        });
    }

    var btnUpdateTahapan = document.getElementById('btn_update_tahapan');
    if (btnUpdateTahapan) {
        btnUpdateTahapan.addEventListener('click', function() {
            var btn = this;
            var form = document.getElementById('form_edit_tahapan');
            
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            btn.setAttribute('data-kt-indicator', 'on');
            btn.disabled = true;
            form.submit();
        });
    }
</script>
@endsection
