<!DOCTYPE html>
<html lang="en">
<head>

	<!-- PAGE TITLE HERE -->
	<title>SPMB Tahun {{ now()->format('Y') }}</title>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="author" content="DexignZone">
	<meta name="robots" content="">

	<meta name="keywords" content="agency, business, company, corporate, creative, finance, multipurpose, one page, parallax, personal, portfolio, responsive, resume, template, unique">
	<meta name="description" content="Agency : is a unique design template which is crafted specially for creative agency, corporate firms, professional businesses. Template theme is specially design for all types of business and have multiple color theme for different types of people.">
	<meta property="og:title" content="Agency | Creative Multipurpose HTML with RTL Ready">
	<meta property="og:description" content="Agency : is a unique design template which is crafted specially for creative agency, corporate firms, professional businesses. Template theme is specially design for all types of business and have multiple color theme for different types of people." >
	<meta property="og:image" content="https://agency.dexignzone.com/xhtml/social-image.png">
	<meta name="format-detection" content="telephone=no">

	<!-- FAVICONS ICON -->
	<link rel="icon" href="{{ asset('front/images/favicon.ico') }}" type="image/x-icon">
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('front/images/favicon.png') }}">

	<!-- MOBILE SPECIFIC -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- STYLESHEETS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('front/css/plugins.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('front/css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('front/css/templete.css') }}">
	<link class="skin" rel="stylesheet" type="text/css" href="{{ asset('front/css/skin/color/skin-5.css') }}">

	<!-- Revolution Slider Css -->
	<link rel="stylesheet" type="text/css" href="{{ asset('front/plugins/revolution/revolution/css/settings.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('front/plugins/revolution/revolution/css/navigation.css') }}">

</head>
<body id="bg">
<div class="page-wraper">
<div id="loading-area" class="loading-page-1">
	<div class="spinner">
		<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
		<circle cx="8" cy="8" r="7" stroke-width="1"/>
		</svg>
	</div>
