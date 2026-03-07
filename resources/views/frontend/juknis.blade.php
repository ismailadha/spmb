@extends('frontend.main')

@section('content')
    <section class="breadcrumb_area breadcrumb2 bgimage biz_overlay">
        <div class="bg_image_holder">
            <img src="{{ asset('front/img/breadbg.jpg') }}" alt="">
        </div>
        <div class="container content_above">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb_wrapper d-flex flex-column align-items-center">
                        <h3 class="page_title">Petunjuk Teknis</h3>
                    </div>
                </div>
            </div><!-- ends: .row -->
        </div>
    </section>
    <section class="service-tab-wrapper section-padding">
        <div class="tab service--tabs">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 sidebar">
                        <div class="tab_nav tab_nav2 m-bottom-50">
                            <div class="nav flex-column" id="tab_nav1" role="tablist" aria-orientation="vertical">
                                <a class="nav-link active" id="v-pills-tab1" data-toggle="pill" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">Financial Analysis</a>
                                <a class="nav-link" id="v-pills-tab2" data-toggle="pill" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false">Investment Planning</a>
                                <a class="nav-link" id="v-pills-tab3" data-toggle="pill" href="#tab3" role="tab" aria-controls="tab3" aria-selected="false">Savings & Investments</a>
                                <a class="nav-link" id="v-pills-tab4" data-toggle="pill" href="#tab4" role="tab" aria-controls="tab4" aria-selected="false">Investment Planning</a>
                                <a class="nav-link" id="v-pills-tab5" data-toggle="pill" href="#tab5" role="tab" aria-controls="tab5" aria-selected="false">Online Consulting</a>
                                <a class="nav-link" id="v-pills-tab6" data-toggle="pill" href="#tab6" role="tab" aria-controls="tab6" aria-selected="false">Strategic Consulting</a>
                                <a class="nav-link" id="v-pills-tab7" data-toggle="pill" href="#tab7" role="tab" aria-controls="tab7" aria-selected="false">Business Process Services</a>
                            </div>
                        </div><!-- ends: .tab_nav -->
                        <div class="download-widget m-bottom-30">
                            <div class="header">
                                <h6>Company Brochure</h6>
                            </div>
                            <div class="content">
                                <img src="img/brochure.jpg" alt="">
                                <p>
                                    <a href="" class="btn btn-secondary btn-sm btn-icon icon-left"><i class="la la-cloud-download"></i> Download (PDF)</a>
                                    <span>165.64 KB</span>
                                </p>
                            </div>
                        </div><!-- ends: .download-widget -->
                        <div class="cta-widget m-bottom-50">
                            <h6>Any Question?</h6>
                            <div class="content">
                                <p class="call-us">
                                    <span>Call Us:</span>
                                    <span><i class="la la-headphones"></i> 800-567 890 576</span>
                                </p>
                                <p class="message-us">
                                    <span>Or</span>
                                    <a href="" class="btn btn-primary btn-sm btn-icon icon-left"><i class="la la-envelope"></i> Send Message</a>
                                </p>
                            </div>
                        </div><!-- ends: .cta-widget -->
                    </div><!-- ends: .col-lg-3 -->
                    <div class="col-lg-9">
                        <div class="tab-content" id="tabContent1">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                <div class="tab-image m-bottom-50">
                                    <img src="img/service1.jpg" alt="Images the foolda">
                                </div>
                                <div class="contents-1">
                                    <div class="m-bottom-30">
                                        <div class="divider divider-simple text-left">
                                            <h3>Financial Overview &amp; Analysis</h3>
                                        </div>
                                    </div>
                                    <p>Investiga tiones demonstr averun d lectores legere melius quod kequa legunt saepius. Claritas est etiam pro cessus dynamicus, qui sequitur mutatin onem consuetudium. Investiga tiones demonstr averunt lectores legere me liusked quod kequa legunt saepius. Claritas est etiam pro cessus. Sequitur mutatin onem consuetudium. Investiga tiones demonstr averunt lectores legere me lius quod ii qua legunt saepius. Claritas est etiam pro cessus.<br><br> Claritas est etiam pro cessus. Sequitur mutatin onem consuetudium. Investiga tiones demonstr aver unt lectores legere me lius quod ii qua legunt saepius. Claritas est etiam pro cessus.</p>
                                </div>
                                <div class="contents-2 m-top-60">
                                    <div class="m-bottom-35">
                                        <div class="divider divider-simple text-left">
                                            <h3>Our Services Include</h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="icon-box-four d-flex">
                                                <div class="box-icon">
                                                    <span class="icon-rounded-sm"><i class="la la-thumbs-up"></i></span>
                                                </div>
                                                <div class="box-content">
                                                    <h6>Valuable Ideas</h6>
                                                    <p>Investig ationes demons travge vunt lectores legere lyrus quodk legunt saepius claritas est.</p>
                                                </div>
                                            </div><!-- ends: .icon-box -->
                                        </div><!-- ends: .col-md-6 -->
                                        <div class="col-md-6">
                                            <div class="icon-box-four d-flex">
                                                <div class="box-icon">
                                                    <span class="icon-rounded-sm"><i class="la la-bar-chart"></i></span>
                                                </div>
                                                <div class="box-content">
                                                    <h6>Industry Experience</h6>
                                                    <p>Investig ationes demons travge vunt lectores legere lyrus quodk legunt saepius claritas est.</p>
                                                </div>
                                            </div><!-- ends: .icon-box -->
                                        </div><!-- ends: .col-md-6 -->
                                        <div class="col-md-6">
                                            <div class="icon-box-four d-flex">
                                                <div class="box-icon">
                                                    <span class="icon-rounded-sm"><i class="la la-money"></i></span>
                                                </div>
                                                <div class="box-content">
                                                    <h6>Budget Friendly</h6>
                                                    <p>Investig ationes demons travge vunt lectores legere lyrus quodk legunt saepius claritas est.</p>
                                                </div>
                                            </div><!-- ends: .icon-box -->
                                        </div><!-- ends: .col-md-6 -->
                                        <div class="col-md-6">
                                            <div class="icon-box-four d-flex">
                                                <div class="box-icon">
                                                    <span class="icon-rounded-sm"><i class="la la-sun-o"></i></span>
                                                </div>
                                                <div class="box-content">
                                                    <h6>Industry Experience</h6>
                                                    <p>Investig ationes demons travge vunt lectores legere lyrus quodk legunt saepius claritas est.</p>
                                                </div>
                                            </div><!-- ends: .icon-box -->
                                        </div><!-- ends: .col-md-6 -->
                                    </div>
                                </div>
                                <div class="contents-2 m-top-10">
                                    <div class="m-bottom-25">
                                        <div class="divider divider-simple text-left">
                                            <h3>Your Benefits</h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 margin-md-60">
                                            <p>Inves tiga tiones demonstr averun d lectores leg ere melius quod kequa legunt s aepius. Clar tas kdest etiam pro cessus dynamicus.</p>
                                            <ul class="m-top-30">
                                                <li class="bullet_list">Delivers solutions that help drive</li>
                                                <li class="bullet_list">Human capital research analytics</li>
                                                <li class="bullet_list">Complex problems bringing an approach</li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="pie-chart_wrap">
                                                <canvas class="pie-chart"></canvas>
                                                <div class="legend pie-legend legend-list"></div>
                                            </div><!-- End: .pie-chart_wrap -->
                                        </div>
                                    </div>
                                </div>
                                <div class="contents-2 m-top-90">
                                    <div class="m-bottom-45">
                                        <div class="divider divider-simple text-left">
                                            <h3>Insights and Impact</h3>
                                        </div>
                                    </div>
                                    <div class="tab tab--4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="tab_nav4">
                                                    <ul class="nav nav-tabs" id="tab9" role="tablist">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" id="tab9_nav1" data-toggle="tab" href="#tab9_content1" role="tab" aria-controls="tab9_nav1" aria-selected="true">Client Prospecting</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="tab9_nav2" data-toggle="tab" href="#tab9_content2" role="tab" aria-controls="tab9_nav2" aria-selected="false">Funding Research</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="tab9_nav3" data-toggle="tab" href="#tab9_content3" role="tab" aria-controls="tab9_nav3" aria-selected="false">Analytics</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!--end ./tab_nav4 -->
                                            </div>
                                        </div><!-- end /.row -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="tab-content tab--content4 tab--content9" id="tabcontent4">
                                                    <div class="tab-pane fade show active" id="tab9_content1" role="tabpanel" aria-labelledby="tab9_content1">
                                                        <div class="row no-gutters">
                                                            <div class="col-md-12">
                                                                <div class="text_content">
                                                                    <p>Investiga tiones demonstr averun d lectores legere melius quod kequa legunt
                                                                        saepius.
                                                                        Claritas est etiam pro cessus dynamicus, qui sequitur mutatin onem
                                                                        consuetudium.
                                                                        Investiga tiones demonstr averunt lectores legere me liusked quod kequa
                                                                        legunt
                                                                        saepius. Claritas est etiam pro cessus. Sequitur mutatin onem consuetudium.
                                                                        Investiga tiones demonstr averunt lectores legere me lius quod ii qua legunt
                                                                        saepius. Claritas est etiam pro cessus.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end ./tab-pane -->
                                                    <div class="tab-pane fade" id="tab9_content2" role="tabpanel" aria-labelledby="tab9_content2">
                                                        <div class="row no-gutters">
                                                            <div class="col-md-12">
                                                                <div class="text_content">
                                                                    <p>Investiga tiones demonstr averun d lectores legere melius quod kequa legunt
                                                                        saepius.
                                                                        Claritas est etiam pro cessus dynamicus, qui sequitur mutatin onem
                                                                        consuetudium.
                                                                        Investiga tiones demonstr averunt lectores legere me liusked quod kequa
                                                                        legunt
                                                                        saepius. Claritas est etiam pro cessus. Sequitur mutatin onem consuetudium.
                                                                        Investiga tiones demonstr averunt lectores legere me lius quod ii qua legunt
                                                                        saepius. Claritas est etiam pro cessus.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end ./tab-pane -->
                                                    <div class="tab-pane fade" id="tab9_content3" role="tabpanel" aria-labelledby="tab9_content3">
                                                        <div class="row no-gutters">
                                                            <div class="col-md-12">
                                                                <div class="text_content">
                                                                    <p>Investiga tiones demonstr averun d lectores legere melius quod kequa legunt
                                                                        saepius.
                                                                        Claritas est etiam pro cessus dynamicus, qui sequitur mutatin onem
                                                                        consuetudium.
                                                                        Investiga tiones demonstr averunt lectores legere me liusked quod kequa
                                                                        legunt
                                                                        saepius. Claritas est etiam pro cessus. Sequitur mutatin onem consuetudium.
                                                                        Investiga tiones demonstr averunt lectores legere me lius quod ii qua legunt
                                                                        saepius. Claritas est etiam pro cessus.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end ./tab-pane -->
                                                </div>
                                            </div>
                                        </div><!-- end /.row -->
                                    </div><!-- end /.tab--4 -->
                                </div>
                            </div><!-- ends: .tab-pane -->
                            <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2">
                                <div class="contents-1">
                                    <div class="m-bottom-30">
                                        <div class="divider divider-simple text-left">
                                            <h3>Investment Planning</h3>
                                        </div>
                                    </div>
                                    <p>Investiga tiones demonstr averun d lectores legere melius quod kequa legunt saepius. Claritas est etiam pro cessus dynamicus, qui sequitur mutatin onem consuetudium. Investiga tiones demonstr averunt lectores legere me liusked quod kequa legunt saepius. Claritas est etiam pro cessus. Sequitur mutatin onem consuetudium. Investiga tiones demonstr averunt lectores legere me lius quod ii qua legunt saepius. Claritas est etiam pro cessus.<br><br> Claritas est etiam pro cessus. Sequitur mutatin onem consuetudium. Investiga tiones demonstr aver unt lectores legere me lius quod ii qua legunt saepius. Claritas est etiam pro cessus.</p>
                                    <div class="m-top-40">
                                        <!-- start blockquote -->
                                        <blockquote class="blockquote blockquote1 ">
                                            <p>My focus areas are on global standardization and harmonization of business processes lorem dolor is reorganization of marketing and customer standardization and harmonization.</p>
                                            <div class="quote-author">
                                                <p><span>Jeff Collins,</span> Founder of Tizara Inc.</p>
                                            </div>
                                        </blockquote><!-- end: blockquote -->
                                    </div>
                                </div>
                            </div><!-- ends: .tab-pane -->
                            <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3">
                                <div class="contents-1">
                                    <div class="m-bottom-30">
                                        <div class="divider divider-simple text-left">
                                            <h3>Savings &amp; Investments</h3>
                                        </div>
                                    </div>
                                    <p>Investiga tiones demonstr averun d lectores legere melius quod kequa legunt saepius. Claritas est etiam pro cessus dynamicus, qui sequitur mutatin onem consuetudium. Investiga tiones demonstr averunt lectores legere me liusked quod kequa legunt saepius. Claritas est etiam pro cessus. Sequitur mutatin onem consuetudium. Investiga tiones demonstr averunt lectores legere me lius quod ii qua legunt saepius. Claritas est etiam pro cessus.<br><br> Claritas est etiam pro cessus. Sequitur mutatin onem consuetudium. Investiga tiones demonstr aver unt lectores legere me lius quod ii qua legunt saepius. Claritas est etiam pro cessus.</p>
                                    <div class="m-top-40">
                                        <!-- start blockquote -->
                                        <blockquote class="blockquote blockquote1 ">
                                            <p>My focus areas are on global standardization and harmonization of business processes lorem dolor is reorganization of marketing and customer standardization and harmonization.</p>
                                            <div class="quote-author">
                                                <p><span>Jeff Collins,</span> Founder of Tizara Inc.</p>
                                            </div>
                                        </blockquote><!-- end: blockquote -->
                                    </div>
                                </div>
                            </div><!-- ends: .tab-pane -->
                            <div class="tab-pane fade" id="tab4" role="tabpanel" aria-labelledby="tab4">
                                <div class="contents-1">
                                    <div class="m-bottom-30">
                                        <div class="divider divider-simple text-left">
                                            <h3>Business Consulting</h3>
                                        </div>
                                    </div>
                                    <p>Investiga tiones demonstr averun d lectores legere melius quod kequa legunt saepius. Claritas est etiam pro cessus dynamicus, qui sequitur mutatin onem consuetudium. Investiga tiones demonstr averunt lectores legere me liusked quod kequa legunt saepius. Claritas est etiam pro cessus. Sequitur mutatin onem consuetudium. Investiga tiones demonstr averunt lectores legere me lius quod ii qua legunt saepius. Claritas est etiam pro cessus.<br><br> Claritas est etiam pro cessus. Sequitur mutatin onem consuetudium. Investiga tiones demonstr aver unt lectores legere me lius quod ii qua legunt saepius. Claritas est etiam pro cessus.</p>
                                    <div class="m-top-40">
                                        <!-- start blockquote -->
                                        <blockquote class="blockquote blockquote1 ">
                                            <p>My focus areas are on global standardization and harmonization of business processes lorem dolor is reorganization of marketing and customer standardization and harmonization.</p>
                                            <div class="quote-author">
                                                <p><span>Jeff Collins,</span> Founder of Tizara Inc.</p>
                                            </div>
                                        </blockquote><!-- end: blockquote -->
                                    </div>
                                </div>
                            </div><!-- ends: .tab-pane -->
                            <div class="tab-pane fade" id="tab5" role="tabpanel" aria-labelledby="tab5">
                                <div class="contents-1">
                                    <div class="m-bottom-30">
                                        <div class="divider divider-simple text-left">
                                            <h3>Online Consulting</h3>
                                        </div>
                                    </div>
                                    <p>Investiga tiones demonstr averun d lectores legere melius quod kequa legunt saepius. Claritas est etiam pro cessus dynamicus, qui sequitur mutatin onem consuetudium. Investiga tiones demonstr averunt lectores legere me liusked quod kequa legunt saepius. Claritas est etiam pro cessus. Sequitur mutatin onem consuetudium. Investiga tiones demonstr averunt lectores legere me lius quod ii qua legunt saepius. Claritas est etiam pro cessus.<br><br> Claritas est etiam pro cessus. Sequitur mutatin onem consuetudium. Investiga tiones demonstr aver unt lectores legere me lius quod ii qua legunt saepius. Claritas est etiam pro cessus.</p>
                                    <div class="m-top-40">
                                        <!-- start blockquote -->
                                        <blockquote class="blockquote blockquote1 ">
                                            <p>My focus areas are on global standardization and harmonization of business processes lorem dolor is reorganization of marketing and customer standardization and harmonization.</p>
                                            <div class="quote-author">
                                                <p><span>Jeff Collins,</span> Founder of Tizara Inc.</p>
                                            </div>
                                        </blockquote><!-- end: blockquote -->
                                    </div>
                                </div>
                            </div><!-- ends: .tab-pane -->
                            <div class="tab-pane fade" id="tab6" role="tabpanel" aria-labelledby="tab6">
                                <div class="contents-1">
                                    <div class="m-bottom-30">
                                        <div class="divider divider-simple text-left">
                                            <h3>Strategic Consulting</h3>
                                        </div>
                                    </div>
                                    <p>Investiga tiones demonstr averun d lectores legere melius quod kequa legunt saepius. Claritas est etiam pro cessus dynamicus, qui sequitur mutatin onem consuetudium. Investiga tiones demonstr averunt lectores legere me liusked quod kequa legunt saepius. Claritas est etiam pro cessus. Sequitur mutatin onem consuetudium. Investiga tiones demonstr averunt lectores legere me lius quod ii qua legunt saepius. Claritas est etiam pro cessus.<br><br> Claritas est etiam pro cessus. Sequitur mutatin onem consuetudium. Investiga tiones demonstr aver unt lectores legere me lius quod ii qua legunt saepius. Claritas est etiam pro cessus.</p>
                                    <div class="m-top-40">
                                        <!-- start blockquote -->
                                        <blockquote class="blockquote blockquote1 ">
                                            <p>My focus areas are on global standardization and harmonization of business processes lorem dolor is reorganization of marketing and customer standardization and harmonization.</p>
                                            <div class="quote-author">
                                                <p><span>Jeff Collins,</span> Founder of Tizara Inc.</p>
                                            </div>
                                        </blockquote><!-- end: blockquote -->
                                    </div>
                                </div>
                            </div><!-- ends: .tab-pane -->
                            <div class="tab-pane fade" id="tab7" role="tabpanel" aria-labelledby="tab7">
                                <div class="contents-1">
                                    <div class="m-bottom-30">
                                        <div class="divider divider-simple text-left">
                                            <h3>Business Process Services</h3>
                                        </div>
                                    </div>
                                    <p>Investiga tiones demonstr averun d lectores legere melius quod kequa legunt saepius. Claritas est etiam pro cessus dynamicus, qui sequitur mutatin onem consuetudium. Investiga tiones demonstr averunt lectores legere me liusked quod kequa legunt saepius. Claritas est etiam pro cessus. Sequitur mutatin onem consuetudium. Investiga tiones demonstr averunt lectores legere me lius quod ii qua legunt saepius. Claritas est etiam pro cessus.<br><br> Claritas est etiam pro cessus. Sequitur mutatin onem consuetudium. Investiga tiones demonstr aver unt lectores legere me lius quod ii qua legunt saepius. Claritas est etiam pro cessus.</p>
                                    <div class="m-top-40">
                                        <!-- start blockquote -->
                                        <blockquote class="blockquote blockquote1 ">
                                            <p>My focus areas are on global standardization and harmonization of business processes lorem dolor is reorganization of marketing and customer standardization and harmonization.</p>
                                            <div class="quote-author">
                                                <p><span>Jeff Collins,</span> Founder of Tizara Inc.</p>
                                            </div>
                                        </blockquote><!-- end: blockquote -->
                                    </div>
                                </div>
                            </div><!-- ends: .tab-pane -->
                        </div>
                    </div><!-- ends: .col-lg-9 -->
                </div>
            </div>
        </div><!-- ends: .service--tabs -->
    </section><!-- ends: .service-tab-wrapper -->
@endsection
