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
                <h3>Detail Sekolah</h3>
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <a href="{{ route('sekolah.edit', $sekolah->id) }}" class="btn btn-primary">Edit</a>
                <a href="{{ route('sekolah.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body py-4">
            <div class="row">
                <div class="col-md-6">
                    <h5>Informasi Dasar</h5>
                    <table class="table table-borderless">
                        <tr>
                            <th>Nama Sekolah:</th>
                            <td>{{ $sekolah->nama_sekolah }}</td>
                        </tr>
                        <tr>
                            <th>Jenjang:</th>
                            <td>{{ $sekolah->jenjang }}</td>
                        </tr>
                        <tr>
                            <th>NPSN:</th>
                            <td>{{ $sekolah->npsn }}</td>
                        </tr>
                        <tr>
                            <th>Daya Tampung:</th>
                            <td>{{ $sekolah->daya_tampung }}</td>
                        </tr>
                        <tr>
                            <th>Alamat:</th>
                            <td>{{ $sekolah->alamat }}</td>
                        </tr>
                        <tr>
                            <th>Provinsi:</th>
                            <td>{{ $sekolah->provinsi->nama_provinsi ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Kabupaten:</th>
                            <td>{{ $sekolah->kabupaten->nama_kabupaten ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Kecamatan:</th>
                            <td>{{ $sekolah->kecamatan->nama_kecamatan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Desa:</th>
                            <td>{{ $sekolah->desa->nama_desa ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Status Perbatasan:</th>
                            <td>
                                @if ($sekolah->status_perbatasan == 1)
                                    <span class="badge badge-success">
                                        <i class="ki-duotone ki-check-circle" style="display: inline; margin-right: 4px;"></i>
                                        Sekolah Perbatasan
                                    </span>
                                @elseif ($sekolah->status_perbatasan == 0)
                                    <span class="badge badge-secondary">Sekolah Non-Perbatasan</span>
                                @else
                                    <span class="badge badge-light text-dark">Belum ditentukan</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Status Pilihan 1:</th>
                            <td>
                                @if ($sekolah->status_pilihan_1 == 1)
                                    <span class="badge badge-success">
                                        <i class="ki-duotone ki-check-circle" style="display: inline; margin-right: 4px;"></i>
                                        Sekolah Pilihan 1
                                    </span>
                                @elseif ($sekolah->status_pilihan_1 == 0)
                                    <span class="badge badge-secondary">Sekolah Pilihan 2</span>
                                @else
                                    <span class="badge badge-light text-dark">Belum ditentukan</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h5>Kontak & Lokasi</h5>
                    <table class="table table-borderless">
                        <tr>
                            <th>Email:</th>
                            <td>{{ $sekolah->email }}</td>
                        </tr>
                        <tr>
                            <th>Telepon:</th>
                            <td>{{ $sekolah->telepon }}</td>
                        </tr>
                        <tr>
                            <th>Website:</th>
                            <td><a href="{{ $sekolah->website }}" target="_blank">{{ $sekolah->website }}</a></td>
                        </tr>
                        <tr>
                            <th>Kode Pos:</th>
                            <td>{{ $sekolah->kode_pos }}</td>
                        </tr>
                        <tr>
                            <th>Latitude:</th>
                            <td>{{ $sekolah->latitude }}</td>
                        </tr>
                        <tr>
                            <th>Longitude:</th>
                            <td>{{ $sekolah->longitude }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Map Container -->
            <div class="row mt-5">
                <div class="col-12">
                    <h5>Peta Lokasi</h5>
                    @if ($sekolah->latitude && $sekolah->longitude)
                        <div id="map"></div>
                    @else
                        <div class="alert alert-warning">
                            Koordinat lokasi belum ditentukan.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--end::Card-->
@endsection

@section('scripts')
    @if ($sekolah->latitude && $sekolah->longitude)
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var lat = {{ $sekolah->latitude }};
            var lng = {{ $sekolah->longitude }};
            var nama_sekolah = {!! json_encode($sekolah->nama_sekolah) !!};

            var map = L.map('map').setView([lat, lng], 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            L.marker([lat, lng]).addTo(map)
                .bindPopup("<b>" + nama_sekolah + "</b>")
                .openPopup();
        });
    </script>
    @endif
@endsection
