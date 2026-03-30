@extends('front.layouts.master')

@section('page_main_content')
<!-- Forget Password Section -->
<section class="forget-password-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-5">
                        
                        <h3 class="text-center fw-bold mb-4">Forgot Password?</h3>
                        
                        <form action="{{ route('user_reset_password_submit',[$token,$email]) }}" method="post">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label">Password <span class="text-danger">*</span></label>
                                <input type="password" name="password" placeholder="Password">
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" name="confirm_password" placeholder="Confirm Password">
                            </div>
                            <button type="submit" class="btn btn-success w-100 mb-3">
                                <i class="bi bi-send me-2"></i> Submit
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection