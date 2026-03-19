@extends('backend.main')

@section('pendaftaran-sd-menu-active', 'active')
@section('formulir-menu-open', 'show')

@section('content')
    <!--begin::Card-->
    <div class="card" style="background-color: #fff5f5; border: 1px solid #ffe2e5;">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <h3>Formulir Pendaftaran SD</h3>
            </div>
            <!--begin::Card title-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body py-4">
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="jenjang" value="SD">

                <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6" id="wizardTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="step1-tab" data-bs-toggle="tab" href="#step1" role="tab">Pilih Jalur</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link disabled" id="step2-tab" data-bs-toggle="tab" href="#step2" role="tab">Data Profil</a>
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
                                    <option value="" disabled selected>Pilih Jalur Pendaftaran</option>
                                    <option value="Domisili">Domisili</option>
                                    <option value="Afirmasi">Afirmasi</option>
                                    <option value="Mutasi">Mutasi</option>
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
                                <input type="text" class="form-control" id="nik" name="nik" required>
                            </div>
                            <div class="col-md-6">
                                <label for="nisn" class="form-label">Nomor Induk Siswa Nasional (NISN)</label>
                                <input type="text" class="form-control" id="nisn" name="nisn" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nomor_kk" class="form-label">Nomor Kartu Keluarga (KK)</label>
                                <input type="text" class="form-control" id="nomor_kk" name="nomor_kk" required>
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal_kk" class="form-label">Tanggal Penerbitan KK</label>
                                <input type="date" class="form-control" id="tanggal_kk" name="tanggal_kk" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="nama_orang_tua" class="form-label">Nama Orang Tua / Wali</label>
                                <input type="text" class="form-control" id="nama_orang_tua" name="nama_orang_tua" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-12">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-secondary btn-prev" data-prev="step1">Sebelumnya</button>
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
                            <div class="col-md-4">
                                <label for="kartu_pkh" class="form-label">Kartu PKH (Jalur Afirmasi)</label>
                                <input type="file" class="form-control" id="kartu_pkh" name="kartu_pkh">
                            </div>
                            <div class="col-md-4">
                                <label for="surat_dokter" class="form-label">Surat Keterangan Dokter/Disabilitas (Afirmasi)</label>
                                <input type="file" class="form-control" id="surat_dokter" name="surat_dokter">
                            </div>
                            <div class="col-md-4">
                                <label for="surat_pindah" class="form-label">Surat Keterangan Pindah (Jalur Mutasi)</label>
                                <input type="file" class="form-control" id="surat_pindah" name="surat_pindah">
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-secondary btn-prev" data-prev="step2">Sebelumnya</button>
                            <button type="button" class="btn btn-primary btn-next" data-next="step4">Selanjutnya</button>
                        </div>
                    </div>

                    <!-- Step 4: Pilih Sekolah -->
                    <div class="tab-pane fade" id="step4" role="tabpanel">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="sekolah_pilihan_1" class="form-label">Pilihan 1</label>
                                <select class="form-control select2" id="sekolah_pilihan_1" name="sekolah_pilihan_1" required>
                                    <option value="">-- Pilih Sekolah --</option>
                                    <optgroup label="Kecamatan Banda Sakti">
                                        <option value="CA">SD Negeri 1 Banda Sakti</option>
                                        <option value="NV">SD Negeri 2 Banda Sakti</option>
                                        <option value="OR">SD Negeri 3 Banda Sakti</option>
                                        <option value="WA">SD Negeri 4 Banda Sakti</option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="sekolah_pilihan_2" class="form-label">Pilihan 2</label>
                                <select class="form-control select2" id="sekolah_pilihan_2" name="sekolah_pilihan_2" required>
                                    <option value="">-- Pilih Sekolah --</option>
                                    <optgroup label="Kecamatan Banda Sakti">
                                        <option value="CA">SD Negeri 1 Banda Sakti</option>
                                        <option value="NV">SD Negeri 2 Banda Sakti</option>
                                        <option value="OR">SD Negeri 3 Banda Sakti</option>
                                        <option value="WA">SD Negeri 4 Banda Sakti</option>
                                    </optgroup>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const jalur = document.getElementById('jalur');
            const kartuPkhInput = document.getElementById('kartu_pkh');
            const suratDokterInput = document.getElementById('surat_dokter');
            const suratPindahInput = document.getElementById('surat_pindah');
            const nextBtn = document.getElementById('nextToProfil');

            function toggleDokumen() {
                if (jalur.value === 'Mutasi') {
                    kartuPkhInput.disabled = true;
                    suratDokterInput.disabled = true;
                    suratPindahInput.disabled = false;
                } else if (jalur.value === 'Afirmasi') {
                    kartuPkhInput.disabled = false;
                    suratDokterInput.disabled = false;
                    suratPindahInput.disabled = true;
                } else {
                    kartuPkhInput.disabled = true;
                    suratDokterInput.disabled = true;
                    suratPindahInput.disabled = true;
                }
            }

            if (jalur) {
                jalur.addEventListener('change', function() {
                    toggleDokumen();
                    if(this.value) {
                        nextBtn.disabled = false;
                        document.querySelectorAll('#step2-tab, #step3-tab, #step4-tab, #step5-tab').forEach(tab => {
                            tab.classList.remove('disabled');
                        });
                    } else {
                        nextBtn.disabled = true;
                        document.querySelectorAll('#step2-tab, #step3-tab, #step4-tab, #step5-tab').forEach(tab => {
                            tab.classList.add('disabled');
                        });
                    }
                });
                
                // Run on initial load
                toggleDokumen();
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
        });
    </script>
@endsection
