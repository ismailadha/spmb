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
                <h3>New Post</h3>
            </div>
            <!--begin::Card title-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body py-4">
            <form action="{{ route('posts.store') }}" method="POST">
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
                            <div class="input-group">
                                <input type="text" class="form-control" id="input_post_thumbnail" name="thumbnail"
                                    readonly placeholder="Klik Browse untuk memilih gambar...">
                                <button type="button" class="btn btn-secondary" id="lfm_thumbnail_trigger">Browse</button>
                            </div>
                            <div id="thumbnail_preview" class="mt-2" style="display:none;">
                                <img id="thumbnail_img" src="" alt="Preview" class="img-fluid" style="max-width:200px; border-radius:4px;">
                            </div>
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
                <div class="d-flex justify-content-end mt-5">
                    <div class="btn-group">
                        <button type="button" class="btn btn-secondary" onclick="window.history.back()">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--end::Card-->
@endsection

@section('scripts')
    <script src="{{ asset('tinymce5/jquery.tinymce.min.js') }}"></script>
    <script src="{{ asset('tinymce5/tinymce.min.js') }}"></script>
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

        // LFM thumbnail picker
        $('#lfm_thumbnail_trigger').on('click', function () {
            window.top.SetUrl = function (items) {
                var imageUrl = items[0].url;
                $('#input_post_thumbnail').val(imageUrl);
                $('#thumbnail_img').attr('src', imageUrl);
                $('#thumbnail_preview').show();
            };
            window.open('/filemanager?type=image', 'lfm', 'width=900,height=600,scrollbars=yes,resizable=yes');
        });

        // TinyMCE
        tinymce.init({
            selector: '#input_post_content',
            height: 500,
            plugins: 'lists link image preview',
            toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
            menubar: true,
            image_title: true,
            automatic_uploads: true,
            relative_urls: false,
            remove_script_host: true,
            file_picker_types: 'image',
            file_picker_callback: function (cb, value, meta) {
                window.top.SetUrl = function (items) {
                    cb(items[0].url, { title: items[0].name });
                };
                window.open('/filemanager?type=image', 'lfm', 'width=900,height=600,scrollbars=yes,resizable=yes');
            },
        });
    });
</script>
@endsection
