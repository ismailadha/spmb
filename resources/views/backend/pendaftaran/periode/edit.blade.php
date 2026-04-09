@extends('backend.main')

@section('periode-menu-active')
    active
@endsection

@section('content')
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <h3>Edit Periode Pendaftaran</h3>
            </div>
            <!--begin::Card title-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body py-4">
            <form action="{{ route('periode.update', $periode->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Tahun Ajaran -->
                <div class="row mb-3">
                    <div class="col-12">
                        <label for="tahun_ajaran" class="form-label">Tahun Ajaran</label>
                        <input type="text" class="form-control" id="tahun_ajaran" name="tahun_ajaran" placeholder="Contoh: 2024/2025" value="{{ old('tahun_ajaran', $periode->tahun_ajaran) }}" required>
                    </div>
                </div>

                <!-- Pendaftaran -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="peserta_daftar_mulai" class="form-label">Pendaftaran Mulai</label>
                        <input type="date" class="form-control" id="peserta_daftar_mulai" name="peserta_daftar_mulai" value="{{ old('peserta_daftar_mulai', \Carbon\Carbon::parse($periode->peserta_daftar_mulai)->format('Y-m-d')) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="peserta_daftar_selesai" class="form-label">Pendaftaran Selesai</label>
                        <input type="date" class="form-control" id="peserta_daftar_selesai" name="peserta_daftar_selesai" value="{{ old('peserta_daftar_selesai', \Carbon\Carbon::parse($periode->peserta_daftar_selesai)->format('Y-m-d')) }}" required>
                    </div>
                </div>
                
                <!-- Verifikasi -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="verifikasi_mulai" class="form-label">Verifikasi Mulai</label>
                        <input type="date" class="form-control" id="verifikasi_mulai" name="verifikasi_mulai" value="{{ old('verifikasi_mulai', $periode->verifikasi_mulai ? \Carbon\Carbon::parse($periode->verifikasi_mulai)->format('Y-m-d') : '') }}">
                    </div>
                    <div class="col-md-6">
                        <label for="verifikasi_selesai" class="form-label">Verifikasi Selesai</label>
                        <input type="date" class="form-control" id="verifikasi_selesai" name="verifikasi_selesai" value="{{ old('verifikasi_selesai', $periode->verifikasi_selesai ? \Carbon\Carbon::parse($periode->verifikasi_selesai)->format('Y-m-d') : '') }}">
                    </div>
                </div>

                <!-- Daftar Ulang -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="daftar_ulang_mulai" class="form-label">Daftar Ulang Mulai</label>
                        <input type="date" class="form-control" id="daftar_ulang_mulai" name="daftar_ulang_mulai" value="{{ old('daftar_ulang_mulai', $periode->daftar_ulang_mulai ? \Carbon\Carbon::parse($periode->daftar_ulang_mulai)->format('Y-m-d') : '') }}">
                    </div>
                    <div class="col-md-6">
                        <label for="daftar_ulang_selesai" class="form-label">Daftar Ulang Selesai</label>
                        <input type="date" class="form-control" id="daftar_ulang_selesai" name="daftar_ulang_selesai" value="{{ old('daftar_ulang_selesai', $periode->daftar_ulang_selesai ? \Carbon\Carbon::parse($periode->daftar_ulang_selesai)->format('Y-m-d') : '') }}">
                    </div>
                </div>

                <!-- Pengumuman & Masuk Sekolah -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="tanggal_pengumuman_seleksi" class="form-label">Tanggal Pengumuman Seleksi</label>
                        <input type="date" class="form-control" id="tanggal_pengumuman_seleksi" name="tanggal_pengumuman_seleksi" value="{{ old('tanggal_pengumuman_seleksi', $periode->tanggal_pengumuman_seleksi ? \Carbon\Carbon::parse($periode->tanggal_pengumuman_seleksi)->format('Y-m-d') : '') }}">
                    </div>
                    <div class="col-md-6">
                        <label for="tanggal_masuk_sekolah" class="form-label">Tanggal Masuk Sekolah</label>
                        <input type="date" class="form-control" id="tanggal_masuk_sekolah" name="tanggal_masuk_sekolah" value="{{ old('tanggal_masuk_sekolah', $periode->tanggal_masuk_sekolah ? \Carbon\Carbon::parse($periode->tanggal_masuk_sekolah)->format('Y-m-d') : '') }}">
                    </div>
                </div>

                <!-- Batas Usia -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="batas_usia_sd" class="form-label">Batas Usia SD (Cut-off)</label>
                        <input type="date" class="form-control" id="batas_usia_sd" name="batas_usia_sd" value="{{ old('batas_usia_sd', $periode->batas_usia_sd ? \Carbon\Carbon::parse($periode->batas_usia_sd)->format('Y-m-d') : '') }}">
                        <div class="form-text">Tanggal batas usia untuk pendaftaran SD.</div>
                    </div>
                    <div class="col-md-6">
                        <label for="batas_usia_smp" class="form-label">Batas Usia SMP (Cut-off)</label>
                        <input type="date" class="form-control" id="batas_usia_smp" name="batas_usia_smp" value="{{ old('batas_usia_smp', $periode->batas_usia_smp ? \Carbon\Carbon::parse($periode->batas_usia_smp)->format('Y-m-d') : '') }}">
                        <div class="form-text">Tanggal batas usia untuk pendaftaran SMP.</div>
                    </div>
                </div>

                <!-- Jalur Seleksi -->
                <div class="row mb-3">
                    <div class="col-12">
                        <label class="form-label fw-bold">Jalur Seleksi</label>
                        <div class="d-flex flex-wrap gap-5 mt-2">
                            @foreach($jalur as $j)
                            <div class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" name="jalur_id[]" value="{{ $j->id }}" id="jalur_{{ $j->id }}" 
                                    {{ in_array($j->id, old('jalur_id', $selectedJalur)) ? 'checked' : '' }} />
                                <label class="form-check-label text-dark" for="jalur_{{ $j->id }}">
                                    {{ $j->nama_jalur }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                        @error('jalur_id')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Status Aktif -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="status_aktif" class="form-label">Status Aktif</label>
                        <select class="form-control" id="status_aktif" name="status_aktif" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="1" {{ old('status_aktif', $periode->status_aktif) == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('status_aktif', $periode->status_aktif) == 0 && old('status_aktif', $periode->status_aktif) !== '' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('periode.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--end::Card-->
@endsection
