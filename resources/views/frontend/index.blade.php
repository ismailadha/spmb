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
                        <img src="{{ asset('storage/' . $slider->gambar) }}" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                    </li>
                @endforeach
            </ul>
            <div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>
        </div>
    </div><!-- END REVOLUTION SLIDER -->
    <section class="p-top-105 p-bottom-55">
        <div class="icon-boxes icon-box--one">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="icon-box icon-box-one text-center">
                            <span class="color-secondary"><i class="la la-support"></i></span>
                            <h6 class="color-dark">Business Consulting</h6>
                            <p>Investig ationes demons trave runt lectores legere lius quod legunt saepiu.</p>
                        </div><!-- ends: .icon-box -->
                    </div><!-- ends: .col-lg-3 -->
                    <div class="col-lg-3 col-md-6">
                        <div class="icon-box icon-box-one text-center">
                            <span class="color-secondary"><i class="la la-lightbulb-o"></i></span>
                            <h6 class="color-dark">Valuable Ideas</h6>
                            <p>Investig ationes demons trave runt lectores legere lius quod legunt saepiu.</p>
                        </div><!-- ends: .icon-box -->
                    </div><!-- ends: .col-lg-3 -->
                    <div class="col-lg-3 col-md-6">
                        <div class="icon-box icon-box-one text-center">
                            <span class="color-secondary"><i class="la la-bar-chart"></i></span>
                            <h6 class="color-dark">Industry Experience</h6>
                            <p>Investig ationes demons trave runt lectores legere lius quod legunt saepiu.</p>
                        </div><!-- ends: .icon-box -->
                    </div><!-- ends: .col-lg-3 -->
                    <div class="col-lg-3 col-md-6">
                        <div class="icon-box icon-box-one text-center">
                            <span class="color-secondary"><i class="la la-money"></i></span>
                            <h6 class="color-dark">Budget Friendly</h6>
                            <p>Investig ationes demons trave runt lectores legere lius quod legunt saepiu.</p>
                        </div><!-- ends: .icon-box -->
                    </div><!-- ends: .col-lg-3 -->
                </div>
            </div>
        </div><!-- ends: .icon-boxes -->
    </section>
    <section class="content-block section-bg content--block11 p-top-110 p-bottom-110">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-lg-5 margin-md-60">
                    <h2>We Support Financial Ideas</h2>
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
                            <img src="img/v2.png" alt="">
                        </figure>
                    </div><!-- ends: .video-single -->
                </div>
            </div>
        </div>
    </section><!-- ends: .content-block -->
    <section class="p-top-100 p-bottom-105">
        <div class="m-bottom-50">
            <div class="divider text-center">
                <h1 class="color-dark">Industries We Serve</h1>
                <p class="mx-auto d-none"></p>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="carousel-one owl-carousel">
                        <div class="carousel-one-single">
                            <figure>
                                <img src="img/c1.jpg" alt="">
                            </figure>
                            <h6><a href="">Business Services Consulting</a></h6>
                            <p>Investig ationes demons trave runt lectoes legere klius quod ii legunt saepius claritas investing ationes demons.</p>
                        </div><!-- ends: .carousel-one-single -->
                        <div class="carousel-one-single">
                            <figure>
                                <img src="img/c2.jpg" alt="">
                            </figure>
                            <h6><a href="">Consumer Products Consulting</a></h6>
                            <p>Investig ationes demons trave runt lectoes legere klius quod ii legunt saepius claritas investing ationes demons.</p>
                        </div><!-- ends: .carousel-one-single -->
                        <div class="carousel-one-single">
                            <figure>
                                <img src="img/c3.jpg" alt="">
                            </figure>
                            <h6><a href="">Financial Services Consulting</a></h6>
                            <p>Investig ationes demons trave runt lectoes legere klius quod ii legunt saepius claritas investing ationes demons.</p>
                        </div><!-- ends: .carousel-one-single -->
                        <div class="carousel-one-single">
                            <figure>
                                <img src="img/c1.jpg" alt="">
                            </figure>
                            <h6><a href="">Business Services Consulting</a></h6>
                            <p>Investig ationes demons trave runt lectoes legere klius quod ii legunt saepius claritas investing ationes demons.</p>
                        </div><!-- ends: .carousel-one-single -->
                        <div class="carousel-one-single">
                            <figure>
                                <img src="img/c1.jpg" alt="">
                            </figure>
                            <h6><a href="">Business Services Consulting</a></h6>
                            <p>Investig ationes demons trave runt lectoes legere klius quod ii legunt saepius claritas investing ationes demons.</p>
                        </div><!-- ends: .carousel-one-single -->
                        <div class="carousel-one-single">
                            <figure>
                                <img src="img/c2.jpg" alt="">
                            </figure>
                            <h6><a href="">Consumer Products Consulting</a></h6>
                            <p>Investig ationes demons trave runt lectoes legere klius quod ii legunt saepius claritas investing ationes demons.</p>
                        </div><!-- ends: .carousel-one-single -->
                        <div class="carousel-one-single">
                            <figure>
                                <img src="img/c3.jpg" alt="">
                            </figure>
                            <h6><a href="">Financial Services Consulting</a></h6>
                            <p>Investig ationes demons trave runt lectoes legere klius quod ii legunt saepius claritas investing ationes demons.</p>
                        </div><!-- ends: .carousel-one-single -->
                    </div><!-- ends: .carousel-one -->
                </div>
            </div>
        </div>
    </section>
    <section class="carousel-wrapper bgimage logo-carousel">
        <div class="bg_image_holder">
            <img src="img/logo-wrapper-bg.jpg" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-5 d-flex justify-content-center flex-column margin-md-60 content-left">
                    <h1 class="color-dark">They are Changing the Face of Business</h1>
                    <p>Demonstr averunt lectores legere me lius quod qua pro legunt saepius Claritas est etiam pro cessus dynamicus qui sequitur mutationem consuetudium lec torum. Mirum notare quam littera gothica, quam the nunc.</p>
                </div><!-- ends: .col-lg-5 -->
                <div class="col-lg-6 offset-lg-1">
                    <div class="logo-carousel-two owl-carousel">
                        <div class="carousel-single">
                            <div class="logo-box">
                                <img src="img/cl14.png" alt="">
                            </div><!-- ends: .logo-box -->
                            <div class="logo-box">
                                <img src="img/cl15.png" alt="">
                            </div><!-- ends: .logo-box -->
                        </div><!-- end: .carousel-single -->
                        <div class="carousel-single">
                            <div class="logo-box">
                                <img src="img/cl16.png" alt="">
                            </div><!-- ends: .logo-box -->
                            <div class="logo-box">
                                <img src="img/cl17.png" alt="">
                            </div><!-- ends: .logo-box -->
                        </div><!-- end: .carousel-single -->
                        <div class="carousel-single">
                            <div class="logo-box">
                                <img src="img/cl14.png" alt="">
                            </div><!-- ends: .logo-box -->
                            <div class="logo-box">
                                <img src="img/cl15.png" alt="">
                            </div><!-- ends: .logo-box -->
                        </div><!-- end: .carousel-single -->
                        <div class="carousel-single">
                            <div class="logo-box">
                                <img src="img/cl16.png" alt="">
                            </div><!-- ends: .logo-box -->
                            <div class="logo-box">
                                <img src="img/cl17.png" alt="">
                            </div><!-- ends: .logo-box -->
                        </div><!-- end: .carousel-single -->
                        <div class="carousel-single">
                            <div class="logo-box">
                                <img src="img/cl14.png" alt="">
                            </div><!-- ends: .logo-box -->
                            <div class="logo-box">
                                <img src="img/cl15.png" alt="">
                            </div><!-- ends: .logo-box -->
                        </div><!-- end: .carousel-single -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="p-top-95 p-bottom-95">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="testimonial-carousel-five owl-carousel">
                        <div class="carousel-single">
                            <div class="author-text">
                                <p>Investig ationes demons trave runt lectores legere lius awquod he legunt saepius clary tyitas Investig ationes demon trave rungt. Investig ationes mons trave arunty lector ompanies ationes that are leaders.</p>
                            </div>
                            <div class="author-spec d-flex">
                                <div class="author-img">
                                    <img src="img/client5.jpg" alt="" class="rounded-circle">
                                </div>
                                <div class="author-desc">
                                    <h6>Jeff Collins</h6>
                                    <span class="color-secondary">aazztech.com</span>
                                </div>
                            </div>
                        </div><!-- end: .carousel-single -->
                        <div class="carousel-single">
                            <div class="author-text">
                                <p>Investig ationes demons trave runt lectores legere lius awquod he legunt saepius clary tyitas Investig ationes demon trave rungt. Investig ationes mons trave arunty lector ompanies ationes that are leaders.</p>
                            </div>
                            <div class="author-spec d-flex">
                                <div class="author-img">
                                    <img src="img/client3.jpg" alt="" class="rounded-circle">
                                </div>
                                <div class="author-desc">
                                    <h6>Bob Andrews</h6>
                                    <span class="color-secondary">finance.com</span>
                                </div>
                            </div>
                        </div><!-- end: .carousel-single -->
                        <div class="carousel-single">
                            <div class="author-text">
                                <p>Investig ationes demons trave runt lectores legere lius awquod he legunt saepius clary tyitas Investig ationes demon trave rungt. Investig ationes mons trave arunty lector ompanies ationes that are leaders.</p>
                            </div>
                            <div class="author-spec d-flex">
                                <div class="author-img">
                                    <img src="img/client1.jpg" alt="" class="rounded-circle">
                                </div>
                                <div class="author-desc">
                                    <h6>Jeff Collins</h6>
                                    <span class="color-secondary">aazztech.com</span>
                                </div>
                            </div>
                        </div><!-- end: .carousel-single -->
                        <div class="carousel-single">
                            <div class="author-text">
                                <p>Investig ationes demons trave runt lectores legere lius awquod he legunt saepius clary tyitas Investig ationes demon trave rungt. Investig ationes mons trave arunty lector ompanies ationes that are leaders.</p>
                            </div>
                            <div class="author-spec d-flex">
                                <div class="author-img">
                                    <img src="img/client2.jpg" alt="" class="rounded-circle">
                                </div>
                                <div class="author-desc">
                                    <h6>Bob Andrews</h6>
                                    <span class="color-secondary">finance.com</span>
                                </div>
                            </div>
                        </div><!-- end: .carousel-single -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-bg p-top-100 p-bottom-80">
        <div class="m-bottom-50">
            <div class="divider text-center">
                <h1 class="color-dark">Business Experts</h1>
                <p class="mx-auto d-none"></p>
            </div>
        </div>
        <div class="card-style section-bg team--card3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="card card--team3">
                            <div class="card__thumbnail">
                                <img src="img/t8.jpg" alt="">
                            </div>
                            <div class="card-body text-center">
                                <h6><a href="team-single.html">Amanda Richards</a></h6>
                                <span class="subtitle">Customer Relations</span>
                                <p>Investig ationes demons trave runt lectores legere liusry quod ii legunt saepius claritas Investig ationes.</p>
                                <div class="social-basic ">
                                    <ul class="d-flex justify-content-center ">
                                        <li><a href="#"><span class="fab fa-facebook-f"></span></a></li>
                                        <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                                        <li><a href="#"><span class="fab fa-linkedin-in"></span></a></li>
                                        <li><a href="#"><span class="fab fa-google-plus-g"></span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div><!-- End: .card -->
                    </div><!-- ends: .col-lg-4 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="card card--team3">
                            <div class="card__thumbnail">
                                <img src="img/t9.jpg" alt="">
                            </div>
                            <div class="card-body text-center">
                                <h6><a href="team-single.html">Jack Semper</a></h6>
                                <span class="subtitle">Accountant</span>
                                <p>Investig ationes demons trave runt lectores legere liusry quod ii legunt saepius claritas Investig ationes.</p>
                                <div class="social-basic ">
                                    <ul class="d-flex justify-content-center ">
                                        <li><a href="#"><span class="fab fa-facebook-f"></span></a></li>
                                        <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                                        <li><a href="#"><span class="fab fa-linkedin-in"></span></a></li>
                                        <li><a href="#"><span class="fab fa-google-plus-g"></span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div><!-- End: .card -->
                    </div><!-- ends: .col-lg-4 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="card card--team3">
                            <div class="card__thumbnail">
                                <img src="img/t10.jpg" alt="">
                            </div>
                            <div class="card-body text-center">
                                <h6><a href="team-single.html">Philip Wilson</a></h6>
                                <span class="subtitle">Customer Relations</span>
                                <p>Investig ationes demons trave runt lectores legere liusry quod ii legunt saepius claritas Investig ationes.</p>
                                <div class="social-basic ">
                                    <ul class="d-flex justify-content-center ">
                                        <li><a href="#"><span class="fab fa-facebook-f"></span></a></li>
                                        <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                                        <li><a href="#"><span class="fab fa-linkedin-in"></span></a></li>
                                        <li><a href="#"><span class="fab fa-google-plus-g"></span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div><!-- End: .card -->
                    </div><!-- ends: .col-lg-4 -->
                </div><!-- ends: .row -->
            </div>
        </div><!-- ends: .card-style -->
    </section>
    <section class="section-news p-top-100 p-bottom-80">
        <div class="m-bottom-50">
            <div class="divider text-center">
                <h1 class="color-dark">Industry News</h1>
                <p class="mx-auto d-none"></p>
            </div>
        </div>
        <div class="post--card1">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="card post--card ">
                            <figure>
                                <a href=""><img src="img/c4.jpg" alt=""></a>
                            </figure>
                            <div class="card-body">
                                <h6><a href="">How to Run a Successful Business Meeting</a></h6>
                                <ul class="post-meta d-flex">
                                    <li>Aug 12, 2019</li>
                                    <li>in <a href="">Industry</a></li>
                                </ul>
                                <p>Investig ationes demons trave runt lectores legere liusry quod ii legunt saepius claritas Investig ationes.</p>
                            </div>
                        </div><!-- End: .card -->
                    </div><!-- ends: .col-lg-4 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="card post--card ">
                            <figure>
                                <a href=""><img src="img/c5.jpg" alt=""></a>
                            </figure>
                            <div class="card-body">
                                <h6><a href="">Exciting New Technologies Business Communication</a></h6>
                                <ul class="post-meta d-flex">
                                    <li>Aug 12, 2019</li>
                                    <li>in <a href="">Industry</a></li>
                                </ul>
                                <p>Investig ationes demons trave runt lectores legere liusry quod ii legunt saepius claritas Investig ationes.</p>
                            </div>
                        </div><!-- End: .card -->
                    </div><!-- ends: .col-lg-4 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="card post--card ">
                            <figure>
                                <a href=""><img src="img/c6.jpg" alt=""></a>
                            </figure>
                            <div class="card-body">
                                <h6><a href="">Global Automative Market Grows to $600 Billion</a></h6>
                                <ul class="post-meta d-flex">
                                    <li>Aug 12, 2019</li>
                                    <li>in <a href="">Industry</a></li>
                                </ul>
                                <p>Investig ationes demons trave runt lectores legere liusry quod ii legunt saepius claritas Investig ationes.</p>
                            </div>
                        </div><!-- End: .card -->
                    </div><!-- ends: .col-lg-4 -->
                </div><!-- ends: .row -->
            </div>
        </div><!-- ends: .post--card1 -->
    </section>
    <section class="form-wrapper section-bg contact--from3 p-top-100 p-bottom-110">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="m-bottom-65">
                        <div class="divider text-center">
                            <h1 class="color-dark">Request A Call Back</h1>
                            <p class="mx-auto d-none"></p>
                        </div>
                    </div>
                    <div class="form-wrapper">
                        <form action="#">
                            <div class="row">
                                <div class="col-lg-4 col-md-6 m-bottom-20">
                                    <input type="text" placeholder="Your Name" class="form-control fc--rounded border-0" required>
                                </div>
                                <div class="col-lg-4 col-md-6 m-bottom-20">
                                    <input type="text" placeholder="Phone Number" class="form-control fc--rounded border-0" required>
                                </div>
                                <div class="col-lg-4 m-bottom-20">
                                    <div class="form-group">
                                        <div class="select-basic">
                                            <select class="form-control fc--rounded border-0">
                                                <option>Business Planning</option>
                                                <option>Option 1</option>
                                                <option>Option 2</option>
                                                <option>Option 3</option>
                                                <option>Option 4</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 text-center m-top-30">
                                    <button class="btn btn-primary btn--rounded">Request Now</button>
                                </div>
                            </div>
                        </form>
                    </div><!-- end: .form-wrapper -->
                </div>
            </div>
        </div>
    </section><!-- ends: .form-wrapper -->
@endsection
