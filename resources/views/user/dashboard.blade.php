@extends('front.layouts.master')

@section('page_main_content')
<!-- Breadcrumb -->
<section class="breadcrumb-section py-3 bg-light">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-success">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Customer Dashboard Section -->
<section class="customer-dashboard py-5">
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

            <!-- Dashboard Content -->
            <div class="col-lg-9">
                <h3 class="fw-bold mb-4">Dashboard</h3>
                
                <!-- Stats Cards -->
                <div class="row g-4 mb-4">
                    <div class="col-md-3">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body text-center">
                                <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3 avatar-circle-md">
                                    <i class="bi bi-bag-check text-primary fs-4"></i>
                                </div>
                                <h4 class="fw-bold mb-1">{{ $total_orders }}</h4>
                                <small class="text-muted">Total Orders</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body text-center">
                                <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3 avatar-circle-md">
                                    <i class="bi bi-clock-history text-success fs-4"></i>
                                </div>
                                <h4 class="fw-bold mb-1">{{ $total_pending_orders }}</h4>
                                <small class="text-muted">Pending</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body text-center">
                                <div class="bg-info bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3 avatar-circle-md">
                                    <i class="bi bi-truck text-info fs-4"></i>
                                </div>
                                <h4 class="fw-bold mb-1">{{ $total_shipped_orders }}</h4>
                                <small class="text-muted">Shipped</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body text-center">
                                <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3 avatar-circle-md">
                                    <i class="bi bi-heart text-warning fs-4"></i>
                                </div>
                                <h4 class="fw-bold mb-1">{{ $total_wishlist_items }}</h4>
                                <small class="text-muted">Wishlist</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Orders -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-bold">Recent Orders</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="px-4 py-3">Order No</th>
                                        <th class="py-3">Date</th>
                                        <th class="py-3">Payment Method</th>
                                        <th class="py-3">Total Price</th>
                                        <th class="py-3">Payment Status</th>
                                        <th class="py-3">Delivery Status</th>
                                        <th class="py-3">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                    <tr>
                                        <td class="px-4 py-3 fw-bold">{{ $order->order_no }}</td>
                                        <td class="py-3">{{ $order->created_at->format('M d, Y') }}</td>
                                        <td class="py-3">{{ $order->payment_method }}</td>
                                        <td class="py-3 fw-bold text-success">${{ $order->total_price }}</td>
                                        <td class="py-3">
                                            @if($order->payment_status == 'Pending')
                                            <span class="badge bg-warning">{{ $order->payment_status }}</span>
                                            @elseif($order->payment_status == 'Paid')
                                            <span class="badge bg-success">{{ $order->payment_status }}</span>
                                            @endif
                                        </td>
                                        <td class="py-3">
                                            @if($order->delivery_status == 'Pending')
                                            <span class="badge bg-warning">{{ $order->delivery_status }}</span>
                                            @elseif($order->delivery_status == 'Processing')
                                            <span class="badge bg-info">{{ $order->delivery_status }}</span>
                                            @elseif($order->delivery_status == 'Shipped')
                                            <span class="badge bg-primary">{{ $order->delivery_status }}</span>
                                            @elseif($order->delivery_status == 'Delivered')
                                            <span class="badge bg-success">{{ $order->delivery_status }}</span>
                                            @endif
                                        </td>
                                        <td class="py-3">
                                            <a href="{{ route('user_invoice', $order->order_no) }}" class="btn btn-sm btn-success me-1">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-white text-center py-3">
                        <a href="{{ route('user_orders') }}" class="text-success text-decoration-none fw-bold">
                            View All Orders <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection