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
                    <img src="assets/img/abt1.jpg" class="v-img" alt="about">
                    <img src="assets/img/abt2.jpg" class="h-img" alt="about">
                    <img src="assets/img/abt3.jpg" class="h-img" alt="about">
                    <img src="assets/img/abt4.jpg" class="h-img" alt="about">
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
                <div class="section-title d-none">
                    <h2>Customers <span>Review</span></h2>
                </div>
                <div class="mn-test-outer mn-testimonials">
                    <ul class="mn-testimonial-slider owl-carousel">
                        @if(isset($customerReviews) && count($customerReviews) > 0)
                        @foreach($customerReviews as $review)
                        <li class="mn-test-item">
                            <img src="assets/img/icons/top-quotes.svg" class="svg_img test_svg top" alt="user">
                            <div class="mn-test-inner">
                                <div class="mn-test-img">
                                    @if($review->image)
                                    <img alt="testimonial" title="testimonial"
                                        src="{{ asset('storage/' . $review->image) }}">
                                    @endif
                                </div>
                                <div class="mn-test-content">
                                    <div class="mn-test-desc">{{ $review->review }}</div>
                                    <div class="mn-test-name">{{ $review->customer_name }}</div>
                                    @if(!empty($review->designation))
                                    <div class="mn-test-designation">({{ $review->designation }})</div>
                                    @endif
                                </div>
                            </div>
                            <img src="assets/img/icons/bottom-quotes.svg" class="svg_img test_svg bottom" alt="">
                        </li>
                        @endforeach
                        @else
                        <li class="mn-test-item">
                            <div class="mn-test-content">
                                <div class="mn-test-desc">No customer reviews available yet.</div>
                            </div>
                        </li>
                        @endif
                    </ul>
                </div>
                <span class="mn-testi-shape-2"></span>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="mn-team-section p-tb-15">
        <div class="mn-title">
            <h2>Our <span>Team</span></h2>
        </div>
        <div class="mn-team owl-carousel">
            @forelse($teamMembers as $member)
            <div class="mn-team-box">
                <div class="mn-team-img">
                    @if($member->image)
                    <img src="{{ asset('storage/' . $member->image) }}" alt="{{ $member->name }}" height="200"
                        width="150">
                    @endif
                    <div class="mn-team-socials">
                        <ul class="align-itemn-center">
                            @if($member->linkedin_url)
                            <li class="mn-social-link">
                                <a href="{{ $member->linkedin_url }}" target="_blank"><i
                                        class="ri-linkedin-line"></i></a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="mn-team-info">
                    <h5>{{ $member->name }}</h5>
                    <p>{{ $member->position }}</p>
                </div>
            </div>
            @empty
            <div class="mn-team-box">
                <div class="mn-team-info">
                    <p>No team members found.</p>
                </div>
            </div>
            @endforelse
        </div>
    </section>
    <!-- Facts Section End -->
</div>

@endsection