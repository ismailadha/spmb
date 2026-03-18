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
            <form action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Caption - Full Width -->
                <div class="row mb-3">
                    <div class="col-12">
                        <label for="caption" class="form-label">Caption</label>
                        <input type="text" class="form-control" id="caption" name="caption" required>
                    </div>
                </div>

                <!-- Gambar -->
                <div class="row mb-3">
                    <div class="col-12">
                        <label for="gambar" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="gambar" name="gambar" required>
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
