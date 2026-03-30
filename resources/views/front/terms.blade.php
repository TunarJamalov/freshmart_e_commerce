@extends('front.layouts.master')

@section('page_main_content')
<!-- Breadcrumb -->
<section class="breadcrumb-section py-3 bg-light">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-success">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Terms of Use</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Privacy Policy Section -->
<section class="privacy-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h2 class="fw-bold mb-4">Terms of Use</h2>
                <p class="text-muted mb-4">Last updated: {{ $page_data->updated_at->format('F d, Y') }}</p>
                {!! $page_data->terms_content !!}
            </div>
        </div>
    </div>
</section>
@endsection