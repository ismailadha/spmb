@extends('frontend.main')

@section('content')
    <!-- Main Slider -->
        <div class="rev-slider">
			<div id="rev_slider_265_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container errow-style-1" data-alias="" data-source="gallery" style="margin:0px auto;background:transparent;padding:0px;margin-top:0px;margin-bottom:0px;">
			<!-- START REVOLUTION SLIDER 5.4.6.3 fullwidth mode -->
			<div id="rev_slider_265_1" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.4.6.3">

                <ul>  <!-- SLIDE  -->
                    @foreach ($sliders as $slider)
					<li data-index="rs-100" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="300" data-thumb="{{ asset('Storage/' . $slider->gambar) }}" data-rotate="0" data-saveperformance="off" data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
						<!-- MAIN IMAGE -->
						<img src="{{ asset('Storage/' . $slider->gambar) }}" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
					</li>
                    @endforeach
				</ul>

				<div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div> </div>
			</div>
		</div>
        <!-- Main Slider -->
		<div class="content-block">
            <!-- About Us -->
            <div class="section-full industry-service" style="background-image:url(images/background/bg17.jpg)">
                <div class="container">
                    <div class="row m-b80">
						<div class="col-lg-4 col-md-4">
							<div class="icon-bx-wraper ind-ser-bx">
								<div class="icon-lg m-b10">
									<a href="javascript:void(0);" class="icon-cell text-primary"><i class="flaticon-operation"></i></a>
								</div>
								<div class="icon-content">
									<h3 class="dlab-tilte">Dedicated Teams</h3>
									<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry..</p>
								</div>
								<a href="javascript:void(0);" class="site-button btn-block d-flex justify-content-between"><span>Read More</span> <i class="ti-arrow-right"></i></a>
							</div>
						</div>
						<div class="col-lg-4 col-md-4">
							<div class="icon-bx-wraper ind-ser-bx active">
								<div class="icon-lg m-b10">
									<a href="javascript:void(0);" class="icon-cell text-primary"><i class="flaticon-network"></i></a>
								</div>
								<div class="icon-content">
									<h3 class="dlab-tilte">True Partners</h3>
									<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry..</p>
								</div>
								<a href="javascript:void(0);" class="site-button btn-block d-flex justify-content-between"><span>Read More</span> <i class="ti-arrow-right"></i></a>
							</div>
						</div>
						<div class="col-lg-4 col-md-4">
							<div class="icon-bx-wraper ind-ser-bx">
								<div class="icon-lg m-b10">
									<a href="javascript:void(0);" class="icon-cell text-primary"><i class="flaticon-mind"></i></a>
								</div>
								<div class="icon-content">
									<h3 class="dlab-tilte">Focus On Innovation</h3>
									<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry..</p>
								</div>
								<a href="javascript:void(0);" class="site-button btn-block d-flex justify-content-between"><span>Read More</span> <i class="ti-arrow-right"></i></a>
							</div>
						</div>
					</div>
					<div class="row d-flex align-items-center">
						<div class="col-lg-5 col-md-12 m-b30">
							<h2 class="box-title m-t0 m-b20 font-40"><span class="font-weight-400">About </span><br>Our Company</h2>
							<p class="m-b20">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
							<a href="javascript:void(0);" class="site-button button-md">Read More</a>
						</div>
						<div class="col-lg-7 col-md-12">
							<img src="images/about/pic11.jpg" class="radius-sm" alt="">
						</div>
					</div>
                </div>
            </div>
			<!-- About Us End -->
			<!-- Why Chose Us -->
			<div class="section-full bg-blue-light content-inner explore-projects" style="background-image:url(images/background/bg3.png)">
				<div class="container">
					<div class="section-content">
						<div class="row">
							<div class="col-md-12 col-lg-12 section-head text-center">
								<h2 class="m-b0 font-40"><span class="font-weight-400">Explore</span> Projects</h2>
								<p class="m-b0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the.</p>
							</div>
						</div>
						<!-- blog post Carousel with no margin -->
						<div class="row">
							<div class="explore-carousel mfp-gallery owl-loaded owl-theme owl-carousel gallery owl-btn-center-lr owl-btn-2 primary">
								<div class="item">
									<div class="dlab-box">
										<div class="dlab-media dlab-img-effect rotate"> <a href="javascript:void(0);"><img src="images/our-services/industry/pic1.jpg" alt=""></a> </div>
										<div class="dlab-info bg-white">
											<h5 class="dlab-title m-t0"><a href="javascript:void(0);">Epcot Park</a></h5>
											<p class="m-b0">Lorem ipsum dolor Fusce varius euismod lacus eget feugiat rorem ipsum dolor consectetur...</p>
										</div>
										<a href="javascript:void(0);" class="site-button btn-block d-flex justify-content-between white"><span>Read More</span> <i class="ti-arrow-right"></i></a>
									</div>
								</div>
								<div class="item">
									<div class="dlab-box">
										<div class="dlab-media dlab-img-effect rotate"> <a href="javascript:void(0);"><img src="images/our-services/industry/pic2.jpg" alt=""></a> </div>
										<div class="dlab-info bg-white">
											<h5 class="dlab-title m-t0"><a href="javascript:void(0);">Tokyo Bridg</a></h5>
											<p class="m-b0">Lorem ipsum dolor Fusce varius euismod lacus eget feugiat rorem ipsum dolor consectetur...</p>
										</div>
										<a href="javascript:void(0);" class="site-button btn-block d-flex justify-content-between white"><span>Read More</span> <i class="ti-arrow-right"></i></a>
									</div>
								</div>
								<div class="item">
									<div class="dlab-box">
										<div class="dlab-media dlab-img-effect rotate"> <a href="javascript:void(0);"><img src="images/our-services/industry/pic3.jpg" alt=""></a> </div>
										<div class="dlab-info bg-white">
											<h5 class="dlab-title m-t0"><a href="javascript:void(0);">Baptist Church</a></h5>
											<p class="m-b0">Lorem ipsum dolor Fusce varius euismod lacus eget feugiat rorem ipsum dolor consectetur...</p>
										</div>
										<a href="javascript:void(0);" class="site-button btn-block d-flex justify-content-between white"><span>Read More</span> <i class="ti-arrow-right"></i></a>
									</div>
								</div>
								<div class="item">
									<div class="dlab-box">
										<div class="dlab-media dlab-img-effect rotate"> <a href="javascript:void(0);"><img src="images/our-services/industry/pic1.jpg" alt=""></a> </div>
										<div class="dlab-info bg-white">
											<h5 class="dlab-title m-t0"><a href="javascript:void(0);">Epcot Park</a></h5>
											<p class="m-b0">Lorem ipsum dolor Fusce varius euismod lacus eget feugiat rorem ipsum dolor consectetur...</p>
										</div>
										<a href="javascript:void(0);" class="site-button btn-block d-flex justify-content-between white"><span>Read More</span> <i class="ti-arrow-right"></i></a>
									</div>
								</div>
								<div class="item">
									<div class="dlab-box">
										<div class="dlab-media dlab-img-effect rotate"> <a href="javascript:void(0);"><img src="images/our-services/industry/pic2.jpg" alt=""></a> </div>
										<div class="dlab-info bg-white">
											<h5 class="dlab-title m-t0"><a href="javascript:void(0);">Tokyo Bridg</a></h5>
											<p class="m-b0">Lorem ipsum dolor Fusce varius euismod lacus eget feugiat rorem ipsum dolor consectetur...</p>
										</div>
										<a href="javascript:void(0);" class="site-button btn-block d-flex justify-content-between white"><span>Read More</span> <i class="ti-arrow-right"></i></a>
									</div>
								</div>
								<div class="item">
									<div class="dlab-box">
										<div class="dlab-media dlab-img-effect rotate"> <a href="javascript:void(0);"><img src="images/our-services/industry/pic3.jpg" alt=""></a> </div>
										<div class="dlab-info bg-white">
											<h5 class="dlab-title m-t0"><a href="javascript:void(0);">Baptist Church</a></h5>
											<p class="m-b0">Lorem ipsum dolor Fusce varius euismod lacus eget feugiat rorem ipsum dolor consectetur...</p>
										</div>
										<a href="javascript:void(0);" class="site-button btn-block d-flex justify-content-between white"><span>Read More</span> <i class="ti-arrow-right"></i></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Why Chose Us End -->
			<div class="section-full overlay-black-dark our-projects" style="background-image:url(images/background/bg3.jpg)">
				<div class="container text-white">
					<div class="row m-lr0 d-flex align-items-stretch">
						<div class="col-lg-4 col-md-4 p-lr0 d-flex ind-ser-info-bx">
							<div class="ind-service-info align-self-stretch">
								<span>01</span>
								<div class="ind-service-info-in">
									<h2><span>World Class</span>Technology</h2>
									<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of.</p>
								</div>
								<a href="javascript:void(0);" class="site-button btn-block d-flex justify-content-between white outline outline-2"><span>Read More</span> <i class="ti-arrow-right"></i></a>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 p-lr0 d-flex ind-ser-info-bx">
							<div class="ind-service-info align-self-stretch">
								<span>02</span>
								<div class="ind-service-info-in">
									<h2><span>Quality </span>Standart</h2>
									<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of.</p>
								</div>
								<a href="javascript:void(0);" class="site-button btn-block d-flex justify-content-between white outline outline-2"><span>Read More</span> <i class="ti-arrow-right"></i></a>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 p-lr0 d-flex ind-ser-info-bx">
							<div class="ind-service-info align-self-stretch">
								<span>03</span>
								<div class="ind-service-info-in">
									<h2><span>Productive</span>Capacity</h2>
									<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of.</p>
								</div>
								<a href="javascript:void(0);" class="site-button btn-block d-flex justify-content-between white outline outline-2"><span>Read More</span> <i class="ti-arrow-right"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Our Portfolio -->
			<div class="section-full p-tb15 our-support content-inner-2" style="background-image:url(images/background/bg19.jpg); background-repeat:no-repeat; background-size:100%; background-position:bottom;">
                <div class="container">
					<div class="row">
						<div class="col-md-12 col-lg-12 section-head text-center">
							<h2 class="m-b0 font-40"><span class="font-weight-400">Contact</span> Us</h2>
							<p class="m-b0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the.</p>
						</div>
					</div>
					<div class="support-box-form bg-primary">
						<div class="row m-lr0">
							<div class="col-lg-6 p-lr0 d-flex">
								<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d57803.76927259502!2d75.78311389999999!3d25.110810700000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1540556893926" class="d-flex align-items-stretch" style="border:0; width:100%; min-height:350px;" allowfullscreen></iframe>
							</div>
							<div class="col-lg-6">
								<div class="support-form">
									<div class="support-title text-white m-b30">
										<h6 class="text-uppercase font-weight-500 m-b10">Support</h6>
										<h2 class="font-40 font-weight-400 m-tb0">Need Help?</h2>
										<p class="font-14">Contact our customer support team if you have any questions.</p>
									</div>
									<div class="dezPlaceAni">
										<form method="post" class="dzForm" action="script/contact_smtp.php">
											<div class="dzFormMsg"></div>
											<input type="hidden" class="form-control" name="dzToDo" value="Contact" >
											<input type="hidden" class="form-control" name="reCaptchaEnable" value="0" >

											<div class="row">
												<div class="col-lg-6 col-md-6 col-sm-6 col-12">
													<div class="form-group">
														<div class="input-group">
															<label>Your Name</label>
															<input name="dzName" type="text" required class="form-control" placeholder="">
														</div>
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6 col-12">
													<div class="form-group">
														<div class="input-group">
															<label>Phone</label>
															<input name="dzPhoneNumber" type="text" required class="form-control" placeholder="">
														</div>
													</div>
												</div>
												<div class="col-lg-12 col-md-12 col-sm-12 col-12">
													<div class="form-group">
														<div class="input-group">
															<label>Your Email Address</label>
															<input name="dzEmail" type="email" class="form-control" required  placeholder="" >
														</div>
													</div>
												</div>
												<div class="col-lg-12 col-md-12 col-sm-12 col-12">
													<div class="form-group">
														<div class="input-group">
															<label>Your Message...</label>
															<textarea name="dzMessage" rows="4" class="form-control" required placeholder=""></textarea>
														</div>
													</div>
												</div>
												<div class="col-lg-12 col-md-12 col-sm-12">
													<button name="submit" type="submit" value="Submit" class="site-button white button-md m-t10">Submit Now</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
            </div>
			<!-- Our Portfolio END -->
			<!-- Testimonials -->
			<div class="section-full content-inner ind-client" style="background-image:url(images/background/bg18.jpg); background-position:bottom;">
                <div class="container">
					<div class="row d-flex align-items-center">
						<div class="col-md-4 section-head">
							<h2 class="box-title m-t0 m-b10 font-40"><span class="font-weight-400">Our</span><br> Testimonials</h2>
							<p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry.</p>
							<a href="javascript:void(0);" class="site-button button-md">View Client</a>
						</div>
						<div class="col-md-8">
							<div class="row">
								<div class="testimonial-box item-center1 owl-loaded owl-theme owl-carousel owl-none mfp-gallery owl-dots-black-full">
									<div class="item">
										<div class="testimonial-8">
											<div class="testimonial-text">
												<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the when an printer took a galley of type and scrambled it to make [...]</p>
											</div>
											<div class="testimonial-detail clearfix">
												<div class="testimonial-pic radius shadow">
													<img src="images/testimonials/pic2.jpg" width="100" height="100" alt="">
												</div>
												<h5 class="testimonial-name m-t0 m-b5">Mr. Jone Deo</h5>
												<span>Client</span>
											</div>
										</div>
									</div>
									<div class="item">
										<div class="testimonial-8">
											<div class="testimonial-text">
												<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the when an printer took a galley of type and scrambled it to make [...]</p>
											</div>
											<div class="testimonial-detail clearfix">
												<div class="testimonial-pic radius shadow">
													<img src="images/testimonials/pic3.jpg" width="100" height="100" alt="">
												</div>
												<h5 class="testimonial-name m-t0 m-b5">Mr. Jone Deo</h5>
												<span>Client</span>
											</div>
										</div>
									</div>
									<div class="item">
										<div class="testimonial-8">
											<div class="testimonial-text">
												<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the when an printer took a galley of type and scrambled it to make [...]</p>
											</div>
											<div class="testimonial-detail clearfix">
												<div class="testimonial-pic radius shadow">
													<img src="images/testimonials/pic2.jpg" width="100" height="100" alt="">
												</div>
												<h5 class="testimonial-name m-t0 m-b5">Mr. Jone Deo</h5>
												<span>Client</span>
											</div>
										</div>
									</div>
									<div class="item">
										<div class="testimonial-8">
											<div class="testimonial-text">
												<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the when an printer took a galley of type and scrambled it to make [...]</p>
											</div>
											<div class="testimonial-detail clearfix">
												<div class="testimonial-pic radius shadow">
													<img src="images/testimonials/pic3.jpg" width="100" height="100" alt="">
												</div>
												<h5 class="testimonial-name m-t0 m-b5">Mr. Jone Deo</h5>
												<span>Client</span>
											</div>
										</div>
									</div>
									<div class="item">
										<div class="testimonial-8">
											<div class="testimonial-text">
												<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the when an printer took a galley of type and scrambled it to make [...]</p>
											</div>
											<div class="testimonial-detail clearfix">
												<div class="testimonial-pic radius shadow">
													<img src="images/testimonials/pic2.jpg" width="100" height="100" alt="">
												</div>
												<h5 class="testimonial-name m-t0 m-b5">Mr. Jone Deo</h5>
												<span>Client</span>
											</div>
										</div>
									</div>
									<div class="item">
										<div class="testimonial-8">
											<div class="testimonial-text">
												<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the when an printer took a galley of type and scrambled it to make [...]</p>
											</div>
											<div class="testimonial-detail clearfix">
												<div class="testimonial-pic radius shadow">
													<img src="images/testimonials/pic3.jpg" width="100" height="100" alt="">
												</div>
												<h5 class="testimonial-name m-t0 m-b5">Mr. Jone Deo</h5>
												<span>Client</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Testimonials END -->
			<div class="section-full add-to-call bg-primary p-tb30">
				<div class="container">
					<div class="d-lg-flex d-sm-block justify-content-between align-items-center">
						<h2 class="m-b10 m-t10 text-white">Reliable Engineering Takes Many Forms</h2>
						<div><a href="javascript:void(0);" class="site-button button-md white">Learn More</a></div>
					</div>
				</div>
			</div>
        </div>
		<!-- contact area END -->
@endsection
