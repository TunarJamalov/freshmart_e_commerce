@extends('admin.layouts.master')

@section('main_content')
@include('admin.layouts.nav')
@include('admin.layouts.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between align-items-center">
            <h1>Edit User</h1>
            <div class="ml-auto">
                <a href="{{ route('admin_user_index') }}" class="btn btn-primary"><i class="fas fa-eye"></i> All Items</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_user_update', $user->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12 mb-3">
                                        <label for="">Existing Photo</label>
                                        <div>
                                            @if($user->photo != '')
                                                <img src="{{ asset('uploads/'.$user->photo) }}" alt="User Photo" style="width:100px;height:auto;">
                                            @else
                                                <img src="{{ asset('uploads/default.png') }}" alt="Default User Photo" style="width:100px;height:auto;">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <label for="">Change Photo</label>
                                        <div>
                                            <input type="file" name="photo">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="">Name *</label>
                                        <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="">Email *</label>
                                        <input type="text" name="email" class="form-control" value="{{ $user->email }}">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="">Phone</label>
                                        <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="">Address</label>
                                        <input type="text" name="address" class="form-control" value="{{ $user->address }}">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="">Country</label>
                                        <input type="text" name="country" class="form-control" value="{{ $user->country }}">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="">State</label>
                                        <input type="text" name="state" class="form-control" value="{{ $user->state }}">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="">City</label>
                                        <input type="text" name="city" class="form-control" value="{{ $user->city }}">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="">Zip</label>
                                        <input type="text" name="zip" class="form-control" value="{{ $user->zip }}">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="">Status *</label>
                                        <select name="status" class="form-select">
                                            <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Pending</option>
                                            <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="2" {{ $user->status == 2 ? 'selected' : '' }}>Suspended</option>
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