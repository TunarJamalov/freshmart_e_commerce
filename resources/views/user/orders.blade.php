@extends('front.layouts.master')

@section('page_main_content')
<!-- Breadcrumb -->
<section class="breadcrumb-section py-3 bg-light">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-success">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">My Orders</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Customer Orders Section -->
<section class="customer-dashboard customer-orders py-5">
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

            <!-- Orders Content -->
            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold mb-0">My Orders</h3>
                </div>
                
                <!-- Orders List -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
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
                </div>

                {{ $orders->links() }}
            </div>
        </div>
    </div>
</section>
@endsection