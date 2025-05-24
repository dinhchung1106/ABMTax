@extends('frontend.layout')
@section('title', 'Dịch vụ - ' . ($company->name ?? 'ABM Tax'))
@section('content')
 <!-- Page-title -->
 <div class="page-title">
            <div class="tf-container">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-content">
                            <p class="text-body-3 text wow fadeInUp"><a href="index.html"> Home</a> / Destination Style 02</p>
                            <h3 class="title wow fadeInUp">
                                Dịch vụ
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.page-title -->

        <!-- Main-content -->
        <div class="main-content tf-spacing-1">

            <!-- List-destination -->
            <div class="list-destination tf-spacing-19">
                <div class="tf-container">
                    <div class="row">
                        <div class="col-12">
                            <div class="grid-layout-4 row-gap-26">
                                <div class="recommended-item hover-img wow fadeInUp">
                                    <div class="image">
                                        <a href="{{ route('frontend.services.show', 1) }}">
                                            <img src="image/section/recommended-1.jpg" data-src="image/section/recommended-1.jpg"
                                            alt="" class="lazyload">
                                            <span>15 Tours</span>
                                        </a>
                                    </div>
                                    <h5 class="address fw-6 text-center">
                                        <a href="{{ route('frontend.services.show', 1) }}">
                                            Kyoto, Japan
                                        </a>
                                    </h5>
                                </div>
                                <div class="recommended-item hover-img as-end wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="image">
                                        <a href="{{ route('frontend.services.show', 1) }}">
                                            <img src="image/section/recommended-2.jpg" data-src="image/section/recommended-2.jpg"
                                            alt="" class="lazyload">
                                            <span>15 Tours</span>
                                        </a>
                                    </div>
                                    <h5 class="address fw-6 text-center">
                                        <a href="{{ route('frontend.services.show', 1) }}">
                                            Gyeongju, Korean
                                        </a>
                                    </h5>
                                </div>
                                <div class="recommended-item hover-img wow fadeInUp" data-wow-delay="0.2s">
                                    <div class="image">
                                        <a href="{{ route('frontend.services.show', 1) }}">
                                            <img src="image/section/recommended-3.jpg" data-src="image/section/recommended-3.jpg"
                                            alt="" class="lazyload">
                                            <span>15 Tours</span>
                                        </a>
                                    </div>
                                    <h5 class="address fw-6 text-center">
                                        <a href="{{ route('frontend.services.show', 1) }}">
                                            Heidelberg, France
                                        </a>
                                    </h5>
                                </div>
                                <div class="recommended-item hover-img as-end wow fadeInUp" data-wow-delay="0.4s">
                                    <div class="image">
                                        <a href="{{ route('frontend.services.show', 1) }}">
                                            <img src="image/section/recommended-4.jpg" data-src="image/section/recommended-4.jpg"
                                            alt="" class="lazyload">
                                            <span>15 Tours</span>
                                        </a>
                                    </div>
                                    <h5 class="address fw-6 text-center">
                                        <a href="{{ route('frontend.services.show', 1) }}">
                                            Ha Long, VietNam
                                        </a>
                                    </h5>
                                </div>
                                <div class="recommended-item hover-img wow fadeInUp">
                                    <div class="image">
                                        <a href="{{ route('frontend.services.show', 1) }}">
                                            <img src="image/section/recommended-5.jpg" data-src="image/section/recommended-5.jpg"
                                            alt="" class="lazyload">
                                            <span>15 Tours</span>
                                        </a>
                                    </div>
                                    <h5 class="address fw-6 text-center">
                                        <a href="{{ route('frontend.services.show', 1) }}">
                                            Ha Noi, Viet Nam
                                        </a>
                                    </h5>
                                </div>
                                <div class="recommended-item hover-img as-end wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="image">
                                        <a href="{{ route('frontend.services.show', 1) }}">
                                            <img src="image/section/recommended-6.jpg" data-src="image/section/recommended-6.jpg"
                                            alt="" class="lazyload">
                                            <span>15 Tours</span>
                                        </a>
                                    </div>
                                    <h5 class="address fw-6 text-center">
                                        <a href="{{ route('frontend.services.show', 1) }}">
                                            Golden Gate
                                        </a>
                                    </h5>
                                </div>
                                <div class="recommended-item hover-img wow fadeInUp" data-wow-delay="0.2s">
                                    <div class="image">
                                        <a href="{{ route('frontend.services.show', 1) }}">
                                            <img src="image/section/recommended-7.jpg" data-src="image/section/recommended-7.jpg"
                                            alt="" class="lazyload">
                                            <span>15 Tours</span>
                                        </a>
                                    </div>
                                    <h5 class="address fw-6 text-center">
                                        <a href="{{ route('frontend.services.show', 1) }}">
                                            Gyeongju
                                        </a>
                                    </h5>
                                </div>
                                <div class="recommended-item hover-img as-end wow fadeInUp" data-wow-delay="0.3s">
                                    <div class="image">
                                        <a href="{{ route('frontend.services.show', 1) }}">
                                            <img src="image/section/recommended-8.jpg" data-src="image/section/recommended-8.jpg"
                                            alt="" class="lazyload">
                                            <span>15 Tours</span>
                                        </a>
                                    </div>
                                    <h5 class="address fw-6 text-center">
                                        <a href="{{ route('frontend.services.show', 1) }}">
                                            Heidelberg
                                        </a>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- ./list-destination -->

            <!-- Section-connect -->
            <section class="section-connect pl-10">
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
                                    <a href="#" class="tf-btn color-primary  wow fadeInUp">Subscribe</a>
                                </div>
                                <div class="connect-right">
                                    <div class="image wow fadeInRight" data-wow-delay="0.1s">
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