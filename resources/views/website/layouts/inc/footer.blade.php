	@php
        use App\Models\WebsiteSetting;
        use App\Models\WebsiteSocialIcon;
        $website_setting = WebsiteSetting::first();
        $website_social = WebsiteSocialIcon::first();
    @endphp


    <!-- bottom navigation -->
    <!-- Mobile Sticky Bottom Menu Start-->
    <section id="mobile-sticky-bottom-menu">
        <ul class="mobile-bottom-ul">
            <li>
                <a href="/index.html" class="active"><i class="fas fa-home"></i><span>Home</span></a>
            </li>
            <li>
                <a href="#"><i class="fa-solid fa-table"></i><span>Categories</span></a>
            </li>
            <li>
                <a href="#"><i class="fas fa-search"></i><span>Search</span></a>
            </li>
            <li>
                <a href="/cart.html"><i class="fas fa-shopping-cart"></i><span>Cart</span></a>
            </li>
            <li>
                <a href="/login.html"><i class="fas fa-user"></i><span>Account</span></a>
            </li>
        </ul>
    </section>
    <!-- Mobile Sticky Bottom Menu Start-->
    <!-- ========footer===== -->

    <!-- ==================== Footer Start Here ==================== -->
    <footer class="footer-area section-bg-light bg-img">
        <div class="pb-60 pt-120">
            <div class="container">
                <div class="row justify-content-center gy-5">
                    <div class="col-xl-3 col-sm-6">
                        <div class="footer-item">
                            <div class="footer-item__logo">
                                <a href="index.html">
                                    <img src="{{ asset($website_setting->website_footer_logo) }}" alt="" /></a>
                            </div>
                            <p class="footer-item__desc">
                                {!! $website_setting->footer_content !!}
                            </p>
                            <ul class="social-list">
                                <li class="social-list__item">
                                    <a href="{{ $website_social->facebook_url }}" class="social-list__link" target="_blank"><i
                                            class="fab fa-facebook-f"></i></a>
                                </li>
                                <li class="social-list__item">
                                    <a href="{{ $website_social->twitter_url }}" class="social-list__link" target="_blank">
                                        <i class="fab fa-twitter"></i></a>
                                </li>
                                <li class="social-list__item">
                                    <a href="{{ $website_social->linkedin_url }}" class="social-list__link" target="_blank">
                                        <i class="fab fa-linkedin-in"></i></a>
                                </li>
                                <li class="social-list__item">
                                    <a href="{{ $website_social->pinterest_url }}" class="social-list__link" target="_blank">
                                        <i class="fab fa-pinterest-p"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-1 d-xl-block d-none"></div>
                    <div class="col-xl-2 col-sm-6">
                        <div class="footer-item">
                            <h5 class="footer-item__title">Pages</h5>
                            <ul class="footer-menu">
                                <li class="footer-menu__item">
                                    <a href="about.html" class="footer-menu__link"> About Us</a>
                                </li>
                                <li class="footer-menu__item">
                                    <a href="faq.html" class="footer-menu__link"> Faq</a>
                                </li>
                                <li class="footer-menu__item">
                                    <a href="cart.html" class="footer-menu__link">Shopping Cart
                                    </a>
                                </li>
                                <li class="footer-menu__item">
                                    <a href="blog.html" class="footer-menu__link"> Blog</a>
                                </li>
                                <li class="footer-menu__item">
                                    <a href="/product-details.html" class="footer-menu__link">
                                        Product Details</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-2 col-sm-6">
                        <div class="footer-item">
                            <h5 class="footer-item__title">Useful link</h5>
                            <ul class="footer-menu">
                                <li class="footer-menu__item">
                                    <a href="/shop.html" class="footer-menu__link">
                                        Product Category
                                    </a>
                                </li>
                                <li class="footer-menu__item">
                                    <a href="check-out.html" class="footer-menu__link">Checkout
                                    </a>
                                </li>
                                <li class="footer-menu__item">
                                    <a href="login.html" class="footer-menu__link">Login </a>
                                </li>
                                <li class="footer-menu__item">
                                    <a href="registration.html" class="footer-menu__link">
                                        Registration
                                    </a>
                                </li>
                                <li class="footer-menu__item">
                                    <a href="contact.html" class="footer-menu__link">
                                        Contact Us
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-1 d-xl-block d-none"></div>
                    <div class="col-xl-3 col-sm-6">
                        <div class="footer-item">
                            <h5 class="footer-item__title">Subscribe now</h5>
                            <div class="subscriber-form mb-3">
                                <input type="text" class="form--control style-two" placeholder="Email Address"
                                    aria-label="Recipient's username" />
                                <button class="btn btn--base subscribe-button">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                            <p>
                                Subscribe to our newsletter and get 10% off your first
                                purchase..
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Top End-->

        <!-- bottom Footer -->
        <div class="bottom-footer section-bg py-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="bottom-footer__text">
                            {{ $website_setting->copyright_text }}.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ==================== Footer End Here ==================== -->

    @include('website.layouts.inc.script')
</body>

</html>
