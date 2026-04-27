@extends('frontend.main')

@section('content')

{{-- ===================== HERO SLIDER ===================== --}}
<div id="hero-slider" class="carousel slide" data-ride="carousel" data-interval="5000" style="margin-top:0;">
    <ol class="carousel-indicators">
        @foreach($sliders as $key => $slider)
            <li data-target="#hero-slider" data-slide-to="{{ $key }}" class="{{ $loop->first ? 'active' : '' }}"></li>
        @endforeach
    </ol>
    <div class="carousel-inner">
        @foreach($sliders as $key => $slider)
            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                <img src="{{ asset($slider->gambar) }}" class="d-block w-100" alt="Slider {{ $key + 1 }}" style="height:520px;object-fit:cover;">
            </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#hero-slider" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#hero-slider" role="button" data-slide="next">
        <span class="carousel-control-next-icon"></span>
    </a>
</div>

{{-- ===================== SAMBUTAN ===================== --}}
<section style="padding:80px 0;background:#f8f9fd;">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col">
                <span style="color:#e74c3c;font-weight:600;text-transform:uppercase;letter-spacing:2px;font-size:.9rem;">Sambutan</span>
                <h2 style="font-weight:700;margin-top:8px;">Kata Sambutan Pimpinan</h2>
                <div style="width:60px;height:4px;background:#e74c3c;margin:12px auto 0;border-radius:2px;"></div>
            </div>
        </div>
        <div class="row justify-content-center">
            @foreach($sambutans as $key => $sambutan)
            <div class="col-lg-5 col-md-6 mb-4">
                <div style="background:#fff;border-radius:16px;box-shadow:0 4px 24px rgba(0,0,0,.08);padding:36px;text-align:center;height:100%;">
                    <img src="{{ $sambutan->foto ?? 'https://ui-avatars.com/api/?name='.urlencode($sambutan->nama_pejabat).'&background=random' }}"
                         alt="{{ $sambutan->nama_pejabat }}" style="width:110px;height:110px;border-radius:50%;object-fit:cover;border:4px solid {{ $loop->index % 2 == 0 ? '#e74c3c' : '#3498db' }};margin-bottom:16px;">
                    <h5 style="font-weight:700;margin-bottom:4px;">{{ $sambutan->nama_pejabat }}</h5>
                    <p style="color:{{ $loop->index % 2 == 0 ? '#e74c3c' : '#3498db' }};font-size:.85rem;font-weight:600;margin-bottom:16px;">{{ $sambutan->jabatan }}</p>
                    <p style="color:#555;font-size:.95rem;line-height:1.8;">
                        {!! $sambutan->isi_sambutan !!}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===================== JENJANG & JALUR ===================== --}}
<section style="padding:80px 0;background:#fff;">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col">
                <span style="color:#27ae60;font-weight:600;text-transform:uppercase;letter-spacing:2px;font-size:.9rem;">Pendaftaran</span>
                <h2 style="font-weight:700;margin-top:8px;">Jenjang &amp; Jalur Seleksi</h2>
                <div style="width:60px;height:4px;background:#27ae60;margin:12px auto 0;border-radius:2px;"></div>
            </div>
        </div>
        <div class="row justify-content-center">
            {{-- SD --}}
            <div class="col-lg-5 col-md-6 mb-4">
                <div style="border-radius:16px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,.10);">
                    <div style="position:relative;">
                        <img src="{{ asset('images/sekolah-sd.jpg') }}" alt="SD"
                             style="width:100%;height:200px;object-fit:cover;">
                        <div style="position:absolute;inset:0;background:linear-gradient(to bottom,rgba(231,76,60,.2),rgba(231,76,60,.85));"></div>
                        <div style="position:absolute;bottom:16px;left:50%;transform:translateX(-50%);text-align:center;">
                            <i class="la la-graduation-cap" style="font-size:2.5rem;color:#fff;"></i>
                            <h4 style="color:#fff;font-weight:700;margin:4px 0 0;">Sekolah Dasar (SD)</h4>
                        </div>
                    </div>
                    <div style="padding:24px;background:#f8f9fd;">
                        <p style="font-size:.9rem;color:#666;margin-bottom:16px;">Jalur penerimaan peserta didik baru jenjang SD:</p>
                        <ul style="list-style:none;padding:0;margin:0 0 20px;">
                            @foreach(['Jalur Domisili / Zonasi','Jalur Afirmasi','Jalur Mutasi Orang Tua'] as $jalur)
                            <li style="padding:8px 0;border-bottom:1px solid #eee;display:flex;align-items:center;gap:10px;">
                                <span style="width:24px;height:24px;background:#e74c3c;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                    <i class="la la-check" style="color:#fff;font-size:.9rem;"></i>
                                </span>
                                <span style="font-size:.9rem;color:#333;">{{ $jalur }}</span>
                            </li>
                            @endforeach
                        </ul>
                        @if($activePeriode)
                            <a href="{{ route('register-peserta') }}" class="btn btn-danger btn-block"
                               style="border-radius:8px;font-weight:600;background:#e74c3c;border-color:#e74c3c;">Daftar Sekarang</a>
                        @endif
                    </div>
                </div>
            </div>
            {{-- SMP --}}
            <div class="col-lg-5 col-md-6 mb-4">
                <div style="border-radius:16px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,.10);">
                    <div style="position:relative;">
                        <img src="https://images.unsplash.com/photo-1546410531-bb4caa6b424d?w=600&q=80" alt="SMP"
                             style="width:100%;height:200px;object-fit:cover;">
                        <div style="position:absolute;inset:0;background:linear-gradient(to bottom,rgba(52,152,219,.2),rgba(52,152,219,.85));"></div>
                        <div style="position:absolute;bottom:16px;left:50%;transform:translateX(-50%);text-align:center;">
                            <i class="la la-graduation-cap" style="font-size:2.5rem;color:#fff;"></i>
                            <h4 style="color:#fff;font-weight:700;margin:4px 0 0;">Sekolah Menengah Pertama (SMP)</h4>
                        </div>
                    </div>
                    <div style="padding:24px;background:#f8f9fd;">
                        <p style="font-size:.9rem;color:#666;margin-bottom:16px;">Jalur penerimaan peserta didik baru jenjang SMP:</p>
                        <ul style="list-style:none;padding:0;margin:0 0 20px;">
                            @foreach(['Jalur Domisili / Zonasi','Jalur Afirmasi','Jalur Mutasi Orang Tua','Jalur Prestasi'] as $jalur)
                            <li style="padding:8px 0;border-bottom:1px solid #eee;display:flex;align-items:center;gap:10px;">
                                <span style="width:24px;height:24px;background:#3498db;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                    <i class="la la-check" style="color:#fff;font-size:.9rem;"></i>
                                </span>
                                <span style="font-size:.9rem;color:#333;">{{ $jalur }}</span>
                            </li>
                            @endforeach
                        </ul>
                        @if($activePeriode)
                            <a href="{{ route('register-peserta') }}" class="btn btn-primary btn-block"
                               style="border-radius:8px;font-weight:600;">Daftar Sekarang</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===================== BERITA TERKINI ===================== --}}
<section style="padding:80px 0;background:#f8f9fd;">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col">
                <span style="color:#8e44ad;font-weight:600;text-transform:uppercase;letter-spacing:2px;font-size:.9rem;">Informasi</span>
                <h2 style="font-weight:700;margin-top:8px;">Berita Terkini</h2>
                <div style="width:60px;height:4px;background:#8e44ad;margin:12px auto 0;border-radius:2px;"></div>
            </div>
        </div>
        <div class="row">
            @foreach($posts as $post)
            <div class="col-lg-4 col-md-6 mb-4">
                <div style="background:#fff;border-radius:16px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,.07);height:100%;transition:transform .2s;" onmouseover="this.style.transform='translateY(-4px)'" onmouseout="this.style.transform='translateY(0)'">
                    <a href="{{ route('post.detail', $post->slug) }}">
                        <img src="{{ $post->thumbnail ?? 'https://images.unsplash.com/photo-1588072432836-e10032774350?w=600&q=80' }}" alt="{{ $post->title }}" style="width:100%;height:200px;object-fit:cover;">
                    </a>
                    <div style="padding:20px;">
                        <div style="display:flex;align-items:center;gap:8px;margin-bottom:10px;">
                            <span style="background:#8e44ad;color:#fff;font-size:.75rem;padding:3px 10px;border-radius:20px;">Informasi</span>
                            <span style="color:#999;font-size:.8rem;"><i class="la la-calendar"></i> {{ \Carbon\Carbon::parse($post->tanggal)->format('d M Y') }}</span>
                        </div>
                        <h6 style="font-weight:700;margin-bottom:10px;line-height:1.5;">{{ $post->title }}</h6>
                        <p style="color:#666;font-size:.9rem;line-height:1.7;margin-bottom:16px;">{{ \Illuminate\Support\Str::limit(strip_tags($post->content), 100) }}</p>
                        <a href="{{ route('post.detail', $post->slug) }}" style="color:#8e44ad;font-size:.88rem;font-weight:600;">Baca Selengkapnya <i class="la la-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row mt-4">
            <div class="col-12 text-center">
                <a href="{{ route('post.index') }}" 
                   style="display:inline-block;padding:12px 35px;background:#fff;color:#8e44ad;border:2px solid #8e44ad;border-radius:50px;font-weight:700;text-decoration:none;transition:all 0.3s;"
                   onmouseover="this.style.background='#8e44ad';this.style.color='#fff';" 
                   onmouseout="this.style.background='#fff';this.style.color='#8e44ad';">
                    Semua Berita <i class="la la-angle-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>

