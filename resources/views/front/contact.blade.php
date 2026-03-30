@extends('front.layouts.master')

@section('page_main_content')
<!-- Breadcrumb -->
<section class="breadcrumb-section py-3 bg-light">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-success">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Contact Section -->
<section class="contact-section py-5">
    <div class="container">
        <!-- Page Header -->
        <div class="text-center mb-5">
            <h2 class="fw-bold">Get In Touch</h2>
            <p class="text-muted">Have questions? We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
        </div>

        <div class="row g-5">
            <!-- Contact Information -->
            <div class="col-lg-4">
                <div class="contact-info">
                    
                    @if($page_data->contact_address != '')
                    <!-- Address -->
                    <div class="info-box mb-4 p-4 bg-light rounded">
                        <div class="d-flex align-items-start">
                            <div class="icon-box bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3 contact-icon-box">
                                <i class="bi bi-geo-alt text-success fs-3"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-2">Address</h5>
                                <p class="text-muted mb-0">
                                    {!! nl2br($page_data->contact_address) !!}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($page_data->contact_phone != '')
                    <!-- Phone -->
                    <div class="info-box mb-4 p-4 bg-light rounded">
                        <div class="d-flex align-items-start">
                            <div class="icon-box bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3 contact-icon-box">
                                <i class="bi bi-telephone text-success fs-3"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-2">Phone</h5>
                                <p class="text-muted mb-0">
                                    {!! nl2br($page_data->contact_phone) !!}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($page_data->contact_email != '')
                    <!-- Email -->
                    <div class="info-box mb-4 p-4 bg-light rounded">
                        <div class="d-flex align-items-start">
                            <div class="icon-box bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3 contact-icon-box">
                                <i class="bi bi-envelope text-success fs-3"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-2">Email</h5>
                                <p class="text-muted mb-0">
                                    {!! nl2br($page_data->contact_email) !!}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($page_data->contact_working_hours != '')
                    <!-- Working Hours -->
                    <div class="info-box p-4 bg-light rounded">
                        <div class="d-flex align-items-start">
                            <div class="icon-box bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3 contact-icon-box">
                                <i class="bi bi-clock text-success fs-3"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-2">Working Hours</h5>
                                <p class="text-muted mb-0">
                                    {!! nl2br($page_data->contact_working_hours) !!}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-lg-8">
                <div class="contact-form">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4 p-md-5">
                            <h4 class="fw-bold mb-4">Send Us a Message</h4>
                            <form action="{{ route('contact_submit') }}" method="post">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Your Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Your Email <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="email">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Phone Number</label>
                                        <input type="tel" class="form-control" name="phone">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Subject <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="subject">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Message <span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="message" rows="6"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-success px-5">
                                            <i class="bi bi-send me-2"></i>Send Message
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($page_data->contact_map != '')
        <!-- Map Section -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="map-container rounded overflow-hidden shadow-sm">
                    {!! $page_data->contact_map !!}
                </div>
            </div>
        </div>
        @endif
    </div>
</section>
@endsection