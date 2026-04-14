@extends('backend.main')

@section('pendaftaran-menu-active', 'active')

@section('content')
    <div class="mb-5">
        @if (session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif
    </div>

    @if ($pendaftaran && $pendaftaran->status == 'submit')
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
                            <!--begin::Actions-->
                            <div class="d-flex my-4">
                                <a href="{{ route('pendaftaran.print', $pendaftaran->id) }}" target="_blank" class="btn btn-sm btn-primary me-2">
                                    <i class="bi bi-printer fs-4 me-1"></i>Cetak Kartu
                                </a>
                            </div>
                            <!--end::Actions-->
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
                                            <div class="fs-2 fw-bolder">{{ strtoupper($pendaftaran->jenjang) }}</div>
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
                                            <div class="fs-2 fw-bolder text-primary">{{ $pendaftaran->nama_jalur }}</div>
                                        </div>
                                        <!--end::Number-->
                                        <!--begin::Label-->
                                        <div class="fw-bold fs-6 text-gray-400">Jalur Masuk</div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Stat-->
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

        <!--begin::details View-->
        <div class="row g-5 g-xl-10">
            <!--begin::Col-->
            <div class="col-xl-6">
                <!--begin::Card-->
                <div class="card card-flush h-lg-100">
                    <!--begin::Card header-->
                    <div class="card-header pt-7">
                        <!--begin::Title-->
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bolder text-dark">Data Diri Peserta</span>
                            <span class="text-gray-400 mt-1 fw-bold fs-7">Informasi lengkap identitas siswa</span>
                        </h3>
                        <!--end::Title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-5">
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">Nama Lengkap</label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800">{{ $pendaftaran->nama_lengkap }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">NIK</label>
                            <div class="col-lg-8 fv-row">
                                <span class="fw-bold text-gray-800 fs-6">{{ $pendaftaran->nik }}</span>
                            </div>
                        </div>
                         <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">NISN</label>
                            <div class="col-lg-8 fv-row">
                                <span class="fw-bold text-gray-800 fs-6">{{ $pendaftaran->nisn }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">Tempat, Tgl Lahir</label>
                            <div class="col-lg-8">
                                <span class="fw-bold text-gray-800 fs-6">{{ $pendaftaran->tempat_lahir }}, {{ \Carbon\Carbon::parse($pendaftaran->tanggal_lahir)->isoFormat('D MMMM YYYY') }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">Jenis Kelamin</label>
                            <div class="col-lg-8">
                                <span class="fw-bold text-gray-800 fs-6">{{ $pendaftaran->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">Agama</label>
                            <div class="col-lg-8">
                                <span class="fw-bold text-gray-800 fs-6">{{ $pendaftaran->agama }}</span>
                            </div>
                        </div>
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-xl-6">
                 <!--begin::Card-->
                 <div class="card card-flush h-lg-100">
                    <!--begin::Card header-->
                    <div class="card-header pt-7">
                        <!--begin::Title-->
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bolder text-dark">Alamat & Domisili</span>
                            <span class="text-gray-400 mt-1 fw-bold fs-7">Informasi tempat tinggal peserta saat ini</span>
                        </h3>
                        <!--end::Title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-5">
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">Alamat Lengkap</label>
                            <div class="col-lg-8">
                                <span class="fw-bold text-gray-800 fs-6">{{ $pendaftaran->alamat }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">Desa/Kelurahan</label>
                            <div class="col-lg-8 fv-row">
                                <span class="fw-bold text-gray-800 fs-6">{{ $pendaftaran->nama_desa }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">Kecamatan</label>
                            <div class="col-lg-8 fv-row">
                                <span class="fw-bold text-gray-800 fs-6">{{ $pendaftaran->nama_kecamatan }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">Kabupaten/Kota</label>
                            <div class="col-lg-8">
                                <span class="fw-bold text-gray-800 fs-6">{{ $pendaftaran->nama_kabupaten }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">Provinsi</label>
                            <div class="col-lg-8">
                                <span class="fw-bold text-gray-800 fs-6">{{ $pendaftaran->nama_provinsi }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">No. Kartu Keluarga</label>
                            <div class="col-lg-8">
                                <span class="fw-bold text-gray-800 fs-6">{{ $pendaftaran->nomor_kk }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-xl-6">
                <div class="card card-flush h-lg-100">
                    <div class="card-header pt-7">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bolder text-dark">Data Orang Tua / Wali</span>
                            <span class="text-gray-400 mt-1 fw-bold fs-7">Informasi penanggung jawab peserta</span>
                        </h3>
                    </div>
                    <div class="card-body pt-5">
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">Nama Wali</label>
                            <div class="col-lg-8">
                                <span class="fw-bold text-gray-800 fs-6">{{ $pendaftaran->nama_wali }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">Pekerjaan</label>
                            <div class="col-lg-8">
                                <span class="fw-bold text-gray-800 fs-6">{{ $pendaftaran->pekerjaan_wali }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">Nomor HP / WhatsApp</label>
                            <div class="col-lg-8">
                                <span class="fw-bold text-gray-800 fs-6">{{ $pendaftaran->no_hp }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">Alamat Wali</label>
                            <div class="col-lg-8">
                                <span class="fw-bold text-gray-800 fs-6">{{ $pendaftaran->alamat_wali }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-xl-6">
                <div class="card card-flush h-lg-100">
                    <div class="card-header pt-7">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bolder text-dark">Sekolah Pilihan</span>
                            <span class="text-gray-400 mt-1 fw-bold fs-7">Daftar sekolah yang dipilih oleh peserta</span>
                        </h3>
                    </div>
                    <div class="card-body pt-5">
                        <!--begin::Item-->
                        <div class="d-flex align-items-center mb-7">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-50px me-5">
                                <span class="symbol-label bg-light-primary">
                                    <i class="bi bi-bank fs-2x text-primary"></i>
                                </span>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Text-->
                            <div class="d-flex flex-column">
                                <span class="text-dark fw-bolder text-hover-primary fs-6">Pilihan 1</span>
                                <span class="text-muted fw-bold">{{ $pendaftaran->sekolah_pilihan_1_nama ?? '-' }}</span>
                                <span class="text-gray-500 fs-7 mt-1"><i class="bi bi-geo fs-6 text-primary"></i> Jarak: {{ $pendaftaran->jarak_sekolah_1 ? $pendaftaran->jarak_sekolah_1 . ' km' : '-' }}</span>
                            </div>
                            <!--end::Text-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="d-flex align-items-center mb-7">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-50px me-5">
                                <span class="symbol-label bg-light-info">
                                    <i class="bi bi-bank fs-2x text-info"></i>
                                </span>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Text-->
                            <div class="d-flex flex-column">
                                <span class="text-dark fw-bolder text-hover-primary fs-6">Pilihan 2</span>
                                <span class="text-muted fw-bold">{{ $pendaftaran->sekolah_pilihan_2_nama ?? '-' }}</span>
                                <span class="text-gray-500 fs-7 mt-1"><i class="bi bi-geo fs-6 text-info"></i> Jarak: {{ $pendaftaran->jarak_sekolah_2 ? $pendaftaran->jarak_sekolah_2 . ' km' : '-' }}</span>
                            </div>
                            <!--end::Text-->
                        </div>
                        <!--end::Item-->
                    </div>
                </div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-xl-6">
                <div class="card card-flush h-lg-100">
                    <div class="card-header pt-7">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bolder text-dark">Dokumen Terunggah</span>
                            <span class="text-gray-400 mt-1 fw-bold fs-7">Daftar berkas pendaftaran yang telah dikirim</span>
                        </h3>
                    </div>
                    <div class="card-body pt-5">
                        @if($berkas->count() > 0)
                            <div class="row">
                                @foreach($berkas as $item)
                                    <div class="col-md-12 d-flex align-items-center mb-5">
                                        <div class="symbol symbol-40px me-5">
                                            <span class="symbol-label bg-light-danger text-danger">
                                                <i class="bi bi-file-earmark-pdf fs-2"></i>
                                            </span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="text-dark fw-bolder text-hover-primary fs-6">{{ ucwords(str_replace('_', ' ', $item->jenis_berkas)) }}</span>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#modal_preview_{{ $item->id }}" class="text-primary fw-semibold fs-7">Lihat Berkas</a>
                                        </div>
                                    </div>

                                    <!-- Modal Preview -->
                                    <div class="modal fade" id="modal_preview_{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-xl modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h2 class="fw-bolder">{{ ucwords(str_replace('_', ' ', $item->jenis_berkas)) }}</h2>
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
                                                        $extension = pathinfo($item->file_path, PATHINFO_EXTENSION);
                                                    @endphp
                                                    @if(in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']))
                                                        <img src="{{ route('pendaftaran.berkas.show', $item->id) }}" class="img-fluid rounded shadow" alt="Preview">
                                                    @elseif(strtolower($extension) == 'pdf')
                                                        <iframe src="{{ route('pendaftaran.berkas.show', $item->id) }}" width="100%" height="600px" style="border: none;"></iframe>
                                                    @else
                                                        <div class="alert alert-warning">Preview tidak tersedia untuk format file ini.</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-10">
                                <span class="text-gray-400">Belum ada dokumen yang diunggah.</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <!--end::Col-->
        </div>
        <!--end::details View-->
    @else
        <!--begin::Card-->
        <div class="card">
            <div class="card-body p-10 text-center">
                @if(isset($periode_aktif) && $periode_aktif)
                    <div class="mb-5">
                        <img src="{{ asset('back/media/illustrations/sigma-1/17.png') }}" class="h-175px" alt="">
                    </div>
                    <h1 class="fw-bolder text-dark mb-2">Halo, {{ Auth::user()->name }}! 👋</h1>
                    <h2 class="fw-bold text-gray-800 mb-4">Selamat Datang di Portal Pendaftaran</h2>
                    <p class="fs-6 text-gray-500 mb-8 mx-auto" style="max-width: 500px;">
                        Saat ini Anda belum memiliki pendaftaran yang terkirim. Yuk, mulai proses pendaftaranmu sekarang juga!
                    </p>
                    <a href="{{ route('pendaftaran.create') }}" class="btn btn-primary btn-lg px-10">
                        <i class="bi bi-pencil-square fs-4 me-2"></i> Mulai Pendaftaran Sekarang
                    </a>
                @else
                    <div class="mb-10">
                        <img src="{{ asset('back/media/illustrations/sigma-1/17.png') }}" class="h-150px" style="filter: grayscale(100%); opacity: 0.6;" alt="">
                    </div>
                    <h1 class="fw-bolder text-dark mb-4">Pendaftaran Saat Ini Sedang Ditutup</h1>
                    <p class="fs-6 text-gray-400 mb-8">Mohon maaf, saat ini tidak ada jadwal penerimaan peserta didik baru yang sedang aktif. <br> Silakan pantau terus informasi pengumuman lebih lanjut.</p>
                    <button type="button" class="btn btn-secondary px-10" disabled>Pendaftaran Ditutup</button>
                @endif
            </div>
        </div>
        <!--end::Card-->
    @endif
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if (session('success'))
            Swal.fire({
                text: "{!! session('success') !!}",
                icon: "success",
                buttonsStyling: false,
                confirmButtonText: "Ok, Mengerti!",
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            });
        @endif

        @if (session('error'))
            Swal.fire({
                text: "{!! session('error') !!}",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Ok, Mengerti!",
                customClass: {
                    confirmButton: "btn btn-danger"
                }
            });
        @endif
    });
</script>
@endsection
