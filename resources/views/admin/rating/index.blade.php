@extends('admin.layouts.master')

@section('main_content')
@include('admin.layouts.nav')
@include('admin.layouts.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between align-items-center">
            <h1>Ratings</h1>
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
                                            <th>User Name</th>
                                            <th>User Email</th>
                                            <th>Product</th>
                                            <th>Rating</th>
                                            <th>Review</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($ratings as $rating)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{ $rating->user->name }}
                                                <br>
                                                <a href="{{ route('admin_user_edit', $rating->user_id) }}">Detail</a>
                                            </td>
                                            <td>
                                                {{ $rating->user->email }}
                                            </td>
                                            <td>{{ $rating->product->name }}</td>
                                            <td>{{ $rating->rating }}</td>
                                            <td>{!! nl2br($rating->review) !!}</td>
                                            <td>
                                                <a href="{{ route('admin_rating_delete', $rating->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
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