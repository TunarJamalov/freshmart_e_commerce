<!-- Navigation -->
@php
$setting = App\Models\Setting::where('id',1)->first();
@endphp
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold text-success" href="{{ route('home') }}">
            <img src="{{ asset('uploads/'.$setting->logo) }}" alt="FreshMart" height="40">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        Categories
                    </a>
                    <ul class="dropdown-menu">
                        @php
                        $product_categories = \App\Models\ProductCategory::orderBy('name', 'asc')->get();
                        @endphp
                        @foreach($product_categories as $item)
                            <li><a class="dropdown-item" href="{{ url('products/?category='.$item->id.'&min_price=&max_price=&rating=on&sort=') }}">{{ $item->name }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('products') }}">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('faq') }}">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('blog') }}">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                </li>
            </ul>
            <div class="d-flex align-items-center">
                <div class="input-group me-3 navbar-search">
                    <input type="text" class="form-control" placeholder="Search products...">
                    <button class="btn btn-success" type="button">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
                <a href="{{ route('user_wishlist') }}" class="btn btn-outline-success position-relative me-2">
                    <i class="bi bi-heart"></i>
                </a>
                <a href="{{ route('cart') }}" class="btn btn-success position-relative">
                    <i class="bi bi-cart3"></i>
                    @if(session()->has('cart'))
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ count(session()->get('cart')) }}
                    </span>
                    @endif
                </a>
            </div>
        </div>
    </div>
</nav>