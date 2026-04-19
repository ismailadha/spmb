@extends('backend.main')

@section('sambutan-menu-active')
    active
@endsection

@section('utilitas-menu-open')
    show
@endsection

@section('content')
    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <h3>Edit Sambutan</h3>
            </div>
        </div>
        <div class="card-body py-4">
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('sambutan.update', $sambutan->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-8">
                        <div class="mb-3">
                            <label for="id" class="form-label">ID</label>
                            <input type="text" class="form-control" id="id" name="id" value="{{ old('id', $sambutan->id) }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="nama_pejabat" class="form-label">Nama Pejabat</label>
                            <input type="text" class="form-control" id="nama_pejabat" name="nama_pejabat" value="{{ old('nama_pejabat', $sambutan->nama_pejabat) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{ old('jabatan', $sambutan->jabatan) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="foto" name="foto" value="{{ old('foto', $sambutan->foto) }}" readonly placeholder="Klik Browse untuk memilih gambar...">
                                <button type="button" class="btn btn-secondary" id="lfm_foto_trigger">Browse</button>
                            </div>
                            <div id="foto_preview" class="mt-2" style="{{ $sambutan->foto ? '' : 'display:none;' }}">
                                <img id="foto_img" src="{{ Str::startsWith($sambutan->foto, ['http', '/']) ? $sambutan->foto : asset('storage/' . $sambutan->foto) }}" alt="Preview" class="img-fluid" style="max-width:200px; border-radius:4px;">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="isi_sambutan" class="form-label">Isi Sambutan</label>
                            <textarea class="form-control" id="isi_sambutan" name="isi_sambutan" rows="5">{{ old('isi_sambutan', $sambutan->isi_sambutan) }}</textarea>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="sort_order" class="form-label">Sort Order</label>
                            <input type="number" class="form-control" id="sort_order" name="sort_order" value="{{ old('sort_order', $sambutan->sort_order) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="is_active" class="form-label">Status</label>
                            <select class="form-control" id="is_active" name="is_active">
                                <option value="1" {{ old('is_active', $sambutan->is_active) == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('is_active', $sambutan->is_active) == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-5">
                    <div class="btn-group">
                        <button type="button" class="btn btn-secondary" onclick="window.history.back()">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('tinymce5/jquery.tinymce.min.js') }}"></script>
    <script src="{{ asset('tinymce5/tinymce.min.js') }}"></script>
<script>
    $(document).ready(function(){
        // LFM photo picker
        $('#lfm_foto_trigger').on('click', function () {
            window.top.SetUrl = function (items) {
                var imageUrl = items[0].url;
                $('#foto').val(imageUrl);
                $('#foto_img').attr('src', imageUrl);
                $('#foto_preview').show();
            };
            window.open('/filemanager?type=image', 'lfm', 'width=900,height=600,scrollbars=yes,resizable=yes');
        });

        // TinyMCE integration
        tinymce.init({
            selector: '#isi_sambutan',
            height: 500,
            plugins: 'lists link image preview',
            toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
            menubar: true,
            image_title: true,
            automatic_uploads: true,
            relative_urls: true,
            remove_script_host: true,
            document_base_url: '/',
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
