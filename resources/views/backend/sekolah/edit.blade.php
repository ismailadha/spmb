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
                <h3>Edit Sekolah</h3>
            </div>
            <!--begin::Card title-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body py-4">
            <form action="{{ route('sekolah.update', $sekolah->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Nama Sekolah - Full Width -->
                <div class="row mb-3">
                    <div class="col-12">
                        <label for="nama_sekolah" class="form-label">Nama Sekolah</label>
                        <input type="text" class="form-control" id="nama_sekolah" name="nama_sekolah" value="{{ $sekolah->nama_sekolah }}" required>
                    </div>
                </div>

                <!-- Jenjang & NPSN -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="jenjang" class="form-label">Jenjang</label>
                        <select class="form-control" id="jenjang" name="jenjang" required>
                            <option value="">-- Pilih Jenjang --</option>
                            <option value="TK" {{ $sekolah->jenjang === 'TK' ? 'selected' : '' }}>TK</option>
                            <option value="SD" {{ $sekolah->jenjang === 'SD' ? 'selected' : '' }}>SD</option>
                            <option value="SMP" {{ $sekolah->jenjang === 'SMP' ? 'selected' : '' }}>SMP</option>
                            <option value="SMA" {{ $sekolah->jenjang === 'SMA' ? 'selected' : '' }}>SMA</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="npsn" class="form-label">NPSN</label>
                        <input type="text" class="form-control" id="npsn" name="npsn" value="{{ $sekolah->npsn }}">
                    </div>
                </div>

                <!-- Alamat - Full Width -->
                <div class="row mb-3">
                    <div class="col-12">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $sekolah->alamat }}">
                    </div>
                </div>

                <!-- Telepon & Email -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="telepon" class="form-label">Telepon</label>
                        <input type="text" class="form-control" id="telepon" name="telepon" value="{{ $sekolah->telepon }}">
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $sekolah->email }}">
                    </div>
                </div>

                <!-- Kode Pos & Website -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="kode_pos" class="form-label">Kode Pos</label>
                        <input type="text" class="form-control" id="kode_pos" name="kode_pos" value="{{ $sekolah->kode_pos }}">
                    </div>
                    <div class="col-md-6">
                        <label for="website" class="form-label">Website</label>
                        <input type="url" class="form-control" id="website" name="website" value="{{ $sekolah->website }}">
                    </div>
                </div>

                <!-- Latitude & Longitude -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="latitude" class="form-label">Latitude</label>
                        <input type="number" step="any" class="form-control" id="latitude" name="latitude" value="{{ $sekolah->latitude }}">
                    </div>
                    <div class="col-md-6">
                        <label for="longitude" class="form-label">Longitude</label>
                        <input type="number" step="any" class="form-control" id="longitude" name="longitude" value="{{ $sekolah->longitude }}">
                    </div>
                </div>

                <!-- Status Perbatasan -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="status_perbatasan" class="form-label">Status Perbatasan</label>
                        <select class="form-control" id="status_perbatasan" name="status_perbatasan">
                            <option value="">-- Pilih Status --</option>
                            <option value="1" {{ $sekolah->status_perbatasan == 1 ? 'selected' : '' }}>Sekolah Perbatasan</option>
                            <option value="0" {{ $sekolah->status_perbatasan == 0 || is_null($sekolah->status_perbatasan) ? 'selected' : '' }}>Sekolah Non-Perbatasan</option>
                        </select>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('sekolah.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--end::Card-->
@endsection
