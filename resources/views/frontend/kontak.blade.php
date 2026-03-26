@extends('frontend.main')

@section('content')

<!-- Contact Area -->
<section class="contact_area section-padding" style="padding: 80px 0; background-color: #f8f9fa;">
    <div class="container">
        
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <h2 style="font-size: 2.2rem; font-weight: 700; color: #1e2a4a; margin-bottom: 15px;">Hubungi Kami</h2>
                
                <div style="width: 60px; height: 3px; background-color: #3498db; margin: 20px auto 0; border-radius: 2px;"></div>
            </div>
        </div>

        <div class="row">
            <!-- Contact Info -->
            <div class="col-lg-8 mx-auto mb-5 mb-lg-0">
                <div class="contact_info h-100" style="background: #fff; padding: 40px; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); position: relative; overflow: hidden;">
                    <!-- Decorative element -->
                    <div style="position: absolute; top: 0; left: 0; width: 5px; height: 100%; background: linear-gradient(to bottom, #3498db, #1abc9c);"></div>
                    <div style="position: absolute; top: -50px; right: -50px; width: 150px; height: 150px; background: rgba(52, 152, 219, 0.05); border-radius: 50%;"></div>
                    
                    <h3 style="font-size: 1.6rem; font-weight: 700; color: #1e2a4a; margin-bottom: 35px; position: relative;">Informasi Kontak</h3>
                    
                    <div class="info_item d-flex align-items-start mb-4">
                        <div class="icon" style="width: 50px; height: 50px; background: rgba(52, 152, 219, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 20px; flex-shrink: 0; transition: all 0.3s ease;">
                            <i class="la la-map-marker" style="font-size: 1.6rem; color: #3498db;"></i>
                        </div>
                        <div class="content pt-1">
                            <h5 style="font-size: 1.05rem; font-weight: 700; color: #1e2a4a; margin-bottom: 8px;">Alamat Resmi</h5>
                            <p style="color: #555; font-size: 0.95rem; line-height: 1.6; margin: 0;">
                                <strong>Dinas Pendidikan dan Kebudayaan Kota Lhokseumawe</strong><br>
                                Jalan H. Ramli Ridwan, Ds. Mon Geudong,<br> 
                                Kecamatan Banda Sakti, Kota Lhokseumawe,<br>
                                Provinsi Aceh. Kode Pos 24351
                            </p>
                        </div>
                    </div>

                    <div class="info_item d-flex align-items-start mb-4">
                        <div class="icon" style="width: 50px; height: 50px; background: rgba(26, 188, 156, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 20px; flex-shrink: 0; transition: all 0.3s ease;">
                            <i class="la la-phone" style="font-size: 1.6rem; color: #1abc9c;"></i>
                        </div>
                        <div class="content pt-1">
                            <h5 style="font-size: 1.05rem; font-weight: 700; color: #1e2a4a; margin-bottom: 8px;">Telepon / Fax</h5>
                            <p style="color: #555; font-size: 0.95rem; line-height: 1.6; margin: 0;">
                                Telepon: (0645) 45234<br>
                                Fax: (0645) 42335
                            </p>
                        </div>
                    </div>

                    <div class="info_item d-flex align-items-start">
                        <div class="icon" style="width: 50px; height: 50px; background: rgba(231, 76, 60, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 20px; flex-shrink: 0; transition: all 0.3s ease;">
                            <i class="la la-envelope" style="font-size: 1.6rem; color: #e74c3c;"></i>
                        </div>
                        <div class="content pt-1">
                            <h5 style="font-size: 1.05rem; font-weight: 700; color: #1e2a4a; margin-bottom: 8px;">Email Address</h5>
                            <p style="color: #555; font-size: 0.95rem; line-height: 1.6; margin: 0;">
                                <a href="mailto:disdikbud.lhokseumawe@gmail.com" style="color: #555; text-decoration: none;">disdikbud.lhokseumawe@gmail.com</a>
                            </p>
                        </div>
                    </div>
                    
                    <div class="social_links mt-5 pt-4" style="border-top: 1px dashed #eee;">
                        <h5 style="font-size: 0.9rem; font-weight: 600; color: #999; margin-bottom: 15px; text-transform: uppercase; letter-spacing: 1px;">Ikuti Kami</h5>
                        <div class="d-flex">
                            <a href="#" class="social-icon" style="width: 40px; height: 40px; background: #f4f6f9; color: #1e2a4a; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 10px; transition: all 0.3s ease; text-decoration: none;">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="social-icon" style="width: 40px; height: 40px; background: #f4f6f9; color: #1e2a4a; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 10px; transition: all 0.3s ease; text-decoration: none;">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="social-icon" style="width: 40px; height: 40px; background: #f4f6f9; color: #1e2a4a; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 10px; transition: all 0.3s ease; text-decoration: none;">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="social-icon" style="width: 40px; height: 40px; background: #f4f6f9; color: #1e2a4a; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease; text-decoration: none;">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </div>
                        <style>
                            .social-icon:hover {
                                background: #3498db !important;
                                color: #fff !important;
                                transform: translateY(-3px);
                            }
                        </style>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
