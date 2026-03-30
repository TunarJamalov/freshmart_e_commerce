@extends('front.layouts.master')

@section('page_main_content')
<!-- Breadcrumb -->
<section class="breadcrumb-section py-3 bg-light">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-success">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Cart Section -->
<section class="cart-section py-5">
    <div class="container">
        <h2 class="fw-bold mb-4">Shopping Cart</h2>
        
        <div class="row g-4">

            @if(session()->has('cart') && count(session()->get('cart')) > 0)

            <!-- Cart Items -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col" class="px-4 py-3">Product</th>
                                        <th scope="col" class="py-3">Price</th>
                                        <th scope="col" class="py-3">Quantity</th>
                                        <th scope="col" class="py-3">Total</th>
                                        <th scope="col" class="py-3">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @php
                                    $subtotal = 0;
                                    $cart = session()->get('cart', []);
                                    @endphp

                                    @foreach($cart as $item)
                                    @php
                                    $variation = \App\Models\ProductVariation::find($item['product_variation_id']);
                                    $price = $variation->sale_price;
                                    $total = $price * $item['quantity'];
                                    @endphp
                                    <tr class="cart-item" data-price="4.00">
                                        <td class="px-4 py-3">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('uploads/'.$variation->product->photo) }}" alt="{{ $variation->product->name }}" class="rounded me-3 cart-product-thumb">
                                                <div>
                                                    <h6 class="mb-1">{{ $variation->product->name }}</h6>
                                                    <small class="text-muted">{{ $variation->label }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-3 align-middle">
                                            <span class="fw-bold text-success item-price">${{ $variation->sale_price }}</span>
                                        </td>
                                        <td class="py-3 align-middle">
                                            <div class="input-group quantity-input">
                                                <form action="{{ route('cart_update') }}" method="post">
                                                    @csrf
                                                    @php
                                                    $updated_quantity = $item['quantity'] - 1;
                                                    @endphp
                                                    <input type="hidden" name="product_variation_id" value="{{ $item['product_variation_id'] }}">
                                                    <input type="hidden" name="quantity" value="{{ $updated_quantity }}">
                                                    <button class="btn btn-sm btn-outline-secondary qty-decrease" type="submit"><i class="bi bi-dash"></i></button>
                                                </form>
                                                <input type="text" class="form-control form-control-sm text-center qty-input" value="{{ $item['quantity'] }}">
                                                <form action="{{ route('cart_update') }}" method="post">
                                                    @csrf
                                                    @php
                                                    $updated_quantity = $item['quantity'] + 1;
                                                    @endphp
                                                    <input type="hidden" name="product_variation_id" value="{{ $item['product_variation_id'] }}">
                                                    <input type="hidden" name="quantity" value="{{ $updated_quantity }}">
                                                    <button class="btn btn-sm btn-outline-secondary qty-increase" type="submit"><i class="bi bi-plus"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                        @php
                                        $temp_total = $variation->sale_price * $item['quantity'];
                                        @endphp
                                        <td class="py-3 align-middle">
                                            <span class="fw-bold item-total">${{ number_format($temp_total, 2) }}</span>
                                        </td>
                                        <td class="py-3 align-middle">
                                            <a href="{{ route('cart_remove', $item['product_variation_id']) }}" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?');">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @php
                                    $subtotal += $temp_total;
                                    @endphp
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('products') }}" class="btn btn-outline-success">
                        <i class="bi bi-arrow-left me-2"></i>Continue Shopping
                    </a>
                    <a href="{{ route('cart_clear') }}" class="btn btn-outline-danger" onclick="return confirm('Are you sure?');">
                        <i class="bi bi-trash me-2"></i>Clear Cart
                    </a>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold mb-4">Order Summary</h5>
                        
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Subtotal:</span>
                            <span class="fw-bold" id="subtotal">${{ number_format($subtotal, 2) }}</span>
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Delivery Fee:</span>
                            <span class="fw-bold" id="delivery">(+) ${{ number_format(session('delivery_option_cost'), 2) }}</span>
                        </div>
                        @php
                        if(session()->has('coupon_discount')){
                            $discount = number_format($subtotal * session('coupon_discount')/100, 2);
                        } else {
                            $discount = number_format(0, 2);
                        }
                        $total = $subtotal + session('delivery_option_cost') - $discount;
                        @endphp
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Discount{{ session()->has('coupon_code') ? ' ('.session('coupon_code').')' : '' }}:</span>
                            <span class="text-success fw-bold" id="discount">(-) ${{ $discount }}</span>
                        </div>
                        @if(session()->has('coupon_discount'))
                        <a href="{{ route('remove_coupon', session('coupon_id')) }}" class="text-danger" onclick="return confirm('Are you sure?')">Remove</a>
                        @endif
                        
                        <hr>
                        
                        <div class="d-flex justify-content-between mb-4">
                            <span class="fw-bold fs-5">Total:</span>
                            <span class="fw-bold fs-5 text-success" id="total">${{ number_format($total, 2) }}</span>
                        </div>

                        <!-- Coupon Code -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Have a Coupon?</label>
                            <form action="{{ route('apply_coupon') }}" method="post">
                            @csrf
                            <div class="input-group">
                                <input name="code" type="text" class="form-control" placeholder="Enter coupon code">
                                <button class="btn btn-outline-success" type="submit">Apply</button>
                            </div>
                            </form>
                        </div>

                        <!-- Proceed to Checkout -->
                        <a href="{{ route('checkout') }}" class="btn btn-success w-100 mb-3">
                            <i class="bi bi-lock me-2"></i>Proceed to Checkout
                        </a>
                    </div>
                </div>
            </div>

            @else
            <div class="col-lg-12">
                <p class="text-danger">Your cart is empty.</p>
            </div>
            @endif
        </div>



    </div>
</section>
@endsection