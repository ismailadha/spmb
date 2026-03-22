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
            <form action="{{ route('sekolah.store') }}" method="POST">
                @csrf

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
                            <option value="TK">TK</option>
                            <option value="SD">SD</option>
                            <option value="SMP">SMP</option>
                            <option value="SMA">SMA</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="npsn" class="form-label">NPSN</label>
                        <input type="text" class="form-control" id="npsn" name="npsn">
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

                <!-- Status Perbatasan -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="status_perbatasan" class="form-label">Status Perbatasan</label>
                        <select class="form-control" id="status_perbatasan" name="status_perbatasan">
                            <option value="">-- Pilih Status --</option>
                            <option value="1">Sekolah Perbatasan</option>
                            <option value="0">Sekolah Non-Perbatasan</option>
                        </select>
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
        });
    </script>
@endsection
