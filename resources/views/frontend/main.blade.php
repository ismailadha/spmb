<!doctype html>
@php
    $logoUrl = !empty($appConfig['logo_path']) ? asset($appConfig['logo_path']) : asset('images/spmb-logo.png');
@endphp
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $appConfig['nama_sistem'] ?? 'Sistem Penerimaan Siswa Baru' }}</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ !empty($appConfig['favicon']) ? asset($appConfig['favicon']) : asset('front/img/favicon.png') }}">
    @include('frontend.css')
    <style>
        .btn-login-top:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-color: #ffffff !important;
            transform: translateY(-2px);
        }
        .btn-register-top:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(52, 152, 219, 0.4) !important;
            filter: brightness(1.1);
        }
        .auth-buttons a {
            letter-spacing: 0.5px;
        }
        @media (max-width: 576px) {
            .navbar-brand img {
                max-width: 150px !important;
                height: auto !important;
            }
        }
        
        /* Premium Footer Styles */
        .footer-premium {
            background: linear-gradient(135deg, #1e2a4a 0%, #111827 100%) !important;
            color: #cbd5e1 !important;
            border-top: 4px solid #3498db;
            position: relative;
        }
        .footer-premium::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(to right, transparent, rgba(255,255,255,0.1), transparent);
        }
        .footer-premium .widget__title {
            color: #ffffff !important;
            font-weight: 700 !important;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 30px;
        }
        .footer-premium .links {
            list-style: none;
            padding: 0;
        }
        .footer-premium .links li {
            margin-bottom: 12px;
        }
        .footer-premium .links li a {
            color: #94a3b8 !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
            align-items: center;
            text-decoration: none;
            font-size: 0.95rem;
        }
        .footer-premium .links li a i {
            font-size: 0.7rem;
            margin-right: 8px;
            opacity: 0.5;
            transition: all 0.3s ease;
        }
        .footer-premium .links li a:hover {
            color: #3498db !important;
            transform: translateX(8px);
        }
        .footer-premium .links li a:hover i {
            opacity: 1;
            color: #3498db;
        }
        .footer-premium .text_widget p {
            color: #94a3b8 !important;
            line-height: 1.8;
        }
        .footer-premium .footer_logo {
            transition: transform 0.3s ease;
        }
        .footer-premium .footer_logo:hover {
            transform: scale(1.05);
        }
        .footer-bottom-premium {
            background-color: #0f172a !important;
            border-top: 1px solid rgba(255,255,255,0.05);
            padding: 25px 0;
            color: #64748b !important;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }
    </style>
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
                            <div class="d-flex align-items-center mr-4"><i class="la la-envelope mr-1" style="color: #3498db; font-size: 1.1rem;"></i> {{ $appConfig['email_resmi'] ?? 'support@spmb.com' }}</div>
                            <div class="d-flex align-items-center mr-4"><i class="la la-phone mr-1" style="color: #3498db; font-size: 1.1rem;"></i> {{ $appConfig['telepon'] ?? '0800 123 456' }}</div>
                            <div class="d-flex align-items-center"><i class="la la-clock-o mr-1" style="color: #3498db; font-size: 1.1rem;"></i> Senin - Sabtu 08.00 - 15.00</div>
                        </div>
                    </div>
                    <div class="col-md-5 text-md-right text-center d-flex align-items-center justify-content-md-end justify-content-center">
                        @auth
                            <div class="d-flex align-items-center" style="font-size: 0.85rem; font-weight: 500; line-height: 1;">
                                <i class="la la-user-circle mr-1" style="font-size: 1.1rem;"></i> Selamat datang, <strong style="color: #1abc9c; margin-left: 4px;">{{ Auth::user()->name }}</strong>
                                <a href="{{ route('logout') }}" style="color: #ffffffff; margin-left: 4px;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">| Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        @else
                            <div class="d-flex align-items-center auth-buttons">
                                <a href="{{ route('login-peserta') }}" class="btn-login-top mr-2" style="color: #ffffff; font-size: 0.82rem; font-weight: 600; text-decoration: none; padding: 6px 16px; border: 1px solid rgba(255,255,255,0.3); border-radius: 30px; display: inline-flex; align-items: center; transition: all 0.3s ease;">
                                    <i class="la la-sign-in mr-1" style="font-size: 1.1rem;"></i> LOGIN
                                </a>
                                <a href="{{ route('register-peserta') }}" class="btn-register-top" style="color: #ffffff; font-size: 0.82rem; font-weight: 600; text-decoration: none; padding: 7px 20px; background: linear-gradient(135deg, #3498db 0%, #2980b9 100%); border-radius: 30px; display: inline-flex; align-items: center; box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3); transition: all 0.3s ease; border: none;">
                                    <i class="la la-user-plus mr-1" style="font-size: 1.1rem;"></i> REGISTRASI
                                </a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Navbar -->
        <div class="menu_area menu1 menu--sticky bg-white" style="box-shadow: 0 4px 20px rgba(0,0,0,0.06);">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light px-0 py-2">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="{{ $logoUrl }}" alt="Logo {{ $appConfig['logo_path'] ?? 'SPMB' }}" style="height: 48px; width: auto; max-width: 100%; object-fit: contain;" />
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
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle font-weight-bold mx-2" href="#" data-toggle="dropdown" style="color: #1e2a4a; font-size: 0.95rem;">Data Sekolah</a>
                                <div class="dropdown-menu border-0 shadow-sm" style="border-radius: 12px; margin-top: 10px;">
                                    <a class="dropdown-item py-2" href="{{ route('sekolah-sd') }}">SD</a>
                                    <a class="dropdown-item py-2" href="{{ route('sekolah-smp') }}">SMP</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle font-weight-bold mx-2" href="#" data-toggle="dropdown" style="color: #1e2a4a; font-size: 0.95rem;">Zonasi Sekolah</a>
                                <div class="dropdown-menu border-0 shadow-sm" style="border-radius: 12px; margin-top: 10px;">
                                    <a class="dropdown-item py-2" href="{{ route('zonasi-sd') }}">SD</a>
                                    <a class="dropdown-item py-2" href="{{ route('zonasi-smp') }}">SMP</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold mx-2" href="{{ route('hasil-seleksi') }}" style="color: #1e2a4a; font-size: 0.95rem;">Hasil Seleksi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold mx-2" href="{{ route('kontak') }}" style="color: #1e2a4a; font-size: 0.95rem;">Kontak</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </section><!-- end: .header -->
    @yield('content')
    <footer class="footer-premium">
        <div class="footer__big">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-12 mb-5 mb-lg-0">
                        <div class="widget text_widget">
                            <div style="background: #ffffff; padding: 20px; border-radius: 8px; display: inline-block; margin-bottom: 25px;">
                                <img src="{{ $logoUrl }}" alt="logo" style="height: 45px; width: auto; display: block;">
                            </div>
                            <h4 class="widget__title mb-2" style="font-size: 1.4rem; color: #ffffff !important;">{{ $appConfig['nama_sistem'] ?? 'Sistem Penerimaan Siswa Baru' }}</h4>
                            <p class="mb-4" style="color: #3498db !important; font-weight: 600; font-size: 1rem;">{{ $appConfig['nama_instansi'] ?? 'Dinas Pendidikan' }}</p>
                            <div class="d-flex align-items-start mb-3">
                                <i class="la la-map-marker mr-3 mt-1" style="color: #3498db; font-size: 1.2rem;"></i>
                                <p class="m-0">{{ $appConfig['alamat'] ?? 'Alamat kantor resmi dinas pendidikan setempat.' }}</p>
                            </div>
                        </div><!-- ends: .widget -->
                    </div><!-- ends: .col-lg-6 -->

                    <div class="col-lg-6 col-md-12">
                        <div class="widget widget--links">
                            <h4 class="widget__title">Menu Utama</h4>
                            <div class="row">
                                <div class="col-md-6 col-6">
                                    <ul class="links">
                                        <li><a href="{{ route('home') }}"><i class="la la-angle-right"></i> Beranda</a></li>
                                        <li><a href="{{ route('juknis') }}"><i class="la la-angle-right"></i> Petunjuk Teknis</a></li>
                                        <li><a href="{{ route('persyaratan') }}"><i class="la la-angle-right"></i> Persyaratan</a></li>
                                        <li><a href="{{ route('hasil-seleksi') }}"><i class="la la-angle-right"></i> Hasil Seleksi</a></li>
                                    </ul>
                                </div>
                                <div class="col-md-6 col-6">
                                    <ul class="links">
                                        <li><a href="{{ route('sekolah-sd') }}"><i class="la la-angle-right"></i> Data Sekolah SD</a></li>
                                        <li><a href="{{ route('sekolah-smp') }}"><i class="la la-angle-right"></i> Data Sekolah SMP</a></li>
                                        <li><a href="{{ route('zonasi-sd') }}"><i class="la la-angle-right"></i> Zonasi Sekolah SD</a></li>
                                        <li><a href="{{ route('zonasi-smp') }}"><i class="la la-angle-right"></i> Zonasi Sekolah SMP</a></li>
                                        <li><a href="{{ route('kontak') }}"><i class="la la-angle-right"></i> Kontak</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div><!-- ends: .widget -->
                    </div><!-- ends: .col-lg-6 -->
                </div>
            </div>
        </div><!-- ends: .footer__big -->
        <div class="footer-bottom-premium text-center">
            <div class="container">
                <p class="m-0">{{ $appConfig['footer_teks'] ?? (date('Y') . ' © ' . ($appConfig['nama_instansi'] ?? 'SPMB')) }} - All Rights Reserved</p>
            </div>
        </div><!-- ends: .footer-bottom-premium -->
    </footer>
    <div class="go_top">
        <span class="la la-angle-up"></span>
    </div>
    @include('frontend.js')
</body>

</html>
