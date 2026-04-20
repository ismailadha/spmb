@extends('backend.main')

@section('sambutan-menu-active')
    active
@endsection

@section('utilitas-menu-open')
    show
@endsection

@section('content')
    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <h3 class="card-label">Data Sambutan</h3>
            </div>
            <div class="card-toolbar">
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <a href="{{ route('sambutan.create') }}" class="btn btn-primary">
                        Add Sambutan
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body py-4">
            <div class="table-responsive">
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_sambutans">
                <thead>
                    <tr class="text-start text-dark-400 fw-bolder fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">No</th>
                        <th class="min-w-100px">ID</th>
                        <th class="min-w-125px">Nama Pejabat</th>
                        <th class="min-w-125px">Jabatan</th>
                        <th class="min-w-100px">Status</th>
                        <th class="text-end min-w-70px">Actions</th>
                    </tr>
                </thead>
                <tbody class="fw-bold text-gray-600">
                    @foreach ($sambutans as $index => $sambutan)
                        <tr class="align-middle">
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $sambutan->id }}</td>
                            <td>{{ $sambutan->nama_pejabat }}</td>
                            <td>{{ $sambutan->jabatan }}</td>
                            <td>
                                @if($sambutan->is_active)
                                    <span class="badge badge-light-success border border-success">Active</span>
                                @else
                                    <span class="badge badge-light-danger border border-danger">Inactive</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end flex-shrink-0">
                                    <a href="{{ url('sambutan/edit/' . $sambutan->id) }}" class="btn btn-warning btn-sm me-1">Edit</a>
                                    <form action="{{ url('sambutan/destroy/' . $sambutan->id) }}" method="POST" class="d-inline-block">
                                        @csrf
                                        <button type="button" class="btn btn-danger btn-sm delete-sambutan">Delete</button>
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
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#kt_table_sambutans').DataTable({
        responsive: true
    });

    $(document).on('click', '.delete-sambutan', function(e) {
        e.preventDefault();
        const form = $(this).closest('form');
        Swal.fire({
            text: "Apakah anda yakin ingin menghapus data sambutan ini?",
            icon: "warning",
            showCancelButton: true,
            buttonsStyling: false,
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Tidak, batalkan",
            customClass: {
                confirmButton: "btn btn-danger",
                cancelButton: "btn btn-active-light"
            }
        }).then(function(result) {
            if (result.value) {
                form.submit();
            }
        });
    });
});
</script>
@endsection
