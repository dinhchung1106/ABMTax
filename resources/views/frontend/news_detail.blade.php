@extends('frontend.layout')
@section('title', $news->title . ' - Tin tức | ' . ($company->name ?? 'ABM Tax'))
@section('meta_description', $news->seo_keywords)
@section('content')
<!-- <section class="section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h1 class="section-title mb-3">{{ $news->title }}</h1>
                <div class="mb-3">
                    <span class="badge bg-primary">{{ $news->category }}</span>
                </div>
                <img src="{{ $news->image }}" alt="{{ $news->title }}" class="img-fluid rounded-4 shadow mb-4 w-100">
                <div class="fs-5 mb-4">{!! nl2br(e($news->content)) !!}</div>
                <a href="/tin-tuc" class="btn btn-outline-secondary">← Quay lại danh sách tin tức</a>
            </div>
        </div>
    </div>
</section> -->

 <!-- Main-content -->
 <div class="main-content tf-spacing-1">
            <div class="tf-container">
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Blog-details -->
                        <div class="blog-details tf-spacing-2">
                            <div class="btn-top">
                                <a class="tf-btn style-uppercase style-2 wow fadeInUp">
                                    TRAVEL
                                </a>
                                <a class="tf-btn style-uppercase style-2 wow fadeInUp" data-wow-delay="0.1s">
                                    SEA
                                </a>
                            </div>
                            <h3 class="title wow fadeInUp">
                                Discover the Best Sights and Experiences in Iconic Destinations Around the Globe
                            </h3>
                            <div class="tags pb-40">
                                <div class="tags-content wow fadeInUp">
                                    <div class="frame">
                                        <div class="icon">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M18.0407 16.5624C16.8508 14.5054 15.0172 13.0304 12.8774 12.3312C13.9358 11.7011 14.7582 10.7409 15.2182 9.59821C15.6781 8.45548 15.7503 7.19337 15.4235 6.00568C15.0968 4.81798 14.3892 3.77039 13.4094 3.02378C12.4296 2.27716 11.2318 1.8728 10 1.8728C8.76821 1.8728 7.57044 2.27716 6.59067 3.02378C5.6109 3.77039 4.90331 4.81798 4.57654 6.00568C4.24978 7.19337 4.32193 8.45548 4.78189 9.59821C5.24186 10.7409 6.06422 11.7011 7.12268 12.3312C4.98284 13.0296 3.14925 14.5046 1.9594 16.5624C1.91577 16.6336 1.88683 16.7127 1.87429 16.7953C1.86174 16.8778 1.86585 16.962 1.88638 17.0429C1.9069 17.1238 1.94341 17.1997 1.99377 17.2663C2.04413 17.3328 2.10731 17.3886 2.17958 17.4304C2.25185 17.4721 2.33175 17.499 2.41457 17.5093C2.49738 17.5197 2.58143 17.5134 2.66176 17.4907C2.74209 17.4681 2.81708 17.4296 2.88228 17.3775C2.94749 17.3254 3.00161 17.2608 3.04143 17.1874C4.51331 14.6437 7.11487 13.1249 10 13.1249C12.8852 13.1249 15.4867 14.6437 16.9586 17.1874C16.9985 17.2608 17.0526 17.3254 17.1178 17.3775C17.183 17.4296 17.258 17.4681 17.3383 17.4907C17.4186 17.5134 17.5027 17.5197 17.5855 17.5093C17.6683 17.499 17.7482 17.4721 17.8205 17.4304C17.8927 17.3886 17.9559 17.3328 18.0063 17.2663C18.0566 17.1997 18.0932 17.1238 18.1137 17.0429C18.1342 16.962 18.1383 16.8778 18.1258 16.7953C18.1132 16.7127 18.0843 16.6336 18.0407 16.5624ZM5.62503 7.49993C5.62503 6.63463 5.88162 5.78877 6.36235 5.06931C6.84308 4.34984 7.52636 3.78909 8.32579 3.45796C9.12522 3.12682 10.0049 3.04018 10.8535 3.20899C11.7022 3.3778 12.4818 3.79448 13.0936 4.40634C13.7055 5.01819 14.1222 5.79774 14.291 6.64641C14.4598 7.49508 14.3731 8.37474 14.042 9.17417C13.7109 9.9736 13.1501 10.6569 12.4306 11.1376C11.7112 11.6183 10.8653 11.8749 10 11.8749C8.84009 11.8737 7.72801 11.4124 6.90781 10.5922C6.0876 9.77195 5.62627 8.65987 5.62503 7.49993Z"
                                                    fill="#121212" />
                                            </svg>
                                        </div>
                                        <div class="text-body-3 text">
                                            By David
                                        </div>
                                    </div>
                                    <div class="line"></div>
                                    <div class="frame">
                                        <div class="icon">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M16.2222 3.33398H3.77778C2.79594 3.33398 2 4.08018 2 5.00065V16.6673C2 17.5878 2.79594 18.334 3.77778 18.334H16.2222C17.2041 18.334 18 17.5878 18 16.6673V5.00065C18 4.08018 17.2041 3.33398 16.2222 3.33398Z"
                                                    stroke="#121212" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M12.834 1.66602V4.99935" stroke="#121212"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M6.16602 1.66602V4.99935" stroke="#121212"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M2 8.33398H18" stroke="#121212" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>

                                        </div>
                                        <div class="text-body-3 text">
                                            February 28, 2024
                                        </div>
                                    </div>
                                </div>
                                <div class="tags-content wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="frame">
                                        <div class="icon">
                                            <svg width="22" height="20" viewBox="0 0 22 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M20.7559 15.5087C21.2741 14.4338 21.5284 13.2508 21.4976 12.058C21.4668 10.8651 21.1518 9.6968 20.5788 8.6501C20.0058 7.60341 19.1914 6.70854 18.2031 6.03984C17.2148 5.37113 16.0812 4.94789 14.8965 4.80527C14.5023 3.88873 13.9292 3.06007 13.2107 2.36779C12.4923 1.67551 11.6429 1.13353 10.7124 0.773604C9.78186 0.413674 8.78887 0.243022 7.79157 0.271641C6.79427 0.300261 5.81271 0.527576 4.90435 0.940277C3.996 1.35298 3.17912 1.94277 2.50155 2.67511C1.82398 3.40745 1.29934 4.26762 0.958344 5.20525C0.617353 6.14288 0.466867 7.13912 0.515698 8.13563C0.56453 9.13215 0.811699 10.1089 1.24273 11.0087L0.561167 13.3253C0.484962 13.5839 0.479867 13.8582 0.546416 14.1195C0.612966 14.3808 0.748701 14.6193 0.93934 14.8099C1.12998 15.0005 1.36848 15.1363 1.62974 15.2028C1.891 15.2694 2.16537 15.2643 2.42398 15.1881L4.74054 14.5065C5.48438 14.8639 6.28187 15.0967 7.10117 15.1956C7.49921 16.1282 8.08224 16.9704 8.81501 17.6713C9.54779 18.3723 10.4151 18.9173 11.3645 19.2735C12.3139 19.6297 13.3256 19.7897 14.3386 19.7438C15.3516 19.698 16.3447 19.4471 17.258 19.0065L19.5746 19.6881C19.8331 19.7642 20.1074 19.7693 20.3685 19.7027C20.6297 19.6362 20.8681 19.5006 21.0587 19.3101C21.2493 19.1196 21.385 18.8812 21.4517 18.6201C21.5183 18.359 21.5134 18.0848 21.4374 17.8262L20.7559 15.5087ZM4.81179 12.9531C4.74012 12.9532 4.66882 12.9633 4.59992 12.9831L1.99929 13.75L2.76523 11.1475C2.8197 10.9594 2.79851 10.7576 2.70617 10.585C2.02771 9.31612 1.8278 7.84573 2.14288 6.44182C2.45797 5.03792 3.26706 3.79398 4.42268 2.93678C5.57829 2.07958 7.00347 1.66619 8.4384 1.77198C9.87334 1.87778 11.2225 2.4957 12.2399 3.5131C13.2573 4.53051 13.8752 5.87965 13.981 7.31459C14.0868 8.74953 13.6734 10.1747 12.8162 11.3303C11.959 12.4859 10.7151 13.295 9.31117 13.6101C7.90726 13.9252 6.43687 13.7253 5.16804 13.0468C5.05893 12.9864 4.93649 12.9542 4.81179 12.9531ZM19.2296 15.6465L19.9993 18.25L17.3968 17.484C17.2088 17.4295 17.0069 17.4507 16.8343 17.5431C15.4532 18.2805 13.8387 18.4494 12.3349 18.0137C10.8311 17.578 9.5569 16.5721 8.78398 15.2106C9.8109 15.1034 10.8046 14.7852 11.7027 14.2758C12.6008 13.7665 13.384 13.077 14.0031 12.2507C14.6222 11.4244 15.0638 10.4791 15.3003 9.47405C15.5368 8.46901 15.5631 7.42593 15.3774 6.41027C16.2722 6.62117 17.1065 7.03485 17.816 7.61936C18.5255 8.20388 19.0912 8.9436 19.4694 9.78144C19.8476 10.6193 20.0283 11.5328 19.9975 12.4516C19.9666 13.3703 19.7251 14.2697 19.2915 15.0803C19.1981 15.2539 19.1769 15.4573 19.2324 15.6465H19.2296Z"
                                                    fill="#121212" />
                                            </svg>
                                        </div>
                                        <div class="text-body-3 text">
                                            12
                                        </div>
                                    </div>
                                    <div class="line"></div>
                                    <div class="frame">
                                        <div class="icon">
                                            <svg width="24" height="16" viewBox="0 0 24 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M23.1853 7.69625C23.1525 7.62219 22.3584 5.86062 20.5931 4.09531C18.2409 1.74312 15.27 0.5 12 0.5C8.72999 0.5 5.75905 1.74312 3.40687 4.09531C1.64155 5.86062 0.843741 7.625 0.814679 7.69625C0.772035 7.79217 0.75 7.89597 0.75 8.00094C0.75 8.10591 0.772035 8.20971 0.814679 8.30562C0.847491 8.37969 1.64155 10.1403 3.40687 11.9056C5.75905 14.2569 8.72999 15.5 12 15.5C15.27 15.5 18.2409 14.2569 20.5931 11.9056C22.3584 10.1403 23.1525 8.37969 23.1853 8.30562C23.2279 8.20971 23.25 8.10591 23.25 8.00094C23.25 7.89597 23.2279 7.79217 23.1853 7.69625ZM12 14C9.11437 14 6.59343 12.9509 4.50655 10.8828C3.65028 10.0313 2.92179 9.06027 2.34374 8C2.92164 6.93963 3.65014 5.9686 4.50655 5.11719C6.59343 3.04906 9.11437 2 12 2C14.8856 2 17.4066 3.04906 19.4934 5.11719C20.3514 5.9684 21.0815 6.93942 21.6609 8C20.985 9.26188 18.0403 14 12 14ZM12 3.5C11.11 3.5 10.2399 3.76392 9.49993 4.25839C8.7599 4.75285 8.18313 5.45566 7.84253 6.27792C7.50194 7.10019 7.41282 8.00499 7.58646 8.87791C7.76009 9.75082 8.18867 10.5526 8.81801 11.182C9.44735 11.8113 10.2492 12.2399 11.1221 12.4135C11.995 12.5872 12.8998 12.4981 13.7221 12.1575C14.5443 11.8169 15.2471 11.2401 15.7416 10.5001C16.2361 9.76005 16.5 8.89002 16.5 8C16.4988 6.80691 16.0242 5.66303 15.1806 4.81939C14.337 3.97575 13.1931 3.50124 12 3.5ZM12 11C11.4066 11 10.8266 10.8241 10.3333 10.4944C9.83993 10.1648 9.45542 9.69623 9.22835 9.14805C9.00129 8.59987 8.94188 7.99667 9.05764 7.41473C9.17339 6.83279 9.45911 6.29824 9.87867 5.87868C10.2982 5.45912 10.8328 5.1734 11.4147 5.05764C11.9967 4.94189 12.5999 5.0013 13.148 5.22836C13.6962 5.45542 14.1648 5.83994 14.4944 6.33329C14.824 6.82664 15 7.40666 15 8C15 8.79565 14.6839 9.55871 14.1213 10.1213C13.5587 10.6839 12.7956 11 12 11Z"
                                                    fill="#121212" />
                                            </svg>
                                        </div>
                                        <div class="text-body-3 text">
                                            260.2K
                                        </div>
                                    </div>
                                    <div class="line"></div>
                                    <div class="frame">
                                        <div class="icon">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M10 0.25C8.07164 0.25 6.18657 0.821828 4.58319 1.89317C2.97982 2.96451 1.73013 4.48726 0.992179 6.26884C0.254225 8.05042 0.061142 10.0108 0.437348 11.9021C0.813554 13.7934 1.74215 15.5307 3.10571 16.8943C4.46928 18.2579 6.20656 19.1865 8.09787 19.5627C9.98919 19.9389 11.9496 19.7458 13.7312 19.0078C15.5127 18.2699 17.0355 17.0202 18.1068 15.4168C19.1782 13.8134 19.75 11.9284 19.75 10C19.7473 7.41498 18.7192 4.93661 16.8913 3.10872C15.0634 1.28084 12.585 0.25273 10 0.25ZM10 18.25C8.36831 18.25 6.77326 17.7661 5.41655 16.8596C4.05984 15.9531 3.00242 14.6646 2.378 13.1571C1.75358 11.6496 1.5902 9.99085 1.90853 8.3905C2.22685 6.79016 3.01259 5.32015 4.16637 4.16637C5.32016 3.01259 6.79017 2.22685 8.39051 1.90852C9.99085 1.59019 11.6497 1.75357 13.1571 2.37799C14.6646 3.00242 15.9531 4.05984 16.8596 5.41655C17.7661 6.77325 18.25 8.3683 18.25 10C18.2475 12.1873 17.3775 14.2843 15.8309 15.8309C14.2843 17.3775 12.1873 18.2475 10 18.25ZM16 10C16 10.1989 15.921 10.3897 15.7803 10.5303C15.6397 10.671 15.4489 10.75 15.25 10.75H10C9.80109 10.75 9.61033 10.671 9.46967 10.5303C9.32902 10.3897 9.25 10.1989 9.25 10V4.75C9.25 4.55109 9.32902 4.36032 9.46967 4.21967C9.61033 4.07902 9.80109 4 10 4C10.1989 4 10.3897 4.07902 10.5303 4.21967C10.671 4.36032 10.75 4.55109 10.75 4.75V9.25H15.25C15.4489 9.25 15.6397 9.32902 15.7803 9.46967C15.921 9.61032 16 9.80109 16 10Z"
                                                    fill="#121212" />
                                            </svg>
                                        </div>
                                        <div class="text-body-3 text">
                                            5 Min Read
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="image hover-img">
                                <img src="image/blog/blog-defaults-1.jpg" data-src="image/blog/blog-defaults-1.jpg"
                                    alt="" class="lazyload">
                            </div>
                            <div class="content">
                                <div class="text text-body-2">
                                    Traveling around the world offers endless opportunities to explore diverse cultures,
                                    stunning landscapes, and historical landmarks. In this article, we will take you on
                                    a journey through some of the most iconic destinations around the globe,
                                    highlighting the best sights and experiences each has to offer. Whether you're an
                                    adventure seeker, a history buff, or a nature lover, these destinations have
                                    something special for everyone.
                                </div>
                            </div>
                            <div class="cape-town">
                                <h4 class="fw-6">Cape Town, South Africa</h4>
                                <ul>
                                    <li class="text-body-2">Table Mountain: Take a cable car to the top for stunning
                                        views of the city and coastline.</li>
                                    <li class="text-body-2">Robben Island: Visit the prison where Nelson Mandela was
                                        held and learn about South Africa's history.</li>
                                </ul>
                            </div>
                            <div class="wg-quote">
                                <h4 class="fw-6">"Uncover iconic destinations where unforgettable sights and experiences
                                    await."</h4>
                                <h6 class="name">Winston Churchi</h6>
                            </div>
                            <div class="image-blog-post">
                                <div class="image-item hover-img">
                                    <img src="image/blog/image-blog-post-1.jpg"
                                        data-src="image/blog/image-blog-post-1.jpg" alt="" class="lazyload">
                                </div>
                                <div class="image-item hover-img">
                                    <img src="image/blog/image-blog-post-2.jpg"
                                        data-src="image/blog/image-blog-post-2.jpg" alt="" class="lazyload">
                                </div>
                            </div>
                            <div class="wg-conclusion">
                                <h4>Conclusion</h4>
                                <div class="text-body-2 text">
                                    From the romantic streets of Paris to the vibrant cityscape of Sydney, the world is
                                    full of iconic destinations waiting to be explored. Each location offers its own
                                    unique sights and experiences that make it special. Whether you're planning your
                                    next big adventure or simply dreaming of far-off places, let these destinations
                                    inspire your travel plans and fill your journey with unforgettable memories.
                                </div>
                            </div>
                            <div class="wg-tags">
                                <div class="left">
                                    <span class="text-body-3">
                                        Tag:
                                    </span>
                                    <div class="tag-list">
                                        <a href="#" class="tag">Camping</a>
                                        <a href="#" class="tag">Cultural Tours</a>
                                        <a href="#" class="tag">Guides</a>
                                    </div>
                                </div>
                                <div class="right">
                                    <span class="text-body-3">
                                        Share:
                                    </span>
                                    <ul class="social style-2">
                                        <li class="social-icon fs-20"><a href="#"><i class="icon-fb1"></i></a></li>
                                        <li class="social-icon fs-20"><a href="#"><i class="icon-linkedin1"></i></a>
                                        </li>
                                        <li class="social-icon fs-20"><a href="#"><i class="icon-twitter2"></i></a></li>
                                        <li class="social-icon fs-20"><a href="#"><i class="icon-instagram21"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="wg-nex-pre">
                                <div class="pre nex-pre-content">
                                    <a href="#" class="text text-body-3 fw-6">
                                        Previous
                                    </a>
                                    <h6 class="fw-6">
                                        What You Need for an Unforgettable Outdoor Experience in Any Season
                                    </h6>
                                </div>
                                <div class="line"></div>
                                <div class="nex nex-pre-content">
                                    <a href="#" class="text text-body-3 fw-6">
                                        Next
                                    </a>
                                    <h6 class="fw-6">
                                        Top 10 Must-Visit Travel Destinations for Adventure Seekers
                                    </h6>
                                </div>
                            </div>
                        </div><!-- /.blog-details -->

                        <!-- Blog-comment -->
                        <div class="blog-comment tf-spacing-12">
                            <div class="review">
                                <div class="top">
                                    <h4 class="title fw-6">
                                        03 Comments
                                    </h4>
                                    <a href="#form-comment" class="tf-btn blog-search">Write A Review</a>
                                </div>
                                <div class="comment-review loadmore-item3">
                                    <div class="fl-item3">
                                        <div class="review-item pt-20">
                                            <div class="image">
                                                <img src="image/avata/avata-1.jpg" data-src="image/avata/avata-1.jpg"
                                                    alt="" class="lazyload">
                                            </div>
                                            <div class="review-content">
                                                <div class="top-content">
                                                    <div class="name">
                                                        <h6 class="fw-6"><a href="#">Mariya R.</a></h6>
                                                        <div class="date-review">
                                                            August 13, 2024
                                                        </div>
                                                    </div>
                                                    <div class="rating">
                                                        <i class="icon-star1"></i>
                                                        <i class="icon-star1"></i>
                                                        <i class="icon-star1"></i>
                                                        <i class="icon-star1"></i>
                                                        <i class="icon-star1"></i>
                                                    </div>
                                                </div>
                                                <div class="text-review text-body-3">
                                                    I really like the logo that Gihan created, and he was very
                                                    responsive
                                                    and great
                                                    to work with. I would recommend him to anyone looking for a logo or
                                                    graphic
                                                    design!
                                                </div>
                                                <div class="image-review">
                                                    <div class="img hover-img">
                                                        <img src="image/blog/review-1.jpg"
                                                            data-src="image/blog/review-1.jpg" alt="" class="lazyload">
                                                    </div>
                                                    <div class="img hover-img">
                                                        <img src="image/blog/review-2.jpg"
                                                            data-src="image/blog/review-2.jpg" alt="" class="lazyload">
                                                    </div>
                                                    <div class="img hover-img">
                                                        <img src="image/blog/review-3.jpg"
                                                            data-src="image/blog/review-3.jpg" alt="" class="lazyload">
                                                    </div>
                                                    <div class="img hover-img">
                                                        <img src="image/blog/review-4.jpg"
                                                            data-src="image/blog/review-4.jpg" alt="" class="lazyload">
                                                    </div>
                                                    <div class="more text-body-3 fw-6">
                                                        +12
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="fl-item3">
                                        <div class="review-item">
                                            <div class="image">
                                                <img src="image/avata/avata-2.jpg" data-src="image/avata/avata-2.jpg"
                                                    alt="" class="lazyload">
                                            </div>
                                            <div class="review-content">
                                                <div class="top-content">
                                                    <div class="name">
                                                        <h6 class="fw-6"><a href="#">Mariya R.</a></h6>
                                                        <div class="date-review">
                                                            August 13, 2024
                                                        </div>
                                                    </div>
                                                    <div class="rating">
                                                        <i class="icon-star1"></i>
                                                        <i class="icon-star1"></i>
                                                        <i class="icon-star1"></i>
                                                        <i class="icon-star1"></i>
                                                        <i class="icon-star1"></i>
                                                    </div>
                                                </div>
                                                <div class="text-review text-body-3">
                                                    I really like the logo that Gihan created, and he was very
                                                    responsive
                                                    and great
                                                    to work with. I would recommend him to anyone looking for a logo or
                                                    graphic
                                                    design!
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="fl-item3">
                                        <div class="review-item">
                                            <div class="image">
                                                <img src="image/avata/avata-3.jpg" data-src="image/avata/avata-3.jpg"
                                                    alt="" class="lazyload">
                                            </div>
                                            <div class="review-content">
                                                <div class="top-content">
                                                    <div class="name">
                                                        <h6 class="fw-6"><a href="#">Mariya R.</a></h6>
                                                        <div class="date-review">
                                                            August 13, 2024
                                                        </div>
                                                    </div>
                                                    <div class="rating">
                                                        <i class="icon-star1"></i>
                                                        <i class="icon-star1"></i>
                                                        <i class="icon-star1"></i>
                                                        <i class="icon-star1"></i>
                                                        <i class="icon-star1"></i>
                                                    </div>
                                                </div>
                                                <div class="text-review text-body-3">
                                                    I really like the logo that Gihan created, and he was very
                                                    responsive
                                                    and great
                                                    to work with. I would recommend him to anyone looking for a logo or
                                                    graphic
                                                    design!
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="fl-item3">
                                        <div class="review-item">
                                            <div class="image">
                                                <img src="image/avata/avata-2.jpg" data-src="image/avata/avata-2.jpg"
                                                    alt="" class="lazyload">
                                            </div>
                                            <div class="review-content">
                                                <div class="top-content">
                                                    <div class="name">
                                                        <h6 class="fw-6"><a href="#">Mariya R.</a></h6>
                                                        <div class="date-review">
                                                            August 13, 2024
                                                        </div>
                                                    </div>
                                                    <div class="rating">
                                                        <i class="icon-star1"></i>
                                                        <i class="icon-star1"></i>
                                                        <i class="icon-star1"></i>
                                                        <i class="icon-star1"></i>
                                                        <i class="icon-star1"></i>
                                                    </div>
                                                </div>
                                                <div class="text-review text-body-3">
                                                    I really like the logo that Gihan created, and he was very
                                                    responsive
                                                    and great
                                                    to work with. I would recommend him to anyone looking for a logo or
                                                    graphic
                                                    design!
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="fl-item3">
                                        <div class="review-item">
                                            <div class="image">
                                                <img src="image/avata/avata-3.jpg" data-src="image/avata/avata-3.jpg"
                                                    alt="" class="lazyload">
                                            </div>
                                            <div class="review-content">
                                                <div class="top-content">
                                                    <div class="name">
                                                        <h6 class="fw-6"><a href="#">Mariya R.</a></h6>
                                                        <div class="date-review">
                                                            August 13, 2024
                                                        </div>
                                                    </div>
                                                    <div class="rating">
                                                        <i class="icon-star1"></i>
                                                        <i class="icon-star1"></i>
                                                        <i class="icon-star1"></i>
                                                        <i class="icon-star1"></i>
                                                        <i class="icon-star1"></i>
                                                    </div>
                                                </div>
                                                <div class="text-review text-body-3">
                                                    I really like the logo that Gihan created, and he was very
                                                    responsive
                                                    and great
                                                    to work with. I would recommend him to anyone looking for a logo or
                                                    graphic
                                                    design!
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bottom view-more-button3">
                                    <a class="tf-btn style-border-bottom btn-loadmore3  ">View More</a>
                                </div>
                            </div>
                            <div class="comment" id="form-comment">
                                <h5 class="title fw-6">Be the first to review</h5>
                                <form action="https://chungdd.co/html/chungdd/@" class="form-comment">
                                    <div class="col">
                                        <fieldset class="pb-20">
                                            <label class="text-body-3 pb-3" for="name">Name</label>
                                            <input type="text" name="name" id="name" required="" value="Jony Dane">
                                        </fieldset>
                                        <fieldset class="pb-20">
                                            <label class="text-body-3 pb-3" for="email">Email</label>
                                            <input type="email" name="email" id="email" required=""
                                                value="contact.dinhchung@gmail.com">
                                        </fieldset>
                                    </div>
                                    <fieldset class="pb-20 check-box pl-3 gap-9">
                                        <input type="checkbox" name="checkbox" id="checkbox">
                                        <label class="text-body-3" for="checkbox">Save your name, email for the next
                                            time review</label>
                                    </fieldset>
                                    <fieldset class="pb-20">
                                        <label for="review" class="text-body-3 pb-3">Review</label>
                                        <textarea id="review" name="review" tabindex="2" aria-required="true"
                                            required="" placeholder="Write comment"></textarea>
                                    </fieldset>
                                    <div class="btn-bottom">
                                        <button type="submit" class="tf-btn color-primary">Post Comment</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.blog-comment -->

                    </div>
                    <div class="col-lg-4">
                        <!-- Sideber -->
                        <div class="sidebar">
                            <div class="wg-avatar">
                                <div class="avatar">
                                    <div class="image">
                                        <img src="image/avata/avatar-4.jpg" data-src="image/avata/avatar-4.jpg" alt=""
                                            class="lazyload">
                                    </div>
                                    <div class="avatar-top">
                                        <h6 class="name fw-6">
                                            <a href="#"> David</a>
                                        </h6>
                                        <div class="follower caption-1">
                                            200 Follower
                                        </div>
                                        <a href="#" class="tf-btn style-small style-boder">Follow Me</a>
                                    </div>
                                </div>
                                <div class="text text-body-2">
                                    chungdd (@chungdd) is a writer who draws. He's the Bestselling author of
                                    "Number of The Year". Donec vitae tortor efficitur, convallis lelobortis elit.
                                </div>
                            </div>
                            <div class="wg-relatest-post sidebar-content">
                                <h6 class="title">Relatest Posts</h6>
                                <div class="blog-grid">
                                    <div class="image hover-img">
                                        <img src="image/blog/relatest-post-1.jpg"
                                            data-src="image/blog/relatest-post-1.jpg" alt="" class="lazyload">
                                    </div>
                                    <div class="tags-content pb-12">
                                        <div class="frame">
                                            <div class="icon">
                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M18.0407 16.5624C16.8508 14.5054 15.0172 13.0304 12.8774 12.3312C13.9358 11.7011 14.7582 10.7409 15.2182 9.59821C15.6781 8.45548 15.7503 7.19337 15.4235 6.00568C15.0968 4.81798 14.3892 3.77039 13.4094 3.02378C12.4296 2.27716 11.2318 1.8728 10 1.8728C8.76821 1.8728 7.57044 2.27716 6.59067 3.02378C5.6109 3.77039 4.90331 4.81798 4.57654 6.00568C4.24978 7.19337 4.32193 8.45548 4.78189 9.59821C5.24186 10.7409 6.06422 11.7011 7.12268 12.3312C4.98284 13.0296 3.14925 14.5046 1.9594 16.5624C1.91577 16.6336 1.88683 16.7127 1.87429 16.7953C1.86174 16.8778 1.86585 16.962 1.88638 17.0429C1.9069 17.1238 1.94341 17.1997 1.99377 17.2663C2.04413 17.3328 2.10731 17.3886 2.17958 17.4304C2.25185 17.4721 2.33175 17.499 2.41457 17.5093C2.49738 17.5197 2.58143 17.5134 2.66176 17.4907C2.74209 17.4681 2.81708 17.4296 2.88228 17.3775C2.94749 17.3254 3.00161 17.2608 3.04143 17.1874C4.51331 14.6437 7.11487 13.1249 10 13.1249C12.8852 13.1249 15.4867 14.6437 16.9586 17.1874C16.9985 17.2608 17.0526 17.3254 17.1178 17.3775C17.183 17.4296 17.258 17.4681 17.3383 17.4907C17.4186 17.5134 17.5027 17.5197 17.5855 17.5093C17.6683 17.499 17.7482 17.4721 17.8205 17.4304C17.8927 17.3886 17.9559 17.3328 18.0063 17.2663C18.0566 17.1997 18.0932 17.1238 18.1137 17.0429C18.1342 16.962 18.1383 16.8778 18.1258 16.7953C18.1132 16.7127 18.0843 16.6336 18.0407 16.5624ZM5.62503 7.49993C5.62503 6.63463 5.88162 5.78877 6.36235 5.06931C6.84308 4.34984 7.52636 3.78909 8.32579 3.45796C9.12522 3.12682 10.0049 3.04018 10.8535 3.20899C11.7022 3.3778 12.4818 3.79448 13.0936 4.40634C13.7055 5.01819 14.1222 5.79774 14.291 6.64641C14.4598 7.49508 14.3731 8.37474 14.042 9.17417C13.7109 9.9736 13.1501 10.6569 12.4306 11.1376C11.7112 11.6183 10.8653 11.8749 10 11.8749C8.84009 11.8737 7.72801 11.4124 6.90781 10.5922C6.0876 9.77195 5.62627 8.65987 5.62503 7.49993Z"
                                                        fill="#121212" />
                                                </svg>
                                            </div>
                                            <div class="text-body-3 text">
                                                By David
                                            </div>
                                        </div>
                                        <div class="line"></div>
                                        <div class="frame">
                                            <div class="icon">
                                                <svg width="20" height="20" viewBox="0 0 19 14" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M18.2703 6.65312L14.7031 1.30703C14.5896 1.1358 14.4354 0.995327 14.2544 0.898135C14.0734 0.800944 13.8711 0.750053 13.6656 0.75H2.125C1.79348 0.75 1.47554 0.881696 1.24112 1.11612C1.0067 1.35054 0.875 1.66848 0.875 2V12C0.875 12.3315 1.0067 12.6495 1.24112 12.8839C1.47554 13.1183 1.79348 13.25 2.125 13.25H13.6656C13.8709 13.2496 14.073 13.1987 14.254 13.1017C14.4349 13.0046 14.5892 12.8645 14.7031 12.6938L18.268 7.34688C18.3368 7.2444 18.3738 7.12382 18.3742 7.00036C18.3747 6.87689 18.3385 6.75606 18.2703 6.65312ZM13.6656 12H2.125V2H13.6656L16.9984 7L13.6656 12Z"
                                                        fill="#121212" />
                                                </svg>
                                            </div>
                                            <div class="text-body-3 text">
                                                Activities
                                            </div>
                                        </div>
                                    </div>
                                    <h6 class="title">
                                        <a href="#">The Ultimate Guide to Planning Your Perfect Tour From Start to
                                            Finish</a>
                                    </h6>
                                </div>
                                <div class="relatest-list">
                                    <div class="image hover-img">
                                        <img src="image/blog/relatest-list-1.jpg"
                                            data-src="image/blog/relatest-list-1.jpg" alt="" class="lazyload">
                                    </div>
                                    <div class="relatest-list-content">
                                        <div class="tags-content style-2">
                                            <div class="frame">
                                                <div class="text">
                                                    By David
                                                </div>
                                            </div>
                                            <div class="line"></div>
                                            <div class="frame">
                                                <div class="text">
                                                    Mountant
                                                </div>
                                            </div>
                                        </div>
                                        <h6 class="title">
                                            <a href="#">
                                                Tips for a Comfortable and Enjoyable Trip
                                            </a>
                                        </h6>
                                    </div>
                                </div>
                                <div class="relatest-list">
                                    <div class="image hover-img">
                                        <img src="image/blog/relatest-list-2.jpg"
                                            data-src="image/blog/relatest-list-2.jpg" alt="" class="lazyload">
                                    </div>
                                    <div class="relatest-list-content">
                                        <div class="tags-content style-2">
                                            <div class="frame">
                                                <div class="text">
                                                    By David
                                                </div>
                                            </div>
                                            <div class="line"></div>
                                            <div class="frame">
                                                <div class="text">
                                                    Mountant
                                                </div>
                                            </div>
                                        </div>
                                        <h6 class="title">
                                            <a href="#">
                                                Tips for a Comfortable and Enjoyable Trip
                                            </a>
                                        </h6>
                                    </div>
                                </div>
                                <div class="relatest-list">
                                    <div class="image hover-img">
                                        <img src="image/blog/relatest-list-3.jpg"
                                            data-src="image/blog/relatest-list-3.jpg" alt="" class="lazyload">
                                    </div>
                                    <div class="relatest-list-content">
                                        <div class="tags-content style-2">
                                            <div class="frame">
                                                <div class="text">
                                                    By David
                                                </div>
                                            </div>
                                            <div class="line"></div>
                                            <div class="frame">
                                                <div class="text">
                                                    Activities
                                                </div>
                                            </div>
                                        </div>
                                        <h6 class="title">
                                            <a href="#">
                                                Tips for a Comfortable and Enjoyable Trip
                                            </a>
                                        </h6>
                                    </div>
                                </div>
                                <div class="relatest-list">
                                    <div class="image hover-img">
                                        <img src="image/blog/relatest-list-4.jpg"
                                            data-src="image/blog/relatest-list-4.jpg" alt="" class="lazyload">
                                    </div>
                                    <div class="relatest-list-content">
                                        <div class="tags-content style-2">
                                            <div class="frame">
                                                <div class="text">
                                                    By David
                                                </div>
                                            </div>
                                            <div class="line"></div>
                                            <div class="frame">
                                                <div class="text">
                                                    Mountant
                                                </div>
                                            </div>
                                        </div>
                                        <h6 class="title">
                                            <a href="#">
                                                Tips for a Comfortable and Enjoyable Trip
                                            </a>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.sildebar -->

                    </div>
                </div>
            </div>
            <!-- Blog-new -->
            <section class="section-new">
                <div class="tf-container">
                    <div class="row">
                        <div class="col-12">
                            <div class="blog-new">
                                <div class="title fw-6">
                                    Blog and Travel Guides
                                </div>
                                <div class="sub-title text-body-2">
                                    Explore the World through Informative Articles and Personal Stories
                                </div>
                            </div>
                            <div class="swiper-container section-new-swiper">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="blog-item hover-img">
                                            <div class="image ">
                                                <img src="image/blog/blog-item-1.jpg"
                                                    data-src="image/blog/blog-item-1.jpg" alt="" class="lazyload">
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
                                                    <a href="#">Tour Packages to Consider for Your Next Vacation.</a>
                                                </h5>
                                                <div class="text-body-3 text">Explore a curated list of 10 extraordinary
                                                    Glamping
                                                    destinations worldwide...</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="blog-item hover-img">
                                            <div class="image ">
                                                <img src="image/blog/blog-item-2.jpg"
                                                    data-src="image/blog/blog-item-2.jpg" alt="" class="lazyload">
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
                                                    <a href="#">Camping in Style Tips for a Comfortable and Enjoyable
                                                        Trip</a>
                                                </h5>
                                                <div class="text-body-3 text">Explore a curated list of 10 extraordinary
                                                    Glamping
                                                    destinations worldwide...</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="blog-item hover-img">
                                            <div class="image ">
                                                <img src="image/blog/blog-item-3.jpg"
                                                    data-src="image/blog/blog-item-3.jpg" alt="" class="lazyload">
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
                                                    <a href="#">Explore the World Travel Tips for Every Type of
                                                        Traveler</a>
                                                </h5>
                                                <div class="text-body-3 text">Explore a curated list of 10 extraordinary
                                                    Glamping
                                                    destinations worldwide...</div>
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
            </section><!-- /.blog-new -->
        </div><!-- /.main-content -->
@endsection 