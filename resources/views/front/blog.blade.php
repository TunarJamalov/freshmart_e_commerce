@extends('front.layouts.master')

@section('page_main_content')
<!-- Breadcrumb -->
<section class="breadcrumb-section py-3 bg-light">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-success">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Blog</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Blog Section -->
<section class="blog-section py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="fw-bold mb-3">Latest Articles</h2>
                <p class="text-muted">Stay updated with healthy eating tips, recipes, and grocery shopping guides</p>
            </div>
        </div>

        <div class="row g-4">
            @foreach($posts as $post)
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <a href="{{ route('post', $post->slug) }}">
                        <img src="{{ asset('uploads/'.$post->photo) }}" class="card-img-top" alt="Blog Post">
                    </a>
                    <div class="card-body">
                        <div class="mb-3">
                            <span class="text-muted"><i class="bi bi-calendar3"></i> {{ $post->created_at->format('M d, Y') }}</span>
                        </div>
                        <h5 class="card-title fw-bold">
                            <a href="{{ route('post', $post->slug) }}" class="text-dark text-decoration-none">{{ $post->title }}</a>
                        </h5>
                        <p class="card-text text-muted">{!! $post->short_description !!}</p>
                        <a href="{{ route('post', $post->slug) }}" class="btn btn-outline-success">Read More <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="row mt-4">
            <div class="col-12 d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</section>
@endsection