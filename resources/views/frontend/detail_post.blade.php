@extends('frontend.main')

@section('content')
<section style="background:#f8f9fd; padding:40px 0 80px;">
    <div class="container">
        {{-- Breadcrumb (Optional but good) --}}
        <div class="row mb-4">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb" style="background:transparent; padding:0; margin:0;">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color:#3498db; text-decoration:none;"><i class="la la-home"></i> Beranda</a></li>
                        <li class="breadcrumb-item active" aria-current="page" style="color:#666;">Detail Berita</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            {{-- Main Content --}}
            <div class="col-lg-8 mb-5 mb-lg-0">
                <div style="background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 4px 24px rgba(0,0,0,.08);">
                    <img src="{{ $post->thumbnail ?? 'https://images.unsplash.com/photo-1588072432836-e10032774350?w=1200&q=80' }}" alt="{{ $post->title }}" style="width:100%; height:400px; object-fit:cover;">
                    <div style="padding:40px;">
                        <div style="display:flex; align-items:center; gap:16px; margin-bottom:20px; flex-wrap:wrap;">
                            <span style="background:#8e44ad; color:#fff; font-size:.85rem; padding:4px 12px; border-radius:20px; font-weight:600;"><i class="la la-tag"></i> Informasi</span>
                            <span style="color:#777; font-size:.9rem;"><i class="la la-calendar"></i> {{ \Carbon\Carbon::parse($post->tanggal)->format('d F Y') }}</span>
                            <span style="color:#777; font-size:.9rem;"><i class="la la-user"></i> {{ $post->user_name ?? 'Admin' }}</span>
                        </div>
                        <h1 style="font-weight:700; margin-bottom:24px; font-size:2rem; color:#2c3e50; line-height:1.4;">{{ $post->title }}</h1>
                        
                        {{-- Post Content --}}
                        <div class="post-content" style="color:#555; font-size:1.05rem; line-height:1.8;">
                            {!! $post->content !!}
                        </div>
                        
                        <div style="margin-top:40px; padding-top:24px; border-top:1px solid #eee; display:flex; justify-content:space-between; align-items:center;">
                            <h6 style="margin:0; font-weight:600; color:#444;">Bagikan Berita:</h6>
                            <div style="display:flex; gap:10px;">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::fullUrl()) }}" target="_blank" style="width:36px; height:36px; background:#3b5998; color:#fff; border-radius:50%; display:flex; align-items:center; justify-content:center; text-decoration:none; transition:opacity .2s;" onmouseover="this.style.opacity='.8'" onmouseout="this.style.opacity='1'"><i class="la la-facebook"></i></a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(Request::fullUrl()) }}&text={{ urlencode($post->title) }}" target="_blank" style="width:36px; height:36px; background:#1da1f2; color:#fff; border-radius:50%; display:flex; align-items:center; justify-content:center; text-decoration:none; transition:opacity .2s;" onmouseover="this.style.opacity='.8'" onmouseout="this.style.opacity='1'"><i class="la la-twitter"></i></a>
                                <a href="https://api.whatsapp.com/send?text={{ urlencode($post->title . ' ' . Request::fullUrl()) }}" target="_blank" style="width:36px; height:36px; background:#25d366; color:#fff; border-radius:50%; display:flex; align-items:center; justify-content:center; text-decoration:none; transition:opacity .2s;" onmouseover="this.style.opacity='.8'" onmouseout="this.style.opacity='1'"><i class="la la-whatsapp"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                <div style="background:#fff; border-radius:16px; padding:30px; box-shadow:0 4px 24px rgba(0,0,0,.08); position:sticky; top:20px;">
                    <h5 style="font-weight:700; margin-bottom:24px; color:#2c3e50; border-bottom:2px solid #3498db; display:inline-block; padding-bottom:8px;">Berita Terbaru</h5>
                    
                    <div style="display:flex; flex-direction:column; gap:20px;">
                        @foreach($recent_posts as $recent)
                        <div style="display:flex; gap:16px; align-items:center; transition:transform .2s;" onmouseover="this.style.transform='translateX(4px)'" onmouseout="this.style.transform='translateX(0)'">
                            <a href="{{ route('post.detail', $recent->slug) }}" style="flex-shrink:0;">
                                <img src="{{ $recent->thumbnail ?? 'https://images.unsplash.com/photo-1588072432836-e10032774350?w=300&q=80' }}" alt="{{ $recent->title }}" style="width:80px; height:80px; border-radius:10px; object-fit:cover;">
                            </a>
                            <div>
                                <h6 style="font-size:.95rem; font-weight:700; margin-bottom:6px; line-height:1.4;">
                                    <a href="{{ route('post.detail', $recent->slug) }}" style="color:#2c3e50; text-decoration:none; transition:color .2s;" onmouseover="this.style.color='#3498db'" onmouseout="this.style.color='#2c3e50'">
                                        {{ \Illuminate\Support\Str::limit($recent->title, 50) }}
                                    </a>
                                </h6>
                                <span style="font-size:.8rem; color:#999;"><i class="la la-calendar"></i> {{ \Carbon\Carbon::parse($recent->tanggal)->format('d F Y') }}</span>
                            </div>
                        </div>
                        @endforeach
                        
                        @if($recent_posts->isEmpty())
                        <p style="color:#999; font-size:.9rem; margin:0;">Belum ada berita terbaru lainnya.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Additional Styling for Post Content --}}
<style>
    .post-content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 20px 0;
    }
    .post-content a {
        color: #3498db;
        text-decoration: none;
    }
    .post-content a:hover {
        text-decoration: underline;
    }
    .post-content h2, .post-content h3, .post-content h4 {
        color: #2c3e50;
        margin-top: 30px;
        margin-bottom: 16px;
        font-weight: 700;
    }
    .post-content blockquote {
        border-left: 4px solid #3498db;
        padding-left: 16px;
        color: #666;
        font-style: italic;
        background: #f8f9fd;
        padding: 16px;
        border-radius: 0 8px 8px 0;
    }
</style>
@endsection
