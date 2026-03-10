<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Registrasi Akun Peserta</title>
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
                            <div class="col-lg-6 offset-lg-3">
                                <div class="form-wrapper">
                                    <div class="card card-shadow">
                                        <div class="card-header">
                                            <h4 class="text-center">Registrasi Akun</h4>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ route('register-peserta.store') }}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <input type="text" placeholder="Nama" class="form-control" name="name">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" placeholder="NIK" class="form-control" name="username">
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" placeholder="Password" class="form-control" name="password">
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation">
                                                </div>
                                                <div class="custom-control custom-checkbox checkbox-secondary">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck3" name="terms" required>
                                                    <label class="custom-control-label" for="customCheck3">Saya setuju dengan syarat dan ketentuan yang berlaku</label>
                                                </div>
                                                <div class="form-group text-center m-top-30 m-bottom-20">
                                                    <button class="btn btn-secondary" type="submit">Buat Akun</button>
                                                </div>
                                                {{-- Sudah punya akun? --}}
                                                <div class="form-group text-center">
                                                    <p>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>
                                                </div>
                                                {{-- link kembali ke halaman utama --}}
                                                <div class="form-group text-center">
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
    </body>
</html>