@php
    $jadwalPenting = $activePeriode ? $activePeriode->getFormattedSchedule() : [];
@endphp

@if(count($jadwalPenting) > 0)
{{-- ===================== JADWAL PENTING ===================== --}}
<section style="padding:80px 0;background:#1e2a4a;">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col">
                <span style="color:#f39c12;font-weight:600;text-transform:uppercase;letter-spacing:2px;font-size:.9rem;">Timeline</span>
                <h2 style="font-weight:700;margin-top:8px;color:#fff;">Jadwal Penting SPMB {{ $activePeriode->tahun_ajaran ?? date('Y') . '/' . (date('Y') + 1) }}</h2>
                <div style="width:60px;height:4px;background:#f39c12;margin:12px auto 0;border-radius:2px;"></div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                @foreach($jadwalPenting as $i => $j)
                <div style="margin-bottom:{{ $loop->last ? '0' : '20px' }};">
                    <div style="display:flex;align-items:center;gap:20px;margin-bottom:12px;">
                        {{-- Icon --}}
                        <div style="flex-shrink:0;width:52px;height:52px;border-radius:50%;background:{{ $j['warna'] }};display:flex;align-items:center;justify-content:center;box-shadow:0 0 0 4px rgba(255,255,255,.12);">
                            <i class="la {{ $j['icon'] }}" style="font-size:1.4rem;color:#fff;"></i>
                        </div>
                        {{-- Line connector --}}
                        <div style="flex:1;background:rgba(255,255,255,.1);border-radius:12px;padding:16px 22px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;">
                            <div>
                                <p style="margin:0;color:#fff;font-weight:700;font-size:1rem;">{{ $j['kegiatan'] }}</p>
                            </div>
                            <div style="text-align:right;">
                                @if($j['mulai'] === $j['selesai'])
                                    <span style="background:{{ $j['warna'] }};color:#fff;padding:4px 14px;border-radius:20px;font-size:.82rem;font-weight:600;">{{ $j['mulai'] }}</span>
                                @else
                                    <span style="background:{{ $j['warna'] }};color:#fff;padding:4px 14px;border-radius:20px;font-size:.82rem;font-weight:600;">{{ $j['mulai'] }} — {{ $j['selesai'] }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Sub Items (Pathway Specific) --}}
                    @if(count($j['sub_items']) > 0)
                    <div style="margin-left:72px;padding-left:20px;border-left:2px dashed rgba(255,255,255,0.2);margin-top:-10px;margin-bottom:20px;">
                        @foreach($j['sub_items'] as $sub)
                        <div style="display:flex;justify-content:space-between;align-items:center;padding:8px 0;border-bottom:1px solid rgba(255,255,255,0.05);">
                            <div style="display:flex;align-items:center;gap:10px;">
                                <i class="la la-check-circle" style="color:#2ecc71;font-size:1.1rem;"></i>
                                <span style="color:rgba(255,255,255,0.8);font-size:.88rem;font-weight:500;">{{ $sub['nama'] }}</span>
                            </div>
                            <span style="color:rgba(255,255,255,0.6);font-size:.82rem;">{{ $sub['mulai'] }} — {{ $sub['selesai'] }}</span>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif


