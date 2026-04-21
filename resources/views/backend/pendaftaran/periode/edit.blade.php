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
            <form action="{{ route('periode.update', $periode->id) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('PUT')

                <!-- Tahun Ajaran -->
                <div class="row mb-4">
                    <div class="col-12">
                        <label for="tahun_ajaran" class="form-label">Tahun Ajaran</label>
                        <input type="text" class="form-control" id="tahun_ajaran" name="tahun_ajaran" placeholder="Contoh: 2024/2025" value="{{ old('tahun_ajaran', $periode->tahun_ajaran) }}" maxlength="255" required>
                    </div>
                </div>

                <!-- PENDAFTARAN Section -->
                <div class="row mb-2">
                    <div class="col-12">
                        <h5 class="fw-bold text-muted">Pendaftaran</h5>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="peserta_daftar_mulai" class="form-label">Mulai</label>
                        <input type="date" class="form-control" id="peserta_daftar_mulai" name="peserta_daftar_mulai" value="{{ old('peserta_daftar_mulai', \Carbon\Carbon::parse($periode->peserta_daftar_mulai)->format('Y-m-d')) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="peserta_daftar_selesai" class="form-label">Selesai</label>
                        <input type="date" class="form-control" id="peserta_daftar_selesai" name="peserta_daftar_selesai" value="{{ old('peserta_daftar_selesai', \Carbon\Carbon::parse($periode->peserta_daftar_selesai)->format('Y-m-d')) }}" required>
                    </div>
                </div>

                <!-- VERIFIKASI Section -->
                <div class="row mb-2">
                    <div class="col-12">
                        <h5 class="fw-bold text-muted">Verifikasi</h5>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="verifikasi_mulai" class="form-label">Mulai</label>
                        <input type="date" class="form-control" id="verifikasi_mulai" name="verifikasi_mulai" value="{{ old('verifikasi_mulai', $periode->verifikasi_mulai ? \Carbon\Carbon::parse($periode->verifikasi_mulai)->format('Y-m-d') : '') }}">
                    </div>
                    <div class="col-md-6">
                        <label for="verifikasi_selesai" class="form-label">Selesai</label>
                        <input type="date" class="form-control" id="verifikasi_selesai" name="verifikasi_selesai" value="{{ old('verifikasi_selesai', $periode->verifikasi_selesai ? \Carbon\Carbon::parse($periode->verifikasi_selesai)->format('Y-m-d') : '') }}">
                    </div>
                </div>

                <!-- DAFTAR ULANG Section -->
                <div class="row mb-2">
                    <div class="col-12">
                        <h5 class="fw-bold text-muted">Daftar Ulang</h5>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="daftar_ulang_mulai" class="form-label">Mulai</label>
                        <input type="date" class="form-control" id="daftar_ulang_mulai" name="daftar_ulang_mulai" value="{{ old('daftar_ulang_mulai', $periode->daftar_ulang_mulai ? \Carbon\Carbon::parse($periode->daftar_ulang_mulai)->format('Y-m-d') : '') }}">
                    </div>
                    <div class="col-md-6">
                        <label for="daftar_ulang_selesai" class="form-label">Selesai</label>
                        <input type="date" class="form-control" id="daftar_ulang_selesai" name="daftar_ulang_selesai" value="{{ old('daftar_ulang_selesai', $periode->daftar_ulang_selesai ? \Carbon\Carbon::parse($periode->daftar_ulang_selesai)->format('Y-m-d') : '') }}">
                    </div>
                </div>

                <!-- PENGUMUMAN & MASUK SEKOLAH Section -->
                <div class="row mb-2">
                    <div class="col-12">
                        <h5 class="fw-bold text-muted">Pengumuman & Masuk Sekolah</h5>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="tanggal_pengumuman_seleksi" class="form-label">Tanggal Pengumuman Seleksi</label>
                        <input type="date" class="form-control" id="tanggal_pengumuman_seleksi" name="tanggal_pengumuman_seleksi" value="{{ old('tanggal_pengumuman_seleksi', $periode->tanggal_pengumuman_seleksi ? \Carbon\Carbon::parse($periode->tanggal_pengumuman_seleksi)->format('Y-m-d') : '') }}">
                    </div>
                    <div class="col-md-6">
                        <label for="tanggal_masuk_sekolah" class="form-label">Tanggal Masuk Sekolah</label>
                        <input type="date" class="form-control" id="tanggal_masuk_sekolah" name="tanggal_masuk_sekolah" value="{{ old('tanggal_masuk_sekolah', $periode->tanggal_masuk_sekolah ? \Carbon\Carbon::parse($periode->tanggal_masuk_sekolah)->format('Y-m-d') : '') }}">
                    </div>
                </div>

                <!-- BATASAN USIA Section -->
                <div class="row mb-2">
                    <div class="col-12">
                        <h5 class="fw-bold text-muted">Batasan Usia</h5>
                    </div>
                </div>
                <!-- SD -->
                <div class="row mb-2">
                    <div class="col-12">
                        <label class="form-label text-dark fw-semibold">SD</label>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label for="tanggal_batas_usia_sd" class="form-label">Tanggal Batas (Cut-off)</label>
                        <input type="date" class="form-control" id="tanggal_batas_usia_sd" name="tanggal_batas_usia_sd" value="{{ old('tanggal_batas_usia_sd', $periode->tanggal_batas_usia_sd ? \Carbon\Carbon::parse($periode->tanggal_batas_usia_sd)->format('Y-m-d') : '') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="usia_min_sd" class="form-label">Usia Minimum (Tahun)</label>
                        <input type="number" class="form-control" id="usia_min_sd" name="usia_min_sd" min="0" value="{{ old('usia_min_sd', $periode->usia_min_sd) }}">
                    </div>
                    <div class="col-md-4">
                        <label for="usia_max_sd" class="form-label">Usia Maksimum (Tahun)</label>
                        <input type="number" class="form-control" id="usia_max_sd" name="usia_max_sd" min="0" value="{{ old('usia_max_sd', $periode->usia_max_sd) }}">
                    </div>
                </div>

                <!-- SMP -->
                <div class="row mb-2">
                    <div class="col-12">
                        <label class="form-label text-dark fw-semibold">SMP</label>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="tanggal_batas_usia_smp" class="form-label">Tanggal Batas (Cut-off)</label>
                        <input type="date" class="form-control" id="tanggal_batas_usia_smp" name="tanggal_batas_usia_smp" value="{{ old('tanggal_batas_usia_smp', $periode->tanggal_batas_usia_smp ? \Carbon\Carbon::parse($periode->tanggal_batas_usia_smp)->format('Y-m-d') : '') }}">
                    </div>
                    <div class="col-md-6">
                        <label for="usia_max_smp" class="form-label">Usia Maksimum (Tahun)</label>
                        <input type="number" class="form-control" id="usia_max_smp" name="usia_max_smp" min="0" value="{{ old('usia_max_smp', $periode->usia_max_smp) }}">
                    </div>
                </div>

                <!-- Jalur Seleksi -->
                <div class="row mb-3">
                    <div class="col-12">
                        <label class="form-label fw-bold">Jalur Seleksi & Jadwal Khusus</label>
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle">
                                <thead class="bg-light">
                                    <tr>
                                        <th style="width: 200px;">Jalur</th>
                                        <th>Jadwal Pendaftaran</th>
                                        <th>Jadwal Verifikasi</th>
                                        <th>Jadwal Daftar Ulang</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($jalur as $j)
                                    @php
                                        $pivot = $selectedJalurData->get($j->id);
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="form-check form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" name="jalur_id[]" value="{{ $j->id }}" id="jalur_{{ $j->id }}"
                                                    {{ in_array($j->id, old('jalur_id', $selectedJalur)) ? 'checked' : '' }} />
                                                <label class="form-check-label text-dark" for="jalur_{{ $j->id }}">
                                                    {{ $j->nama_jalur }}
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row g-2">
                                                <div class="col-6">
                                                    <input type="date" class="form-control form-control-sm" name="pendaftaran_mulai[{{ $j->id }}]" value="{{ old('pendaftaran_mulai.'.$j->id, $pivot ? $pivot->pendaftaran_mulai : '') }}" placeholder="Mulai">
                                                </div>
                                                <div class="col-6">
                                                    <input type="date" class="form-control form-control-sm" name="pendaftaran_selesai[{{ $j->id }}]" value="{{ old('pendaftaran_selesai.'.$j->id, $pivot ? $pivot->pendaftaran_selesai : '') }}" placeholder="Selesai">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row g-2">
                                                <div class="col-6">
                                                    <input type="date" class="form-control form-control-sm" name="verifikasi_mulai_jalur[{{ $j->id }}]" value="{{ old('verifikasi_mulai_jalur.'.$j->id, $pivot ? $pivot->verifikasi_mulai : '') }}" placeholder="Mulai">
                                                </div>
                                                <div class="col-6">
                                                    <input type="date" class="form-control form-control-sm" name="verifikasi_selesai_jalur[{{ $j->id }}]" value="{{ old('verifikasi_selesai_jalur.'.$j->id, $pivot ? $pivot->verifikasi_selesai : '') }}" placeholder="Selesai">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row g-2">
                                                <div class="col-6">
                                                    <input type="date" class="form-control form-control-sm" name="daftar_ulang_mulai_jalur[{{ $j->id }}]" value="{{ old('daftar_ulang_mulai_jalur.'.$j->id, $pivot ? $pivot->daftar_ulang_mulai : '') }}" placeholder="Mulai">
                                                </div>
                                                <div class="col-6">
                                                    <input type="date" class="form-control form-control-sm" name="daftar_ulang_selesai_jalur[{{ $j->id }}]" value="{{ old('daftar_ulang_selesai_jalur.'.$j->id, $pivot ? $pivot->daftar_ulang_selesai : '') }}" placeholder="Selesai">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const forms = document.querySelectorAll('.needs-validation');
        Array.prototype.slice.call(forms).forEach(function(form) {
            form.addEventListener('submit', function(event) {
                // Check jalur
                const checkboxes = document.querySelectorAll('input[name="jalur_id[]"]');
                let isChecked = false;
                checkboxes.forEach(function(checkbox) {
                    if (checkbox.checked) {
                        isChecked = true;
                    }
                });

                if (!form.checkValidity() || !isChecked) {
                    event.preventDefault();
                    event.stopPropagation();
                    
                    form.classList.add('was-validated');

                    Swal.fire({
                        text: "Mohon lengkapi seluruh field yang wajib diisi dan pastikan minimal satu Jalur Seleksi terpilih.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, Mengerti!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }
            }, false);
        });
    });
</script>
@endsection
