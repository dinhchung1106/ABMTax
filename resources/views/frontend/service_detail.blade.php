@extends('frontend.layout')
@section('title', $service->name . ' - Dịch vụ | ' . ($company->name ?? 'ABM Tax'))
@section('meta_description', $service->description)
@section('content')

 <!-- Page-title -->
 <div class="page-title tf-spacing-4">
            <div class="tf-container">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-content">
                            <p class="text-body-3 text wow fadeInUp"><a href="index.html"> Home</a> / Destination
                                Details</p>
                            <h3 class="title wow fadeInUp">
                                Tokyo, Japan
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.page-title -->

        <!-- Main-content -->
        <div class="main-content">
            <!-- Section-recommended -->
            <section class="section-recommended tf-spacing-4">
                <div class="tf-container">
                    <div class="row">
                        <div class="col-12">
                            <div class="wg-slider-recommended-5">
                                <div class="slider-section-prev-6 section-prev btn-arrow style-2">
                                    <i class="icon-back1"></i>
                                </div>
                                <div class="slider-section-next-6 section-next btn-arrow style-2">
                                    <i class="icon-next1"></i>
                                </div>
                                <div class="swiper-container recommended-swiper-5">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <div class="recommended-item-img">
                                                <img src="image/section/recommended-item-img.jpg"
                                                    data-src="image/section/recommended-item-img.jpg" alt=""
                                                    class="lazyload">
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="recommended-item-img">
                                                <img src="image/section/recommended-item-img-2.jpg"
                                                    data-src="image/section/recommended-item-img-2.jpg" alt=""
                                                    class="lazyload">
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="recommended-item-img">
                                                <img src="image/section/recommended-item-img-3.jpg"
                                                    data-src="image/section/recommended-item-img-3.jpg" alt=""
                                                    class="lazyload">
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="recommended-item-img">
                                                <img src="image/section/recommended-item-img.jpg"
                                                    data-src="image/section/recommended-item-img.jpg" alt=""
                                                    class="lazyload">
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="recommended-item-img">
                                                <img src="image/section/recommended-item-img-2.jpg"
                                                    data-src="image/section/recommended-item-img-2.jpg" alt=""
                                                    class="lazyload">
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="recommended-item-img">
                                                <img src="image/section/recommended-item-img-3.jpg"
                                                    data-src="image/section/recommended-item-img-3.jpg" alt=""
                                                    class="lazyload">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section><!-- /.section-recommended -->

            <!-- Section-about-destination -->
            <section class="section-about-destination tf-spacing-4 ">
                <div class="tf-container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="about-content">
                                <div class="heading-section pb-32">
                                    <h3 class="title fw-6 pb-16 wow fadeInUp">
                                        Overview
                                    </h3>
                                    <div class="sub-title text-body-2 wow fadeInUp">
                                        Mi bibendum neque egestas congue. Arcu risus quis varius quam quisque id diam
                                        vel. Nunc sed blandit libero volutpat sed cras ornare arcu dui. Nunc consequat
                                        interdum varius sit amet mattis vulputate. Lobortis mattis aliquam faucibus
                                        purus in massa tempor.
                                    </div>
                                </div>
                                <div class="benefit style-2">
                                    <div class="benefit-item wow fadeInUp">
                                        <div class="text text-body-3 fw-6"> <i class="icon-check-box-2"></i> Exploring
                                            ancient ruins, historical landmar.</div>
                                    </div>
                                    <div class="benefit-item wow fadeInUp">
                                        <div class="text text-body-3 fw-6"> <i class="icon-check-box-2"></i> Immersive
                                            cultural experiences, local.</div>
                                    </div>
                                    <div class="benefit-item wow fadeInUp">
                                        <div class="text text-body-3 fw-6"> <i class="icon-check-box-2"></i> Hiking,
                                            trekking, extreme sports, and out.</div>
                                    </div>
                                    <div class="benefit-item wow fadeInUp">
                                        <div class="text text-body-3 fw-6"> <i class="icon-check-box-2"></i>
                                            Kid-friendly activities, theme parks family.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="box-map1">
                                <div id="map1" class="map1"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section><!-- /.section-about-destination -->

            <!-- Section-recommended-destination -->
            <section class="section-recommended-destination section-about-recommended tf-spacing-10">
                <div class="tf-container">
                    <div class="row">
                        <div class="col-12">
                            <div class="heading-recommended">
                                <h3 class="title fw-6 wow fadeInUp">
                                    Recommended Tours
                                </h3>
                                <div class="slider-arrow">
                                    <div class="slider-section-prev-7 section-prev-2 btn-arrow style-3 wow fadeInUp"
                                        data-wow-delay="0.1s">
                                        <i class="icon-arrowLeft"></i>
                                    </div>
                                    <div class="slider-section-next-7 section-next-2 btn-arrow style-3 wow fadeInUp"
                                        data-wow-delay="0.2s">
                                        <i class="icon-arrowRight"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-container recommended-swiper-6">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="tour-grid hover-img">
                                            <div class="image">
                                                <a href="tours-details-2.html">
                                                    <img src="image/tour-grid/tour-grid-1.jpg"
                                                    data-src="image/tour-grid/tour-grid-1.jpg" alt="" class="lazyload">
                                                </a>
                                                <div class="heart tf-action-btns">
                                                </div>
                                                <a class="caption-2 tf-btn style-uppercase">Hiking</a>
                                                <span class="number caption-1">
                                                    1/8
                                                </span>
                                            </div>
                                            <div class="tour-grid-content">
                                                <div class="top">
                                                    <div class="map-ping">
                                                        <svg width="20" height="20" viewBox="0 0 24 28" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M21 14C21 21 12 27 12 27C12 27 3 21 3 14C3 11.6131 3.94821 9.32387 5.63604 7.63604C7.32387 5.94821 9.61305 5 12 5C14.3869 5 16.6761 5.94821 18.364 7.63604C20.0518 9.32387 21 11.6131 21 14Z"
                                                                stroke="#64666C" stroke-width="1.2"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <path
                                                                d="M12 17C13.6569 17 15 15.6569 15 14C15 12.3431 13.6569 11 12 11C10.3431 11 9 12.3431 9 14C9 15.6569 10.3431 17 12 17Z"
                                                                stroke="#64666C" stroke-width="1.2"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>

                                                        <a class="text-body-3 text">Los Anglese</a>
                                                    </div>
                                                    <div class="rating">
                                                        <div class="number text-body-3 fw-6">4.2</div>
                                                        <i class="icon-star1"></i>
                                                    </div>
                                                </div>
                                                <div  class="title text-body-2 fw-6">
                                                    <a href="#">Conquer Stunning Trails and
                                                        Scenic
                                                        Paths</a>
                                                </div>
                                                
                                                <div class="tour-grid-details">
                                                    <a class="people text-body-3">
                                                        <i class="icon-Users1"></i>
                                                        08 People
                                                    </a>
                                                    <a class="days text-body-3">
                                                        <i class="icon-Clock1"></i>
                                                        3 Days/2 Night
                                                    </a>
                                                </div>
                                                <div class="price text-body-3">
                                                    Starting from: <span class="text-body-2 fw-6">$243</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="tour-grid hover-img">
                                            <div class="image">
                                                <a href="tours-details-2.html">
                                                    <img src="image/tour-grid/tour-grid-2.jpg"
                                                    data-src="image/tour-grid/tour-grid-2.jpg" alt="" class="lazyload">
                                                </a>
                                                <div class="heart tf-action-btns">
                                                </div>
                                                <a class="caption-2 tf-btn style-uppercase">Discovery</a>
                                                <span class="number caption-1">
                                                    1/8
                                                </span>
                                            </div>
                                            <div class="tour-grid-content">
                                                <div class="top">
                                                    <div class="map-ping">
                                                       <svg width="20" height="20" viewBox="0 0 24 28" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M21 14C21 21 12 27 12 27C12 27 3 21 3 14C3 11.6131 3.94821 9.32387 5.63604 7.63604C7.32387 5.94821 9.61305 5 12 5C14.3869 5 16.6761 5.94821 18.364 7.63604C20.0518 9.32387 21 11.6131 21 14Z"
                                                                stroke="#64666C" stroke-width="1.2"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <path
                                                                d="M12 17C13.6569 17 15 15.6569 15 14C15 12.3431 13.6569 11 12 11C10.3431 11 9 12.3431 9 14C9 15.6569 10.3431 17 12 17Z"
                                                                stroke="#64666C" stroke-width="1.2"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>

                                                        <a class="text-body-3 text">Los Anglese</a>
                                                    </div>
                                                    <div class="rating">
                                                        <div class="number text-body-3 fw-6">4.6</div>
                                                        <i class="icon-star1"></i>
                                                    </div>
                                                </div>
                                                <div  class="title text-body-2 fw-6">
                                                    <a href="#">Uncover Hidden Historical
                                                        Wonders and
                                                        Secrets</a>
                                                </div>
                                               
                                                <div class="tour-grid-details">
                                                    <a class="people text-body-3">
                                                        <i class="icon-Users1"></i>
                                                        23 People
                                                    </a>
                                                    <a class="days text-body-3">
                                                        <i class="icon-Clock1"></i>
                                                        3 Days/2 Night
                                                    </a>
                                                </div>
                                                <div class="price text-body-3">
                                                    Starting from: <span class="text-body-2 fw-6">$213</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="tour-grid hover-img">
                                            <div class="image">
                                                <a href="tours-details-2.html">
                                                    <img src="image/tour-grid/tour-grid-3.jpg"
                                                    data-src="image/tour-grid/tour-grid-3.jpg" alt="" class="lazyload">
                                                </a>
                                                <div class="heart tf-action-btns">
                                                </div>
                                                <a class="caption-2 tf-btn style-uppercase">Discovery</a>
                                                <span class="number caption-1">
                                                    1/8
                                                </span>
                                            </div>
                                            <div class="tour-grid-content">
                                                <div class="top">
                                                    <div class="map-ping">
                                                       <svg width="20" height="20" viewBox="0 0 24 28" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M21 14C21 21 12 27 12 27C12 27 3 21 3 14C3 11.6131 3.94821 9.32387 5.63604 7.63604C7.32387 5.94821 9.61305 5 12 5C14.3869 5 16.6761 5.94821 18.364 7.63604C20.0518 9.32387 21 11.6131 21 14Z"
                                                                stroke="#64666C" stroke-width="1.2"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <path
                                                                d="M12 17C13.6569 17 15 15.6569 15 14C15 12.3431 13.6569 11 12 11C10.3431 11 9 12.3431 9 14C9 15.6569 10.3431 17 12 17Z"
                                                                stroke="#64666C" stroke-width="1.2"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>

                                                        <a class="text-body-3 text">Los Anglese</a>
                                                    </div>
                                                    <div class="rating">
                                                        <div class="number text-body-3 fw-6">4.7</div>
                                                        <i class="icon-star1"></i>
                                                    </div>
                                                </div>
                                                <div  class="title text-body-2 fw-6">
                                                    <a href="#">Experience the Mysteries of
                                                        the Ancient
                                                        World</a>
                                                </div>
                                                
                                                <div class="tour-grid-details">
                                                    <a class="people text-body-3">
                                                        <i class="icon-Users1"></i>
                                                        12 People
                                                    </a>
                                                    <a class="days text-body-3">
                                                        <i class="icon-Clock1"></i>
                                                        3 Days/2 Night
                                                    </a>
                                                </div>
                                                <div class="price text-body-3">
                                                    Starting from: <span class="text-body-2 fw-6">$325</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="tour-grid hover-img">
                                            <div class="image">
                                                <a href="tours-details-2.html">
                                                    <img src="image/tour-grid/tour-grid-4.jpg"
                                                    data-src="image/tour-grid/tour-grid-4.jpg" alt="" class="lazyload">
                                                </a>
                                                <div class="heart tf-action-btns">
                                                </div>
                                                <a class="caption-2 tf-btn style-uppercase">Kayaking</a>
                                                <span class="number caption-1">
                                                    1/8
                                                </span>
                                            </div>
                                            <div class="tour-grid-content">
                                                <div class="top">
                                                    <div class="map-ping">
                                                       <svg width="20" height="20" viewBox="0 0 24 28" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M21 14C21 21 12 27 12 27C12 27 3 21 3 14C3 11.6131 3.94821 9.32387 5.63604 7.63604C7.32387 5.94821 9.61305 5 12 5C14.3869 5 16.6761 5.94821 18.364 7.63604C20.0518 9.32387 21 11.6131 21 14Z"
                                                                stroke="#64666C" stroke-width="1.2"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <path
                                                                d="M12 17C13.6569 17 15 15.6569 15 14C15 12.3431 13.6569 11 12 11C10.3431 11 9 12.3431 9 14C9 15.6569 10.3431 17 12 17Z"
                                                                stroke="#64666C" stroke-width="1.2"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>

                                                        <a class="text-body-3 text">Los Anglese</a>
                                                    </div>
                                                    <div class="rating">
                                                        <div class="number text-body-3 fw-6">4.2</div>
                                                        <i class="icon-star1"></i>
                                                    </div>
                                                </div>
                                                <div  class="title text-body-2 fw-6">
                                                    <a href="#">Explore Majestic Rivers and
                                                        Waterways</a>
                                                </div>
                                                
                                                <div class="tour-grid-details">
                                                    <a class="people text-body-3">
                                                        <i class="icon-Users1"></i>
                                                        22 People
                                                    </a>
                                                    <a class="days text-body-3">
                                                        <i class="icon-Clock1"></i>
                                                        3 Days/2 Night
                                                    </a>
                                                </div>
                                                <div class="price text-body-3">
                                                    Starting from: <span class="text-body-2 fw-6">$92</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="tour-grid hover-img">
                                            <div class="image">
                                                <a href="tours-details-2.html">
                                                    <img src="image/tour-grid/tour-grid-5.jpg"
                                                    data-src="image/tour-grid/tour-grid-5.jpg" alt="" class="lazyload">
                                                </a>
                                                <div class="heart tf-action-btns">
                                                </div>
                                                <a class="caption-2 tf-btn style-uppercase">Camping</a>
                                                <span class="number caption-1">
                                                    1/8
                                                </span>
                                            </div>
                                            <div class="tour-grid-content">
                                                <div class="top">
                                                    <div class="map-ping">
                                                       <svg width="20" height="20" viewBox="0 0 24 28" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M21 14C21 21 12 27 12 27C12 27 3 21 3 14C3 11.6131 3.94821 9.32387 5.63604 7.63604C7.32387 5.94821 9.61305 5 12 5C14.3869 5 16.6761 5.94821 18.364 7.63604C20.0518 9.32387 21 11.6131 21 14Z"
                                                                stroke="#64666C" stroke-width="1.2"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <path
                                                                d="M12 17C13.6569 17 15 15.6569 15 14C15 12.3431 13.6569 11 12 11C10.3431 11 9 12.3431 9 14C9 15.6569 10.3431 17 12 17Z"
                                                                stroke="#64666C" stroke-width="1.2"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>

                                                        <a class="text-body-3 text">Los Anglese</a>
                                                    </div>
                                                    <div class="rating">
                                                        <div class="number text-body-3 fw-6">4.9</div>
                                                        <i class="icon-star1"></i>
                                                    </div>
                                                </div>
                                                <div  class="title text-body-2 fw-6">
                                                    <a href="#">Wild Adventures Under the
                                                        Beautiful
                                                        Starry
                                                        Sky</a>
                                                </div>
                                               
                                                <div class="tour-grid-details">
                                                    <a class="people text-body-3">
                                                        <i class="icon-Users1"></i>
                                                        12 People
                                                    </a>
                                                    <a class="days text-body-3">
                                                        <i class="icon-Clock1"></i>
                                                        3 Days/2 Night
                                                    </a>
                                                </div>
                                                <div class="price text-body-3">
                                                    Starting from: <span class="text-body-2 fw-6">$354</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="tour-grid hover-img">
                                            <div class="image">
                                                <a href="tours-details-2.html">
                                                    <img src="image/tour-grid/tour-grid-6.jpg"
                                                    data-src="image/tour-grid/tour-grid-6.jpg" alt="" class="lazyload">
                                                </a>
                                                <div class="heart tf-action-btns">
                                                </div>
                                                <a class="caption-2 tf-btn style-uppercase">Camping</a>
                                                <span class="number caption-1">
                                                    1/8
                                                </span>
                                            </div>
                                            <div class="tour-grid-content">
                                                <div class="top">
                                                    <div class="map-ping">
                                                       <svg width="20" height="20" viewBox="0 0 24 28" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M21 14C21 21 12 27 12 27C12 27 3 21 3 14C3 11.6131 3.94821 9.32387 5.63604 7.63604C7.32387 5.94821 9.61305 5 12 5C14.3869 5 16.6761 5.94821 18.364 7.63604C20.0518 9.32387 21 11.6131 21 14Z"
                                                                stroke="#64666C" stroke-width="1.2"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <path
                                                                d="M12 17C13.6569 17 15 15.6569 15 14C15 12.3431 13.6569 11 12 11C10.3431 11 9 12.3431 9 14C9 15.6569 10.3431 17 12 17Z"
                                                                stroke="#64666C" stroke-width="1.2"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>

                                                        <a class="text-body-3 text">Los Anglese</a>
                                                    </div>
                                                    <div class="rating">
                                                        <div class="number text-body-3 fw-6">4.6</div>
                                                        <i class="icon-star1"></i>
                                                    </div>
                                                </div>
                                                <div  class="title text-body-2 fw-6">
                                                    <a href="#">Retreat in Nature’s Untouched
                                                        Beauty</a>
                                                </div>
                                              
                                                <div class="tour-grid-details">
                                                    <a class="people text-body-3">
                                                        <i class="icon-Users1"></i>
                                                        24 People
                                                    </a>
                                                    <a class="days text-body-3">
                                                        <i class="icon-Clock1"></i>
                                                        3 Days/2 Night
                                                    </a>
                                                </div>
                                                <div class="price text-body-3">
                                                    Starting from: <span class="text-body-2 fw-6">$254</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bottom-slide">
                                <div class="swiper-pagination pagination-recommended-swiper-6">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section><!-- /.section-recommended-destination -->

            <!-- Section-connect -->
            <section class="section-connect tf-spacing-2">
                <div class="tf-container">
                    <div class="row">
                        <div class="col-12">
                            <div class="connect-inner">
                                <div class="connect-left">
                                    <div class="heading-section">
                                        <h3 class="title fw-6 pb-12  wow fadeInUp">
                                            Stay Connected with Us!
                                        </h3>
                                        <div class="sub-title text-body-2 wow fadeInUp">
                                            Join our community to receive the latest travel updates, exclusive deals,
                                            and
                                            insider tips. Follow us on social media and never miss an adventure!
                                        </div>
                                    </div>
                                    <a href="#" class="tf-btn color-primary wow fadeInUp">Subscribe</a>
                                </div>
                                <div class="connect-right wow fadeInRight" data-wow-delay="0.1s">
                                    <div class="image">
                                        <img src="image/section/img-section-connect.png"
                                            data-src="image/section/img-section-connect.png" alt="" class="lazyload">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section><!-- /.section-connect -->

        </div><!-- /.main-content -->
@endsection 