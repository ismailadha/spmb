<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistem Penerimaan Siswa Baru</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ 'front/img/favicon.png' }}">
    @include('frontend.css')
</head>

<body>
    <!-- header area -->
    <section class="header header--2">
        <!-- Topbar: Sleek and Slim -->
        <div class="top_bar" style="background-color: #1e2a4a; color: #f8f9fa; padding: 20px 0;">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-7 d-none d-md-block">
                        <div class="d-flex align-items-center" style="font-size: 0.85rem; opacity: 0.9; margin: 0; padding: 0; line-height: 1;">
                            <div class="d-flex align-items-center mr-4"><i class="la la-envelope mr-1" style="color: #3498db; font-size: 1.1rem;"></i> support@spmb.com</div>
                            <div class="d-flex align-items-center mr-4"><i class="la la-phone mr-1" style="color: #3498db; font-size: 1.1rem;"></i> 0800 123 456</div>
                            <div class="d-flex align-items-center"><i class="la la-clock-o mr-1" style="color: #3498db; font-size: 1.1rem;"></i> Senin - Sabtu 08.00 - 15.00</div>
                        </div>
                    </div>
                    <div class="col-md-5 text-md-right text-center d-flex align-items-center justify-content-md-end justify-content-center">
                        @auth
                            <div class="d-flex align-items-center" style="font-size: 0.85rem; font-weight: 500; line-height: 1;">
                                <i class="la la-user-circle mr-1" style="font-size: 1.1rem;"></i> Selamat datang, <strong style="color: #1abc9c; margin-left: 4px;">{{ Auth::user()->name }}</strong>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Navbar -->
        <div class="menu_area menu1 menu--sticky bg-white" style="box-shadow: 0 4px 20px rgba(0,0,0,0.06);">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light px-0 py-3">
                    <a class="navbar-brand order-sm-1 order-1" href="{{ route('home') }}">
                        <img height="48" src="{{ asset('images/spmb-logo.png') }}" alt="Logo SPMB" style="object-fit: contain;" />
                    </a>
                    
                    <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="outline: none;">
                        <span class="la la-bars" style="font-size: 1.6rem; color: #1e2a4a;"></span>
                    </button>
                    
                    <div class="collapse navbar-collapse order-md-1" id="navbarSupportedContent">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item active">
                                <a class="nav-link font-weight-bold mx-2" href="{{ route('home') }}" style="color: #1e2a4a; font-size: 0.95rem;">Beranda</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle font-weight-bold mx-2" href="#" data-toggle="dropdown" style="color: #1e2a4a; font-size: 0.95rem;">Informasi</a>
                                <div class="dropdown-menu border-0 shadow-sm" style="border-radius: 12px; margin-top: 10px;">
                                    <a class="dropdown-item py-2" href="{{ route('juknis') }}">Petunjuk Teknis</a>
                                    <a class="dropdown-item py-2" href="{{ route('persyaratan') }}">Persyaratan</a>
                                    <a class="dropdown-item py-2" href="{{ route('datasekolah') }}">Data Sekolah</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle font-weight-bold mx-2" href="#" data-toggle="dropdown" style="color: #1e2a4a; font-size: 0.95rem;">Peta Zonasi</a>
                                <div class="dropdown-menu border-0 shadow-sm" style="border-radius: 12px; margin-top: 10px;">
                                    <a class="dropdown-item py-2" href="#">SD</a>
                                    <a class="dropdown-item py-2" href="#">SMP</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle font-weight-bold mx-2" href="#" data-toggle="dropdown" style="color: #1e2a4a; font-size: 0.95rem;">Hasil Seleksi</a>
                                <div class="dropdown-menu border-0 shadow-sm" style="border-radius: 12px; margin-top: 10px;">
                                    <a class="dropdown-item py-2" href="#">SD</a>
                                    <a class="dropdown-item py-2" href="#">SMP</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle font-weight-bold mx-2" href="#" data-toggle="dropdown" style="color: #1e2a4a; font-size: 0.95rem;">Pendaftaran</a>
                                <div class="dropdown-menu border-0 shadow-sm" style="border-radius: 12px; margin-top: 10px;">
                                    <a class="dropdown-item py-2" href="{{ route('register-peserta') }}">Pembuatan Akun</a>
                                    <a class="dropdown-item py-2" href="#">Pendaftaran Peserta</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold mx-2" href="#" style="color: #1e2a4a; font-size: 0.95rem;">Kontak</a>
                            </li>
                        </ul>
                        
                        <div class="nav_right_content d-flex align-items-center order-2 order-sm-2 ml-lg-3 mt-3 mt-lg-0">
                            @auth
                                <a class="btn btn-outline-danger px-4 py-2" style="border-radius: 50px; font-weight: 600; font-size: 0.9rem;" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="la la-sign-out mr-1"></i> Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none" style="display: none;">
                                    @csrf
                                </form>
                            @else
                                <a class="btn btn-primary px-4 py-2" style="border-radius: 50px; font-weight: 600; font-size: 0.9rem; background: linear-gradient(135deg, #1abc9c 0%, #3498db 100%); border: none; box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);" href="{{ route('register-peserta') }}" onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 6px 20px rgba(52, 152, 219, 0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(52, 152, 219, 0.3)';">
                                    <i class="la la-user-plus mr-1"></i> Daftar SPMB
                                </a>
                            @endauth
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </section><!-- end: .header -->
    @yield('content')
    <footer class="footer5 footer--bw">
        <div class="footer__big">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="widget text_widget">
                            <img class="footer_logo" src="img/logo-white.png" alt="logo">
                            <p>Nunc placerat mi id nisi interdum they mtolis. Praesient is pharetra justo ught scel
                                erisque the mattis lhreo quam nterdum mollisy.</p>
                            <a href="#">Read More About <span class="la la-chevron-right"></span></a>
                        </div><!-- ends: .widget -->
                    </div><!-- ends: .col-lg-3 -->
                    <div class="col-lg-3 col-md-6 col-sm-6 d-flex justify-content-lg-center">
                        <div class="widget widget--links">
                            <h4 class="widget__title">quick links</h4>
                            <ul class="links">
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Contacts Us</a></li>
                                <li><a href="#">Testimonials</a></li>
                                <li><a href="#">Careers</a></li>
                                <li><a href="#">Our Team</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                            </ul>
                        </div><!-- ends: .widget -->
                    </div><!-- ends: .col-lg-3 -->
                    <div class="col-lg-3 col-md-6 col-sm-6 d-flex justify-content-lg-center">
                        <div class="widget widget--links">
                            <h4 class="widget__title">our services</h4>
                            <ul class="links">
                                <li><a href="#">Business</a></li>
                                <li><a href="#">Marketing</a></li>
                                <li><a href="#">Management</a></li>
                                <li><a href="#">Accounting</a></li>
                                <li><a href="#">Training</a></li>
                                <li><a href="#">Consultation</a></li>
                            </ul>
                        </div><!-- ends: .widget -->
                    </div><!-- ends: .col-lg-3 -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="widget subcribe--widget">
                            <h4 class="widget__title">Newsletter</h4>
                            <p>Subscribe to get update and information. Don't worry, we won't send spam!</p>
                            <form class="subscribe_form">
                                <div class="input_with_embed">
                                    <input type="text" class="form-control-lg input--rounded border-0" placeholder="Enter email">
                                    <div class="embed_icon">
                                        <span class="la la-envelope"></span>
                                    </div>
                                </div>
                            </form>
                            <div class="widget__social">
                                <div class="social  ">
                                    <ul class="d-flex flex-wrap">
                                        <li><a href="#" class="facebook"><span class="fab fa-facebook-f"></span></a></li>
                                        <li><a href="#" class="twitter"><span class="fab fa-twitter"></span></a></li>
                                        <li><a href="#" class="linkedin"><span class="fab fa-linkedin-in"></span></a></li>
                                        <li><a href="#" class="gplus"><span class="fab fa-google-plus-g"></span></a></li>
                                    </ul>
                                </div><!-- ends: .social -->
                            </div>
                        </div><!-- ends: .widget -->
                    </div><!-- ends: .col-lg-3 -->
                </div>
            </div>
        </div><!-- ends: .footer__big -->
        <div class="footer__small text-center">
            <p>©2019 Tizara. All rights reserved. Created by <a href="#">AazzTech</a></p>
        </div><!-- ends: .footer__small -->
    </footer>
    <div class="go_top">
        <span class="la la-angle-up"></span>
    </div>
    @include('frontend.js')
</body>

</html>
