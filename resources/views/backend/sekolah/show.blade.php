@extends('backend.main')

@section('sekolah-menu-active')
    active
@endsection

@section('sekolah-menu-open')
    show
@endsection

@section('content')
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
                            <th>NPSN:</th>
                            <td>{{ $sekolah->npsn }}</td>
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
        </div>
    </div>
    <!--end::Card-->
@endsection
