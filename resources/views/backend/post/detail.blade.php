@extends('backend.main')

@section('menu-open')
    menu-open
@endsection

@section('menu-active')
    active
@endsection

@section('content')
<div class="content-wrapper">
    <div class="app-content">
        <div class="container-fluid">
            <div class="row pt-4">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Post Detail</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    @if ($post->thumbnail)
                                        <img src="{{ asset('storage/thumbnails/' . $post->thumbnail) }}" alt="{{ $post->title }}" class="img-fluid mt-2" style="max-width: 400px;">
                                    @endif
                                    <h5 class="m-2">{{ $post->title }}</h5>
                                    <small class="text-muted ml-2">
                                        By {{ $post->user_name }} on {{ date('d-M-Y', strtotime($post->tanggal)) }} | Status:
                                        @if ($post->status == 'Draft')
                                            <span class="badge bg-secondary">Draft</span>
                                        @elseif ($post->status == 'Published')
                                            <span class="badge bg-success">Published</span>
                                        @endif
                                    </small>
                                    <p class="m-2">{!! $post->content !!}</p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