</div>
	<!-- header -->
    <header class="site-header header mo-left header-ind">
		<div class="top-bar bg-dark">
			<div class="container">
				<div class="row d-flex justify-content-between">
					<div class="dlab-topbar-left">
						<ul>
							<li><i class="flaticon-phone-call m-r5"></i> 001 1234 6789</li>
						</ul>
					</div>
					<div class="dlab-topbar-right">
						<ul>
							<li><i class="ti-email m-r5"></i> info@example.com</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- main header -->
        <div class="sticky-header main-bar-wraper navbar-expand-lg">
            <div class="main-bar clearfix ">
                <div class="container clearfix">
                    <!-- website logo -->
                    <div class="logo-header mostion logo-dark">
						<a href="{{ url('/') }}" class="dez-page"><img src="{{ asset('images/spmb-logo.png') }}" alt=""></a>
					</div>
                    <!-- nav toggle button -->
                    <button class="navbar-toggler collapsed navicon justify-content-end" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
						<span></span>
						<span></span>
						<span></span>
					</button>
                    <!-- extra nav -->
                    <div class="extra-nav">
                        <div class="extra-cell">
                            <a href="contact.html" class="dez-page site-button primary">Daftar Akun </a>
                        </div>
                    </div>
                    <!-- main nav -->
                    <div class="header-nav navbar-collapse collapse justify-content-end" id="navbarNavDropdown">
                        <ul class="nav navbar-nav">
							<li><a href="{{ url('/') }}">Beranda</a>
							</li>
							<li><a href="javascript:void(0);">Informasi <i class="fa fa-chevron-down"></i></a>
								<ul class="sub-menu">
									<li><a href="{{ url('juknis') }}" class="dez-page">Petunjuk Teknis</a></li>
									<li><a href="{{ url('persyaratan') }}" class="dez-page">Persyaratan</a></li>
                                    <li><a href="{{ url('datasekolah') }}" class="dez-page">Data Sekolah</a></li>
								</ul>
							</li>
                            <li><a href="javascript:void(0);">Peta Zonasi <i class="fa fa-chevron-down"></i></a>
								<ul class="sub-menu">
									<li><a href="" class="dez-page">SD</a></li>
									<li><a href="services-details.html" class="dez-page">SMP</a></li>
								</ul>
							</li>
                            <li><a href="javascript:void(0);">Hasil Seleksi <i class="fa fa-chevron-down"></i></a>
								<ul class="sub-menu">
									<li><a href="" class="dez-page">SD</a></li>
									<li><a href="services-details.html" class="dez-page">SMP</a></li>
								</ul>
							</li>
                            <li><a href="javascript:void(0);">Pendaftaran <i class="fa fa-chevron-down"></i></a>
								<ul class="sub-menu">
									<li><a href="" class="dez-page">Pembuatan Akun</a></li>
									<li><a href="services-details.html" class="dez-page">Pendaftaran Peserta</a></li>
								</ul>
							</li>
						</ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- main header END -->
    </header>
    <!-- header END -->
    <!-- Content -->
    <div class="page-content bg-white rubik-font">
       @yield('content')
    </div>
    <!-- Content END-->
	<!-- Footer -->
    <footer class="site-footer text-uppercase footer-white">
        <div class="footer-top">
            <div class="container">
                <div class="row">
					<div class="col-5 col-lg-2 col-md-6 col-sm-6 footer-col-4">
                        <div class="widget widget_services border-0">
                            <h5 class="m-b30 text-white">Halaman</h5>
                            <ul>
                                <li><a href="about-1.html">Beranda </a></li>
                                <li><a href="index.html">Home </a></li>
                                <li><a href="contact.html">Contact Us</a></li>
                                <li><a href="about-1.html">About Us</a></li>
                                <li><a href="service.html">Our Services</a></li>
                            </ul>
                        </div>
                    </div>
					<div class="col-7 col-lg-2 col-md-6 col-sm-6 footer-col-4">
                        <div class="widget widget_services border-0">
                            <h5 class="m-b30 text-white">Tautan</h5>
                            <ul>
                                <li><a href="index.html">Create Account</a></li>
                                <li><a href="index.html">Company Philosophy </a></li>
                                <li><a href="contact.html">Corporate Culture</a></li>
                                <li><a href="about-1.html">Portfolio</a></li>
                                <li><a href="project-details.html">Project Details</a></li>
                            </ul>
                        </div>
                    </div>
					<div class="col-lg-4 col-md-6 col-sm-6 footer-col-4">
                        <div class="widget widget_getintuch">
                            <h5 class="m-b30 text-white ">Contact us</h5>
                            <ul>
                                <li><i class="ti-location-pin"></i><strong>address</strong> demo address #8901 Marmora Road Chi Minh City, Vietnam </li>
                                <li><i class="ti-mobile"></i><strong>phone</strong>0800-123456 (24/7 Support Line)</li>
								<li><i class="ti-email"></i><strong>email</strong>info@example.com</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 footer-col-4 ">
                        <div class="widget">
                            <h5 class="m-b30 text-white">Subscribe To Our Newsletter</h5>
							<p class="text-capitalize m-b20">If you have any questions, you can contact with us so that we can give you a satisfying answer. Subscribe to our newsletter to get our latest products.</p>
                            <div class="subscribe-form m-b20">
								<form class="dzSubscribe" action="script/mailchamp.php" method="post">
									<div class="dzSubscribeMsg"></div>
									<div class="input-group">
										<input name="dzEmail" required="required"  class="form-control" placeholder="Your Email Address" type="email">
										<span class="input-group-btn">
											<button name="submit" value="Submit" type="submit" class="site-button">Subscribe</button>
										</span>
									</div>
								</form>
							</div>
							<ul class="list-inline m-a0">
								<li><a href="https://www.facebook.com/" target="_blank" class="site-button facebook circle "><i class="fab fa-facebook-f"></i></a></li>
								<li><a href="https://www.behance.net/" target="_blank" class="site-button behance circle "><i class="fab fa-behance"></i></a></li>
								<li><a href="https://www.linkedin.com/" target="_blank" class="site-button linkedin circle "><i class="fab fa-linkedin-in"></i></a></li>
								<li><a href="https://www.instagram.com/" target="_blank" class="site-button instagram circle "><i class="fab fa-instagram"></i></a></li>
								<li><a href="https://www.twitter.com/" target="_blank" class="site-button twitter circle "><i class="fab fa-twitter"></i></a></li>
							</ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer bottom part -->
        <div class="footer-bottom bg-primary">
            <div class="container">
                <div class="row">
                   <div class="col-lg-6 col-md-6 col-sm-6 text-left "> <span>Copyright © <span class="current-year">{{ now()->format('Y') }}</span> Dinas Pendidikan dan Kebudayaan Kota Lhokseumawe</span></div>
                    <div class="col-lg-6 col-md-6 col-sm-6 text-right ">
						<div class="widget-link ">
							<ul>
								<li><a href="javascript:void(0);"> Help Desk</a></li>
								<li><a href="javascript:void(0);"> Privacy Policy</a></li>
							</ul>
						</div>
					</div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer END-->
    <button class="scroltop fa fa-chevron-up" ></button>
