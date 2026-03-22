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
                <div class="carousel-caption d-none d-md-block" style="background:rgba(0,0,0,.45);border-radius:10px;padding:20px 30px;">
                    <h2 style="font-size:2rem;font-weight:700;text-shadow:1px 1px 4px #000;">{{ $slider->caption ?? 'Selamat Datang di SPMB' }}</h2>
                    <p style="font-size:1.1rem;">Sistem Penerimaan Murid Baru Tahun Ajaran 2025/2026</p>
                    <a href="{{ route('register-peserta') }}" class="btn btn-primary btn-lg mt-2">Daftar Sekarang</a>
                </div>
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
            {{-- Walikota --}}
            <div class="col-lg-5 col-md-6 mb-4">
                <div style="background:#fff;border-radius:16px;box-shadow:0 4px 24px rgba(0,0,0,.08);padding:36px;text-align:center;height:100%;">
                    <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?w=200&h=200&fit=crop&q=80"
                         alt="Walikota" style="width:110px;height:110px;border-radius:50%;object-fit:cover;border:4px solid #e74c3c;margin-bottom:16px;">
                    <h5 style="font-weight:700;margin-bottom:4px;">H. Ahmad Fauzan, S.IP., M.M.</h5>
                    <p style="color:#e74c3c;font-size:.85rem;font-weight:600;margin-bottom:16px;">Walikota</p>
                    <p style="color:#555;font-size:.95rem;line-height:1.8;">
                        Dengan semangat membangun generasi unggul, saya menyambut baik pelaksanaan SPMB Tahun Ajaran 2025/2026.
                        Proses penerimaan yang transparan dan berkeadilan adalah komitmen kami demi masa depan anak-anak bangsa.
                    </p>
                    <p style="color:#888;font-size:.85rem;margin-top:12px;font-style:italic;">"Pendidikan adalah investasi terbaik untuk masa depan bangsa."</p>
                </div>
            </div>
            {{-- Kepala Dinas --}}
            <div class="col-lg-5 col-md-6 mb-4">
                <div style="background:#fff;border-radius:16px;box-shadow:0 4px 24px rgba(0,0,0,.08);padding:36px;text-align:center;height:100%;">
                    <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?w=200&h=200&fit=crop&q=80"
                         alt="Kepala Dinas" style="width:110px;height:110px;border-radius:50%;object-fit:cover;border:4px solid #3498db;margin-bottom:16px;">
                    <h5 style="font-weight:700;margin-bottom:4px;">Dr. Hj. Siti Rahmawati, M.Pd.</h5>
                    <p style="color:#3498db;font-size:.85rem;font-weight:600;margin-bottom:16px;">Kepala Dinas Pendidikan</p>
                    <p style="color:#555;font-size:.95rem;line-height:1.8;">
                        Dinas Pendidikan berkomitmen untuk memastikan setiap anak mendapatkan hak pendidikan yang layak.
                        SPMB tahun ini hadir dengan sistem yang lebih mudah, cepat, dan dapat diakses seluruh lapisan masyarakat.
                    </p>
                    <p style="color:#888;font-size:.85rem;margin-top:12px;font-style:italic;">"Sekolah terbaik adalah yang dekat dengan hati masyarakat."</p>
                </div>
            </div>
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
                        <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=600&q=80" alt="SD"
                             style="width:100%;height:200px;object-fit:cover;">
                        <div style="position:absolute;inset:0;background:linear-gradient(to bottom,rgba(39,174,96,.2),rgba(39,174,96,.85));"></div>
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
                                <span style="width:24px;height:24px;background:#27ae60;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                    <i class="la la-check" style="color:#fff;font-size:.9rem;"></i>
                                </span>
                                <span style="font-size:.9rem;color:#333;">{{ $jalur }}</span>
                            </li>
                            @endforeach
                        </ul>
                        <a href="{{ route('pendaftaran-sd') }}" class="btn btn-success btn-block"
                           style="border-radius:8px;font-weight:600;">Daftar Sekarang</a>
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
                        <a href="{{ route('pendaftaran-smp') }}" class="btn btn-primary btn-block"
                           style="border-radius:8px;font-weight:600;">Daftar Sekarang</a>
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
            @php
            $berita = [
                [
                    'img'   => 'https://images.unsplash.com/photo-1588072432836-e10032774350?w=600&q=80',
                    'title' => 'Pendaftaran SPMB 2025/2026 Resmi Dibuka',
                    'date'  => '15 Juni 2025',
                    'cat'   => 'Pengumuman',
                    'desc'  => 'Dinas Pendidikan resmi membuka pendaftaran penerimaan murid baru tahun ajaran 2025/2026 untuk jenjang SD dan SMP mulai tanggal 15 Juni 2025.',
                ],
                [
                    'img'   => 'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?w=600&q=80',
                    'title' => 'Kuota Jalur Afirmasi Ditingkatkan 25%',
                    'date'  => '10 Juni 2025',
                    'cat'   => 'Kebijakan',
                    'desc'  => 'Pemerintah daerah resmi meningkatkan kuota jalur afirmasi sebesar 25% untuk memastikan akses pendidikan bagi keluarga tidak mampu semakin luas.',
                ],
                [
                    'img'   => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?w=600&q=80',
                    'title' => 'Sosialisasi SPMB di Seluruh Kelurahan',
                    'date'  => '5 Juni 2025',
                    'cat'   => 'Kegiatan',
                    'desc'  => 'Dinas Pendidikan menggelar sosialisasi tata cara pendaftaran SPMB di seluruh kelurahan agar masyarakat dapat memahami prosedur pendaftaran dengan baik.',
                ],
            ];
            @endphp
            @foreach($berita as $b)
            <div class="col-lg-4 col-md-6 mb-4">
                <div style="background:#fff;border-radius:16px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,.07);height:100%;transition:transform .2s;" onmouseover="this.style.transform='translateY(-4px)'" onmouseout="this.style.transform='translateY(0)'">
                    <img src="{{ $b['img'] }}" alt="{{ $b['title'] }}" style="width:100%;height:200px;object-fit:cover;">
                    <div style="padding:20px;">
                        <div style="display:flex;align-items:center;gap:8px;margin-bottom:10px;">
                            <span style="background:#8e44ad;color:#fff;font-size:.75rem;padding:3px 10px;border-radius:20px;">{{ $b['cat'] }}</span>
                            <span style="color:#999;font-size:.8rem;"><i class="la la-calendar"></i> {{ $b['date'] }}</span>
                        </div>
                        <h6 style="font-weight:700;margin-bottom:10px;line-height:1.5;">{{ $b['title'] }}</h6>
                        <p style="color:#666;font-size:.9rem;line-height:1.7;margin-bottom:16px;">{{ $b['desc'] }}</p>
                        <a href="#" style="color:#8e44ad;font-size:.88rem;font-weight:600;">Baca Selengkapnya <i class="la la-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===================== JADWAL PENTING ===================== --}}
