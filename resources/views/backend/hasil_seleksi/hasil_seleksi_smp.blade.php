@extends('backend.main')

@section('hasil-seleksi-smp-menu-active')
    active
@endsection

@section('hasil-seleksi-menu-open')
    show
@endsection

@section('content')
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <h3 class="card-label">Daftar Hasil Seleksi Lulus - SMP</h3>
            </div>
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Export Buttons-->
                <div class="d-flex align-items-center gap-2">
                    <button type="button" id="btn_export_excel" class="btn btn-sm btn-success d-flex align-items-center">
                        <i class="fas fa-file-excel fs-4 me-2"></i> Excel
                    </button>
                    {{-- <button type="button" id="btn_export_pdf" class="btn btn-sm btn-danger d-flex align-items-center">
                        <i class="fas fa-file-pdf fs-4 me-2"></i> PDF
                    </button> --}}
                </div>
                <!--end::Export Buttons-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->

        <!--begin::Filters Card body-->
        <div class="card-body pt-0 pb-5">
            <div class="d-flex flex-wrap align-items-center gap-2 gap-md-5">
                <!--begin::Filter Jalur-->
                <div class="d-flex align-items-center">
                    <label class="me-2 fw-bold text-muted">Jalur:</label>
                    <select id="filter_jalur" class="form-select form-select-sm form-select-solid w-200px" data-control="select2" data-placeholder="Filter Jalur" data-allow-clear="true">
                        <option value="">Semua Jalur</option>
                        @foreach($jalur as $j)
                            <option value="{{ $j->id }}">{{ $j->nama_jalur }}</option>
                        @endforeach
                    </select>
                </div>
                <!--end::Filter Jalur-->

                <!--begin::Filter Sekolah-->
                <div class="d-flex align-items-center">
                    <label class="me-2 fw-bold text-muted">Sekolah:</label>
                    <select id="filter_sekolah" class="form-select form-select-sm form-select-solid w-250px" data-control="select2" data-placeholder="Filter Sekolah" {{ auth()->user()->role == 'admin_sekolah' ? '' : 'data-allow-clear=true' }}>
                        @if(auth()->user()->role != 'admin_sekolah')
                            <option value="">Semua Sekolah</option>
                        @endif
                        @foreach($sekolah as $s)
                            <option value="{{ $s->id }}" {{ auth()->user()->sekolah_id == $s->id ? 'selected' : '' }}>{{ $s->nama_sekolah }}</option>
                        @endforeach
                    </select>
                </div>
                <!--end::Filter Sekolah-->
            </div>
        </div>

        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Table-->
            <div class="table-responsive">
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_hasil_seleksi">
                    <thead>
                        <tr class="text-start text-dark-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th class="w-10px pe-2">No</th>
                            <th class="min-w-125px">No. Pendaftaran</th>
                            <th class="min-w-200px">Peserta</th>
                            <th class="min-w-150px">Jalur Seleksi</th>
                            <th class="min-w-200px">Sekolah Diterima</th>
                            <th class="min-w-100px">Skor Usia</th>
                            <th class="min-w-100px">Skor Jarak</th>
                            <th class="min-w-125px">Skor Akhir</th>
                            <th class="text-end min-w-125px">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="fw-bold text-gray-600">
                        <!-- Data loaded via AJAX -->
                    </tbody>
                </table>
            </div>
            <!--end::Table-->

            <!--begin::Note-->
            <div class="mt-5">
                <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed p-4">
                    <i class="ki-duotone ki-information-5 fs-2tx text-primary me-4">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                    </i>
                    <div class="d-flex flex-stack flex-grow-1">
                        <div class="fw-semibold">
                            <div class="fs-6 text-gray-700">
                                <strong class="text-dark">Informasi Perhitungan:</strong> 
                                Skor Akhir untuk jalur selain Prestasi dihitung berdasarkan <strong>Skor Usia + Skor Jarak</strong>. 
                                Untuk Jalur Prestasi, skor akhir dihitung berdasarkan komponen penilaian prestasi masing-masing.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Note-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function() {
    var table = $('#kt_table_hasil_seleksi').DataTable({
        processing: true,
        serverSide: true,
        dom: 'lfrtip',
        ajax: {
            url: "{{ route('hasil-seleksi.smp') }}",
            data: function (d) {
                d.jalur_id = $('#filter_jalur').val();
                d.sekolah_id = $('#filter_sekolah').val();
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'nomor_pendaftaran', name: 'nomor_pendaftaran' },
            { data: 'peserta_info', name: 'peserta_info' },
            { data: 'jalur_info', name: 'jalur_info', searchable: false },
            { data: 'sekolah_info', name: 'sekolah_info', searchable: false },
            { 
                data: 'skor_usia', 
                name: 'nilaiSeleksi.skor_usia',
                searchable: false,
                render: function(data, type, row) {
                    if (row.jalur_id == 3) return '-';
                    return row.nilai_seleksi ? row.nilai_seleksi.skor_usia : '-';
                }
            },
            { 
                data: 'skor_jarak', 
                name: 'nilaiSeleksi.skor_jarak',
                searchable: false,
                render: function(data, type, row) {
                    if (row.jalur_id == 3) return '-';
                    if (!row.nilai_seleksi) return '-';
                    return row.sekolah_diterima_id == row.sekolah_pilihan_2 ? row.nilai_seleksi.skor_jarak_2 : row.nilai_seleksi.skor_jarak;
                }
            },
            { 
                data: 'nilai_akhir', 
                name: 'nilaiSeleksi.nilai_akhir',
                searchable: false,
                render: function(data, type, row) {
                    return row.nilai_seleksi ? row.nilai_seleksi.nilai_akhir : '-';
                }
            },
            { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-end' }
        ]
    });

    $('#filter_jalur, #filter_sekolah').on('change', function () {
        table.draw();
    });

    // Handle Export clicks
    $('#btn_export_excel').click(function() {
        let params = {
            jalur_id: $('#filter_jalur').val(),
            sekolah_id: $('#filter_sekolah').val(),
        };
        let url = "{{ route('hasil-seleksi.smp.export.excel') }}?" + $.param(params);
        window.location.href = url;
    });

    $('#btn_export_pdf').click(function() {
        let params = {
            jalur_id: $('#filter_jalur').val(),
            sekolah_id: $('#filter_sekolah').val(),
        };
        let url = "{{ route('hasil-seleksi.smp.export.pdf') }}?" + $.param(params);
        window.location.href = url;
    });
});
</script>
@endsection
