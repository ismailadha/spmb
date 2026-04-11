@extends('backend.main')

@section('sekolah-menu-active')
    active
@endsection

@section('sekolah-menu-open')
    show
@endsection

@section('content')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <style>
        #map {
            height: 400px;
            width: 100%;
            border-radius: 8px;
            z-index: 1;
        }
    </style>

    <!--begin::Card-->
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <h3>Tambah Sekolah</h3>
            </div>
            <!--begin::Card title-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body py-4">
            <form action="{{ route('sekolah.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- Thumbnail Upload -->
                <div class="row mb-6">
                    <label class="col-12 form-label fw-bold fs-6">Logo/Thumbnail Sekolah</label>
                    <div class="col-12">
                        <div id="thumbnail-upload-container">
                            <div id="thumbnail-preview-container" class="mb-4 d-none text-center bg-light p-5 rounded border border-dashed border-gray-400">
                                <img id="thumbnail-preview" src="" alt="Preview Thumbnail" style="max-height: 200px; max-width: 100%; object-fit: contain;">
                                <div class="mt-3">
                                    <button type="button" class="btn btn-sm btn-danger" id="remove-thumbnail-btn">
                                        <i class="ki-duotone ki-trash fs-4">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        Hapus Foto
                                    </button>
                                </div>
                            </div>

                            <div id="thumbnail-upload-prompt">
                                <input type="file" name="thumbnail" id="thumbnail-input" class="form-control" accept=".png, .jpg, .jpeg" />
                                <div class="form-text mt-2">Format: PNG, JPG, JPEG • Maksimal 2MB</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Nama Sekolah - Full Width -->
                <div class="row mb-3">
                    <div class="col-12">
                        <label for="nama_sekolah" class="form-label">Nama Sekolah</label>
                        <input type="text" class="form-control" id="nama_sekolah" name="nama_sekolah" required>
                    </div>
                </div>

                <!-- Jenjang & NPSN -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="jenjang" class="form-label">Jenjang</label>
                        <select class="form-control" id="jenjang" name="jenjang" required>
                            <option value="">-- Pilih Jenjang --</option>
                            <option value="SD">SD</option>
                            <option value="SMP">SMP</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="npsn" class="form-label">NPSN</label>
                        <input type="text" class="form-control" id="npsn" name="npsn">
                    </div>
                </div>

                <!-- Daya Tampung -->
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="total_daya_tampung" class="form-label fw-bold">Total Daya Tampung</label>
                        <input type="number" class="form-control bg-light" id="total_daya_tampung" readonly min="0" placeholder="Total dari semua jalur">
                        <small class="text-muted">Jumlah maksimal peserta didik yang dapat ditampung secara keseluruhan.</small>
                    </div>
                </div>

                <div class="row mb-6">
                    <div class="col-md-3">
                        <label for="daya_tampung_prestasi" class="form-label">Quota Prestasi</label>
                        <input type="number" class="form-control" id="daya_tampung_prestasi" name="daya_tampung_prestasi" required min="0" value="0">
                    </div>
                    <div class="col-md-3">
                        <label for="daya_tampung_domisili" class="form-label">Quota Domisili</label>
                        <input type="number" class="form-control" id="daya_tampung_domisili" name="daya_tampung_domisili" required min="0" value="0">
                    </div>
                    <div class="col-md-3">
                        <label for="daya_tampung_afirmasi" class="form-label">Quota Afirmasi</label>
                        <input type="number" class="form-control" id="daya_tampung_afirmasi" name="daya_tampung_afirmasi" required min="0" value="0">
                    </div>
                    <div class="col-md-3">
                        <label for="daya_tampung_mutasi" class="form-label">Quota Mutasi</label>
                        <input type="number" class="form-control" id="daya_tampung_mutasi" name="daya_tampung_mutasi" required min="0" value="0">
                    </div>
                </div>

                <!-- Registrasi Wilayah -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="id_provinsi" class="form-label">Provinsi</label>
                        <select class="form-control" id="id_provinsi" name="id_provinsi">
                            <option value="" disabled selected>Pilih Provinsi</option>
                            @foreach ($provinsi as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_provinsi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="id_kabupaten" class="form-label">Kabupaten/Kota</label>
                        <select class="form-control" id="id_kabupaten" name="id_kabupaten">
                            <option value="" disabled selected>Pilih Kabupaten/Kota</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="id_kecamatan" class="form-label">Kecamatan</label>
                        <select class="form-control" id="id_kecamatan" name="id_kecamatan">
                            <option value="" disabled selected>Pilih Kecamatan</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="id_desa" class="form-label">Desa/Kelurahan</label>
                        <select class="form-control" id="id_desa" name="id_desa">
                            <option value="" disabled selected>Pilih Desa/Kelurahan</option>
                        </select>
                    </div>
                </div>

                <!-- Alamat - Full Width -->
                <div class="row mb-3">
                    <div class="col-12">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat">
                    </div>
                </div>

                <!-- Telepon & Email -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="telepon" class="form-label">Telepon</label>
                        <input type="text" class="form-control" id="telepon" name="telepon">
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                </div>

                <!-- Kode Pos & Website -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="kode_pos" class="form-label">Kode Pos</label>
                        <input type="text" class="form-control" id="kode_pos" name="kode_pos">
                    </div>
                    <div class="col-md-6">
                        <label for="website" class="form-label">Website</label>
                        <input type="url" class="form-control" id="website" name="website">
                    </div>
                </div>

                <!-- Latitude & Longitude -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="latitude" class="form-label">Latitude</label>
                        <input type="number" step="any" class="form-control" id="latitude" name="latitude">
                    </div>
                    <div class="col-md-6">
                        <label for="longitude" class="form-label">Longitude</label>
                        <input type="number" step="any" class="form-control" id="longitude" name="longitude">
                    </div>
                </div>

                <!-- Map Container -->
                <div class="row mb-3">
                    <div class="col-12">
                        <label class="form-label">Tentukan Lokasi pada Peta</label>
                        <div id="map"></div>
                        <small class="text-muted">Klik pada peta atau geser marker untuk menentukan koordinat.</small>
                    </div>
                </div>

                <!-- Status Perbatasan & Status Unggulan -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="status_perbatasan" class="form-label">Status Perbatasan</label>
                        <select class="form-control" id="status_perbatasan" name="status_perbatasan">
                            <option value="">-- Pilih Status --</option>
                            <option value="1">Sekolah Perbatasan</option>
                            <option value="0">Sekolah Non-Perbatasan</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label d-block">Status Pilihan 1</label>
                        <div class="form-check form-switch mt-2">
                            <input type="hidden" name="status_pilihan_1" value="0">
                            <input class="form-check-input" type="checkbox" role="switch" name="status_pilihan_1" id="status_pilihan_1" value="1">
                            <label class="form-check-label" for="status_pilihan_1">Sekolah Pilihan 1</label>
                        </div>
                        <small class="text-muted">Aktifkan untuk menjadikan sebagai Sekolah Pilihan 1. (Jika dimatikan, akan menjadi Pilihan 2)</small>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('sekolah.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--end::Card-->
@endsection

@section('scripts')
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Thumbnail Preview Logic
            const fileInput = document.getElementById('thumbnail-input');
            const previewContainer = document.getElementById('thumbnail-preview-container');
            const uploadPrompt = document.getElementById('thumbnail-upload-prompt');
            const thumbnailPreview = document.getElementById('thumbnail-preview');
            const removeThumbnailBtn = document.getElementById('remove-thumbnail-btn');

            fileInput.addEventListener('change', function() {
                if (fileInput.files.length > 0) {
                    const file = fileInput.files[0];
                    const allowedTypes = ['image/png', 'image/jpeg', 'image/jpg'];
                    
                    if (!allowedTypes.includes(file.type)) {
                        alert('Format file tidak valid. Gunakan PNG atau JPG.');
                        fileInput.value = '';
                        return;
                    }

                    if (file.size > 2 * 1024 * 1024) {
                        alert('Ukuran file tidak boleh lebih dari 2MB.');
                        fileInput.value = '';
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = (e) => {
                        thumbnailPreview.src = e.target.result;
                        previewContainer.classList.remove('d-none');
                        uploadPrompt.classList.add('d-none');
                    };
                    reader.readAsDataURL(file);
                }
            });

            removeThumbnailBtn.addEventListener('click', function(e) {
                e.preventDefault();
                fileInput.value = '';
                previewContainer.classList.add('d-none');
                uploadPrompt.classList.remove('d-none');
                thumbnailPreview.src = '';
            });

            // Auto-calculate Total Daya Tampung
            const inputs = ['daya_tampung_prestasi', 'daya_tampung_domisili', 'daya_tampung_afirmasi', 'daya_tampung_mutasi'];
            const totalInput = document.getElementById('total_daya_tampung');

            inputs.forEach(id => {
                document.getElementById(id).addEventListener('input', function() {
                    let total = 0;
                    inputs.forEach(inputId => {
                        total += parseInt(document.getElementById(inputId).value) || 0;
                    });
                    totalInput.value = total;
                });
            });

            // Default location: Islamic Center Lhokseumawe
            var defaultLat = 5.179967;
            var defaultLng = 97.142055;

            var map = L.map('map').setView([defaultLat, defaultLng], 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            var marker = L.marker([defaultLat, defaultLng], {
                draggable: true
            }).addTo(map);

            var latInput = document.getElementById('latitude');
            var lngInput = document.getElementById('longitude');

            // Set initial value if inputs are populated (just in case browser autocompletes)
            if (latInput.value && lngInput.value) {
                var parseLat = parseFloat(latInput.value);
                var parseLng = parseFloat(lngInput.value);
                if (!isNaN(parseLat) && !isNaN(parseLng)) {
                    marker.setLatLng([parseLat, parseLng]);
                    map.setView([parseLat, parseLng], 15);
                }
            }

            // Update inputs when marker is dragged
            marker.on('dragend', function (e) {
                var position = marker.getLatLng();
                latInput.value = position.lat;
                lngInput.value = position.lng;
            });

            // Update marker when map is clicked
            map.on('click', function (e) {
                var lat = e.latlng.lat;
                var lng = e.latlng.lng;

                marker.setLatLng([lat, lng]);
                latInput.value = lat;
                lngInput.value = lng;
            });

            // Update marker when inputs change manually
            latInput.addEventListener('input', updateMapFromInputs);
            lngInput.addEventListener('input', updateMapFromInputs);

            function updateMapFromInputs() {
                var lat = parseFloat(latInput.value);
                var lng = parseFloat(lngInput.value);

                if (!isNaN(lat) && !isNaN(lng)) {
                    marker.setLatLng([lat, lng]);
                    map.setView([lat, lng]);
                }
            }

            // Dynamics Cascading Default for Wilayah
            const provinsiSelect = document.getElementById('id_provinsi');
            const kabupatenSelect = document.getElementById('id_kabupaten');
            const kecamatanSelect = document.getElementById('id_kecamatan');
            const desaSelect = document.getElementById('id_desa');

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
        });

        // Notifications
        @if (session('success'))
            Swal.fire({
                text: "{{ session('success') }}",
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
                text: "{{ session('error') }}",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Ok, Mengerti!",
                customClass: {
                    confirmButton: "btn btn-danger"
                }
            });
        @endif
    </script>
@endsection