<section style="padding:80px 0;background:#1e2a4a;">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col">
                <span style="color:#f39c12;font-weight:600;text-transform:uppercase;letter-spacing:2px;font-size:.9rem;">Timeline</span>
                <h2 style="font-weight:700;margin-top:8px;color:#fff;">Jadwal Penting SPMB 2025/2026</h2>
                <div style="width:60px;height:4px;background:#f39c12;margin:12px auto 0;border-radius:2px;"></div>
            </div>
        </div>
        <div class="row justify-content-center">
            @php
            $jadwal = [
                ['icon'=>'la-edit',         'warna'=>'#3498db', 'kegiatan'=>'Pendaftaran Online',        'mulai'=>'15 Juni 2025',  'selesai'=>'30 Juni 2025'],
                ['icon'=>'la-file-text',    'warna'=>'#27ae60', 'kegiatan'=>'Verifikasi Berkas',         'mulai'=>'1 Juli 2025',   'selesai'=>'5 Juli 2025'],
                ['icon'=>'la-list-ol',      'warna'=>'#e74c3c', 'kegiatan'=>'Pengumuman Seleksi',        'mulai'=>'8 Juli 2025',   'selesai'=>'8 Juli 2025'],
                ['icon'=>'la-check-square', 'warna'=>'#f39c12', 'kegiatan'=>'Daftar Ulang',              'mulai'=>'9 Juli 2025',   'selesai'=>'14 Juli 2025'],
                ['icon'=>'la-graduation-cap','warna'=>'#9b59b6','kegiatan'=>'Hari Pertama Masuk Sekolah','mulai'=>'14 Juli 2025',  'selesai'=>'14 Juli 2025'],
            ];
            @endphp
            <div class="col-lg-10">
                @foreach($jadwal as $i => $j)
                <div style="display:flex;align-items:center;gap:20px;margin-bottom:{{ $loop->last ? '0' : '8px' }};">
                    {{-- Icon --}}
                    <div style="flex-shrink:0;width:52px;height:52px;border-radius:50%;background:{{ $j['warna'] }};display:flex;align-items:center;justify-content:center;box-shadow:0 0 0 4px rgba(255,255,255,.12);">
                        <i class="la {{ $j['icon'] }}" style="font-size:1.4rem;color:#fff;"></i>
                    </div>
                    {{-- Line connector --}}
                    <div style="flex:1;background:rgba(255,255,255,.1);border-radius:12px;padding:16px 22px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;">
                        <div>
                            <p style="margin:0;color:#fff;font-weight:600;font-size:.95rem;">{{ $j['kegiatan'] }}</p>
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
                @if(!$loop->last)
                <div style="width:52px;display:flex;justify-content:center;"><div style="width:2px;height:16px;background:rgba(255,255,255,.2);"></div></div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ===================== CTA REGISTRASI ===================== --}}
