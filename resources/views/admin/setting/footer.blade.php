@extends('admin.layouts.master')

@section('main_content')
@include('admin.layouts.nav')
@include('admin.layouts.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between align-items-center">
            <h1>Edit Footer Information</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_setting_footer_update') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label for="">Facebook</label>
                                        <input type="text" name="footer_facebook" value="{{ $setting->footer_facebook }}" class="form-control">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="">Twitter</label>
                                        <input type="text" name="footer_twitter" value="{{ $setting->footer_twitter }}" class="form-control">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="">Linkedin</label>
                                        <input type="text" name="footer_linkedin" value="{{ $setting->footer_linkedin }}" class="form-control">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="">Instagram</label>
                                        <input type="text" name="footer_instagram" value="{{ $setting->footer_instagram }}" class="form-control">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="">Address</label>
                                        <input type="text" name="footer_address" value="{{ $setting->footer_address }}" class="form-control">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="">Phone</label>
                                        <input type="text" name="footer_phone" value="{{ $setting->footer_phone }}" class="form-control">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="">Email</label>
                                        <input type="text" name="footer_email" value="{{ $setting->footer_email }}" class="form-control">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="">Working Hours</label>
                                        <input type="text" name="footer_working_hours" value="{{ $setting->footer_working_hours }}" class="form-control">
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <label for="">Copyright info</label>
                                        <input type="text" name="footer_copyright" value="{{ $setting->footer_copyright }}" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection