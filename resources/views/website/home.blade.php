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
                            <!-- <p class="label"><span>50%<br>Off</span></p> -->
                            <h1>EcoGrow Organic <br>Fertilizer</h1>
                            <p>Dedicated to supplying 100% organic fertilizers that promote sustainable farming and
                                healthy food production.</p>
                            <a href="{{ route('website.products') }}" class="mn-btn-2"><span>Shop Now</span></a>
                        </div>
                    </div>
                    <div class="mn-hero-slide swiper-slide slide-2">
                        <div class="mn-hero-detail">
                            <!-- <p class="label"><span>35%<br>Off</span></p> -->
                            <h2>Made from 100% <br>natural materials</h2>
                            <p>EcoGrow Organic Fertilizer improves soil structure, boosts plant growth, and
                                enhances crop resistance to diseases.</p>
                            <a href="{{ route('website.products') }}" class="mn-btn-2"><span>Shop Now</span></a>
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
                                        <h3> 100% Organic </h3>
                                        <h4>Fertilizers</h4>
                                    </div>
                                    <div class="inner-text">
                                        <span class="bnr-text">Environmental Friendly</span>
                                        <p>Our processes are designed to minimize carbon footprint and protect
                                            biodiversity.</p>
                                    </div>
                                    <div class="banner-btn">
                                        <a href="{{ route('website.products') }}" class="mn-btn-1"><span>Shop
                                                Now</span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="modern-banner">
                                <div class="mn-banner-img img-2"></div>
                                <div class="mn-banner-contact banner-animation">
                                    <div class="inner-banner">
                                        <h3> 100% Organic </h3>
                                        <h4>Fertilizers</h4>
                                    </div>
                                    <div class="inner-text">
                                        <span class="bnr-text">Environmental Friendly</span>
                                        <p>Our processes are designed to minimize carbon footprint and protect
                                            biodiversity.</p>
                                    </div>
                                    <div class="banner-btn">
                                        <a href="{{ route('website.products') }}" class="mn-btn-1"><span>Shop
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
                        <div class="section-title">
                            <h2>Customers <span>Review</span></h2>
                        </div>
                        <div class="testim-bg">
                            <div class="mn-test-outer mn-testimonials">
                                <ul class="mn-testimonial-slider owl-carousel">
                                    @forelse($customerReviews as $review)
                                    <li class="mn-test-item">
                                        <img src="assets/img/icons/top-quotes.svg" class="svg_img test_svg top"
                                            alt="user">
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
                                            </div>
                                        </div>
                                        <img src="assets/img/icons/bottom-quotes.svg" class="svg_img test_svg bottom"
                                            alt="">
                                    </li>
                                    @empty
                                    <li class="mn-test-item">
                                        <div class="mn-test-content">No customer reviews yet.</div>
                                    </li>
                                    @endforelse
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
                    @foreach ($blogs as $blog)
                    <div class="mn-blog-card">
                        <div class="blog-info">
                            <figure class="blog-img"><a href="{{ route('website.blog.details', $blog->id) }}"><img
                                        src="{{ asset('storage/' . $blog->display_image) }}" alt="news imag"></a>
                            </figure>
                            <div class="detail">
                                <label>{{ $blog->created_at->format('M d, Y') }}</label>
                                <h3><a href="{{ route('website.blog.details', $blog->id) }}">{{ $blog->title }}</a></h3>
                                <div class="more-info">
                                    <a href="{{ route('website.blog.details', $blog->id) }}">Read More<i
                                            class="ri-arrow-right-double-line"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
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