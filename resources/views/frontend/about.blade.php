@extends('frontend.layout')
@section('title', 'Giới thiệu - ' . ($company->name ?? 'ABM Tax'))
@section('content')
<!-- <section class="section py-5">
    <div class="container">
        <h1 class="section-title text-center mb-4">Về {{ $company->name ?? 'ABM Tax' }}</h1>
        <div class="row align-items-center">
            <div class="col-lg-7 mb-4 mb-lg-0">
                <p class="fs-5">{{ $company->about ?? '' }}</p>
                <ul class="list-unstyled mt-3">
                    <li><i class="bi bi-geo-alt-fill me-2 text-primary"></i><strong>Địa chỉ:</strong> {{ $company->address ?? '' }}</li>
                    <li><i class="bi bi-envelope-fill me-2 text-primary"></i><strong>Email:</strong> <a href="mailto:{{ $company->email ?? '' }}">{{ $company->email ?? '' }}</a></li>
                    <li><i class="bi bi-telephone-fill me-2 text-primary"></i><strong>Hotline:</strong> <a href="tel:{{ $company->hotline ?? '' }}">{{ $company->hotline ?? '' }}</a></li>
                </ul>
            </div>
            <div class="col-lg-5 text-center">
                <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=400&q=80" alt="ABM Tax" class="img-fluid rounded-4 shadow">
            </div>
        </div>
    </div>
</section> -->

<!-- Page-title -->
<div class="page-title tf-spacing-4">
            <div class="tf-container">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-content">
                            <p class="text-body-3 text wow fadeInUp"><a href="index.html"> Home </a> &nbsp; / &nbsp;<a
                                    href="#">Pages </a>&nbsp;/ &nbsp; About</p>
                            <h3 class="title wow fadeInUp">
                                About Us
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.page-title -->

 <!-- Main-content -->
 <div class="main-content">
            <!-- Section-about-us -->
            <section class="section-about-us tf-spacing-4">
                <div class="tf-container">
                    <div class="row">
                        <div class="col-12">
                            <div class="heading-section-about-us pb-40">
                                <h2 class="title fw-6 wow fadeInUp">
                                    Welcome The chungdd
                                </h2>
                                <div class="sub-title text-body-2 wow fadeInUp" data-wow-delay="0.1s">
                                    Your ultimate destination for discovering and booking exceptional tours. Explore our
                                    curated selection of adventures, from thrilling excursions to serene getaways, and
                                    find the perfect experience tailored to your interests. Let us guide you through
                                    seamless booking and make your travel dreams a reality with ease.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tf-container pb-40">
                    <div class="row">
                        <div class="col-12">
                            <div class="image ">
                                <img src="image/section/image-about-us.jpg" data-src="image/section/image-about-us.jpg"
                                    alt="" class="lazyload">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tf-container">
                    <div class="row rg-30">
                        <div class="col-lg-3 col-sm-6 col-6">
                            <div class="box-icon style-2">
                                <div class="icon">
                                    <i class="icon-sealpercent1"></i>
                                </div>
                                <div class="box-icon-content">
                                    <h6 class="title fw-6">
                                        <a href="#">Exclusive Deals</a>
                                    </h6>
                                    <div class="text text-body-3">
                                        Special offers and competitive pricing on top destinations.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-6">
                            <div class="box-icon style-2">
                                <div class="icon">
                                    <i class="icon-user3"></i>
                                </div>
                                <div class="box-icon-content">
                                    <h6 class="title fw-6">
                                        <a href="#">Personalized Itineraries</a>
                                    </h6>
                                    <div class="text text-body-3">
                                        Custom travel plans tailored to your interests for a unique experience.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-6">
                            <div class="box-icon style-2">
                                <div class="icon">
                                    <i class="icon-shieldcheck1"></i>
                                </div>
                                <div class="box-icon-content">
                                    <h6 class="title fw-6">
                                        <a href="#">Save and security</a>
                                    </h6>
                                    <div class="text text-body-3">
                                        Protects you against unexpected events for a worry-free trip.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-6">
                            <div class="box-icon style-2">
                                <div class="icon">
                                    <i class="icon-phonecall1"></i>
                                </div>
                                <div class="box-icon-content">
                                    <h6 class="title fw-6">
                                        <a href="#">24/7 Customer Support</a>
                                    </h6>
                                    <div class="text text-body-3">
                                        Round-the-clock assistance for a hassle-free journey.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="line"></div>
                        </div>
                    </div>
                </div>
                <div class="tf-container">
                    <div class="row">
                        <div class="col-12">
                            <div class="wg-mission-vision">
                                <div class="mission-content">
                                    <h4 class="title fw-6 wow fadeInUp">
                                        Vision And Mission
                                    </h4>
                                    <div class="text text-body-3 wow fadeInUp">
                                        Vision: At chungdd, we envision a world where every traveler can effortlessly
                                        discover and embark on extraordinary adventures. Our goal is to inspire
                                        exploration and create unforgettable experiences through innovative travel
                                        solutions and exceptional service.
                                    </div>
                                    <div class="text text-body-3 wow fadeInUp">
                                        Mission: Our mission is to provide a seamless platform for finding and booking
                                        tours that cater to diverse interests and preferences. We are dedicated to
                                        delivering personalized service, expert recommendations, and reliable support to
                                        ensure every journey is memorable and hassle-free.
                                    </div>
                                </div>
                                <div class="mission-content">
                                    <h4 class="title fw-6 wow fadeInUp" data-wow-delay="0.1s">
                                        Our chungdd Story
                                    </h4>
                                    <div class="text text-body-3 wow fadeInUp" data-wow-delay="0.1s">
                                        chungdd began with a passion for travel and a vision to simplify the way
                                        people explore the world. Our journey started with a simple idea: to create a
                                        platform that connects travelers with the best tours and experiences around the
                                        globe.
                                    </div>
                                    <div class="text text-body-3 wow fadeInUp" data-wow-delay="0.1s">
                                        From our humble beginnings, we have grown into a trusted resource for adventure
                                        seekers and travel enthusiasts, continually expanding our offerings to meet the
                                        needs of a diverse audience. Join us as we continue to innovate and inspire,
                                        making your travel dreams come true with every trip.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section><!-- /.section-about-us -->

            <!-- Section-step -->
            <section class="section-step tf-spacing-4">
                <div class="tf-container">
                    <div class="row">
                        <div class="col-12">
                            <div class="step-inner style-2">
                                <div class="step-left">
                                    <div class="heading-section">
                                        <h3 class="title fw-6 pb-16 wow fadeInUp">
                                            Book tickets easily with just a few steps
                                        </h3>
                                        <div class="sub-title text-body-2 pb-40 wow fadeInUp">
                                            The solution for those of you who don't want the hassle of ordering travel
                                            tickets, with just 3 steps you can travel anywhere you want.
                                        </div>
                                        <a href="#" class="tf-btn color-primary wow fadeInUp">Booking Tour</a>
                                    </div>
                                </div>
                                <div class="step-right">
                                    <div class="box-icon wow fadeInUp" data-wow-delay="0.1s">
                                        <div class="icon">
                                            <img src="{{ asset('frontend/images/icon/find.png') }}" data-src="{{ asset('frontend/images/icon/find.png') }}" alt=""
                                                class="lazyload">
                                        </div>
                                        <div class="box-icon-content">
                                            <h5 class="title fw-6">
                                                <a href="#">Find Your Travel Destination </a>
                                            </h5>
                                            <div class="text text-body-3">
                                                Do you want to relax on the beach, explore a new city, or go on an
                                                adventure?
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-icon wow fadeInUp" data-wow-delay="0.1s">
                                        <div class="icon">
                                            <img src="{{ asset('frontend/images/icon/book.png') }}" data-src="{{ asset('frontend/images/icon/book.png') }}" alt=""
                                                class="lazyload">
                                        </div>
                                        <div class="box-icon-content">
                                            <h5 class="title fw-6">
                                                <a href="#">Book You Ticket</a>
                                            </h5>
                                            <div class="text text-body-3">
                                                Find your travel destination, because we have covered all regions in the
                                                world.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-icon wow fadeInUp" data-wow-delay="0.1s">
                                        <div class="icon">
                                            <img src="{{ asset('frontend/images/icon/pay.png') }}" data-src="{{ asset('frontend/images/icon/pay.png') }}" alt=""
                                                class="lazyload">
                                        </div>
                                        <div class="box-icon-content">
                                            <h5 class="title fw-6">
                                                <a href="#">Pay and go tour</a>
                                            </h5>
                                            <div class="text text-body-3">
                                                Do you want to relax on the beach, explore a new city, or go on an
                                                adventure?
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section><!-- /.section-step -->

            <!-- Section-why -->
            <section class="section-why tf-spacing-14">
                <div class="tf-container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="why-inner">
                                <div class="heading-section pr-62">
                                    <h3 class="title fw-6 pb-16 wow fadeInUp">
                                        Discover the Best Activities with chungdd
                                    </h3>
                                    <div class="sub-title text-body-2 wow fadeInUp">
                                        Explore top activities with chungdd, from thrilling adventures to unique
                                        experiences, and make your next journey unforgettable.
                                    </div>
                                </div>
                                <div class="benefit style-2">
                                    <div class="benefit-item wow fadeInUp">
                                        <div class="text text-body-2"> <i class="icon-check-box-2"></i> Thrilling
                                            adventure activities tailored to your interests.</div>
                                    </div>
                                    <div class="benefit-item wow fadeInUp">
                                        <div class="text text-body-2"> <i class="icon-check-box-2"></i> Unique and
                                            exclusive experiences for memorable moments.</div>
                                    </div>
                                    <div class="benefit-item wow fadeInUp">
                                        <div class="text text-body-2"> <i class="icon-check-box-2"></i> Expert guides
                                            providing knowledgeable insights and assistance.</div>
                                    </div>
                                    <div class="benefit-item wow fadeInUp">
                                        <div class="text text-body-2"> <i class="icon-check-box-2"></i> Hassle-free
                                            bookings with organized itineraries.</div>
                                    </div>
                                    <div class="benefit-item wow fadeInUp">
                                        <div class="text text-body-2"> <i class="icon-check-box-2"></i> Access to
                                            special events and off-the-beaten-path locations.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="wg-slider-why">
                                <div class="slider-arrow style-3">
                                    <div class="slider-section-prev-5 section-prev-3 btn-arrow style-4">
                                        <i class="icon-arrowLeft"></i>
                                    </div>
                                    <div class="slider-section-next-5 section-next-3 btn-arrow style-4">
                                        <i class="icon-arrowRight"></i>
                                    </div>
                                </div>
                                <div class="swiper-container why-swiper">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <div class="why-item hover-img">
                                                <div class="image">
                                                    <img src="image/section/section-why-item.jpg"
                                                        data-src="image/section/section-why-item.jpg" alt=""
                                                        class="lazyload">
                                                </div>
                                                <div class="why-content">
                                                    <div class="address">
                                                        <h5 class="title fw-6 pb-1">
                                                            <a href="tours-details-2.html">Canoeing And Kayaking</a>
                                                        </h5>
                                                        <div class="sub-title text-body-3">
                                                            Mount Fuji
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="why-item hover-img">
                                                <div class="image">
                                                    <img src="image/section/section-why-item.jpg"
                                                        data-src="image/section/section-why-item.jpg" alt=""
                                                        class="lazyload">
                                                </div>
                                                <div class="why-content">
                                                    <div class="address">
                                                        <h5 class="title fw-6 pb-1">
                                                            <a href="tours-details-2.html">Canoeing And Kayaking</a>
                                                        </h5>
                                                        <div class="sub-title text-body-3">
                                                            Mount Fuji
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="why-item hover-img">
                                                <div class="image">
                                                    <img src="image/section/section-why-item.jpg"
                                                        data-src="image/section/section-why-item.jpg" alt=""
                                                        class="lazyload">
                                                </div>
                                                <div class="why-content">
                                                    <div class="address">
                                                        <h5 class="title fw-6 pb-1">
                                                            <a href="tours-details-2.html">Canoeing And Kayaking</a>
                                                        </h5>
                                                        <div class="sub-title text-body-3">
                                                            Mount Fuji
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
            </section><!-- /.section-why -->

            <!-- Section-testi -->
            <section class="section-testi tf-spacing-18 ">
                <div class="tf-container">
                    <div class="row">
                        <div class="col-12">
                            <div class="heading-section text-center">
                                <h3 class="title fw-6 pb-16 wow fadeInUp">
                                    What’s people say’s
                                </h3>
                                <div class="sub-title text-body-2 wow fadeInUp">
                                    Discover exceptional experiences through testimonials from our satisfied customers.
                                </div>
                            </div>
                            <div class="wg-testimonial style-3">
                                <div class="swiper-container testimonial-swiper-3">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <div class="testimonial-item style-3">
                                                <div class="testimonial-content">
                                                    <div class="rating">
                                                        <i class="icon-star1"></i>
                                                        <i class="icon-star1"></i>
                                                        <i class="icon-star1"></i>
                                                        <i class="icon-star1"></i>
                                                        <i class="icon-star1"></i>
                                                    </div>
                                                    <div class="text text-body-2">
                                                        “I've used this travel booking site multiple times and have
                                                        never been disappointed. The search filters are great for
                                                        narrowing down options, and the prices are always competitive.”
                                                    </div>
                                                    <div class="testimonial-avatar">
                                                        <div class="image-avatar">
                                                            <img src="image/avata/avatestimonial-avatar-3.jpg"
                                                                data-src="image/avata/avatestimonial-avatar-3.jpg"
                                                                alt="" class="lazyload">
                                                        </div>
                                                        <h6 class="name fw-6">
                                                            <a href="#">
                                                                Annette Black
                                                            </a>
                                                            <span class="country caption-1">NewYork, USA</span>
                                                        </h6>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="testimonial-item style-3">
                                                <div class="testimonial-content">
                                                    <div class="rating">
                                                        <i class="icon-star1"></i>
                                                        <i class="icon-star1"></i>
                                                        <i class="icon-star1"></i>
                                                        <i class="icon-star1"></i>
                                                        <i class="icon-star1"></i>
                                                    </div>
                                                    <div class="text text-body-2">
                                                        "This travel site is my go-to for booking adventures. The range
                                                        of tour
                                                        options is fantastic, and I appreciate the detailed descriptions
                                                        and
                                                        reviews that help me make informed decisions.”
                                                    </div>
                                                    <div class="testimonial-avatar">
                                                        <div class="image-avatar">
                                                            <img src="image/avata/avatestimonial-avatar-5.jpg"
                                                                data-src="image/avata/avatestimonial-avatar-5.jpg"
                                                                alt="" class="lazyload">
                                                        </div>
                                                        <h6 class="name fw-6">
                                                            <a href="#">
                                                                Jane Cooper
                                                            </a>
                                                            <span class="country caption-1">NewYork, USA</span>
                                                        </h6>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="testimonial-item style-3">
                                                <div class="testimonial-content">
                                                    <div class="rating">
                                                        <i class="icon-star1"></i>
                                                        <i class="icon-star1"></i>
                                                        <i class="icon-star1"></i>
                                                        <i class="icon-star1"></i>
                                                        <i class="icon-star1"></i>
                                                    </div>
                                                    <div class="text text-body-2">
                                                        “I've used this travel booking site multiple times and have
                                                        never been disappointed. The search filters are great for
                                                        narrowing down options, and the prices are always competitive.”
                                                    </div>
                                                    <div class="testimonial-avatar">
                                                        <div class="image-avatar">
                                                            <img src="image/avata/avatestimonial-avatar.jpg"
                                                                data-src="image/avata/avatestimonial-avatar.jpg" alt=""
                                                                class="lazyload">
                                                        </div>
                                                        <h6 class="name fw-6">
                                                            <a href="#">
                                                                Annette Black
                                                            </a>
                                                            <span class="country caption-1">NewYork, USA</span>
                                                        </h6>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="testimonial-item style-3">
                                                <div class="testimonial-content">
                                                    <div class="rating">
                                                        <i class="icon-star1"></i>
                                                        <i class="icon-star1"></i>
                                                        <i class="icon-star1"></i>
                                                        <i class="icon-star1"></i>
                                                        <i class="icon-star1"></i>
                                                    </div>
                                                    <div class="text text-body-2">
                                                        “I've used this travel booking site multiple times and have
                                                        never been disappointed. The search filters are great for
                                                        narrowing down options, and the prices are always competitive.”
                                                    </div>
                                                    <div class="testimonial-avatar">
                                                        <div class="image-avatar">
                                                            <img src="image/avata/avatestimonial-avatar-4.jpg"
                                                                data-src="image/avata/avatestimonial-avatar-4.jpg"
                                                                alt="" class="lazyload">
                                                        </div>
                                                        <h6 class="name fw-6">
                                                            <a href="#">
                                                                Annette Black
                                                            </a>
                                                            <span class="country caption-1">NewYork, USA</span>
                                                        </h6>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="testimonial-item style-3">
                                                <div class="testimonial-content">
                                                    <div class="rating">
                                                        <i class="icon-star1"></i>
                                                        <i class="icon-star1"></i>
                                                        <i class="icon-star1"></i>
                                                        <i class="icon-star1"></i>
                                                        <i class="icon-star1"></i>
                                                    </div>
                                                    <div class="text text-body-2">
                                                        “I've used this travel booking site multiple times and have
                                                        never been disappointed. The search filters are great for
                                                        narrowing down options, and the prices are always competitive.”
                                                    </div>
                                                    <div class="testimonial-avatar">
                                                        <div class="image-avatar">
                                                            <img src="image/avata/avatestimonial-avatar-2.jpg"
                                                                data-src="image/avata/avatestimonial-avatar-2.jpg"
                                                                alt="" class="lazyload">
                                                        </div>
                                                        <h6 class="name fw-6">
                                                            <a href="#">
                                                                Annette Black
                                                            </a>
                                                            <span class="country caption-1">NewYork, USA</span>
                                                        </h6>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="wg-testimonial-bottom">
                                    <div class="swiper-pagination pagination-testimonial-3">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section><!-- /.section-testi -->

            <!-- Section-connect -->
            <section class="section-connect tf-spacing-4">
                <div class="tf-container">
                    <div class="row">
                        <div class="col-12">
                            <div class="connect-inner">
                                <div class="connect-left">
                                    <div class="heading-section">
                                        <h3 class="title fw-6 pb-12 wow fadeInUp">
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