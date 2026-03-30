@extends('admin.layouts.master')

@section('main_content')
@include('admin.layouts.nav')
@include('admin.layouts.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between align-items-center">
            <h1>Product Variations for {{ $product->name }}</h1>
            <div class="ml-auto">
                <a href="{{ route('admin_product_index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back to Products Page</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_product_variation_store',[$product->id]) }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4 mb-3">
                                        <label for="">Label *</label>
                                        <input type="text" name="label" class="form-control">
                                    </div>
                                    <div class="col-lg-2 mb-3">
                                        <label for="">Sale Price *</label>
                                        <input type="text" name="sale_price" class="form-control">
                                    </div>
                                    <div class="col-lg-2 mb-3">
                                        <label for="">Regular Price</label>
                                        <input type="text" name="regular_price" class="form-control">
                                    </div>
                                    <div class="col-lg-2 mb-3">
                                        <label for="">Stock *</label>
                                        <input type="text" name="stock" class="form-control">
                                    </div>
                                    <div class="col-lg-2 mb-3">
                                        <label for="">Order *</label>
                                        <input type="text" name="sort_order" class="form-control">
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
                                        <th>Sale Price</th>
                                        <th>Regular Price</th>
                                        <th>Stock</th>
                                        <th>Order</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach($product_variations as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->label }}</td>
                                        <td>${{ $item->sale_price }}</td>
                                        <td>
                                            @if($item->regular_price)
                                            ${{ $item->regular_price }}
                                            @endif
                                        </td>
                                        <td>{{ $item->stock }}</td>
                                        <td>{{ $item->sort_order }}</td>
                                        <td>
                                            <a href="" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal_{{ $loop->iteration }}"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('admin_product_variation_delete', $item->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></a>
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
                                                    <form action="{{ route('admin_product_variation_update', $item->id) }}" method="post">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label class="form-label">Label</label>
                                                            <input type="text" name="label" class="form-control" value="{{ $item->label }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Sale Price</label>
                                                            <input type="text" name="sale_price" class="form-control" value="{{ $item->sale_price }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Regular Price</label>
                                                            <input type="text" name="regular_price" class="form-control" value="{{ $item->regular_price }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Stock</label>
                                                            <input type="text" name="stock" class="form-control" value="{{ $item->stock }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Order</label>
                                                            <input type="text" name="sort_order" class="form-control" value="{{ $item->sort_order }}">
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