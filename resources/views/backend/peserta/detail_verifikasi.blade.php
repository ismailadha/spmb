@extends('backend.main')

@section('peserta-menu-active')
    active
@endsection

@section('peserta-menu-open')
    show
@endsection

@section('content')
<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Toolbar-->
    <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
        <div class="container-fluid d-flex flex-stack flex-wrap">
            <div class="page-title d-flex flex-column py-1">
                <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">Verifikasi Calon Peserta</h1>
            </div>
            <div class="d-flex align-items-center py-1">
                <a href="{{ route('peserta.sd') }}" class="btn btn-sm btn-secondary me-3">Kembali</a>
                <button class="btn btn-sm btn-danger me-3">Tolak Pendaftaran</button>
                @if($peserta->pendaftaran)
                <button type="button" class="btn btn-sm btn-warning me-3" data-bs-toggle="modal" data-bs-target="#modal_perbaikan">Minta Perbaikan</button>
                <form id="form-setuju-verifikasi-{{ $peserta->pendaftaran->id }}" action="{{ route('peserta.verifikasi.setuju', $peserta->pendaftaran->id) }}" method="POST">
                    @csrf
                </form>
                <button type="button" class="btn btn-sm btn-primary" onclick="confirmSetuju({{ $peserta->pendaftaran->id }})">Setujui & Verifikasi</button>
                @endif
            </div>
        </div>
    </div>
    <!--end::Toolbar-->

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            <div class="row g-5 g-xl-10">
                <!--begin::Left Column-->
                <div class="col-xl-4">
                    <!--begin::Summary Card-->
                    <div class="card mb-5 mb-xl-8">
                        <div class="card-body pt-15">
                            <div class="d-flex flex-center flex-column mb-5">
                                <div class="symbol symbol-100px symbol-circle mb-7">
                                    @php
                                        $pasfoto = $peserta->pendaftaran && $peserta->pendaftaran->berkas ? $peserta->pendaftaran->berkas->where('jenis_berkas', 'pasfoto')->first() : null;
                                    @endphp
                                    @if($pasfoto)
                                        <img src="{{ route('pendaftaran.berkas.show', $pasfoto->id) }}" alt="Foto Diri" style="object-fit: cover; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#modal_preview_{{ $pasfoto->id }}" />
                                    @else
                                        <img src="{{ asset('back/media/avatars/300-1.jpg') }}" alt="image" />
                                    @endif
                                </div>
                                <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bolder mb-1">{{ $peserta->nama_lengkap }}</a>
                                <div class="fs-5 fw-bold text-muted mb-6">{{ $peserta->pendaftaran->nomor_pendaftaran ?? 'Belum Ada No. Pendaftaran' }}</div>
                                <div class="d-flex flex-wrap flex-center">
                                    <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                                        <div class="fs-4 fw-bolder text-gray-700 text-center">
                                            @if($peserta->pendaftaran->status == 'submit')
                                                <span class="badge badge-light-warning fw-bolder px-4 py-3">Proses Verifikasi</span>
                                            @elseif($peserta->pendaftaran->status == 'verifikasi')
                                                <span class="badge badge-light-info fw-bolder px-4 py-3" style="background-color: #f3f1ff; color: #7239ea;">Terverifikasi</span>
                                            @elseif($peserta->pendaftaran->status == 'perbaikan')
                                                <span class="badge badge-light-warning fw-bolder px-4 py-3" style="background-color: #fff4e1; color: #ff8c00;">Perbaikan</span>
                                            @elseif($peserta->pendaftaran->status == 'lulus' || $peserta->pendaftaran->status == 'diterima')
                                                <span class="badge badge-light-success fw-bolder px-4 py-3" style="background-color: #e8fff3; color: #50cd89;">{{ $peserta->pendaftaran->status == 'lulus' ? 'Lulus' : 'Diterima' }}</span>
                                            @elseif($peserta->pendaftaran->status == 'ditolak')
                                                <span class="badge badge-light-danger fw-bolder px-4 py-3">Ditolak</span>
                                            @elseif($peserta->pendaftaran->status == 'draft')
                                                <span class="badge badge-light-primary fw-bolder px-4 py-3">Draft</span>
                                            @endif
                                        </div>
                                        <div class="fw-bold text-muted text-center fs-7">Status</div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex flex-stack fs-4 py-3">
                                <div class="fw-bolder rotate collapsible" data-bs-toggle="collapse" href="#kt_user_view_details" role="button" aria-expanded="false" aria-controls="kt_user_view_details">Details 
                                    <span class="ms-2 rotate-180">
                                        <span class="svg-icon svg-icon-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13583 5.75 8.55005C5.33579 8.96426 5.33579 9.63584 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13583 17.1642 8.13583 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <div class="separator separator-dashed my-3"></div>
                            <div id="kt_user_view_details" class="collapse show">
                                <div class="pb-5 fs-6">
                                    <div class="fw-bolder mt-5">NIK</div>
                                    <div class="text-gray-600">{{ $peserta->nik }}</div>
                                    <div class="fw-bolder mt-5">NISN</div>
                                    <div class="text-gray-600">{{ $peserta->nisn }}</div>
                                    <div class="fw-bolder mt-5">Gender</div>
                                    <div class="text-gray-600">
                                        @if($peserta->jenis_kelamin == 'L')
                                            Laki-laki
                                        @else
                                            Perempuan
                                        @endif
                                    </div>
                                    <div class="fw-bolder mt-5">Tempat/Tgl Lahir</div>
                                    <div class="text-gray-600">
                                        {{ $peserta->tempat_lahir }}, {{ \Carbon\Carbon::parse($peserta->tanggal_lahir)->isoFormat('D MMMM YYYY') }}
                                        @php
                                            $usia = $peserta->getUsiaSesuaiJenjang();
                                        @endphp
                                        @if($usia)
                                            <div class="mt-1">
                                                <span class="badge {{ $usia['is_valid'] ? 'badge-light-primary' : 'badge-light-danger' }} fw-bold">
                                                    {{ $usia['string'] }}
                                                </span>
                                                @if(!$usia['is_valid'])
                                                    <span class="text-danger fs-8 fw-bold ms-1"><i class="bi bi-exclamation-circle text-danger"></i> {{ $usia['message'] }}</span>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                    <div class="fw-bolder mt-5">Agama</div>
                                    <div class="text-gray-600">{{ $peserta->agama }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Left Column-->

                <!--begin::Right Column-->
                <div class="col-xl-8">
                    <div class="card mb-5 mb-xl-10">
                        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_pendaftaran_details" aria-expanded="true" aria-controls="kt_pendaftaran_details">
                            <div class="card-title m-0">
                                <h3 class="fw-bolder m-0">Informasi Pendaftaran</h3>
                            </div>
                        </div>
                        <div id="kt_pendaftaran_details" class="collapse show">
                            <div class="card-body border-top p-9">
                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-bold text-muted">Jalur Pendaftaran</label>
                                    <div class="col-lg-8">
                                        <span class="fw-bolder fs-6 text-gray-800">{{ $peserta->pendaftaran->jalur->nama_jalur ?? '-' }}</span>
                                    </div>
                                </div>
                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-bold text-muted">Jenjang</label>
                                    <div class="col-lg-8">
                                        <span class="fw-bolder fs-6 text-gray-800">{{ $peserta->pendaftaran->jenjang ?? '-' }}</span>
                                    </div>
                                </div>
                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-bold text-muted">Sekolah Pilihan 1</label>
                                    <div class="col-lg-8">
                                        <span class="fw-bolder fs-6 text-gray-800">{{ $peserta->pendaftaran->sekolahPilihan1->nama_sekolah ?? '-' }}</span>
                                        @if(isset($peserta->pendaftaran->jarak_sekolah_1))
                                            <div class="text-muted fs-7 mt-1"><i class="bi bi-geo fs-7 text-primary"></i> Jarak: {{ $peserta->pendaftaran->jarak_sekolah_1 }} km</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-bold text-muted">Sekolah Pilihan 2</label>
                                    <div class="col-lg-8">
                                        <span class="fw-bolder fs-6 text-gray-800">{{ $peserta->pendaftaran->sekolahPilihan2->nama_sekolah ?? '-' }}</span>
                                        @if(isset($peserta->pendaftaran->jarak_sekolah_2))
                                            <div class="text-muted fs-7 mt-1"><i class="bi bi-geo fs-7 text-info"></i> Jarak: {{ $peserta->pendaftaran->jarak_sekolah_2 }} km</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @if($peserta->pendaftaran->jalur_id == 3)
                    <div class="card mb-5 mb-xl-10">
                        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_penilaian_details" aria-expanded="true" aria-controls="kt_penilaian_details">
                            <div class="card-title m-0">
                                <h3 class="fw-bolder m-0">Penilaian Jalur Prestasi</h3>
                            </div>
                        </div>
                        <div id="kt_penilaian_details" class="collapse show">
                            <div class="card-body border-top p-9">
                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-bold text-muted">Rata-rata Rapor (NR)</label>
                                    <div class="col-lg-8">
                                        <input type="number" step="0.01" class="form-control form-control-solid input-penilaian" name="rata_rapor" id="rata_rapor" placeholder="0.00" value="{{ $peserta->pendaftaran->nilaiSeleksi->rata_rapor ?? '' }}" form="form-setuju-verifikasi-{{ $peserta->pendaftaran->id }}">
                                        <div class="text-muted fs-7 mt-1">Bobot: 40% (NR)</div>
                                    </div>
                                </div>
                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-bold text-muted">Nilai Tes Akademik (NHTKA)</label>
                                    <div class="col-lg-8">
                                        <input type="number" step="0.01" class="form-control form-control-solid input-penilaian" name="nilai_tes_akademik" id="nilai_tes_akademik" placeholder="0.00" value="{{ $peserta->pendaftaran->nilaiSeleksi->nilai_tes_akademik ?? '' }}" form="form-setuju-verifikasi-{{ $peserta->pendaftaran->id }}">
                                        <div class="text-muted fs-7 mt-1">Bobot: 30% (NHTKA)</div>
                                    </div>
                                </div>
                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-bold text-muted">Nilai Prestasi (NP)</label>
                                    <div class="col-lg-8">
                                        <input type="number" step="0.01" class="form-control form-control-solid input-penilaian" name="nilai_prestasi" id="nilai_prestasi" placeholder="0.00" value="{{ $peserta->pendaftaran->nilaiSeleksi->nilai_prestasi ?? '' }}" form="form-setuju-verifikasi-{{ $peserta->pendaftaran->id }}">
                                        <div class="text-muted fs-7 mt-1">Bobot: 30% (NP)</div>
                                    </div>
                                </div>
                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-bold text-muted">Nilai Akhir (NA)</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control form-control-solid bg-light" id="nilai_akhir" readonly value="{{ $peserta->pendaftaran->nilaiSeleksi->nilai_akhir ?? '0.00' }}">
                                        <div class="text-muted fs-7 mt-1">Formula: (NR * 40%) + (NHTKA * 30%) + (NP * 30%)</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="card mb-5 mb-xl-10">
                        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_alamat_details" aria-expanded="true" aria-controls="kt_alamat_details">
                            <div class="card-title m-0">
                                <h3 class="fw-bolder m-0">Alamat & Kontak</h3>
                            </div>
                        </div>
                        <div id="kt_alamat_details" class="collapse show">
                            <div class="card-body border-top p-9">
                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-bold text-muted">Provinsi</label>
                                    <div class="col-lg-8">
                                        <span class="fw-bolder fs-6 text-gray-800">{{ $peserta->provinsi->nama_provinsi ?? '-' }}</span>
                                    </div>
                                </div>
                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-bold text-muted">Kabupaten/Kota</label>
                                    <div class="col-lg-8">
                                        <span class="fw-bolder fs-6 text-gray-800">{{ $peserta->kabupaten->nama_kabupaten ?? '-' }}</span>
                                    </div>
                                </div>
                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-bold text-muted">Kecamatan</label>
                                    <div class="col-lg-8">
                                        <span class="fw-bolder fs-6 text-gray-800">{{ $peserta->kecamatan->nama_kecamatan ?? '-' }}</span>
                                    </div>
                                </div>
                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-bold text-muted">Desa/Kelurahan</label>
                                    <div class="col-lg-8">
                                        <span class="fw-bolder fs-6 text-gray-800">{{ $peserta->desa->nama_desa ?? '-' }}</span>
                                    </div>
                                </div>
                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-bold text-muted">Alamat Lengkap</label>
                                    <div class="col-lg-8">
                                        <span class="fw-bolder fs-6 text-gray-800">{{ $peserta->alamat }}</span>
                                    </div>
                                </div>
                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-bold text-muted">Koordinat</label>
                                    <div class="col-lg-8">
                                        <span class="fw-bolder fs-6 text-gray-800">{{ $peserta->latitude }}, {{ $peserta->longitude }}</span>
                                        <button type="button" class="btn btn-sm btn-light-primary ms-3" data-bs-toggle="modal" data-bs-target="#modal_map">Lihat Peta</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-5 mb-xl-10">
                        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_berkas_details" aria-expanded="true" aria-controls="kt_berkas_details">
                            <div class="card-title m-0">
                                <h3 class="fw-bolder m-0">Berkas Pendaftaran</h3>
                            </div>
                        </div>
                        <div id="kt_berkas_details" class="collapse show">
                            <div class="card-body border-top p-9">
                                <div class="table-responsive">
                                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                                        <thead>
                                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                <th class="min-w-125px">Jenis Berkas</th>
                                                <th class="min-w-125px">Status</th>
                                                <th class="text-end min-w-100px">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-gray-600 fw-bold">
                                            @foreach($peserta->pendaftaran->berkas as $file)
                                            <tr>
                                                <td>{{ ucwords(str_replace('_', ' ', $file->jenis_berkas)) }}</td>
                                                <td>
                                                    <span class="badge {{ $file->status_verifikasi == 'verified' ? 'badge-light-success' : ($file->status_verifikasi == 'rejected' ? 'badge-light-danger' : 'badge-light-warning') }} fw-bolder px-4 py-3">
                                                        {{ ucfirst($file->status_verifikasi) }}
                                                    </span>
                                                </td>
                                                <td class="text-end">
                                                    <button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-bs-toggle="modal" data-bs-target="#modal_preview_{{ $file->id }}">
                                                        <span class="svg-icon svg-icon-3">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="currentColor" />
                                                                <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM5 17.5C5 18.9 6.1 20 7.5 20C8.9 20 10 18.9 10 17.5C10 16.1 8.9 15 7.5 15C6.1 15 5 16.1 5 17.5Z" fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Modal Preview -->
                                            <div class="modal fade" id="modal_preview_{{ $file->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h2 class="fw-bolder">{{ ucwords(str_replace('_', ' ', $file->jenis_berkas)) }}</h2>
                                                            <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                                                                <span class="svg-icon svg-icon-1">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                                                        <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="modal-body scroll-y mx-5 my-7 text-center">
                                                            @php
                                                                $extension = pathinfo($file->file_path, PATHINFO_EXTENSION);
                                                            @endphp
                                                            @if(in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']))
                                                                <img src="{{ route('pendaftaran.berkas.show', $file->id) }}" class="img-fluid rounded shadow" alt="Preview">
                                                            @elseif(strtolower($extension) == 'pdf')
                                                                <iframe src="{{ route('pendaftaran.berkas.show', $file->id) }}" width="100%" height="600px" style="border: none;"></iframe>
                                                            @else
                                                                <div class="alert alert-warning">Preview tidak tersedia untuk format file ini. Silakan unduh berkas untuk melihat.</div>
                                                            @endif
                                                            <div class="mt-5">
                                                                <a href="{{ route('pendaftaran.berkas.show', $file->id) }}" target="_blank" class="btn btn-primary">Unduh / Lihat Jendela Baru</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Right Column-->
            </div>
        </div>
    </div>
    <!--end::Post-->
</div>

<!-- Modal Map -->
<div class="modal fade" id="modal_map" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bolder">Lokasi Tempat Tinggal</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                        </svg>
                    </span>
                </div>
            </div>
            <div class="modal-body p-0">
                <div id="map" style="height: 500px; width: 100%;"></div>
            </div>
            <div class="modal-footer">
                <div class="text-start flex-grow-1">
                    <span class="text-muted fw-bold">Koordinat:</span>
                    <span class="fw-bolder text-gray-800">{{ $peserta->latitude }}, {{ $peserta->longitude }}</span>
                </div>
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Perbaikan -->
<div class="modal fade" id="modal_perbaikan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bolder">Minta Perbaikan Pendaftaran</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                        </svg>
                    </span>
                </div>
            </div>
            <form action="{{ route('peserta.verifikasi.perbaikan', $peserta->pendaftaran->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label required fw-bold">Catatan Perbaikan</label>
                        <textarea class="form-control form-control-solid" name="catatan_perbaikan" rows="4" placeholder="Cantumkan bagian mana yang harus diperbaiki oleh pendaftar..." required></textarea>
                        <div class="text-muted fs-7 mt-2">Catatan ini akan dilihat oleh pendaftar pada halaman dashboard mereka.</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning">Kirim Permintaan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<script>
    function confirmSetuju(id) {
        Swal.fire({
            title: 'Konfirmasi Verifikasi',
            text: "Apakah Anda yakin ingin menyetujui dan memverifikasi pendaftaran ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Setujui!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('form-setuju-verifikasi-' + id).submit();
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const lat = {{ $peserta->latitude }};
        const lng = {{ $peserta->longitude }};
        
        let map;
        let marker;

        const modalMap = document.getElementById('modal_map');
        modalMap.addEventListener('shown.bs.modal', function () {
            if (!map) {
                map = L.map('map').setView([lat, lng], 15);
                
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                marker = L.marker([lat, lng]).addTo(map)
                    .bindPopup('Lokasi Tempat Tinggal Peserta')
                    .openPopup();
            } else {
                map.invalidateSize();
                map.setView([lat, lng], 15);
            }
        });
    });

    // Real-time calculation for Jalur Prestasi
    document.addEventListener('DOMContentLoaded', function() {
        const nrInput = document.getElementById('rata_rapor');
        const nhtkaInput = document.getElementById('nilai_tes_akademik');
        const npInput = document.getElementById('nilai_prestasi');
        const naInput = document.getElementById('nilai_akhir');

        if (nrInput && nhtkaInput && npInput) {
            function calculateNA() {
                const nr = parseFloat(nrInput.value) || 0;
                const nhtka = parseFloat(nhtkaInput.value) || 0;
                const np = parseFloat(npInput.value) || 0;

                const na = (nr * 0.4) + (nhtka * 0.3) + (np * 0.3);
                naInput.value = na.toFixed(2);
            }

            nrInput.addEventListener('input', calculateNA);
            nhtkaInput.addEventListener('input', calculateNA);
            npInput.addEventListener('input', calculateNA);
        }
    });
</script>
@endsection
