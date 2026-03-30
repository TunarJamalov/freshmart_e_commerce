@extends('front.layouts.master')

@section('page_main_content')
<!-- Breadcrumb -->
<section class="breadcrumb-section py-3 bg-light">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="index.html" class="text-success">Home</a></li>
                <li class="breadcrumb-item"><a href="cart.html" class="text-success">Cart</a></li>
                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Checkout Section -->
<section class="checkout-section py-5">
    <div class="container">
        <h2 class="fw-bold mb-4">Checkout</h2>

        <div class="row g-4">
            <!-- Checkout Form -->
            <div class="col-lg-8">

                <!-- Shipping Method -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">Shipping Method</h5>

                        <form id="deliveryForm" method="POST" action="{{ route('change_delivery_option') }}">
                        @csrf
                        @foreach($delivery_options as $item)
                        <div class="form-check mb-3 p-3 border rounded">
                            <input class="form-check-input shipping-method" type="radio" name="delivery_option_id" id="current_item_{{ $loop->iteration }}" value="{{ $item->id }}" {{ session()->get('delivery_option_id') == $item->id ? 'checked' : '' }}>
                            <label class="form-check-label w-100 d-flex justify-content-between" for="current_item_{{ $loop->iteration }}">
                                <div>
                                    <strong>{{ $item->name }}</strong>
                                    <div class="small text-muted">{!! $item->description !!}</div>
                                </div>
                                <strong class="text-success">${{ number_format($item->cost, 2) }}</strong>
                            </label>
                        </div>
                        @endforeach
                        </form>
                    </div>
                </div>

                <script>
                document.querySelectorAll('.shipping-method').forEach(function(item){
                    item.addEventListener('change', function(){
                        document.getElementById('deliveryForm').submit();
                    });
                });
                </script>


                <form action="{{ route('payment') }}" method="post">
                @csrf

                <!-- Billing Details -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">Billing and Shipping Details</h5>
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <label class="form-label">Name <span class="text-danger">*</span></label>
                                <input name="billing_name" type="text" class="form-control" value="{{ Auth::guard('web')->user()->name }}">
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label">Email Address <span class="text-danger">*</span></label>
                                <input name="billing_email" type="email" class="form-control" value="{{ Auth::guard('web')->user()->email }}">
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                                <input name="billing_phone" type="text" class="form-control" value="{{ Auth::guard('web')->user()->phone }}">
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label">Address <span class="text-danger">*</span></label>
                                <input name="billing_address" type="text" class="form-control" value="{{ Auth::guard('web')->user()->address }}">
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label">Country <span class="text-danger">*</span></label>
                                <input name="billing_country" type="text" class="form-control" value="{{ Auth::guard('web')->user()->country }}">
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label">State <span class="text-danger">*</span></label>
                                <input name="billing_state" type="text" class="form-control" value="{{ Auth::guard('web')->user()->state }}">
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label">City <span class="text-danger">*</span></label>
                                <input name="billing_city" type="text" class="form-control" value="{{ Auth::guard('web')->user()->city }}">
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label">Zip <span class="text-danger">*</span></label>
                                <input name="billing_zip" type="text" class="form-control" value="{{ Auth::guard('web')->user()->zip }}">
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label">Order Notes (Optional)</label>
                                <textarea name="note" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                

                <!-- Payment Method -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">Payment Method</h5>

                        <div class="form-check mb-3 p-3 border rounded">
                            <input class="form-check-input" type="radio" name="payment_method" id="paypal" value="paypal" checked>
                            <label class="form-check-label" for="paypal">
                                <strong>PayPal</strong>
                                <div class="small text-muted">You will be redirected to PayPal</div>
                            </label>
                        </div>

                        <div class="form-check mb-3 p-3 border rounded">
                            <input class="form-check-input" type="radio" name="payment_method" id="stripe" value="stripe">
                            <label class="form-check-label" for="stripe">
                                <strong>Stripe</strong>
                                <div class="small text-muted">You will be redirected to Stripe</div>
                            </label>
                        </div>

                        <div class="form-check p-3 border rounded">
                            <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod">
                            <label class="form-check-label" for="cod">
                                <strong>Cash on Delivery</strong>
                                <div class="small text-muted">Pay when you receive the order</div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm sticky-top checkout-sticky">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">Order Summary</h5>

                        <!-- Cart Items -->
                        <div class="cart-items-summary mb-4">

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
                                <div class="d-flex align-items-center mb-3">
                                    <img src="{{ asset('uploads/'.$variation->product->photo) }}" alt="{{ $variation->product->name }}" class="rounded me-2 product-thumb">
                                    <div class="flex-grow-1">
                                        <small class="d-block">{{ $variation->product->name }}</small>
                                        <small class="text-muted">{{ $variation->label }} × {{ $item['quantity'] }}</small>
                                    </div>
                                    @php
                                    $temp_total = $variation->sale_price * $item['quantity'];
                                    @endphp
                                    <span class="fw-bold">${{ number_format($temp_total, 2) }}</span>
                                </div>
                                @php
                                    $subtotal += $temp_total;
                                @endphp
                            @endforeach
                        </div>

                        <hr>

                        <!-- Pricing Details -->
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Subtotal:</span>
                            <span>${{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Delivery Fee:</span>
                            <span>(+) ${{ number_format(session('delivery_option_cost'), 2) }}</span>
                        </div>
                        @php
                            if(session()->has('coupon_discount')){
                                $discount = number_format($subtotal * session('coupon_discount')/100, 2);
                            } else {
                                $discount = number_format(0, 2);
                            }
                            $total = $subtotal + session('delivery_option_cost') - $discount;
                        @endphp
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Discount:</span>
                            <span class="text-success">(-) ${{ $discount }}</span>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between mb-4">
                            <span class="fw-bold fs-5">Total:</span>
                            <span class="fw-bold fs-5 text-success" id="total">${{ number_format($total, 2) }}</span>
                        </div>

                        <!-- Place Order Button -->
                        <button type="submit" class="btn btn-success w-100 mb-3">
                            <i class="bi bi-lock me-2"></i>Place Order
                        </button>

                        <!-- Security Badge -->
                        <div class="text-center">
                            <small class="text-muted">
                                <i class="bi bi-shield-check text-success me-1"></i>
                                Secure Checkout - SSL Encrypted
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <input type="hidden" name="subtotal_price" value="{{ $subtotal }}">
            <input type="hidden" name="total_price" value="{{ $total }}">
            <input type="hidden" name="product_name" value="Grocery Items">
            <input type="hidden" name="quantity" value="1">

            </form>

        </div>
    </div>
</section>
@endsection