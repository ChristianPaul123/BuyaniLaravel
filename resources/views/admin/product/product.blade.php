@extends('layouts.admin-app') {{-- Extend the main parent layout --}}

@section('title', 'Admin | Product') {{-- Set the page title --}}

@push('styles')
<style>
.main-section {
        max-height: 31rem;
    }
</style>
@endpush

@section('content')
     <div class="container-fluid">
        <div class="row">
        @include('admin.includes.sidebar')
        <section class="col-md-10 ml-sm-auto col-lg-10 px-3 py-2 overflow-y-scroll main-section">
            @session('message')
            <div class=" mx-3 my-2 px-3 py-2 alert alert-success">
                <button type="button" class="close  btn btn-success" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session('message') }}
            </div>
           @endsession
           {{-- if there's errors --}}
            @if ($errors->any())
            <div class="alert alert-danger mx-3 my-2 px-3 py-2">
                <button type="button" class="close btn btn-danger" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-1 pb-2 mb-3 border-bottom">
                <h1 class="h2">Product</h1>
            </div>

                <!--Add the more part here
                EX: just add a div
                -->
                <div class="d-flex justify-content-end flex-wrap flex-md-nowrap align-items-center pt-1 pb-2 mb-3 border-bottom">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                        Add Product
                    </button>
                </div>
                <!--Add Modal Frame -->
                <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('admin.product.add') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="product_name">Product Name</label>
                                        <input type="text" class="form-control" id="product_name" name="product_name" required>
                                    </div>

                                    <div class="form-group my-3">
                                        <label for="product_details">Product Details</label>
                                        <textarea class="form-control" style="resize: none;" id="product_details" name="product_details" rows="2" required></textarea>
                                    </div>

                                    <div class="form-group my-3">
                                        <label for="product_pic">Product Image</label>
                                        <input type="file" class="form-control" id="product_pic" name="product_pic">
                                    </div>

                                    <div class="form-group my-3">
                                        <label for="category_id">Category</label>
                                        <select class="form-control" id="category_id" name="category_id" required>
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="subcategory_id">SubCategory</label>
                                        <select class="form-control" id="subcategory_id" name="subcategory_id" required>
                                            <option value="">Select SubCategory</option>
                                            @foreach ($subcategories as $subcategory)
                                                <option value="{{ $subcategory->id }}">{{ $subcategory->sub_category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <input type="hidden" class="form-control" id="product_status" name="product_status" value="1" required>

                                    <div class="d-flex">
                                        <button type="submit" class="btn btn-block my-3 px-4 btn-success">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card overflow-x-scroll">
                    <div class="card-header">
                        <h3 class="card-title">All Products</h3>
                    </div>

                    <div class="card-body">
                        <table id="productTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Product Details</th>
                                    <th>Product Status</th>
                                    <th>Product Image</th>
                                    <th>Category Name</th>
                                    <th>Sub Category Name</th>
                                    <th>Deactivated Date</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->product_details }}</td>
                                        <td>{{ $product->status_label }}</td>
                                        <td><img src="{{ asset( "$product->product_pic" ) }}" alt="{{ $product->product_name }}" width="50"></td>
                                        <td>{{ $product->category->category_name }}</td>
                                        <td>{{ $product->subcategory->sub_category_name }}</td>
                                        <td>{{ $product->product_deactivated }}</td>
                                        <td class="text-center d-flex justify-content-center align-items-center">
                                            <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-primary">Edit</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.product.delete', $product->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete the product: {{ $product->product_name }}?');">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

