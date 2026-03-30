@extends('admin.layouts.master')

@section('main_content')
@include('admin.layouts.nav')
@include('admin.layouts.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between align-items-center">
            <h1>Edit Delivery Option</h1>
            <div class="ml-auto">
                <a href="{{ route('admin_delivery_option_index') }}" class="btn btn-primary"><i class="fas fa-eye"></i> All Delivery Options</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_delivery_option_update', $delivery_option->id) }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4 mb-3">
                                        <label for="">Name *</label>
                                        <input type="text" name="name" class="form-control" value="{{ $delivery_option->name }}">
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <label for="">Cost *</label>
                                        <input type="number" name="cost" class="form-control" min="0" value="{{ $delivery_option->cost }}">
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <label for="">Is Default *</label>
                                        <select name="is_default" class="form-select">
                                            <option value="1" {{ $delivery_option->is_default == 1 ? 'selected' : '' }}>Yes</option>
                                            <option value="0" {{ $delivery_option->is_default == 0 ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <label for="">Description *</label>
                                        <textarea name="description" class="form-control h_100" rows="3">{{ $delivery_option->description }}</textarea>
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