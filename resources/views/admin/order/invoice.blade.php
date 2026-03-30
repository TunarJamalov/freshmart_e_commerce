@extends('admin.layouts.master')

@section('main_content')
@include('admin.layouts.nav')
@include('admin.layouts.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between align-items-center">
            <h1>Invoice: {{ $order->order_no }} </h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="invoice-container" id="print_invoice">
                                <div class="invoice-top">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-border-0">
                                                    <tbody>
                                                        <tr>
                                                            <td class="w-50">
                                                                @php
                                                                $setting = App\Models\Setting::where('id',1)->first();
                                                                @endphp
                                                                <img src="{{ asset('uploads/'.$setting->logo) }}" alt="" class="w-200">
                                                            </td>
                                                            <td class="w-50">
                                                                <div class="invoice-top-right">
                                                                    <h4>Invoice</h4>
                                                                    <h5>Order No: {{ $order->order_no }}</h5>
                                                                    <h5>Date: {{ $order->created_at->format('Y-m-d') }}</h5>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="invoice-middle">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-border-0">
                                                    <tbody>
                                                        <tr>
                                                            <td class="w-50">
                                                                <div class="invoice-middle-left">
                                                                    <h4>Invoice To:</h4>
                                                                    <p class="mb_0">{{ $order->billing_name }}</p>
                                                                    <p class="mb_0">{{ $order->billing_email }}</p>
                                                                    <p class="mb_0">{{ $order->billing_phone }}</p>
                                                                    <p class="mb_0">{{ $order->billing_address }}</p>
                                                                    <p class="mb_0">{{ $order->billing_city }}, {{ $order->billing_state }}, {{ $order->billing_country }}, {{ $order->billing_zip }}</p>
                                                                </div>
                                                            </td>
                                                            <td class="w-50">
                                                                <div class="invoice-middle-right">
                                                                    <h4>Invoice From:</h4>
                                                                    <p class="mb_0">{{ env('APP_NAME') }}</p>
                                                                    <p class="mb_0 color_6d6d6d">{{ Auth::guard('admin')->user()->email }}</p>
                                                                    <p class="mb_0">111-222-3333</p>
                                                                    <p class="mb_0">3145 Glen Falls Road</p>
                                                                    <p class="mb_0">Bensalem, PA 19020</p>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="invoice-item">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordered invoice-item-table">
                                                    <tbody>
                                                        <tr>
                                                            <th>SL</th>
                                                            <th>Product</th>
                                                            <th>Quantity</th>
                                                            <th style="text-align:right;">Price</th>
                                                            <th style="text-align:right;">Total</th>
                                                        </tr>
                                                        @foreach($order_details as $item)
                                                        @php
                                                            $product_info = App\Models\Product::where('id', $item->product_id)->first();
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>
                                                                {{ $product_info->name }}<br>
                                                                <span style="color:#969696;font-size:14px;">{{ $item->label }}</span>
                                                            </td>
                                                            <td>{{ $item->quantity }}</td>
                                                            <td style="text-align:right;">${{ $item->sale_price }}</td>
                                                            <td style="text-align:right;">${{ $item->total_price }}</td>
                                                        </tr>
                                                        @endforeach
                                                        <tr>
                                                            <td colspan="4" style="text-align:right;font-weight:bold;">Subtotal</td>
                                                            <td style="text-align:right;font-weight:bold;">
                                                                ${{ $order->subtotal_price }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" style="text-align:right;font-weight:bold;">Delivery Cost</td>
                                                            <td style="text-align:right;font-weight:bold;">
                                                                (+) ${{ $order->delivery_option_cost }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" style="text-align:right;font-weight:bold;">Discount</td>
                                                            <td style="text-align:right;font-weight:bold;">
                                                                (-) ${{ $order->coupon_discount_value }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" style="text-align:right;font-weight:bold;">Total</td>
                                                            <td style="text-align:right;font-weight:bold;">
                                                                ${{ $order->total_price }}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="invoice-bottom">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-border-0">
                                                    <tbody>
                                                        <td class="w-70 invoice-bottom-payment">
                                                            <h4>Payment Method</h4>
                                                            <p>{{ $order->payment_method }}</p>
                                                        </td>
                                                        <td class="w-30 tar invoice-bottom-total-box">
                                                            <h4>Total</h4>
                                                            <p>${{ $order->total_price }}</p>
                                                        </td>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="print-button mt_25">
                                <a onclick="printInvoice()" href="javascript:;" class="btn btn-primary"><i class="fas fa-print"></i> Print</a>
                            </div>
                            <script>
                                function printInvoice() {
                                    let body = document.body.innerHTML;
                                    let data = document.getElementById('print_invoice').innerHTML;
                                    document.body.innerHTML = data;
                                    window.print();
                                    document.body.innerHTML = body;
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection