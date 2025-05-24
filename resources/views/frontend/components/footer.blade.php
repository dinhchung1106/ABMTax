<!-- <footer class="bg-primary text-white pt-5 pb-3 mt-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 mb-3 mb-md-0">
                <h5 class="fw-bold mb-2">{{ $company->name ?? 'ABM Tax' }}</h5>
                <p class="mb-1"><i class="bi bi-geo-alt"></i> {{ $company->address ?? 'Hà Nam, Việt Nam' }}</p>
                <p class="mb-1"><i class="bi bi-telephone"></i> {{ $company->phone ?? '0123 456 789' }}</p>
                <p class="mb-1"><i class="bi bi-envelope"></i> {{ $company->email ?? 'info@abmtax.vn' }}</p>
            </div>
            <div class="col-md-6 text-md-end">
                <div class="mb-2">
                    <a href="#" class="text-white me-3"><i class="bi bi-facebook fs-4"></i></a>
                    <a href="#" class="text-white me-3"><i class="bi bi-youtube fs-4"></i></a>
                    <a href="#" class="text-white me-3"><i class="bi bi-tiktok fs-4"></i></a>
                    <a href="#" class="text-white"><i class="bi bi-envelope fs-4"></i></a>
                </div>
                <div class="small">&copy; {{ date('Y') }} {{ $company->name ?? 'ABM Tax' }}. All rights reserved.</div>
            </div>
        </div>
    </div>
