<div id="mn-side-cart" class="mn-side-cart">
    <div class="mn-cart-inner">
        <div class="mn-cart-top">
            <div class="mn-cart-title">
                <span class="cart_title">My Cart</span>
                <a href="javascript:void(0)" class="mn-cart-close">
                    <i class="ri-close-line"></i>
                </a>
            </div>
            @props(['cartItems' => collect(), 'cartSubtotal' => 0, 'cartTotal' => 0])
            <ul class="mn-cart-pro-items">
                @foreach($cartItems as $item)
                <li class="cart-sidebar-list">
                    <a href="{{ route('website.product.details', $item->product->id) }}" class="mn-pro-img">
                        <img src="{{ asset('storage/' . $item->product->images->first()->image_url) }}" alt="product">
                    </a>
                    <div class="mn-pro-content">
                        <a href="{{ route('website.product.details', $item->product->id) }}" class="cart-pro-title">
                    </div>

                    <span class="cart-price">
                        <span>GHS{{ number_format($item->product->discounted_price, 2) }}</span> x
                        {{ $item->quantity }}
                    </span>
                    <div class="qty-plus-minus">
                        <input class="qty-input" type="text" name="mn-qtybtn" value="{{ $item->quantity }}" readonly>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>

        <li class="text-center p-3">Your cart is empty.</li>

    </div>
    <div class="mn-cart-bottom">
        <div class="cart-sub-total">
            <table class="table cart-table">
                <tbody>
                    <tr>
                        <td class="text-left">Sub-Total :</td>
                        <td class="text-right">GHS{{ number_format($cartSubtotal, 2) }}</td>
                    </tr>
                    <tr>
                        <td class="text-left">VAT (0%) :</td>
                        <td class="text-right">GHS0.00</td>
                    </tr>
                    <tr>
                        <td class="text-left">Total :</td>
                        <td class="text-right primary-color">GHS{{ number_format($cartTotal, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="cart_btn">
            <a href="{{ route('cart.index') }}" class="mn-btn-1"><span>Cart<i
                        class="ri-arrow-right-s-line"></i></span></a>
            <a href="{{ route('checkout') }}" class="mn-btn-2"><span>Checkout<i
                        class="ri-arrow-right-s-line"></i></span></a>
        </div>
    </div>
</div>
</div>