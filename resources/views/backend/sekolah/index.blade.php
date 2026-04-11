@extends('backend.main')

@section('sekolah-menu-active')
    active
@endsection

@section('sekolah-menu-open')
    show
@endsection

@section('content')
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <h3 class="card-label">Data Sekolah</h3>
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <a href="{{ route('sekolah.create') }}" class="btn btn-primary">
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor" />
                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor" />
                            </svg>
                        </span>
                        Add Sekolah
                    </a>
                </div>
                <!--end::Toolbar-->
            </div>
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
		<div class="card-body py-4">
            <!--begin::Table-->
            <div class="table-responsive">
            <table class="table align-middle table-row-dashed fs-6 gy-5 min-w-full" id="kt_table_users">
                <!--begin::Table head-->
                <thead>
                    <!--begin::Table row-->
                    <tr class="text-start text-dark-400 fw-bolder fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">No</th>
                        <th class="min-w-200px">Sekolah</th>
                        <th class="min-w-150px">Alamat</th>
                        <th class="min-w-100px text-center">Total Kuota</th>
                        <th class="min-w-100px">Status</th>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {
    $('#kt_table_users').DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        ajax: "{{ route('sekolah.index') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, width: '10px' },
            { data: 'sekolah_info', name: 'sekolah_info' },
            { data: 'alamat', name: 'alamat' },
            { data: 'total_daya_tampung', name: 'total_daya_tampung', className: 'text-center' },
            { data: 'status_pilihan_1', name: 'status_pilihan_1', orderable: false, searchable: false },
            { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-end' }
        ]
    });

    // Delete confirmation
    $(document).on('click', '.btn-delete', function(e) {
        e.preventDefault();
        var form = $(this).closest('form');
        var nama = $(this).data('nama');

        Swal.fire({
            text: "Apakah Anda yakin ingin menghapus " + nama + "?",
            icon: "warning",
            showCancelButton: true,
            buttonsStyling: false,
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Tidak, Batal",
            customClass: {
                confirmButton: "btn fw-bold btn-danger",
                cancelButton: "btn fw-bold btn-active-light-primary"
            }
        }).then(function(result) {
            if (result.value) {
                form.submit();
            }
        });
    });

    @if (session('success'))
        Swal.fire({
            text: "{{ session('success') }}",
            icon: "success",
            buttonsStyling: false,
            confirmButtonText: "Ok, Mengerti!",
            customClass: {
                confirmButton: "btn btn-primary"
            }
        });
    @endif

    @if (session('error'))
        Swal.fire({
            text: "{{ session('error') }}",
            icon: "error",
            buttonsStyling: false,
            confirmButtonText: "Ok, Mengerti!",
            customClass: {
                confirmButton: "btn btn-danger"
            }
        });
    @endif
});
</script>
@endsection
