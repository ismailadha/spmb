@extends('backend.main')

@section('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        function confirmTidakLulus() {
            var status = "{{ $pendaftaran->status }}";
            var title = status === 'cadangan' ? 'Batalkan Status Cadangan' : 'Batalkan Kelulusan';
            var text = status === 'cadangan' ? 'Apakah Anda yakin ingin membatalkan status cadangan ini?' : 'Apakah Anda yakin ingin membatalkan kelulusan ini?';

            Swal.fire({
                title: title,
                text: text + " Silakan berikan alasan pembatalan:",
                icon: 'warning',
                input: 'textarea',
                inputPlaceholder: 'Tulis alasan di sini...',
                inputAttributes: {
                    'aria-label': 'Tulis alasan di sini'
                },
                showCancelButton: true,
                confirmButtonColor: '#f1416c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Batalkan!',
                cancelButtonText: 'Batal',
                inputValidator: (value) => {
                    if (!value) {
                        return 'Anda harus mengisi alasan pembatalan!'
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('input-keterangan').value = result.value;
                    document.getElementById('form-tidak-lulus').submit();
                }
            });
        }

        // Handler untuk Radio & Dropdown di section penempatan
        $(document).on('change', '#select_other_school', function() {
            if ($(this).val()) {
                $('input[name="target_sekolah"]').prop('checked', false);
            }
        });

        $(document).on('click', 'input[name="target_sekolah"]', function() {
            $('#select_other_school').val('').trigger('change');
        });

        $(document).on('click', '#btn_proses_luluskan', function() {
            let selectedRadio = $('input[name="target_sekolah"]:checked').val();
            let selectedOther = $('#select_other_school').val();
            let finalSekolahId = selectedOther ? selectedOther : selectedRadio;

            if (!finalSekolahId) {
                Swal.fire('Error', 'Anda harus memilih salah satu sekolah!', 'error');
                return;
            }

            Swal.fire({
                title: 'Konfirmasi Kelulusan',
                text: "Apakah Anda yakin ingin meluluskan peserta ke sekolah terpilih?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Luluskan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('kelulusan.luluskan') }}",
                        type: "POST",
                        data: {
                            pendaftaran_ids: ["{{ $pendaftaran->id }}"],
                            sekolah_id: finalSekolahId
                        },
                        beforeSend: function() {
                            Swal.fire({
                                title: 'Mohon Tunggu',
                                text: 'Sedang memproses kelulusan...',
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading()
                                }
                            });
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    text: response.message,
                                    icon: "success",
                                    confirmButtonText: "Ok, mengerti!",
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    text: response.message,
                                    icon: "error",
                                    confirmButtonText: "Ok, mengerti!",
                                });
                            }
                        },
                        error: function(xhr) {
                            Swal.fire({
                                text: xhr.responseJSON ? xhr.responseJSON.message : "Terjadi kesalahan sistem saat meluluskan.",
                                icon: "error",
                                confirmButtonText: "Ok, mengerti!",
                            });
                        }
                    });
                }
            });
        });
    </script>
