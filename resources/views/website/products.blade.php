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
                                                <x-product-card :product="$product" />
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
        window.routes = {
            addToCart: "{{ route('cart.add') }}"
        };
    </script>
    <script src="{{ asset('/assets/js/product.js')}}"></script>
@endsection