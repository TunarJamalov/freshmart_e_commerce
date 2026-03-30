@extends('admin.layouts.master')

@section('main_content')
@include('admin.layouts.nav')
@include('admin.layouts.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between align-items-center">
            <h1>Delivery Options</h1>
            <div class="ml-auto">
                <a href="{{ route('admin_delivery_option_create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Create Delivery Option</a>
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
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Cost</th>
                                            <th>Is Default</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($delivery_options as $delivery_option)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $delivery_option->name }}</td>
                                            <td>{{ $delivery_option->description }}</td>
                                            <td>{{ $delivery_option->cost }}</td>
                                            <td>
                                                @if($delivery_option->is_default == 1)
                                                    <span class="badge bg-success">Yes</span>
                                                @else
                                                    <span class="badge bg-danger">No</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin_delivery_option_edit', $delivery_option->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                                <a href="{{ route('admin_delivery_option_delete', $delivery_option->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
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