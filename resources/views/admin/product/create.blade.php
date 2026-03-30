@extends('admin.layouts.master')

@section('main_content')
@include('admin.layouts.nav')
@include('admin.layouts.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between align-items-center">
            <h1>Create Product</h1>
            <div class="ml-auto">
                <a href="{{ route('admin_product_index') }}" class="btn btn-primary"><i class="fas fa-eye"></i> All Items</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_product_store') }}" method="post" enctype="multipart/form-data">
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
                                        <label for="">Slug *</label>
                                        <input type="text" name="slug" class="form-control">
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <label for="">Short Description *</label>
                                        <textarea name="short_description" class="form-control h_100"></textarea>
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <label for="">Description *</label>
                                        <textarea name="description" class="form-control editor" rows="6"></textarea>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="">Product Category *</label>
                                        <select name="product_category_id" class="form-select">
                                            @foreach($product_categories as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="">Show on Home? *</label>
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