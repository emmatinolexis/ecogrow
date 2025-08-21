<div class="mn-product-card">
    <div class="mn-product-img">
        <div class="mn-img">
            <a href="{{ route('website.product.details', $product->id) }}" class="image">
                <img class="main-img"
                    src="{{ $product->images->first() ? asset('storage/' . $product->images->first()->image_url) : asset('images/default.png') }}"
                    alt="{{ $product->name }}" style="height:250px;width:100%;object-fit:cover;">

                @if($product->images->count() > 1)
                    <img class="hover-img" src="{{ asset('storage/' . $product->images[1]->image_url) }}"
                        alt="{{ $product->name }}" style="height:250px;width:100%;object-fit:cover;">
                @endif
            </a>

            <div class="mn-options">
                <ul>
                    <li>
                        <a href="javascript:void(0)" data-tooltip title="Quick View" data-link-action="quickview"
                            data-bs-toggle="modal" data-bs-target="#quickview_modal_{{ $product->id }}">
                            <i class="ri-eye-line"></i>
                        </a>
                    </li>
                    <li>
                        <a type="button" class="mn-add-cart btn p-0 add-to-cart-btn"
                            data-product-id="{{ $product->id }}" data-tooltip title="Add To Cart"
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
            <a href="#">{{ $product->category ? $product->category->name : '' }}</a>
        </div>
        <h5>
            <a href="{{ route('website.product.details', $product->id) }}">{{ $product->name }}</a>
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