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
                            <h3 class="card-title">Post</h3>
                            <div class="card-tools">
                                <a href="{{ route('posts.create') }}" class="btn btn-primary btn-sm">Add New</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if ($posts ->isEmpty())
                                <p>No posts available.</p>
                            @else
                                @foreach ($posts as $post)
                                    <div class="row mb-3">
                                        <div class="col-md-2">
                                            <img src="{{ asset('storage/thumbnails/' . $post->thumbnail) }}" alt="{{ $post->title }}" class="img-fluid">
                                        </div>
                                        <div class="col-md-10">
                                            <small class="text-muted">
                                                By {{ $post->user_name }} on {{ date('d-M-Y', strtotime($post->tanggal)) }} | Status:
                                                @if ($post->status == 'Draft')
                                                    <span class="badge bg-secondary">Draft</span>
                                                @elseif ($post->status == 'Published')
                                                    <span class="badge bg-success">Published</span>
                                                @endif
                                            </small>
                                            <h5>{{ $post->title }}</h5>
                                            <p>{!! Str::limit($post->content, 150) !!}</p>
                                            <div class="btn-group float-right">
                                                <a href="{{ route('posts.show', ['post' => $post]) }}" class="btn btn-info btn-sm">View</a>
                                                <a href="{{ route('posts.edit', ['post' => $post]) }}" class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('posts.destroy', ['post' => $post]) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        {{-- <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-end">
                                <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
