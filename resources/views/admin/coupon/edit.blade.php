@extends('admin.layouts.master')

@section('main_content')
@include('admin.layouts.nav')
@include('admin.layouts.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between align-items-center">
            <h1>Edit Coupon</h1>
            <div class="ml-auto">
                <a href="{{ route('admin_coupon_index') }}" class="btn btn-primary"><i class="fas fa-eye"></i> All Coupons</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_coupon_update', $coupon->id) }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label for="">Code *</label>
                                        <input type="text" name="code" class="form-control" value="{{ $coupon->code }}">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="">Discount (%) *</label>
                                        <input type="number" name="discount" class="form-control" min="0" max="100" value="{{ $coupon->discount }}">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="">Start Date *</label>
                                        <input id="datepicker" type="text" name="start_date" class="form-control" value="{{ $coupon->start_date }}">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="">End Date *</label>
                                        <input id="datepicker1" type="text" name="end_date" class="form-control" value="{{ $coupon->end_date }}">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="">Usage Limit *</label>
                                        <input type="number" name="usage_limit" class="form-control" min="1" value="{{ $coupon->usage_limit }}">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="">Status *</label>
                                        <select name="status" class="form-select">
                                            <option value="Active" {{ $coupon->status == 'Active' ? 'selected' : '' }}>Active</option>
                                            <option value="Inactive" {{ $coupon->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection