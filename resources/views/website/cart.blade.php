@extends('website.master')
@section('content')

<!-- Main Content -->
<div class="mn-main-content">
    <div class="mn-breadcrumb m-b-30">
        <div class="row">
            <div class="col-12">
                <div class="row gi_breadcrumb_inner">
                    <div class="col-md-6 col-sm-12">
                        <h2 class="mn-breadcrumb-title">Cart Page</h2>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <!-- mn-breadcrumb-list start -->
                        <ul class="mn-breadcrumb-list">
                            <li class="mn-breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="mn-breadcrumb-item active">Cart Page</li>
                        </ul>
                        <!-- mn-breadcrumb-list end -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cart section -->
    <section class="mn-cart-section p-b-15">
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <h2 class="d-none">Cart Page</h2>
        <div class="row">
            <div class="mn-cart-leftside col-lg-9 col-md-12">
                <!-- cart content Start -->
                <div class="mn-cart-content">
                    <div class="mn-cart-inner cart_list">
                        <div class="row">
                            <div class="table-content cart-table-content">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th style="text-align: center;">Quantity</th>
                                            <th>Total</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($cartItems as $item)
                                        <tr class="mn-cart-product">
                                            <td data-label="Product" class="mn-cart-pro-name">
                                                <a href="{{ route('website.product.details', $item->product->id) }}">
                                                    <img class="mn-cart-pro-img"
                                                        src="{{ asset('storage/' . $item->product->images->first()->image_url) }}"
                                                        alt="">{{ $item->product->name }}
                                                </a>
                                                @if($item->options->count())
                                                <div class="small text-muted">Options:
                                                    @foreach($item->options as $option)
                                                    {{ $option->option_type }}:
                                                    {{ $option->option_value }}@if(!$loop->last), @endif
                                                    @endforeach
                                                </div>
                                                @endif
                                            </td>
                                            <td data-label="Price" class="mn-cart-pro-price">
                                                <span
                                                    class="amount">GHS{{ number_format($item->product->discounted_price, 2) }}</span>
                                            </td>
                                            <td data-label="Quantity" class="mn-cart-pro-qty"
                                                style="text-align: center;">
                                                <form action="{{ route('cart.update', $item->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    <div class="cart-qty-plus-minus d-flex align-items-center">
                                                        <input class="cart-plus-minus" type="number" name="quantity"
                                                            value="{{ $item->quantity }}" min="1" style="width:60px;">
                                                        <button type="submit" class="btn btn-sm btn-primary ms-2"
                                                            title="Update Quantity"><i
                                                                class="ri-refresh-line"></i></button>
                                                    </div>
                                                </form>
                                            </td>
                                            <td data-label="Total" class="mn-cart-pro-subtotal">
                                                GHS{{ number_format($item->product->discounted_price * $item->quantity, 2) }}
                                            </td>
                                            <td data-label="Remove" class="mn-cart-pro-remove">
                                                <form action="{{ route('cart.remove', $item->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-link p-0"
                                                        onclick="return confirm('Remove this item from cart?')"
                                                        title="Remove">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Your cart is empty.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- Shipping Address Selection -->
                            <div class="col-lg-12 mt-4">
                                <h4>Select Shipping Address</h4>
                                @php
                                $shippingAddresses = \App\Models\ShippingAddress::where('user_id', Auth::id())->get();
                                $defaultAddressId = $shippingAddresses->where('is_default', true)->first()?->id;
                                @endphp
                                @if($shippingAddresses->count())
                                <form action="{{ route('orders.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <select name="shipping_address_id" class="form-control">
                                            @foreach($shippingAddresses as $address)
                                            <option value="{{ $address->id }}"
                                                {{ $address->id == $defaultAddressId ? 'selected' : '' }}>
                                                {{ $address->address_line_1 }}, {{ $address->city }},
                                                {{ $address->country }}
                                                @if($address->is_default) (Default) @endif
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mn-cart-update-bottom">
                                        <a href="{{ route('website.products') }}">Continue Shopping</a>
                                        <button type="submit" class="mn-btn-2"><span>Make an order</span></button>
                                    </div>
                                </form>
                                @else
                                <p class="text-warning">No shipping addresses found. <a
                                        href="{{ route('shipping_addresses.index') }}">Add one here</a>.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!--cart content End -->
            </div>
            <!-- Sidebar Area Start -->
            <div class="mn-cart-rightside col-lg-3 col-md-12 m-t-991">
                <div class="mn-sidebar-wrap">
                    <!-- Sidebar Summary Block -->
                    <div class="mn-sidebar-block">
                        <div class="mn-sb-title">
                            <h3 class="mn-sidebar-title">Summary</h3>
                        </div>


                        <div class="mn-sb-block-content">
                            <div class="mn-cart-summary-bottom">
                                <div class="mn-cart-summary">
                                    <div>
                                        <span class="text-left">Sub-Total</span>
                                        <span class="text-right">GHS{{ number_format($cartSubtotal, 2) }}</span>
                                    </div>
                                    <div>
                                        <span class="text-left">Delivery Charges</span>
                                        <span class="text-right">GHS 0.0</span>
                                    </div>
                                    <div class="mn-cart-summary-total">
                                        <span class="text-left">Total Amount</span>
                                        <span class="text-right">GHS{{ number_format($cartTotal, 2) }}</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection