@extends('front.layouts.master')

@section('page_main_content')
<!-- Breadcrumb -->
<section class="breadcrumb-section py-3 bg-light">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-success">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products') }}" class="text-success">Products</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Product Details Section -->
<section class="product-details py-5">
    <div class="container">
        <div class="row g-5">
            <!-- Product Images -->
            <div class="col-lg-5">
                <div class="product-images">
                    <!-- Main Image -->
                    <div class="main-image mb-3">
                        <img src="{{ asset('uploads/'.$product->photo) }}" alt="{{ $product->name }}" class="rounded shadow-sm w-100 product-single-img">
                    </div>
                </div>
            </div>

            <!-- Product Info -->
            <div class="col-lg-7">
                <div class="product-info">

                    <form action="{{ route('cart_add') }}" method="post">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <!-- Badge -->
                    @php
                        $firstVariation = $product->product_variations->first();
                        $discountPercent = 0;
                        if ($firstVariation && $firstVariation->regular_price && $firstVariation->regular_price > 0) {
                            $discountPercent = round((($firstVariation->regular_price - $firstVariation->sale_price) / $firstVariation->regular_price) * 100);
                        }
                    @endphp
                    <span class="badge bg-danger mb-2" id="discountBadge" style="display: {{ $discountPercent > 0 ? 'inline-block' : 'none' }};">{{ $discountPercent > 0 ? $discountPercent . '% OFF' : '0% OFF' }}</span>
                    
                    <!-- Product Title -->
                    <h2 class="fw-bold mb-3">{{ $product->name }}</h2>
                    
                    <!-- Rating -->
                    <div class="d-flex align-items-center mb-3">
                        <span class="text-warning fs-5">
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
                        <span class="ms-2 text-muted">({{ $product->average_rating }}) {{ $ratings->count() }} Reviews</span>
                    </div>

                    <!-- Price -->
                    <div class="price-section mb-4">
                        @foreach($product->product_variations as $variation)
                        <h3 class="text-success fw-bold d-inline" id="currentPrice">${{ $variation->sale_price }}</h3>
                        @if($variation->regular_price && $variation->regular_price > 0)
                        <span class="text-muted text-decoration-line-through fs-5 ms-2" id="originalPrice">${{ $variation->regular_price }}</span>
                        @else
                        <span class="text-muted text-decoration-line-through fs-5 ms-2" id="originalPrice" style="display: none;"></span>
                        @endif
                        @break
                        @endforeach
                    </div>

                    <!-- Short Description -->
                    <p class="text-muted mb-4">
                        {!! nl2br($product->short_description) !!}
                    </p>

                    <!-- Availability -->
                    <div class="mb-3">
                        <span class="fw-bold">Availability:</span> 
                        <span class="text-success" id="inStockLabel" style="display: none;">
                            <i class="bi bi-check-circle-fill"></i> In Stock
                        </span>
                        <span class="text-danger" id="outOfStockLabel" style="display: none;">
                            <i class="bi bi-x-circle-fill"></i> Out Of Stock
                        </span>
                    </div>

                    <!-- Category -->
                    <div class="mb-3">
                        <span class="fw-bold">Category:</span> 
                        <a href="{{ route('products') }}" class="text-success text-decoration-none">Fruits & Vegetables</a>
                    </div>

                    
                    <!-- Weight/Size Options -->
                    <div class="mb-4">
                        <label class="fw-bold mb-2">Weight:</label>
                        <div class="btn-group" role="group">
                            @foreach($product->product_variations as $variation)
                            <input type="radio" class="btn-check weight-option" name="product_variation_id" id="weight{{ $loop->iteration }}" value="{{ $variation->id }}" data-price="{{ $variation->sale_price }}" data-original="{{ $variation->regular_price ?? 0 }}" data-stock="{{ $variation->stock ?? 0 }}" {{ $loop->first ? 'checked' : '' }}>
                            <label class="btn btn-outline-success" for="weight{{ $loop->iteration }}">{{ $variation->label }}</label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Quantity -->
                    <div class="mb-4">
                        <label class="fw-bold mb-2">Quantity:</label>
                        <div class="input-group product-quantity-input">
                            <button class="btn btn-outline-success" type="button" id="decrementBtn">
                                <i class="bi bi-dash"></i>
                            </button>
                            <input name="quantity" type="number" class="form-control text-center" id="quantityInput" value="1" min="1">
                            <button class="btn btn-outline-success" type="button" id="incrementBtn">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex gap-3 mb-4">
                        <button type="submit" class="btn btn-success btn-lg flex-grow-1">
                            <i class="bi bi-cart-plus me-2"></i>Add to Cart
                        </button>
                        <a href="{{ route('user_wishlist_add',$product->id) }}" class="btn btn-outline-success btn-lg">
                            <i class="bi bi-heart"></i>
                        </a>
                    </div>
                    </form>

                </div>
            </div>
        </div>

        <!-- Product Tabs -->
        <div class="row mt-5">
            <div class="col-12">
                <ul class="nav nav-tabs" id="productTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button">
                            Description
                        </button>
                    </li>

                    @if($product->additional_informations->count() > 0)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button">
                            Additional Information
                        </button>
                    </li>
                    @endif


                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button">
                            Reviews ({{ $ratings->count() }})
                        </button>
                    </li>
                </ul>
                <div class="tab-content border border-top-0 p-4" id="productTabContent">
                    <!-- Description Tab -->
                    <div class="tab-pane fade show active" id="description">
                        {!! $product->description !!}
                    </div>


                    @if($product->additional_informations->count() > 0)
                    <!-- Additional Info Tab -->
                    <div class="tab-pane fade" id="info">
                        <table class="table table-bordered">
                            <tbody>
                                @foreach($product->additional_informations as $info)
                                <tr>
                                    <th width="30%">{{ $info->label }}</th>
                                    <td>{{ $info->value }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif


                    <!-- Reviews Tab -->
                    <div class="tab-pane fade" id="reviews">
                        <h5 class="mb-4">Customer Reviews ({{ $ratings->count() }})</h5>
                        
                        @forelse($ratings as $rating)
                        <div class="review-item border-bottom pb-4 mb-4">
                            <div class="d-flex align-items-center mb-2">
                                <div>
                                    <img src="{{ asset('uploads/'.$rating->user->photo) }}" alt="" class="rounded-circle me-3" style="width: 50px; height: 50px;">
                                </div>
                                <div>
                                    <h6 class="mb-0">{{ $rating->user->name }}</h6>
                                    <div class="text-warning">
                                        @if($rating->rating == 5)
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                        @elseif($rating->rating == 4)
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star"></i>
                                        @elseif($rating->rating == 3)
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star"></i>
                                            <i class="bi bi-star"></i>
                                        @elseif($rating->rating == 2)
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star"></i>
                                            <i class="bi bi-star"></i>
                                            <i class="bi bi-star"></i>
                                        @elseif($rating->rating == 1)
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star"></i>
                                            <i class="bi bi-star"></i>
                                            <i class="bi bi-star"></i>
                                            <i class="bi bi-star"></i>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <p class="text-muted mb-2"><small>Reviewed on: {{ $rating->created_at->format('F j, Y') }}</small></p>
                            <p>{!! $rating->review !!}</p>
                        </div>
                        @empty
                        <p class="text-danger">No reviews yet.</p>
                        @endforelse


                        <!-- Add Review Form -->
                        <div class="mt-5">
                            <h5 class="mb-3">Write a Review</h5>
                            @if(Auth::guard('web')->check())
                                @php
                                $allow_checking = App\Models\OrderDetail::where('product_id',$product->id)
                                    ->where('user_id',Auth::guard('web')->user()->id)
                                    ->first();
                                @endphp
                                @if($allow_checking)
                                    @php
                                    $existing_review = App\Models\Rating::where('product_id',$product->id)
                                        ->where('user_id',Auth::guard('web')->user()->id)
                                        ->first();
                                    @endphp
                                    @if(!$existing_review)
                                    <form action="{{ route('rating_submit',$product->id) }}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-4 mb-3">
                                                <label class="form-label">Your Rating *</label>
                                                <select name="rating" class="form-select">
                                                    <option value="5">5 Stars</option>
                                                    <option value="4">4 Stars</option>
                                                    <option value="3">3 Stars</option>
                                                    <option value="2">2 Stars</option>
                                                    <option value="1">1 Star</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-12 mb-3">
                                                <label class="form-label">Your Review *</label>
                                                <textarea name="review" class="form-control" rows="4" required></textarea>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-success">Submit Review</button>
                                    </form>
                                    @else
                                    <p class="text-success">You have already submitted a review for this product. Thank you!</p>
                                    @endif
                                @else
                                    <p class="text-danger">You need to purchase this product to write a review.</p>
                                @endif
                            @else
                                <p class="text-danger">Please <a href="{{ route('user_login') }}" class="text-success">login</a> to write a review.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Related Products -->
        <div class="row mt-5">
            <div class="col-12">
                <h3 class="fw-bold mb-4">Related Products</h3>
                <div class="row g-4">

                    @forelse($related_products as $related_product)
                    <div class="col-lg-3 col-md-6">
                        <div class="card product-card h-100 border-0 shadow-sm">
                            <div class="position-relative">
                                <a href="{{ route('product', $related_product->slug) }}">
                                    <div class="product-image bg-light d-flex align-items-center justify-content-center overflow-hidden">
                                        <img src="{{ asset('uploads/'.$related_product->photo) }}" alt="{{ $related_product->name }}" class="img-fluid w-100 h-100">
                                    </div>
                                </a>
                                <button class="btn btn-sm btn-success position-absolute bottom-0 end-0 m-2">
                                    <i class="bi bi-cart-plus"></i>
                                </button>
                            </div>
                            <div class="card-body">
                                <p class="small text-muted mb-1">{{ $related_product->product_category->name }}</p>
                                <h6 class="card-title"><a href="{{ route('product', $related_product->slug) }}" class="text-decoration-none text-dark">{{ $related_product->name }}</a></h6>
                                <div class="d-flex align-items-center mb-2">
                                    <span class="text-warning small">
                                        @if($related_product->average_rating == 5)
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                        @elseif($related_product->average_rating >= 4.5)
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-half"></i>
                                        @elseif($related_product->average_rating >= 4)
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
                                        @elseif($related_product->average_rating >= 3)
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star"></i>
                                            <i class="bi bi-star"></i>
                                        @elseif($related_product->average_rating >= 2.5)
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-half"></i>
                                            <i class="bi bi-star"></i>
                                            <i class="bi bi-star"></i>
                                        @elseif($related_product->average_rating >= 2)
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star"></i>
                                            <i class="bi bi-star"></i>
                                            <i class="bi bi-star"></i>
                                        @elseif($related_product->average_rating >= 1.5)
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-half"></i>
                                            <i class="bi bi-star"></i>
                                            <i class="bi bi-star"></i>
                                            <i class="bi bi-star"></i>
                                        @elseif($related_product->average_rating >= 1)
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star"></i>
                                            <i class="bi bi-star"></i>
                                            <i class="bi bi-star"></i>
                                            <i class="bi bi-star"></i>
                                        @elseif($related_product->average_rating >= 0)
                                            <i class="bi bi-star"></i>
                                            <i class="bi bi-star"></i>
                                            <i class="bi bi-star"></i>
                                            <i class="bi bi-star"></i>
                                            <i class="bi bi-star"></i>
                                        @endif
                                    </span>
                                    <small class="text-muted ms-2">({{ $related_product->average_rating }})</small>
                                </div>
                                @foreach($product->product_variations as $item)
                                <span class="text-success fw-bold fs-5">${{ $item->sale_price }}</span>
                                <span class="text-muted text-decoration-line-through small ms-1">${{ $item->regular_price }}</span>
                                @break
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-danger">No related products found.</p>
                    @endforelse

                    
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    console.log('Script loaded');
    
    <?php 
    foreach($product->product_variations as $variation) {
        $baseSalePrice = $variation->sale_price;
        $baseRegularPrice = $variation->regular_price ?? 0;
        $baseStock = $variation->stock ?? 0;
        break;
    }
    ?>
    // Store base unit prices
    var baseSalePrice = <?php echo $baseSalePrice; ?>;
    var baseRegularPrice = <?php echo $baseRegularPrice ?: 0; ?>;
    var currentStock = <?php echo $baseStock; ?>;
    
    // Function to update stock status
    function updateStockStatus(stock) {
        if (stock > 0) {
            $('#inStockLabel').show();
            $('#outOfStockLabel').hide();
        } else {
            $('#inStockLabel').hide();
            $('#outOfStockLabel').show();
        }
    }
    
    // Function to update discount badge
    function updateDiscountBadge(salePrice, regularPrice) {
        if (regularPrice && regularPrice > 0 && regularPrice > salePrice) {
            var discountPercent = Math.round(((regularPrice - salePrice) / regularPrice) * 100);
            $('#discountBadge').text(discountPercent + '% OFF').show();
        } else {
            $('#discountBadge').hide();
        }
    }
    
    // Initialize stock status on page load
    updateStockStatus(currentStock);
    updateDiscountBadge(baseSalePrice, baseRegularPrice);
    
    // Initialize original price visibility
    if (!baseRegularPrice || baseRegularPrice <= 0) {
        $('#originalPrice').hide();
    }
    
    // Function to update total price
    function updateTotalPrice() {
        var quantity = parseInt($('#quantityInput').val());
        var totalPrice = baseSalePrice * quantity;
        var originalTotal = baseRegularPrice * quantity;
        
        $('#currentPrice').text('$' + totalPrice.toFixed(2));
        $('#originalPrice').text('$' + originalTotal.toFixed(2));
    }
    
    // Weight option change handler
    $('input[name="product_variation_id"]').on('change', function() {
        console.log('Weight changed!');
        baseSalePrice = parseFloat($(this).data('price'));
        baseRegularPrice = parseFloat($(this).data('original'));
        currentStock = parseInt($(this).data('stock'));
        
        console.log('New Price:', baseSalePrice);
        console.log('Original Price:', baseRegularPrice);
        console.log('Stock:', currentStock);
        
        // Update stock status
        updateStockStatus(currentStock);
        
        // Update discount badge
        updateDiscountBadge(baseSalePrice, baseRegularPrice);
        
        // Reset quantity to 1 when weight changes
        $('#quantityInput').val(1);
        
        // Update prices
        $('#currentPrice').text('$' + baseSalePrice.toFixed(2));
        
        // Show/hide original price based on value
        if (baseRegularPrice && baseRegularPrice > 0) {
            $('#originalPrice').text('$' + baseRegularPrice.toFixed(2)).show();
        } else {
            $('#originalPrice').hide();
        }
    });
    
    // Quantity increment/decrement handlers
    $('#incrementBtn').on('click', function() {
        var input = $('#quantityInput');
        var currentVal = parseInt(input.val());
        input.val(currentVal + 1);
        updateTotalPrice();
    });
    
    $('#decrementBtn').on('click', function() {
        var input = $('#quantityInput');
        var currentVal = parseInt(input.val());
        if (currentVal > 1) {
            input.val(currentVal - 1);
            updateTotalPrice();
        }
    });
    
    // Handle manual input change
    $('#quantityInput').on('change', function() {
        var currentVal = parseInt($(this).val());
        if (currentVal < 1 || isNaN(currentVal)) {
            $(this).val(1);
        }
        updateTotalPrice();
    });
});
</script>
@endsection