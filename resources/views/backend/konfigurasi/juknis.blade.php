@extends('backend.main')

@section('juknis-menu-active')
    active
@endsection

@section('utilitas-menu-open')
    show
@endsection

@section('content')
<div class="card mb-5 mb-xl-10">
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">Petunjuk Teknis (Juknis)</h3>
        </div>
    </div>

    <div id="kt_account_profile_details" class="collapse show">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="ki-duotone ki-cross-circle fs-3 me-2">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
                <div class="d-flex flex-column">
                    <span class="fw-bold">Validasi gagal!</span>
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <form id="kt_juknis_form" class="form" method="POST" action="{{ route('konfigurasi.juknis.update') }}">
            @csrf
            <div class="card-body border-top p-9">
                <!-- Petunjuk Teknis -->
                <div class="row mb-6">
                    <label class="col-lg-12 col-form-label required fw-bold fs-6">Isi Petunjuk Teknis</label>
                    <div class="col-lg-12 fv-row">
                        <textarea name="nilai" id="isi_juknis" class="form-control form-control-lg form-control-solid @error('nilai') is-invalid @enderror" rows="20">{{ $juknis->nilai ?? old('nilai') }}</textarea>
                        @error('nilai')
                            <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button type="reset" class="btn btn-light btn-active-light-primary me-2" id="btn-reset">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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
        // TinyMCE integration
        tinymce.init({
            selector: '#isi_juknis',
            height: 600,
            plugins: 'lists link image preview table code help lists',
            toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | code | help',
            menubar: true,
            image_title: true,
            automatic_uploads: true,
            relative_urls: true,
            remove_script_host: true,
            document_base_url: '/',
            file_picker_types: 'image file',
            file_picker_callback: function (cb, value, meta) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

                var type = 'image' === meta.filetype ? 'Images' : 'Files';
                var url = '/filemanager?type=' + type;

                window.top.SetUrl = function (items) {
                    cb(items[0].url, { title: items[0].name });
                };
                window.open(url, 'lfm', 'width=' + x * 0.8 + ',height=' + y * 0.8 + ',scrollbars=yes,resizable=yes');
            },
        });

        @if (session('success'))
            Swal.fire({
                text: "{!! session('success') !!}",
                icon: "success",
                buttonsStyling: false,
                confirmButtonText: "Ok, Mengerti!",
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            });
        @endif
    });
</script>
@endsection
