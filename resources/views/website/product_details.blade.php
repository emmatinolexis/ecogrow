@extends('website.master')
@section('content')
    <div class="mn-main-content">
        <div class="mn-breadcrumb m-b-30">
            <div class="row">
                <div class="col-12">
                    <div class="row gi_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="mn-breadcrumb-title">Product Page</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- mn-breadcrumb-list start -->
                            <ul class="mn-breadcrumb-list">
                                <li class="mn-breadcrumb-item"><a href="">Home</a></li>
                                <li class="mn-breadcrumb-item active">Product Page</li>
                            </ul>
                            <!-- mn-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-12">
                <section class="mn-single-product">
                    <div class="row">
                        <div class="mn-pro-rightside mn-common-rightside col-lg-9 col-md-12 m-b-15">
                            <!-- Single product content Start -->
                            <div class="single-pro-block">
                                <div class="single-pro-inner">
                                    <div class="row">
                                        <div class="single-pro-img">
                                            <div class="single-product-scroll">
                                                <div class="single-product-cover">
                                                    @foreach($product->images as $image)
                                                        <div class="single-slide zoom-image-hover">
                                                            <img class="img-responsive"
                                                                src="{{asset('storage/' . $image->image_url) }}" alt="">
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="single-nav-thumb">
                                                    @foreach($product->images as $image)
                                                        <div class="single-slide">
                                                            <img class="img-responsive"
                                                                src="{{asset('storage/' . $image->image_url) }}" alt="">
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-pro-desc m-t-991">
                                            <div class="single-pro-content">
                                                <h5 class="mn-single-title">{{ $product->name }}</h5>
                                                <div class="mn-single-rating-wrap">
                                                    <div class="mn-single-rating mn-pro-rating">
                                                        <i class="ri-star-fill"></i>
                                                        <i class="ri-star-fill"></i>
                                                        <i class="ri-star-fill"></i>
                                                        <i class="ri-star-fill"></i>
                                                        <i class="ri-star-fill grey"></i>
                                                    </div>
                                                    <span class="mn-read-review">
                                                        |&nbsp;&nbsp;<a href="#mn-spt-nav-review">992 Ratings</a>
                                                    </span>
                                                </div>
                                                <div class="mn-single-price-stoke">
                                                    <div class="mn-single-price">
                                                        <div class="final-price">GHS ${{ $product->discounted_price }}
                                                            @if($product->active_discount)
                                                                <span class="price-des">
                                                                    -
                                                                    {{ $product->discounts[0]->discount_percent }}</span>
                                                            @endif
                                                        </div>
                                                        @if($product->active_discount)
                                                            <div class="mrp">Actual Price : <span>GHS
                                                                    {{ $product->price }}</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                {!! \Illuminate\Support\Str::limit($product->description, 300) !!}
                                                <div class="mn-single-desc"></div>
                                                <div class="mn-pro-variation">
                                                    @php
                                                        $groupedOptions = $product->options->groupBy(function ($item) {
                                                            return strtolower($item->option_type);
                                                        });
                                                    @endphp
                                                    @foreach($groupedOptions as $type => $options)
                                                        <div class="mn-pro-variation-inner mn-pro-variation-{{ $type }} m-b-24">
                                                            <span>{{ ucfirst($type) }}</span>
                                                            <div class="mn-pro-variation-content">
                                                                <ul class="option-list" data-type="{{ $type }}">
                                                                    @foreach($options as $i => $option)
                                                                        <li class="option-item" data-option-id="{{ $option->id }}"
                                                                            data-type="{{ $type }}">
                                                                            @if($type === 'color')
                                                                                <span
                                                                                    style="background-color:{{ $option->option_value }}">&nbsp;&nbsp;&nbsp;</span>
                                                                            @else
                                                                                <span>{{ $option->option_value }}</span>
                                                                            @endif
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="mn-single-qty">
                                                    <div class="qty-plus-minus">
                                                        <input class="qty-input" type="text" name="ms_qtybtn" value="1">
                                                    </div>
                                                    <div class="mn-btns">
                                                        <div class="mn-single-cart">
                                                            <button class="btn btn-primary mn-btn-2 mn-add-cart"
                                                                id="add-to-cart-btn"
                                                                data-product-id="{{ $product->id }}"><span>Add To
                                                                    Cart</span></button>
                                                        </div>
                                                        <div class="mn-single-wishlist">
                                                            <a href="javascript:void(0)"
                                                                class="mn-btn-group wishlist mn-wishlist" title="Wishlist">
                                                                <i class="ri-heart-line"></i>
                                                            </a>
                                                        </div>
                                                        <div class="mn-single-mn-compare">
                                                            <a href="javascript:void(0)" class="mn-btn-group mn-compare"
                                                                title="Quick view">
                                                                <i class="ri-repeat-line"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Single product tab start -->
                            <div class="mn-single-pro-tab">
                                <div class="mn-single-pro-tab-wrapper">
                                    <div class="mn-single-pro-tab-nav">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="details-tab" data-bs-toggle="tab"
                                                    data-bs-target="#mn-spt-nav-details" type="button" role="tab"
                                                    aria-controls="mn-spt-nav-details" aria-selected="true">Detail</button>
                                            </li>

                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="review-tab" data-bs-toggle="tab"
                                                    data-bs-target="#mn-spt-nav-review" type="button" role="tab"
                                                    aria-controls="mn-spt-nav-review" aria-selected="false">Reviews</button>
                                            </li>
                                        </ul>

                                    </div>
                                    <div class="tab-content  mn-single-pro-tab-content">
                                        <div id="mn-spt-nav-details" class="tab-pane fade show active">
                                            <div class="mn-single-pro-tab-desc">
                                                {!! $product->description !!}
                                            </div>
                                        </div>
                                        <div id="mn-spt-nav-review" class="tab-pane fade">
                                            <div class="row">
                                                <div class="mn-t-review-wrapper mt-0">
                                                    <div class="mn-t-review-item">
                                                        <div class="mn-t-review-avtar">
                                                            <img src="/assets/img/user/1.jpg" alt="user">
                                                        </div>
                                                        <div class="mn-t-review-content">
                                                            <div class="mn-t-review-top">
                                                                <div class="mn-t-review-name">Mariya Lykra</div>
                                                                <div class="mn-t-review-rating mn-pro-rating">
                                                                    <i class="ri-star-fill"></i>
                                                                    <i class="ri-star-fill"></i>
                                                                    <i class="ri-star-fill"></i>
                                                                    <i class="ri-star-fill"></i>
                                                                    <i class="ri-star-fill grey"></i>
                                                                </div>
                                                            </div>
                                                            <div class="mn-t-review-bottom">
                                                                <p>Lorem Ipsum is simply dummy text of the printing
                                                                    and
                                                                    typesetting industry. Lorem Ipsum has been the
                                                                    industry's
                                                                    standard dummy text ever since the 1500s, when
                                                                    an unknown
                                                                    printer took a galley of type and scrambled it
                                                                    to make a
                                                                    type specimen.
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mn-t-review-item">
                                                        <div class="mn-t-review-avtar">
                                                            <img src="/assets/img/user/2.jpg" alt="user">
                                                        </div>
                                                        <div class="mn-t-review-content">
                                                            <div class="mn-t-review-top">
                                                                <div class="mn-t-review-name">Moris Willson</div>
                                                                <div class="mn-t-review-rating mn-pro-rating">
                                                                    <i class="ri-star-fill"></i>
                                                                    <i class="ri-star-fill"></i>
                                                                    <i class="ri-star-fill"></i>
                                                                    <i class="ri-star-fill grey"></i>
                                                                    <i class="ri-star-fill grey"></i>
                                                                </div>
                                                            </div>
                                                            <div class="mn-t-review-bottom">
                                                                <p>Lorem Ipsum has been the industry's
                                                                    standard dummy text ever since the 1500s, when
                                                                    an unknown
                                                                    printer took a galley of type and scrambled it
                                                                    to make a
                                                                    type specimen.
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="mn-ratting-content">
                                                    <h3>Add a Review</h3>
                                                    <div class="mn-ratting-form">
                                                        <form action="#">
                                                            <div class="mn-ratting-star">
                                                                <span>Your rating:</span>
                                                                <div class="mn-t-review-rating mn-pro-rating">
                                                                    <i class="ri-star-fill"></i>
                                                                    <i class="ri-star-fill"></i>
                                                                    <i class="ri-star-fill grey"></i>
                                                                    <i class="ri-star-fill grey"></i>
                                                                    <i class="ri-star-fill grey"></i>
                                                                </div>
                                                            </div>
                                                            <div class="mn-ratting-input">
                                                                <input name="your-name" placeholder="Name" type="text">
                                                            </div>
                                                            <div class="mn-ratting-input">
                                                                <input name="your-email" placeholder="Email*" type="email"
                                                                    required>
                                                            </div>
                                                            <div class="mn-ratting-input form-submit">
                                                                <textarea name="your-commemt"
                                                                    placeholder="Enter Your Comment"></textarea>
                                                                <button class="mn-btn-2" type="submit"
                                                                    value="Submit"><span>Submit</span></button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Related Section -->
                            <section class="mn-related-product m-t-30">
                                <div class="mn-title">
                                    <h2>Related <span>Products</span></h2>
                                </div>
                                <div class="mn-related owl-carousel">
                                    @foreach ($relatedProducts as $rp)
                                        <div class="mn-product-card">

                                            <div class="mn-product-img">

                                                <div class="mn-img">
                                                    <a href="{{ route('website.product.details', $rp->id) }}" class="image">

                                                        <a href="{{ route('website.product.details', $rp->id) }}" class="image">
                                                            <img class="main-img"
                                                                src="{{asset('storage/' . $rp->images->first()->image_url) }}"
                                                                alt="{{ $rp->name }}"
                                                                style="height:250px;width:100%;object-fit:cover;">
                                                            @if($rp->images->count() > 1)
                                                                <img class="hover-img"
                                                                    src="{{ asset('storage/' . $rp->images[1]->image_url) }}"
                                                                    alt="{{ $rp->name }}"
                                                                    style="height:250px;width:100%;object-fit:cover;">
                                                            @endif
                                                        </a>
                                                    </a>
                                                    <div class="mn-pro-loader"></div>
                                                    <div class="mn-options">
                                                        <ul>
                                                            <li><a href="javascript:void(0)" data-tooltip title="Quick View"
                                                                    data-link-action="quickview" data-bs-toggle="modal"
                                                                    data-bs-target="#quickview_modal">
                                                                    <i class="ri-eye-line"></i></a></li>
                                                            <li><a href="javascript:void(0)" data-tooltip title="Compare"
                                                                    class="mn-compare"><i class="ri-repeat-line"></i></a>
                                                            </li>
                                                            <li><a href="javascript:void(0)" data-tooltip title="Add To Cart"
                                                                    class="mn-add-cart"><i
                                                                        class="ri-shopping-cart-line"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mn-product-detail">
                                                <div class="cat">
                                                    <a
                                                        href="{{ route('website.product.details', $rp->id) }}">{{ $rp->name }}</a>
                                                    <ul>
                                                        <li>s</li>
                                                        <li>m</li>
                                                        <li>xl</li>
                                                    </ul>
                                                </div>
                                                <h5><a href="#">{{ $rp->category ? $product->category->name : '' }}</a></h5>
                                                <div class="mn-price">
                                                    <div class="mn-price-new">
                                                        ${{ $product->discounted_price }}</div>
                                                    @if($product->active_discount)
                                                        <div class="mn-price-old">${{ $product->price }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </section>
                        </div>
                        <!-- Sidebar Area Start -->
                        <div class="mn-shop-sidebar col-lg-3 col-md-12 m-t-991">
                            <div id="shop_sidebar">
                                <div class="mn-sidebar-wrap">
                                    <!-- Sidebar Filters Block -->
                                    @include('website.components.product-filters', ['categories' => $categories])
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
        $(document).ready(function () {
            // Option selection logic
            $('.option-list .option-item').on('click', function () {
                let $list = $(this).closest('.option-list');
                $list.find('.option-item').removeClass('active');
                $(this).addClass('active');
            });

            // Add to cart logic
            $('#add-to-cart-btn').on('click', function (e) {
                e.preventDefault();
                let productId = $(this).data('product-id');
                let quantity = $('.qty-input').val() || 1;
                let selectedOptions = [];
                $('.option-list').each(function () {
                    let $active = $(this).find('.option-item.active');
                    if ($active.length) {
                        selectedOptions.push($active.data('option-id'));
                    }
                });

                axios.post("{{ route('cart.add') }}", {
                    product_id: productId,
                    quantity: quantity,
                    product_options: selectedOptions
                }, {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                    }
                })
                    .then(function (response) {
                        alert('Product added to cart!');
                    })
                    .catch(function (error) {
                        if (error.response && error.response.status === 401) {
                            alert(error.response.data.message);
                        } else {
                            alert('An error occurred.');
                        }
                    });
            });
        });
    </script>
@endsection