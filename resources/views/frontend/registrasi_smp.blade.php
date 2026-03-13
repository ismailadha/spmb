<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Registrasi Calon Siswa Sekolah Menengah Pertama</title>
        <link rel="icon" type="image/png" sizes="32x32" href="{{ 'front/img/favicon.png' }}">
        @include('frontend.css')
    </head>
    <body>
        <section class="login-register bgimage biz_overlay overlay--secondary2">
            <div class="bg_image_holder">
                <img src="{{ asset('front/img/image3.jpg') }}" alt="">
            </div>
            <div class="content_above">
                <!-- end menu area -->
                <div class="signup-form d-flex align-items-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-wrapper">
                                    <div class="card card-shadow">
                                        <div class="card-header">
                                            <h4 class="text-center">Registrasi Calon Siswa Sekolah Menengah Pertama</h4>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ route('register-peserta.store') }}" method="POST">
                                                @csrf
                                                <div class="tab tab--6">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="tab_nav2">
                                                                    <ul class="nav justify-content-center" id="tab6" role="tablist">
                                                                        <li class="nav-item">
                                                                            <a class="nav-link active" id="tab6_nav1" data-toggle="tab" href="#tab6_content1" role="tab" aria-controls="tab6_nav1" aria-selected="true">Pilih Jalur</a>
                                                                        </li>
                                                                        <li class="nav-item">
                                                                            <a class="nav-link" id="tab6_nav2" data-toggle="tab" href="#tab6_content2" role="tab" aria-controls="tab6_nav2" aria-selected="false">Data Profil</a>
                                                                        </li>
                                                                        <li class="nav-item">
                                                                            <a class="nav-link" id="tab6_nav3" data-toggle="tab" href="#tab6_content3" role="tab" aria-controls="tab6_nav3" aria-selected="false">Upload Dokumen</a>
                                                                        </li>
                                                                        <li class="nav-item">
                                                                            <a class="nav-link" id="tab6_nav4" data-toggle="tab" href="#tab6_content4" role="tab" aria-controls="tab6_nav4" aria-selected="false">Pilih Sekolah</a>
                                                                        </li>
                                                                        <li class="nav-item">
                                                                            <a class="nav-link" id="tab6_nav5" data-toggle="tab" href="#tab6_content5" role="tab" aria-controls="tab6_nav5" aria-selected="false">Submit</a>
                                                                        </li>
                                                                    </ul>
                                                                </div><!-- ends .tab_nav2 -->
                                                            </div>
                                                        </div><!-- ends .row -->
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="tab-content tab--content2" id="tabcontent6">
                                                                    <div class="tab-pane fade show active" id="tab6_content1" role="tabpanel" aria-labelledby="tab6_content1">
                                                                        <h4>Pilih Jalur</h4>
                                                                        {{-- Select --}}
                                                                        <div class="form-group">
                                                                            <select class="form-control" id="jalur" name="jalur" required>
                                                                                <option value="" disabled selected>Pilih Jalur Pendaftaran</option>
                                                                                <option value="Domisili">Domisili</option>
                                                                                <option value="Afirmasi">Afirmasi</option>
                                                                                <option value="Mutasi">Mutasi</option>
                                                                                <option value="Prestasi">Prestasi</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="d-flex justify-content-end mt-4">
                                                                            <button type="button" id="nextToProfil" class="btn btn-sm btn-primary" disabled>Next</button>
                                                                        </div>
                                                                    </div><!-- end ./tab-pane -->
                                                                    <div class="tab-pane fade" id="tab6_content2" role="tabpanel" aria-labelledby="tab6_content2">
                                                                        <h4>Data Profil</h4>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="nik">NIK</label>
                                                                                    <input type="text" class="form-control" id="nik" name="nik" value="{{ Auth::user()->name }}" readonly>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="nisn">Nomor Induk Siswa Nasional (NISN)</label>
                                                                                    <input type="text" class="form-control" id="nisn" name="nisn">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="nama_lengkap">Nama Lengkap</label>
                                                                                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="tempat_lahir">Tempat Lahir</label>
                                                                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                                                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="nomor_kk">Nomor Kartu Keluarga (KK)</label>
                                                                                    <input type="text" class="form-control" id="nomor_kk" name="nomor_kk">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="tanggal_kk">Tanggal Penerbitan KK</label>
                                                                                    <input type="date" class="form-control" id="tanggal_kk" name="tanggal_kk">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="nama_orang_tua">Nama Orang Tua / Wali</label>
                                                                                    <input type="text" class="form-control" id="nama_orang_tua" name="nama_orang_tua">
                                                                                </div>
                                                                                {{-- Alamat --}}
                                                                                <div class="form-group">
                                                                                    <label for="alamat">Alamat</label>
                                                                                    <textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex justify-content-between mt-4">
                                                                            <button type="button" class="btn btn-sm btn-secondary back-btn" data-target="#tab6_nav1">Back</button>
                                                                            <button type="button" class="btn btn-sm btn-primary next-btn" data-target="#tab6_nav3">Next</button>
                                                                        </div>
                                                                    </div><!-- end ./tab-pane -->
                                                                    <div class="tab-pane fade" id="tab6_content3" role="tabpanel" aria-labelledby="tab6_content3">
                                                                        <h4>Upload Dokumen</h4>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="pasfoto">Pas Photo</label>
                                                                                    <input type="file" class="form-control-file" id="pasfoto" name="pasfoto">
                                                                                </div>
                                                                                {{-- Akta lahir --}}
                                                                                <div class="form-group">
                                                                                    <label for="akta_lahir">Akta Lahir</label>
                                                                                    <input type="file" class="form-control-file" id="akta_lahir" name="akta_lahir">
                                                                                </div>
                                                                                {{-- Kartu Keluarga --}}
                                                                                <div class="form-group">
                                                                                    <label for="kk">Kartu Keluarga</label>
                                                                                    <input type="file" class="form-control-file" id="kk" name="kk">
                                                                                </div>
                                                                                {{-- KTP Orang Tua --}}
                                                                                <div class="form-group">
                                                                                    <label for="ktp_orang_tua">KTP Orang Tua</label>
                                                                                    <input type="file" class="form-control-file" id="ktp_orang_tua" name="ktp_orang_tua">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                {{-- Kartu PKH (Jalur Afirmasi) --}}
                                                                                <div class="form-group">
                                                                                    <label for="kartu_pkh">Kartu PKH (Jalur Afirmasi)</label>
                                                                                    <input type="file" class="form-control-file" id="kartu_pkh" name="kartu_pkh">
                                                                                </div>
                                                                                {{-- Surat Keterangan Dokter / Kartu Penyandang Disabilitas --}}
                                                                                <div class="form-group">
                                                                                    <label for="surat_dokter">Surat Keterangan Dokter / Disabilitas (Jalur Afirmasi)</label>
                                                                                    <input type="file" class="form-control-file" id="surat_dokter" name="surat_dokter">
                                                                                </div>
                                                                                {{-- Surat Keterangan Pindah --}}
                                                                                <div class="form-group">
                                                                                    <label for="surat_pindah">Surat Keterangan Pindah (Jalur Mutasi)</label>
                                                                                    <input type="file" class="form-control-file" id="surat_pindah" name="surat_pindah">
                                                                                </div>
                                                                                {{-- Dokumen prestasi akademik --}}
                                                                                <div class="form-group">
                                                                                    <label for="dokumen_prestasi">Dokumen Prestasi Akademik (Jalur Prestasi)</label>
                                                                                    {{-- Nilai TKA --}}
                                                                                    <input type="number" class="form-control" id="nilai_tka" name="nilai_tka" placeholder="Masukkan Nilai TKA">
                                                                                    <label for="dokumen_tka">Dokumen Hasil Tes TKA</label>
                                                                                    <input type="file" class="form-control-file" id="dokumen_tka" name="dokumen_tka">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="dokumen_prestasi">Dokumen Prestasi Non-Akademik (Jalur Prestasi)</label>
                                                                                    {{-- Nama perlombaan TKA --}}
                                                                                    <input type="text" class="form-control" id="nama_perlombaan" name="nama_perlombaan" placeholder="Masukkan Nama Perlombaan">
                                                                                    <label for="dokumen_prestasi">Sertifikat Penghargaan</label>
                                                                                    <input type="file" class="form-control-file" id="sertifikat_penghargaan" name="sertifikat_penghargaan">
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="d-flex justify-content-between mt-4">
                                                                            <button type="button" class="btn btn-sm btn-secondary back-btn" data-target="#tab6_nav2">Back</button>
                                                                            <button type="button" class="btn btn-sm btn-primary next-btn" data-target="#tab6_nav4">Next</button>
                                                                        </div>
                                                                    </div><!-- end ./tab-pane -->
                                                                    <div class="tab-pane fade" id="tab6_content4" role="tabpanel" aria-labelledby="tab6_content4">
                                                                        <h4>Pilih Sekolah</h4>
                                                                        <div class="form-group">
                                                                            <label for="pilihan_1">Pilihan 1 (Sesuai Kecamatan, Daftar Unggulan)</label>
                                                                            <div class="select-multiple select-basic">
                                                                                <select class="select2_default form-control" name="sekolah_pilihan_1">
                                                                                    <optgroup label="Pacific Time Zone">
                                                                                        <option value="CA">SD Negeri 1 Banda Sakti</option>
                                                                                        <option value="NV">SD Negeri 2 Banda Sakti</option>
                                                                                        <option value="OR">SD Negeri 3 Banda Sakti</option>
                                                                                        <option value="WA">SD Negeri 4 Banda Sakti</option>
                                                                                    </optgroup>
                                                                                </select>
                                                                            </div>
                                                                        </div><!-- End: .form-group -->
                                                                        <div class="form-group">
                                                                            <label for="pilihan_2">Pilihan 2 (Sesuai Kecamatan, diluar Daftar Unggulan)</label>
                                                                            <div class="select-multiple select-basic">
                                                                                <select class="select2_default form-control" name="sekolah_pilihan_2">
                                                                                    <optgroup label="Pacific Time Zone">
                                                                                        <option value="CA">SD Negeri 1 Banda Sakti</option>
                                                                                        <option value="NV">SD Negeri 2 Banda Sakti</option>
                                                                                        <option value="OR">SD Negeri 3 Banda Sakti</option>
                                                                                        <option value="WA">SD Negeri 4 Banda Sakti</option>
                                                                                    </optgroup>
                                                                                </select>
                                                                            </div>
                                                                        </div><!-- End: .form-group -->
                                                                        <div class="d-flex justify-content-between mt-4">
                                                                            <button type="button" class="btn btn-sm btn-secondary back-btn" data-target="#tab6_nav3">Back</button>
                                                                            <button type="button" class="btn btn-sm btn-primary next-btn" data-target="#tab6_nav5">Next</button>
                                                                        </div>
                                                                    </div><!-- end ./tab-pane -->
                                                                    <div class="tab-pane fade" id="tab6_content5" role="tabpanel" aria-labelledby="tab6_content5">
                                                                        <h4>Submit</h4>
                                                                        <section class="card-style section-bg p-top-20">
                                                                            <div class="card-style-twelve">
                                                                                <div class="container">
                                                                                    <div class="row">
                                                                                        <div class="col-md-12">
                                                                                            <div class="card card-twelve">
                                                                                                <div class="card-body">
                                                                                                    <h6>Perhatian</h6>
                                                                                                    <p>
                                                                                                        <ul>
                                                                                                            <li>Periksa kembali data yang telah dimasukkan</li>
                                                                                                            <li>Pastikan semua dokumen yang diunggah sudah benar dan sesuai dengan persyaratan</li>
                                                                                                        </ul>
                                                                                                    </p>
                                                                                                    <div class="custom-control custom-checkbox checkbox-secondary">
                                                                                                        <input type="checkbox" class="custom-control-input" id="customCheck3" name="terms" required>
                                                                                                        <label class="custom-control-label" for="customCheck3">Saya setuju dengan syarat dan ketentuan yang berlaku</label>
                                                                                                    </div>
                                                                                                    <div class="form-group text-right m-top-30 m-bottom-20">
                                                                                                        <button class="btn btn-outline-secondary" type="submit">Submit</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div><!-- End: .card -->
                                                                                        </div><!-- ends: .col-lg-4 -->
                                                                                    </div><!-- ends: .row -->
                                                                                </div>
                                                                            </div><!-- ends: .card-style-twelve -->
                                                                        </section>

                                                                        <div class="d-flex justify-content-between mt-4">
                                                                            <button type="button" class="btn btn-sm btn-secondary back-btn" data-target="#tab6_nav4">Back</button>
                                                                            <!-- last step: you might add finish or leave blank -->
                                                                        </div>
                                                                    </div><!-- end ./tab-pane -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end ./container -->
                                                </div>
                                                {{-- link kembali ke halaman utama --}}
                                                <div class="form-group pt-5">
                                                    <a href="{{ route('home') }}" class="btn btn-link">Kembali ke Halaman Utama</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- ends: .col-lg-6 -->
                        </div>
                    </div>
                </div><!-- ends: .login-form -->
            </div>
        </section>
        @include('frontend.js')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const jalur = document.getElementById('jalur');
                const nextBtn = document.getElementById('nextToProfil');

                // initially disable tabs except the first one
                document.querySelectorAll('#tab6_nav2, #tab6_nav3, #tab6_nav4, #tab6_nav5').forEach(tab => {
                    tab.classList.add('disabled');
                    tab.setAttribute('aria-disabled', 'true');
                });

                // enable button and other tabs when a jalur is selected
                jalur.addEventListener('change', function() {
                    nextBtn.disabled = !this.value;
                    if (this.value) {
                        document.querySelectorAll('#tab6_nav2, #tab6_nav3, #tab6_nav4, #tab6_nav5').forEach(tab => {
                            tab.classList.remove('disabled');
                            tab.setAttribute('aria-disabled', 'false');
                        });
                    } else {
                        document.querySelectorAll('#tab6_nav2, #tab6_nav3, #tab6_nav4, #tab6_nav5').forEach(tab => {
                            tab.classList.add('disabled');
                            tab.setAttribute('aria-disabled', 'true');
                        });
                    }
                });

                nextBtn.addEventListener('click', function() {
                    // show profil tab
                    const profilTab = document.querySelector('#tab6_nav2');
                    if (profilTab) {
                        $(profilTab).tab('show');
                    }
                });

                // generic navigation buttons
                document.querySelectorAll('.next-btn, .back-btn').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const targetSelector = this.getAttribute('data-target');
                        if (targetSelector) {
                            const targetTab = document.querySelector(targetSelector);
                            if (targetTab) {
                                $(targetTab).tab('show');
                            }
                        }
                    });
                });
            });

            // Ketika jalur mutasi dipilih, disable dokumen surat dokter dan kartu pkh
            document.getElementById('jalur').addEventListener('change', function() {
                const kartuPkhInput = document.getElementById('kartu_pkh');
                const suratDokterInput = document.getElementById('surat_dokter');
                const suratPindahInput = document.getElementById('surat_pindah');
                const nilaiTkaInput = document.getElementById('nilai_tka');
                const dokumenTkaInput = document.getElementById('dokumen_tka');
                const namaPerlombaanInput = document.getElementById('nama_perlombaan');
                const sertifikatPenghargaanInput = document.getElementById('sertifikat_penghargaan');
                if (this.value === 'Mutasi') {
                    kartuPkhInput.disabled = true;
                    suratDokterInput.disabled = true;
                    suratPindahInput.disabled = false;
                    nilaiTkaInput.disabled = true;
                    dokumenTkaInput.disabled = true;
                    namaPerlombaanInput.disabled = true;
                    sertifikatPenghargaanInput.disabled = true;
                } else if (this.value === 'Afirmasi') {
                    kartuPkhInput.disabled = false;
                    suratDokterInput.disabled = false;
                    suratPindahInput.disabled = true;
                    nilaiTkaInput.disabled = true;
                    dokumenTkaInput.disabled = true;
                    namaPerlombaanInput.disabled = true;
                    sertifikatPenghargaanInput.disabled = true;
                } else if (this.value === 'Prestasi') {
                    kartuPkhInput.disabled = true;
                    suratDokterInput.disabled = true;
                    suratPindahInput.disabled = true;
                    nilaiTkaInput.disabled = false;
                    dokumenTkaInput.disabled = false;
                    namaPerlombaanInput.disabled = false;
                    sertifikatPenghargaanInput.disabled = false;
                } else {
                    kartuPkhInput.disabled = true;
                    suratDokterInput.disabled = true;
                    suratPindahInput.disabled = true;
                    nilaiTkaInput.disabled = true;
                    dokumenTkaInput.disabled = true;
                    namaPerlombaanInput.disabled = true;
                    sertifikatPenghargaanInput.disabled = true;
                }
            });
        </script>
    </body>
</html>
