@extends('backend.main')

@section('pengguna-menu-active')
    active
@endsection

@section('pengguna-menu-open')
    show
@endsection

@section('content')
<div class="card shadow-sm mt-5">
    <div class="card-header">
        <h3 class="card-title fw-bolder text-dark">Tambah Pengguna Baru</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('pengguna.store') }}" method="POST">
            @csrf
            
            <div class="fv-row mb-7">
                <label class="required fs-6 fw-bold mb-2">Role</label>
                <select class="form-select form-select-solid @error('role') is-invalid @enderror" name="role" required>
                    <option value="" disabled selected>Pilih Role</option>
                    <option value="admin_dinas" {{ old('role') == 'admin_dinas' ? 'selected' : '' }}>Admin Dinas</option>
                    <option value="admin_sekolah" {{ old('role') == 'admin_sekolah' ? 'selected' : '' }}>Admin Sekolah</option>
                    <option value="peserta" {{ old('role') == 'peserta' ? 'selected' : '' }}>Peserta</option>
                </select>
                @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="fv-row mb-7">
                <label class="required fs-6 fw-bold mb-2">Nama Lengkap</label>
                <input type="text" class="form-control form-control-solid @error('name') is-invalid @enderror" placeholder="Masukkan nama lengkap" name="name" value="{{ old('name') }}" required />
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="fv-row mb-7" id="username_container">
                <label class="required fs-6 fw-bold mb-2">Username</label>
                <input type="text" class="form-control form-control-solid @error('username') is-invalid @enderror" placeholder="Masukkan username" name="username" value="{{ old('username') }}" id="username_input" />
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="fv-row mb-7 d-none" id="nik_container">
                <label class="required fs-6 fw-bold mb-2">NIK</label>
                <input type="text" class="form-control form-control-solid @error('nik') is-invalid @enderror" placeholder="Masukkan 16 digit NIK" name="nik" value="{{ old('nik') }}" maxlength="16" id="nik_input" />
                @error('nik')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="text-muted fs-7 mt-1">NIK ini akan otomatis digunakan sebagai username untuk login Peserta.</div>
            </div>

            <div class="fv-row mb-7 d-none" id="sekolah_container">
                <label class="required fs-6 fw-bold mb-2">Sekolah</label>
                <select class="form-select form-select-solid @error('sekolah_id') is-invalid @enderror" name="sekolah_id" id="sekolah_input">
                    <option value="" disabled selected>Pilih Sekolah</option>
                    @foreach ($sekolah as $s)
                        <option value="{{ $s->id }}" {{ old('sekolah_id') == $s->id ? 'selected' : '' }}>{{ $s->nama_sekolah }}</option>
                    @endforeach
                </select>
                @error('sekolah_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="fv-row mb-10">
                <label class="required fs-6 fw-bold mb-2">Password</label>
                <input type="password" class="form-control form-control-solid @error('password') is-invalid @enderror" placeholder="Masukkan password" name="password" required />
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Password Confirmation --}}
            <div class="fv-row mb-10">
                <label class="required fs-6 fw-bold mb-2">Konfirmasi Password</label>
                <input type="password" class="form-control form-control-solid @error('password_confirmation') is-invalid @enderror" placeholder="Masukkan konfirmasi password" name="password_confirmation" required />
                @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="separator mb-8"></div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('pengguna.index') }}" class="btn btn-light me-3">Batal</a>
                <button type="submit" class="btn btn-primary">
                    <span class="indicator-label">Simpan Pengguna</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        const roleSelect = $('select[name="role"]');
        const nikContainer = $('#nik_container');
        const usernameContainer = $('#username_container');
        const sekolahContainer = $('#sekolah_container');
        const nikInput = $('#nik_input');
        const usernameInput = $('#username_input');
        const sekolahInput = $('#sekolah_input');

        function toggleFields() {
            const role = roleSelect.val();
            if (role === 'peserta') {
                nikContainer.removeClass('d-none');
                usernameContainer.addClass('d-none');
                sekolahContainer.addClass('d-none');
                usernameInput.prop('required', false);
                nikInput.prop('required', true);
                sekolahInput.prop('required', false);
            } else if (role === 'admin_sekolah') {
                nikContainer.addClass('d-none');
                usernameContainer.removeClass('d-none');
                sekolahContainer.removeClass('d-none');
                usernameInput.prop('required', true);
                nikInput.prop('required', false);
                sekolahInput.prop('required', true);
            } else {
                nikContainer.addClass('d-none');
                usernameContainer.removeClass('d-none');
                sekolahContainer.addClass('d-none');
                usernameInput.prop('required', true);
                nikInput.prop('required', false);
                sekolahInput.prop('required', false);
            }
        }

        roleSelect.on('change', toggleFields);
        toggleFields();
    });
</script>
@endsection
