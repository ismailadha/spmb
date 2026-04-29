@extends('frontend.main')

@section('content')
<style>
    .hover-shadow {
        transition: all 0.3s ease;
    }
    .hover-shadow:hover {
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
        transform: translateY(-3px);
    }
    .card-img-wrapper {
        height: 200px;
        overflow: hidden;
        position: relative;
    }
    .card-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .school-card:hover .card-img-wrapper img {
        transform: scale(1.05);
    }
    .distance-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(5px);
        font-weight: 600;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .rounded-xl {
        border-radius: 1rem !important;
    }
    .rounded-top-xl {
        border-top-left-radius: 1rem !important;
        border-top-right-radius: 1rem !important;
    }
    .badge-soft-success {
        background-color: rgba(40, 167, 69, 0.1);
        color: #28a745;
        border: 1px solid rgba(40, 167, 69, 0.2);
    }
    .badge-soft-primary {
        background-color: rgba(0, 123, 255, 0.1);
        color: #007bff;
        border: 1px solid rgba(0, 123, 255, 0.2);
    }
    .form-label {
        font-weight: 600;
        color: #6c757d;
        margin-bottom: 0.5rem;
        display: inline-block;
    }
</style>

<!-- Hero Area / Breadcrumb -->
<section class="breadcrumb_area breadcrumb2 bgimage" style="background-image: url('https://images.unsplash.com/photo-1510531704581-5b2870972060?auto=format&fit=crop&w=1920&q=80'); background-size: cover; padding: 120px 0; background-position: center; position: relative; overflow: hidden;">
    <div class="overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(to right, rgba(30, 42, 74, 0.8), rgba(52, 152, 219, 0.4));"></div>
    <div class="container text-center position-relative" style="z-index: 2;">
        <h1 class="text-white font-weight-bold display-4 mb-2 animate__animated animate__fadeInDown">Cek Zonasi Sekolah</h1>
        <p class="text-white-50 lead animate__animated animate__fadeInUp">Temukan sekolah terdekat dari lokasi tempat tinggal Anda berdasarkan aturan zonasi PPDB</p>
    </div>
</section>

<div class="container pb-5">
    <!-- Filter/Search Box -->
    <div class="card border-0 shadow-sm rounded-xl mb-5 hover-shadow">
        <div class="card-body p-4 p-md-5">
            <form action="#" method="POST">
                <div class="row">
                    <!-- Kabupaten / Kota -->
                    <div class="col-md-4 mb-3 mb-md-0">
                        <label for="kabupaten" class="form-label">Kabupaten/Kota</label>
                        <select id="kabupaten" name="kabupaten" class="form-control form-control-lg custom-select bg-light">
                            <option>Kota Lhokseumawe</option>
                        </select>
                    </div>
                    
                    <!-- Kecamatan -->
                    <div class="col-md-4 mb-3 mb-md-0">
                        <label for="kecamatan" class="form-label">Kecamatan</label>
                        <select id="kecamatan" name="kecamatan" class="form-control form-control-lg custom-select bg-light">
                            <option>Muara Dua</option>
                            <option>Blang Mangat</option>
                            <option>Muara Satu</option>
                            <option>Banda Sakti</option>
                        </select>
                    </div>

                    <!-- Jenjang -->
                    <div class="col-md-4 mb-3 mb-md-0">
                        <label for="jenjang" class="form-label">Jenjang Sekolah</label>
                        <select id="jenjang" name="jenjang" class="form-control form-control-lg custom-select bg-light">
                            <option>SD</option>
                            <option>SMP</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-end">
                    <button type="button" class="btn btn-primary btn-lg px-4 rounded d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="mr-2" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>  
                        Tampilkan Zonasi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Result Title -->
    <h3 class="font-weight-bold text-dark mb-4 d-flex align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="text-primary mr-2" viewBox="0 0 16 16">
            <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
        </svg>
        Daftar Sekolah Zonasi Anda
    </h3>

    <!-- Dummy Data Grid (Diganti Map) -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-xl overflow-hidden hover-shadow">
                <div class="card-body p-0">
                    <div id="map" style="height: 550px; width: 100%; z-index: 1;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Card -->
    <div class="alert alert-primary d-flex align-items-start border-0 shadow-sm rounded-xl p-4" role="alert">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="text-primary mr-3 flex-shrink-0" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
            <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
        </svg>
        <div>
            <h5 class="alert-heading font-weight-bold mb-2">Catatan Penting</h5>
            <p class="mb-0 text-dark" style="opacity: 0.85;">
                Jarak zonasi dihitung berdasarkan titik koordinat yang diambil dari alamat tempat tinggal sesuai dengan Kartu Keluarga (KK) menuju titik koordinat sekolah tujuan. Pastikan letak koordinat tempat tinggal yang Anda set sesuai untuk menghindari kendala verifikasi data.
            </p>
        </div>
    </div>

