@extends('frontend.main')

@section('content')
    <!-- Hero Area / Breadcrumb -->
    <section class="breadcrumb_area breadcrumb2 bgimage" style="background-image: url('https://images.unsplash.com/photo-1510531704581-5b2870972060?auto=format&fit=crop&w=1920&q=80'); background-size: cover; padding: 120px 0; background-position: center; position: relative; overflow: hidden;">
        <div class="overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(to right, rgba(30, 42, 74, 0.8), rgba(52, 152, 219, 0.4));"></div>
        <div class="container text-center position-relative" style="z-index: 2;">
            <h1 class="text-white font-weight-bold display-4 mb-2 animate__animated animate__fadeInDown">Persyaratan Pendaftaran</h1>
            <p class="text-white-50 lead animate__animated animate__fadeInUp">Lengkapi seluruh dokumen persyaratan sebelum melakukan pendaftaran</p>
        </div>
    </section>

    <section class="persyaratan_area section-padding" style="padding: 80px 0; background-color: #f8f9fa;">
        <div class="container py-5">
            {!! $persyaratan->nilai ?? '<div class="alert alert-info text-center">Persyaratan pendaftaran belum tersedia.</div>' !!}
        </div>
    </section>
@endsection
