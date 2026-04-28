<!doctype html>
@php
    $appConfig = \App\Models\Konfigurasi::pluck('nilai', 'kunci')->toArray();
    $logoUrl = !empty($appConfig['logo_path']) ? asset($appConfig['logo_path']) : asset('images/spmb-logo.png');
@endphp
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Registrasi - {{ $appConfig['nama_sistem'] ?? 'SPMB' }}</title>
        <link rel="icon" type="image/png" sizes="32x32" href="{{ !empty($appConfig['favicon']) ? asset($appConfig['favicon']) : asset('front/img/favicon.png') }}">
        @include('frontend.css')
    </head>
    <body>
        <section class="login-register bgimage biz_overlay overlay--secondary2">
            <div class="bg_image_holder">
                <img src="https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=600&q=80" alt="">
            </div>
            <div class="content_above">
                <!-- end menu area -->
                <div class="signup-form d-flex align-items-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 offset-lg-3">
                                <div class="form-wrapper">
                                <style>
                                    .interactive-card {
                                        border-radius: 20px;
                                        border: none;
                                        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
                                        overflow: hidden;
                                        transition: transform 0.3s ease, box-shadow 0.3s ease;
                                        background: #fff;
                                    }
                                    
                                    .interactive-card:hover {
                                        transform: translateY(-5px);
                                        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
                                    }

                                    .interactive-card .card-header {
                                        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
                                        color: white;
                                        padding: 30px 20px;
                                        border-bottom: none;
                                        text-align: center;
                                    }

                                    .interactive-card .card-header h4 {
                                        color: white;
                                        font-weight: 700;
                                        margin: 0;
                                        letter-spacing: 1px;
                                        text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
                                    }

                                    .interactive-card .card-body {
                                        padding: 40px 30px;
                                    }

                                    .form-floating-custom {
                                        position: relative;
                                        margin-bottom: 25px;
                                    }

                                    .form-floating-custom input.form-control {
                                        width: 100%;
                                        height: auto;
                                        padding: 15px 20px;
                                        font-size: 16px;
                                        border: 2px solid #e0e0e0;
                                        border-radius: 12px;
                                        outline: none;
                                        background: transparent;
                                        transition: all 0.3s ease;
                                        box-shadow: none;
                                    }

                                    .form-floating-custom label {
                                        position: absolute;
                                        top: 50%;
                                        left: 20px;
                                        transform: translateY(-50%);
                                        font-size: 15px;
                                        color: #999;
                                        pointer-events: none;
                                        transition: all 0.3s ease;
                                        background: #fff;
                                        padding: 0 5px;
                                        margin-bottom: 0;
                                    }

                                    .form-floating-custom input.form-control:focus,
                                    .form-floating-custom input.form-control:not(:placeholder-shown) {
                                        border-color: #4facfe;
                                        box-shadow: 0 0 0 4px rgba(79, 172, 254, 0.1);
                                    }

                                    .form-floating-custom input.form-control:focus + label,
                                    .form-floating-custom input.form-control:not(:placeholder-shown) + label {
                                        top: 0;
                                        font-size: 13px;
                                        color: #4facfe;
                                        font-weight: 600;
                                    }

                                    .btn-interactive {
                                        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
                                        color: white;
                                        border: none;
                                        border-radius: 12px;
                                        padding: 14px 30px;
                                        font-size: 16px;
                                        font-weight: 600;
                                        width: 100%;
                                        letter-spacing: 1px;
                                        transition: all 0.3s ease;
                                        box-shadow: 0 5px 15px rgba(79, 172, 254, 0.4);
                                    }

                                    .btn-interactive:hover {
                                        transform: translateY(-2px);
                                        box-shadow: 0 8px 20px rgba(79, 172, 254, 0.6);
                                        background: linear-gradient(135deg, #00f2fe 0%, #4facfe 100%);
                                        color: white;
                                    }

                                    .btn-interactive:active {
                                        transform: translateY(1px);
                                        box-shadow: 0 2px 10px rgba(79, 172, 254, 0.4);
                                    }

                                    .custom-control-label {
                                        cursor: pointer;
                                        padding-top: 2px;
                                    }
                                    
                                    .login-link {
                                        color: #4facfe;
                                        font-weight: 600;
                                        text-decoration: none;
                                        transition: color 0.3s ease;
                                    }
                                    
                                    .login-link:hover {
                                        color: #00f2fe;
                                        text-decoration: underline;
                                    }
                                    
                                    .back-home-btn {
                                        display: inline-block;
                                        padding: 10px 20px;
                                        border-radius: 30px;
                                        border: 2px solid #f0f0f0;
                                        color: #666;
                                        font-weight: 500;
                                        transition: all 0.3s ease;
                                        text-decoration: none;
                                        margin-top: 15px;
                                    }
                                    
                                    .back-home-btn:hover {
                                        background: #f8f9fa;
                                        color: #333;
                                        border-color: #ddd;
                                        text-decoration: none;
                                    }
                                </style>
                                <div class="card interactive-card">
                                    @if (session('error'))
                                        <div class="alert alert-danger">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                    <div class="card-header">
                                        <div class="text-center mb-3">
                                            <img src="{{ $logoUrl }}" alt="Logo" style="max-height: 60px;">
                                        </div>
                                        <h4 class="text-center">Registrasi Akun Baru</h4>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('register-peserta.store') }}" method="POST">
                                            @csrf
                                            <div class="form-floating-custom">
                                                <input type="text" class="form-control" id="name" name="name" placeholder=" " required>
                                                <label for="name">Nama Lengkap</label>
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            
                                            <div class="form-floating-custom">
                                                <input type="text" class="form-control" id="nik" name="nik" placeholder=" " required minlength="16" maxlength="16" pattern="\d{16}" title="NIK harus 16 digit angka" inputmode="numeric">
                                                <label for="nik">NIK (Nomor Induk Kependudukan)</label>
                                                @error('nik')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            
                                            <div class="form-floating-custom">
                                                <input type="password" class="form-control" id="password" name="password" placeholder=" " required>
                                                <label for="password">Password</label>
                                                @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            
                                            <div class="form-floating-custom">
                                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder=" " required>
                                                <label for="password_confirmation">Konfirmasi Password</label>
                                                @error('password_confirmation')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            
                                            <div class="custom-control custom-checkbox checkbox-secondary mb-4">
                                                <input type="checkbox" class="custom-control-input" id="customCheck3" name="terms" required>
                                                <label class="custom-control-label text-muted" for="customCheck3" style="font-size: 14px;">
                                                    Saya setuju dengan <a href="#" class="login-link">syarat dan ketentuan</a> yang berlaku
                                                </label>
                                            </div>
                                            
                                            <div class="form-group mb-4">
                                                <button class="btn btn-interactive" type="submit">Mendaftar Sekarang</button>
                                            </div>
                                            
                                            <div class="text-center mt-3">
                                                <p class="text-muted mb-2">Sudah punya akun? <a href="{{ route('login-peserta') }}" class="login-link">Login di sini</a></p>
                                                <a href="{{ route('home') }}" class="back-home-btn">
                                                    &larr; Kembali ke Beranda
                                                </a>
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
                const nikInput = document.getElementById('nik');
                if (nikInput) {
                    nikInput.addEventListener('input', function(e) {
                        this.value = this.value.replace(/[^0-9]/g, '');
                        if (this.value.length > 16) {
                            this.value = this.value.slice(0, 16);
                        }
                    });
                    nikInput.addEventListener('keypress', function(e) {
                        if (e.which < 48 || e.which > 57) {
                            e.preventDefault();
                        }
                    });
                }
            });
        </script>
    </body>
</html>
