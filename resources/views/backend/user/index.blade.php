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
        @if(session('success'))
            <div class="alert alert-success d-flex align-items-center p-5 mb-10">
                <div class="d-flex flex-column">
                    <h4 class="mb-1 text-success">Berhasil</h4>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_pengguna">
                <thead>
                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">No</th>
                        <th class="min-w-125px">Nama</th>
                        <th class="min-w-125px">NIK</th>
                        <th class="min-w-125px">Username</th>
                        <th class="min-w-100px text-center">Role</th>
                        <th class="min-w-100px text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-bold">
                    @foreach($pengguna as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="fw-bolder text-dark">{{ $item->name }}</div>
                            </td>
                            <td>{{ $item->nik ?? '-' }}</td>
                            <td>
                                <div class="badge badge-light-dark">{{ $item->username }}</div>
                            </td>
                            <td class="text-center">
                                @if(strtolower($item->role ?? '') === 'admin')
                                    <span class="badge badge-light-primary fw-bolder px-4 py-2">Admin</span>
                                @else
                                    <span class="badge badge-light-secondary fw-bolder px-4 py-2">{{ $item->role ?? 'User' }}</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="btn-group" role="group" aria-label="Aksi Pengguna">
                                    <a href="#" class="btn btn-icon btn-warning btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                        <i class="fas fa-edit fs-4 text-white"></i>
                                    </a>
                                    <form action="#" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-icon btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" onclick="if(confirm('Yakin ingin menghapus?')) this.form.submit()">
                                            <i class="fas fa-trash fs-4 text-white"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!--end::Card-->
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function() {
    var table = $('#kt_table_pengguna').DataTable({
        scrollX: true,
        language: {
            emptyTable: "Belum ada data pengguna.",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
            infoFiltered: "(disaring dari _MAX_ total data)",
            lengthMenu: "Tampilkan _MENU_ data",
            search: "Cari:",
            zeroRecords: "Data tidak ditemukan",
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
});
</script>
@endsection