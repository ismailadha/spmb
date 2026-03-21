@extends('frontend.main')

@section('content')
    <div id="rev_slider_15_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" data-alias="slider4" data-source="gallery" style="margin:0px auto;background:transparent;padding:0px;margin-top:0px;margin-bottom:0px;">
        <!-- START REVOLUTION SLIDER 5.4.8.1 fullwidth mode -->
        <div id="rev_slider_15_1" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.4.8.1">
            <ul>
                @foreach ($sliders as $slider )
                    <!-- SLIDE  -->
                    <li data-index="rs-59" data-transition="boxslide" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="default" data-thumb="{{ asset('storage/' . $slider->gambar) }}" data-rotate="0" data-saveperformance="off" data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                        <!-- MAIN IMAGE -->
                        <img src="{{ asset($slider->gambar) }}" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                    </li>
                @endforeach
            </ul>
            <div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>
        </div>
    </div><!-- END REVOLUTION SLIDER -->
    <section class="content-block section-bg content--block11 p-top-110 p-bottom-110">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-lg-5 margin-md-60">
                    <h2>Sambutan Walikota / Kadis</h2>
                    <p>Investiga tiones demonstr averunt lectres legere kedrme quod kequa legunt saepius. Clarias est
                        etiam cessus.</p>
                    <div class="m-top-40">
                        <ul class="icon-light content-list--two">
                            <li class="content-list d-flex">
                                <div class="icon icon-circle"><span><i class="la la-cog"></i></span></div>
                                <div class="contents">
                                    <h6 class="color-dark">Reliability</h6>
                                    <p>Investig ationes demons trave fhunt lectores legere lius quod getons trave atnes.</p>
                                </div>
                            </li>
                            <li class="content-list d-flex">
                                <div class="icon icon-circle"><span><i class="la la-thumbs-up"></i></span></div>
                                <div class="contents">
                                    <h6 class="color-dark">Industry Experience</h6>
                                    <p>Investig ationes demons trave fhunt lectores legere lius quod getons trave atnes.</p>
                                </div>
                            </li>
                        </ul><!-- ends: .content-list--two -->
                    </div>
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <div class="video-single video-single--two video-overlay">
                        <figure>
                            <img src="{{ asset('front/img/v2.png') }}" alt="">
                        </figure>
                    </div><!-- ends: .video-single -->
                </div>
            </div>
        </div>
    </section><!-- ends: .content-block -->
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="showcase showcase--title1">
                    <h3>Jenjang dan Jalur Pendaftaran</h3>
                </div>
            </div>
        </div>
    </div>
    <section class="card-style">
        <div class="card-style-eleven">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6">
                        <div class="card card--eleven">
                            <figure>
                                <img src="{{ asset('front/img/g2.jpg') }}" alt="">
                            </figure>
                            <div class="card-body text-center">
                                <div class="card-contents">
                                    <div class="content-top">
                                        <span><i class="la la-graduation-cap"></i></span>
                                        <h6>SEKOLAH DASAR</h6>
                                    </div>
                                    <div class="content-bottom mt-2">
                                        <ul style="color: white">
                                            <li class="list-item checklist checklist-light color-primary">
                                                <img src="{{ asset('front/img/svg/check-circle.svg') }}" alt="" class="svg">
                                                Jalur Domisili
                                            </li>
                                            <li class="list-item checklist checklist-light color-primary">
                                                <img src="{{ asset('front/img/svg/check-circle.svg') }}" alt="" class="svg">
                                                Jalur Afirmasi
                                            </li>
                                            <li class="list-item checklist checklist-light color-primary">
                                                <img src="{{ asset('front/img/svg/check-circle.svg') }}" alt="" class="svg">
                                                Jalur Mutasi
                                            </li>
                                        </ul>
                                        <a href="{{ route('registrasi-sd') }}" class="btn btn-secondary btn-sm mt-2">Daftar</a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End: .card -->
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="card card--eleven">
                            <figure>
                                <img src="{{ asset('front/img/g3.jpg') }}" alt="">
                            </figure>
                            <div class="card-body text-center">
                                <div class="card-contents">
                                    <div class="content-top">
                                        <span><i class="la la-graduation-cap"></i></span>
                                        <h6>SEKOLAH MENENGAH PERTAMA</h6>
                                    </div>
                                    <div class="content-bottom mt-2">
                                        <ul style="color: white">
                                            <li class="list-item checklist checklist-light color-primary">
                                                <img src="{{ asset('front/img/svg/check-circle.svg') }}" alt="" class="svg">
                                                Jalur Domisili
                                            </li>
                                            <li class="list-item checklist checklist-light color-primary">
                                                <img src="{{ asset('front/img/svg/check-circle.svg') }}" alt="" class="svg">
                                                Jalur Afirmasi
                                            </li>
                                            <li class="list-item checklist checklist-light color-primary">
                                                <img src="{{ asset('front/img/svg/check-circle.svg') }}" alt="" class="svg">
                                                Jalur Mutasi
                                            </li>
                                            <li class="list-item checklist checklist-light color-primary">
                                                <img src="{{ asset('front/img/svg/check-circle.svg') }}" alt="" class="svg">
                                                Jalur Prestasi
                                            </li>
                                        </ul>
                                        <a href="{{ route('registrasi-smp') }}" class="btn btn-secondary btn-sm mt-2">Daftar</a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End: .card -->
                    </div>
                </div><!-- ends: .row -->
            </div>
        </div><!-- ends: .card-style-eleven -->
    </section>
    <section class="section-news p-top-100 p-bottom-80">
        <div class="m-bottom-50">
            <div class="divider text-center">
                <h1 class="color-dark">Berita Terkini</h1>
                <p class="mx-auto d-none"></p>
            </div>
        </div>
        <div class="post--card1">
            <div class="container">
                <div class="row">
                    @foreach ($posts as $post)
                    <div class="col-lg-4 col-md-6">
                        <div class="card post--card ">
                            <figure>
                                <a href=""><img src="{{ asset('storage/thumbnails/' . $post->thumbnail) }}" alt=""></a>
                            </figure>
                            <div class="card-body">
                                <h6><a href="">{{ $post->title }}</a></h6>
                                <ul class="post-meta d-flex">
                                    <li>{{ date('d-M-Y', strtotime($post->tanggal)) }}</li>
                                    <li>in <a href="">Industry</a></li>
                                </ul>
                                <p>{!! Str::limit($post->content, 150) !!}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div><!-- ends: .row -->
            </div>
        </div><!-- ends: .post--card1 -->
    </section>
@endsection
