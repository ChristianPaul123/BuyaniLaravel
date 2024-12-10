@extends('layouts.app')

@section('title', 'Voting System')

@push('styles')
<style>
    /* General Page Styles */
    .voting-header {
        margin-top: 50px;
        text-align: center;
        font-family: 'Poppins', sans-serif;
        color: #333;
    }

    /* Card Styling */
    .card {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        border-radius: 15px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        border: none;
        overflow: hidden;
    }

        /* Card Styling */
    .card .card-body{
        padding: auto;
    }

    .voting-poll {
        background-color:#cbcbcb;
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        border: none;
        overflow: hidden;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    /* Product Image */
    .product-image img {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #ddd;
    }

    /* Product Details */
    .details h5 {
        font-size: 18px;
        font-weight: bold;
        color: #333;
        margin-bottom: 8px;
    }

    .details p {
        font-size: 14px;
        color: #777;
        margin: 0;
    }

    /* Buttons */
    .actions button {
        border: none;
        border-radius: 30px;
        padding: 8px 20px;
        font-size: 14px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .actions .btn-info {
        background-color: #17a2b8;
        color: white;
    }

    .actions .btn-info:hover {
        background-color: #138496;
        transform: scale(1.05);
    }

    .actions .btn-success {
        background-color: #28a745;
        color: white;
    }

    .actions .btn-success:hover {
        background-color: #218838;
        transform: scale(1.05);
    }

    /* Modal Styling */
    .modal-content {
        border-radius: 15px;
        overflow: hidden;
    }

    .modal-header {
        background-color: #4caf50;
        color: white;
    }

    .modal-body {
        padding: 30px;
    }

    .product-image-modal img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #ddd;
    }

    .modal-title {
        font-size: 22px;
        font-weight: bold;
    }

    .modal-footer button {
        border-radius: 20px;
        padding: 10px 20px;
    }

    /* Chart Container */
    .chart-container {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 15px;
        margin-top: 20px;
        min-height: 500px;
    }

    /* Request Product Section */
    .request-product {
        margin-top: 30px;
        text-align: right;
    }

    .request-product .btn-primary {
        background: #007bff;
        border: none;
        padding: 10px 20px;
        border-radius: 30px;
        font-size: 14px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .request-product .btn-primary:hover {
        background-color: #0056b3;
        transform: translateY(-3px);
    }

    .max-height {
        max-height: 300px;
        min-height: 300px;
        overflow-y: scroll
    }
</style>
@endpush

@section('content')
@include('user.includes.navbar-consumer')

<div class="main-content-wrapper">
    <div class="container my-5">
        <!-- Voting Header -->
        <div class="voting-header">
            <h1>Product Voting</h1>
            <p>Vote for your favorite products this month!</p>
        </div>
        @livewire('product-chart')
        @livewire('product-poll')
         <!-- Request Product Button -->
         <div class="request-product">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#requestProductModal">+ Request Product</button>
        </div>
        <div class="modal fade" id="requestProductModal" tabindex="-1" aria-labelledby="requestProductModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('user.consumer.voting.suggest') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="requestProductModalLabel">Request Product</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="suggest_name">Product Name</label>
                                <input type="text" class="form-control" name="suggest_name" required>
                            </div>
                            <div class="form-group">
                                <label for="category">Sample Category:</label>
                                <input type="text" class="form-control" name="category" required>
                            </div>
                            <div class="form-group">
                                <label for="suggest_description">Introduction to requested product:</label>
                                <textarea class="form-control" name="suggest_description" rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="suggest_image">Product Image</label>
                                <input type="file" class="form-control" name="suggest_image">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@endsection
