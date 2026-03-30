@extends('front.layouts.master')

@section('page_main_content')
<!-- Login Section -->
<section class="login-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-5">
                        <h3 class="text-center fw-bold mb-4">Login</h3>
                        
                        <form action="{{ route('user_login_submit') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Email Address <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="email">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            
                            <button type="submit" class="btn btn-success w-100 mb-3">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Login
                            </button>
                            
                            <div class="text-center">
                                <a href="{{ route('user_forget_password') }}" class="text-decoration-none">Forgot Password?</a>
                            </div>
                        </form>
                        
                        <hr class="my-4">
                        
                        <p class="text-center mb-0">
                            Don't have an account? 
                            <a href="{{ route('user_registration') }}" class="text-success text-decoration-none fw-bold">Sign Up</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection