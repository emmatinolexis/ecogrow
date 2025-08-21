@extends('website.master')
@section('content')
    <!-- Main Content -->
    <div class="mn-main-content">
        <div class="row">
            <div class="col-xxl-12">
                <!-- Hero Section -->
                <section class="mn-hero swiper-container m-b-15">
                    <div class="mn-hero-slider owl-carousel">
                        <div class="mn-hero-slide swiper-slide slide-1">
                            <div class="mn-hero-detail">
                                <p class="label"><span>50%<br>Off</span></p>
                                <h1>Fashion sale <br>for women's</h1>
                                <p>Elevate your every day. Style that speaks volumes.</p>
                                <a href="javascript:void(0)" class="mn-btn-2"><span>Shop Now</span></a>
                            </div>
                        </div>
                        <div class="mn-hero-slide swiper-slide slide-2">
                            <div class="mn-hero-detail">
                                <p class="label"><span>35%<br>Off</span></p>
                                <h2>Fashion sale <br>for Men's</h2>
                                <p>Wear the change. Fashion that feels good.</p>
                                <a href="javascript:void(0)" class="mn-btn-2"><span>Shop Now</span></a>
                            </div>
                        </div>
                        <div class="mn-hero-slide swiper-slide slide-3">
                            <div class="mn-hero-detail">
                                <p class="label"><span>44%<br>Off</span></p>
                                <h2>Fashion sale <br>for Children's</h2>
                                <p>Wear the change. Fashion that feels good.</p>
                                <a href="javascript:void(0)" class="mn-btn-2"><span>Shop Now</span></a>
                            </div>
                        </div>
                        <div class="mn-hero-slide swiper-slide slide-4">
                            <div class="mn-hero-detail">
                                <p class="label"><span>22%<br>Off</span></p>
                                <h2>Cosmetics sale <br>for Women's</h2>
                                <p>Wear the change. Fashion that feels good.</p>
                                <a href="javascript:void(0)" class="mn-btn-2"><span>Shop Now</span></a>
                            </div>
                        </div>
                    </div>
                </section>

                @include('components.mission')


                <!-- New Section -->
                <section class="mn-new-product p-tb-15">
                    <div class="mn-title">
                        <h2>New <span>Arrivals</span></h2>
                    </div>
                    <div class="mn-product owl-carousel">
                        @foreach($lastProducts as $product)
                            <x-product-card :product="$product" />
                        @endforeach
                    </div>
                </section>


                <!-- Banner slider -->
                <section class="mn-banner p-tb-15">
                    <div class="row">
                        <div class="col-12" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                            <div class="mn-modern-banner owl-carousel">
                                <div class="modern-banner">
                                    <div class="mn-banner-img img-1"></div>
                                    <div class="mn-banner-contact banner-animation">
                                        <div class="inner-banner">
                                            <h3>WOMEN'S</h3>
                                            <h4>Fashion COLLECTION</h4>
                                        </div>
                                        <div class="inner-text">
                                            <span class="bnr-text">Summer</span>
                                            <p>New Stylish Shirts, Pants & Accessries.</p>
                                        </div>
                                        <div class="banner-btn">
                                            <a href="room-details.html" class="mn-btn-1"><span>Book
                                                    Now</span></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="modern-banner">
                                    <div class="mn-banner-img img-2"></div>
                                    <div class="mn-banner-contact banner-animation">
                                        <div class="inner-banner">
                                            <h3>WOMEN'S</h3>
                                            <h4>goggles COLLECTION</h4>
                                        </div>
                                        <div class="inner-text">
                                            <span class="bnr-text">Summer</span>
                                            <p>New Stylish Shirts, Pants & Accessries.</p>
                                        </div>
                                        <div class="banner-btn">
                                            <a href="room-details.html" class="mn-btn-1"><span>Book
                                                    Now</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Testimonials Section -->
                <section class="mn-testimonials p-tb-15">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="testim-bg">
                                <div class="section-title d-none">
                                    <h2>Customers <span>Review</span></h2>
                                </div>
                                <div class="mn-test-outer mn-testimonials">
                                    <ul class="mn-testimonial-slider owl-carousel">
                                        <li class="mn-test-item">
                                            <img src="assets/img/icons/top-quotes.svg" class="svg_img test_svg top"
                                                alt="user">
                                            <div class="mn-test-inner">
                                                <div class="mn-test-img">
                                                    <img alt="testimonial" title="testimonial" src="assets/img/user/1.jpg">
                                                </div>
                                                <div class="mn-test-content">
                                                    <div class="mn-test-desc">Lorem Ipsum is simply dummy text of
                                                        the printing and industry. Lorem Ipsum has been the
                                                        industry's standard dummy text ever since the 1500s.</div>
                                                    <div class="mn-test-name">Mariya Klinton</div>
                                                    <div class="mn-test-designation">(CEO)</div>
                                                </div>
                                            </div>
                                            <img src="assets/img/icons/bottom-quotes.svg" class="svg_img test_svg bottom"
                                                alt="">
                                        </li>
                                        <li class="mn-test-item ">
                                            <img src="assets/img/icons/top-quotes.svg" class="svg_img test_svg top" alt="">
                                            <div class="mn-test-inner">
                                                <div class="mn-test-img">
                                                    <img alt="testimonial" title="testimonial" src="assets/img/user/2.jpg">
                                                </div>
                                                <div class="mn-test-content">
                                                    <div class="mn-test-desc">Standard dummy text ever since the
                                                        1500s, when an unknown printer took a galley of type and
                                                        this is the lorem and scrambled it to make a type specimen.
                                                    </div>
                                                    <div class="mn-test-name">John Doe</div>
                                                    <div class="mn-test-designation">(CFO)</div>
                                                </div>
                                            </div>
                                            <img src="assets/img/icons/bottom-quotes.svg" class="svg_img test_svg bottom"
                                                alt="">
                                        </li>
                                        <li class="mn-test-item">
                                            <img src="assets/img/icons/top-quotes.svg" class="svg_img test_svg top" alt="">
                                            <div class="mn-test-inner">
                                                <div class="mn-test-img">
                                                    <img alt="testimonial" title="testimonial" src="assets/img/user/3.jpg">
                                                </div>
                                                <div class="mn-test-content">
                                                    <div class="mn-test-desc">When an unknown printer took a galley
                                                        of type and scrambled it to make a type specimen Lorem Ipsum
                                                        has been the industry's and ever since to the 1500s, </div>
                                                    <div class="mn-test-name">Nency Lykra</div>
                                                    <div class="mn-test-designation">(Manager)</div>
                                                </div>
                                            </div>
                                            <img src="assets/img/icons/bottom-quotes.svg" class="svg_img test_svg bottom"
                                                alt="">
                                        </li>
                                    </ul>
                                </div>
                                <span class="mn-testi-shape-2"></span>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Blog Section Start -->
                <section class="mn-blog p-tb-15">
                    <div class="mn-title">
                        <h2>Our <span>Blogs</span></h2>
                    </div>
                    <div class="mn-blog-carousel owl-carousel">
                        <div class="mn-blog-card">
                            <div class="blog-info">
                                <figure class="blog-img"><a href="#"><img src="assets/img/blog/1.jpg" alt="news imag"></a>
                                </figure>
                                <div class="detail">
                                    <label>June 30, 2025 - <a href="#">Fashion</a></label>
                                    <h3><a href="#">Marketing Guide: 5 Steps to Success to way.</a></h3>
                                    <div class="more-info">
                                        <a href="blog-detail-right-sidebar.html">Read More<i
                                                class="ri-arrow-right-double-line"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mn-blog-card">
                            <div class="blog-info">
                                <figure class="blog-img"><a href="#"><img src="assets/img/blog/2.jpg" alt="news imag"></a>
                                </figure>
                                <div class="detail">
                                    <label>April 02, 2025 - <a href="#">Shoes</a></label>
                                    <h3><a href="#">Best way to solve business issue in market.</a>
                                    </h3>
                                    <div class="more-info">
                                        <a href="blog-detail-right-sidebar.html">Read More<i
                                                class="ri-arrow-right-double-line"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mn-blog-card">
                            <div class="blog-info">
                                <figure class="blog-img"><a href="#"><img src="assets/img/blog/3.jpg" alt="news imag"></a>
                                </figure>
                                <div class="detail">
                                    <label>Mar 09, 2025 - <a href="#">Grocery</a></label>
                                    <h3><a href="#">31 grocery customer service stats know in 2025.</a></h3>
                                    <div class="more-info">
                                        <a href="blog-detail-right-sidebar.html">Read More<i
                                                class="ri-arrow-right-double-line"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mn-blog-card">
                            <div class="blog-info">
                                <figure class="blog-img"><a href="#"><img src="assets/img/blog/4.jpg" alt="news imag"></a>
                                </figure>
                                <div class="detail">
                                    <label>January 25, 2025 - <a href="#">Bags</a></label>
                                    <h3><a href="#">Business ideas to grow your business traffic.</a></h3>
                                    <div class="more-info">
                                        <a href="blog-detail-right-sidebar.html">Read More<i
                                                class="ri-arrow-right-double-line"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mn-blog-card">
                            <div class="blog-info">
                                <figure class="blog-img"><a href="#"><img src="assets/img/blog/5.jpg" alt="news imag"></a>
                                </figure>
                                <div class="detail">
                                    <label>December 10, 2026 - <a href="#">Cosmetics</a></label>
                                    <h3><a href="#">Marketing Guide: 5 Steps way to Success.</a></h3>
                                    <div class="more-info">
                                        <a href="blog-detail-right-sidebar.html">Read More<i
                                                class="ri-arrow-right-double-line"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mn-blog-card">
                            <div class="blog-info">
                                <figure class="blog-img"><a href="#"><img src="assets/img/blog/6.jpg" alt="news imag"></a>
                                </figure>
                                <div class="detail">
                                    <label>August 08, 2027 - <a href="#">Bags</a></label>
                                    <h3><a href="#">15 customer service stats idea know in 2026.</a></h3>
                                    <div class="more-info">
                                        <a href="blog-detail-right-sidebar.html">Read More<i
                                                class="ri-arrow-right-double-line"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        window.routes = {
            addToCart: "{{ route('cart.add') }}"
        };
    </script>
    <script src="{{ asset('/assets/js/product.js')}}"></script>
@endsection