</div>
<!-- JAVASCRIPT FILES ========================================= -->
<script src="{{ asset('front/js/jquery.min.js') }}"></script><!-- JQUERY.MIN JS -->
<script src="{{ asset('front/plugins/wow/wow.js') }}"></script><!-- WOW JS -->

<script src="{{ asset('front/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script><!-- BOOTSTRAP.MIN JS -->
<script src="{{ asset('front/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script><!-- FORM JS -->
<script src="{{ asset('front/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js') }}"></script><!-- FORM JS -->
<script src="{{ asset('front/plugins/magnific-popup/magnific-popup.js') }}"></script><!-- MAGNIFIC POPUP JS -->
<script src="{{ asset('front/plugins/counter/waypoints-min.js') }}"></script><!-- WAYPOINTS JS -->
<script src="{{ asset('front/plugins/counter/counterup.min.js') }}"></script><!-- COUNTERUP JS -->
<script src="{{ asset('front/plugins/imagesloaded/imagesloaded.js') }}"></script><!-- IMAGESLOADED -->
<script src="{{ asset('front/plugins/masonry/masonry-4.2.2.js') }}"></script><!-- MASONRY -->
<script src="{{ asset('front/plugins/masonry/isotope.pkgd.min.js') }}"></script><!-- MASONRY -->
<script src="{{ asset('front/plugins/owl-carousel/owl.carousel.js') }}"></script><!-- OWL SLIDER -->
<script src="{{ asset('front/plugins/rangeslider/rangeslider.js') }}" ></script><!-- Rangeslider -->
<script src="{{ asset('front/js/custom.js') }}"></script><!-- CUSTOM FUCTIONS  -->
<script src="{{ asset('front/js/dz.carousel.js') }}"></script><!-- SORTCODE FUCTIONS  -->
<script src="{{ asset('front/plugins/loading/anime.js') }}"></script><!-- LOADING JS -->
<script src="{{ asset('front/plugins/loading/anime-app3.js') }}"></script><!-- LOADING JS -->
<script src="{{ asset('front/js/dz.ajax.js') }}"></script><!-- CONTACT JS  -->
 <!-- revolution JS FILES -->
<script src="{{ asset('front/plugins/revolution/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
<script src="{{ asset('front/plugins/revolution/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>
<!-- Slider revolution 5.0 Extensions  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->
<script src="{{ asset('front/plugins/revolution/revolution/js/extensions/revolution.extension.actions.min.js') }}"></script>
<script src="{{ asset('front/plugins/revolution/revolution/js/extensions/revolution.extension.carousel.min.js') }}"></script>
<script src="{{ asset('front/plugins/revolution/revolution/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
<script src="{{ asset('front/plugins/revolution/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
<script src="{{ asset('front/plugins/revolution/revolution/js/extensions/revolution.extension.migration.min.js') }}"></script>
<script src="{{ asset('front/plugins/revolution/revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
<script src="{{ asset('front/plugins/revolution/revolution/js/extensions/revolution.extension.parallax.min.js') }}"></script>
<script src="{{ asset('front/plugins/revolution/revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
<script src="{{ asset('front/plugins/revolution/revolution/js/extensions/revolution.extension.video.min.js') }}"></script>
<script  src="{{ asset('front/js/rev.slider.js') }}"></script>
<script>
jQuery(document).ready(function() {
	'use strict';
	dz_rev_slider_5();
});	/*ready*/
</script>


</body>
</html>
