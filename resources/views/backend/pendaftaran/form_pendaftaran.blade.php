@extends('backend.main')

@section('pendaftaran-menu-active', 'active')

@section('content')
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
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="{{ $peserta->nama_lengkap }}" required>
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

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="nama_orang_tua" class="form-label">Nama Orang Tua / Wali</label>
                                <input type="text" class="form-control" id="nama_orang_tua" name="nama_orang_tua" required>
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
            const nextBtn = document.getElementById('nextToProfil');

            function toggleDokumen() {
                const kartuPkhContainer = document.getElementById('kartu_pkh_container');
                const suratDokterContainer = document.getElementById('surat_dokter_container');
                const suratPindahContainer = document.getElementById('surat_pindah_container');

                let selectedText = '';
                if (jalur.selectedIndex !== -1) {
                    selectedText = jalur.options[jalur.selectedIndex].text.toLowerCase();
                }

                if (selectedText.includes('mutasi')) {
                    kartuPkhContainer.style.display = 'none';
                    suratDokterContainer.style.display = 'none';
                    suratPindahContainer.style.display = 'block';
                } else if (selectedText.includes('afirmasi')) {
                    kartuPkhContainer.style.display = 'block';
                    suratDokterContainer.style.display = 'block';
                    suratPindahContainer.style.display = 'none';
                } else {
                    kartuPkhContainer.style.display = 'none';
                    suratDokterContainer.style.display = 'none';
                    suratPindahContainer.style.display = 'none';
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

                // Jika mode edit, tombol lanjut di tab1 tidak disabled dan bisa lanjut ke tab2
                // dan juga tab2, tab3, tab4, tab5 tidak disabled
                @if ($mode == 'edit')
                    nextBtn.disabled = false;
                    document.querySelectorAll('#step2-tab, #step3-tab, #step4-tab, #step5-tab').forEach(tab => {
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
        });
    </script>
@endsection
