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
                        <div class="card-header"><h3 class="card-title">New Post</h3></div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-8">
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Title</label>
                                            <input type="text" class="form-control" id="input_post_title" name="title">
                                        </div>
                                        <div class="mb-3">
                                            <label for="slug" class="form-label">Slug</label>
                                            <input type="text" class="form-control" id="input_post_slug" name="slug" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="thumbnail" class="form-label">Thumbnail</label>
                                            <input type="file" class="form-control" id="input_post_thumbnail" name="thumbnail">
                                        </div>
                                        <div class="mb-3">
                                            <label for="content" class="form-label">Content</label>
                                            <textarea class="form-control" id="input_post_content" name="content" rows="5"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="published_at" class="form-label">Published At</label>
                                            <input type="date" class="form-control" id="input_post_published_at" name="published_at" value="{{ date('Y-m-d') }}">
                                        </div>
                                        {{-- Publish status --}}
                                        <div class="mb-3">
                                            <label for="status" class="form-label">Status</label>
                                            <select class="form-control" id="input_post_status" name="status">
                                                <option value="Draft">Draft</option>
                                                <option value="Published">Published</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-secondary" onclick="window.history.back()">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('javascript-external')
    <script src="{{ asset('tinymce5/jquery.tinymce.min.js') }}"></script>
    <script src="{{ asset('tinymce5/tinymce.min.js') }}"></script>
@endpush

@push('javascript-internal')
<script>
    $(document).ready(function(){
        $("#input_post_title").change(function (event) {
            $("#input_post_slug").val(
                event.target.value
                .trim()
                .toLowerCase()
                .replace(/[^a-z\d-]/gi, "-")
                .replace(/-+/g, "-")
                .replace(/^-|-$/g, "")
            );
        });

        tinymce.init({
            selector: '#input_post_content',
            height: 500,
            plugins: 'lists link image preview',
            toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
            menubar: true,
            image_title: true,
            automatic_uploads: true,
            file_picker_types: 'image',
            file_picker_callback: function (cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');

                input.onchange = function () {
                    var file = this.files[0];
                    var reader = new FileReader();
                    reader.onload = function () {
                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);
                        cb(blobInfo.blobUri(), { title: file.name });
                    };
                    reader.readAsDataURL(file);
                };

                input.click();
            }
        });
    });
</script>
@endpush
