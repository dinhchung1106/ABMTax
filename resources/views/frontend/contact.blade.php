@extends('frontend.layout')
@section('title', 'Liên hệ - ' . ($company->name ?? 'ABM Tax'))
@section('meta_description', 'Liên hệ với ' . ($company->name ?? 'ABM Tax') . ' để được tư vấn dịch vụ thuế, kế toán, doanh nghiệp.')
@section('content')
<!-- <section class="section py-5">
    <div class="container">
        <h1 class="section-title text-center mb-4">Liên hệ với chúng tôi</h1>
        <div class="row justify-content-center">
            <div class="col-lg-6 mb-4">
                <form class="contact-form" method="POST" action="#">
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
            <div class="col-lg-6">
                <div class="ratio ratio-16x9 rounded-4 shadow">
                    <iframe src="https://www.google.com/maps?q={{ urlencode($company->address ?? 'Hà Nam, Việt Nam') }}&output=embed" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</section> -->

 <!-- /.Page-title -->
 <div class="page-title tf-spacing-4">
            <div class="tf-container">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-content">
                            <p class="text-body-3 text wow fadeInUp"><a href="index.html"> Home</a>&nbsp; /&nbsp; Contact</p>
                            <h3 class="title">
                                Contact
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.page-title -->

        <!-- Main-content -->
        <div class="main-content">
            <div class="tf-container tf-spacing-10">
                <div class="row">
                    <div class="col-lg-5">
                        <!-- Section-info -->
                        <section class="section-info">
                            <div class="heading-section pb-24">
                                <div class="title fs-36 lh-44 fw-6 wow fadeInUp">
                                    We’d love to help
                                </div>
                                <div class="sub-title text-body-3 wow fadeInUp">
                                    Crafting Unforgettable Adventures Together
                                </div>
                            </div>
                            <div class="details-section">
                                <div class="phone details-content pb-16">
                                    <div class="title text-body-3 fw-6 wow fadeInUp">
                                        Phone:
                                    </div>
                                    <div class="sub-title text-body-3 numberphone wow fadeInUp">
                                        +1 666 234 8888
                                    </div>
                                </div>
                                <div class="email details-content pb-16">
                                    <div class="title text-body-3 fw-6 wow fadeInUp">
                                        Email:
                                    </div>
                                    <div class="sub-title text-body-3 address-email wow fadeInUp">
                                        contact.dinhchung@gmail.com
                                    </div>
                                </div>
                                <div class="address details-content pb-16">
                                    <div class="title text-body-3 fw-6 wow fadeInUp">
                                        Address:
                                    </div>
                                    <div class="sub-title text-body-3 wow fadeInUp">
                                        2163 Phillips Gap Rd, West Jefferson, North Carolina, United States
                                    </div>
                                </div>
                                <div class="open-time details-content pb-16">
                                    <div class="title text-body-3 fw-6 wow fadeInUp">
                                        Open Time:
                                    </div>
                                    <ul>
                                        <li class="open-time-item text-body-3 wow fadeInUp">Mon - Sat: &nbsp;
                                            &nbsp;<span>7:30am - 8:00pm
                                                PST</span></li>
                                        <li class="open-time-item text-body-3 wow fadeInUp">Sunday: &nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <span>9:00am - 5:00pm PST</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </section><!-- /.section-info -->
                    </div>
                    <div class="col-lg-7">
                        <!-- Section-form -->
                        <div class="section-form">
                            <div class="heading-section pb-24">
                                <div class="title fw-6 fs-36 lh-44 wow fadeInUp" data-wow-delay="0.1s">
                                    Get In Touch
                                </div>
                                <div class="sub-title text-body-3 wow fadeInUp" data-wow-delay="0.1s">
                                    Connect with Us to Embark on a Journey to Create Your Dream Epictrip Experience
                                </div>
                            </div>
                            <form id="contactform" method="post" action="https://chungdd.co/html/chungdd/contact/contact-process.php">
                                <div>
                                    <div class="cols pb-20">
                                        <fieldset>
                                            <input type="text" name="name" id="name" required="" placeholder="Your Name*">
                                        </fieldset>
                                        <fieldset>
                                            <input type="email" name="mail" id="mail" required="" placeholder="Your Email*">
                                        </fieldset>
                                    </div>
                                    <fieldset class="pb-24">
                                        <textarea placeholder="Message" class="h-204"name="message" id="message" required="" cols="30" rows="10"></textarea>
                                    </fieldset>
                                    <button type="submit" class="tf-btn color-primary">Send message</button>
                                </div>
                            </form>
                        </div><!-- /.section-form -->
                    </div>
                </div>
            </div>
            <!-- Box-map2 -->
            <div class="box-map2">
                <div id="map2"></div>
            </div>
            <!-- /.box-map2 -->
            
        </div><!-- /.main-content -->
@endsection 