{{-- ===================== CTA REGISTRASI ===================== --}}
<section style="padding:80px 0;background:linear-gradient(135deg,#1abc9c 0%,#3498db 100%);">
    <div class="container text-center">
        <h2 style="color:#fff;font-weight:700;font-size:2.2rem;margin-bottom:14px;">Segera Daftarkan Putra-Putri Anda!</h2>
        <p style="color:rgba(255,255,255,.85);font-size:1.1rem;max-width:560px;margin:0 auto 32px;">
            Jangan lewatkan kesempatan mendaftar ke sekolah favorit. Pendaftaran dibuka hingga <strong style="color:#fff;">{{ $activePeriode ? \Carbon\Carbon::parse($activePeriode->peserta_daftar_selesai)->translatedFormat('d F Y') : '-' }}</strong>.
        </p>
        <div style="display:flex;justify-content:center;gap:16px;flex-wrap:wrap;">
            @if($activePeriode)
                <a href="{{ route('register-peserta') }}"
                   style="background:#fff;color:#1abc9c;padding:14px 36px;border-radius:50px;font-weight:700;font-size:1rem;text-decoration:none;box-shadow:0 6px 20px rgba(0,0,0,.2);transition:transform .2s;"
                   onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                    <i class="la la-pencil-square"></i> Segera Daftar
                </a>
            @endif
            <a href="{{ route('juknis') }}"
               style="background:transparent;color:#fff;padding:14px 36px;border-radius:50px;font-weight:700;font-size:1rem;text-decoration:none;border:2px solid rgba(255,255,255,.7);transition:transform .2s;"
               onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                <i class="la la-book"></i> Petunjuk Teknis
            </a>
        </div>
        <div style="margin-top:48px;">
            {{-- Baris 1: Statistik Jalur (4 Kolom) --}}
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:24px;margin-bottom:48px;">
                @foreach($stats['jalur'] as $j)
                <div style="background:rgba(255,255,255,0.08);backdrop-filter:blur(8px);border:1px solid rgba(255,255,255,0.15);border-radius:20px;padding:24px;text-align:center;transition:all 0.3s ease-in-out;box-shadow:0 10px 30px rgba(0,0,0,0.1);" 
                     onmouseover="this.style.transform='translateY(-8px)';this.style.background='rgba(255,255,255,0.12)';" 
                     onmouseout="this.style.transform='translateY(0)';this.style.background='rgba(255,255,255,0.08)';">
                    <div style="width:56px;height:56px;background:linear-gradient(135deg,rgba(255,255,255,0.3),rgba(255,255,255,0.1));border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;box-shadow:0 4px 15px rgba(0,0,0,0.1);">
                        <i class="la {{ $j['icon'] }}" style="font-size:2rem;color:#fff;"></i>
                    </div>
                    <h5 style="color:#fff;font-weight:700;margin-bottom:16px;font-size:1.15rem;letter-spacing:0.5px;">{{ $j['nama'] }}</h5>
                    <div style="display:flex;justify-content:center;gap:20px;border-top:1px solid rgba(255,255,255,0.1);padding-top:16px;">
                        <div>
                            <span style="display:block;color:rgba(255,255,255,0.65);font-size:0.75rem;font-weight:700;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;">SD</span>
                            <span style="color:#fff;font-weight:800;font-size:1.2rem;">{{ number_format($j['sd'], 0, ',', '.') }}</span>
                        </div>
                        <div style="width:1px;background:rgba(255,255,255,0.2);height:30px;align-self:center;"></div>
                        <div>
                            <span style="display:block;color:rgba(255,255,255,0.65);font-size:0.75rem;font-weight:700;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;">SMP</span>
                            <span style="color:#fff;font-weight:800;font-size:1.2rem;">{{ number_format($j['smp'], 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Baris 2: Statistik Umum (Pendaftar, Sekolah & Kecamatan) --}}
            <div style="display:flex;justify-content:center;gap:60px 80px;flex-wrap:wrap;border-top:1px solid rgba(255,255,255,0.2);padding-top:40px;margin-top:20px;">
                <div style="text-align:center;min-width:180px;">
                    <div style="display:inline-flex;align-items:center;justify-content:center;width:64px;height:64px;background:rgba(255,255,255,0.15);border-radius:50%;margin-bottom:12px;">
                        <i class="la la-users" style="font-size:2.2rem;color:#fff;"></i>
                    </div>
                    <p style="color:#fff;font-size:2.8rem;font-weight:800;margin:0;line-height:1;">{{ number_format($stats['total_pendaftar'], 0, ',', '.') }}</p>
                    <p style="color:rgba(255,255,255,0.85);font-size:1.1rem;font-weight:700;margin-top:8px;text-transform:uppercase;letter-spacing:1px;">Peserta Terdaftar</p>
                </div>
                <div style="text-align:center;min-width:180px;">
                    <div style="display:inline-flex;align-items:center;justify-content:center;width:64px;height:64px;background:rgba(255,255,255,0.15);border-radius:50%;margin-bottom:12px;">
                        <i class="la la-school" style="font-size:2.2rem;color:#fff;"></i>
                    </div>
                    <p style="color:#fff;font-size:2.8rem;font-weight:800;margin:0;line-height:1;">{{ number_format($stats['total_sekolah'], 0, ',', '.') }}</p>
                    <p style="color:rgba(255,255,255,0.85);font-size:1.1rem;font-weight:700;margin-top:8px;text-transform:uppercase;letter-spacing:1px;">Sekolah</p>
                </div>
                <div style="text-align:center;min-width:180px;">
                    <div style="display:inline-flex;align-items:center;justify-content:center;width:64px;height:64px;background:rgba(255,255,255,0.15);border-radius:50%;margin-bottom:12px;">
                        <i class="la la-map-pin" style="font-size:2.2rem;color:#fff;"></i>
                    </div>
                    <p style="color:#fff;font-size:2.8rem;font-weight:800;margin:0;line-height:1;">{{ number_format($stats['total_kecamatan'], 0, ',', '.') }}</p>
                    <p style="color:rgba(255,255,255,0.85);font-size:1.1rem;font-weight:700;margin-top:8px;text-transform:uppercase;letter-spacing:1px;">Kecamatan</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
