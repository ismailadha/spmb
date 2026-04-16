@extends('backend.main')

@section('konfigurasi-menu-active')
    active
@endsection

@section('content')
<div class="card mb-5 mb-xl-10">
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">Konfigurasi Sistem</h3>
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
        <form id="kt_konfigurasi_form" class="form" method="POST" action="{{ route('konfigurasi.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body border-top p-9">

                <!-- Logo Path -->
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-bold fs-6">Logo Sistem</label>
                    <div class="col-lg-8">

                        <!-- Upload area -->
                        <div id="logo-upload-container">
                            <div id="logo-preview-container" class="mb-4 d-none">
                                <img id="logo-preview" src="" alt="Preview Logo" style="max-height: 150px; max-width: 100%; object-fit: contain;">
                                <div class="mt-3">
                                    <button type="button" class="btn btn-sm btn-danger" id="remove-logo-btn">
                                        <i class="ki-duotone ki-trash fs-4">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        Hapus Logo
                                    </button>
                                </div>
                            </div>

                            <div id="logo-upload-prompt">
                                <input type="file" name="logo_path" id="logo-input" class="form-control form-control-lg" accept=".png, .jpg, .jpeg" />
                                <div class="form-text mt-2">Format: PNG, JPG, JPEG • Maksimal 2MB</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Favicon -->
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-bold fs-6">Favicon Sistem</label>
                    <div class="col-lg-8">

                        <!-- Upload area -->
                        <div id="favicon-upload-container">
                            <div id="favicon-preview-container" class="mb-4 d-none">
                                <img id="favicon-preview" src="" alt="Preview Favicon" style="max-height: 50px; max-width: 100%; object-fit: contain;">
                                <div class="mt-3">
                                    <button type="button" class="btn btn-sm btn-danger" id="remove-favicon-btn">
                                        <i class="ki-duotone ki-trash fs-4">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        Hapus Favicon
                                    </button>
                                </div>
                            </div>

                            <div id="favicon-upload-prompt">
                                <input type="file" name="favicon" id="favicon-input" class="form-control form-control-lg" accept=".png, .jpg, .jpeg, .ico" />
                                <div class="form-text mt-2">Format: PNG, JPG, JPEG, ICO • Maksimal 1MB</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Nama Sistem -->
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label required fw-bold fs-6">Nama Sistem</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="nama_sistem" class="form-control form-control-lg form-control-solid @error('nama_sistem') is-invalid @enderror" placeholder="Contoh: Sistem Penerimaan Siswa Baru" value="{{ $konfigurasi['nama_sistem'] ?? old('nama_sistem') }}" />
                        @error('nama_sistem')
                            <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Nama Instansi -->
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label required fw-bold fs-6">Nama Instansi</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="nama_instansi" class="form-control form-control-lg form-control-solid @error('nama_instansi') is-invalid @enderror" placeholder="Contoh: Dinas Pendidikan Kota Lhokseumawe" value="{{ $konfigurasi['nama_instansi'] ?? old('nama_instansi') }}" />
                        @error('nama_instansi')
                            <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Email Resmi -->
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label required fw-bold fs-6">Email Resmi</label>
                    <div class="col-lg-8 fv-row">
                        <input type="email" name="email_resmi" class="form-control form-control-lg form-control-solid @error('email_resmi') is-invalid @enderror" placeholder="email@instansi.go.id" value="{{ $konfigurasi['email_resmi'] ?? old('email_resmi') }}" />
                        @error('email_resmi')
                            <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Telepon -->
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-bold fs-6">
                        <span class="required">Telepon</span>
                    </label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="telepon" class="form-control form-control-lg form-control-solid @error('telepon') is-invalid @enderror" placeholder="0812xxxxxx" value="{{ $konfigurasi['telepon'] ?? old('telepon') }}" />
                        @error('telepon')
                            <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Alamat -->
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label required fw-bold fs-6">Alamat Lengkap</label>
                    <div class="col-lg-8 fv-row">
                        <textarea name="alamat" class="form-control form-control-lg form-control-solid @error('alamat') is-invalid @enderror" rows="3" placeholder="Masukkan alamat lengkap instansi">{{ $konfigurasi['alamat'] ?? old('alamat') }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Footer Teks -->
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label required fw-bold fs-6">Footer Teks</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="footer_teks" class="form-control form-control-lg form-control-solid @error('footer_teks') is-invalid @enderror" placeholder="Contoh: 2026© Dinas Pendidikan" value="{{ $konfigurasi['footer_teks'] ?? old('footer_teks') }}" />
                        @error('footer_teks')
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Logo variables
    const fileInput = document.getElementById('logo-input');
    const previewContainer = document.getElementById('logo-preview-container');
    const uploadPrompt = document.getElementById('logo-upload-prompt');
    const logoPreview = document.getElementById('logo-preview');
    const removeLogoBtn = document.getElementById('remove-logo-btn');

    // Favicon variables
    const faviconInput = document.getElementById('favicon-input');
    const faviconPreviewContainer = document.getElementById('favicon-preview-container');
    const faviconUploadPrompt = document.getElementById('favicon-upload-prompt');
    const faviconPreview = document.getElementById('favicon-preview');
    const removeFaviconBtn = document.getElementById('remove-favicon-btn');

    const form = document.getElementById('kt_konfigurasi_form');
    const resetBtn = document.getElementById('btn-reset');

    // Logo state
    let hasExistingLogo = false;
    let existingLogoUrl = '';

    // Favicon state
    let hasExistingFavicon = false;
    let existingFaviconUrl = '';

    // Check if logo already exists
    @if (!empty($konfigurasi['logo_path']))
        hasExistingLogo = true;
        existingLogoUrl = '{{ asset($konfigurasi['logo_path']) }}';
        logoPreview.src = existingLogoUrl;
        previewContainer.classList.remove('d-none');
        uploadPrompt.classList.add('d-none');
    @endif

    // Check if favicon already exists
    @if (!empty($konfigurasi['favicon']))
        hasExistingFavicon = true;
        existingFaviconUrl = '{{ asset($konfigurasi['favicon']) }}';
        faviconPreview.src = existingFaviconUrl;
        faviconPreviewContainer.classList.remove('d-none');
        faviconUploadPrompt.classList.add('d-none');
    @endif

    // Logo input change
    fileInput.addEventListener('change', () => handleFileSelect(fileInput, logoPreview, previewContainer, uploadPrompt, 'image/png', 'image/jpeg', 'image/jpg'));

    // Favicon input change
    faviconInput.addEventListener('change', () => handleFileSelect(faviconInput, faviconPreview, faviconPreviewContainer, faviconUploadPrompt, 'image/png', 'image/jpeg', 'image/jpg', 'image/x-icon', 'image/vnd.microsoft.icon'));

    function handleFileSelect(input, preview, container, prompt, ...allowedTypes) {
        if (input.files.length > 0) {
            const file = input.files[0];

            // Validate file type
            if (allowedTypes.length > 0 && !allowedTypes.includes(file.type)) {
                alert('Format file tidak valid.');
                input.value = '';
                return;
            }

            // Validate file size (2MB for logo, 1MB for favicon)
            const maxSize = (input.id === 'logo-input') ? 2 * 1024 * 1024 : 1 * 1024 * 1024;
            if (file.size > maxSize) {
                alert('Ukuran file tidak boleh lebih dari ' + (maxSize / 1024 / 1024) + 'MB.');
                input.value = '';
                return;
            }

            // Show preview
            const reader = new FileReader();
            reader.onload = (e) => {
                preview.src = e.target.result;
                container.classList.remove('d-none');
                prompt.classList.add('d-none');
            };
            reader.readAsDataURL(file);
        }
    }

    // Remove logo
    removeLogoBtn.addEventListener('click', (e) => {
        e.preventDefault();
        fileInput.value = '';
        previewContainer.classList.add('d-none');
        uploadPrompt.classList.remove('d-none');
        logoPreview.src = '';
    });

    // Remove favicon
    removeFaviconBtn.addEventListener('click', (e) => {
        e.preventDefault();
        faviconInput.value = '';
        faviconPreviewContainer.classList.add('d-none');
        faviconUploadPrompt.classList.remove('d-none');
        faviconPreview.src = '';
    });

    // Reset button - clear form
    resetBtn.addEventListener('click', function() {
        form.reset();
        fileInput.value = '';
        faviconInput.value = '';

        // Reset logo display
        if (hasExistingLogo) {
            logoPreview.src = existingLogoUrl;
            previewContainer.classList.remove('d-none');
            uploadPrompt.classList.add('d-none');
        } else {
            previewContainer.classList.add('d-none');
            uploadPrompt.classList.remove('d-none');
            logoPreview.src = '';
        }

        // Reset favicon display
        if (hasExistingFavicon) {
            faviconPreview.src = existingFaviconUrl;
            faviconPreviewContainer.classList.remove('d-none');
            faviconUploadPrompt.classList.add('d-none');
        } else {
            faviconPreviewContainer.classList.add('d-none');
            faviconUploadPrompt.classList.remove('d-none');
            faviconPreview.src = '';
        }

        form.classList.remove('was-validated');
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
