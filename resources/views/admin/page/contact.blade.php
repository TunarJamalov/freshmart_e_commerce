@extends('admin.layouts.master')

@section('main_content')
@include('admin.layouts.nav')
@include('admin.layouts.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between align-items-center">
            <h1>Edit Contact Page Content</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_page_contact_update') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label for="">Address</label>
                                        <textarea name="contact_address" class="form-control h_100" rows="4">{{ $page_data->contact_address }}</textarea>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="">Email</label>
                                        <textarea name="contact_email" class="form-control h_100" rows="4">{{ $page_data->contact_email }}</textarea>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="">Phone</label>
                                        <textarea name="contact_phone" class="form-control h_100" rows="4">{{ $page_data->contact_phone }}</textarea>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="">Working Hours</label>
                                        <textarea name="contact_working_hours" class="form-control h_100" rows="4">{{ $page_data->contact_working_hours }}</textarea>
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <label for="">Map</label>
                                        <textarea name="contact_map" class="form-control h_200" rows="4">{{ $page_data->contact_map }}</textarea>
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