</div>

<!-- Leaflet CSS & JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Init Map centered to Lhokseumawe (User Location / Center)
        var mapCenter = [5.1801, 97.1507];
        var map = L.map('map').setView(mapCenter, 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Dummy Data Sekolah Lhokseumawe
        var schools = [
            {
                name: "SMA Negeri 1 Lhokseumawe",
                lat: 5.1780,
                lng: 97.1450,
                address: "Jl. KH. A. Fatah Hasan No.88, Muara Dua",
                quota: 120,
                accreditation: "A",
                distance: "1.2 km"
            },
            {
                name: "SMA Negeri 2 Lhokseumawe",
                lat: 5.1850,
                lng: 97.1350,
                address: "Jl. Banda Sakti, Muara Satu",
                quota: 150,
                accreditation: "A",
                distance: "3.5 km"
            },
            {
                name: "SMA Negeri 3 Lhokseumawe",
                lat: 5.1680,
                lng: 97.1550,
                address: "Jl. Cot Girek, Blang Mangat",
                quota: 90,
                accreditation: "B",
                distance: "5.2 km"
            }
        ];

        // Custom Marker Icons (Blue for Schools, Red for Home)
        var iconBaseParams = {
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41], iconAnchor: [12, 41], popupAnchor: [1, -34], shadowSize: [41, 41]
        };
        var schoolIcon = L.icon(Object.assign({iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png'}, iconBaseParams));
        var homeIcon = L.icon(Object.assign({iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png'}, iconBaseParams));

        var markersGroup = L.featureGroup();

        // Add Markers for Schools
        schools.forEach(function(school) {
            var marker = L.marker([school.lat, school.lng], {icon: schoolIcon});
            
            var popupContent = `
                <div style="min-width: 200px;">
                    <h6 style="margin-bottom: 5px; font-weight: bold; color: #007bff;">${school.name}</h6>
                    <span class="badge badge-success" style="margin-bottom: 8px;">Akreditasi ${school.accreditation}</span>
                    <p style="margin: 0 0 8px 0; font-size: 13px; color: #6c757d;">${school.address}</p>
                    <div style="border-top: 1px solid #dee2e6; padding-top: 8px; font-size: 13px;">
                        <div style="margin-bottom: 4px;">Daya Tampung: <strong class="text-dark">${school.quota} Siswa</strong></div>
                        <div>Jarak: <strong class="text-danger">${school.distance}</strong></div>
                    </div>
                </div>
            `;
            
            marker.bindPopup(popupContent);
            markersGroup.addLayer(marker);
        });

        // Add User Location Marker
        var homeMarker = L.marker(mapCenter, {icon: homeIcon});
        homeMarker.bindPopup('<strong class="text-danger">Lokasi Anda (Simulasi)</strong><br>Pusat Kota Lhokseumawe').openPopup();
        markersGroup.addLayer(homeMarker);

        // Add all markers to map and fit bounds so everything is visible
        markersGroup.addTo(map);
        map.fitBounds(markersGroup.getBounds().pad(0.1));
    });
</script>
@endsection