</footer>  -->


 <!-- Footer -->
 <footer class="footer" id="footer">
            <div class="tf-container">
                <div class="row">
                    <div class="col-12">
                        <div class="footer-inner">
                            <div class="footer-left">
                                <div class="logo">
                                    <a href="#">
                                        <img src="{{ asset('frontend/image/logo/logo-footer.svg') }}" data-src="{{ asset('frontend/image/logo/logo-footer.svg') }}"
                                            alt="" class="lazyload">
                                    </a>
                                </div>
                                <div class="info">
                                    {{ $company->about ?? 'ABM Tax' }}.
                                </div>
                                <ul class="social">
                                    <li class="social-icon"><a href="#"><i class="icon-fb1"></i></a></li>
                                    <li class="social-icon"><a href="#"><i class="icon-linkedin1"></i></a></li>
                                    <li class="social-icon"><a href="#"><i class="icon-twitter2"></i></a></li>
                                    <li class="social-icon"><a href="#"><i class="icon-instagram1"></i></a></li>
                                    <li class="social-icon"><a href="#"><i class="icon-youtube-play1"></i></a></li>
                                </ul>
                            </div>
                            <div class="support-footer menu-footer footer-col-block">
                                <div class="title text-body-3 title-desktop">
                                    Support
                                </div>
                                <div class="title text-body-3 title-mobile">
                                    Support
                                </div>
                                <ul class="tf-collapse-content">
                                    <li class="support-item caption-1"><a href="#">Help Center</a></li>
                                    <li class="support-item caption-1"><a href="contact-us.html">Contact Us</a></li>
                                    <li class="support-item caption-1"><a href="FAQ.html">Glamp FAQ</a></li>
                                    <li class="support-item caption-1"><a href="#">Booking Policy</a></li>
                                    <li class="support-item caption-1"><a href="#">Booking Guide</a></li>
                                    <li class="support-item caption-1"><a href="#">Feedback</a></li>
                                </ul>
                            </div>
                            <div class="about-us-footer menu-footer footer-col-block">
                                <div class="title text-body-3 title-desktop">
                                    About Us
                                </div>
                                <div class="title text-body-3 title-mobile">
                                    About Us
                                </div>
                                <ul class="tf-collapse-content">
                                    <li class="support-item caption-1"><a href="about-us.html">About Us</a></li>
                                    <li class="support-item caption-1"><a href="our-team.html">Our Story</a></li>
                                    <li class="support-item caption-1"><a href="#">Journal</a></li>
                                    <li class="support-item caption-1"><a href="blog-defaults.html">Late News</a></li>
                                    <li class="support-item caption-1"><a href="listing-tours-topmap-1.html">Site
                                            Map</a></li>
                                    <li class="support-item caption-1"><a href="#">Partnerships</a></li>
                                </ul>
                            </div>
                            <div class="contact-us-footer menu-footer pr-62 footer-col-block">
                                <div class="title text-body-3 title-desktop">
                                    Contact Us
                                </div>
                                <div class="title text-body-3 title-mobile">
                                    Contact Us
                                </div>
                                <ul class="tf-collapse-content">
                                    <li class="text">Need help? 24/7</li>
                                    <li class="text-body-2 number-phone"><a href="#">001-1234-88888</a></li>
                                    <li class="email-footer">
                                        <svg width="16" height="16" viewBox="0 0 14 10" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M13 0H1C0.867392 0 0.740215 0.0526785 0.646447 0.146447C0.552678 0.240215 0.5 0.367392 0.5 0.5V9C0.5 9.26522 0.605357 9.51957 0.792893 9.70711C0.98043 9.89464 1.23478 10 1.5 10H12.5C12.7652 10 13.0196 9.89464 13.2071 9.70711C13.3946 9.51957 13.5 9.26522 13.5 9V0.5C13.5 0.367392 13.4473 0.240215 13.3536 0.146447C13.2598 0.0526785 13.1326 0 13 0ZM11.7144 1L7 5.32187L2.28562 1H11.7144ZM12.5 9H1.5V1.63688L6.66187 6.36875C6.75412 6.45343 6.87478 6.50041 7 6.50041C7.12522 6.50041 7.24588 6.45343 7.33813 6.36875L12.5 1.63688V9Z"
                                                fill="white" />
                                        </svg>
                                        contact.dinhchung@gmail.com
                                    </li>
                                    <li class="add-download">
                                        <a href="#">
                                            <img src="{{ asset('frontend/image/icon/gg-play.png') }}" data-src="{{ asset('frontend/image/icon/gg-play.png') }}" alt=""
                                                class="lazyload">
                                        </a>
                                        <a href="#">
                                            <img src="{{ asset('frontend/image/icon/app-store.png') }}" data-src="{{ asset('frontend/image/icon/app-store.png') }}"
                                                alt="" class="lazyload">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="line-footer"></div>
            <div class="tf-container">
                <div class="row">
                    <div class="col-12">
                        <div class="footer-bottom">
                            <div class="left">
                                ©{{ date('Y') }} {{ $company->name ?? 'ABM Tax' }}
                            </div>
                            <div class="right">
                                <ul>
                                    <li><a href="#">Terms Of Services</a></li>
                                    <li class="line"></li>
                                    <li><a href="#"> Privacy Policy</a></li>
                                    <li class="line"></li>
                                    <li><a href="#"> Cookie Policy</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer><!-- /.footer -->

        <!-- Login -->
        <div class="offcanvas offcanvas-bottom offcanvas-login" id="canvasLogin">
            <div class="wg-login wg-popup fw-6">
                <button class="btn-close-login" type="button" data-bs-dismiss="offcanvas" aria-label="Close">
                    <i class="icon-close1"></i>
                </button>
                <h4 class="title">
                    <span class="login">Login</span>
                    <span class="register">Register</span>
                </h4>
                <fieldset class="input-text input-name">
                    <label class="text-body-3 fw-4" for="name-login">Username or email
                        address<span>*</span></label>
                    <input class="text-body-3" type="text" name="name-login" id="name-login" value="TonyNguyen">
                </fieldset>
                <fieldset class="input-text input-pass">
                    <label class="text-body-3 fw-4" for="pass-login">Password<span>*</span></label>
                    <input class="text-body-3" type="password" name="pass-login" id="pass-login">
                    <div class="icon">
                        <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12.1073 8.3916L7.89063 12.6083C7.34896 12.0666 7.01562 11.3249 7.01562 10.4999C7.01562 8.84993 8.34896 7.5166 9.99896 7.5166C10.824 7.5166 11.5656 7.84994 12.1073 8.3916Z"
                                stroke="#64666C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M14.8518 5.3084C13.3935 4.2084 11.7268 3.6084 10.0018 3.6084C7.06016 3.6084 4.31849 5.34173 2.41016 8.34173C1.66016 9.51673 1.66016 11.4917 2.41016 12.6667C3.06849 13.7001 3.83516 14.5917 4.66849 15.3084"
                                stroke="#64666C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M7.01562 16.7751C7.96563 17.1751 8.97396 17.3917 9.99896 17.3917C12.9406 17.3917 15.6823 15.6584 17.5906 12.6584C18.3406 11.4834 18.3406 9.5084 17.5906 8.3334C17.3156 7.90006 17.0156 7.49173 16.7073 7.1084"
                                stroke="#64666C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M12.9242 11.083C12.7076 12.258 11.7492 13.2163 10.5742 13.433" stroke="#64666C"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M7.89297 12.6084L1.66797 18.8334" stroke="#64666C" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M18.3344 2.16699L12.1094 8.39199" stroke="#64666C" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>

                    </div>
                </fieldset>
                <div class="remember-fogotpassword">
                    <div class="remember check-box">
                        <input type="checkbox" name="remember" id="remember">
                        <label class="text-body-3 fw-4" for="remember">Remember me</label>
                    </div>
                    <a href="#" class="fw-4 text-body-3">Fogot password?</a>
                </div>
                <div class="btn-login btn-popup">
                    <a href="#" class="tf-btn color-primary text-body-3">Login</a>
                </div>
                <div class="text text-body-3 fw-4">
                    Not registered yet? <a href="#canvasRegister" data-bs-toggle="offcanvas" class="fw-6">Sign Up</a>
                </div>
                <div class="line">
                    <div class="line-1"></div>
                    <p class="text-body-3">
                        or sign up with
                    </p>
                    <div class="line-2"></div>
                </div>
                <ul class="social style-2">
                    <li class="item">
                        <a href="#">
                            <div class="icon">
                                <img src="{{ asset('frontend/image/icon/logo-fb.png') }}" data-src="{{ asset('frontend/image/icon/logo-fb.png') }}" alt="">
                            </div>
                            <div class="title-social text-body-3">
                                Facebook
                            </div>
                        </a>
                    </li>
                    <li class="item">
                        <a href="#">
                            <div class="icon">
                                <img src="{{ asset('frontend/image/icon/logo-gg.png') }}" data-src="{{ asset('frontend/image/icon/logo-gg.png') }}" alt="">
                            </div>
                            <div class="title-social text-body-3">
                                Google
                            </div>
                        </a>
                    </li>
                    <li class="item">
                        <a href="#">
                            <div class="icon">
                                <img src="{{ asset('frontend/image/icon/logo-tw.png') }}" data-src="{{ asset('frontend/image/icon/logo-tw.png') }}" alt="">
                            </div>
                            <div class="title-social text-body-3">
                                Twitter
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div><!-- /.login -->

        <!-- Register -->
        <div class="offcanvas offcanvas-bottom offcanvas-register" id="canvasRegister">
            <div class="wg-register wg-popup fw-6">
                <button class="btn-close-register" type="button" data-bs-dismiss="offcanvas" aria-label="Close">
                    <i class="icon-close1"></i>
                </button>
                <h4 class="title">
                    <span class="login">Login</span>
                    <span class="register">Register</span>
                </h4>
                <fieldset class="input-text input-name">
                    <label class="text-body-3 fw-4" for="name-register">Username or email
                        address<span>*</span></label>
                    <input class="text-body-3" type="text" name="name-register" id="name-register" value="TonyNguyen">
                </fieldset>
                <fieldset class="input-text input-pass">
                    <label class="text-body-3 fw-4" for="pass-register">Password<span>*</span></label>
                    <input class="text-body-3" type="password" placeholder="Password" name="pass-register"
                        id="pass-register">
                    <div class="icon">
                        <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12.1073 8.3916L7.89063 12.6083C7.34896 12.0666 7.01562 11.3249 7.01562 10.4999C7.01562 8.84993 8.34896 7.5166 9.99896 7.5166C10.824 7.5166 11.5656 7.84994 12.1073 8.3916Z"
                                stroke="#64666C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M14.8518 5.3084C13.3935 4.2084 11.7268 3.6084 10.0018 3.6084C7.06016 3.6084 4.31849 5.34173 2.41016 8.34173C1.66016 9.51673 1.66016 11.4917 2.41016 12.6667C3.06849 13.7001 3.83516 14.5917 4.66849 15.3084"
                                stroke="#64666C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M7.01562 16.7751C7.96563 17.1751 8.97396 17.3917 9.99896 17.3917C12.9406 17.3917 15.6823 15.6584 17.5906 12.6584C18.3406 11.4834 18.3406 9.5084 17.5906 8.3334C17.3156 7.90006 17.0156 7.49173 16.7073 7.1084"
                                stroke="#64666C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M12.9242 11.0833C12.7076 12.2583 11.7492 13.2166 10.5742 13.4333" stroke="#64666C"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M7.89297 12.6084L1.66797 18.8334" stroke="#64666C" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M18.3344 2.16675L12.1094 8.39175" stroke="#64666C" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                </fieldset>
                <fieldset class="input-text input-pass">
                    <label class="text-body-3 fw-4" for="pass-confirm">Confirm Password<span>*</span></label>
                    <input class="text-body-3" type="password" placeholder="Password" name="pass-confirm"
                        id="pass-confirm">
                    <div class="icon">
                        <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12.1073 8.3916L7.89063 12.6083C7.34896 12.0666 7.01562 11.3249 7.01562 10.4999C7.01562 8.84993 8.34896 7.5166 9.99896 7.5166C10.824 7.5166 11.5656 7.84994 12.1073 8.3916Z"
                                stroke="#64666C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M14.8518 5.3084C13.3935 4.2084 11.7268 3.6084 10.0018 3.6084C7.06016 3.6084 4.31849 5.34173 2.41016 8.34173C1.66016 9.51673 1.66016 11.4917 2.41016 12.6667C3.06849 13.7001 3.83516 14.5917 4.66849 15.3084"
                                stroke="#64666C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M7.01562 16.7751C7.96563 17.1751 8.97396 17.3917 9.99896 17.3917C12.9406 17.3917 15.6823 15.6584 17.5906 12.6584C18.3406 11.4834 18.3406 9.5084 17.5906 8.3334C17.3156 7.90006 17.0156 7.49173 16.7073 7.1084"
                                stroke="#64666C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M12.9242 11.0833C12.7076 12.2583 11.7492 13.2166 10.5742 13.4333" stroke="#64666C"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M7.89297 12.6084L1.66797 18.8334" stroke="#64666C" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M18.3344 2.16675L12.1094 8.39175" stroke="#64666C" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                </fieldset>
                <fieldset class="agree check-box">
                    <input type="checkbox" name="agree" id="agree">
                    <label class="text-body-3 fw-4" for="agree">I agree to the <span>Terms of
                            User</span></label>
                </fieldset>
                <div class="btn-register btn-popup">
                    <a href="#" class="tf-btn color-primary text-body-3">Create a new account</a>
                </div>
                <div class="text text-body-3 fw-4">
                    Already have an account? <a href="#canvasLogin" data-bs-toggle="offcanvas" class="fw-6">Login
                        Here</a>
                </div>
            </div>
        </div><!-- /.register -->

        <!-- Go-top -->
        <div class="progress-wrap">
            <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
                <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"
                    style="transition: stroke-dashoffset 10ms linear; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 277.672;">
                </path>
            </svg>
        </div><!-- /.go-top -->