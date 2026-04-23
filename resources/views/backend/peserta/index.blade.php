@extends('backend.main')

@section('peserta-menu-active')
    active
@endsection

@section('peserta-menu-open')
    show
@endsection

@section('content')
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <h3 class="card-label me-5">Data Peserta</h3>
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Cari Peserta" />
                </div>
                <!--end::Search-->
            </div>
            <!--end::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <div class="d-flex align-items-center">
                    <label for="filter_periode" class="me-2 fw-bold text-muted">Periode:</label>
                    <select id="filter_periode" class="form-select form-select-sm form-select-solid w-125px me-5">
                        @foreach($semuaPeriode as $p)
                            <option value="{{ $p->id }}" {{ ($periode && $periode->id == $p->id) ? 'selected' : '' }}>
                                {{ $p->tahun_ajaran }}
                            </option>
                        @endforeach
                    </select>

                    <label for="filter_jalur" class="me-2 fw-bold text-muted">Jalur:</label>
                    <select id="filter_jalur" class="form-select form-select-sm form-select-solid w-150px me-5">
                        <option value="">Semua Jalur</option>
                        @foreach($semuaJalur as $j)
                            <option value="{{ $j->id }}">{{ $j->nama_jalur }}</option>
                        @endforeach
                    </select>

                    <label for="filter_sekolah" class="me-2 fw-bold text-muted">Sekolah:</label>
                    <select id="filter_sekolah" class="form-select form-select-sm form-select-solid w-200px" data-control="select2" data-placeholder="Semua Sekolah" {{ auth()->user()->role == 'admin_sekolah' ? 'disabled' : '' }}>
                        @if(auth()->user()->role != 'admin_sekolah')
                            <option value="">Semua Sekolah</option>
                        @endif
                        @foreach($semuaSekolah as $s)
                            <option value="{{ $s->id }}" {{ auth()->user()->role == 'admin_sekolah' ? 'selected' : '' }}>{{ $s->nama_sekolah }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
		<div class="card-body py-4">
            <!--begin::Table-->
            <div class="table-responsive">
            <table class="table align-middle table-row-dashed fs-6 gy-5 min-w-full" id="kt_table_peserta">
                <!--begin::Table head-->
                <thead>
                    <tr class="text-start text-dark-400 fw-bolder fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">No</th>
                        <th class="min-w-125px">No. Pendaftaran</th>
                        <th class="min-w-125px">Nama Lengkap</th>
                        <th class="min-w-125px">Jalur</th>
                        <th class="min-w-125px">Jenjang</th>
                        <th class="min-w-100px text-center">Status</th>
                        <th class="text-end min-w-70px">Actions</th>
                    </tr>
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody class="fw-bold text-gray-600">
                    <!-- Data will be loaded via AJAX -->
                </tbody>
                <!--end::Table body-->
            </table>
            </div>
            <!--end::Table-->
        </div>
    </div>
    <!--end::Card-->
@endsection

@section('scripts')
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {
    $('#kt_table_peserta').DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        ajax: {
            url: "{{ route('peserta.index') }}",
            data: function (d) {
                d.periode_id = $('#filter_periode').val();
                d.jalur_id = $('#filter_jalur').val();
                d.sekolah_id = $('#filter_sekolah').val();
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, width: '10px' },
            { data: 'nomor_pendaftaran', name: 'nomor_pendaftaran' },
            { data: 'nama_lengkap', name: 'nama_lengkap' },
            { data: 'nama_jalur', name: 'nama_jalur' },
            { data: 'jenjang', name: 'jenjang' },
            { data: 'status', name: 'status', className: 'text-center' },
            { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-end' }
        ],
        language: {
            "emptyTable": "Tidak ada data yang tersedia",
            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
            "infoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
            "infoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
            "lengthMenu": "Tampilkan _MENU_ entri",
            "loadingRecords": "Memuat...",
            "processing": "Sedang memproses...",
            "search": "Cari:",
            "zeroRecords": "Tidak ditemukan data yang sesuai",
            "paginate": {
                "first": "Pertama",
                "last": "Terakhir",
                "next": "Berikutnya",
                "previous": "Sebelumnya"
            }
        }
    });

    // Handle search input
    $('[data-kt-user-table-filter="search"]').on('keyup', function() {
        $('#kt_table_peserta').DataTable().search($(this).val()).draw();
    });

    // Handle delete button click
    $(document).on('click', '.btn-delete', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data peserta dan berkas pendaftaran terkait akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#f1416c',
            cancelButtonColor: '#d3d3d3',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            customClass: {
                confirmButton: "btn fw-bold btn-danger",
                cancelButton: "btn fw-bold btn-active-light-primary"
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $('#delete-form-' + id).submit();
            }
        });
    });

    // Handle session success/error messages
    @if(session('success'))
        Swal.fire({
            text: "{{ session('success') }}",
            icon: "success",
            buttonsStyling: false,
            confirmButtonText: "Ok, mengerti!",
            customClass: {
                confirmButton: "btn fw-bold btn-primary"
            }
        });
    @endif

    @if(session('error'))
        Swal.fire({
            text: "{{ session('error') }}",
            icon: "error",
            buttonsStyling: false,
            confirmButtonText: "Ok, mengerti!",
            customClass: {
                confirmButton: "btn fw-bold btn-primary"
            }
        });
    @endif
    
    $('#filter_periode, #filter_jalur, #filter_sekolah').change(function() {
        $('#kt_table_peserta').DataTable().ajax.reload();
    });
});
</script>
@endsection