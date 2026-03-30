@extends('admin.layouts.master')

@section('main_content')
@include('admin.layouts.nav')
@include('admin.layouts.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between align-items-center">
            <h1>Create Product Category</h1>
            <div class="ml-auto">
                <a href="{{ route('admin_product_category_index') }}" class="btn btn-primary"><i class="fas fa-eye"></i> All Items</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_product_category_store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label for="">Name *</label>
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="">Show on home? *</label>
                                        <select name="show_on_home" class="form-select">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
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