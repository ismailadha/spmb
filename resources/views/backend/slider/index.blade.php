@extends('backend.main')

@section('slider-menu-active')
    active
@endsection

@section('utilitas-menu-open')
    show
@endsection

@section('content')
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <h3 class="card-label">Data Slider</h3>
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <a href="{{ route('slider.create') }}" class="btn btn-primary">
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor" />
                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor" />
                            </svg>
                        </span>
                        Add Slider
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
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_sliders">
                <!--begin::Table head-->
                <thead>
                    <!--begin::Table row-->
                    <tr class="text-start text-dark-400 fw-bolder fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">No</th>
                        <th class="min-w-125px">Caption</th>
                        <th class="min-w-125px">Image</th>
                        <th class="text-end min-w-70px">Actions</th>
                    </tr>
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody class="fw-bold text-gray-600">
                    @if ($sliders->isEmpty())
                        <tr>
                            <td colspan="4" class="text-center">No sliders found.</td>
                        </tr>
                    @else
                        @foreach ($sliders as $index => $slider)
                            <tr class="align-middle">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $slider->caption }}</td>
                                <td>
                                    <img src="{{ Str::startsWith($slider->gambar, ['http', '/']) ? $slider->gambar : asset('storage/' . $slider->gambar) }}" alt="Slider Image" class="img-fluid" style="max-width: 150px;">
                                </td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end flex-shrink-0">
                                        <a href="{{ url('slider/edit/' . $slider->id) }}" class="btn btn-warning btn-sm me-1">Edit</a>
                                        <form action="{{ url('slider/destroy/' . $slider->id) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            <button type="button" class="btn btn-danger btn-sm delete-slider">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
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
$(document).ready(function() {
    $('#kt_table_sliders').DataTable({
        responsive: true
    });

    $(document).on('click', '.delete-slider', function(e) {
        e.preventDefault();
        const form = $(this).closest('form');
        Swal.fire({
            text: "Apakah anda yakin ingin menghapus slider ini?",
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
