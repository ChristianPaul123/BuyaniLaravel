@extends('layouts.admin-app') {{-- Extend the main parent layout --}}

@section('title', 'Admin | Edit Product') {{-- Set the page title --}}

@push('styles')
<style>
    .card {
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
        background-color: #fff;
        margin-top: 1rem;
    }
    .card-title {
        font-size: 1.25rem;
        font-weight: 500;
    }
    .form-control:focus {
        box-shadow: none;
        border-color: #80bdff;
    }
    .main-section {
    min-height: 90vh;
    max-height: 90vh;
    }
    .img-thumbnail {
        margin-top: 10px;
    }
    .btn-back {
        margin-bottom: 15px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('admin.includes.sidebar')
<section class="col-md-10 ml-sm-auto col-lg-10 px-3 py-5 overflow-y-scroll main-section">
        <div class="container-fluid">
            <div class="container mt-4">
                    {{-- Header Section --}}
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                        <h1 class="h2">Edit Product</h1>
                    </div>

                    {{-- Back Button --}}
                    <button type="button" class="btn btn-primary btn-back" onclick="window.history.back()"><i class="bi bi-arrow-left-circle"> </i>Back to previous</button>

                    {{-- Error Messages --}}
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    {{-- Edit Product Form --}}
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Product: {{ $product->product_name }}</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                {{-- Product Name --}}
                                <div class="form-group">
                                    <label for="product_name">Product Name</label>
                                    <input type="text" class="form-control" id="product_name" name="product_name" value="{{ $product->product_name }}" required>
                                </div>

                                {{-- Product Details --}}
                                <div class="form-group my-3">
                                    <label for="product_details">Product Details</label>
                                    <textarea class="form-control" style="resize: none;" id="product_details" name="product_details" rows="2">{{ $product->product_details }}</textarea>
                                </div>
                                {{-- Current Product Image --}}
                                <div class="mb-3 d-flex flex-column">
                                    <label for="product_image_showcase">Current Product Image</label>
                                    <img id="product_image_showcase" src="{{ asset($product->product_pic) }}" alt="Product Image" class="img-thumbnail" width="200px" height="100px">
                                </div>
                                <div class="form-group my-3">
                                    <label for="product_pic">Upload New Main Image</label>
                                    <input type="file" class="form-control" id="product_pic" name="product_pic">
                                </div>

                                {{-- Sub Product Images --}}
                                <div class="mb-3 d-flex flex-column">
                                    <label for="product_image_showcase">Sub Product Image</label>
                                    <div class="row">
                                        @foreach ($images as $image)
                                        <div class="position-relative col-6 col-md-4 col-lg-3 mb-2">
                                            <img id="{{ $image['id'] }}" src="{{ asset($image['img']) }}" alt="Product Image" class="img-thumbnail w-100 h-100" style="object-fit: cover;">
                                            <button type="button" class="btn btn-danger btn-sm position-absolute" style="top: 5px; right: 5px; z-index: 1;">
                                                &times;
                                            </button>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="form-group my-3">
                                    <label for="product_pic">Upload New Product Images</label>
                                    <input type="file" class="form-control" id="product_pic" name="product_images[]" multiple>
                                </div>

                                {{-- Product Status --}}
                                <div class="form-group my-3">
                                    <label for="product_status">Product Status</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="product_status" id="product_status_available" value="1" {{ $product->product_status == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="product_status_available">Available</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="product_status" id="product_status_out_of_stock" value="2" {{ $product->product_status == 2 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="product_status_out_of_stock">Out of Stock</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="product_status" id="product_status_unavailable" value="3" {{ $product->product_status == 3 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="product_status_unavailable">Unavailable</label>
                                    </div>
                                </div>

                                {{-- Category Dropdown --}}
                                <div class="form-group my-3">
                                    <label for="category_id">Category</label>
                                    <select class="form-control" id="category_id" name="category_id">
                                        <option value="{{ $product->category_id }}" selected>{{ $product->category->category_name }}</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Subcategory Dropdown --}}
                                <div class="form-group">
                                    <label for="subcategory_id">Subcategory</label>
                                    <select class="form-control" id="subcategory_id" name="subcategory_id">
                                        <option value="{{ $product->subcategory_id }}" selected>{{ $product->subcategory->sub_category_name }}</option>
                                        @foreach ($subcategories as $subcategory)
                                            <option value="{{ $subcategory->id }}">{{ $subcategory->sub_category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" name="removed_images" id="removed_images">

                                {{-- Submit Button --}}
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-block">Update Product</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<script>
    // Array to keep track of removed image IDs
    let removedImages = [];

    document.addEventListener('DOMContentLoaded', function () {
        // Add event listeners to all remove buttons
        document.querySelectorAll('.btn-danger').forEach(button => {
            button.addEventListener('click', function () {
                const imageDiv = this.closest('.position-relative');
                const imageId = imageDiv.querySelector('img').id;

                // Add the image ID to the removedImages array
                removedImages.push(imageId);

                // Remove the image visually
                imageDiv.remove();
                console.log('Removed images:', removedImages);
            });
        });
    });

    document.querySelector('form').addEventListener('submit', function () {
        document.getElementById('removed_images').value = JSON.stringify(removedImages);
    });
</script>

@endsection
