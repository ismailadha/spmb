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
                                <span data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Tahapan">
                                    <button type="button" class="btn btn-icon btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal_tahapan_{{ $jadwal->id }}">
                                        <i class="fas fa-list fs-4 text-white"></i>
                                    </button>
                                </span>
                                <a href="{{ route('jadwal.show', $jadwal->id) }}" class="btn btn-icon btn-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                    <i class="fas fa-eye fs-4 text-white"></i>
                                </a>
                                <a href="{{ route('jadwal.edit', $jadwal->id) }}" class="btn btn-icon btn-warning btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                    <i class="fas fa-edit fs-4 text-white"></i>
                                </a>
                                <form action="{{ route('jadwal.destroy', $jadwal->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data jadwal ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-icon btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
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

<!-- Modals for Tahapan -->
@foreach($jadwals as $jadwal)
<div class="modal fade" id="modal_tahapan_{{ $jadwal->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tahapan Pendaftaran - {{ $jadwal->nama_sekolah }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @php
                    $tahapans = \App\Models\JadwalTahapan::where('jadwal_id', $jadwal->id)->orderBy('tanggal_mulai', 'asc')->get();
                @endphp
                
                @if($tahapans->count() > 0)
                <div class="table-responsive mt-2">
                    <table class="table table-row-dashed align-middle gs-0 gy-3 my-0">
                        <thead>
                            <tr class="fs-7 fw-bolder text-gray-400 border-bottom-0">
                                <th class="p-0 pb-3 min-w-150px text-start">NAMA TAHAPAN</th>
                                <th class="p-0 pb-3 min-w-100px text-end">TGL MULAI</th>
                                <th class="p-0 pb-3 min-w-100px text-end">TGL SELESAI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tahapans as $tahapan)
                            <tr>
                                <td><span class="text-dark fw-bolder d-block mb-1 fs-6">{{ $tahapan->nama_tahapan }}</span></td>
                                <td class="text-end text-muted fw-bold">{{ \Carbon\Carbon::parse($tahapan->tanggal_mulai)->format('d M Y') }}</td>
                                <td class="text-end text-muted fw-bold">{{ \Carbon\Carbon::parse($tahapan->tanggal_selesai)->format('d M Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center pt-5 pb-5">
                    <span class="text-muted">Belum ada data tahapan untuk jadwal pendaftaran ini.</span>
                </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach

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
