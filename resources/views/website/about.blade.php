@extends('website.master')

@section('content')

<!-- Main Content -->
<div class="mn-main-content">
    <div class="mn-breadcrumb m-b-30">
        <div class="row">
            <div class="col-12">
                <div class="row gi_breadcrumb_inner">
                    <div class="col-md-6 col-sm-12">
                        <h2 class="mn-breadcrumb-title">About us Page</h2>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <!-- mn-breadcrumb-list start -->
                        <ul class="mn-breadcrumb-list">
                            <li class="mn-breadcrumb-item"><a href="{{ route('website.home') }}">Home</a></li>
                            <li class="mn-breadcrumb-item active">About us Page</li>
                        </ul>
                        <!-- mn-breadcrumb-list end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About section -->
    <section class="mn-about p-b-15">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="mn-about-img">
                    <img src="assets/img/common/about-1.png" class="v-img" alt="about">
                    <img src="assets/img/common/about-2.png" class="h-img" alt="about">
                    <img src="assets/img/common/about-3.png" class="h-img" alt="about">
                    <img src="assets/img/common/about-4.png" class="h-img" alt="about">
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="mn-about-detail">
                    <div class="section-title m-t-991">
                        <h2>Who We <span>Are?</span></h2>
                        <p>Founded on the belief that nature knows best, EcoGrow combines traditional farming wisdom
                            with modern organic science to deliver high-quality products that meet the demands of modern
                            agriculture without harming the planet.</p>
                    </div>
                    <p>EcoGrow FMS Ltd is a forward-thinking agricultural company dedicated to supplying 100%
                        organic fertilizers that promote sustainable farming and healthy food production. Our mission is
                        to empower farmers across Ghana and beyond with eco-friendly solutions that restore soil
                        health, increase crop yields, and protect the environment.
                    </p>
                    <p>Made from 100% natural materials, EcoGrow Organic Fertilizer improves soil structure, boosts
                        plant growth, and enhances crop resistance to diseases. It’s suitable for vegetables, cereals,
                        fruits, and cash crops.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- About section End -->

    @include('components.mission')
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
                                <img src="assets/img/icons/top-quotes.svg" class="svg_img test_svg top" alt="user">
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
                                <img src="assets/img/icons/bottom-quotes.svg" class="svg_img test_svg bottom" alt="">
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
                                <img src="assets/img/icons/bottom-quotes.svg" class="svg_img test_svg bottom" alt="">
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
                                <img src="assets/img/icons/bottom-quotes.svg" class="svg_img test_svg bottom" alt="">
                            </li>
                        </ul>
                    </div>
                    <span class="mn-testi-shape-2"></span>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="mn-team-section p-tb-15">
        <div class="mn-title">
            <h2>Our <span>Team</span></h2>
        </div>
        <div class="mn-team owl-carousel">
            <div class="mn-team-box">
                <div class="mn-team-img">
                    <img src="assets/img/user/1.jpg" alt="user">
                    <div class="mn-team-socials">
                        <ul class="align-itemn-center">
                            <li class="mn-social-link">
                                <a href="#"><i class="ri-twitter-line"></i></a>
                            </li>
                            <li class="mn-social-link">
                                <a href="#"><i class="ri-facebook-line"></i></a>
                            </li>
                            <li class="mn-social-link">
                                <a href="#"><i class="ri-linkedin-line"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="mn-team-info">
                    <h5>Olivia Smith</h5>
                    <p>Founder</p>
                </div>
            </div>
            <div class="mn-team-box">
                <div class="mn-team-img">
                    <img src="assets/img/user/2.jpg" alt="user">
                    <div class="mn-team-socials">
                        <ul class="align-itemn-center">
                            <li class="mn-social-link">
                                <a href="#"><i class="ri-twitter-line"></i></a>
                            </li>
                            <li class="mn-social-link">
                                <a href="#"><i class="ri-facebook-line"></i></a>
                            </li>
                            <li class="mn-social-link">
                                <a href="#"><i class="ri-linkedin-line"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="mn-team-info">
                    <h5>William Dalin</h5>
                    <p>Co-Founder</p>
                </div>
            </div>
            <div class="mn-team-box">
                <div class="mn-team-img">
                    <img src="assets/img/user/3.jpg" alt="user">
                    <div class="mn-team-socials">
                        <ul class="align-itemn-center">
                            <li class="mn-social-link">
                                <a href="#"><i class="ri-twitter-line"></i></a>
                            </li>
                            <li class="mn-social-link">
                                <a href="#"><i class="ri-facebook-line"></i></a>
                            </li>
                            <li class="mn-social-link">
                                <a href="#"><i class="ri-linkedin-line"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="mn-team-info">
                    <h5>Emma Welson</h5>
                    <p>Manager</p>
                </div>
            </div>
            <div class="mn-team-box">
                <div class="mn-team-img">
                    <img src="assets/img/user/4.jpg" alt="user">
                    <div class="mn-team-socials">
                        <ul class="align-itemn-center">
                            <li class="mn-social-link">
                                <a href="#"><i class="ri-twitter-line"></i></a>
                            </li>
                            <li class="mn-social-link">
                                <a href="#"><i class="ri-facebook-line"></i></a>
                            </li>
                            <li class="mn-social-link">
                                <a href="#"><i class="ri-linkedin-line"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="mn-team-info">
                    <h5>Benjamin Martin</h5>
                    <p>Leader</p>
                </div>
            </div>
            <div class="mn-team-box">
                <div class="mn-team-img">
                    <img src="assets/img/user/5.jpg" alt="user">
                    <div class="mn-team-socials">
                        <ul class="align-itemn-center">
                            <li class="mn-social-link">
                                <a href="#"><i class="ri-twitter-line"></i></a>
                            </li>
                            <li class="mn-social-link">
                                <a href="#"><i class="ri-facebook-line"></i></a>
                            </li>
                            <li class="mn-social-link">
                                <a href="#"><i class="ri-linkedin-line"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="mn-team-info">
                    <h5>Amelia Martin</h5>
                    <p>Leader</p>
                </div>
            </div>
            <div class="mn-team-box">
                <div class="mn-team-img">
                    <img src="assets/img/user/7.jpg" alt="user">
                    <div class="mn-team-socials">
                        <ul class="align-itemn-center">
                            <li class="mn-social-link">
                                <a href="#"><i class="ri-twitter-line"></i></a>
                            </li>
                            <li class="mn-social-link">
                                <a href="#"><i class="ri-facebook-line"></i></a>
                            </li>
                            <li class="mn-social-link">
                                <a href="#"><i class="ri-linkedin-line"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="mn-team-info">
                    <h5>Margret Smith</h5>
                    <p>Marketing</p>
                </div>
            </div>
            <div class="mn-team-box">
                <div class="mn-team-img">
                    <img src="assets/img/user/8.jpg" alt="user">
                    <div class="mn-team-socials">
                        <ul class="align-itemn-center">
                            <li class="mn-social-link">
                                <a href="#"><i class="ri-twitter-line"></i></a>
                            </li>
                            <li class="mn-social-link">
                                <a href="#"><i class="ri-facebook-line"></i></a>
                            </li>
                            <li class="mn-social-link">
                                <a href="#"><i class="ri-linkedin-line"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="mn-team-info">
                    <h5>Julee Beans</h5>
                    <p>Manager</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Facts Section End -->
</div>

@endsection