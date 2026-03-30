@extends('admin.layouts.master')

@section('main_content')
@include('admin.layouts.nav')
@include('admin.layouts.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between align-items-center">
            <h1>Replies of This Comment:<br>
                Post: {{ $comment_data->post->title }} <br>
                Name: {{ $comment_data->name }} <br>
                Email: {{ $comment_data->email }} <br>
                Comment: {!! nl2br(e($comment_data->comment)) !!}
            </h1>
            <div class="ml-auto">
                <a href="{{ route('admin_comment') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back to Comment Page</a>
            </div>
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
                                            <th>Name & Email</th>
                                            <th>Reply</th>
                                            <th>User Type</th>
                                            <th style="width: 120px;">Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($replies as $reply)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if($reply->user_type == 'Admin')
                                                    @php
                                                        $admin = App\Models\Admin::where('id',1)->first();
                                                    @endphp
                                                    {{ $admin->name }}<br>{{ $admin->email }}
                                                @else
                                                    {{ $reply->name }}<br>{{ $reply->email }}
                                                @endif
                                            </td>
                                            <td>{!! nl2br(e($reply->reply)) !!}</td>
                                            <td>{{ $reply->user_type }}</td>
                                            <td>
                                                @if($reply->status == 'Approved')
                                                    <span class="badge bg-success">Approved</span>
                                                @else
                                                    <span class="badge bg-danger">Pending</span>
                                                @endif
                                                <br><a href="{{ route('admin_reply_status_change', $reply->id) }}">Change Status</a>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin_reply_delete', $reply->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></a>
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