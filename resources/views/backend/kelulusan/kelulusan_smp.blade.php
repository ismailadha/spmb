@extends('backend.main')

@section('kelulusan-smp-menu-active')
    active
@endsection

@section('kelulusan-menu-open')
    show
@endsection

@section('content')
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <h3 class="card-label">Data Kelulusan SMP</h3>
            </div>
            <!--begin::Card title-->
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
                    <select id="filter_jalur" class="form-select form-select-sm form-select-solid w-150px">
                        <option value="">Semua Jalur</option>
                        @foreach($semuaJalur as $j)
                            <option value="{{ $j->id }}">{{ $j->nama_jalur }}</option>
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
            <table class="table align-middle table-row-dashed fs-6 gy-5 min-w-full" id="kt_table_kelulusan">
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
    $('#kt_table_kelulusan').DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        ajax: {
            url: "{{ route('kelulusan.smp.data') }}",
            data: function (d) {
                d.periode_id = $('#filter_periode').val();
                d.jalur_id = $('#filter_jalur').val();
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

    // Handle Luluskan button click
    $(document).on('click', '.btn-luluskan', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        
        Swal.fire({
            title: 'Apakah hasil ini sudah benar?',
            text: "Anda akan meluluskan peserta ini!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Luluskan!',
            cancelButtonText: 'Batal',
            customClass: {
                confirmButton: "btn fw-bold btn-primary",
                cancelButton: "btn fw-bold btn-active-light-primary"
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Future implementation for graduation logic
                console.log('Luluskan peserta ID: ' + id);
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
    
    $('#filter_periode, #filter_jalur').change(function() {
        $('#kt_table_kelulusan').DataTable().ajax.reload();
    });
});
</script>
@endsection