@endsection

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
                                    @if($pendaftaran->kabupaten_luar)
                                        <span class="badge badge-light-danger fw-bolder ms-2 fs-8 py-1 px-3" style="background-color: #fff5f8; color: #f1416c;">LUAR LHOKSEUMAWE</span>
                                    @endif
                                    {{-- Jika status pendaftaran adalah submit, maka tampilkan badge --}}
                                    @if ($pendaftaran->status == 'submit')
                                        <span class="badge badge-light-warning fw-bolder ms-2 fs-8 py-1 px-3" style="background-color: #fff8dd; color: #ffc700;">PROSES VERIFIKASI</span>
                                    @elseif ($pendaftaran->status == 'verifikasi')
                                        <span class="badge badge-light-info fw-bolder ms-2 fs-8 py-1 px-3" style="background-color: #f3f1ff; color: #7239ea;">TERVERIFIKASI</span>
                                    @elseif ($pendaftaran->status == 'perbaikan')
                                        <span class="badge badge-light-warning fw-bolder ms-2 fs-8 py-1 px-3" style="background-color: #fff4e1; color: #ff8c00;">PERBAIKAN BERKAS</span>
                                    @elseif ($pendaftaran->status == 'lulus' || $pendaftaran->status == 'diterima')
                                        <span class="badge badge-light-success fw-bolder ms-2 fs-8 py-1 px-3" style="background-color: #e8fff3; color: #50cd89;">LULUS / DITERIMA</span>
                                    @elseif ($pendaftaran->status == 'cadangan')
                                        <span class="badge badge-light-warning fw-bolder ms-2 fs-8 py-1 px-3" style="background-color: #fff8dd; color: #ffc700;">CADANGAN</span>
                                    @elseif ($pendaftaran->status == 'tidak_lulus')
                                        <span class="badge badge-light-danger fw-bolder ms-2 fs-8 py-1 px-3" style="background-color: #fff5f8; color: #f1416c;">TIDAK LULUS</span>
                                    @endif
                                </div>
                                <!--end::Name-->
                                <!--begin::Info-->
                                <div class="d-flex flex-wrap fw-bold fs-6 mb-4 pe-2">
                                    <span class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                        <i class="bi bi-person-badge fs-4 me-1"></i>NISN: {{ $pendaftaran->nisn }}
                                    </span>
                                    <span class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                        <i class="bi bi-geo-alt fs-4 me-1"></i>{{ $pendaftaran->nama_kecamatan }}, <span class="ms-1 {{ $pendaftaran->kabupaten_luar ? 'text-danger fw-bolder' : '' }}">{{ $pendaftaran->kabupaten_luar ?? $pendaftaran->nama_kabupaten }}</span>
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
                                @if(auth()->user()->role == 'admin_dinas' || auth()->user()->role == 'admin_sekolah')
                                    @if (in_array($pendaftaran->status, ['submit', 'perbaikan', 'tidak_lulus']))
                                        <a href="{{ route('peserta.verifikasi', $pendaftaran->peserta_id) }}" class="btn btn-sm btn-primary me-2">Verifikasi Sekarang</a>
                                    @endif
                                @endif

                                @if (in_array($pendaftaran->status, ['submit', 'verifikasi']))
                                    <a href="{{ route('pendaftaran.download', $pendaftaran->id) }}" class="btn btn-sm btn-light-danger me-2" target="_blank">
                                        <i class="bi bi-file-earmark-pdf fs-4 me-1"></i>Download Kartu
                                    </a>
                                    <a href="{{ route('pendaftaran.print', $pendaftaran->id) }}" class="btn btn-sm btn-light-info" target="_blank">
                                        <i class="bi bi-printer fs-4 me-1"></i>Cetak Kartu
                                    </a>
                                @endif
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

        <!--begin::Hasil Seleksi Section-->
        @if (in_array($pendaftaran->status, ['lulus', 'diterima', 'cadangan']) || $pendaftaran->sekolah_diterima)
        <div class="card mb-5 mb-xl-10">
            <div class="card-header border-0">
                <div class="card-title m-0">
                    @if($pendaftaran->status == 'cadangan')
                        <h3 class="fw-bolder m-0 text-warning"><i class="bi bi-clock-history text-warning fs-2 me-2"></i>Hasil Seleksi (Cadangan)</h3>
                    @else
                        <h3 class="fw-bolder m-0 text-success"><i class="bi bi-patch-check-fill text-success fs-2 me-2"></i>Hasil Seleksi</h3>
                    @endif
                </div>
                @if (auth()->user()->role == 'admin_dinas')
                <div class="card-toolbar">
                    @if($pendaftaran->status == 'cadangan')
                        <button type="button" class="btn btn-sm btn-primary fw-bold me-2" data-bs-toggle="collapse" data-bs-target="#section_penempatan">
                            <i class="bi bi-check-circle fs-4 me-2"></i>Luluskan Peserta
                        </button>
                    @endif
                    
                    <form action="{{ route('kelulusan.tidak_lulus', $pendaftaran->id) }}" method="POST" class="d-inline" id="form-tidak-lulus">
                        @csrf
                        <input type="hidden" name="keterangan" id="input-keterangan">
                        <button type="button" class="btn btn-sm btn-light-danger fw-bold" onclick="confirmTidakLulus()">
                            <i class="bi bi-x-circle fs-4 me-2"></i>{{ $pendaftaran->status == 'cadangan' ? 'Batalkan Cadangan' : 'Batalkan Kelulusan' }}
                        </button>
                    </form>
                </div>
                @endif
            </div>
            <div class="card-body border-top p-9">
                <!--begin::Manajemen Penempatan (Accordion Style)-->
                @if($pendaftaran->status == 'cadangan' && auth()->user()->role == 'admin_dinas')
                <div class="collapse mb-10" id="section_penempatan">
                    <div class="card card-bordered bg-light-primary border-primary border-dashed">
                        <div class="card-body p-6">
                            <h5 class="fw-bolder mb-5 text-primary d-flex align-items-center">
                                <i class="bi bi-gear-wide-connected fs-2 me-3 text-primary"></i>Manajemen Penempatan Kelulusan
                            </h5>
                            <div class="row g-9">
                                <div class="col-md-6 border-end border-gray-300">
                                    <label class="form-label fw-bolder mb-4">Pilihan Asli Peserta:</label>
                                    <div class="form-check form-check-custom form-check-solid mb-4">
                                        <input class="form-check-input h-20px w-20px" type="radio" name="target_sekolah" value="{{ $pendaftaran->sekolah_pilihan_1 }}" id="radio_p1" checked>
                                        <label class="form-check-label text-gray-800 fw-bold" for="radio_p1">
                                            Pilihan 1: {{ $pendaftaran->pilihan_1 }}
                                        </label>
                                    </div>
                                    @if($pendaftaran->sekolah_pilihan_2)
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input h-20px w-20px" type="radio" name="target_sekolah" value="{{ $pendaftaran->sekolah_pilihan_2 }}" id="radio_p2">
                                        <label class="form-check-label text-gray-800 fw-bold" for="radio_p2">
                                            Pilihan 2: {{ $pendaftaran->pilihan_2 }}
                                        </label>
                                    </div>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bolder mb-4">Penempatan Sekolah Lain (Opsi Dinas):</label>
                                    <select id="select_other_school" class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih Sekolah Lain">
                                        <option value="">-- Pilih Sekolah Lain --</option>
                                        @foreach($semuaSekolah as $kecamatan => $sekolahs)
                                            <optgroup label="KECAMATAN {{ strtoupper($kecamatan) }}">
                                                @foreach($sekolahs as $sekolah)
                                                    <option value="{{ $sekolah->id }}">{{ $sekolah->nama_sekolah }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                    <div class="text-muted fs-8 mt-3 italic">* Memilih dari dropdown akan otomatis mengabaikan pilihan radio.</div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-6">
                                <button type="button" class="btn btn-primary btn-sm px-6" id="btn_proses_luluskan">
                                    <i class="bi bi-check-all fs-3 me-1"></i>Proses Kelulusan Sekarang
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <!--end::Manajemen Penempatan-->
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted">Status Akhir</label>
                    <div class="col-lg-8">
                        @if($pendaftaran->status == 'cadangan')
                            <span class="badge badge-light-warning fw-bolder fs-6 px-4 py-2" style="background-color: #fff8dd; color: #ffc700;">CADANGAN</span>
                        @else
                            <span class="badge badge-success fw-bolder fs-6 px-4 py-2">DITERIMA / LULUS</span>
                        @endif
                    </div>
                </div>
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted">Sekolah Penempatan</label>
                    <div class="col-lg-8 d-flex align-items-center">
                        <span class="fw-bolder fs-4 text-gray-800 me-3">{{ $pendaftaran->sekolah_diterima ?? '-' }}</span>
                        @if($pendaftaran->sekolah_diterima_id && !in_array($pendaftaran->sekolah_diterima_id, [$pendaftaran->sekolah_pilihan_1, $pendaftaran->sekolah_pilihan_2]))
                            <span class="badge badge-light-primary fw-bolder px-3 py-1">PENEMPATAN KHUSUS / DINAS</span>
                        @endif
                    </div>
                </div>
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted">Jalur Seleksi</label>
                    <div class="col-lg-8">
                        <span class="fw-bold fs-6 text-gray-800">{{ $pendaftaran->nama_jalur }}</span>
                    </div>
                </div>
                <div class="row mb-0">
                    <label class="col-lg-4 fw-bold text-muted">Detail Skor / Jarak</label>
                    <div class="col-lg-8">
                        <div class="d-flex flex-wrap gap-3 mb-5">
                            @if($pendaftaran->skor_jarak)
                                <div class="border border-gray-300 border-dashed rounded py-3 px-4">
                                    <div class="fw-bold text-muted fs-7">Skor Jarak</div>
                                    <div class="fw-bolder fs-5 text-primary">{{ number_format($pendaftaran->skor_jarak, 0, ',', '.') }} Poin</div>
                                </div>
                            @endif
                            @if($pendaftaran->skor_usia)
                                <div class="border border-gray-300 border-dashed rounded py-3 px-4">
                                    <div class="fw-bold text-muted fs-7">Skor Usia</div>
                                    <div class="fw-bolder fs-5 text-primary">{{ number_format($pendaftaran->skor_usia, 0, ',', '.') }} Hari</div>
                                </div>
                            @endif
                            @if($pendaftaran->nilai_akhir)
                                <div class="border border-gray-300 border-dashed rounded py-3 px-4">
                                    <div class="fw-bold text-muted fs-7">Nilai Akhir</div>
                                    <div class="fw-bolder fs-5 text-primary">{{ number_format($pendaftaran->nilai_akhir, 0, ',', '.') }}</div>
                                </div>
                            @endif
                            @if($pendaftaran->nilai_prestasi)
                                <div class="border border-gray-300 border-dashed rounded py-3 px-4">
                                    <div class="fw-bold text-muted fs-7">Nilai Prestasi</div>
                                    <div class="fw-bolder fs-5 text-primary">{{ $pendaftaran->nilai_prestasi }}</div>
                                </div>
                            @endif
                            @if($pendaftaran->rata_rapor)
                                <div class="border border-gray-300 border-dashed rounded py-3 px-4">
                                    <div class="fw-bold text-muted fs-7">Rata-rata Rapor</div>
                                    <div class="fw-bolder fs-5 text-primary">{{ $pendaftaran->rata_rapor }}</div>
                                </div>
                            @endif
                            @if($pendaftaran->nilai_tes_akademik)
                                <div class="border border-gray-300 border-dashed rounded py-3 px-4">
                                    <div class="fw-bold text-muted fs-7">Nilai Tes Akademik</div>
                                    <div class="fw-bolder fs-5 text-primary">{{ $pendaftaran->nilai_tes_akademik }}</div>
                                </div>
                            @endif
                        </div>
                        
                        @if($pendaftaran->sekolah_diterima_id && !in_array($pendaftaran->sekolah_diterima_id, [$pendaftaran->sekolah_pilihan_1, $pendaftaran->sekolah_pilihan_2]))
                            <div class="alert alert-dismissible bg-light-info d-flex flex-column flex-sm-row p-5 mb-5">
                                <i class="bi bi-info-circle fs-2hx text-info me-4 mb-5 mb-sm-0"></i>
                                <div class="d-flex flex-column pe-0 pe-sm-10">
                                    <h4 class="fw-bold">Informasi Penempatan</h4>
                                    <span>Peserta ini diterima melalui <strong>Penempatan Khusus / Dinas</strong> karena sisa kuota yang tersedia di sekolah penempatan. Skor yang ditampilkan tetap menggunakan referensi skor seleksi dari pilihan awal peserta.</span>
                                </div>
                            </div>
                        @endif

                        <div class="d-flex gap-3">
                            <a href="{{ route('pendaftaran.lulus.download', $pendaftaran->id) }}" class="btn btn-danger btn-sm" target="_blank">
                                <i class="bi bi-file-earmark-pdf fs-4 me-2"></i>Download
                            </a>
                            <a href="{{ route('pendaftaran.lulus.print', $pendaftaran->id) }}" class="btn btn-secondary btn-sm" target="_blank">
                                <i class="bi bi-printer fs-4 me-2"></i>Cetak
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!--end::Hasil Seleksi Section-->

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
                                    <tr class="{{ $pendaftaran->kabupaten_luar ? 'bg-light-danger' : '' }}">
                                        <td class="ps-3">
                                            <span class="text-muted fw-bolder d-block fs-7">Kabupaten</span>
                                        </td>
                                        <td class="pe-3">
                                            <span class="text-dark fw-bolder d-block fs-6">{{ $pendaftaran->kabupaten_luar ?? $pendaftaran->nama_kabupaten }}</span>
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
