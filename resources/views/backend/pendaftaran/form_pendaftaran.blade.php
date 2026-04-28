@extends('backend.main')

@section('pendaftaran-menu-active', 'active')

@section('content')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

    <!--begin::Card-->
    <div class="card" style="background-color: #fff5f5; border: 1px solid #ffe2e5;">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <h3>Form Pendaftaran Peserta Didik Baru Periode Tahun Ajaran {{ $data->tahun_ajaran }}</h3>
            </div>
            <!--begin::Card title-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body py-4">
            <form action="{{ $mode == 'create' ? route('pendaftaran.store') : route('pendaftaran.update', $data->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                @if ($mode == 'edit')
                    @method('PUT')
                @endif
                <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6" id="wizardTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="step1-tab" data-bs-toggle="tab" href="#step1" role="tab">Pilih Jalur</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link disabled" id="step2-tab" data-bs-toggle="tab" href="#step2" role="tab">Data Profil</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link disabled" id="step-wali-tab" data-bs-toggle="tab" href="#step-wali" role="tab">Orang Tua Wali</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link disabled" id="step3-tab" data-bs-toggle="tab" href="#step3" role="tab">Upload Dokumen</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link disabled" id="step4-tab" data-bs-toggle="tab" href="#step4" role="tab">Pilih Sekolah</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link disabled" id="step5-tab" data-bs-toggle="tab" href="#step5" role="tab">Submit</a>
                    </li>
                </ul>

                <div class="tab-content" id="wizardTabContent">
                    <!-- Step 1: Pilih Jalur -->
                    <div class="tab-pane fade show active" id="step1" role="tabpanel">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="jalur" class="form-label">Jalur Pendaftaran</label>
                                <select class="form-control" id="jalur" name="jalur" required @if(isset($isPerbaikan) && $isPerbaikan) disabled @endif>
                                    <option value="" disabled {{ !old('jalur', $data->jalur_id ?? '') ? 'selected' : '' }}>Pilih Jalur Pendaftaran</option>
                                    @foreach ($jalur_pendaftaran as $jalur)
                                        <option value="{{ $jalur->jalur_id }}" {{ old('jalur', $data->jalur_id ?? '') == $jalur->jalur_id ? 'selected' : '' }}>{{ $jalur->nama_jalur }}</option>
                                    @endforeach
                                </select>
                                @if(isset($isPerbaikan) && $isPerbaikan)
                                    <input type="hidden" name="jalur" value="{{ $data->jalur_id }}">
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="jenjang" class="form-label">Jenjang</label>
                                <select class="form-control" id="jenjang" name="jenjang" required @if(isset($isPerbaikan) && $isPerbaikan) disabled @endif>
                                    <option value="" disabled {{ !old('jenjang', $data->jenjang ?? '') ? 'selected' : '' }}>Pilih Jenjang</option>
                                    <option value="SD" {{ old('jenjang', $data->jenjang ?? '') == 'SD' ? 'selected' : '' }}>SD</option>
                                    <option value="SMP" {{ old('jenjang', $data->jenjang ?? '') == 'SMP' ? 'selected' : '' }}>SMP</option>
                                </select>
                                @if(isset($isPerbaikan) && $isPerbaikan)
                                    <input type="hidden" name="jenjang" value="{{ $data->jenjang }}">
                                @endif
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-4">
                            <button type="button" class="btn btn-primary btn-next" data-next="step2" id="nextToProfil" disabled>Selanjutnya</button>
                        </div>
                    </div>

                    <!-- Step 2: Data Profil -->
                    <div class="tab-pane fade" id="step2" role="tabpanel">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nik" class="form-label">NIK</label>
                                @if ($mode == 'edit')
                                    <input type="text" class="form-control" id="nik" name="nik" value="{{ $peserta->nik }}" disabled>
                                    <input type="hidden" name="nik" value="{{ $peserta->nik }}">
                                @else
                                    <input type="text" class="form-control" id="nik" name="nik" value="{{ Auth::user()->nik }}" disabled>
                                    <input type="hidden" name="nik" value="{{ Auth::user()->nik }}">
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="nisn" class="form-label">Nomor Induk Siswa Nasional (NISN)</label>
                                <input type="text" class="form-control" id="nisn" name="nisn" value="{{ old('nisn', $peserta->nisn ?? '') }}" required @if(isset($isPerbaikan) && $isPerbaikan) readonly @endif>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $peserta->nama_lengkap ?? '') }}" required @if(isset($isPerbaikan) && $isPerbaikan) readonly @endif>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required @if(isset($isPerbaikan) && $isPerbaikan) disabled @endif>
                                    <option value="" disabled {{ !old('jenis_kelamin', $peserta->jenis_kelamin ?? '') ? 'selected' : '' }}>Pilih Jenis Kelamin</option>
                                    <option value="L" {{ old('jenis_kelamin', $peserta->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('jenis_kelamin', $peserta->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @if(isset($isPerbaikan) && $isPerbaikan)
                                    <input type="hidden" name="jenis_kelamin" value="{{ old('jenis_kelamin', $peserta->jenis_kelamin ?? '') }}">
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="agama" class="form-label">Agama</label>
                                <select class="form-control" id="agama" name="agama" required @if(isset($isPerbaikan) && $isPerbaikan) disabled @endif>
                                    <option value="" disabled {{ !old('agama', $peserta->agama ?? '') ? 'selected' : '' }}>Pilih Agama</option>
                                    <option value="Islam" {{ old('agama', $peserta->agama ?? '') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="Kristen" {{ old('agama', $peserta->agama ?? '') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                    <option value="Katolik" {{ old('agama', $peserta->agama ?? '') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                    <option value="Hindu" {{ old('agama', $peserta->agama ?? '') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="Buddha" {{ old('agama', $peserta->agama ?? '') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                    <option value="Konghucu" {{ old('agama', $peserta->agama ?? '') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                </select>
                                @if(isset($isPerbaikan) && $isPerbaikan)
                                    <input type="hidden" name="agama" value="{{ old('agama', $peserta->agama ?? '') }}">
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $peserta->tempat_lahir ?? '') }}" required @if(isset($isPerbaikan) && $isPerbaikan) readonly @endif>
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $peserta->tanggal_lahir ?? '') }}" required @if(isset($isPerbaikan) && $isPerbaikan) readonly @endif>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nomor_kk" class="form-label">Nomor Kartu Keluarga (KK)</label>
                                <input type="text" class="form-control" id="nomor_kk" name="nomor_kk" value="{{ old('nomor_kk', $peserta->nomor_kk ?? '') }}" required minlength="16" maxlength="16" pattern="\d{16}" title="Nomor KK harus 16 digit angka" inputmode="numeric" @if(isset($isPerbaikan) && $isPerbaikan) readonly @endif>
                                <div class="text-muted fs-7 mt-1">Nomor KK harus terdiri dari tepat 16 digit angka.</div>
                                <div class="invalid-feedback">Nomor KK harus 16 digit angka.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal_kk" class="form-label">Tanggal Penerbitan KK</label>
                                <input type="date" class="form-control" id="tanggal_kk" name="tanggal_terbit_kk" value="{{ old('tanggal_terbit_kk', $peserta->tanggal_terbit_kk ?? '') }}" required @if(isset($isPerbaikan) && $isPerbaikan) readonly @endif>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <label class="form-label d-block">Status Domisili</label>
                                <div class="form-check form-switch form-check-custom form-check-solid mt-2">
                                    <input class="form-check-input h-30px w-50px" type="checkbox" id="check_luar_daerah" {{ old('kabupaten', $mode == 'edit' ? ($peserta->kabupaten_id ?: '9999') : '1173') == '9999' ? 'checked' : '' }} />
                                    <label class="form-check-label fw-bold text-gray-700" for="check_luar_daerah">
                                        Pendaftar dari luar Kota Lhokseumawe?
                                    </label>
                                </div>
                                <input type="hidden" id="kabupaten" name="kabupaten" value="{{ old('kabupaten', $mode == 'edit' ? ($peserta->kabupaten_id ?: '9999') : '1173') }}">
                            </div>
                            <div class="col-md-6">
                                <label for="provinsi_display" class="form-label">Provinsi</label>
                                <select class="form-control" id="provinsi_display" name="provinsi_display" required>
                                    <option value="" disabled {{ !old('provinsi', $peserta->provinsi_id ?? '') ? 'selected' : '' }}>Pilih Provinsi</option>
                                    @foreach ($provinsi as $item)
                                        <option value="{{ $item->id }}" {{ old('provinsi', $peserta->provinsi_id ?? '') == $item->id ? 'selected' : '' }}>{{ $item->nama_provinsi }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" id="provinsi" name="provinsi" value="{{ old('provinsi', $peserta->provinsi_id ?? '') }}">
                            </div>
                        </div>

                        <div class="row mb-3" id="kabupaten_luar_container" style="display: none;">
                            <div class="col-md-12">
                                <label for="kabupaten_nama_luar" class="form-label">Nama Kabupaten/Kota Asal</label>
                                <input type="text" class="form-control" id="kabupaten_nama_luar" name="kabupaten_nama_luar" value="{{ old('kabupaten_nama_luar', $peserta->kabupaten_luar ?? '') }}" placeholder="Contoh: Banda Aceh, Medan, dll">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="kecamatan" class="form-label">Kecamatan</label>
                                <select class="form-control" id="kecamatan" name="kecamatan" required>
                                    <option value="" disabled {{ !old('kecamatan', $peserta->kecamatan_id ?? '') ? 'selected' : '' }}>Pilih Kecamatan</option>
                                    @foreach ($kecamatan as $item)
                                        <option value="{{ $item->id }}" {{ old('kecamatan', $peserta->kecamatan_id ?? '') == $item->id ? 'selected' : '' }}>{{ $item->nama_kecamatan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="desa" class="form-label">Desa/Kelurahan</label>
                                <select class="form-control" id="desa" name="desa" required>
                                    <option value="" disabled {{ !old('desa', $peserta->desa_id ?? '') ? 'selected' : '' }}>Pilih Desa/Kelurahan</option>
                                    @foreach ($desa as $item)
                                        <option value="{{ $item->id }}" {{ old('desa', $peserta->desa_id ?? '') == $item->id ? 'selected' : '' }}>{{ $item->nama_desa }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-12">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ old('alamat', $peserta->alamat ?? '') }}</textarea>
                            </div>
                        </div>

                        {{-- latitude dan longitude --}}
                        <div class="row mb-3">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Titik Lokasi Tempat Tinggal</label>
                                <div class="text-muted mb-2">Geser penanda (marker) biru pada peta di bawah ini untuk menentukan titik koordinat tempat tinggal yang tepat.</div>
                                <div id="map" style="height: 400px; width: 100%; border-radius: 8px; z-index: 1;"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="latitude" class="form-label">Latitude</label>
                                <input type="text" class="form-control" id="latitude" name="latitude" value="{{ old('latitude', $peserta->latitude ?? '') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="longitude" class="form-label">Longitude</label>
                                <input type="text" class="form-control" id="longitude" name="longitude" value="{{ old('longitude', $peserta->longitude ?? '') }}" required>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-secondary btn-prev" data-prev="step1">Sebelumnya</button>
                            <button type="button" class="btn btn-primary btn-next" data-next="step-wali">Selanjutnya</button>
                        </div>
                    </div>

                    <!-- Step 2a: Orang Tua Wali -->
                    <div class="tab-pane fade" id="step-wali" role="tabpanel">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="nama_wali" class="form-label">Nama Wali</label>
                                <input type="text" class="form-control" id="nama_wali" name="nama_wali" value="{{ old('nama_wali', $peserta->nama_wali ?? '') }}" required @if(isset($isPerbaikan) && $isPerbaikan) readonly @endif>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="pekerjaan_wali" class="form-label">Pekerjaan Wali</label>
                                <input type="text" class="form-control" id="pekerjaan_wali" name="pekerjaan_wali" value="{{ old('pekerjaan_wali', $peserta->pekerjaan_wali ?? '') }}" required @if(isset($isPerbaikan) && $isPerbaikan) readonly @endif>
                            </div>
                            <div class="col-md-6">
                                <label for="no_hp_wali" class="form-label">No. HP Wali</label>
                                <input type="text" class="form-control" id="no_hp_wali" name="no_hp_wali" value="{{ old('no_hp_wali', $peserta->no_hp ?? '') }}" required @if(isset($isPerbaikan) && $isPerbaikan) readonly @endif>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="alamat_wali" class="form-label">Alamat Wali</label>
                                <textarea class="form-control" id="alamat_wali" name="alamat_wali" rows="3" required @if(isset($isPerbaikan) && $isPerbaikan) readonly @endif>{{ old('alamat_wali', $peserta->alamat_wali ?? '') }}</textarea>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-secondary btn-prev" data-prev="step2">Sebelumnya</button>
                            <button type="button" class="btn btn-primary btn-next" data-next="step3">Selanjutnya</button>
                        </div>
                    </div>

                    <!-- Step 3: Upload Dokumen -->
                    <div class="tab-pane fade" id="step3" role="tabpanel">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="pasfoto" class="form-label">Pas Photo</label>
                                <input type="file" class="form-control" id="pasfoto" name="pasfoto" {{ $berkas->where('jenis_berkas', 'pasfoto')->first() ? '' : 'required' }}>
                                @error('pasfoto') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                @if($berkas->where('jenis_berkas', 'pasfoto')->first())
                                    <div class="mt-2">
                                        <small class="text-primary fw-bold">
                                            <i class="fa fa-check-circle text-primary"></i> Berkas sudah diunggah.
                                            <a href="{{ route('pendaftaran.berkas.show', $berkas->where('jenis_berkas', 'pasfoto')->first()->id) }}" target="_blank" class="text-decoration-underline">Lihat Berkas</a>
                                        </small>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="akta_lahir" class="form-label">Akta Lahir</label>
                                <input type="file" class="form-control" id="akta_lahir" name="akta_lahir" {{ $berkas->where('jenis_berkas', 'akta_lahir')->first() ? '' : 'required' }}>
                                @error('akta_lahir') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                @if($berkas->where('jenis_berkas', 'akta_lahir')->first())
                                    <div class="mt-2">
                                        <small class="text-primary fw-bold">
                                            <i class="fa fa-check-circle text-primary"></i> Berkas sudah diunggah.
                                            <a href="{{ route('pendaftaran.berkas.show', $berkas->where('jenis_berkas', 'akta_lahir')->first()->id) }}" target="_blank" class="text-decoration-underline">Lihat Berkas</a>
                                        </small>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="kk" class="form-label">Kartu Keluarga</label>
                                <input type="file" class="form-control" id="kk" name="kk" {{ $berkas->where('jenis_berkas', 'kk')->first() ? '' : 'required' }}>
                                @error('kk') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                @if($berkas->where('jenis_berkas', 'kk')->first())
                                    <div class="mt-2">
                                        <small class="text-primary fw-bold">
                                            <i class="fa fa-check-circle text-primary"></i> Berkas sudah diunggah.
                                            <a href="{{ route('pendaftaran.berkas.show', $berkas->where('jenis_berkas', 'kk')->first()->id) }}" target="_blank" class="text-decoration-underline">Lihat Berkas</a>
                                        </small>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="ktp_orang_tua" class="form-label">KTP Orang Tua / Wali</label>
                                <input type="file" class="form-control" id="ktp_orang_tua" name="ktp_orang_tua" {{ $berkas->where('jenis_berkas', 'ktp_orang_tua')->first() ? '' : 'required' }}>
                                @error('ktp_orang_tua') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                @if($berkas->where('jenis_berkas', 'ktp_orang_tua')->first())
                                    <div class="mt-2">
                                        <small class="text-primary fw-bold">
                                            <i class="fa fa-check-circle text-primary"></i> Berkas sudah diunggah.
                                            <a href="{{ route('pendaftaran.berkas.show', $berkas->where('jenis_berkas', 'ktp_orang_tua')->first()->id) }}" target="_blank" class="text-decoration-underline">Lihat Berkas</a>
                                        </small>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-4" id="kartu_pkh_container" style="display: none;">
                                <label for="kartu_pkh" class="form-label">Kartu PKH (Jalur Afirmasi)</label>
                                <input type="file" class="form-control" id="kartu_pkh" name="kartu_pkh">
                                @error('kartu_pkh') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                @if($berkas->where('jenis_berkas', 'kartu_pkh')->first())
                                    <div class="mt-2">
                                        <small class="text-primary fw-bold">
                                            <i class="fa fa-check-circle text-primary"></i> Berkas sudah diunggah.
                                            <a href="{{ route('pendaftaran.berkas.show', $berkas->where('jenis_berkas', 'kartu_pkh')->first()->id) }}" target="_blank" class="text-decoration-underline">Lihat Berkas</a>
                                        </small>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-4" id="surat_dokter_container" style="display: none;">
                                <label for="surat_dokter" class="form-label">Surat Keterangan Dokter/Disabilitas (Afirmasi)</label>
                                <input type="file" class="form-control" id="surat_dokter" name="surat_dokter">
                                @error('surat_dokter') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                @if($berkas->where('jenis_berkas', 'surat_dokter')->first())
                                    <div class="mt-2">
                                        <small class="text-primary fw-bold">
                                            <i class="fa fa-check-circle text-primary"></i> Berkas sudah diunggah.
                                            <a href="{{ route('pendaftaran.berkas.show', $berkas->where('jenis_berkas', 'surat_dokter')->first()->id) }}" target="_blank" class="text-decoration-underline">Lihat Berkas</a>
                                        </small>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-4" id="surat_pindah_container" style="display: none;">
                                <label for="surat_pindah" class="form-label">Surat Keterangan Pindah (Jalur Mutasi)</label>
                                <input type="file" class="form-control" id="surat_pindah" name="surat_pindah">
                                @error('surat_pindah') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                @if($berkas->where('jenis_berkas', 'surat_pindah')->first())
                                    <div class="mt-2">
                                        <small class="text-primary fw-bold">
                                            <i class="fa fa-check-circle text-primary"></i> Berkas sudah diunggah.
                                            <a href="{{ route('pendaftaran.berkas.show', $berkas->where('jenis_berkas', 'surat_pindah')->first()->id) }}" target="_blank" class="text-decoration-underline">Lihat Berkas</a>
                                        </small>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6" id="prestasi_akademik_container" style="display: none;">
                                <h5 class="mb-3">Dokumen Prestasi Akademik (Jalur Prestasi)</h5>
                                <div>
                                    <label for="dokumen_tka" class="form-label">Dokumen Hasil Tes TKA</label>
                                    <input type="file" class="form-control" id="dokumen_tka" name="dokumen_tka">
                                    @error('dokumen_tka') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                    @if($berkas->where('jenis_berkas', 'dokumen_tka')->first())
                                        <div class="mt-2">
                                            <small class="text-primary fw-bold">
                                                <i class="fa fa-check-circle text-primary"></i> Berkas sudah diunggah.
                                                <a href="{{ route('pendaftaran.berkas.show', $berkas->where('jenis_berkas', 'dokumen_tka')->first()->id) }}" target="_blank" class="text-decoration-underline">Lihat Berkas</a>
                                            </small>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6" id="prestasi_nonakademik_container" style="display: none;">
                                <h5 class="mb-3">Dokumen Prestasi Non-Akademik (Jalur Prestasi)</h5>
                                <div>
                                    <label for="sertifikat_penghargaan" class="form-label">Sertifikat Penghargaan</label>
                                    <input type="file" class="form-control" id="sertifikat_penghargaan" name="sertifikat_penghargaan">
                                    @error('sertifikat_penghargaan') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                    @if($berkas->where('jenis_berkas', 'sertifikat_penghargaan')->first())
                                        <div class="mt-2">
                                            <small class="text-primary fw-bold">
                                                <i class="fa fa-check-circle text-primary"></i> Berkas sudah diunggah.
                                                <a href="{{ route('pendaftaran.berkas.show', $berkas->where('jenis_berkas', 'sertifikat_penghargaan')->first()->id) }}" target="_blank" class="text-decoration-underline">Lihat Berkas</a>
                                            </small>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-secondary btn-prev" data-prev="step-wali">Sebelumnya</button>
                            <button type="button" class="btn btn-primary btn-next" data-next="step4">Selanjutnya</button>
                        </div>
                    </div>

                    <!-- Step 4: Pilih Sekolah -->
                    <div class="tab-pane fade" id="step4" role="tabpanel">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="sekolah_pilihan_1" class="form-label">Pilihan 1</label>
                                @if ($mode == 'edit')
                                    <select class="form-control select2" id="sekolah_pilihan_1" name="sekolah_pilihan_1" required @if(isset($isPerbaikan) && $isPerbaikan) disabled @endif>
                                        <option value="" disabled>-- Pilih Sekolah --</option>
                                        @foreach($sekolahGrouped[$data->jenjang] ?? [] as $kecamatan => $listSekolah)
                                            <optgroup label="Kecamatan {{ $kecamatan }}">
                                                @foreach($listSekolah as $sekolah)
                                                    <option value="{{ $sekolah->id }}" data-lat="{{ $sekolah->latitude }}" data-lng="{{ $sekolah->longitude }}" {{ ($data->sekolah_pilihan_1 ?? '') == $sekolah->id ? 'selected' : '' }}>
                                                        {{ $sekolah->nama_sekolah }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                    @if(isset($isPerbaikan) && $isPerbaikan)
                                        <input type="hidden" name="sekolah_pilihan_1" value="{{ $data->sekolah_pilihan_1 }}">
                                    @endif
                                @else
                                    <select class="form-control select2" id="sekolah_pilihan_1" name="sekolah_pilihan_1" required>
                                        <option value="" disabled selected>-- Pilih Sekolah --</option>
                                    </select>
                                @endif
                            </div>
                            <div class="col-md-6" id="sekolah_pilihan_2_container">
                                <label for="sekolah_pilihan_2" class="form-label">Pilihan 2</label>
                                @if ($mode == 'edit')
                                    <select class="form-control select2" id="sekolah_pilihan_2" name="sekolah_pilihan_2" @if(isset($isPerbaikan) && $isPerbaikan) disabled @endif>
                                        <option value="" disabled>-- Pilih Sekolah --</option>
                                        @foreach($sekolahGrouped[$data->jenjang] ?? [] as $kecamatan => $listSekolah)
                                            <optgroup label="Kecamatan {{ $kecamatan }}">
                                                @foreach($listSekolah as $sekolah)
                                                    <option value="{{ $sekolah->id }}" data-lat="{{ $sekolah->latitude }}" data-lng="{{ $sekolah->longitude }}" {{ ($data->sekolah_pilihan_2 ?? '') == $sekolah->id ? 'selected' : '' }}>
                                                        {{ $sekolah->nama_sekolah }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                    @if(isset($isPerbaikan) && $isPerbaikan)
                                        <input type="hidden" name="sekolah_pilihan_2" value="{{ $data->sekolah_pilihan_2 }}">
                                    @endif
                                @else
                                    <select class="form-control select2" id="sekolah_pilihan_2" name="sekolah_pilihan_2">
                                        <option value="" disabled selected>-- Pilih Sekolah --</option>
                                    </select>
                                @endif
                            </div>
                        </div>
                        {{-- Jarak Sekolah --}}
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="jarak_sekolah_1" class="form-label">Jarak Sekolah 1</label>
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light" id="jarak_sekolah_1" name="jarak_sekolah_1" value="{{ $data->jarak_sekolah_1 ?? '' }}" readonly>
                                    <span class="input-group-text">km</span>
                                </div>
                            </div>
                            <div class="col-md-6" id="jarak_sekolah_2_container">
                                <label for="jarak_sekolah_2" class="form-label">Jarak Sekolah 2 <span class="text-muted">(Disarankan pilih jarak terdekat dari tempat tinggal)</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light" id="jarak_sekolah_2" name="jarak_sekolah_2" value="{{ $data->jarak_sekolah_2 ?? '' }}" readonly>
                                    <span class="input-group-text">km</span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-secondary btn-prev" data-prev="step3">Sebelumnya</button>
                            <button type="button" class="btn btn-primary btn-next" data-next="step5">Selanjutnya</button>
                        </div>
                    </div>

                    <!-- Step 5: Submit -->
                    <div class="tab-pane fade" id="step5" role="tabpanel">
                        <div class="alert alert-warning d-flex align-items-center p-5 mb-10">
                            <div class="d-flex flex-column">
                                <h4 class="mb-1 text-dark">Perhatian</h4>
                                <span>Mohon periksa kembali seluruh data yang telah Anda isi di bawah ini sebelum menekan tombol <strong>Submit</strong>.</span>
                            </div>
                        </div>

                        <!-- Summary Section -->
                        <div class="row g-5 mb-8" id="summary-content">
                            <!-- Data Jalur & Jenjang -->
                            <div class="col-md-6">
                                <div class="card border border-dashed h-100 p-6">
                                    <div class="d-flex flex-stack mb-4">
                                        <div class="flex-grow-1">
                                            <h5 class="text-gray-800 fw-bold">Jalur & Jenjang</h5>
                                        </div>
                                    </div>
                                    <div class="separator separator-dashed mb-4"></div>
                                    <div class="d-flex flex-column gap-2">
                                        <div class="d-flex flex-stack">
                                            <span class="text-gray-500 fw-semibold">Jalur Pendaftaran:</span>
                                            <span class="text-gray-800 fw-bold text-end" id="sum-jalur">-</span>
                                        </div>
                                        <div class="d-flex flex-stack">
                                            <span class="text-gray-500 fw-semibold">Jenjang Sekolah:</span>
                                            <span class="text-gray-800 fw-bold text-end" id="sum-jenjang">-</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Sekolah Pilihan -->
                            <div class="col-md-6">
                                <div class="card border border-dashed h-100 p-6">
                                    <div class="d-flex flex-stack mb-4">
                                        <div class="flex-grow-1">
                                            <h5 class="text-gray-800 fw-bold">Sekolah Pilihan</h5>
                                        </div>
                                    </div>
                                    <div class="separator separator-dashed mb-4"></div>
                                    <div class="d-flex flex-column gap-2">
                                        <div class="d-flex flex-stack mt-2">
                                            <span class="text-gray-500 fw-semibold">Pilihan 1:</span>
                                            <span class="text-gray-800 fw-bold text-end" id="sum-sekolah1">-</span>
                                        </div>
                                        <div class="d-flex flex-stack">
                                            <span class="text-gray-500 fw-semibold ms-4">Jarak:</span>
                                            <span class="text-gray-800 text-end" id="sum-jarak1">-</span>
                                        </div>
                                        <div class="separator separator-dashed my-2" id="sum-sep2"></div>
                                        <div class="d-flex flex-stack" id="sum-sekolah2-row">
                                            <span class="text-gray-500 fw-semibold">Pilihan 2:</span>
                                            <span class="text-gray-800 fw-bold text-end" id="sum-sekolah2">-</span>
                                        </div>
                                        <div class="d-flex flex-stack" id="sum-jarak2-row">
                                            <span class="text-gray-500 fw-semibold ms-4">Jarak:</span>
                                            <span class="text-gray-800 text-end" id="sum-jarak2">-</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Dokumen Terunggah -->
                            <div class="col-md-12">
                                <div class="card border border-dashed p-6">
                                    <div class="d-flex flex-stack mb-4">
                                        <div class="flex-grow-1">
                                            <h5 class="text-gray-800 fw-bold">Dokumen Terunggah</h5>
                                        </div>
                                    </div>
                                    <div class="separator separator-dashed mb-4"></div>
                                    @if($berkas->count() > 0)
                                        <div class="row g-5">
                                            @foreach($berkas as $item)
                                                <div class="col-md-4">
                                                    <div class="d-flex align-items-center mb-3">
                                                        <i class="fa fa-file-pdf text-primary fs-2 me-3"></i>
                                                        <div class="d-flex flex-column">
                                                            <span class="text-gray-800 fw-bold fs-6">{{ ucwords(str_replace('_', ' ', $item->jenis_berkas)) }}</span>
                                                            <a href="{{ route('pendaftaran.berkas.show', $item->id) }}" target="_blank" class="text-primary fw-semibold fs-7 qtext-hover-underline">Lihat Dokumen</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="text-center py-5">
                                            <span class="text-gray-500">Belum ada dokumen yang diunggah.</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Data Peserta -->
                            <div class="col-md-12">
                                <div class="card border border-dashed p-6">
                                    <div class="d-flex flex-stack mb-4">
                                        <div class="flex-grow-1">
                                            <h5 class="text-gray-800 fw-bold">Data Peserta Didik</h5>
                                        </div>
                                    </div>
                                    <div class="separator separator-dashed mb-4"></div>
                                    <div class="row g-5">
                                        <div class="col-md-6">
                                            <table class="table table-borderless align-middle gs-0 gy-2">
                                                <tr>
                                                    <td class="text-gray-500 fw-semibold w-150px">Nama Lengkap</td>
                                                    <td class="text-gray-800 fw-bold">: <span id="sum-nama">-</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-gray-500 fw-semibold">NIK</td>
                                                    <td class="text-gray-800 fw-bold">: <span id="sum-nik">-</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-gray-500 fw-semibold">NISN</td>
                                                    <td class="text-gray-800 fw-bold">: <span id="sum-nisn">-</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-gray-500 fw-semibold">JK / Agama</td>
                                                    <td class="text-gray-800 fw-bold">: <span id="sum-jk-agama">-</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-gray-500 fw-semibold">Tempat, Tgl Lahir</td>
                                                    <td class="text-gray-800 fw-bold">: <span id="sum-ttl">-</span></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table table-borderless align-middle gs-0 gy-2">
                                                <tr>
                                                    <td class="text-gray-500 fw-semibold w-150px">No. KK</td>
                                                    <td class="text-gray-800 fw-bold">: <span id="sum-kk">-</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-gray-500 fw-semibold">Tgl Terbit KK</td>
                                                    <td class="text-gray-800 fw-bold">: <span id="sum-tgl-kk">-</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-gray-500 fw-semibold">Alamat</td>
                                                    <td class="text-gray-800 fw-bold">: <span id="sum-alamat">-</span></td>
                                                </tr>
                                                <tr id="sum-prov-row" style="display: none;">
                                                    <td class="text-gray-500 fw-semibold">Provinsi</td>
                                                    <td class="text-gray-800 fw-bold">: <span id="sum-provinsi">-</span></td>
                                                </tr>
                                                <tr id="sum-wil-row" style="display: none;">
                                                    <td class="text-gray-500 fw-semibold">Kota/Kec/Desa</td>
                                                    <td class="text-gray-800 fw-bold">: <span id="sum-wilayah">-</span></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Data Orang Tua/Wali -->
                            <div class="col-md-12">
                                <div class="card border border-dashed p-6">
                                    <div class="d-flex flex-stack mb-4">
                                        <div class="flex-grow-1">
                                            <h5 class="text-gray-800 fw-bold">Data Orang Tua / Wali</h5>
                                        </div>
                                    </div>
                                    <div class="separator separator-dashed mb-4"></div>
                                    <div class="row g-5">
                                        <div class="col-md-6">
                                            <table class="table table-borderless align-middle gs-0 gy-2">
                                                <tr>
                                                    <td class="text-gray-500 fw-semibold w-150px">Nama Wali</td>
                                                    <td class="text-gray-800 fw-bold">: <span id="sum-wali-nama">-</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-gray-500 fw-semibold">No. HP</td>
                                                    <td class="text-gray-800 fw-bold">: <span id="sum-wali-hp">-</span></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table table-borderless align-middle gs-0 gy-2">
                                                <tr>
                                                    <td class="text-gray-500 fw-semibold w-150px">Pekerjaan</td>
                                                    <td class="text-gray-800 fw-bold">: <span id="sum-wali-kerja">-</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-gray-500 fw-semibold">Alamat Wali</td>
                                                    <td class="text-gray-800 fw-bold">: <span id="sum-wali-alamat">-</span></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row g-5 mb-8">
                            @if(!isset($isPerbaikan) || !$isPerbaikan)
                            <div class="col-lg-6">
                                <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed p-6">
                                    <div class="d-flex flex-stack flex-grow-1">
                                        <div class="fw-bold">
                                            <h4 class="text-gray-900 fw-bolder">Draft</h4>
                                            <div class="fs-6 text-gray-700">Data tersimpan sebagai draf. Anda tetap dapat mengubah data pendaftaran ini kapan saja sebelum melakukan Submit.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="{{ (isset($isPerbaikan) && $isPerbaikan) ? 'col-lg-12' : 'col-lg-6' }}">
                                <div class="notice d-flex bg-light-success rounded border-success border border-dashed p-6">
                                    <div class="d-flex flex-stack flex-grow-1">
                                        <div class="fw-bold">
                                            <h4 class="text-gray-900 fw-bolder">Submit</h4>
                                            <div class="fs-6 text-gray-700">Data akan dikirim dan dikunci untuk proses seleksi. Anda <strong>tidak dapat lagi mengubah data</strong> setelah menekan tombol Submit.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-10">
                            <button type="button" class="btn btn-light btn-prev" data-prev="step4">Sebelumnya</button>
                            <div class="d-flex gap-3">
                                <div class="separator separator-vertical h-40px mx-2"></div>
                                @if(!isset($isPerbaikan) || !$isPerbaikan)
                                    <button type="submit" name="status" value="draft" class="btn btn-primary shadow-sm">Simpan Sebagai Draft</button>
                                @endif
                                <button type="submit" name="status" value="submit" class="btn btn-success shadow-sm">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--end::Card-->

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // -- Leaflet Map Initialization --
            let defaultLat = 5.179858; // Islamic Center Lhokseumawe
            let defaultLng = 97.141969; // Islamic Center Lhokseumawe

            const latInput = document.getElementById('latitude');
            const lngInput = document.getElementById('longitude');

            // Override default if coordinates exist in inputs
            if(latInput && latInput.value && !isNaN(latInput.value)) {
                defaultLat = parseFloat(latInput.value);
            }

            if(lngInput && lngInput.value && !isNaN(lngInput.value)) {
                defaultLng = parseFloat(lngInput.value);
            }

            const map = L.map('map').setView([defaultLat, defaultLng], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            let marker = L.marker([defaultLat, defaultLng], {
                draggable: true
            }).addTo(map);

            marker.on('dragend', function (e) {
                const position = marker.getLatLng();
                latInput.value = position.lat.toFixed(6);
                lngInput.value = position.lng.toFixed(6);
                if (typeof calculateDistances === 'function') calculateDistances();
            });

            // Update marker and inputs when map is clicked
            map.on('click', function(e) {
                marker.setLatLng(e.latlng);
                latInput.value = e.latlng.lat.toFixed(6);
                lngInput.value = e.latlng.lng.toFixed(6);
                if (typeof calculateDistances === 'function') calculateDistances();
            });

            // Update marker when input changed manually
            function updateMapFromInputs() {
                const lat = parseFloat(latInput.value);
                const lng = parseFloat(lngInput.value);
                if (!isNaN(lat) && !isNaN(lng)) {
                    const newLatLng = new L.LatLng(lat, lng);
                    marker.setLatLng(newLatLng);
                    map.panTo(newLatLng);
                }
                if (typeof calculateDistances === 'function') calculateDistances();
            }

            if(latInput && lngInput) {
                latInput.addEventListener('input', updateMapFromInputs);
                lngInput.addEventListener('input', updateMapFromInputs);
            }

            // Fix map rendering issue when it is hidden inside a tab
            const tab2 = document.getElementById('step2-tab');
            if (tab2) {
                tab2.addEventListener('shown.bs.tab', function () {
                    setTimeout(() => {
                        map.invalidateSize();
                        map.panTo(marker.getLatLng());
                    }, 100);
                });
            }

            // -- KK Number Input Restriction --
            const kkInput = document.getElementById('nomor_kk');
            if (kkInput) {
                kkInput.addEventListener('input', function(e) {
                    // Remove any non-digit characters
                    this.value = this.value.replace(/[^0-9]/g, '');
                    
                    // Limit to 16 digits
                    if (this.value.length > 16) {
                        this.value = this.value.slice(0, 16);
                    }
                });
                
                // Also prevent non-digit on keypress for better UX
                kkInput.addEventListener('keypress', function(e) {
                    if (e.which < 48 || e.which > 57) {
                        e.preventDefault();
                    }
                });
            }

            // -- End Leaflet Map Initialization --

            const jalur = document.getElementById('jalur');
            const nextBtn = document.getElementById('nextToProfil');

            const hasKartuPkh = {{ $berkas->where('jenis_berkas', 'kartu_pkh')->first() ? 'true' : 'false' }};
            const hasSuratDokter = {{ $berkas->where('jenis_berkas', 'surat_dokter')->first() ? 'true' : 'false' }};
            const hasSuratPindah = {{ $berkas->where('jenis_berkas', 'surat_pindah')->first() ? 'true' : 'false' }};
            const hasPrestasiAkd = {{ $berkas->where('jenis_berkas', 'dokumen_tka')->first() ? 'true' : 'false' }};
            const hasPrestasiNon = {{ $berkas->where('jenis_berkas', 'sertifikat_penghargaan')->first() ? 'true' : 'false' }};

            function toggleDokumen() {
                const kartuPkhContainer = document.getElementById('kartu_pkh_container');
                const suratDokterContainer = document.getElementById('surat_dokter_container');
                const suratPindahContainer = document.getElementById('surat_pindah_container');
                const prestasiAkademikContainer = document.getElementById('prestasi_akademik_container');
                const prestasiNonakademikContainer = document.getElementById('prestasi_nonakademik_container');
                const jenjangSelect = document.getElementById('jenjang');

                // Reset required ke false untuk semua input dinamis setiap kali toggle berjalan
                document.getElementById('kartu_pkh').required = false;
                document.getElementById('surat_dokter').required = false;
                document.getElementById('surat_pindah').required = false;
                if(document.getElementById('dokumen_tka')) document.getElementById('dokumen_tka').required = false;
                if(document.getElementById('sertifikat_penghargaan')) document.getElementById('sertifikat_penghargaan').required = false;

                let selectedText = '';
                if (jalur.selectedIndex !== -1) {
                    selectedText = jalur.options[jalur.selectedIndex].text.toLowerCase();
                }

                if (selectedText.includes('mutasi')) {
                    kartuPkhContainer.style.display = 'none';
                    suratDokterContainer.style.display = 'none';
                    suratPindahContainer.style.display = 'block';
                    if (!hasSuratPindah) document.getElementById('surat_pindah').required = true;

                    if(prestasiAkademikContainer) prestasiAkademikContainer.style.display = 'none';
                    if(prestasiNonakademikContainer) prestasiNonakademikContainer.style.display = 'none';
                } else if (selectedText.includes('afirmasi')) {
                    kartuPkhContainer.style.display = 'block';
                    suratDokterContainer.style.display = 'block';
                    if (!hasKartuPkh) document.getElementById('kartu_pkh').required = true;
                    if (!hasSuratDokter) document.getElementById('surat_dokter').required = true;

                    suratPindahContainer.style.display = 'none';
                    if(prestasiAkademikContainer) prestasiAkademikContainer.style.display = 'none';
                    if(prestasiNonakademikContainer) prestasiNonakademikContainer.style.display = 'none';
                } else if (selectedText.includes('prestasi')) {
                    kartuPkhContainer.style.display = 'none';
                    suratDokterContainer.style.display = 'none';
                    suratPindahContainer.style.display = 'none';

                    if(prestasiAkademikContainer) {
                        prestasiAkademikContainer.style.display = 'block';
                        if (!hasPrestasiAkd) {
                            document.getElementById('dokumen_tka').required = true;
                        }
                    }
                    if(prestasiNonakademikContainer) {
                        prestasiNonakademikContainer.style.display = 'block';
                        if (!hasPrestasiNon) {
                            document.getElementById('sertifikat_penghargaan').required = true;
                        }
                    }
                } else {
                    kartuPkhContainer.style.display = 'none';
                    suratDokterContainer.style.display = 'none';
                    suratPindahContainer.style.display = 'none';
                    if(prestasiAkademikContainer) prestasiAkademikContainer.style.display = 'none';
                    if(prestasiNonakademikContainer) prestasiNonakademikContainer.style.display = 'none';
                }

                // Toggle Sekolah Pilihan 2
                const sekolahPilihan2Container = document.getElementById('sekolah_pilihan_2_container');
                const jarakSekolah2Container = document.getElementById('jarak_sekolah_2_container');
                const sekolahPilihan2 = document.getElementById('sekolah_pilihan_2');

                if (selectedText.includes('domisili')) {
                    sekolahPilihan2Container.style.display = 'block';
                    jarakSekolah2Container.style.display = 'block';
                    if (sekolahPilihan2) sekolahPilihan2.required = true;
                } else {
                    sekolahPilihan2Container.style.display = 'none';
                    jarakSekolah2Container.style.display = 'none';
                    if (sekolahPilihan2) {
                        sekolahPilihan2.required = false;
                        sekolahPilihan2.value = '';
                        if (window.jQuery && typeof jQuery.fn.select2 !== 'undefined') {
                            $(sekolahPilihan2).val('').trigger('change');
                        }
                    }
                    if (document.getElementById('jarak_sekolah_2')) {
                        document.getElementById('jarak_sekolah_2').value = '';
                    }
                }

                if (jenjangSelect) {
                    const sdOption = jenjangSelect.querySelector('option[value="SD"]');
                    if (sdOption) {
                        if (selectedText.includes('prestasi')) {
                            sdOption.disabled = true;
                            if(jenjangSelect.value === 'SD') {
                                jenjangSelect.value = '';
                                if(typeof renderSekolah === 'function') {
                                    renderSekolah('');
                                }
                            }
                        } else {
                            sdOption.disabled = false;
                        }
                    }
                }
            }

            if (jalur) {
                jalur.addEventListener('change', function() {
                    toggleDokumen();
                    if (typeof updateSchoolOptions === 'function') updateSchoolOptions();
                    
                    if(this.value) {
                        nextBtn.disabled = false;
                        document.querySelectorAll('#step2-tab, #step-wali-tab, #step3-tab, #step4-tab, #step5-tab').forEach(tab => {
                            tab.classList.remove('disabled');
                        });
                    } else {
                        nextBtn.disabled = true;
                        document.querySelectorAll('#step2-tab, #step-wali-tab, #step3-tab, #step4-tab, #step5-tab').forEach(tab => {
                            tab.classList.add('disabled');
                        });
                    }
                });

                // Run on initial load
                toggleDokumen();



                // Jika mode edit, tombol lanjut di tab1 tidak disabled dan bisa lanjut ke tab2
                // dan juga tab2, tab3, tab4, tab5 tidak disabled
                @if ($mode == 'edit')
                    nextBtn.disabled = false;
                    document.querySelectorAll('#step2-tab, #step-wali-tab, #step3-tab, #step4-tab, #step5-tab').forEach(tab => {
                        tab.classList.remove('disabled');
                    });
                @endif
            }

            // Dynamics Cascading Default for Wilayah
            const provSelect = document.querySelector('select[name="provinsi_display"]');
            const provHidden = document.querySelector('input[name="provinsi"]');
            const kabupatenSelect = document.getElementById('kabupaten');
            const kecamatanSelect = document.getElementById('kecamatan');
            const desaSelect = document.getElementById('desa');
            const kabupatenLuarContainer = document.getElementById('kabupaten_luar_container');
            const kabupatenLuarInput = document.getElementById('kabupaten_nama_luar');
            const checkLuarDaerah = document.getElementById('check_luar_daerah');

            if (provSelect) {
                // Initialize Province (Aceh by default)
                if (!provHidden.value) {
                    provSelect.value = "11";
                    provHidden.value = "11";
                } else {
                    provSelect.value = provHidden.value;
                }
                provSelect.disabled = true;
                provSelect.parentElement.style.opacity = '0.7';

                provSelect.addEventListener('change', function() {
                    provHidden.value = this.value;
                    // Reset local selects if province changes (though currently locked)
                    if (checkLuarDaerah && !checkLuarDaerah.checked) {
                        kecamatanSelect.innerHTML = '<option value="" disabled selected>Pilih Kecamatan</option>';
                        desaSelect.innerHTML = '<option value="" disabled selected>Pilih Desa/Kelurahan</option>';
                        loadKecamatan("1173");
                    }
                });
            }

            function toggleKabupatenLuar() {
                const isLuar = checkLuarDaerah ? checkLuarDaerah.checked : false;
                const kabVal = isLuar ? "9999" : "1173";
                if (kabupatenSelect) kabupatenSelect.value = kabVal;

                if (isLuar) {
                    if (kabupatenLuarContainer) kabupatenLuarContainer.style.display = 'block';
                    if (kabupatenLuarInput) kabupatenLuarInput.required = true;

                    // Disable local selects
                    kecamatanSelect.required = false;
                    desaSelect.required = false;
                    kecamatanSelect.parentElement.style.opacity = '0.5';
                    desaSelect.parentElement.style.opacity = '0.5';
                    kecamatanSelect.disabled = true;
                    desaSelect.disabled = true;

                    kecamatanSelect.innerHTML = '<option value="" selected>Luar Lhokseumawe</option>';
                    desaSelect.innerHTML = '<option value="" selected>Luar Lhokseumawe</option>';

                    if (window.jQuery && typeof jQuery.fn.select2 !== 'undefined') {
                        $(kecamatanSelect).trigger('change');
                        $(desaSelect).trigger('change');
                    }

                    // Disable and clear province
                    if (provSelect) {
                        provSelect.value = "";
                        provHidden.value = "";
                        provSelect.disabled = true;
                        provSelect.parentElement.style.opacity = '0.5';
                        if (window.jQuery && typeof jQuery.fn.select2 !== 'undefined') {
                            $(provSelect).trigger('change');
                        }
                    }
                } else {
                    if (kabupatenLuarContainer) kabupatenLuarContainer.style.display = 'none';
                    if (kabupatenLuarInput) kabupatenLuarInput.required = false;

                    // Enable local selects
                    kecamatanSelect.required = true;
                    desaSelect.required = true;
                    kecamatanSelect.parentElement.style.opacity = '1';
                    desaSelect.parentElement.style.opacity = '1';
                    kecamatanSelect.disabled = false;
                    desaSelect.disabled = false;

                    loadKecamatan("1173");

                    // Explicitly set to Aceh (ID 11) for locals
                    if (provSelect) {
                        provSelect.value = "11";
                        provHidden.value = "11";
                        provSelect.disabled = true;
                        provSelect.parentElement.style.opacity = '0.7';
                    }
                }
            }

            if (checkLuarDaerah) {
                checkLuarDaerah.addEventListener('change', function() {
                    toggleKabupatenLuar();
                    if (typeof updateSchoolOptions === 'function') updateSchoolOptions();
                });
                toggleKabupatenLuar();
            }

            if (kecamatanSelect) {
                kecamatanSelect.addEventListener('change', function() {
                    loadDesa(this.value);
                });
            }

            function loadKecamatan(kabupatenId) {
                if (!kabupatenId || kabupatenId == "9999") return;
                
                // Optimized check for edit mode
                if (kecamatanSelect.options.length > 2 && "{{ $mode }}" == "edit") {
                    if (kecamatanSelect.value) {
                        loadDesa(kecamatanSelect.value);
                        return;
                    }
                }

                kecamatanSelect.innerHTML = '<option value="" disabled selected>Memuat...</option>';
                fetch(`/wilayah/kecamatan/${kabupatenId}`)
                    .then(response => response.json())
                    .then(data => {
                        kecamatanSelect.innerHTML = '<option value="" disabled selected>Pilih Kecamatan</option>';
                        let currentKecId = "";
                        data.forEach(item => {
                            let selected = (item.id == "{{ old('kecamatan', $peserta->kecamatan_id ?? '') }}") ? 'selected' : '';
                            if (selected) currentKecId = item.id;
                            kecamatanSelect.innerHTML += `<option value="${item.id}" ${selected}>${item.nama_kecamatan}</option>`;
                        });
                        
                        if (window.jQuery && typeof jQuery.fn.select2 !== 'undefined') {
                            $(kecamatanSelect).trigger('change');
                        }

                        if (currentKecId) {
                            loadDesa(currentKecId);
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching kecamatan:', error);
                        kecamatanSelect.innerHTML = '<option value="" disabled selected>Gagal memuat data</option>';
                    });
            }

            function loadDesa(kecamatanId) {
                if (!kecamatanId || (kabupatenSelect && kabupatenSelect.value == "9999")) return;

                // Optimized check for edit mode
                if (desaSelect.options.length > 2 && "{{ $mode }}" == "edit") {
                    if (desaSelect.value) return;
                }

                desaSelect.innerHTML = '<option value="" disabled selected>Memuat...</option>';
                fetch(`/wilayah/desa/${kecamatanId}`)
                    .then(response => response.json())
                    .then(data => {
                        desaSelect.innerHTML = '<option value="" disabled selected>Pilih Desa/Kelurahan</option>';
                        data.forEach(item => {
                            let selected = (item.id == "{{ old('desa', $peserta->desa_id ?? '') }}") ? 'selected' : '';
                            desaSelect.innerHTML += `<option value="${item.id}" ${selected}>${item.nama_desa}</option>`;
                        });
                        
                        if (window.jQuery && typeof jQuery.fn.select2 !== 'undefined') {
                            $(desaSelect).trigger('change');
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching desa:', error);
                        desaSelect.innerHTML = '<option value="" disabled selected>Gagal memuat data</option>';
                    });
            }// Wizard navigation logic
            const nextButtons = document.querySelectorAll('.btn-next');
            const prevButtons = document.querySelectorAll('.btn-prev');

            nextButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    let nextTabId = this.getAttribute('data-next');
                    let nextTabNode = document.getElementById(nextTabId + '-tab');

                    if (nextTabNode && !nextTabNode.classList.contains('disabled')) {
                        let nextTab = new bootstrap.Tab(nextTabNode);
                        nextTab.show();
                    }
                });
            });

            prevButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    let prevTabId = this.getAttribute('data-prev');
                    let prevTabNode = document.getElementById(prevTabId + '-tab');

                    if (prevTabNode) {
                        let prevTab = new bootstrap.Tab(prevTabNode);
                        prevTab.show();
                    }
                });
            });

            // Summary Logic
            const step5Tab = document.getElementById('step5-tab');
            if (step5Tab) {
                step5Tab.addEventListener('shown.bs.tab', function () {
                    populateSummary();
                });
            }

            function populateSummary() {
                // Get display texts instead of values where applicable
                const jalurText = jalur.options[jalur.selectedIndex] ? jalur.options[jalur.selectedIndex].text : '-';
                const jenjangVal = document.getElementById('jenjang').value || '-';

                const sekolah1Text = sekolahPilihan1.options[sekolahPilihan1.selectedIndex] ? sekolahPilihan1.options[sekolahPilihan1.selectedIndex].text : '-';
                const sekolah2Text = sekolahPilihan2.options[sekolahPilihan2.selectedIndex] ? sekolahPilihan2.options[sekolahPilihan2.selectedIndex].text : '-';

                // Fill Summary
                document.getElementById('sum-jalur').innerText = jalurText;
                document.getElementById('sum-jenjang').innerText = jenjangVal;
                document.getElementById('sum-sekolah1').innerText = sekolah1Text;
                document.getElementById('sum-jarak1').innerText = (document.getElementById('jarak_sekolah_1').value ? document.getElementById('jarak_sekolah_1').value + ' km' : '-');

                // Summary Pilihan 2 (Only if Domisili)
                const sumSekolah2Row = document.getElementById('sum-sekolah2-row');
                const sumJarak2Row = document.getElementById('sum-jarak2-row');
                const sumSep2 = document.getElementById('sum-sep2');

                if (jalurText.toLowerCase().includes('domisili')) {
                    if(sumSekolah2Row) sumSekolah2Row.style.display = 'flex';
                    if(sumJarak2Row) sumJarak2Row.style.display = 'flex';
                    if(sumSep2) sumSep2.style.display = 'block';
                    document.getElementById('sum-sekolah2').innerText = sekolah2Text;
                    document.getElementById('sum-jarak2').innerText = (document.getElementById('jarak_sekolah_2').value ? document.getElementById('jarak_sekolah_2').value + ' km' : '-');
                } else {
                    if(sumSekolah2Row) sumSekolah2Row.style.display = 'none';
                    if(sumJarak2Row) sumJarak2Row.style.display = 'none';
                    if(sumSep2) sumSep2.style.display = 'none';
                }

                document.getElementById('sum-nama').innerText = document.getElementById('nama_lengkap').value || '-';
                document.getElementById('sum-nik').innerText = document.getElementById('nik').value || '-';
                document.getElementById('sum-nisn').innerText = document.getElementById('nisn').value || '-';

                const jk = document.getElementById('jenis_kelamin').value === 'L' ? 'Laki-laki' : (document.getElementById('jenis_kelamin').value === 'P' ? 'Perempuan' : '-');
                document.getElementById('sum-jk-agama').innerText = `${jk} / ${document.getElementById('agama').value || '-'}`;

                document.getElementById('sum-ttl').innerText = `${document.getElementById('tempat_lahir').value || '-'}, ${document.getElementById('tanggal_lahir').value || '-'}`;
                document.getElementById('sum-kk').innerText = document.getElementById('nomor_kk').value || '-';
                document.getElementById('sum-tgl-kk').innerText = document.getElementById('tanggal_kk').value || '-';
                document.getElementById('sum-alamat').innerText = document.getElementById('alamat').value || '-';

                const provText = provSelect.options[provSelect.selectedIndex] ? provSelect.options[provSelect.selectedIndex].text : '-';
                let kabText = kabupatenSelect.value == "1173" ? "Kota Lhokseumawe" : "Luar Lhokseumawe";
                if (kabupatenSelect.value == "9999") {
                    kabText = 'Luar Lhokseumawe (' + (kabupatenLuarInput.value || '-') + ')';
                }
                const kecText = kecamatanSelect.options[kecamatanSelect.selectedIndex] ? kecamatanSelect.options[kecamatanSelect.selectedIndex].text : '-';
                const desaText = desaSelect.options[desaSelect.selectedIndex] ? desaSelect.options[desaSelect.selectedIndex].text : '-';

                const sumProvRow = document.getElementById('sum-prov-row');
                const sumWilRow = document.getElementById('sum-wil-row');

                if (kabupatenSelect.value == "1173") {
                    if(sumProvRow) sumProvRow.style.display = 'table-row';
                    if(sumWilRow) sumWilRow.style.display = 'table-row';

                    const sumProv = document.getElementById('sum-provinsi');
                    if (sumProv) sumProv.innerText = provText;

                    const sumWilayah = document.getElementById('sum-wilayah');
                    if (sumWilayah) sumWilayah.innerText = `${kabText} / ${kecText} / ${desaText}`;
                } else {
                    if(sumProvRow) sumProvRow.style.display = 'none';
                    if(sumWilRow) sumWilRow.style.display = 'none';
                }

                // Wali
                document.getElementById('sum-wali-nama').innerText = document.getElementById('nama_wali').value || '-';
                document.getElementById('sum-wali-hp').innerText = document.getElementById('no_hp_wali').value || '-';
                document.getElementById('sum-wali-kerja').innerText = document.getElementById('pekerjaan_wali').value || '-';
                document.getElementById('sum-wali-alamat').innerText = document.getElementById('alamat_wali').value || '-';
            }

            // Preview Button Logic
            const btnPreview = document.getElementById('btnPreview');
            if (btnPreview) {
                btnPreview.addEventListener('click', function() {
                    populateSummary(); // Ensure data is up to date

                    // Fill Modal
                    document.getElementById('pre-jalur').innerText = document.getElementById('sum-jalur').innerText;
                    document.getElementById('pre-nama').innerText = document.getElementById('sum-nama').innerText;
                    document.getElementById('pre-nik').innerText = document.getElementById('sum-nik').innerText;
                    document.getElementById('pre-nisn').innerText = document.getElementById('sum-nisn').innerText;
                    document.getElementById('pre-ttl').innerText = document.getElementById('sum-ttl').innerText;
                    document.getElementById('pre-jk').innerText = document.getElementById('sum-jk-agama').innerText.split(' / ')[0];
                    document.getElementById('pre-sekolah1').innerText = document.getElementById('sum-sekolah1').innerText;
                    document.getElementById('pre-jarak1').innerText = document.getElementById('sum-jarak1').innerText;

                    const preSekolah2Row = document.getElementById('pre-sekolah2-row');
                    if (document.getElementById('sum-jalur').innerText.toLowerCase().includes('domisili')) {
                        if(preSekolah2Row) preSekolah2Row.style.display = 'table-row';
                        document.getElementById('pre-sekolah2').innerText = document.getElementById('sum-sekolah2').innerText;
                        document.getElementById('pre-jarak2').innerText = document.getElementById('sum-jarak2').innerText;
                    } else {
                        if(preSekolah2Row) preSekolah2Row.style.display = 'none';
                    }

                    const previewModal = new bootstrap.Modal(document.getElementById('previewModal'));
                    previewModal.show();
                });
            }

            // Sekolah Pilihan dynamically based on Jenjang
            const sekolahData = @json($sekolahGrouped);
            const jenjangSelect = document.getElementById('jenjang');
            const sekolahPilihan1 = document.getElementById('sekolah_pilihan_1');
            const sekolahPilihan2 = document.getElementById('sekolah_pilihan_2');

            function updateSchoolOptions() {
                const val1 = sekolahPilihan1.value;
                const val2 = sekolahPilihan2.value;

                // Reset all options (enable them)
                Array.from(sekolahPilihan1.options).forEach(opt => {
                    if (opt.value !== "") {
                        opt.disabled = false;
                    }
                });
                Array.from(sekolahPilihan2.options).forEach(opt => {
                    if (opt.value !== "") {
                        opt.disabled = false;
                    }
                });

                // Disable selected school from Choice 1 in Choice 2
                if (val1) {
                    Array.from(sekolahPilihan2.options).forEach(opt => {
                        if (opt.value === val1 && opt.value !== "") {
                            opt.disabled = true;
                        }
                    });
                }

                // Disable selected school from Choice 2 in Choice 1
                if (val2) {
                    Array.from(sekolahPilihan1.options).forEach(opt => {
                        if (opt.value === val2 && opt.value !== "") {
                            opt.disabled = true;
                        }
                    });
                }

                // Refresh Select2 to reflect disabled state
                if (window.jQuery && typeof jQuery.fn.select2 !== 'undefined') {
                    $(sekolahPilihan1).trigger('change.select2');
                    $(sekolahPilihan2).trigger('change.select2');
                }

                // Policy Check: Outside Residents on Domisili Path
                const isLuar = kabupatenSelect.value == "9999";
                const isDomisili = jalur.options[jalur.selectedIndex] ? jalur.options[jalur.selectedIndex].text.toLowerCase().includes('domisili') : false;

                if (isLuar && isDomisili) {
                    const sel1 = sekolahPilihan1.options[sekolahPilihan1.selectedIndex];
                    const sel2 = sekolahPilihan2.options[sekolahPilihan2.selectedIndex];

                    if (val1 && sel1 && sel1.getAttribute('data-perbatasan') != '1') {
                        Swal.fire({
                            title: "Peringatan Luar Daerah",
                            text: "Maaf, pendaftar dari luar Kota Lhokseumawe hanya diperbolehkan mendaftar melalui jalur Domisili pada Sekolah Perbatasan.",
                            icon: "error"
                        });
                        sekolahPilihan1.value = "";
                        $(sekolahPilihan1).val('').trigger('change');
                    }

                    if (val2 && sel2 && sel2.getAttribute('data-perbatasan') != '1') {
                        // Silent reset or same swal
                        sekolahPilihan2.value = "";
                        $(sekolahPilihan2).val('').trigger('change');
                    }
                }

                calculateDistances();
            }

            if (sekolahPilihan1) {
                sekolahPilihan1.addEventListener('change', updateSchoolOptions);
                $(sekolahPilihan1).on('select2:select', updateSchoolOptions);
            }
            if (sekolahPilihan2) {
                sekolahPilihan2.addEventListener('change', updateSchoolOptions);
                $(sekolahPilihan2).on('select2:select', updateSchoolOptions);
            }

            function calculateDistanceHav(lat1, lon1, lat2, lon2) {
                if(!lat1 || !lon1 || !lat2 || !lon2) return 0;
                const R = 6371; // km
                const dLat = (lat2 - lat1) * Math.PI / 180;
                const dLon = (lon2 - lon1) * Math.PI / 180;
                const a = Math.sin(dLat/2) * Math.sin(dLat/2) +
                          Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                          Math.sin(dLon/2) * Math.sin(dLon/2);
                const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
                return R * c;
            }

            function calculateDistances() {
                const pendaftarLat = parseFloat(document.getElementById('latitude').value);
                const pendaftarLng = parseFloat(document.getElementById('longitude').value);

                // hitung sekolah 1
                const sek1 = document.getElementById('sekolah_pilihan_1');
                const inputJarak1 = document.getElementById('jarak_sekolah_1');
                if (sek1 && sek1.selectedIndex > 0 && !isNaN(pendaftarLat) && !isNaN(pendaftarLng)) {
                    const selectedOption = sek1.options[sek1.selectedIndex];
                    const lat = parseFloat(selectedOption.getAttribute('data-lat'));
                    const lng = parseFloat(selectedOption.getAttribute('data-lng'));
                    if (!isNaN(lat) && !isNaN(lng)) {
                        const distance = calculateDistanceHav(pendaftarLat, pendaftarLng, lat, lng);
                        inputJarak1.value = distance.toFixed(2);
                    } else {
                        inputJarak1.value = 'Koordinat tidak valid';
                    }
                } else {
                    if(inputJarak1) inputJarak1.value = '';
                }

                // hitung sekolah 2
                const sek2 = document.getElementById('sekolah_pilihan_2');
                const inputJarak2 = document.getElementById('jarak_sekolah_2');
                if (sek2 && sek2.selectedIndex > 0 && !isNaN(pendaftarLat) && !isNaN(pendaftarLng)) {
                    const selectedOption = sek2.options[sek2.selectedIndex];
                    const lat = parseFloat(selectedOption.getAttribute('data-lat'));
                    const lng = parseFloat(selectedOption.getAttribute('data-lng'));
                    if (!isNaN(lat) && !isNaN(lng)) {
                        const distance = calculateDistanceHav(pendaftarLat, pendaftarLng, lat, lng);
                        inputJarak2.value = distance.toFixed(2);
                    } else {
                        inputJarak2.value = 'Koordinat tidak valid';
                    }
                } else {
                    if(inputJarak2) inputJarak2.value = '';
                }
            }

            function renderSekolah(jenjang) {
                let optionsHTML1 = '<option value="" disabled selected>-- Pilih Sekolah --</option>';
                let optionsHTML2 = '<option value="" disabled selected>-- Pilih Sekolah --</option>';
                if (jenjang && sekolahData[jenjang]) {
                    for (const kecamatan in sekolahData[jenjang]) {
                        optionsHTML1 += `<optgroup label="Kecamatan ${kecamatan}">`;
                        optionsHTML2 += `<optgroup label="Kecamatan ${kecamatan}">`;
                        sekolahData[jenjang][kecamatan].forEach(sekolah => {
                            let perbatasanText = sekolah.status_perbatasan == 1 ? ' [Sekolah Perbatasan]' : '';
                            optionsHTML1 += `<option value="${sekolah.id}" data-lat="${sekolah.latitude}" data-lng="${sekolah.longitude}" data-perbatasan="${sekolah.status_perbatasan}">${sekolah.nama_sekolah}${perbatasanText}</option>`;

                            // Jika sekolah tidak di-set hanya untuk pilihan 1
                            if (sekolah.status_pilihan_1 != 1) {
                                optionsHTML2 += `<option value="${sekolah.id}" data-lat="${sekolah.latitude}" data-lng="${sekolah.longitude}" data-perbatasan="${sekolah.status_perbatasan}">${sekolah.nama_sekolah}${perbatasanText}</option>`;
                            }
                        });
                        optionsHTML1 += `</optgroup>`;
                        optionsHTML2 += `</optgroup>`;
                    }
                }
                sekolahPilihan1.innerHTML = optionsHTML1;
                sekolahPilihan2.innerHTML = optionsHTML2;

                // Refresh Select2 if applicable
                if (window.jQuery && typeof jQuery.fn.select2 !== 'undefined') {
                    $(sekolahPilihan1).trigger('change');
                    $(sekolahPilihan2).trigger('change');
                }

                updateSchoolOptions();
            }

            if (jenjangSelect) {
                jenjangSelect.addEventListener('change', function() {
                    renderSekolah(this.value);

                    // Sesuaikan penegasan validasi di JS
                    if (sekolahPilihan1) sekolahPilihan1.required = true;

                    // Pilihan 2 hanya required jika jalur Domisili
                    const selectedText = jalur.options[jalur.selectedIndex] ? jalur.options[jalur.selectedIndex].text.toLowerCase() : '';
                    if (sekolahPilihan2) {
                        sekolahPilihan2.required = selectedText.includes('domisili');
                    }

                    // Mengulang status HTML native `was-validated` karena pilihan baru saja di reset
                    const form = document.querySelector('.needs-validation');
                    if (form) form.classList.remove('was-validated');
                });

                // Initial load
                if (jenjangSelect.value) {
                    renderSekolah(jenjangSelect.value);

                    // Sesuaikan penegasan validasi di JS
                    if (sekolahPilihan1) sekolahPilihan1.required = true;

                    // Pilihan 2 hanya required jika jalur Domisili
                    const selectedText = jalur.options[jalur.selectedIndex] ? jalur.options[jalur.selectedIndex].text.toLowerCase() : '';
                    if (sekolahPilihan2) {
                        sekolahPilihan2.required = selectedText.includes('domisili');
                    }

                    @if ($mode == 'edit' || old('sekolah_pilihan_1') || old('sekolah_pilihan_2'))
                        const selectedSekolah1 = "{{ old('sekolah_pilihan_1', $data->sekolah_pilihan_1 ?? '') }}";
                        const selectedSekolah2 = "{{ old('sekolah_pilihan_2', $data->sekolah_pilihan_2 ?? '') }}";

                        if (selectedSekolah1) {
                            sekolahPilihan1.value = selectedSekolah1;
                        }
                        if (selectedSekolah2) {
                            sekolahPilihan2.value = selectedSekolah2;
                        }

                        updateSchoolOptions();
                    @endif
                }
            }

            // Bootstrap form validation
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    const isDraft = event.submitter && event.submitter.value === 'draft';

                    // Reset visual validation state
                    form.classList.remove('was-validated');
                    form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));

                    let isValid = true;
                    if (isDraft) {
                        // Minimal validation for Draft: Jalur, Jenjang, Nama, NIK, NISN, Wilayah
                        let minimalFields = ['jalur', 'jenjang', 'nama_lengkap', 'nik', 'nisn', 'provinsi', 'kabupaten', 'sekolah_pilihan_1'];
                        
                        if (kabupatenSelect.value == "1173") {
                            minimalFields.push('kecamatan', 'desa');
                        } else {
                            minimalFields.push('kabupaten_nama_luar');
                        }

                        minimalFields.forEach(id => {
                            const field = document.getElementById(id);
                            if (field && !field.checkValidity()) {
                                field.classList.add('is-invalid'); // Manual highlight only for failing minimal fields
                                isValid = false;
                            }
                        });
                    } else {
                        // Full validation for Submit
                        isValid = form.checkValidity();
                    }

                    if (!isValid) {
                        event.preventDefault()
                        event.stopPropagation()

                        // Temukan tab pertama yang memiliki error dan pindah ke sana
                        const firstInvalid = form.querySelector(':invalid, .is-invalid');
                        if (firstInvalid) {
                            const tabPane = firstInvalid.closest('.tab-pane');
                            if (tabPane) {
                                const tabTrigger = document.getElementById(tabPane.id + '-tab');
                                if (tabTrigger) {
                                    const tab = new bootstrap.Tab(tabTrigger);
                                    tab.show();

                                    // Beri sedikit delay agar transisi tab selesai sebelum scroll
                                    setTimeout(() => {
                                        firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                                        if (firstInvalid.focus) firstInvalid.focus();
                                    }, 150);
                                }
                            }
                        }

                        // Show error alert
                        Swal.fire({
                            text: isDraft
                                ? "Mohon lengkapi data minimal (Pilihan Sekolah 1, Jalur, Jenjang, Identitas & Wilayah) sebelum simpan sebagai draft."
                                : "Mohon lengkapi seluruh field yang wajib diisi. Silakan periksa kembali pada setiap tab sebelumnya.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, Mengerti!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });

                        // Only show global validation state if it's NOT a draft
                        if (!isDraft) {
                            form.classList.add('was-validated');
                        }

                        return;
                    }

                    // If valid and submit button clicked, show confirmation
                    if (event.submitter && event.submitter.value === 'submit') {
                        event.preventDefault(); // Stop normal submission to show Swal

                        Swal.fire({
                            title: "Konfirmasi Pendaftaran",
                            html: "Saya menyatakan bahwa seluruh data yang diisikan adalah benar dan dapat dipertanggungjawabkan sesuai ketentuan yang berlaku.<br><br><b>Perhatian:</b> Data yang sudah di-submit tidak dapat diubah kembali.",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonText: "Ya, Mendaftar",
                            cancelButtonText: "Batal",
                            customClass: {
                                confirmButton: "btn btn-success",
                                cancelButton: "btn btn-secondary"
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Inject hidden input for status to simulate submitter value
                                let hiddenInput = document.createElement('input');
                                hiddenInput.type = 'hidden';
                                hiddenInput.name = 'status';
                                hiddenInput.value = 'submit';
                                form.appendChild(hiddenInput);

                                form.submit(); // Bypass listener and native submit
                            }
                        });
                    }

                }, false)
            })

            // Show session messages if available
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
