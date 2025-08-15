@extends('website.master')
@section('content')

@endsection

<div class="row">
    @foreach($products as $product)
        <div class="col-md-4 col-sm-6 col-xs-6 m-b-24 mn-product-box pro-gl-content">
            <div class="mn-product-card">
                <div class="mn-product-img">
                    <div class="lbl">
                        @if($product->active_discount)
                            <span class="sale">Sale</span>
                        @else
                            <span class="new">new</span>
                        @endif
                    </div>
                    <div class="mn-img">
                        <a href="#" class="image">
                            <img class="main-img"
                                src="{{ $product->images->first() ? asset('storage/' . $product->images->first()->image_url) : asset('assets/img/product/default.jpg') }}"
                                alt="{{ $product->name }}">
                            @if($product->images->count() > 1)
                                <img class="hover-img" src="{{ asset('storage/' . $product->images[1]->image_url) }}"
                                    alt="{{ $product->name }}">
                            @endif
                        </a>
                        <div class="mn-pro-loader"></div>
                        <div class="mn-options">
                            <ul>
                                <li><a href="javascript:void(0)" data-tooltip title="Quick View"
                                        data-link-action="quickview" data-bs-toggle="modal"
                                        data-bs-target="#quickview_modal"><i class="ri-eye-line"></i></a>
                                </li>
                                <li><a href="javascript:void(0)" data-tooltip title="Compare" class="mn-compare"><i
                                            class="ri-repeat-line"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="mn-product-detail">
                    <div class="cat">
                        <a href="#">{{ $product->category ? $product->category->name : '' }}</a>
                        <ul>
                            <li>s</li>
                            <li>m</li>
                            <li>xl</li>
                        </ul>
                    </div>
                    <h5><a href="#">{{ $product->name }}</a></h5>
                    <p class="mn-info">{{ $product->description }}</p>
                    <div class="mn-price">
                        <div class="mn-price-new">
                            ${{ $product->discounted_price }}</div>
                        @if($product->active_discount)
                            <div class="mn-price-old">${{ $product->price }}
                            </div>
                        @endif
                    </div>
                    <div class="mn-pro-option">
                        <div class="mn-pro-color">
                            <ul class="mn-opt-swatch mn-change-img">
                                <li><a href="#" class="mn-opt-clr-img" data-src="#" data-src-hover="#"
                                        data-tooltip="Color"><span style="background-color:#de8abc;"></span></a>
                                </li>
                                <li><a href="#" class="mn-opt-clr-img" data-src="#" data-src-hover="#"
                                        data-tooltip="Color"><span style="background-color:#5e68ce;"></span></a>
                                </li>
                                <li><a href="#" class="mn-opt-clr-img" data-src="#" data-src-hover="#"
                                        data-tooltip="Color"><span style="background-color:#eee;"></span></a>
                                </li>
                            </ul>
                        </div>
                        <a href="javascript:void(0);" class="mn-wishlist" data-tooltip title="Wishlist">
                            <i class="ri-heart-line"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>