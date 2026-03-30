@extends('front.layouts.master')

@section('page_main_content')
<!-- Registration Section -->
<section class="registration-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-5">
                        <h3 class="text-center fw-bold mb-4">Create Account</h3>
                        
                        <form action="{{ route('user_registration_submit') }}" method="post">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                                
                                <div class="col-lg-12">
                                    <label class="form-label">Email Address <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="email">
                                </div>
                                
                                <div class="col-lg-12">
                                    <label class="form-label">Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                                
                                <div class="col-12">
                                    <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="confirm_password">
                                </div>
                                
                                <div class="col-12">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="terms">
                                        <label class="form-check-label" for="terms">
                                            I agree to the <a href="#" class="text-success">Terms & Conditions</a>
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <button type="submit" class="btn btn-success w-100">
                                        <i class="bi bi-person-plus me-2"></i>Create Account
                                    </button>
                                </div>
                            </div>
                        </form>
                        
                        <hr class="my-4">
                        
                        <p class="text-center mb-0">
                            Already have an account? 
                            <a href="{{ route('user_login') }}" class="text-success text-decoration-none fw-bold">Login</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection