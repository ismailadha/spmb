@extends('frontend.main')

@section('content')
    <div class="content-area">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Left part start -->
                <div class="col-md-12">
                    <div class="blog-post blog-single">
                        <div class="dlab-post-title ">
                            <h2 class="post-title"><a href="#">Petunjuk Teknis</a></h2>
                        </div>
                        <div class="dlab-tabs product-description tabs-site-button pt-3">
                            <ul class="nav nav-tabs ">
                                <li><a data-bs-toggle="tab" href="#web-design-1" class="active show"><i class="fa fa-globe"></i> Description</a></li>
                                <li><a data-bs-toggle="tab" href="#graphic-design-1"><i class="far fa-image"></i> Additional Information</a></li>
                                <li><a data-bs-toggle="tab" href="#developement-1"><i class="fa fa-cog"></i> Product Review</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="web-design-1" class="tab-pane active">
                                    <p class="m-b10">Suspendisse et justo. Praesent mattis commyolk augue Aliquam ornare hendrerit augue Cras tellus In pulvinar lectus a est Curabitur eget orci Cras laoreet. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Suspendisse et justo. Praesent mattis  commyolk augue aliquam ornare augue.</p>
                                    <p>"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences</p>
                                    <ul class="list-check primary">
                                        <li>"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and </li>
                                        <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </li>
                                    </ul>
                                </div>
                                <div id="graphic-design-1" class="tab-pane">
                                    <table class="table table-bordered" >
                                        <tr>
                                            <td>Size</td>
                                            <td>Small, Medium & Large</td>
                                        </tr>
                                        <tr>
                                            <td>Color</td>
                                            <td>Pink & White</td>
                                        </tr>
                                        <tr>
                                            <td>Rating</td>
                                            <td><span class="rating-bx"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> </span> </td>
                                        </tr>
                                        <tr>
                                            <td>Waist</td>
                                            <td>26 cm</td>
                                        </tr>
                                        <tr>
                                            <td>Length</td>
                                            <td>40 cm</td>
                                        </tr>
                                        <tr>
                                            <td>Chest</td>
                                            <td>33 inches</td>
                                        </tr>
                                        <tr>
                                            <td>Fabric</td>
                                            <td>Cotton, Silk & Synthetic</td>
                                        </tr>
                                        <tr>
                                            <td>Warranty</td>
                                            <td>3 Months</td>
                                        </tr>
                                        <tr>
                                            <td>Chest</td>
                                            <td>33 inches</td>
                                        </tr>
                                    </table>
                                </div>
                                <div id="developement-1" class="tab-pane">
                                    <div id="comments">
                                        <ol class="commentlist">
                                            <li class="comment">
                                                <div class="comment_container"> <img class="avatar avatar-60 photo" src="images/testimonials/pic1.jpg" alt="">
                                                    <div class="comment-text">
                                                        <div  class="star-rating">
                                                            <div data-rating='3'> <i class="fa fa-star" data-alt="1" title="regular"></i> <i class="fa fa-star" data-alt="2" title="regular"></i> <i class="far fa-star" data-alt="3" title="regular"></i> <i class="far fa-star" data-alt="4" title="regular"></i> <i class="far fa-star" data-alt="5" title="regular"></i> </div>
                                                        </div>
                                                        <p class="meta"> <strong class="author">Cobus Bester</strong> <span><i class="far fa-clock"></i> March 7, 2013</span> </p>
                                                        <div class="description">
                                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="comment">
                                                <div class="comment_container"> <img class="avatar avatar-60 photo" src="images/testimonials/pic2.jpg" alt="">
                                                    <div class="comment-text">
                                                        <div  class="star-rating">
                                                            <div data-rating='3'> <i class="fa fa-star" data-alt="1" title="regular"></i> <i class="fa fa-star" data-alt="2" title="regular"></i> <i class="fa fa-star" data-alt="3" title="regular"></i> <i class="far fa-star" data-alt="4" title="regular"></i> <i class="far fa-star" data-alt="5" title="regular"></i> </div>
                                                        </div>
                                                        <p class="meta"> <strong class="author">Cobus Bester</strong> <span><i class="far fa-clock"></i> March 7, 2013</span> </p>
                                                        <div class="description">
                                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="comment">
                                                <div class="comment_container"> <img class="avatar avatar-60 photo" src="images/testimonials/pic3.jpg" alt="">
                                                    <div class="comment-text">
                                                        <div  class="star-rating">
                                                            <div data-rating='3'> <i class="fa fa-star" data-alt="1" title="regular"></i> <i class="fa fa-star" data-alt="2" title="regular"></i> <i class="fa fa-star" data-alt="3" title="regular"></i> <i class="fa fa-star" data-alt="4" title="regular"></i> <i class="far fa-star" data-alt="5" title="regular"></i> </div>
                                                        </div>
                                                        <p class="meta"> <strong class="author">Cobus Bester</strong> <span><i class="far fa-clock"></i> March 7, 2013</span> </p>
                                                        <div class="description">
                                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ol>
                                    </div>
                                    <div id="review_form_wrapper">
                                        <div id="review_form">
                                            <div id="respond" class="comment-respond">
                                                <h3 class="comment-reply-title" id="reply-title">Add a review</h3>
                                                <form class="comment-form" method="post" >
                                                    <div class="comment-form-author">
                                                        <label>Name <span class="required">*</span></label>
                                                        <input type="text" aria-required="true" size="30" value="" name="author" id="author">
                                                    </div>
                                                    <div class="comment-form-email">
                                                        <label>Email <span class="required">*</span></label>
                                                        <input type="text" aria-required="true" size="30" value="" name="email" id="email">
                                                    </div>
                                                    <div class="comment-form-rating">
                                                        <label class="pull-left m-r20">Your Rating</label>
                                                        <div class='rating-widget'>
                                                        <!-- Rating Stars Box -->
                                                            <div class='rating-stars'>
                                                            <ul id='stars'>
                                                                <li class='star' title='Poor' data-value='1'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                                </li>
                                                                <li class='star' title='Fair' data-value='2'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                                </li>
                                                                <li class='star' title='Good' data-value='3'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                                </li>
                                                                <li class='star' title='Excellent' data-value='4'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                                </li>
                                                                <li class='star' title='WOW!!!' data-value='5'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                                </li>
                                                            </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="comment-form-comment">
                                                        <label>Your Review</label>
                                                        <textarea aria-required="true" rows="8" cols="45" name="comment" id="comment"></textarea>
                                                    </div>
                                                    <div class="form-submit">
                                                        <input type="submit" value="Submit" class="site-button" id="submit" name="submit">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
