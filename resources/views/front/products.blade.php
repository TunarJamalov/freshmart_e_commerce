@extends('front.layouts.master')

@section('page_main_content')
<!-- Breadcrumb -->
<section class="breadcrumb-section py-3 bg-light">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-success">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Products</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Products Section with Sidebar -->
<section class="products-section py-5">
    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3 col-md-4">

                <form action="{{ url('products') }}" method="get" id="filterForm">
                <div class="sidebar">
                    <!-- Categories Filter -->
                    <div class="filter-widget mb-4">
                        <h5 class="fw-bold mb-3">Categories</h5>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="category" id="catAll" value="" {{ request('category') == null ? 'checked' : '' }}>
                            <label class="form-check-label" for="catAll">
                                All Products
                            </label>
                        </div>
                        @foreach($product_categories as $item)
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="category" id="cat{{ $item->id }}" value="{{ $item->id }}" {{ request('category') == $item->id ? 'checked' : '' }}>
                            <label class="form-check-label" for="cat{{ $item->id }}">
                                {{ $item->name }}
                            </label>
                        </div>
                        @endforeach
                    </div>

                    <!-- Price Filter -->
                    <div class="filter-widget mb-4">
                        <h5 class="fw-bold mb-3">Price Range</h5>
                        <div class="price d-flex justify-content-start mb-3">
                            <div class="min mr_10">
                                <input type="number" name="min_price" class="form-control" value="{{ request('min_price') }}" min="0" placeholder="Min Price">
                            </div>
                            <div class="max">
                                <input type="number" name="max_price" class="form-control" value="{{ request('max_price') }}" min="1" placeholder="Max Price">
                            </div>
                        </div>
                    </div>

                    <!-- Rating Filter -->
                    <div class="filter-widget mb-4">
                        <h5 class="fw-bold mb-3">Rating</h5>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="rating" value="" id="ratingAll" checked>
                            <label class="form-check-label" for="ratingAll">
                                All Ratings
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="rating" value="5" id="rating5" {{ request('rating') == 5 ? 'checked' : '' }}>
                            <label class="form-check-label" for="rating5">
                                <span class="text-warning">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </span>
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="rating" value="4" id="rating4" {{ request('rating') == 4 ? 'checked' : '' }}>
                            <label class="form-check-label" for="rating4">
                                <span class="text-warning">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star"></i>
                                </span> & Up
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="rating" value="3" id="rating3" {{ request('rating') == 3 ? 'checked' : '' }}>
                            <label class="form-check-label" for="rating3">
                                <span class="text-warning">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star"></i>
                                    <i class="bi bi-star"></i>
                                </span> & Up
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="rating" value="2" id="rating2" {{ request('rating') == 2 ? 'checked' : '' }}>
                            <label class="form-check-label" for="rating2">
                                <span class="text-warning">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star"></i>
                                    <i class="bi bi-star"></i>
                                    <i class="bi bi-star"></i>
                                </span> & Up
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="rating" value="1" id="rating1" {{ request('rating') == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="rating1">
                                <span class="text-warning">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star"></i>
                                    <i class="bi bi-star"></i>
                                    <i class="bi bi-star"></i>
                                    <i class="bi bi-star"></i>
                                </span> & Up
                            </label>
                        </div>
                    </div>
                    
                    <input type="hidden" name="sort" id="sortField" value="{{ request('sort') }}">

                    <!-- Reset Filters Button -->
                    <button type="submit" class="btn btn-outline-success w-100">
                        <i class="bi bi-arrow-clockwise me-2"></i>Apply Filters
                    </button>
                </div>

                </form>

            </div>

            <!-- Products Grid -->
            <div class="col-lg-9 col-md-8">
                <!-- Toolbar -->
                <div class="products-toolbar d-flex justify-content-between align-items-center mb-4 p-3 bg-light rounded">
                    <div>
                        @if($products->total() == 0)
                        <p class="mb-0 text-muted">Showing <strong>{{ $products->total() }}</strong> result</p>
                        @else
                        <p class="mb-0 text-muted">Showing <strong>{{ $products->firstItem() }}-{{ $products->lastItem() }}</strong> of <strong>{{ $products->total() }}</strong> results</p>
                        @endif
                    </div>
                    <div class="d-flex align-items-center">
                        <label class="me-2 mb-0" style="width:100px;">Sort by:</label>
                        <select name="sort" class="form-select form-select-sm" id="sortDropdown">
                            <option value="">Default</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                            <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name: A to Z</option>
                            <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name: Z to A</option>
                            <option value="rating_asc" {{ request('sort') == 'rating_asc' ? 'selected' : '' }}>Rating: Low to High</option>
                            <option value="rating_desc" {{ request('sort') == 'rating_desc' ? 'selected' : '' }}>Rating: High to Low</option>
                        </select>
                    </div>
                </div>

                <!-- Products Grid -->
                @if($products->total() > 0)
                <div class="row g-4">

                    @foreach($products as $product)
                    <div class="col-lg-4 col-md-6 col-sm-6">
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

                    <div class="col-lg-12 d-flex justify-content-center">
                        <!-- APPEND WITH CURRENT URL -->
                        {{ $products->appends(request()->query())->links() }}
                    </div>
                    
                </div>
                @else
                <p class="text-danger">No product found.</p>
                @endif




            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    $('#sortDropdown').on('change', function() {
        var sortValue = $(this).val();
        $('#sortField').val(sortValue);
        $('#filterForm').submit();
    });
</script>
@endsection