@extends('backend.main')

@section('pengguna-menu-active')
    active
@endsection

@section('pengguna-menu-open')
    show
@endsection

@section('content')
<div class="card mb-4">
    <div class="card-header border-bottom">
        <h5 class="mb-0">Tambah Pengguna</h5>
    </div>
    <div class="card-body">
        <p>Formulir tambah pengguna akan ada di sini.</p>
        <a href="{{ route('pengguna.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection
