@extends('front.layouts.master')

@section('page_main_content')
<!-- Hero Section -->
<section class="hero-section">
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
        </div>
        <div class="carousel-inner">

            @foreach($sliders as $slider)
            <div class="carousel-item @if($loop->first) active @endif">
                <div class="hero-slide bg-gradient-1">
                    <div class="container">
                        <div class="row align-items-center py-5">
                            <div class="col-lg-6 mb-4 mb-lg-0">
                                <h1 class="display-3 fw-bold mb-3">{{ $slider->title }}</h1>
                                <p class="lead mb-4">
                                    {!! nl2br($slider->description) !!}
                                </p>
                                @if($slider->button_text != '')
                                <a href="{{ $slider->button_url }}" class="btn btn-success btn-lg">{{ $slider->button_text }} <i class="bi bi-arrow-right"></i></a>
                                @endif
                            </div>
                            <div class="col-lg-6 text-center">
                                <img src="{{ asset('uploads/'.$slider->photo) }}" alt="Fresh Vegetables" class="rounded shadow hero-carousel-img">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features py-5 bg-light">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-3">
                <div class="text-center">
                    <div class="feature-icon bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3 avatar-circle-lg">
                        <i class="bi bi-truck text-success fs-2"></i>
                    </div>
                    <h5>Free Shipping</h5>
                    <p class="text-muted">Free delivery on orders over $50</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center">
                    <div class="feature-icon bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3 avatar-circle-lg">
                        <i class="bi bi-clock-history text-success fs-2"></i>
                    </div>
                    <h5>24/7 Support</h5>
                    <p class="text-muted">Customer support available anytime</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center">
                    <div class="feature-icon bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3 avatar-circle-lg">
                        <i class="bi bi-shield-check text-success fs-2"></i>
                    </div>
                    <h5>Secure Payment</h5>
                    <p class="text-muted">100% secure payment methods</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center">
                    <div class="feature-icon bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="bi bi-arrow-repeat text-success fs-2"></i>
                    </div>
                    <h5>Easy Returns</h5>
                    <p class="text-muted">30-day return guarantee</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="categories py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Shop by Categories</h2>
            <p class="text-muted">Browse our top categories</p>
        </div>
        <div class="row g-4">
            @foreach($product_categories_home as $item)
            <div class="col-lg-3 col-md-4 col-6">
                <a href="{{ url('products/?category='.$item->id.'&min_price=&max_price=&rating=on&sort=') }}" style="text-decoration: none;">
                <div class="category-card text-center px-3 bg-success rounded-3 h-100 d-flex flex-column align-items-center justify-content-between">
                    <h6 class="text-white fw-bold mb-0">{{ $item->name }}</h6>
                    <div class="icon">
                        <i class="bi bi-arrow-right text-white"></i>
                    </div>
                </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Featured Products Section -->
<section class="featured-products py-5 bg-light" id="deals">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Featured Products</h2>
            <p class="text-muted">Check out our best selling products</p>
        </div>
        <div class="row g-4">

            @foreach($products_home as $product)
            <div class="col-lg-3 col-md-6 col-sm-6">
                <form action="{{ route('cart_add') }}" method="post">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <div class="card product-card h-100 border-0 shadow-sm">
                        <div class="position-relative">
                            <a href="{{ route('product', $product->slug) }}">
                                <div class="product-image bg-light d-flex align-items-center justify-content-center overflow-hidden">
                                    <img src="{{ asset('uploads/'.$product->photo) }}" alt="{{ $product->name }}" class="img-fluid w-100 h-100">
                                    <div class="btn btn-sm btn-danger wishlist" style="position:absolute;bottom:8px;left:8px;">
                                        <a href="{{ route('user_wishlist_add',$product->id) }}" style="color:white;">
                                            <i class="bi bi-heart"></i>
                                        </a>
                                    </div>
                                </div>
                            </a>
                            <button type="submit" class="btn btn-sm btn-success position-absolute bottom-0 end-0 m-2">
                                <i class="bi bi-cart-plus"></i>
                            </button>
                        </div>
                        <div class="card-body">
                            <p class="small text-muted mb-1">{{ $product->product_category->name }}</p>
                            <h6 class="card-title"><a href="{{ route('product', $product->slug) }}" class="text-decoration-none text-dark">{{ $product->name }}</a></h6>
                            <div class="d-flex align-items-center mb-2">
                                <span class="text-warning">
                                    @if($product->average_rating == 5)
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                    @elseif($product->average_rating >= 4.5)
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-half"></i>
                                    @elseif($product->average_rating >= 4)
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star"></i>
                                    @elseif($product->average_rating >= 3.5)
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-half"></i>
                                        <i class="bi bi-star"></i>
                                    @elseif($product->average_rating >= 3)
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                    @elseif($product->average_rating >= 2.5)
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-half"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                    @elseif($product->average_rating >= 2)
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                    @elseif($product->average_rating >= 1.5)
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-half"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                    @elseif($product->average_rating >= 1)
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                    @elseif($product->average_rating >= 0)
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                    @endif
                                </span>
                                <small class="text-muted ms-2">({{ $product->average_rating }})</small>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    @foreach($product->product_variations as $item)
                                        <input type="hidden" name="product_variation_id" value="{{ $item->id }}">
                                        <span class="text-success fw-bold fs-5">${{ $item->sale_price }}</span>
                                        @if($item->regular_price != null)
                                            <span class="text-muted text-decoration-line-through small ms-1">${{ $item->regular_price }}</span>
                                        @endif
                                        @break
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            @endforeach

        </div>
    </div>
</section>
@endsection