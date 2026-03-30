@extends('front.layouts.master')

@section('page_main_content')
<!-- Breadcrumb -->
<section class="breadcrumb-section py-3 bg-light">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-success">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('blog') }}" class="text-success">Blog</a></li>
                <li class="breadcrumb-item active" aria-current="page">Post</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Blog Post Section -->
<section class="post-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Post Header -->
                <div class="mb-4">
                    <h1 class="fw-bold mb-3">
                        {{ $post->title }}
                    </h1>
                    <div class="text-muted mb-4">
                        <span><i class="bi bi-calendar3"></i> {{ $post->created_at->format('M d, Y') }}</span>
                        <span class="ms-3"><i class="bi bi-chat-dots"></i> {{ $comments->count() }} Comments</span>
                    </div>
                </div>

                <!-- Featured Image -->
                <img src="{{ asset('uploads/'.$post->photo) }}" alt="Blog Post" class="mb-4 blog-post-detail">

                <!-- Post Content -->
                <div class="post-content">
                    {!! $post->description !!}
                </div>

                <!-- Post Footer -->
                <div class="border-top border-bottom py-4 my-5">
                    <div class="row">
                        <div class="col-md-12 mt-3 mt-md-0">
                            <strong>Share:</strong>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('post', $post->slug)) }}" class="btn btn-sm btn-outline-success ms-2"><i class="bi bi-facebook"></i></a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('post', $post->slug)) }}&text={{ urlencode($post->title) }}" class="btn btn-sm btn-outline-success ms-1"><i class="bi bi-twitter"></i></a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(route('post', $post->slug)) }}" class="btn btn-sm btn-outline-success ms-1"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Comments Section -->
                <div class="comments-section mt-5">
                    <h3 class="fw-bold mb-4">Comments ({{ $comments->count() }})</h3>

                    @forelse($comments as $comment)
                    @php
                        $default = "";
                        $size = 200;
                        $gravatar_url = "http://www.gravatar.com/avatar/" . md5(strtolower(trim($comment->email))) . "?d=" . urlencode($default) . "&s=" . $size;
                    @endphp
                    <div class="comment mb-4 p-4 bg-light rounded">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="rounded-circle">
                                        <img src="{{ $gravatar_url }}" alt="" style="width:50px; height:50px; border-radius:50%;">
                                    </div>
                                </div>
                                <div class="ms-3">
                                    <h6 class="mb-1 fw-bold">{{ $comment->name }}</h6>
                                    <small class="text-muted">{{ $comment->created_at->format('F d, Y') }}</small>
                                </div>
                            </div>
                            <button class="btn btn-sm btn-outline-success reply-btn" data-bs-toggle="modal" data-bs-target="#reply_modal{{$loop->iteration}}">
                                <i class="bi bi-reply"></i> Reply
                            </button>
                        </div>
                        <p class="mb-0">
                            {!! nl2br($comment->comment) !!}
                        </p>

                        @php
                            $replies = App\Models\Reply::where('comment_id',$comment->id)->where('status', 'Approved')->get();
                        @endphp

                        <!-- REPLY -->
                        @foreach($replies as $reply)
                        @php
                            if($reply->user_type == 'Admin')
                            {
                                $name = Auth::guard('admin')->user()->name;
                                $email = Auth::guard('admin')->user()->email;
                            } else {
                                $name = $reply->name;
                                $email = $reply->email;
                            }
                        @endphp
                        @php
                            $default = "";
                            $size = 200;
                            $gravatar_url = "http://www.gravatar.com/avatar/" . md5(strtolower(trim($email))) . "?d=" . urlencode($default) . "&s=" . $size;
                        @endphp
                        <div class="child-comment mt-3 ms-5 p-3 bg-white rounded border">
                            <div class="d-flex mb-2">
                                <div class="flex-shrink-0">
                                    <div class="rounded-circle">
                                        <img src="{{ $gravatar_url }}" alt="" style="width:50px; height:50px; border-radius:50%;">
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1 fw-bold">
                                        {{ $name }}
                                        @if($reply->user_type == 'Admin')
                                            <span class="badge bg-success ms-2">Admin</span>
                                        @endif
                                    </h6>
                                    <small class="text-muted">{{ $reply->created_at->format('F d, Y') }}</small>
                                </div>
                            </div>
                            <p class="mb-0">
                                {!! nl2br($reply->reply) !!}
                            </p>
                        </div>
                        @endforeach
                        


                    </div>
                    <div class="modal fade" id="reply_modal{{$loop->iteration}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Give a Reply</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('reply_submit',$comment->id) }}" method="post">
                                        @csrf
                                        <div class="mb-3">
                                            <input name="name" type="text" class="form-control" placeholder="Name" required>
                                        </div>
                                        <div class="mb-3">
                                            <input name="email" type="text" class="form-control" placeholder="Email" required>
                                        </div>
                                        <div class="mb-3">
                                            <textarea name="reply" class="form-control h_100" cols="30" rows="10" placeholder="Reply" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-danger">No comments found.</p>
                    @endforelse

                    <!-- Leave a Comment Form -->
                    <div class="leave-comment mt-5">
                        <h4 class="fw-bold mb-4">Leave a Comment</h4>
                        <form action="{{ route('comment_submit',$post->id) }}" method="post">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" placeholder="Your Name *">
                                </div>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" placeholder="Your Email *">
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control" name="comment" rows="5" placeholder="Your Comment *"></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-success">
                                        <i class="bi bi-send me-2"></i>Post Comment
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection