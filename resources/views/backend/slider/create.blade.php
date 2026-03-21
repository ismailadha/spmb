@extends('backend.main')

@section('slider-menu-active')
    active
@endsection

@section('slider-menu-open')
    show
@endsection

@section('content')
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <h3>Tambah Slider</h3>
            </div>
            <!--begin::Card title-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body py-4">
            <form action="{{ route('slider.store') }}" method="POST">
                @csrf

                <!-- Caption - Full Width -->
                <div class="row mb-3">
                    <div class="col-12">
                        <label for="caption" class="form-label">Caption</label>
                        <input type="text" class="form-control" id="caption" name="caption" required>
                    </div>
                </div>

                <!-- Gambar via LFM -->
                <div class="row mb-3">
                    <div class="col-12">
                        <label class="form-label">Gambar</label>
                        <input type="hidden" id="gambar" name="gambar">
                        <div class="input-group">
                            <input type="text" class="form-control" id="gambar_display" placeholder="Pilih gambar..." readonly>
                            <button type="button" class="btn btn-secondary" id="lfm-btn">
                                <i class="fa fa-image me-1"></i> Browse
                            </button>
                        </div>
                        <div class="mt-3" id="preview-container" style="display:none;">
                            <img id="gambar_preview" src="" alt="Preview Gambar" class="img-fluid rounded" style="max-width: 250px; max-height: 200px; object-fit: cover;">
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="row mt-5">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('slider.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--end::Card-->
@endsection

@section('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        document.getElementById('lfm-btn').addEventListener('click', function () {
            var lfmUrl = '/filemanager?type=Images';
            var w = 900, h = 600;
            var left = (screen.width / 2) - (w / 2);
            var top = (screen.height / 2) - (h / 2);

            window.open(lfmUrl, 'FileManager',
                'width=' + w + ',height=' + h + ',top=' + top + ',left=' + left);
        });

        window.SetUrl = function (items) {
            var fileUrl = items.map(function (item) { return item.url; }).join(',');
            document.getElementById('gambar').value = fileUrl;
            document.getElementById('gambar_display').value = fileUrl;

            var preview = document.getElementById('gambar_preview');
            preview.src = fileUrl;
            document.getElementById('preview-container').style.display = 'block';
        };
    </script>
@endsection
