@extends('admin.layouts.master')

@section('main_content')
@include('admin.layouts.nav')
@include('admin.layouts.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between align-items-center">
            <h1>Comments</h1>
            <div class="ml-auto">
                <a href="{{ route('admin_post_index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back to Post Page</a>
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
                                            <th>Post</th>
                                            <th>Name & Email</th>
                                            <th>Comment</th>
                                            <th style="width: 120px;">Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($comments as $comment)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{ $comment->post->title }}
                                                <br><a href="{{ route('post', $comment->post->slug) }}">Post Detail</a>
                                                <br><a href="{{ route('admin_reply', $comment->id) }}" class="btn btn-warning btn-sm">Replies</a> <a href="" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal_reply_admin{{$loop->iteration}}">Give Reply</a>
                                            </td>
                                            <td>{{ $comment->name }}<br>{{ $comment->email }}</td>
                                            <td>{!! nl2br(e($comment->comment)) !!}</td>
                                            <td>
                                                @if($comment->status == 'Approved')
                                                    <span class="badge bg-success">Approved</span>
                                                @else
                                                    <span class="badge bg-danger">Pending</span>
                                                @endif
                                                <br><a href="{{ route('admin_comment_status_change', $comment->id) }}">Change Status</a>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin_comment_delete', $comment->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="modal_reply_admin{{$loop->iteration}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Reply</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin_reply_submit', $comment->id) }}" method="post">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <textarea name="reply" class="form-control h_100" cols="30" rows="10" placeholder="Reply"></textarea>
                                                            </div>
                                                            <div class="mb-3">
                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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