@extends('backend.main')

@section('peserta-smp-menu-active')
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
                <h3 class="card-label me-5">Data Peserta SMP</h3>
                <!--begin::Search-->

                <!--end::Search-->
            </div>
            <!--end::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Export Buttons-->
                <div class="d-flex align-items-center gap-2">
                    <button type="button" id="btn_export_excel" class="btn btn-sm btn-success d-flex align-items-center">
                        <i class="fas fa-file-excel fs-4 me-2"></i> Excel
                    </button>
                    <button type="button" id="btn_export_pdf" class="btn btn-sm btn-danger d-flex align-items-center">
                        <i class="fas fa-file-pdf fs-4 me-2"></i> PDF
                    </button>
                </div>
                <!--end::Export Buttons-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Filters-->
            <div class="d-flex flex-wrap align-items-center gap-2 gap-md-5 mb-5">
                <div class="d-flex align-items-center">
                    <label for="filter_periode" class="me-2 fw-bold text-muted">Periode:</label>
                    <select id="filter_periode" class="form-select form-select-sm form-select-solid w-125px">
                        @foreach($semuaPeriode as $p)
                            <option value="{{ $p->id }}" {{ ($periode && $periode->id == $p->id) ? 'selected' : '' }}>
                                {{ $p->tahun_ajaran }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex align-items-center">
                    <label for="filter_jalur" class="me-2 fw-bold text-muted">Jalur:</label>
                    <select id="filter_jalur" class="form-select form-select-sm form-select-solid w-150px">
                        <option value="">Semua Jalur</option>
                        @foreach($semuaJalur as $j)
                            <option value="{{ $j->id }}">{{ $j->nama_jalur }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex align-items-center">
                    <label for="filter_sekolah" class="me-2 fw-bold text-muted">Sekolah:</label>
                    <select id="filter_sekolah" class="form-select form-select-sm form-select-solid w-200px" data-control="select2" data-placeholder="Semua Sekolah" {{ in_array(auth()->user()->role, ['admin_sekolah', 'operator_sekolah']) ? 'disabled' : '' }}>
                        @if(!in_array(auth()->user()->role, ['admin_sekolah', 'operator_sekolah']))
                            <option value="">Semua Sekolah</option>
                        @endif
                        @foreach($semuaSekolah as $s)
                            <option value="{{ $s->id }}" {{ in_array(auth()->user()->role, ['admin_sekolah', 'operator_sekolah']) ? 'selected' : '' }}>{{ $s->nama_sekolah }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex align-items-center">
                    <label for="filter_status" class="me-2 fw-bold text-muted">Status:</label>
                    <select id="filter_status" class="form-select form-select-sm form-select-solid w-150px">
                        <option value="">Semua Status</option>
                        <option value="submit">Proses Verifikasi</option>
                        <option value="verifikasi">Terverifikasi</option>
                        <option value="lulus">Lulus</option>
                        <option value="perbaikan">Perbaikan</option>
                        <option value="draft">Draft</option>
                    </select>
                </div>
            </div>
            <!--end::Filters-->
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
        dom: 'lfrtip',
        ajax: {
            url: "{{ route('peserta.smp') }}",
            data: function (d) {
                d.periode_id = $('#filter_periode').val();
                d.jalur_id = $('#filter_jalur').val();
                d.sekolah_id = $('#filter_sekolah').val();
                d.status = $('#filter_status').val();
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, width: '10px' },
            { data: 'nomor_pendaftaran', name: 'nomor_pendaftaran' },
            { data: 'nama_lengkap', name: 'nama_lengkap' },
            { data: 'nama_jalur', name: 'nama_jalur', searchable: false },
            { data: 'jenjang', name: 'jenjang', searchable: false },
            { data: 'status', name: 'status', className: 'text-center', searchable: false },
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
    
    $('#filter_periode, #filter_jalur, #filter_sekolah, #filter_status').change(function() {
        $('#kt_table_peserta').DataTable().ajax.reload();
    });

    // Handle Export clicks
    $('#btn_export_excel').click(function() {
        let params = {
            periode_id: $('#filter_periode').val(),
            jalur_id: $('#filter_jalur').val(),
            sekolah_id: $('#filter_sekolah').val(),
            status: $('#filter_status').val(),
        };
        let url = "{{ route('peserta.smp.export.excel') }}?" + $.param(params);
        window.location.href = url;
    });

    $('#btn_export_pdf').click(function() {
        let params = {
            periode_id: $('#filter_periode').val(),
            jalur_id: $('#filter_jalur').val(),
            sekolah_id: $('#filter_sekolah').val(),
            status: $('#filter_status').val(),
        };
        let url = "{{ route('peserta.smp.export.pdf') }}?" + $.param(params);
        window.location.href = url;
    });
});
</script>
@endsection
