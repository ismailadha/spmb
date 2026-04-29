@extends('frontend.main')

@section('content')

<!-- Hero Area / Breadcrumb -->
<section class="breadcrumb_area breadcrumb2 bgimage" style="background-image: url('https://images.unsplash.com/photo-1510531704581-5b2870972060?auto=format&fit=crop&w=1920&q=80'); background-size: cover; padding: 120px 0; background-position: center; position: relative; overflow: hidden;">
    <div class="overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(to right, rgba(30, 42, 74, 0.8), rgba(52, 152, 219, 0.4));"></div>
    <div class="container text-center position-relative" style="z-index: 2;">
        <h1 class="text-white font-weight-bold display-4 mb-2 animate__animated animate__fadeInDown">Hubungi Kami</h1>
        <p class="text-white-50 lead animate__animated animate__fadeInUp">Layanan bantuan dan informasi seputar pendaftaran siswa baru</p>
    </div>
</section>

<!-- Contact Area -->
<section class="contact_area section-padding" style="padding: 80px 0; background-color: #f8f9fa;">
    <div class="container">

        <div class="row">
            <!-- Office Contact Info -->
            <div class="col-lg-4 mb-4">
                <div class="contact_info h-100" style="background: #fff; padding: 35px 30px; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); position: relative; overflow: hidden; border-top: 4px solid #3498db;">
                    <h4 style="font-size: 1.3rem; font-weight: 700; color: #1e2a4a; margin-bottom: 25px;">Informasi</h4>
                    
                    <div class="info_item d-flex align-items-start mb-4">
                        <div class="icon" style="width: 40px; height: 40px; background: rgba(52, 152, 219, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px; flex-shrink: 0;">
                            <i class="la la-map-marker" style="font-size: 1.3rem; color: #3498db;"></i>
                        </div>
                        <div class="content">
                            <h6 style="font-size: 0.95rem; font-weight: 700; color: #1e2a4a; margin-bottom: 5px;">Alamat</h6>
                            <p style="color: #666; font-size: 0.9rem; line-height: 1.5; margin: 0;">
                                <strong>{{ $appConfig['nama_instansi'] ?? 'Dinas Pendidikan' }}</strong><br>
                                {!! nl2br(e($appConfig['alamat'] ?? 'Alamat belum diatur')) !!}
                            </p>
                        </div>
                    </div>
 
                    <div class="info_item d-flex align-items-start mb-4">
                        <div class="icon" style="width: 40px; height: 40px; background: rgba(26, 188, 156, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px; flex-shrink: 0;">
                            <i class="la la-phone" style="font-size: 1.3rem; color: #1abc9c;"></i>
                        </div>
                        <div class="content">
                            <h6 style="font-size: 0.95rem; font-weight: 700; color: #1e2a4a; margin-bottom: 5px;">Telepon</h6>
                            <p style="color: #666; font-size: 0.9rem; margin: 0;">{{ $appConfig['telepon'] ?? 'Belum diatur' }}</p>
                        </div>
                    </div>
 
                    <div class="info_item d-flex align-items-start">
                        <div class="icon" style="width: 40px; height: 40px; background: rgba(231, 76, 60, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px; flex-shrink: 0;">
                            <i class="la la-envelope" style="font-size: 1.3rem; color: #e74c3c;"></i>
                        </div>
                        <div class="content">
                            <h6 style="font-size: 0.95rem; font-weight: 700; color: #1e2a4a; margin-bottom: 5px;">Email</h6>
                            <p style="color: #666; font-size: 0.9rem; margin: 0;">
                                <a href="mailto:{{ $appConfig['email_resmi'] ?? '' }}" style="color: #666; text-decoration: none;">{{ $appConfig['email_resmi'] ?? 'Belum diatur' }}</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SD Coordinator Info -->
            <div class="col-lg-4 mb-4">
                <div class="contact_info h-100" style="background: #fff; padding: 35px 30px; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); position: relative; overflow: hidden; border-top: 4px solid #f39c12;">
                    <div class="d-flex align-items-center mb-4">
                        <div style="width: 32px; height: 32px; background: #3498db; color: #fff; border-radius: 6px; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; font-weight: 800; margin-right: 12px;">SD</div>
                        <h4 style="font-size: 1.3rem; font-weight: 700; color: #1e2a4a; margin: 0;">Koordinator SD</h4>
                    </div>

                    <div class="info_item d-flex align-items-start mb-4">
                        <div class="icon" style="width: 40px; height: 40px; background: rgba(52, 152, 219, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px; flex-shrink: 0;">
                            <i class="la la-user" style="font-size: 1.3rem; color: #3498db;"></i>
                        </div>
                        <div class="content">
                            <h6 style="font-size: 0.95rem; font-weight: 700; color: #1e2a4a; margin-bottom: 5px;">Nama Koordinator</h6>
                            <p style="color: #666; font-size: 0.9rem; margin: 0;">{{ $appConfig['nama_kor_sd'] ?? 'Belum diatur' }}</p>
                        </div>
                    </div>

                    @if(!empty($appConfig['email_kor_sd']))
                    <div class="info_item d-flex align-items-start mb-4">
                        <div class="icon" style="width: 40px; height: 40px; background: rgba(231, 76, 60, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px; flex-shrink: 0;">
                            <i class="la la-envelope" style="font-size: 1.3rem; color: #e74c3c;"></i>
                        </div>
                        <div class="content">
                            <h6 style="font-size: 0.95rem; font-weight: 700; color: #1e2a4a; margin-bottom: 5px;">Email</h6>
                            <p style="color: #666; font-size: 0.9rem; margin: 0;">{{ $appConfig['email_kor_sd'] }}</p>
                        </div>
                    </div>
                    @endif

                    @if(!empty($appConfig['hp_kor_sd']))
                    <div class="info_item d-flex align-items-start">
                        <div class="icon" style="width: 40px; height: 40px; background: rgba(37, 211, 102, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px; flex-shrink: 0;">
                            <i class="la la-phone" style="font-size: 1.3rem; color: #25D366;"></i>
                        </div>
                        <div class="content">
                            <h6 style="font-size: 0.95rem; font-weight: 700; color: #1e2a4a; margin-bottom: 5px;">Telepon</h6>
                            <p style="color: #666; font-size: 0.9rem; margin: 0;">
                                {{ $appConfig['hp_kor_sd'] }}
                            </p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- SMP Coordinator Info -->
            <div class="col-lg-4 mb-4">
                <div class="contact_info h-100" style="background: #fff; padding: 35px 30px; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); position: relative; overflow: hidden; border-top: 4px solid #e74c3c;">
                    <div class="d-flex align-items-center mb-4">
                        <div style="width: 32px; height: 32px; background: #e74c3c; color: #fff; border-radius: 6px; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; font-weight: 800; margin-right: 12px;">SMP</div>
                        <h4 style="font-size: 1.3rem; font-weight: 700; color: #1e2a4a; margin: 0;">Koordinator SMP</h4>
                    </div>

                    <div class="info_item d-flex align-items-start mb-4">
                        <div class="icon" style="width: 40px; height: 40px; background: rgba(52, 152, 219, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px; flex-shrink: 0;">
                            <i class="la la-user" style="font-size: 1.3rem; color: #3498db;"></i>
                        </div>
                        <div class="content">
                            <h6 style="font-size: 0.95rem; font-weight: 700; color: #1e2a4a; margin-bottom: 5px;">Nama Koordinator</h6>
                            <p style="color: #666; font-size: 0.9rem; margin: 0;">{{ $appConfig['nama_kor_smp'] ?? 'Belum diatur' }}</p>
                        </div>
                    </div>

                    @if(!empty($appConfig['email_kor_smp']))
                    <div class="info_item d-flex align-items-start mb-4">
                        <div class="icon" style="width: 40px; height: 40px; background: rgba(231, 76, 60, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px; flex-shrink: 0;">
                            <i class="la la-envelope" style="font-size: 1.3rem; color: #e74c3c;"></i>
                        </div>
                        <div class="content">
                            <h6 style="font-size: 0.95rem; font-weight: 700; color: #1e2a4a; margin-bottom: 5px;">Email</h6>
                            <p style="color: #666; font-size: 0.9rem; margin: 0;">{{ $appConfig['email_kor_smp'] }}</p>
                        </div>
                    </div>
                    @endif

                    @if(!empty($appConfig['hp_kor_smp']))
                    <div class="info_item d-flex align-items-start">
                        <div class="icon" style="width: 40px; height: 40px; background: rgba(37, 211, 102, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px; flex-shrink: 0;">
                            <i class="la la-phone" style="font-size: 1.3rem; color: #25D366;"></i>
                        </div>
                        <div class="content">
                            <h6 style="font-size: 0.95rem; font-weight: 700; color: #1e2a4a; margin-bottom: 5px;">Telepon</h6>
                            <p style="color: #666; font-size: 0.9rem; margin: 0;">
                                {{ $appConfig['hp_kor_smp'] }}
                            </p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
