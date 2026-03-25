@extends('frontend.main')

@section('content')
<section style="padding:40px 0 80px;background:#f8f9fd;">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8 mb-4">
                <div style="background:#fff;border-radius:16px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,.07);padding:35px;">
                    <h2 style="font-weight:700;margin-bottom:15px;line-height:1.4;">{{ $post->title }}</h2>
                    <div style="display:flex;align-items:center;gap:15px;margin-bottom:25px;border-bottom:1px solid #eee;padding-bottom:15px;">
                        <span style="background:#8e44ad;color:#fff;font-size:.8rem;padding:4px 12px;border-radius:20px;"><i class="la la-tag"></i> Informasi</span>
                        <span style="color:#666;font-size:.9rem;"><i class="la la-calendar"></i> {{ \Carbon\Carbon::parse($post->tanggal)->format('d M Y') }}</span>
                    </div>
                    
                    @if($post->thumbnail)
                        <img src="{{ asset($post->thumbnail) }}" alt="{{ $post->title }}" style="width:100%;height:auto;max-height:450px;object-fit:cover;border-radius:12px;margin-bottom:30px;">
                    @else
                        <img src="https://images.unsplash.com/photo-1588072432836-e10032774350?w=800&q=80" alt="{{ $post->title }}" style="width:100%;height:auto;max-height:450px;object-fit:cover;border-radius:12px;margin-bottom:30px;">
                    @endif

                    <div style="color:#444;font-size:1.05rem;line-height:1.8;">
                        {!! $post->content !!}
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div style="background:#fff;border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,.07);padding:25px;position:sticky;top:90px;">
                    <h5 style="font-weight:700;margin-bottom:20px;border-bottom:3px solid #8e44ad;display:inline-block;padding-bottom:5px;">Berita Terbaru</h5>
                    
                    <ul style="list-style:none;padding:0;margin:0;">
                        @forelse($recent_posts as $recent)
                            <li style="margin-bottom:15px;display:flex;gap:15px;align-items:flex-start;border-bottom:1px solid #eee;padding-bottom:15px;">
                                <a href="{{ route('post.detail', $recent->slug) }}" style="flex-shrink:0;">
                                    @if($recent->thumbnail)
                                        <img src="{{ asset($recent->thumbnail) }}" alt="{{ $recent->title }}" style="width:80px;height:65px;object-fit:cover;border-radius:8px;">
                                    @else
                                        <img src="https://images.unsplash.com/photo-1588072432836-e10032774350?w=150&q=80" alt="{{ $recent->title }}" style="width:80px;height:65px;object-fit:cover;border-radius:8px;">
                                    @endif
                                </a>
                                <div>
                                    <h6 style="margin:0 0 5px;font-weight:600;font-size:.9rem;line-height:1.4;">
                                        <a href="{{ route('post.detail', $recent->slug) }}" style="color:#333;text-decoration:none;" onmouseover="this.style.color='#8e44ad'" onmouseout="this.style.color='#333'">
                                            {{ \Illuminate\Support\Str::limit($recent->title, 45) }}
                                        </a>
                                    </h6>
                                    <span style="color:#999;font-size:.78rem;"><i class="la la-calendar"></i> {{ \Carbon\Carbon::parse($recent->tanggal)->format('d M Y') }}</span>
                                </div>
                            </li>
                        @empty
                            <li><p style="color:#999;font-size:.9rem;">Belum ada berita lainnya.</p></li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection