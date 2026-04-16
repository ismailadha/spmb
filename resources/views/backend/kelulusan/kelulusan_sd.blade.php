@extends('backend.main')

@section('kelulusan-sd-menu-active')
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
                <h3 class="card-label">Data Kelulusan SD</h3>
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <div class="d-flex align-items-center flex-wrap gap-3">
                    <div class="d-flex align-items-center">
                        <label for="filter_sekolah" class="me-2 fw-bold text-muted">Sekolah:</label>
                        <select id="filter_sekolah" class="form-select form-select-sm form-select-solid w-200px me-5" data-control="select2" data-placeholder="Semua Sekolah" {{ auth()->user()->role == 'admin_sekolah' ? 'disabled' : '' }}>
                            @if(auth()->user()->role != 'admin_sekolah')
                                <option value="">Semua Sekolah</option>
                            @endif
                            @foreach($semuaSekolah as $s)
                                <option value="{{ $s->id }}" {{ auth()->user()->role == 'admin_sekolah' ? 'selected' : '' }}>{{ $s->nama_sekolah }}</option>
                            @endforeach
                        </select>

                        <label for="filter_jalur" class="me-2 fw-bold text-muted">Jalur:</label>
                        <select id="filter_jalur" class="form-select form-select-sm form-select-solid w-150px me-5">
                            <option value="">Semua Jalur</option>
                            @foreach($semuaJalur as $j)
                                <option value="{{ $j->id }}">{{ $j->nama_jalur }}</option>
                            @endforeach
                        </select>

                        <div id="container_filter_pilihan" style="display: none;">
                            <div class="d-flex align-items-center">
                                <label for="filter_pilihan" class="me-2 fw-bold text-muted">Urutan:</label>
                                <select id="filter_pilihan" class="form-select form-select-sm form-select-solid w-150px">
                                    <option value="1" selected>Pilihan 1</option>
                                    <option value="2">Pilihan 2</option>
                                </select>
                            </div>
                        </div>

                        <button id="bulk-luluskan" type="button" class="btn btn-sm btn-primary" disabled>Luluskan</button>
                    </div>
                </div>
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
		<div class="card-body py-4">
            <!--begin::Quota Info-->
            <div id="quota_info_container" class="alert alert-dismissible bg-light-primary d-flex flex-column flex-sm-row p-5 mb-5" style="display: none !important;">
                <div class="d-flex flex-column pe-0 pe-sm-10">
                    <h5 class="mb-1 text-primary" id="quota_text">Daya Tampung: -</h5>
                    <span id="applicants_text">Total Pendaftar: -</span>
                </div>
            </div>
            <!--end::Quota Info-->

            <!--begin::Table-->
            <div class="table-responsive">
            <table class="table align-middle table-row-dashed fs-6 gy-5 min-w-full" id="kt_table_kelulusan">
                <!--begin::Table head-->
                <thead>
                    <tr class="text-start text-dark-400 fw-bolder fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2 text-center">
                            <input type="checkbox" id="select_all" />
                        </th>
                        <th class="w-10px pe-2">No</th>
                        <th class="min-w-125px">No. Pendaftaran</th>
                        <th class="min-w-150px">Nama Lengkap</th>
                        <th class="min-w-100px text-center">Hasil</th>
                        <th class="min-w-150px">Pilihan 1</th>
                        <th class="min-w-100px">Jarak 1 (km)</th>
                        <th class="min-w-150px col-pilihan2">Pilihan 2</th>
                        <th class="min-w-100px col-jarak2">Jarak 2 (km)</th>
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
    var table = $('#kt_table_kelulusan').DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        ordering: false,
        ajax: {
            url: "{{ route('kelulusan.sd.data') }}",
            data: function (d) {
                d.sekolah_id = $('#filter_sekolah').val();
                d.jalur_id = $('#filter_jalur').val();
                d.pilihan_ke = $('#filter_pilihan').val();
            }
        },
        columns: [
            {
                data: 'pendaftaran_id',
                name: 'pendaftaran_id',
                orderable: false,
                searchable: false,
                className: 'text-center',
                width: '20px',
                render: function(data, type) {
                    return '<input type="checkbox" class="row-checkbox" data-id="' + data + '">';
                }
            },
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, width: '10px' },
            {
                data: 'nomor_pendaftaran',
                name: 'nomor_pendaftaran',
                render: function(data, type, row) {
                    return '<a href="' + '{{ url("peserta/detail") }}/' + row.pendaftaran_id + '" target="_blank" class="text-primary fw-semibold">' + data + '</a>';
                }
            },
            { data: 'nama_lengkap', name: 'nama_lengkap' },
            { data: 'hasil', name: 'hasil', className: 'text-center' },
            { data: 'pilihan_1', name: 'pilihan_1' },
            { data: 'jarak_sekolah_1', name: 'jarak_sekolah_1' },
            { data: 'pilihan_2', name: 'pilihan_2' },
            { data: 'jarak_sekolah_2', name: 'jarak_sekolah_2' }
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
        },
        drawCallback: function(settings) {
            adjustColumnsVisibility();
            $('#select_all').prop('checked', false);
            updateBulkButton();

            // Update Quota Info
            var json = table.ajax.json();
            if (json && json.quota > 0) {
                $('#quota_text').text('Daya Tampung: ' + json.quota);
                $('#applicants_text').text('Total Pendaftar: ' + json.recordsFiltered);
                $('#quota_info_container').attr('style', 'display: flex !important;');
            } else {
                $('#quota_info_container').attr('style', 'display: none !important;');
            }

            // Hide bulk button if no data
            if (json && json.recordsFiltered === 0) {
                $('#bulk-luluskan').hide();
            } else {
                $('#bulk-luluskan').show();
            }
        }
    });

    function adjustColumnsVisibility() {
        var jalurId = $('#filter_jalur').val();
        var pilihanKe = $('#filter_pilihan').val();

        // Pilihan 2 columns are only visible if:
        // 1. Path is Domisili (1) AND Choice filter is Pilihan 2
        var showPilihan2 = (jalurId == '1' && pilihanKe == '2');

        table.column(6).visible(showPilihan2);
        table.column(7).visible(showPilihan2);
    }

    function updateBulkButton() {
        var selectedCount = $('.row-checkbox:checked').length;
        $('#bulk-luluskan').prop('disabled', selectedCount === 0);
    }

    $('#select_all').on('change', function() {
        var checked = $(this).is(':checked');
        $('.row-checkbox').prop('checked', checked);
        updateBulkButton();
    });

    $(document).on('change', '.row-checkbox', function() {
        var totalRows = $('.row-checkbox').length;
        var checkedRows = $('.row-checkbox:checked').length;
        $('#select_all').prop('checked', totalRows > 0 && totalRows === checkedRows);
        updateBulkButton();
    });

    $('#bulk-luluskan').on('click', function() {
        var selectedIds = $('.row-checkbox:checked').map(function() {
            return $(this).data('id');
        }).get();

        if (selectedIds.length === 0) {
            return;
        }

        Swal.fire({
            title: 'Luluskan peserta terpilih?',
            text: 'Anda akan meluluskan ' + selectedIds.length + ' peserta.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Luluskan!',
            cancelButtonText: 'Batal',
            customClass: {
                confirmButton: 'btn fw-bold btn-primary',
                cancelButton: 'btn fw-bold btn-active-light-primary'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                console.log('Bulk luluskan peserta:', selectedIds);
                // Future implementation: kirim selectedIds ke server untuk diproses
            }
        });
    });

    function adjustFiltersVisibility() {
        var jalurId = $('#filter_jalur').val();
        // Show choice filter ONLY if Domisili (1)
        if (jalurId == '1') {
            $('#container_filter_pilihan').fadeIn();
        } else {
            $('#container_filter_pilihan').fadeOut();
            $('#filter_pilihan').val("1"); // Reset to Pilihan 1 if hidden
        }
    }

    // Initial visibility check
    adjustFiltersVisibility();

    $('#filter_sekolah, #filter_jalur, #filter_pilihan').change(function() {
        if (this.id === 'filter_jalur') {
            adjustFiltersVisibility();
        }
        table.ajax.reload();
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

    $('#filter_sekolah, #filter_jalur').change(function() {
        $('#kt_table_kelulusan').DataTable().ajax.reload();
    });
});
</script>
@endsection
