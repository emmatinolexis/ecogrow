@extends('website.master')
@section('content')
<div class="mn-main-content">
    <div class="row">
        <div class="col-xxl-12">
            <section class="mn-shop padding-tb-30">
                <div class="row">
                    <div class="mn-shop-rightside col-lg-9 col-md-12">
                        <div class="shop-pro-content">
                            <div class="shop-pro-inner">
                                <div class="row">
                                    @foreach($products as $product)
                                    <div class="col-md-4 col-sm-6 col-xs-6 m-b-24 mn-product-box pro-gl-content">
                                        <div class="mn-product-card">
                                            <div class="mn-product-img">
                                                <div class="mn-img">
                                                    <a href="{{ route('website.product.details', $product->id) }}"
                                                        class="image">
                                                        <img class="main-img"
                                                            src="{{ $product->images->first() ? asset('storage/' . $product->images->first()->image_url) : asset('images/default.png') }}"
                                                            alt="{{ $product->name }}"
                                                            style="height:250px;width:100%;object-fit:cover;">
                                                        @if($product->images->count() > 1)
                                                        <img class="hover-img"
                                                            src="{{ asset('storage/' . $product->images[1]->image_url) }}"
                                                            alt="{{ $product->name }}"
                                                            style="height:250px;width:100%;object-fit:cover;">
                                                        @endif
                                                    </a>
                                                    <div class="mn-options">
                                                        <ul>
                                                            <li><a href="javascript:void(0)" data-tooltip
                                                                    title="Quick View" data-link-action="quickview"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#quickview_modal_{{ $product->id }}"><i
                                                                        class="ri-eye-line"></i></a></li>
                                                            <li><a href="javascript:void(0)" data-tooltip
                                                                    title="Compare" class="mn-compare"><i
                                                                        class="ri-repeat-line"></i></a></li>
                                                            <li>
                                                                <a type="button"
                                                                    class="mn-add-cart btn p-0 add-to-cart-btn"
                                                                    data-product-id="{{ $product->id }}" data-tooltip
                                                                    title="Add To Cart"
                                                                    style="background:none;border:none;">
                                                                    <i class="ri-shopping-cart-line"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mn-product-detail">
                                                <div class="cat">
                                                    <a
                                                        href="#">{{ $product->category ? $product->category->name : '' }}</a>
                                                </div>
                                                <h5><a
                                                        href="{{ route('website.product.details', $product->id) }}">{{ $product->name }}</a>
                                                </h5>
                                                <p class="mn-info">
                                                    {!! \Illuminate\Support\Str::limit($product->description, 50) !!}
                                                </p>
                                                <div class="mn-price">
                                                    <div class="mn-price-new">GHC{{ $product->discounted_price }}</div>
                                                    @if($product->active_discount)
                                                    <div class="mn-price-old">GHC{{ $product->price }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mn-shop-sidebar col-lg-3 col-md-12 m-t-991">
                        <div id="shop_sidebar">
                            <div class="mn-sidebar-wrap">
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
$(document).ready(function() {
    function showToast(message, type = 'success') {
        let bgClass = type === 'success' ? 'alert-success' : 'alert-danger';
        let toast = $('<div></div>')
            .addClass(`alert ${bgClass} position-fixed top-0 end-0 m-4`)
            .css('z-index', 9999)
            .text(message);
        $('body').append(toast);
        setTimeout(() => {
            toast.remove();
        }, 2500);
    }
    $('.add-to-cart-btn').on('click', function(e) {
        e.preventDefault();
        let productId = $(this).data('product-id');
        let productOptionId = $(this).closest('.mn-product-card').find('.option-item.active').data(
            'option-id') || null;
        let productQuantity = 1;
        axios.post("{{ route('cart.add') }}", {
                product_id: productId,
                quantity: productQuantity,
                product_option_id: productOptionId
            }, {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                }
            })
            .then(function(response) {
                showToast('Product added to cart!', 'success');
            })
            .catch(function(error) {
                if (error.response && error.response.status === 401) {
                    showToast(error.response.data.message, 'danger');
                } else {
                    showToast('An error occurred.', 'danger');
                }
            });
    });
});
</script>
@endsection