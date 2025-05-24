@extends('frontend.layout')
@section('title', ($company->name ?? 'ABM Tax') . ' - ' . ($company->slogan ?? 'Đồng hành phát triển cùng doanh nghiệp'))
@section('meta_description', $company->about ?? '')
@section('content')
<!-- <section class="hero-section text-center position-relative">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-7 text-lg-start text-center mb-4 mb-lg-0">
                <h1 class="animate__animated animate__fadeInDown">{{ $company->slogan ?? 'Đồng hành phát triển cùng doanh nghiệp' }}</h1>
                <p class="mt-3 mb-4 animate__animated animate__fadeInUp">{{ $company->about ?? '' }}</p>
                <a href="#contact" class="btn btn-warning cta-btn fw-bold shadow animate__animated animate__pulse animate__infinite">Liên hệ ngay</a>
            </div>
            <div class="col-lg-5 text-center">
                <img src="https://images.unsplash.com/photo-1461749280684-dccba630e2f6?auto=format&fit=crop&w=500&q=80" alt="ABM Tax" class="hero-img img-fluid">
            </div>
        </div>
    </div>
</section>
<section class="about-section section" id="about">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 mb-4 mb-lg-0">
                <h2 class="section-title">Về {{ $company->name ?? 'ABM Tax' }}</h2>
                <p>{{ $company->about ?? '' }}</p>
                <ul class="list-unstyled mt-3">
                    <li><i class="bi bi-geo-alt-fill me-2 text-primary"></i><strong>Địa chỉ:</strong> {{ $company->address ?? '' }}</li>
                    <li><i class="bi bi-envelope-fill me-2 text-primary"></i><strong>Email:</strong> <a href="mailto:{{ $company->email ?? '' }}">{{ $company->email ?? '' }}</a></li>
                    <li><i class="bi bi-telephone-fill me-2 text-primary"></i><strong>Hotline:</strong> <a href="tel:{{ $company->hotline ?? '' }}">{{ $company->hotline ?? '' }}</a></li>
                </ul>
            </div>
            <div class="col-lg-5 text-center">
                <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=400&q=80" alt="ABM Tax" class="img-fluid rounded-4 shadow animate__animated animate__zoomIn">
            </div>
        </div>
    </div>
