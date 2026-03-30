@extends('front.layouts.master')

@section('page_main_content')
<!-- Breadcrumb -->
<section class="breadcrumb-section py-3 bg-light">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-success">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Customer Wishlist Section -->
<section class="customer-dashboard customer-wishlist py-5">
    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        @include('user.sidebar')
                    </div>
                </div>
            </div>

            <!-- Wishlist Content -->
            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold mb-0">My Wishlist</h3>
                    <span class="text-muted">{{ $wishlist_items->count() }} items</span>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col" class="px-4 py-3">Photo</th>
                                        <th scope="col" class="py-3">Product</th>
                                        <th scope="col" class="py-3">Category</th>
                                        <th scope="col" class="py-3">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($wishlist_items as $item)
                                    <tr>
                                        <td class="px-4 py-3">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('uploads/'.$item->product->photo) }}" alt="{{ $item->product->name }}" class="rounded me-3 wishlist-product-thumb">
                                            </div>
                                        </td>
                                        <td class="py-3 align-middle">
                                           {{ $item->product->name }}
                                        </td>
                                        <td class="py-3 align-middle">
                                            {{ $item->product->product_category->name }}
                                        </td>
                                        <td class="py-3 align-middle">
                                            <a href="{{ route('product', $item->product->slug) }}" class="btn btn-outline-primary btn-sm">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('user_wishlist_remove', $item->id) }}" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure?')">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection