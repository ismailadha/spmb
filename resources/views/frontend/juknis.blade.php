@extends('frontend.main')

@section('content')
    <section class="breadcrumb_area breadcrumb2 bgimage biz_overlay">
        <div class="bg_image_holder">
            <img src="https://images.unsplash.com/photo-1510531704581-5b2870972060?auto=format&fit=crop&w=1920&q=80" alt="">
        </div>
        <div class="container content_above">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb_wrapper d-flex flex-column align-items-center">
                        <h3 class="page_title">Petunjuk Teknis</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="juknis_area section-padding" style="padding: 80px 0; background-color: #f8f9fa;">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <h2 class="mb-3" style="color: #1e2a4a; font-weight: 700;">Alur Pendaftaran Siswa Baru</h2>
                    <p class="text-muted" style="font-size: 1.1rem; line-height: 1.8;">Berikut adalah petunjuk teknis langkah demi langkah untuk melakukan pendaftaran secara online. Pastikan Anda memahami setiap prosedur yang diberikan agar proses pendaftaran berjalan lancar.</p>
                </div>
            </div>

            <div class="row">
                <!-- Step 1 -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm" style="border-radius: 15px; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 1rem 3rem rgba(0,0,0,.1)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 .125rem .25rem rgba(0,0,0,.075)'">
                         <div class="card-body text-center p-5">
                            <div class="icon_box mb-4 d-inline-block" style="width: 80px; height: 80px; background: rgba(52, 152, 219, 0.1); border-radius: 50%; line-height: 80px;">
                                <i class="la la-user-plus" style="font-size: 2.5rem; color: #3498db;"></i>
                            </div>
                            <h4 class="card-title font-weight-bold mb-3" style="color: #1e2a4a;">1. Buat Akun Pendaftar</h4>
                            <p class="card-text text-muted" style="line-height: 1.6;">Calon peserta didik wajib membuat akun menggunakan username dan password yang mudah diingat.</p>
                         </div>
                    </div>
                </div>
                <!-- Step 2 -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm" style="border-radius: 15px; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 1rem 3rem rgba(0,0,0,.1)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 .125rem .25rem rgba(0,0,0,.075)'">
                         <div class="card-body text-center p-5">
                            <div class="icon_box mb-4 d-inline-block" style="width: 80px; height: 80px; background: rgba(26, 188, 156, 0.1); border-radius: 50%; line-height: 80px;">
                                <i class="la la-edit" style="font-size: 2.5rem; color: #1abc9c;"></i>
                            </div>
                            <h4 class="card-title font-weight-bold mb-3" style="color: #1e2a4a;">2. Pengisian Biodata</h4>
                            <p class="card-text text-muted" style="line-height: 1.6;">Login ke dalam sistem, lalu lengkapi formulir pendaftaran yang meliputi data diri, data orang tua/wali, serta data asal sekolah pelamar.</p>
                         </div>
                    </div>
                </div>
                <!-- Step 3 -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm" style="border-radius: 15px; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 1rem 3rem rgba(0,0,0,.1)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 .125rem .25rem rgba(0,0,0,.075)'">
                         <div class="card-body text-center p-5">
                            <div class="icon_box mb-4 d-inline-block" style="width: 80px; height: 80px; background: rgba(243, 156, 18, 0.1); border-radius: 50%; line-height: 80px;">
                                <i class="la la-cloud-upload" style="font-size: 2.5rem; color: #f39c12;"></i>
                            </div>
                            <h4 class="card-title font-weight-bold mb-3" style="color: #1e2a4a;">3. Unggah Dokumen</h4>
                            <p class="card-text text-muted" style="line-height: 1.6;">Upload hasil scan dokumen persyaratan asli seperti Kartu Keluarga, Akta Kelahiran, dan Ijazah dalam format PDF atau JPG maksimal 2MB.</p>
                         </div>
                    </div>
                </div>
                <!-- Step 4 -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm" style="border-radius: 15px; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 1rem 3rem rgba(0,0,0,.1)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 .125rem .25rem rgba(0,0,0,.075)'">
                         <div class="card-body text-center p-5">
                            <div class="icon_box mb-4 d-inline-block" style="width: 80px; height: 80px; background: rgba(155, 89, 182, 0.1); border-radius: 50%; line-height: 80px;">
                                <i class="la la-check-circle" style="font-size: 2.5rem; color: #9b59b6;"></i>
                            </div>
                            <h4 class="card-title font-weight-bold mb-3" style="color: #1e2a4a;">4. Verifikasi Berkas</h4>
                            <p class="card-text text-muted" style="line-height: 1.6;">Panitia SPMB akan memverifikasi keabsahan dokumen. Anda dapat mengecek status verifikasi secara berkala lewat dashboard akun.</p>
                         </div>
                    </div>
                </div>
                <!-- Step 5 -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm" style="border-radius: 15px; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 1rem 3rem rgba(0,0,0,.1)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 .125rem .25rem rgba(0,0,0,.075)'">
                         <div class="card-body text-center p-5">
                            <div class="icon_box mb-4 d-inline-block" style="width: 80px; height: 80px; background: rgba(231, 76, 60, 0.1); border-radius: 50%; line-height: 80px;">
                                <i class="la la-print" style="font-size: 2.5rem; color: #e74c3c;"></i>
                            </div>
                            <h4 class="card-title font-weight-bold mb-3" style="color: #1e2a4a;">5. Cetak Bukti Daftar</h4>
                            <p class="card-text text-muted" style="line-height: 1.6;">Setelah berkas dinyatakan terverifikasi/valid, peserta wajib mencetak formulir atau tanda bukti pendaftaran sebagai syarat tes.</p>
                         </div>
                    </div>
                </div>
                <!-- Step 6 -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm" style="border-radius: 15px; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 1rem 3rem rgba(0,0,0,.1)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 .125rem .25rem rgba(0,0,0,.075)'">
                         <div class="card-body text-center p-5">
                            <div class="icon_box mb-4 d-inline-block" style="width: 80px; height: 80px; background: rgba(46, 204, 113, 0.1); border-radius: 50%; line-height: 80px;">
                                <i class="la la-bullhorn" style="font-size: 2.5rem; color: #2ecc71;"></i>
                            </div>
                            <h4 class="card-title font-weight-bold mb-3" style="color: #1e2a4a;">6. Pengumuman Kelulusan</h4>
                            <p class="card-text text-muted" style="line-height: 1.6;">Hasil akhir seleksi peserta didik baru akan diumumkan secara online pada menu Hasil Seleksi sesuai dengan jadwal yang telah ditetapkan.</p>
                         </div>
                    </div>
                </div>
            </div>

            <!-- Notes or Warning Section -->
            <div class="row mt-5">
                <div class="col-12">
                     <div class="alert fade show p-4" style="background-color: #fff; border-left: 5px solid #e74c3c; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
                        <div class="d-flex align-items-center">
                            <i class="la la-exclamation-triangle mr-4 d-none d-sm-block" style="font-size: 3.5rem; color: #e74c3c;"></i>
                            <div>
                                <h4 class="alert-heading font-weight-bold mb-2" style="color: #1e2a4a;">Perhatian Penting Bagi Pendaftar</h4>
                                <p class="mb-0 text-muted" style="line-height: 1.7; font-size: 1.05rem;">Segala bentuk pemalsuan data atau dokumen akan mengakibatkan <strong>GUGUR / DISKUALIFIKASI</strong> dari proses seleksi. Pastikan semua data yang Anda isikan serta dokumen yang diunggah adalah sah dan benar. Pastikan juga Anda menyimpan password dengan baik.</p>
                            </div>
                        </div>
                     </div>
                </div>
            </div>

            <div class="row mt-5 pt-3">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <h3 class="font-weight-bold mb-3" style="color: #1e2a4a;">Mengalami Kendala Teknis?</h3>
                    <p class="text-muted mb-4" style="font-size: 1.1rem;">Tim bantuan kami bersedia untuk membantu Anda jika terdapat permasalahan selama proses pendaftaran. Silakan hubungi kami di jam kerja (Senin - Sabtu: 08:00 WIB - 15:00 WIB).</p>
                    <a href="#" class="btn btn-outline-primary px-5 py-3 mx-2 my-1" style="border-radius: 50px; font-weight: 600; font-size: 1rem; border-width: 2px;">
                        <i class="la la-whatsapp mr-1"></i> WhatsApp Center
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
