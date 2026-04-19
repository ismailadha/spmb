@extends('frontend.main')

@section('content')
    <section class="breadcrumb_area breadcrumb2 bgimage biz_overlay">
        <div class="bg_image_holder">
            <img src="https://images.unsplash.com/photo-1510531704581-5b2870972060?auto=format&fit=crop&w=1920&q=80" alt="">
        </div>
        <div class="container content_above">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb_wrapper d-flex flex-column align-items-center">
                        <h3 class="page_title">Persyaratan Pendaftaran</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="persyaratan_area section-padding" style="padding: 80px 0; background-color: #f8f9fa;">
        <div class="container py-5">
            {!! $persyaratan->nilai ?? '<div class="alert alert-info text-center">Persyaratan pendaftaran belum tersedia.</div>' !!}
        </div>
    </section>
@endsection
