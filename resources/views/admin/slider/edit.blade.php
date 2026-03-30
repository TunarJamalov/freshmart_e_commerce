@extends('admin.layouts.master')

@section('main_content')
@include('admin.layouts.nav')
@include('admin.layouts.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between align-items-center">
            <h1>Edit Slider</h1>
            <div class="ml-auto">
                <a href="{{ route('admin_slider_index') }}" class="btn btn-primary"><i class="fas fa-eye"></i> All Items</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_slider_update', $slider->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12 mb-3">
                                        <label for="">Existing Photo</label>
                                        <div>
                                            <img src="{{ asset('uploads/'.$slider->photo) }}" alt="Slider Photo" style="width:150px;height:auto;">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <label for="">Change Photo</label>
                                        <div>
                                            <input type="file" name="photo">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <label for="">Title *</label>
                                        <input type="text" name="title" class="form-control" value="{{ $slider->title }}">
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <label for="">Description *</label>
                                        <textarea name="description" class="form-control h_100" rows="4">{{ $slider->description }}</textarea>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="">Button Text</label>
                                        <input type="text" name="button_text" class="form-control" value="{{ $slider->button_text }}">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="">Button URL</label>
                                        <input type="text" name="button_url" class="form-control" value="{{ $slider->button_url }}">
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