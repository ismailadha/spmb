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
                <h3 class="card-label">Data Berita (Post)</h3>
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <a href="{{ route('posts.create') }}" class="btn btn-primary">
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor" />
                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor" />
                            </svg>
                        </span>
                        Add Post
                    </a>
                </div>
                <!--end::Toolbar-->
            </div>
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
		<div class="card-body py-4">
            <!--begin::Table-->
            <div class="table-responsive">
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_posts">
                <!--begin::Table head-->
                <thead>
                    <!--begin::Table row-->
                    <tr class="text-start text-dark-400 fw-bolder fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">No</th>
                        <th class="min-w-125px">Thumbnail</th>
                        <th class="min-w-200px">Title</th>
                        <th class="min-w-125px">Date</th>
                        <th class="min-w-100px">Status</th>
                        <th class="text-end min-w-150px">Actions</th>
                    </tr>
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody class="fw-bold text-gray-600">
                    @if ($posts->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center">No posts available.</td>
                        </tr>
                    @else
                        @foreach ($posts as $index => $post)
                            <tr class="align-middle">
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <img src="{{ $post->thumbnail }}" alt="{{ $post->title }}" class="img-fluid" style="max-width: 100px; border-radius: 4px;">
                                </td>
                                <td>
                                    <a href="{{ route('posts.show', ['post' => $post]) }}" class="text-gray-800 text-hover-primary mb-1">{{ $post->title }}</a>
                                </td>
                                <td>{{ date('d-M-Y', strtotime($post->tanggal)) }}</td>
                                <td>
                                    @if ($post->status == 'Draft')
                                        <div class="badge badge-light-secondary fw-bolder">Draft</div>
                                    @elseif ($post->status == 'Published')
                                        <div class="badge badge-light-success fw-bolder">Published</div>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-info btn-sm">View</a>
                                        <a href="{{ route('posts.edit', $post->slug) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('posts.destroy', $post->slug) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                <!--end::Table body-->
            </table>
            </div>
            <!--end::Table-->
        </div>
    </div>
    <!--end::Card-->
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function() {
    $('#kt_table_posts').DataTable({
        responsive: true
    });
});
</script>
@endsection
