@extends('admin.layouts.master')

@section('main_content')
@include('admin.layouts.nav')
@include('admin.layouts.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between align-items-center">
            <h1>Create User</h1>
            <div class="ml-auto">
                <a href="{{ route('admin_user_index') }}" class="btn btn-primary"><i class="fas fa-eye"></i> All Items</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_user_store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12 mb-3">
                                        <label for="">Photo</label>
                                        <div>
                                            <input type="file" name="photo">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="">Name *</label>
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="">Email *</label>
                                        <input type="text" name="email" class="form-control">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="">Phone</label>
                                        <input type="text" name="phone" class="form-control">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="">Address</label>
                                        <input type="text" name="address" class="form-control">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="">Country</label>
                                        <input type="text" name="country" class="form-control">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="">State</label>
                                        <input type="text" name="state" class="form-control">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="">City</label>
                                        <input type="text" name="city" class="form-control">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="">Zip</label>
                                        <input type="text" name="zip" class="form-control">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="">Status *</label>
                                        <select name="status" class="form-select">
                                            <option value="0">Pending</option>
                                            <option value="1">Active</option>
                                            <option value="2">Suspended</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary">Submit</button>
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