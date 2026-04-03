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
            <form action="{{ $mode == 'create' ? route('pendaftaran.store') : route('pendaftaran.update', $data->id) }}" method="POST" enctype="multipart/form-data">
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
                                <select class="form-control" id="jalur" name="jalur" required>
                                    {{-- data jalur yang telah diambil oleh peserta --}}
                                    @if ($mode == 'edit')
                                        <option value="" disabled selected>Pilih Jalur Pendaftaran</option>
                                        @foreach ($jalur_pendaftaran as $jalur)
                                            <option value="{{ $jalur->jalur_id }}" {{ $data->jalur_id == $jalur->jalur_id ? 'selected' : '' }}>{{ $jalur->nama_jalur }}</option>
                                        @endforeach
                                    @else
                                        <option value="" disabled selected>Pilih Jalur Pendaftaran</option>
                                        @foreach ($jalur_pendaftaran as $jalur)
                                            <option value="{{ $jalur->jalur_id }}">{{ $jalur->nama_jalur }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="jenjang" class="form-label">Jenjang</label>
                                <select class="form-control" id="jenjang" name="jenjang" required>
                                    {{-- data jenjang yang telah diambil oleh peserta --}}
                                    @if ($mode == 'edit')
                                        <option value="" disabled selected>Pilih Jenjang</option>
                                    {{-- Dropdown biasa: SD, SMP --}}
                                    <option value="SD" {{ $data->jenjang == 'SD' ? 'selected' : '' }}>SD</option>
                                    <option value="SMP" {{ $data->jenjang == 'SMP' ? 'selected' : '' }}>SMP</option>
                                    @else
                                        <option value="" disabled selected>Pilih Jenjang</option>
                                        <option value="SD">SD</option>
                                        <option value="SMP">SMP</option>
                                    @endif
                                </select>
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
                                <input type="text" class="form-control" id="nik" name="nik" value="{{ $peserta->nik }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="nisn" class="form-label">Nomor Induk Siswa Nasional (NISN)</label>
                                <input type="text" class="form-control" id="nisn" name="nisn" value="{{ $peserta->nisn }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="{{ $peserta->nama_lengkap }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                    <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                    <option value="L" {{ $peserta->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ $peserta->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="agama" class="form-label">Agama</label>
                                <select class="form-control" id="agama" name="agama" required>
                                    <option value="" disabled selected>Pilih Agama</option>
                                    <option value="Islam" {{ $peserta->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="Kristen" {{ $peserta->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                    <option value="Katolik" {{ $peserta->agama == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                    <option value="Hindu" {{ $peserta->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="Buddha" {{ $peserta->agama == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                    <option value="Konghucu" {{ $peserta->agama == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{ $peserta->tempat_lahir }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ $peserta->tanggal_lahir }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nomor_kk" class="form-label">Nomor Kartu Keluarga (KK)</label>
                                <input type="text" class="form-control" id="nomor_kk" name="nomor_kk" value="{{ $peserta->nomor_kk }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal_kk" class="form-label">Tanggal Penerbitan KK</label>
                                <input type="date" class="form-control" id="tanggal_kk" name="tanggal_terbit_kk" value="{{ $peserta->tanggal_terbit_kk }}" required>
                            </div>
                        </div>

                        {{-- Wilayah --}}
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="provinsi" class="form-label">Provinsi</label>
                                <select class="form-control" id="provinsi" name="provinsi" required>
                                    @if ($mode == 'edit')
                                        <option value="" disabled>Pilih Provinsi</option>
                                        @foreach ($provinsi as $item)
                                            <option value="{{ $item->id }}" {{ $item->id == $peserta->provinsi_id ? 'selected' : '' }}>{{ $item->nama_provinsi }}</option>
                                        @endforeach
                                    @else
                                        <option value="" disabled selected>Pilih Provinsi</option>
                                        @foreach ($provinsi as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_provinsi }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="kabupaten" class="form-label">Kabupaten/Kota</label>
                                <select class="form-control" id="kabupaten" name="kabupaten" required>
                                    @if ($mode == 'edit')
                                        <option value="" disabled>Pilih Kabupaten/Kota</option>
                                        @foreach ($kabupaten as $item)
                                            <option value="{{ $item->id }}" {{ $item->id == $peserta->kabupaten_id ? 'selected' : '' }}>{{ $item->nama_kabupaten }}</option>
                                        @endforeach
                                    @else
                                        <option value="" disabled selected>Pilih Kabupaten/Kota</option>
                                        @foreach ($kabupaten as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_kabupaten }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="kecamatan" class="form-label">Kecamatan</label>
                                <select class="form-control" id="kecamatan" name="kecamatan" required>
                                    @if ($mode == 'edit')
                                        <option value="" disabled>Pilih Kecamatan</option>
                                        @foreach ($kecamatan as $item)
                                            <option value="{{ $item->id }}" {{ $item->id == $peserta->kecamatan_id ? 'selected' : '' }}>{{ $item->nama_kecamatan }}</option>
                                        @endforeach
                                    @else
                                        <option value="" disabled selected>Pilih Kecamatan</option>
                                        @foreach ($kecamatan as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_kecamatan }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="desa" class="form-label">Desa/Kelurahan</label>
                                <select class="form-control" id="desa" name="desa" required>
                                    @if ($mode == 'edit')
                                        <option value="" disabled>Pilih Desa/Kelurahan</option>
                                        @foreach ($desa as $item)
                                            <option value="{{ $item->id }}" {{ $item->id == $peserta->desa_id ? 'selected' : '' }}>{{ $item->nama_desa }}</option>
                                        @endforeach
                                    @else
                                        <option value="" disabled selected>Pilih Desa/Kelurahan</option>
                                        @foreach ($desa as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_desa }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-12">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ $peserta->alamat }}</textarea>
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
                                <input type="text" class="form-control" id="latitude" name="latitude" value="{{ $peserta->latitude }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="longitude" class="form-label">Longitude</label>
                                <input type="text" class="form-control" id="longitude" name="longitude" value="{{ $peserta->longitude }}" required>
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
                                <input type="text" class="form-control" id="nama_wali" name="nama_wali" value="{{ $peserta->nama_wali ?? '' }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="pekerjaan_wali" class="form-label">Pekerjaan Wali</label>
                                <input type="text" class="form-control" id="pekerjaan_wali" name="pekerjaan_wali" value="{{ $peserta->pekerjaan_wali ?? '' }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="no_hp_wali" class="form-label">No. HP Wali</label>
                                <input type="text" class="form-control" id="no_hp_wali" name="no_hp_wali" value="{{ $peserta->no_hp_wali ?? '' }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="alamat_wali" class="form-label">Alamat Wali</label>
                                <textarea class="form-control" id="alamat_wali" name="alamat_wali" rows="3" required>{{ $peserta->alamat_wali ?? '' }}</textarea>
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
                                <input type="file" class="form-control" id="pasfoto" name="pasfoto" required>
                            </div>
                            <div class="col-md-6">
                                <label for="akta_lahir" class="form-label">Akta Lahir</label>
                                <input type="file" class="form-control" id="akta_lahir" name="akta_lahir" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="kk" class="form-label">Kartu Keluarga</label>
                                <input type="file" class="form-control" id="kk" name="kk" required>
                            </div>
                            <div class="col-md-6">
                                <label for="ktp_orang_tua" class="form-label">KTP Orang Tua</label>
                                <input type="file" class="form-control" id="ktp_orang_tua" name="ktp_orang_tua" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-4" id="kartu_pkh_container" style="display: none;">
                                <label for="kartu_pkh" class="form-label">Kartu PKH (Jalur Afirmasi)</label>
                                <input type="file" class="form-control" id="kartu_pkh" name="kartu_pkh">
                            </div>
                            <div class="col-md-4" id="surat_dokter_container" style="display: none;">
                                <label for="surat_dokter" class="form-label">Surat Keterangan Dokter/Disabilitas (Afirmasi)</label>
                                <input type="file" class="form-control" id="surat_dokter" name="surat_dokter">
                            </div>
                            <div class="col-md-4" id="surat_pindah_container" style="display: none;">
                                <label for="surat_pindah" class="form-label">Surat Keterangan Pindah (Jalur Mutasi)</label>
                                <input type="file" class="form-control" id="surat_pindah" name="surat_pindah">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6" id="prestasi_akademik_container" style="display: none;">
                                <h5 class="mb-3">Dokumen Prestasi Akademik (Jalur Prestasi)</h5>
                                <div class="mb-3">
                                    <label for="nilai_tka" class="form-label">Nilai TKA</label>
                                    <input type="number" class="form-control" id="nilai_tka" name="nilai_tka" placeholder="Masukkan Nilai TKA">
                                </div>
                                <div>
                                    <label for="dokumen_tka" class="form-label">Dokumen Hasil Tes TKA</label>
                                    <input type="file" class="form-control" id="dokumen_tka" name="dokumen_tka">
                                </div>
                            </div>
                            <div class="col-md-6" id="prestasi_nonakademik_container" style="display: none;">
                                <h5 class="mb-3">Dokumen Prestasi Non-Akademik (Jalur Prestasi)</h5>
                                <div class="mb-3">
                                    <label for="nama_perlombaan" class="form-label">Nama Perlombaan</label>
                                    <input type="text" class="form-control" id="nama_perlombaan" name="nama_perlombaan" placeholder="Masukkan Nama Perlombaan">
                                </div>
                                <div>
                                    <label for="sertifikat_penghargaan" class="form-label">Sertifikat Penghargaan</label>
                                    <input type="file" class="form-control" id="sertifikat_penghargaan" name="sertifikat_penghargaan">
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
                                <select class="form-control select2" id="sekolah_pilihan_1" name="sekolah_pilihan_1" required>
                                    <option value="" disabled selected>-- Pilih Sekolah --</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="sekolah_pilihan_2" class="form-label">Pilihan 2</label>
                                <select class="form-control select2" id="sekolah_pilihan_2" name="sekolah_pilihan_2">
                                    <option value="" disabled selected>-- Pilih Sekolah --</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-secondary btn-prev" data-prev="step3">Sebelumnya</button>
                            <button type="button" class="btn btn-primary btn-next" data-next="step5">Selanjutnya</button>
                        </div>
                    </div>

                    <!-- Step 5: Submit -->
                    <div class="tab-pane fade" id="step5" role="tabpanel">
                        <div class="alert alert-warning mb-5">
                            <div class="d-flex flex-column">
                                <h4 class="mb-1 text-dark">Perhatian</h4>
                                <span>Pastikan semua data dan dokumen telah diisi dengan benar sebelum menyimpan pendaftaran ini.</span>
                            </div>
                        </div>

                        <div class="form-check form-check-custom form-check-solid mb-5">
                            <input class="form-check-input" type="checkbox" value="1" id="terms" name="terms" required/>
                            <label class="form-check-label" for="terms">
                                Saya menyatakan bahwa seluruh data yang diisikan adalah benar
                            </label>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-secondary btn-prev" data-prev="step4">Sebelumnya</button>
                            <button type="submit" class="btn btn-success">Simpan Pendaftaran</button>
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
            } else if (latInput) {
                latInput.value = defaultLat.toFixed(6);
            }

            if(lngInput && lngInput.value && !isNaN(lngInput.value)) {
                defaultLng = parseFloat(lngInput.value);
            } else if (lngInput) {
                lngInput.value = defaultLng.toFixed(6);
            }

            const map = L.map('map').setView([defaultLat, defaultLng], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            let marker = L.marker([defaultLat, defaultLng], {
                draggable: true
            }).addTo(map);

            // Update inputs when marker is dragged
            marker.on('dragend', function (e) {
                const position = marker.getLatLng();
                latInput.value = position.lat.toFixed(6);
                lngInput.value = position.lng.toFixed(6);
            });

            // Update marker and inputs when map is clicked
            map.on('click', function(e) {
                marker.setLatLng(e.latlng);
                latInput.value = e.latlng.lat.toFixed(6);
                lngInput.value = e.latlng.lng.toFixed(6);
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


            // -- End Leaflet Map Initialization --

            const jalur = document.getElementById('jalur');
            const nextBtn = document.getElementById('nextToProfil');

            function toggleDokumen() {
                const kartuPkhContainer = document.getElementById('kartu_pkh_container');
                const suratDokterContainer = document.getElementById('surat_dokter_container');
                const suratPindahContainer = document.getElementById('surat_pindah_container');
                const prestasiAkademikContainer = document.getElementById('prestasi_akademik_container');
                const prestasiNonakademikContainer = document.getElementById('prestasi_nonakademik_container');
                const jenjangSelect = document.getElementById('jenjang');

                let selectedText = '';
                if (jalur.selectedIndex !== -1) {
                    selectedText = jalur.options[jalur.selectedIndex].text.toLowerCase();
                }

                if (selectedText.includes('mutasi')) {
                    kartuPkhContainer.style.display = 'none';
                    suratDokterContainer.style.display = 'none';
                    suratPindahContainer.style.display = 'block';
                    if(prestasiAkademikContainer) prestasiAkademikContainer.style.display = 'none';
                    if(prestasiNonakademikContainer) prestasiNonakademikContainer.style.display = 'none';
                } else if (selectedText.includes('afirmasi')) {
                    kartuPkhContainer.style.display = 'block';
                    suratDokterContainer.style.display = 'block';
                    suratPindahContainer.style.display = 'none';
                    if(prestasiAkademikContainer) prestasiAkademikContainer.style.display = 'none';
                    if(prestasiNonakademikContainer) prestasiNonakademikContainer.style.display = 'none';
                } else if (selectedText.includes('prestasi')) {
                    kartuPkhContainer.style.display = 'none';
                    suratDokterContainer.style.display = 'none';
                    suratPindahContainer.style.display = 'none';
                    if(prestasiAkademikContainer) prestasiAkademikContainer.style.display = 'block';
                    if(prestasiNonakademikContainer) prestasiNonakademikContainer.style.display = 'block';
                } else {
                    kartuPkhContainer.style.display = 'none';
                    suratDokterContainer.style.display = 'none';
                    suratPindahContainer.style.display = 'none';
                    if(prestasiAkademikContainer) prestasiAkademikContainer.style.display = 'none';
                    if(prestasiNonakademikContainer) prestasiNonakademikContainer.style.display = 'none';
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
            const provinsiSelect = document.getElementById('provinsi');
            const kabupatenSelect = document.getElementById('kabupaten');
            const kecamatanSelect = document.getElementById('kecamatan');
            const desaSelect = document.getElementById('desa');

            if (provinsiSelect) {
                provinsiSelect.addEventListener('change', function() {
                    const provinsiId = this.value;
                    
                    // Reset children
                    kabupatenSelect.innerHTML = '<option value="" disabled selected>Memuat...</option>';
                    kecamatanSelect.innerHTML = '<option value="" disabled selected>Pilih Kecamatan</option>';
                    desaSelect.innerHTML = '<option value="" disabled selected>Pilih Desa/Kelurahan</option>';

                    if (provinsiId) {
                        fetch(`/wilayah/kabupaten/${provinsiId}`)
                            .then(response => response.json())
                            .then(data => {
                                kabupatenSelect.innerHTML = '<option value="" disabled selected>Pilih Kabupaten/Kota</option>';
                                data.forEach(item => {
                                    kabupatenSelect.innerHTML += `<option value="${item.id}">${item.nama_kabupaten}</option>`;
                                });
                            })
                            .catch(error => {
                                console.error('Error fetching kabupaten:', error);
                                kabupatenSelect.innerHTML = '<option value="" disabled selected>Gagal memuat data</option>';
                            });
                    }
                });
            }

            if (kabupatenSelect) {
                kabupatenSelect.addEventListener('change', function() {
                    const kabupatenId = this.value;
                    
                    // Reset children
                    kecamatanSelect.innerHTML = '<option value="" disabled selected>Memuat...</option>';
                    desaSelect.innerHTML = '<option value="" disabled selected>Pilih Desa/Kelurahan</option>';

                    if (kabupatenId) {
                        fetch(`/wilayah/kecamatan/${kabupatenId}`)
                            .then(response => response.json())
                            .then(data => {
                                kecamatanSelect.innerHTML = '<option value="" disabled selected>Pilih Kecamatan</option>';
                                data.forEach(item => {
                                    kecamatanSelect.innerHTML += `<option value="${item.id}">${item.nama_kecamatan}</option>`;
                                });
                            })
                            .catch(error => {
                                console.error('Error fetching kecamatan:', error);
                                kecamatanSelect.innerHTML = '<option value="" disabled selected>Gagal memuat data</option>';
                            });
                    }
                });
            }

            if (kecamatanSelect) {
                kecamatanSelect.addEventListener('change', function() {
                    const kecamatanId = this.value;
                    
                    // Reset children
                    desaSelect.innerHTML = '<option value="" disabled selected>Memuat...</option>';

                    if (kecamatanId) {
                        fetch(`/wilayah/desa/${kecamatanId}`)
                            .then(response => response.json())
                            .then(data => {
                                desaSelect.innerHTML = '<option value="" disabled selected>Pilih Desa/Kelurahan</option>';
                                data.forEach(item => {
                                    desaSelect.innerHTML += `<option value="${item.id}">${item.nama_desa}</option>`;
                                });
                            })
                            .catch(error => {
                                console.error('Error fetching desa:', error);
                                desaSelect.innerHTML = '<option value="" disabled selected>Gagal memuat data</option>';
                            });
                    }
                });
            }

            // Wizard navigation logic
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

            // Sekolah Pilihan dynamically based on Jenjang
            const sekolahData = @json($sekolahGrouped);
            const jenjangSelect = document.getElementById('jenjang');
            const sekolahPilihan1 = document.getElementById('sekolah_pilihan_1');
            const sekolahPilihan2 = document.getElementById('sekolah_pilihan_2');

            function renderSekolah(jenjang) {
                let optionsHTML = '<option value="" disabled selected>-- Pilih Sekolah --</option>';
                if (jenjang && sekolahData[jenjang]) {
                    for (const kecamatan in sekolahData[jenjang]) {
                        optionsHTML += `<optgroup label="Kecamatan ${kecamatan}">`;
                        sekolahData[jenjang][kecamatan].forEach(sekolah => {
                            optionsHTML += `<option value="${sekolah.id}">${sekolah.nama_sekolah}</option>`;
                        });
                        optionsHTML += `</optgroup>`;
                    }
                }
                sekolahPilihan1.innerHTML = optionsHTML;
                sekolahPilihan2.innerHTML = optionsHTML;
            }

            if (jenjangSelect) {
                jenjangSelect.addEventListener('change', function() {
                    renderSekolah(this.value);
                });

                // Initial load
                if (jenjangSelect.value) {
                    renderSekolah(jenjangSelect.value);
                    
                    @if ($mode == 'edit')
                        // Set selected values for edit mode
                        const selectedSekolah1 = "{{ $data->sekolah_pilihan_1 ?? '' }}";
                        const selectedSekolah2 = "{{ $data->sekolah_pilihan_2 ?? '' }}";
                        
                        if (selectedSekolah1) {
                            sekolahPilihan1.value = selectedSekolah1;
                        }
                        if (selectedSekolah2) {
                            sekolahPilihan2.value = selectedSekolah2;
                        }
                    @endif
                }
            }

        });
    </script>
@endsection
