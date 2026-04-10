@extends('backend.main')

@section('pengguna-menu-active')
    active
@endsection

@section('pengguna-menu-open')
    show
@endsection

@section('content')
<!--begin::Card-->
<div class="card">
    <div class="card-header border-0 pt-6">
        <div class="card-title">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">Daftar Pengguna</span>
                <span class="text-muted mt-1 fw-bold fs-7">Kelola data pengguna sistem</span>
            </h3>
        </div>
        <div class="card-toolbar">
            <a href="{{ route('pengguna.create') }}" class="btn btn-primary">
                <i class="fas fa-plus fs-4 me-2"></i>Tambah Pengguna
            </a>
        </div>
    </div>
    <div class="card-body py-4">
        <div class="table-responsive">
            <table class="table align-middle table-row-dashed fs-6 gy-5 min-w-full" id="kt_table_pengguna">
                <thead>
                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">No</th>
                        <th class="min-w-125px">Nama</th>
                        <th class="min-w-125px">Username</th>
                        <th class="min-w-100px text-center">Role</th>
                        <th class="min-w-100px text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-bold">
                    {{-- Populated by DataTables AJAX --}}
                </tbody>
            </table>
        </div>
    </div>
</div>
<!--end::Card-->
@endsection

@section('scripts')
{{-- Include CDN scripts as used in Sekolah index --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var table = $('#kt_table_pengguna').DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        ajax: "{{ route('pengguna.index') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'name', name: 'name' },
            { data: 'username', name: 'username' },
            { data: 'role', name: 'role', className: 'text-center' },
            { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-end' }
        ],
        language: {
            emptyTable: "Belum ada data pengguna.",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
            infoFiltered: "(disaring dari _MAX_ total data)",
            lengthMenu: "Tampilkan _MENU_ data",
            search: "Cari:",
            zeroRecords: "Data tidak ditemukan",
            loadingRecords: "Memuat data...",
            processing: "Sedang memproses...",
            paginate: {
                first: "Pertama",
                last: "Terakhir",
                next: "Selanjutnya",
                previous: "Sebelumnya"
            }
        },
        drawCallback: function(settings) {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        }
    });

    // Delete confirmation
    $(document).on('click', '.btn-delete', function(e) {
        e.preventDefault();
        var form = $(this).closest('form');
        var nama = $(this).data('nama');
        var role = $(this).data('role');

        var text = "Apakah Anda yakin ingin menghapus pengguna " + nama + "?";
        
        if (role === 'peserta') {
            text = "Apakah Anda yakin ingin menghapus pengguna " + nama + "? Data pendaftaran yang sudah terdaftar juga akan ikut terhapus.";
        }

        Swal.fire({
            text: text,
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
});
</script>
@endsection