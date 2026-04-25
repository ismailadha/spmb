@extends('backend.main')

@section('content')
<div class="card shadow-sm mt-5">
    <div class="card-header">
        <h3 class="card-title fw-bolder text-dark">Ubah Kata Sandi</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="fv-row mb-7">
                <label class="required fs-6 fw-bold mb-2">Kata Sandi Saat Ini</label>
                <input type="password" class="form-control form-control-solid @error('current_password') is-invalid @enderror" placeholder="Masukkan kata sandi saat ini" name="current_password" required />
                @error('current_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="fv-row mb-7">
                <label class="required fs-6 fw-bold mb-2">Kata Sandi Baru</label>
                <input type="password" class="form-control form-control-solid @error('password') is-invalid @enderror" placeholder="Masukkan kata sandi baru" name="password" required />
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="fv-row mb-10">
                <label class="required fs-6 fw-bold mb-2">Konfirmasi Kata Sandi Baru</label>
                <input type="password" class="form-control form-control-solid @error('password_confirmation') is-invalid @enderror" placeholder="Konfirmasi kata sandi baru" name="password_confirmation" required />
                @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="separator mb-8"></div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('dashboard') }}" class="btn btn-light me-3">Batal</a>
                <button type="submit" class="btn btn-primary">
                    <span class="indicator-label">Simpan Perubahan</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
