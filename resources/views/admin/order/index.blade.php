@extends('admin.layouts.master')

@section('main_content')
@include('admin.layouts.nav')
@include('admin.layouts.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between align-items-center">
            <h1>Orders</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm" id="example1">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>User</th>
                                            <th>Order No</th>
                                            <th>Date</th>
                                            <th>Payment Method</th>
                                            <th>Total Price</th>
                                            <th>Payment Status</th>
                                            <th>Delivery Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $order)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{ $order->user->name }}
                                                <br>
                                                <a href="{{ route('admin_user_edit', $order->user_id) }}">Detail</a>
                                            </td>
                                            <td>{{ $order->order_no }}</td>
                                            <td>{{ $order->created_at->format('M d, Y') }}</td>
                                            <td>{{ $order->payment_method }}</td>
                                            <td>${{ $order->total_price }}</td>
                                            <td class="py-3">
                                                @if($order->payment_status == 'Pending')
                                                <span class="badge bg-warning">{{ $order->payment_status }}</span>
                                                <br><a href="{{ route('admin_order_change_payment_status', $order->id) }}" style="color:red;font-size:12px;">Change Status</a>
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
                                                <br><a href="" style="color:red;font-size:12px;"  data-bs-toggle="modal" data-bs-target="#modal_{{ $loop->iteration }}">Change Status</a>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin_order_invoice', $order->order_no) }}" class="btn btn-primary btn-sm"><i class="fas fa-file-invoice"></i></a>
                                                <a href="{{ route('admin_order_delete', $order->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="modal_{{ $loop->iteration }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Change Delivery Status</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group row bdb1 pt_10 mb_0">
                                                            <form action="{{ route('admin_order_change_delivery_status', $order->id) }}" method="post">
                                                                @csrf
                                                                <div class="mb-3">
                                                                    <label class="form-label">Select Status</label>
                                                                    <select name="delivery_status" class="form-select">
                                                                        <option value="Pending">Pending</option>
                                                                        <option value="Processing">Processing</option>
                                                                        <option value="Shipped">Shipped</option>
                                                                        <option value="Delivered">Delivered</option>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
</div>
@endsection