</section>
<section class="section" id="services">
    <div class="container">
        <h2 class="section-title text-center">Dịch vụ nổi bật</h2>
        <div class="row g-4">
            @foreach($services as $service)
                <div class="col-md-4">
                    <div class="card service-card h-100 text-center p-3 animate__animated animate__fadeInUp">
                        <div class="service-icon mb-2"><i class="bi bi-briefcase-fill"></i></div>
                        <img src="{{ $service->image }}" class="card-img-top mb-2 rounded-3 shadow-sm" alt="{{ $service->name }}">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $service->name }}</h5>
                            <p class="card-text">{{ $service->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<section class="section" id="courses">
    <div class="container">
        <h2 class="section-title text-center">Khóa học nổi bật <span class="badge badge-cta ms-2">Ưu đãi</span></h2>
        <div class="row g-4">
            @foreach($courses as $course)
                <div class="col-md-6">
                    <div class="card course-card h-100 p-3 animate__animated animate__fadeInUp">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $course->name }}</h5>
                            <p class="card-text">{{ $course->description }}</p>
                            <ul class="list-unstyled mb-2">
                                <li><i class="bi bi-cash-coin text-success"></i> <strong>Học phí:</strong> {{ number_format($course->fee, 0, ',', '.') }}đ</li>
                                <li><i class="bi bi-calendar-event text-primary"></i> <strong>Khai giảng:</strong> {{ \Carbon\Carbon::parse($course->start_date)->format('d/m/Y') }}</li>
                                <li><i class="bi bi-clock text-warning"></i> <strong>Lịch học:</strong> {{ $course->schedule }}</li>
                                <li><i class="bi bi-star-fill text-warning"></i> <strong>Ưu đãi:</strong> {{ $course->discount_info }}</li>
                            </ul>
                            <a href="#contact" class="btn btn-primary btn-sm px-4 fw-bold shadow-sm">Đăng ký ngay</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<section class="section" id="news">
    <div class="container">
        <h2 class="section-title text-center">Tin tức mới nhất</h2>
        <div class="row g-4">
            @foreach($news as $item)
                <div class="col-md-4">
                    <div class="card news-card h-100 animate__animated animate__fadeInUp">
                        <img src="{{ $item->image }}" class="card-img-top rounded-3" alt="{{ $item->title }}">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $item->title }}</h5>
                            <p class="card-text">{{ \Illuminate\Support\Str::limit(strip_tags($item->content), 100) }}</p>
                            <span class="badge bg-primary">{{ $item->category }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<section class="section" id="contact">
    <div class="container">
        <h2 class="section-title text-center">Liên hệ với chúng tôi</h2>
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <form class="contact-form animate__animated animate__fadeInUp" method="POST" action="#">
                    <div class="mb-3">
                        <label for="name" class="form-label">Họ tên</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Số điện thoại</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Nội dung</label>
                        <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary px-4 fw-bold">Gửi liên hệ</button>
                </form>
            </div>
        </div>
    </div>
</section> -->


<!-- Page-title-home-3 -->
<div class="page-title-home style-3">
            <div class="swiper-container page-title-home-swiper-3">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="page-title-home-inner page-title-home-1">
                            <div class="tf-container">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="page-title-home-content text-center">
                                            <h1 class="title fw-6 tf-fade-top fade-item-3">
                                                Experience Ultimate Getaways
                                            </h1>
                                            <h6 class="sub-title tf-fade-top fade-item-2">
                                                Relax and explore with our top-notch travel packages.
                                            </h6>
                                            <a href="#" class="tf-btn color-white tf-fade-top fade-item-1">Let’s Get
                                                Started</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="page-title-home-inner page-title-home-2">
                            <div class="tf-container">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="page-title-home-content text-center">
                                            <h1 class="title fw-6 tf-fade-top fade-item-3">
                                                Create Your Dream Vacation
                                            </h1>
                                            <h6 class="sub-title tf-fade-top fade-item-2">
                                                Personalize your travel experience with our custom tours.
                                            </h6>
                                            <a href="#" class="tf-btn color-white tf-fade-top fade-item-1">Let’s Get
                                                Started</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slider-page-title-home-3-prev home-prev btn-arrow btn-arrow-page-title">
                    <i class="icon-back1"></i>
                </div>
                <div class="slider-page-title-home-3-next home-next btn-arrow btn-arrow-page-title">
                    <i class="icon-next1"></i>
                </div>
            </div>
        </div><!-- /.page-title-home-3 -->

 <!-- Main-content -->
 <div class="main-content">

<!-- Section-form-search -->
<section class="section-form-search tf-spacing-4">
</section><!-- /.section-form-search -->


@include('frontend.components.flash-sale')

<!-- Section-about-h-3 -->
<section class="section-about-h-3 tf-spacing-4">
    <div class="tf-container">
        <div class="row">
            <div class="col-lg-6">
                <div class="about-inner">
                    <div class="heading-section pb-32 pr-62">
                        <h3 class="title fw-6 pb-16 wow fadeInUp">
                        Công ty TNHH Đại lý thuế ABM
                        </h3>
                        <div class="sub-title text-body-2 wow fadeInUp">
                        Công ty TNHH Đại lý thuế ABM cung cấp dịch vụ kế toán, tư vấn thuế, hóa đơn điện tử và đào tạo kế toán chuyên nghiệp, đồng hành cùng doanh nghiệp trên mọi miền tổ quốc.
                        </div>
                    </div>
                    <div class="benefit style-2 pb-32">
                        <div class="benefit-item wow fadeInUp">
                            <div class="text fw-6 text-body-3"> <i class="icon-check-box-2"></i> 
                            Giải pháp kế toán - thuế toàn diện
                        </div>
                        </div>
                        <div class="benefit-item wow fadeInUp">
                            <div class="text fw-6 text-body-3"> <i class="icon-check-box-2"></i>
                            Đồng hành cùng doanh nghiệp toàn quốc</div>
                        </div>
                        <div class="benefit-item wow fadeInUp">
                            <div class="text fw-6 text-body-3"> <i class="icon-check-box-2"></i>
                            Đào tạo kế toán thực chiến</div>
                        </div>
                        <div class="benefit-item wow fadeInUp">
                            <div class="text fw-6 text-body-3"> <i class="icon-check-box-2"></i> Chi phí hợp lý, hiệu quả tối ưu</div>
                        </div>
                    </div>
                    <div class="booking-number">
                        <div class="left wow fadeInUp">
                            <div class="icon">
                                <svg width="18.75" height="18.75" viewBox="0 0 13 13" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.01688 0.870743C8.03385 0.807288 8.06316 0.747799 8.10313 0.695675C8.14311 0.643551 8.19296 0.599813 8.24984 0.566962C8.30672 0.53411 8.36951 0.512789 8.43464 0.504215C8.49976 0.495641 8.56594 0.499983 8.62938 0.516993C9.5563 0.758836 10.402 1.2434 11.0794 1.92077C11.7567 2.59813 12.2413 3.44383 12.4831 4.37074C12.5001 4.43419 12.5045 4.50036 12.4959 4.56549C12.4873 4.63061 12.466 4.69341 12.4332 4.75029C12.4003 4.80717 12.3566 4.85702 12.3044 4.89699C12.2523 4.93696 12.1928 4.96627 12.1294 4.98324C12.0871 4.99434 12.0437 5.00001 12 5.00012C11.8898 5.00011 11.7827 4.96372 11.6954 4.89658C11.608 4.82945 11.5453 4.73533 11.5169 4.62887C11.3196 3.87219 10.9242 3.18181 10.3712 2.62888C9.81831 2.07595 9.12793 1.68049 8.37126 1.48324C8.30774 1.46634 8.24819 1.43708 8.196 1.39713C8.1438 1.35719 8.1 1.30735 8.06708 1.25046C8.03417 1.19358 8.01279 1.13076 8.00418 1.0656C7.99557 1.00044 7.99988 0.934229 8.01688 0.870743ZM7.87126 3.48324C8.73313 3.71324 9.28688 4.26699 9.51688 5.12887C9.54525 5.23533 9.608 5.32945 9.69536 5.39658C9.78273 5.46372 9.88982 5.50011 10 5.50012C10.0437 5.50001 10.0871 5.49434 10.1294 5.48324C10.1928 5.46627 10.2523 5.43696 10.3044 5.39699C10.3566 5.35702 10.4003 5.30717 10.4332 5.25029C10.466 5.19341 10.4873 5.13061 10.4959 5.06549C10.5045 5.00036 10.5001 4.93419 10.4831 4.87074C10.1631 3.67324 9.32688 2.83699 8.12938 2.51699C8.00125 2.48276 7.86477 2.50084 7.74996 2.56724C7.63515 2.63364 7.55142 2.74292 7.51719 2.87106C7.48296 2.99919 7.50104 3.13567 7.56744 3.25048C7.63384 3.36529 7.74312 3.44901 7.87126 3.48324ZM12.9925 9.44262C12.8811 10.2895 12.4651 11.0669 11.8224 11.6295C11.1797 12.1922 10.3542 12.5016 9.50001 12.5001C4.53751 12.5001 0.500006 8.46262 0.500006 3.50012C0.498474 2.64592 0.807935 1.82038 1.37059 1.17768C1.93324 0.534973 2.71061 0.119059 3.55751 0.00761765C3.77166 -0.0185318 3.98854 0.0252815 4.17575 0.132517C4.36296 0.239752 4.51047 0.404658 4.59626 0.602618L5.91626 3.54949V3.55699C5.98194 3.70853 6.00906 3.87397 5.99521 4.03854C5.98136 4.20311 5.92696 4.36169 5.83688 4.50012C5.82563 4.51699 5.81376 4.53262 5.80126 4.54824L4.50001 6.09074C4.96813 7.04199 5.96313 8.02824 6.92688 8.49762L8.44813 7.20324C8.46307 7.19068 8.47872 7.179 8.49501 7.16824C8.63331 7.07599 8.79244 7.01968 8.95799 7.00441C9.12353 6.98913 9.29028 7.01537 9.44313 7.08074L9.45126 7.08449L12.3956 8.40387C12.5939 8.48935 12.7592 8.63673 12.8668 8.82397C12.9744 9.01121 13.0185 9.22824 12.9925 9.44262ZM12 9.31762C12 9.31762 11.9956 9.31762 11.9931 9.31762L9.05563 8.00199L7.53376 9.29637C7.51899 9.30887 7.50355 9.32056 7.48751 9.33137C7.3436 9.42737 7.17726 9.4844 7.00472 9.49689C6.83218 9.50938 6.65936 9.4769 6.50313 9.40262C5.33251 8.83699 4.16563 7.67887 3.59938 6.52074C3.5244 6.36565 3.49075 6.19382 3.5017 6.02191C3.51265 5.84999 3.56783 5.68382 3.66188 5.53949C3.67248 5.52255 3.68439 5.50646 3.69751 5.49137L5.00001 3.94699L3.68751 1.00949C3.68726 1.007 3.68726 1.00449 3.68751 1.00199C3.08141 1.08105 2.52493 1.37834 2.12226 1.83819C1.7196 2.29803 1.49837 2.88889 1.50001 3.50012C1.50232 5.62114 2.34592 7.65462 3.84571 9.15441C5.3455 10.6542 7.37898 11.4978 9.50001 11.5001C10.1109 11.5022 10.7016 11.2818 11.1617 10.88C11.6218 10.4782 11.9198 9.92256 12 9.31699V9.31762Z"
                                        fill="White" />
                                </svg>
                            </div>
                            <div class="number-phone">
                                <h6 class="fw-6">
                                    {{ $company->hotline }}
                                </h6>
                            </div>
                        </div>
                        <a href="/lien-he" class="tf-btn color-primary wow fadeInUp" data-wow-delay="0.1s">Liên hệ</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="wg-slider-about">
                    <div class="slider-arrow style-2">
                        <div class="slider-section-prev-3 section-prev-3 btn-arrow style-4">
                            <i class="icon-arrowLeft"></i>
                        </div>
                        <div class="slider-section-next-3 section-next-3 btn-arrow style-4">
                            <i class="icon-arrowRight"></i>
                        </div>
                    </div>
                    <div class="swiper-container about-swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="about-item hover-img">
                                    <div class="image">
                                        <img src="{{ asset('frontend/image/section/about-slider-1.jpg') }}"
                                            data-src="{{ asset('frontend/image/section/about-slider-1.jpg') }}" alt=""
                                            class="lazyload">
                                    </div>
                                    <div class="about-content">
                                        <div class="address">
                                            <h5 class="title fw-6">
                                                <a href="tours-details-2.html">Canoeing and Kayaking</a>
                                            </h5>
                                            <div class="sub-title text-body-3">
                                                Mount Fuji
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="about-item hover-img">
                                    <div class="image">
                                        <img src="{{ asset('frontend/image/section/about-slider-1.jpg') }}"
                                                data-src="{{ asset('frontend/image/section/about-slider-1.jpg') }}" alt=""
                                            class="lazyload">
                                    </div>
                                    <div class="about-content">
                                        <div class="address">
                                            <h5 class="title fw-6">
                                                <a href="tours-details-2.html">Canoeing and Kayaking</a>
                                            </h5>
                                            <div class="sub-title text-body-3">
                                                Mount Fuji
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="about-item hover-img">
                                    <div class="image">
                                        <img src="{{ asset('frontend/image/section/about-slider-1.jpg') }}"
                                            data-src="{{ asset('frontend/image/section/about-slider-1.jpg') }}" alt=""
                                            class="lazyload">
                                    </div>
                                    <div class="about-content">
                                        <div class="address">
                                            <h5 class="title fw-6">
                                                <a href="tours-details-2.html">Canoeing and Kayaking</a>
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
</section><!-- /.section-about-h-3 -->

<section class="section-about-h-2 tf-spacing-4">
    <div class="tf-container">
        <div class="row">
            <div class="col-lg-6">
                <div class="about-left">
                    <div class="image">
                        <div class="img-icon img-icon-1">
                            <img src="{{ asset('frontend/image/icon/star-list.png') }}" data-src="{{ asset('frontend/image/icon/star-list.png') }}" alt="" class=" ls-is-cached lazyloaded">
                        </div>
                        <div class="img-icon img-icon-2">
                            <img src="{{ asset('frontend/image//icon/balloon.png') }}" data-src="{{ asset('frontend/image//icon/balloon.png') }}" alt="" class=" ls-is-cached lazyloaded">
                        </div>
                        <div class="img-icon img-icon-3">
                            <img src="{{ asset('frontend/image/icon/cloud.png') }}" data-src="{{ asset('frontend/image/icon/cloud.png') }}" alt="" class=" ls-is-cached lazyloaded">
                        </div>
                        <div class="image image-1">
                            <img src="{{ asset('frontend/image/section/about-h-2.jpg') }}" data-src="{{ asset('frontend/image/section/about-h-2.jpg') }}" alt="" class=" ls-is-cached lazyloaded">
                        </div>
                        <div class="image image-2">
                            <img src="{{ asset('frontend/image/section/about-h-2-2.jpg') }}" data-src="{{ asset('frontend/image/section/about-h-2-2.jpg') }}" alt="" class=" ls-is-cached lazyloaded">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-right">
                    <div class="heading-section pb-32">
                        <h3 class="title fw-6 pb-16  wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                           Dịch vụ nổi bật
                        </h3>
                        <div class="sub-title text-body-2 wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                        Khám phá các giải pháp kế toán, thuế và công nghệ hàng đầu từ ABM, được thiết kế để hỗ trợ doanh nghiệp tối ưu hóa tài chính, tuân thủ pháp luật và phát triển bền vững
                        </div>
                    </div>
                    <div class="about-right-content">
                        <div class="details wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                            <h5 class="title-icon fw-6 pb-8">
                                <i class="icon-checkbox-3"></i>
                                Exciting Adventures
                            </h5>
                            <div class="sub-title-icon text-body-3">
                                Enjoy a variety of thrilling activities and unique experiences tailored for
                                maximum fun.
                            </div>
                        </div>
                        <div class="details wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                            <h5 class="title-icon fw-6 pb-8">
                                <i class="icon-checkbox-3"></i>
                                Excellent Customer Service
                            </h5>
                            <div class="sub-title-icon text-body-3">
                                Our dedicated team ensures your trip is smooth, enjoyable, and stress-free,
                                providing assistance from start to finish.
                            </div>
                        </div>
                        <div class="details wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                            <h5 class="title-icon fw-6 pb-8">
                                <i class="icon-checkbox-3"></i>
                                Unforgettable Experiences
                            </h5>
                            <div class="sub-title-icon text-body-3">
                                Create lasting memories with well-planned tours that cater to all your
                                travel desires.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section-tours -->
<section class="section-tours tf-spacing-7">
    <div class="tf-container">
        <div class="row">
            <div class="col-12">
                <div class="heading-section text-center pb-30">
                    <h3 class="title fw-6 wow fadeInUp">
                    Khóa học kế toán thuế
                    </h3>
                    <div class="sub-title text-body-2 pb-12 wow fadeInUp">
                    Tham gia khóa học kế toán thuế của ABM để thành thạo kỹ năng kê khai, quyết toán thuế và sử dụng hóa đơn điện tử.
                    </div>
                </div>
                <div class="swiper-container tour-grid-2-swiper style-2">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="tour-grid hover-img style-2">
                                <a href="tours-details-2.html" class="link-img"></a>
                                <div class="image">
                                    <img src="{{ asset('frontend/image/tour-grid/tour-grid-9.jpg') }}"
                                        data-src="{{ asset('frontend/image/tour-grid/tour-grid-9.jpg') }}" alt="" class="lazyload">
                                    <div class="heart tf-action-btns">
                                    </div>
                                    <a class="caption-2 tf-btn style-uppercase ls-1">Adventure</a>
                                </div>
                                <div class="tour-grid-content">
                                    <div class="top">
                                        <div class="map-ping">
                                            <svg width="20" height="20" viewBox="0 0 24 28" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M21 14C21 21 12 27 12 27C12 27 3 21 3 14C3 11.6131 3.94821 9.32387 5.63604 7.63604C7.32387 5.94821 9.61305 5 12 5C14.3869 5 16.6761 5.94821 18.364 7.63604C20.0518 9.32387 21 11.6131 21 14Z"
                                                    stroke="#fff" stroke-width="1.2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M12 17C13.6569 17 15 15.6569 15 14C15 12.3431 13.6569 11 12 11C10.3431 11 9 12.3431 9 14C9 15.6569 10.3431 17 12 17Z"
                                                    stroke="#fff" stroke-width="1.2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            <a class="text-body-3 text">Los Anglese</a>
                                        </div>
                                        <div class="rating">
                                            <div class="number text-body-3 fw-6">4.2</div>
                                            <i class="icon-star1"></i>
                                        </div>
                                    </div>
                                    <div class="title text-body-2 fw-6">
                                        <a href="tours-details-2.html"
                                            class="title text-body-2 fw-6">Conquer Stunning Trails and
                                            Scenic Paths</a>
                                    </div>
                                    <div class="tour-grid-details">
                                        <a class="people text-body-3">
                                            <i class="icon-Users1"></i>
                                            32 People
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
                                <div class="overlay"></div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="tour-grid hover-img style-2">
                                <a href="tours-details-2.html" class="link-img"></a>
                                <div class="image">
                                    <img src="{{ asset('frontend/image/tour-grid/tour-grid-10.jpg') }}"
                                        data-src="{{ asset('frontend/image/tour-grid/tour-grid-10.jpg') }}" alt="" class="lazyload">
                                    <div class="heart tf-action-btns">
                                    </div>
                                    <a class="caption-2 tf-btn style-uppercase ls-1">Discovery</a>
                                </div>
                                <div class="tour-grid-content">
                                    <div class="top">
                                        <div class="map-ping">
                                            <svg width="20" height="20" viewBox="0 0 24 28" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M21 14C21 21 12 27 12 27C12 27 3 21 3 14C3 11.6131 3.94821 9.32387 5.63604 7.63604C7.32387 5.94821 9.61305 5 12 5C14.3869 5 16.6761 5.94821 18.364 7.63604C20.0518 9.32387 21 11.6131 21 14Z"
                                                    stroke="#fff" stroke-width="1.2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M12 17C13.6569 17 15 15.6569 15 14C15 12.3431 13.6569 11 12 11C10.3431 11 9 12.3431 9 14C9 15.6569 10.3431 17 12 17Z"
                                                    stroke="#fff" stroke-width="1.2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            <a class="text-body-3 text">Los Anglese</a>
                                        </div>
                                        <div class="rating">
                                            <div class="number text-body-3 fw-6">4.6</div>
                                            <i class="icon-star1"></i>
                                        </div>
                                    </div>
                                    <div class="title text-body-2 fw-6">
                                        <a href="tours-details-2.html"
                                            class="title text-body-2 fw-6">Uncover Hidden Historical Wonders
                                            and Secrets</a>
                                    </div>
                                    <div class="tour-grid-details">
                                        <a class="people text-body-3">
                                            <i class="icon-Users1"></i>
                                            32 People
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
                                <div class="overlay"></div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="tour-grid hover-img style-2">
                                <a href="tours-details-2.html" class="link-img"></a>
                                <div class="image">
                                    <img src="{{ asset('frontend/image/tour-grid/tour-grid-11.jpg') }}"
                                        data-src="{{ asset('frontend/image/tour-grid/tour-grid-11.jpg') }}" alt="" class="lazyload">
                                    <div class="heart tf-action-btns">
                                    </div>
                                    <a class="caption-2 tf-btn style-uppercase ls-1">Discovery</a>
                                </div>
                                <div class="tour-grid-content">
                                    <div class="top">
                                        <div class="map-ping">
                                            <svg width="20" height="20" viewBox="0 0 24 28" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M21 14C21 21 12 27 12 27C12 27 3 21 3 14C3 11.6131 3.94821 9.32387 5.63604 7.63604C7.32387 5.94821 9.61305 5 12 5C14.3869 5 16.6761 5.94821 18.364 7.63604C20.0518 9.32387 21 11.6131 21 14Z"
                                                    stroke="#fff" stroke-width="1.2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M12 17C13.6569 17 15 15.6569 15 14C15 12.3431 13.6569 11 12 11C10.3431 11 9 12.3431 9 14C9 15.6569 10.3431 17 12 17Z"
                                                    stroke="#fff" stroke-width="1.2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>

                                            <a class="text-body-3 text">Los Anglese</a>
                                        </div>
                                        <div class="rating">
                                            <div class="number text-body-3 fw-6">4.7</div>
                                            <i class="icon-star1"></i>
                                        </div>
                                    </div>
                                    <div class="title text-body-2 fw-6">
                                        <a href="tours-details-2.html"
                                            class="title text-body-2 fw-6">Experience the Mysteries of the
                                            Ancient World</a>
                                    </div>
                                    <div class="tour-grid-details">
                                        <a class="people text-body-3">
                                            <i class="icon-Users1"></i>
                                            32 People
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
                                <div class="overlay"></div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="tour-grid hover-img style-2">
                                <a href="tours-details-2.html" class="link-img"></a>
                                <div class="image">
                                    <img src="{{ asset('frontend/image/tour-grid/tour-grid-12.jpg') }}"
                                        data-src="{{ asset('frontend/image/tour-grid/tour-grid-12.jpg') }}" alt="" class="lazyload">
                                    <div class="heart tf-action-btns">
                                    </div>
                                    <a class="caption-2 tf-btn style-uppercase ls-1">Beach</a>
                                </div>
                                <div class="tour-grid-content">
                                    <div class="top">
                                        <div class="map-ping">
                                            <svg width="20" height="20" viewBox="0 0 24 28" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M21 14C21 21 12 27 12 27C12 27 3 21 3 14C3 11.6131 3.94821 9.32387 5.63604 7.63604C7.32387 5.94821 9.61305 5 12 5C14.3869 5 16.6761 5.94821 18.364 7.63604C20.0518 9.32387 21 11.6131 21 14Z"
                                                    stroke="#fff" stroke-width="1.2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M12 17C13.6569 17 15 15.6569 15 14C15 12.3431 13.6569 11 12 11C10.3431 11 9 12.3431 9 14C9 15.6569 10.3431 17 12 17Z"
                                                    stroke="#fff" stroke-width="1.2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>

                                            <a class="text-body-3 text">Los Anglese</a>
                                        </div>
                                        <div class="rating">
                                            <div class="number text-body-3 fw-6">4.2</div>
                                            <i class="icon-star1"></i>
                                        </div>
                                    </div>
                                    <div class="title text-body-2 fw-6">
                                        <a href="tours-details-2.html"
                                            class="title text-body-2 fw-6">Explore Majestic Rivers and
                                            Waterways</a>
                                    </div>
                                    <div class="tour-grid-details">
                                        <a class="people text-body-3">
                                            <i class="icon-Users1"></i>
                                            32 People
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
                                <div class="overlay"></div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="tour-grid hover-img style-2">
                                <a href="tours-details-2.html" class="link-img"></a>
                                <div class="image">
                                    <img src="{{ asset('frontend/image/tour-grid/tour-grid-13.jpg') }}"
                                        data-src="{{ asset('frontend/image/tour-grid/tour-grid-13.jpg') }}" alt="" class="lazyload">
                                    <div class="heart tf-action-btns">
                                    </div>
                                    <a class="caption-2 tf-btn style-uppercase ls-1">Beach</a>
                                </div>
                                <div class="tour-grid-content">
                                    <div class="top">
                                        <div class="map-ping">
                                            <svg width="20" height="20" viewBox="0 0 24 28" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M21 14C21 21 12 27 12 27C12 27 3 21 3 14C3 11.6131 3.94821 9.32387 5.63604 7.63604C7.32387 5.94821 9.61305 5 12 5C14.3869 5 16.6761 5.94821 18.364 7.63604C20.0518 9.32387 21 11.6131 21 14Z"
                                                    stroke="#fff" stroke-width="1.2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M12 17C13.6569 17 15 15.6569 15 14C15 12.3431 13.6569 11 12 11C10.3431 11 9 12.3431 9 14C9 15.6569 10.3431 17 12 17Z"
                                                    stroke="#fff" stroke-width="1.2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>

                                            <a class="text-body-3 text">Los Anglese</a>
                                        </div>
                                        <div class="rating">
                                            <div class="number text-body-3 fw-6">4.9</div>
                                            <i class="icon-star1"></i>
                                        </div>
                                    </div>
                                    <div class="title text-body-2 fw-6">
                                        <a href="tours-details-2.html" class="title text-body-2 fw-6">Wild
                                            Adventures Under the Beautiful Starry Sky</a>
                                    </div>
                                    <div class="tour-grid-details">
                                        <a class="people text-body-3">
                                            <i class="icon-Users1"></i>
                                            32 People
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
                                <div class="overlay"></div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="tour-grid hover-img style-2">
                                <a href="tours-details-2.html" class="link-img"></a>
                                <div class="image">
                                    <img src="{{ asset('frontend/image/tour-grid/tour-grid-14.jpg') }}"
                                        data-src="{{ asset('frontend/image/tour-grid/tour-grid-14.jpg') }}" alt="" class="lazyload">
                                    <div class="heart tf-action-btns">
                                    </div>
                                    <a class="caption-2 tf-btn style-uppercase ls-1">Beach</a>
                                </div>
                                <div class="tour-grid-content">
                                    <div class="top">
                                        <div class="map-ping">
                                            <svg width="20" height="20" viewBox="0 0 24 28" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M21 14C21 21 12 27 12 27C12 27 3 21 3 14C3 11.6131 3.94821 9.32387 5.63604 7.63604C7.32387 5.94821 9.61305 5 12 5C14.3869 5 16.6761 5.94821 18.364 7.63604C20.0518 9.32387 21 11.6131 21 14Z"
                                                    stroke="#fff" stroke-width="1.2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M12 17C13.6569 17 15 15.6569 15 14C15 12.3431 13.6569 11 12 11C10.3431 11 9 12.3431 9 14C9 15.6569 10.3431 17 12 17Z"
                                                    stroke="#fff" stroke-width="1.2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>

                                            <a class="text-body-3 text">Los Anglese</a>
                                        </div>
                                        <div class="rating">
                                            <div class="number text-body-3 fw-6">4.6</div>
                                            <i class="icon-star1"></i>
                                        </div>
                                    </div>
                                    <div class="title text-body-2 fw-6">
                                        <a href="tours-details-2.html"
                                            class="title text-body-2 fw-6">Retreat in Nature’s Untouched
                                            Beauty</a>
                                    </div>
                                    <div class="tour-grid-details">
                                        <a class="people text-body-3">
                                            <i class="icon-Users1"></i>
                                            32 People
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
                                <div class="overlay"></div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="tour-grid hover-img style-2">
                                <a href="tours-details-2.html" class="link-img"></a>
                                <div class="image">
                                    <img src="{{ asset('frontend/image/tour-grid/tour-grid-15.jpg') }}"
                                        data-src="{{ asset('frontend/image/tour-grid/tour-grid-15.jpg') }}" alt="" class="lazyload">
                                    <div class="heart tf-action-btns">
                                    </div>
                                    <a class="caption-2 tf-btn style-uppercase ls-1">Discovery</a>
                                </div>
                                <div class="tour-grid-content">
                                    <div class="top">
                                        <div class="map-ping">
                                            <svg width="20" height="20" viewBox="0 0 24 28" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M21 14C21 21 12 27 12 27C12 27 3 21 3 14C3 11.6131 3.94821 9.32387 5.63604 7.63604C7.32387 5.94821 9.61305 5 12 5C14.3869 5 16.6761 5.94821 18.364 7.63604C20.0518 9.32387 21 11.6131 21 14Z"
                                                    stroke="#fff" stroke-width="1.2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M12 17C13.6569 17 15 15.6569 15 14C15 12.3431 13.6569 11 12 11C10.3431 11 9 12.3431 9 14C9 15.6569 10.3431 17 12 17Z"
                                                    stroke="#fff" stroke-width="1.2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>

                                            <a class="text-body-3 text">Los Anglese</a>
                                        </div>
                                        <div class="rating">
                                            <div class="number text-body-3 fw-6">4.6</div>
                                            <i class="icon-star1"></i>
                                        </div>
                                    </div>
                                    <div class="title text-body-2 fw-6">
                                        <a href="tours-details-2.html"
                                            class="title text-body-2 fw-6">Journey Through Rich Culture and
                                            History</a>
                                    </div>
                                    <div class="tour-grid-details">
                                        <a class="people text-body-3">
                                            <i class="icon-Users1"></i>
                                            32 People
                                        </a>
                                        <a class="days text-body-3">
                                            <i class="icon-Clock1"></i>
                                            3 Days/2 Night
                                        </a>
                                    </div>
                                    <div class="price text-body-3">
                                        Starting from: <span class="text-body-2 fw-6">$180</span>
                                    </div>
                                </div>
                                <div class="overlay"></div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="tour-grid hover-img style-2">
                                <a href="tours-details-2.html" class="link-img"></a>
                                <div class="image">
                                    <img src="{{ asset('frontend/image/tour-grid/tour-grid-16.jpg') }}"
                                                data-src="{{ asset('frontend/image/tour-grid/tour-grid-16.jpg') }}" alt="" class="lazyload">
                                    <div class="heart tf-action-btns">
                                    </div>
                                    <a class="caption-2 tf-btn style-uppercase ls-1">Beach</a>
                                </div>
                                <div class="tour-grid-content">
                                    <div class="top">
                                        <div class="map-ping">
                                            <svg width="20" height="20" viewBox="0 0 24 28" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M21 14C21 21 12 27 12 27C12 27 3 21 3 14C3 11.6131 3.94821 9.32387 5.63604 7.63604C7.32387 5.94821 9.61305 5 12 5C14.3869 5 16.6761 5.94821 18.364 7.63604C20.0518 9.32387 21 11.6131 21 14Z"
                                                    stroke="#fff" stroke-width="1.2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M12 17C13.6569 17 15 15.6569 15 14C15 12.3431 13.6569 11 12 11C10.3431 11 9 12.3431 9 14C9 15.6569 10.3431 17 12 17Z"
                                                    stroke="#fff" stroke-width="1.2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>

                                            <a class="text-body-3 text">Los Anglese</a>
                                        </div>
                                        <div class="rating">
                                            <div class="number text-body-3 fw-6">4.9</div>
                                            <i class="icon-star1"></i>
                                        </div>
                                    </div>
                                    <div class="title text-body-2 fw-6">
                                        <a href="tours-details-2.html"
                                            class="title text-body-2 fw-6">Perfect Getaway in the Great
                                            Outdoors</a>
                                    </div>
                                    <div class="tour-grid-details">
                                        <a class="people text-body-3">
                                            <i class="icon-Users1"></i>
                                            32 People
                                        </a>
                                        <a class="days text-body-3">
                                            <i class="icon-Clock1"></i>
                                            3 Days/2 Night
                                        </a>
                                    </div>
                                    <div class="price text-body-3">
                                        Starting from: <span class="text-body-2 fw-6">$352</span>
                                    </div>
                                </div>
                                <div class="overlay"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bottom-slide">
                    <div class="swiper-pagination pagination-tour-grid-2">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tf-container">
        <div class="row">
            <div class="col-12">
                <div class="help text-body-2 text-center">
                    We Help Your find the prefect Tours. it’s completely free. <a href="#"
                        class="tf-btn text-body-2 style-border-bottom">Explore all Tours</a>
                </div>
            </div>
        </div>
    </div>
</section><!-- /.section-tours -->

<!-- Section-step -->
<section class="section-step tf-spacing-4">
    <div class="tf-container">
        <div class="row">
            <div class="col-12">
                <div class="step-inner">
                    <div class="step-left">
                        <div class="heading-section">
                            <h3 class="title fw-6 pb-16 wow fadeInUp">
                                Lợi ích khi chọn ABM
                            </h3>
                            <div class="sub-title text-body-2 pb-40 wow fadeInUp">
                            ABM cam kết cung cấp các dịch vụ kế toán, thuế và đào tạo với chi phí cạnh tranh, tối ưu hóa ngân sách cho doanh nghiệp. Quy trình làm việc nhanh chóng, đúng tiến độ giúp tiết kiệm thời gian, đảm bảo doanh nghiệp luôn tuân thủ các quy định pháp luật kịp thời.
                            </div>
                            <a href="/lien-he" class="tf-btn color-primary wow fadeInUp">Liên hệ</a>
                        </div>
                    </div>
                    <div class="step-right">
                        <div class="box-icon wow fadeInUp" data-wow-delay="0.1s">
                            <div class="icon">
                                <img src="{{ asset('frontend/image/icon/find.png') }}" data-src="{{ asset('frontend/image/icon/find.png') }}" alt=""
                                    class="lazyload">
                            </div>
                            <div class="box-icon-content">
                                <h5 class="title fw-6">
                                    <a href="#">Hỗ trợ trên mọi miền tổ quốc. </a>
                                </h5>
                                <div class="text text-body-3">
                                </div>
                            </div>
                        </div>
                        <div class="box-icon wow fadeInUp" data-wow-delay="0.1s">
                            <div class="icon">
                                <img src="{{ asset('frontend/image/icon/book.png') }}" data-src="{{ asset('frontend/image/icon/book.png') }}" alt=""
                                    class="lazyload">
                            </div>
                            <div class="box-icon-content">
                                <h5 class="title fw-6">
                                    <a href="#">Chi phí - thời gian hợp lý.</a>
                                </h5>
                                <div class="text text-body-3">
                                </div>
                            </div>
                        </div>
                        <div class="box-icon wow fadeInUp" data-wow-delay="0.1s">
                            <div class="icon">
                                <img src="{{ asset('frontend/image/icon/pay.png') }}" data-src="{{ asset('frontend/image/icon/pay.png') }}" alt=""
                                    class="lazyload">
                            </div>
                            <div class="box-icon-content">
                                <h5 class="title fw-6">
                                    <a href="#">Đội ngũ nhân sự chuyên nghiệp, nhiệt tình.</a>
                                </h5>
                                <div class="text text-body-3">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- /.section-step -->

<!-- Section-location -->
<section class="section-location tf-spacing-4">
    <div class="tf-container">
        <div class="row">
            <div class="col-12">
                <div class="heading-section text-center pl-12">
                    <h3 class="title fw-6 pb-16 wow fadeInUp">
                        Trending Tour Location
                    </h3>
                    <div class="sub-title text-body-2 wow fadeInUp">
                        An Escape for Thrill-Seekers and Relaxation Enthusiasts.
                    </div>
                </div>
                <div class="wg-location-slider ml-5">
                    <div class="slider-section-prev-4 section-prev btn-arrow style-2">
                        <i class="icon-back1"></i>
                    </div>
                    <div class="slider-section-next-4 section-next btn-arrow style-2">
                        <i class="icon-next1"></i>
                    </div>
                    <div class="swiper-container location-swiper slider-auto">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="box-card style-2 active hover-img">
                                    <div class="box-card-inner">
                                        <a href="#" class="image">
                                            <img src="{{ asset('frontend/image/box-card/box-card-7.jpg') }}"
                                                data-src="{{ asset('frontend/image/box-card/box-card-7.jpg') }}" alt=""
                                                class="lazyload">
                                        </a>
                                        <div class="content">
                                            <h5 class="name fw-6">
                                                <a href="#">
                                                    Tokyo, Japan
                                                </a>
                                            </h5>
                                            <div class="number-tours text-body-3">
                                                28 Tours
                                            </div>
                                        </div>
                                        <div class="content-abs">
                                            <div class="info">
                                                <h5 class="name fw-6">
                                                    <a href="#">
                                                        Tokyo, Japan
                                                    </a>
                                                </h5>
                                                <div class="number-tours text-body-3">
                                                    28 Tours
                                                </div>
                                            </div>
                                            <div class="btn-card">
                                                <a href="#" class="tf-btn color-primary">
                                                    View All
                                                </a>
                                            </div>
                                        </div>
                                        <div class="overlay"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="box-card style-2 hover-img">
                                    <div class="box-card-inner">
                                        <a href="#" class="image">
                                            <img src="{{ asset('frontend/image/box-card/box-card-8.jpg') }}"
                                                data-src="{{ asset('frontend/image/box-card/box-card-8.jpg') }}" alt=""
                                                class="lazyload">
                                        </a>
                                        <div class="content">
                                            <h5 class="name fw-6">
                                                <a href="#">
                                                    Gyeongju, Korean
                                                </a>
                                            </h5>
                                            <div class="number-tours text-body-3">
                                                28 Tours
                                            </div>
                                        </div>
                                        <div class="content-abs">
                                            <div class="info">
                                                <h5 class="name fw-6">
                                                    <a href="#">
                                                        Gyeongju, Korean
                                                    </a>
                                                </h5>
                                                <div class="number-tours text-body-3">
                                                    28 Tours
                                                </div>
                                            </div>
                                            <div class="btn-card">
                                                <a href="#" class="tf-btn color-primary">
                                                    View All
                                                </a>
                                            </div>
                                        </div>
                                        <div class="overlay"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="box-card style-2 hover-img">
                                    <div class="box-card-inner">
                                        <a href="#" class="image">
                                            <img src="{{ asset('frontend/image/box-card/box-card-9.jpg') }}"
                                                data-src="{{ asset('frontend/image/box-card/box-card-9.jpg') }}" alt=""
                                                class="lazyload">
                                        </a>
                                        <div class="content">
                                            <h5 class="name fw-6">
                                                <a href="#">
                                                    Mount Fuji, Japan
                                                </a>
                                            </h5>
                                            <div class="number-tours text-body-3">
                                                28 Tours
                                            </div>
                                        </div>
                                        <div class="content-abs">
                                            <div class="info">
                                                <h5 class="name fw-6">
                                                    <a href="#">
                                                        Mount Fuji, Japan
                                                    </a>
                                                </h5>
                                                <div class="number-tours text-body-3">
                                                    28 Tours
                                                </div>
                                            </div>
                                            <div class="btn-card">
                                                <a href="#" class="tf-btn color-primary">
                                                    View All
                                                </a>
                                            </div>
                                        </div>
                                        <div class="overlay"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="box-card style-2 hover-img">
                                    <div class="box-card-inner">
                                        <a href="#" class="image">
                                            <img src="{{ asset('frontend/image/box-card/box-card-10.jpg') }}"
                                                data-src="{{ asset('frontend/image/box-card/box-card-10.jpg') }}" alt=""
                                                class="lazyload">
                                        </a>
                                        <div class="content">
                                            <h5 class="name fw-6">
                                                <a href="#">
                                                    Heidelberg, France
                                                </a>
                                            </h5>
                                            <div class="number-tours text-body-3">
                                                28 Tours
                                            </div>
                                        </div>
                                        <div class="content-abs">
                                            <div class="info">
                                                <h5 class="name fw-6">
                                                    <a href="#">
                                                        Heidelberg, France
                                                    </a>
                                                </h5>
                                                <div class="number-tours text-body-3">
                                                    28 Tours
                                                </div>
                                            </div>
                                            <div class="btn-card">
                                                <a href="#" class="tf-btn color-primary">
                                                    View All
                                                </a>
                                            </div>
                                        </div>
                                        <div class="overlay"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="box-card style-2 hover-img">
                                    <div class="box-card-inner">
                                        <a href="#" class="image">
                                            <img src="{{ asset('frontend/image/box-card/box-card-11.jpg') }}"
                                                data-src="{{ asset('frontend/image/box-card/box-card-11.jpg') }}" alt=""
                                                class="lazyload">
                                        </a>
                                        <div class="content">
                                            <h5 class="name fw-6">
                                                <a href="#">
                                                    Ha Long, VietNam
                                                </a>
                                            </h5>
                                            <div class="number-tours text-body-3">
                                                28 Tours
                                            </div>
                                        </div>
                                        <div class="content-abs">
                                            <div class="info">
                                                <h5 class="name fw-6">
                                                    <a href="#">
                                                        Ha Long, VietNam
                                                    </a>
                                                </h5>
                                                <div class="number-tours text-body-3">
                                                    28 Tours
                                                </div>
                                            </div>
                                            <div class="btn-card">
                                                <a href="#" class="tf-btn color-primary">
                                                    View All
                                                </a>
                                            </div>
                                        </div>
                                        <div class="overlay"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="box-card style-2 hover-img">
                                    <div class="box-card-inner">
                                        <a href="#" class="image">
                                            <img src="{{ asset('frontend/image/box-card/box-card-7.jpg') }}"
                                                data-src="{{ asset('frontend/image/box-card/box-card-7.jpg') }}" alt=""
                                                class="lazyload">
                                        </a>
                                        <div class="content">
                                            <h5 class="name fw-6">
                                                <a href="#">
                                                    Tokyo, Japan
                                                </a>
                                            </h5>
                                            <div class="number-tours text-body-3">
                                                28 Tours
                                            </div>
                                        </div>
                                        <div class="content-abs">
                                            <div class="info">
                                                <h5 class="name fw-6">
                                                    <a href="#">
                                                        Tokyo, Japan
                                                    </a>
                                                </h5>
                                                <div class="number-tours text-body-3">
                                                    28 Tours
                                                </div>
                                            </div>
                                            <div class="btn-card">
                                                <a href="#" class="tf-btn color-primary">
                                                    View All
                                                </a>
                                            </div>
                                        </div>
                                        <div class="overlay"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="box-card style-2 hover-img">
                                    <div class="box-card-inner">
                                        <a href="#" class="image">
                                            <img src="{{ asset('frontend/image/box-card/box-card-8.jpg') }}"
                                                data-src="{{ asset('frontend/image/box-card/box-card-8.jpg') }}" alt=""
                                                class="lazyload">
                                        </a>
                                        <div class="content">
                                            <h5 class="name fw-6">
                                                <a href="#">
                                                    Gyeongju, Korean
                                                </a>
                                            </h5>
                                            <div class="number-tours text-body-3">
                                                28 Tours
                                            </div>
                                        </div>
                                        <div class="content-abs">
                                            <div class="info">
                                                <h5 class="name fw-6">
                                                    <a href="#">
                                                        Gyeongju, Korean
                                                    </a>
                                                </h5>
                                                <div class="number-tours text-body-3">
                                                    28 Tours
                                                </div>
                                            </div>
                                            <div class="btn-card">
                                                <a href="#" class="tf-btn color-primary">
                                                    View All
                                                </a>
                                            </div>
                                        </div>
                                        <div class="overlay"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bottom-slide">
                        <div class="swiper-pagination pagination-location">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- /.section-location -->

<!-- Section-new -->
<section class="section-new tf-spacing-8">
    <div class="tf-container">
        <div class="row">
            <div class="col-12">
                <div class="heading-section text-center">
                    <h3 class="title fw-6 pb-16 wow fadeInUp">
                        Tin tức nổi bật
                    </h3>
                    <div class="sub-title text-body-2 wow fadeInUp">
                        Tips & insights we collected through the years.
                    </div>
                </div>
                <div class="slider-section-new">
                    <div class="swiper-container section-new-swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="blog-item hover-img">
                                    <div class="image ">
                                        <a href="blog-post.html">
                                            <img src="{{ asset('frontend/image/blog/blog-item-8.jpg') }}"
                                                data-src="{{ asset('frontend/image/blog/blog-item-8.jpg') }}" alt=""
                                                class="lazyload">
                                        </a>
                                        <a href="#" class="date style-2">
                                            <span class="day fw-6">
                                                28
                                            </span>
                                            <span class="caption-2">FEB</span>
                                        </a>
                                    </div>
                                    <div class="blog-item-content">
                                        <div class="tags-content style-2 pb-12">
                                            <div class="frame">
                                                <div class="text">
                                                    By David
                                                </div>
                                            </div>
                                            <div class="line"></div>
                                            <div class="frame">
                                                <div class="text">
                                                    Travel
                                                </div>
                                            </div>
                                        </div>
                                        <h5 class="title fw-6 pb-12">
                                            <a href="blog-post.html">Tour Packages to Consider for Your Next
                                                Vacation.</a>
                                        </h5>
                                        <div class="text-body-3 text">Explore a curated list of 10
                                            extraordinary Glamping
                                            destinations worldwide...</div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="blog-item hover-img">
                                    <div class="image ">
                                        <a href="blog-post.html">
                                            <img src="{{ asset('frontend/image/blog/blog-item-9.jpg') }}"
                                                data-src="{{ asset('frontend/image/blog/blog-item-9.jpg') }}" alt=""
                                                class="lazyload">
                                        </a>
                                        <a href="#" class="date style-2">
                                            <span class="day fw-6">
                                                28
                                            </span>
                                            <span class="caption-2">FEB</span>
                                        </a>
                                    </div>
                                    <div class="blog-item-content">
                                        <div class="tags-content style-2 pb-12">
                                            <div class="frame">
                                                <div class="text">
                                                    By David
                                                </div>
                                            </div>
                                            <div class="line"></div>
                                            <div class="frame">
                                                <div class="text">
                                                    Travel
                                                </div>
                                            </div>
                                        </div>
                                        <h5 class="title fw-6 pb-12">
                                            <a href="blog-post.html">Camping in Style Tips for a Comfortable
                                                and Enjoyable
                                                Trip</a>
                                        </h5>
                                        <div class="text-body-3 text">Explore a curated list of 10
                                            extraordinary Glamping
                                            destinations worldwide...</div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="blog-item hover-img">
                                    <div class="image ">
                                        <a href="blog-post.html">
                                            <img src="{{ asset('frontend/image/blog/blog-item-3.jpg') }}"
                                                    data-src="{{ asset('frontend/image/blog/blog-item-3.jpg') }}" alt=""
                                                class="lazyload">
                                        </a>
                                        <a href="#" class="date style-2">
                                            <span class="day fw-6">
                                                28
                                            </span>
                                            <span class="caption-2">FEB</span>
                                        </a>
                                    </div>
                                    <div class="blog-item-content">
                                        <div class="tags-content style-2 pb-12">
                                            <div class="frame">
                                                <div class="text">
                                                    By David
                                                </div>
                                            </div>
                                            <div class="line"></div>
                                            <div class="frame">
                                                <div class="text">
                                                    Travel
                                                </div>
                                            </div>
                                        </div>
                                        <h5 class="title fw-6 pb-12">
                                            <a href="blog-post.html">Explore the World Travel Tips for Every
                                                Type of
                                                Traveler</a>
                                        </h5>
                                        <div class="text-body-3 text">Explore a curated list of 10
                                            extraordinary Glamping
                                            destinations worldwide...</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bottom-slide">
                    <div class="swiper-pagination pagination-section-new">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- /.section-new -->

</div><!-- /.main-content -->
@endsection 