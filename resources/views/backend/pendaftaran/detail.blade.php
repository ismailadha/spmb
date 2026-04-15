@extends('backend.main')

@section('content')
    <div class="mb-5">
        @if (session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif
    </div>

    @if ($pendaftaran)
        <!--begin::Navbar-->
        <div class="card mb-5 mb-xl-10">
            <div class="card-body pt-9 pb-0">
                <!--begin::Details-->
                <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                    <!--begin: Pic-->
                    <div class="me-7 mb-4">
                        <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                            @php
                                $pasfoto = isset($berkas) ? $berkas->where('jenis_berkas', 'pasfoto')->first() : null;
                            @endphp
                            @if($pasfoto)
                                <img src="{{ route('pendaftaran.berkas.show', $pasfoto->id) }}" alt="Foto Diri" style="object-fit: cover; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#modal_preview_{{ $pasfoto->id }}" />
                            @else
                                <img src="{{ asset('back/media/avatars/blank.png') }}" alt="image" />
                            @endif
                            <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-white h-20px w-20px"></div>
                        </div>
                    </div>
                    <!--end::Pic-->
                    <!--begin::Info-->
                    <div class="flex-grow-1">
                        <!--begin::Title-->
                        <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                            <!--begin::User-->
                            <div class="d-flex flex-column">
                                <!--begin::Name-->
                                <div class="d-flex align-items-center mb-2">
                                    <span class="text-gray-900 fs-2 fw-bolder me-1">{{ $pendaftaran->nama_lengkap }}</span>
                                    {{-- Jika status pendaftaran adalah submit, maka tampilkan badge --}}
                                    @if ($pendaftaran->status == 'submit')
                                        <span class="badge badge-light-success fw-bolder ms-2 fs-8 py-1 px-3">Proses Verifikasi</span>
                                    @elseif ($pendaftaran->status == 'verifikasi')
                                        <span class="badge badge-light-danger fw-bolder ms-2 fs-8 py-1 px-3">Terverifikasi</span>
                                    @elseif ($pendaftaran->status == 'perbaikan')
                                        <span class="badge badge-light-success fw-bolder ms-2 fs-8 py-1 px-3">Perbaikan Berkas</span>
                                    @elseif ($pendaftaran->status == 'lulus')
                                        <span class="badge badge-light-success fw-bolder ms-2 fs-8 py-1 px-3">Lulus</span>
                                    @elseif ($pendaftaran->status == 'tidak_lulus')
                                        <span class="badge badge-light-danger fw-bolder ms-2 fs-8 py-1 px-3">Tidak Lulus</span>
                                    @endif
                                </div>
                                <!--end::Name-->
                                <!--begin::Info-->
                                <div class="d-flex flex-wrap fw-bold fs-6 mb-4 pe-2">
                                    <span class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                        <i class="bi bi-person-badge fs-4 me-1"></i>NISN: {{ $pendaftaran->nisn }}
                                    </span>
                                    <span class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                        <i class="bi bi-geo-alt fs-4 me-1"></i>{{ $pendaftaran->nama_kecamatan }}, {{ $pendaftaran->nama_kabupaten }}
                                    </span>
                                    <span class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                                        <i class="bi bi-calendar-check fs-4 me-1"></i>Terdaftar: {{ \Carbon\Carbon::parse($pendaftaran->tanggal_daftar)->isoFormat('D MMMM YYYY') }}
                                    </span>
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::User-->
                        </div>
                        <!--end::Title-->
                        <!--begin::Stats-->
                        <div class="d-flex flex-wrap flex-stack">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-column flex-grow-1 pe-8">
                                <!--begin::Stats-->
                                <div class="d-flex flex-wrap">
                                    <!--begin::Stat-->
                                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                        <!--begin::Number-->
                                        <div class="d-flex align-items-center">
                                            <div class="fs-2 fw-bolder">{{ $pendaftaran->nomor_pendaftaran ?? 'Menunggu...' }}</div>
                                        </div>
                                        <!--end::Number-->
                                        <!--begin::Label-->
                                        <div class="fw-bold fs-6 text-gray-400">Nomor Pendaftaran</div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Stat-->
                                    <!--begin::Stat-->
                                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                        <!--begin::Number-->
                                        <div class="d-flex align-items-center">
                                            <div class="fs-2 fw-bolder">{{ $pendaftaran->nama_jalur }}</div>
                                        </div>
                                        <!--end::Number-->
                                        <!--begin::Label-->
                                        <div class="fw-bold fs-6 text-gray-400">Jalur Pendaftaran</div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Stat-->
                                    <!--begin::Stat-->
                                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                        <!--begin::Number-->
                                        <div class="d-flex align-items-center">
                                            <div class="fs-2 fw-bolder">{{ $pendaftaran->jenjang }}</div>
                                        </div>
                                        <!--end::Number-->
                                        <!--begin::Label-->
                                        <div class="fw-bold fs-6 text-gray-400">Jenjang</div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Stat-->
                                    <!--begin::Stat-->
                                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                        <!--begin::Number-->
                                        <div class="d-flex align-items-center">
                                            <div class="fs-2 fw-bolder">{{ $pendaftaran->pilihan_1 }}</div>
                                        </div>
                                        <!--end::Number-->
                                        <!--begin::Label-->
                                        <div class="fw-bold fs-6 text-gray-400">Pilihan 1</div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Stat-->
                                    @if($pendaftaran->pilihan_2)
                                    <!--begin::Stat-->
                                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                        <!--begin::Number-->
                                        <div class="d-flex align-items-center">
                                            <div class="fs-2 fw-bolder">{{ $pendaftaran->pilihan_2 }}</div>
                                        </div>
                                        <!--end::Number-->
                                        <!--begin::Label-->
                                        <div class="fw-bold fs-6 text-gray-400">Pilihan 2</div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Stat-->
                                    @endif
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Stats-->
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::Details-->
            </div>
        </div>
        <!--end::Navbar-->

        <!--begin::Row-->
        <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
            <!--begin::Col-->
            <div class="col-xl-8">
                <!--begin::List Widget 4-->
                <div class="card card-xl-stretch mb-xl-8">
                    <!--begin::Header-->
                    <div class="card-header border-0">
                        <h3 class="card-title fw-bolder text-dark">Data Pribadi</h3>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-2">
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle">
                                <tbody>
                                    <tr>
                                        <td class="ps-0">
                                            <span class="text-muted fw-bolder d-block fs-7">NIK</span>
                                        </td>
                                        <td class="pe-0">
                                            <span class="text-dark fw-bolder d-block fs-6">{{ $pendaftaran->nik }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-0">
                                            <span class="text-muted fw-bolder d-block fs-7">NISN</span>
                                        </td>
                                        <td class="pe-0">
                                            <span class="text-dark fw-bolder d-block fs-6">{{ $pendaftaran->nisn }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-0">
                                            <span class="text-muted fw-bolder d-block fs-7">Nama Lengkap</span>
                                        </td>
                                        <td class="pe-0">
                                            <span class="text-dark fw-bolder d-block fs-6">{{ $pendaftaran->nama_lengkap }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-0">
                                            <span class="text-muted fw-bolder d-block fs-7">Jenis Kelamin</span>
                                        </td>
                                        <td class="pe-0">
                                            <span class="text-dark fw-bolder d-block fs-6">{{ $pendaftaran->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-0">
                                            <span class="text-muted fw-bolder d-block fs-7">Tempat Lahir</span>
                                        </td>
                                        <td class="pe-0">
                                            <span class="text-dark fw-bolder d-block fs-6">{{ $pendaftaran->tempat_lahir }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-0">
                                            <span class="text-muted fw-bolder d-block fs-7">Tanggal Lahir</span>
                                        </td>
                                        <td class="pe-0">
                                            <span class="text-dark fw-bolder d-block fs-6">{{ \Carbon\Carbon::parse($pendaftaran->tanggal_lahir)->isoFormat('D MMMM YYYY') }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-0">
                                            <span class="text-muted fw-bolder d-block fs-7">Agama</span>
                                        </td>
                                        <td class="pe-0">
                                            <span class="text-dark fw-bolder d-block fs-6">{{ $pendaftaran->agama }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-0">
                                            <span class="text-muted fw-bolder d-block fs-7">Alamat</span>
                                        </td>
                                        <td class="pe-0">
                                            <span class="text-dark fw-bolder d-block fs-6">{{ $pendaftaran->alamat }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-0">
                                            <span class="text-muted fw-bolder d-block fs-7">Provinsi</span>
                                        </td>
                                        <td class="pe-0">
                                            <span class="text-dark fw-bolder d-block fs-6">{{ $pendaftaran->nama_provinsi }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-0">
                                            <span class="text-muted fw-bolder d-block fs-7">Kabupaten</span>
                                        </td>
                                        <td class="pe-0">
                                            <span class="text-dark fw-bolder d-block fs-6">{{ $pendaftaran->nama_kabupaten }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-0">
                                            <span class="text-muted fw-bolder d-block fs-7">Kecamatan</span>
                                        </td>
                                        <td class="pe-0">
                                            <span class="text-dark fw-bolder d-block fs-6">{{ $pendaftaran->nama_kecamatan }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-0">
                                            <span class="text-muted fw-bolder d-block fs-7">Desa</span>
                                        </td>
                                        <td class="pe-0">
                                            <span class="text-dark fw-bolder d-block fs-6">{{ $pendaftaran->nama_desa }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-0">
                                            <span class="text-muted fw-bolder d-block fs-7">No. HP</span>
                                        </td>
                                        <td class="pe-0">
                                            <span class="text-dark fw-bolder d-block fs-6">{{ $pendaftaran->no_hp }}</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::List Widget 4-->
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-4">
                <!--begin::List Widget 3-->
                <div class="card card-xl-stretch mb-5 mb-xl-8">
                    <!--begin::Header-->
                    <div class="card-header border-0">
                        <h3 class="card-title fw-bolder text-dark">Data Orang Tua / Wali</h3>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-2">
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle">
                                <tbody>
                                    <tr>
                                        <td class="ps-0">
                                            <span class="text-muted fw-bolder d-block fs-7">Nama Ayah</span>
                                        </td>
                                        <td class="pe-0">
                                            <span class="text-dark fw-bolder d-block fs-6">{{ $pendaftaran->nama_ayah ?? '-' }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-0">
                                            <span class="text-muted fw-bolder d-block fs-7">Pekerjaan Ayah</span>
                                        </td>
                                        <td class="pe-0">
                                            <span class="text-dark fw-bolder d-block fs-6">{{ $pendaftaran->pekerjaan_ayah ?? '-' }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-0">
                                            <span class="text-muted fw-bolder d-block fs-7">Nama Ibu</span>
                                        </td>
                                        <td class="pe-0">
                                            <span class="text-dark fw-bolder d-block fs-6">{{ $pendaftaran->nama_ibu ?? '-' }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-0">
                                            <span class="text-muted fw-bolder d-block fs-7">Pekerjaan Ibu</span>
                                        </td>
                                        <td class="pe-0">
                                            <span class="text-dark fw-bolder d-block fs-6">{{ $pendaftaran->pekerjaan_ibu ?? '-' }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-0">
                                            <span class="text-muted fw-bolder d-block fs-7">Alamat</span>
                                        </td>
                                        <td class="pe-0">
                                            <span class="text-dark fw-bolder d-block fs-6">{{ $pendaftaran->alamat_orang_tua ?? '-' }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-0">
                                            <span class="text-muted fw-bolder d-block fs-7">No. HP</span>
                                        </td>
                                        <td class="pe-0">
                                            <span class="text-dark fw-bolder d-block fs-6">{{ $pendaftaran->no_hp_orang_tua ?? '-' }}</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::List Widget 3-->
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

        <!--begin::Row-->
        <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
            <!--begin::Col-->
            <div class="col-xl-12">
                <!--begin::List Widget 5-->
                <div class="card card-xl-stretch mb-xl-8">
                    <!--begin::Header-->
                    <div class="card-header border-0">
                        <h3 class="card-title fw-bolder text-dark">Berkas Pendaftaran</h3>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-2">
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle">
                                <tbody>
                                    @foreach($berkas as $item)
                                    <tr>
                                        <td class="ps-0">
                                            <span class="text-muted fw-bolder d-block fs-7">{{ ucwords(str_replace('_', ' ', $item->jenis_berkas)) }}</span>
                                        </td>
                                        <td class="pe-0">
                                            <a href="{{ route('pendaftaran.berkas.show', $item->id) }}" target="_blank" class="text-primary fw-semibold fs-7 qtext-hover-underline">Lihat Dokumen</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::List Widget 5-->
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    @endif

    @if(isset($berkas))
    @foreach($berkas as $item)
    <!-- Modal Preview -->
    <div class="modal fade" id="modal_preview_{{ $item->id }}" tabindex="-1" aria-labelledby="modal_preview_label_{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_preview_label_{{ $item->id }}">{{ ucwords(str_replace('_', ' ', $item->jenis_berkas)) }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if(in_array($item->jenis_berkas, ['pasfoto', 'akta_lahir', 'kk', 'ktp_orang_tua', 'kartu_pkh', 'surat_dokter', 'surat_pindah', 'dokumen_tka', 'sertifikat_penghargaan']))
                        <img src="{{ route('pendaftaran.berkas.show', $item->id) }}" class="img-fluid rounded shadow" alt="Preview">
                    @else
                        <iframe src="{{ route('pendaftaran.berkas.show', $item->id) }}" width="100%" height="600px" style="border: none;"></iframe>
                    @endif
                </div>
                <div class="modal-footer">
                    <a href="{{ route('pendaftaran.berkas.show', $item->id) }}" target="_blank" class="btn btn-primary">Unduh / Lihat Jendela Baru</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @endif
@endsection
