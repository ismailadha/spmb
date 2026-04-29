@extends('frontend.main')

@section('content')
<!-- Hero Area / Breadcrumb -->
<section class="breadcrumb_area breadcrumb2 bgimage" style="background-image: url('https://images.unsplash.com/photo-1510531704581-5b2870972060?auto=format&fit=crop&w=1920&q=80'); background-size: cover; padding: 120px 0; background-position: center; position: relative; overflow: hidden;">
    <div class="overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(to right, rgba(30, 42, 74, 0.8), rgba(142, 68, 173, 0.4));"></div>
    <div class="container text-center position-relative" style="z-index: 2;">
        <h1 class="text-white font-weight-bold display-4 mb-2 animate__animated animate__fadeInDown">Berita & Informasi</h1>
        <p class="text-white-50 lead animate__animated animate__fadeInUp">Dapatkan informasi terbaru seputar Penerimaan Peserta Didik Baru (PPDB)</p>
    </div>
</section>

{{-- ===================== BERITA LIST ===================== --}}
<section style="padding:80px 0;background:#f8f9fd;">
    <div class="container">
        <div class="row">
            @forelse($posts as $post)
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
                        <h6 style="font-weight:700;margin-bottom:10px;line-height:1.5;min-height:45px;">{{ $post->title }}</h6>
                        <p style="color:#666;font-size:.9rem;line-height:1.7;margin-bottom:16px;">{{ \Illuminate\Support\Str::limit(strip_tags($post->content), 100) }}</p>
                        <a href="{{ route('post.detail', $post->slug) }}" style="color:#8e44ad;font-size:.88rem;font-weight:600;">Baca Selengkapnya <i class="la la-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <div style="padding:50px;background:#fff;border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,.05);">
                    <i class="la la-info-circle" style="font-size:4rem;color:#ccc;margin-bottom:20px;"></i>
                    <h4 style="color:#666;">Belum ada berita saat ini.</h4>
                    <p style="color:#999;">Silakan cek kembali di lain waktu.</p>
                    <a href="{{ route('home') }}" class="btn btn-primary mt-3" style="border-radius:30px;padding:10px 30px;">Kembali ke Beranda</a>
                </div>
            </div>
            @endforelse
        </div>

        <div class="row mt-5">
            <div class="col-12 d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</section>
@endsection
