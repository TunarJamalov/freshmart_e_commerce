@extends('admin.layouts.master')

@section('main_content')
@include('admin.layouts.nav')
@include('admin.layouts.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between align-items-center">
            <h1>Additional Information for {{ $product->name }}</h1>
            <div class="ml-auto">
                <a href="{{ route('admin_product_index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back to Products Page</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_product_additional_information_store',[$product->id]) }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label for="">Label *</label>
                                        <input type="text" name="label" class="form-control">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="">Value *</label>
                                        <input type="text" name="value" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tr>
                                        <th>SL</th>
                                        <th>Label</th>
                                        <th>Value</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach($additional_informations as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->label }}</td>
                                        <td>{{ $item->value }}</td>
                                        
                                        <td>
                                            <a href="" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal_{{ $loop->iteration }}"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('admin_product_additional_information_delete', $item->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="modal_{{ $loop->iteration }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('admin_product_additional_information_update', $item->id) }}" method="post">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label class="form-label">Label *</label>
                                                            <input type="text" name="label" class="form-control" value="{{ $item->label }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Value *</label>
                                                            <input type="text" name="value" class="form-control" value="{{ $item->value }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
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