<section style="padding:80px 0;background:linear-gradient(135deg,#1abc9c 0%,#3498db 100%);">
    <div class="container text-center">
        <h2 style="color:#fff;font-weight:700;font-size:2.2rem;margin-bottom:14px;">Segera Daftarkan Putra-Putri Anda!</h2>
        <p style="color:rgba(255,255,255,.85);font-size:1.1rem;max-width:560px;margin:0 auto 32px;">
            Jangan lewatkan kesempatan mendaftar ke sekolah favorit. Pendaftaran dibuka hingga <strong style="color:#fff;">30 Juni 2025</strong>.
        </p>
        <div style="display:flex;justify-content:center;gap:16px;flex-wrap:wrap;">
            <a href="{{ route('register-peserta') }}"
               style="background:#fff;color:#1abc9c;padding:14px 36px;border-radius:50px;font-weight:700;font-size:1rem;text-decoration:none;box-shadow:0 6px 20px rgba(0,0,0,.2);transition:transform .2s;"
               onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                <i class="la la-pencil-square"></i> Segera Daftar
            </a>
            <a href="{{ route('juknis') }}"
               style="background:transparent;color:#fff;padding:14px 36px;border-radius:50px;font-weight:700;font-size:1rem;text-decoration:none;border:2px solid rgba(255,255,255,.7);transition:transform .2s;"
               onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                <i class="la la-book"></i> Petunjuk Teknis
            </a>
        </div>
        <div style="margin-top:36px;display:flex;justify-content:center;gap:40px;flex-wrap:wrap;">
            @foreach([['la-users','2.400+','Pendaftar Tahun Lalu'],['la-school','120','Sekolah Mitra'],['la-map-marker','15','Kecamatan']] as $s)
            <div style="text-align:center;">
                <i class="la {{ $s[0] }}" style="font-size:2rem;color:rgba(255,255,255,.8);"></i>
                <p style="color:#fff;font-size:1.8rem;font-weight:700;margin:4px 0 2px;">{{ $s[1] }}</p>
                <p style="color:rgba(255,255,255,.75);font-size:.85rem;margin:0;">{{ $s[2] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
