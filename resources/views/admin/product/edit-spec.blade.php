@extends('layouts.admin-app') {{-- Extend the main parent layout --}}

@section('title', 'Admin | Product Specification Edit') {{-- Set the page title --}}

@push('styles')
<style>
    .tab-content .card {
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
        background-color: #fff;
        margin-top: 1rem;
    }
    .card-title {
        font-size: 1.25rem;
        font-weight: 500;
    }
    table {
        width: 100%;
        margin-bottom: 1rem;
        color: #212529;
        border-collapse: collapse;
    }
    table th, table td {
        padding: 0.75rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
    }
    table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #dee2e6;
    }
    .scroll-to-bottom {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }
    .scroll-to-bottom:hover {
        background-color: #0056b3;
    }

    .main-section {
    min-height: 90vh;
    max-height: 90vh;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('admin.includes.sidebar')
        <section class="col-md-10 ml-sm-auto col-lg-10 px-3 py-1 overflow-y-scroll main-section">
            <div class="container-fluid">
                <div class="container mt-4">
                    {{-- Back Button --}}
                    <div class="d-flex justify-content-start flex-wrap flex-md-nowrap align-items-center pt-1 pb-2 mb-3 border-bottom">
                        <button type="button" class="btn btn-primary" onclick="window.history.back()"> &#9754; Back to previous</button>
                    </div>

                    <!-- Card: Edit Product Specification -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Edit Product Specification: {{ $specification->specification_name }}</h4>
                                </div>
                                {{-- Display Errors --}}
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
                                <div class="card-body">
                                    <form action="{{ route('admin.product.specification.update', $specification->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <!-- Product Dropdown -->
                                        <div class="form-group">
                                            <label for="product_id">Product</label>
                                            <select class="form-control" id="product_id" name="product_id" required>
                                                <option value="{{ $specification->product_id }}" selected>{{ $specification->product->product_name }}</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Specification Name -->
                                        <div class="form-group">
                                            <label for="specification_name">Specification Name</label>
                                            <input type="text" class="form-control" id="specification_name" name="specification_name" value="{{ $specification->specification_name }}" required>
                                        </div>

                                        <!-- Product Price -->
                                        <div class="form-group my-3">
                                            <label for="product_price">Product Price</label>
                                            <input type="number" class="form-control" id="product_price" name="product_price" value="{{ $specification->product_price }}" required>
                                        </div>

                                        <!-- Product Weight -->
                                        <div class="form-group my-3">
                                            <label for="product_kg">Product Weight (kg)</label>
                                            <input type="number" step="0.01" class="form-control" id="product_kg" name="product_kg" value="{{ $specification->product_kg }}" required>
                                        </div>

                                        <!-- Hidden Admin ID -->
                                        <input type="hidden" class="form-control" id="admin_id" name="admin_id" value="{{ Auth::guard('admin')->user()->id }}" required>

                                        <!-- Submit Button -->
                                        <div class="d-flex">
                                            <button type="submit" class="btn btn-block my-3 px-4 btn-success">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
