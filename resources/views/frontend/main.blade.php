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
        <div class="top_bar top--bar2 d-flex align-items-center bg-dark">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex topbar_content justify-content-between">
                            <div class="top_bar--lang align-self-center order-2">
                                <a class="btn btn-primary" href="{{ route('register-peserta') }}">Buat Akun</a>
                            </div>
                            <div class="top_bar--info order-0 d-none d-lg-block align-self-center">
                                <ul>
                                    <li><span class="la la-envelope"></span>
                                        <p>support@email.com</p>
                                    </li>
                                    <li><span class="la la-headphones"></span>
                                        <p>800 567.890.576</p>
                                    </li>
                                    <li><span class="la la-clock-o"></span>
                                        <p>Mon-Sat 8.00 - 18.00</p>
                                    </li>
                                </ul>
                            </div>
                            @if (Auth::check())
                                <div class="top_bar--social">
                                    <p>Anda login sebagai {{ Auth::user()->name }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- start menu area -->
        <div class="menu_area menu1 menu--sticky">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light bg-light px-0">
                    <a class="navbar-brand order-sm-1 order-1" href="#"><img height="50" width="150" src="{{ asset('images/spmb-logo.png') }}" alt="" /></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent2" aria-controls="navbarSupportedContent2" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="la la-bars"></span>
                    </button>
                    <div class="collapse navbar-collapse order-md-1" id="navbarSupportedContent2">
                        <ul class="navbar-nav m-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ route('home') }}">Beranda</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Informasi</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('juknis') }}">Petunjuk Teknis</a>
                                    <a class="dropdown-item" href="{{ route('persyaratan') }}">Persyaratan</a>
                                    <a class="dropdown-item" href="{{ route('datasekolah') }}">Data Sekolah</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Peta Zonasi</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">SD</a>
                                    <a class="dropdown-item" href="">SMP</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Hasil Seleksi</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">SD</a>
                                    <a class="dropdown-item" href="">SMP</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pendaftaran</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Pembuatan Akun</a>
                                    <a class="dropdown-item" href="">Pendaftaran Peserta</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Kontak</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Dinas</a>
                                    <a class="dropdown-item" href="">Sekolah</a>
                                </div>
                            </li>
                        </ul>
                        <!-- end: .navbar-nav -->
                    </div>
                    <div class="nav_right_content d-flex align-items-center order-2 order-sm-2">
                        <!-- end .cart_module -->
                        <div class="nav_right_module search_module">
                            <span class="la la-search search_trigger"></span>
                            <div class="search_area">
                                <form action="/">
                                    <div class="input-group input-group-light">
                                        <span class="icon-left">
                                            <i class="la la-search"></i>
                                        </span>
                                        <input type="text" class="form-control search_field" placeholder="Type words and hit enter...">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- end ./search_module -->
                    </div>
                </nav>
            </div>
        </div>
        <!-- end menu area -->
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
