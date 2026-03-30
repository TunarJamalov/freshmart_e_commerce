@extends('admin.layouts.master')

@section('main_content')
@include('admin.layouts.nav')
@include('admin.layouts.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between align-items-center">
            <h1>Edit Post</h1>
            <div class="ml-auto">
                <a href="{{ route('admin_post_index') }}" class="btn btn-primary"><i class="fas fa-eye"></i> All Items</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_post_update', $post->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12 mb-3">
                                        <label for="">Existing Photo</label>
                                        <div>
                                            <img src="{{ asset('uploads/'.$post->photo) }}" alt="Post Photo" style="width:150px;height:auto;">
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
                                        <input type="text" name="title" class="form-control" value="{{ $post->title }}">
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <label for="">Slug *</label>
                                        <input type="text" name="slug" class="form-control" value="{{ $post->slug }}">
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <label for="">Short Description *</label>
                                        <textarea name="short_description" class="form-control h_100" rows="4">{{ $post->short_description }}</textarea>
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <label for="">Description *</label>
                                        <textarea name="description" class="form-control editor" rows="4">{{ $post->description }}</textarea>
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