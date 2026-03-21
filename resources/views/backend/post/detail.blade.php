@extends('backend.main')

@section('post-menu-active')
    active
@endsection

@section('utilitas-menu-open')
    show
@endsection

@section('content')
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <h3>Post Detail</h3>
            </div>
            <!--begin::Card title-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body py-4">
            <div class="row mb-3">
                <div class="col-md-12">
                    @if ($post->thumbnail)
                        <img src="{{ $post->thumbnail }}" alt="{{ $post->title }}" class="img-fluid mt-2" style="max-width: 400px; border-radius: 8px;">
                    @endif
                    <h5 class="mt-5 mb-2">{{ $post->title }}</h5>
                    <small class="text-muted">
                        By {{ $post->user_name }} on {{ date('d-M-Y', strtotime($post->tanggal)) }} | Status:
                        @if ($post->status == 'Draft')
                            <span class="badge badge-light-secondary fw-bolder">Draft</span>
                        @elseif ($post->status == 'Published')
                            <span class="badge badge-light-success fw-bolder">Published</span>
                        @endif
                    </small>
                    <div class="mt-5" style="font-size: 1.1rem; line-height: 1.6;">
                        {!! $post->content !!}
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end mt-5">
                <a href="{{ route('posts.index') }}" class="btn btn-secondary me-2">Back to List</a>
                <a href="{{ route('posts.edit', $post->slug) }}" class="btn btn-warning">Edit Post</a>
            </div>
        </div>
    </div>
    <!--end::Card-->
@endsection
