@extends('backend.main')

@section('jadwal-menu-active')
    active
@endsection

@section('jadwal-menu-open')
    show
@endsection

@section('content')
<!--begin::Card-->
<div class="card">
    <div class="card-header border-0 pt-6">
        <div class="card-title">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">Daftar Jadwal Pendaftaran</span>
                <span class="text-muted mt-1 fw-bold fs-7">Seluruh jadwal yang telah dikonfigurasi</span>
            </h3>
        </div>
        <div class="card-toolbar">
            <a href="{{ route('jadwal.create') }}" class="btn btn-primary">
                <i class="fas fa-plus fs-4 me-2"></i>Tambah Jadwal
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
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_jadwal">
                <thead>
                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                        <th class="min-w-125px">Periode</th>
                        <th class="min-w-200px">Sekolah (Jalur)</th>
                        <th class="min-w-150px">Tanggal</th>
                        <th class="min-w-100px text-end">Kuota</th>
                        <th class="min-w-100px text-center">Status</th>
                        <th class="min-w-100px text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-bold">
                    @foreach($jadwals as $jadwal)
                    <tr>
                        <td>
                            <div class="fw-bolder text-dark">{{ $jadwal->tahun_ajaran }}</div>
                            <div class="text-muted fs-7">
                                {{ \Carbon\Carbon::parse($jadwal->periode_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($jadwal->periode_selesai)->format('d M Y') }}
                            </div>
                        </td>
                        <td>
                            <span class="fs-6 fw-bolder text-dark">{{ $jadwal->nama_sekolah }}</span><br/>
                            <span class="badge badge-light-primary">{{ $jadwal->nama_jalur }}</span>
                        </td>
                        <td>
                            <div class="badge badge-light-dark">
                                {{ \Carbon\Carbon::parse($jadwal->tanggal_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($jadwal->tanggal_selesai)->format('d M Y') }}
                            </div>
                        </td>
                        <td class="text-end text-primary fw-bolder">
                            {{ $jadwal->kuota }}
                        </td>
                        <td class="text-center">
                            @php
                                $statusEnum = strtolower($jadwal->status ?? 'draft');
                                
                                if ($statusEnum === 'open') {
                                    $statusText = 'Open';
                                    $statusClass = 'badge-light-success text-success';
                                } elseif ($statusEnum === 'selesai') {
                                    $statusText = 'Selesai';
                                    $statusClass = 'badge-light-danger text-danger';
                                } else {
                                    $statusText = 'Draft';
                                    $statusClass = 'badge-light-secondary text-muted';
                                }
                            @endphp
                            <span class="badge {{ $statusClass }} fw-bolder px-4 py-2">{{ $statusText }}</span>
                        </td>
                        <td class="text-end">
                            <div class="btn-group" role="group" aria-label="Aksi Jadwal">
                                <a href="#" class="btn btn-icon btn-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                    <i class="fas fa-eye fs-4 text-white"></i>
                                </a>
                                <a href="#" class="btn btn-icon btn-warning btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                    <i class="fas fa-edit fs-4 text-white"></i>
                                </a>
                                <a href="#" class="btn btn-icon btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                    <i class="fas fa-trash fs-4 text-white"></i>
                                </a>
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
    var table = $('#kt_table_jadwal').DataTable({
        scrollX: true,
        language: {
            emptyTable: "Belum ada data jadwal pendaftaran.",
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
            // Re-initialize tooltips on draw so they survive pagination
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        }
    });
});
</script>
@endsection
