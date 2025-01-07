@extends('layouts.app') <!-- Extend your main layout -->

@section('title', 'Product Catalog') <!-- Define the title for this page -->

@push('styles')
    <style>
    .navbar-category {
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 1000;
        background-color: #175593;
        border-bottom: 1px solid #ddd;
    }
    .navbar-nav .nav-link {
        color: #333;
    }
    .navbar-nav .nav-link.active {
        font-weight: bold;
    }

    .card {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        font-size: 0.95rem;
        padding: 0.5rem;
    }

    .card-body {
        padding: 0.75rem;
        font-size: 0.85rem;
    }

    .btn-sm {
        font-size: 0.8rem;
        padding: 0.25rem 0.5rem;
    }

    .input-group button {
        font-size: 0.8rem;
        height: 30px;
    }

    .input-group input {
        font-size: 0.8rem;
        height: 30px;
        width: 50px;
        padding: 0 0.25rem;
    }

    button.btn-primary {
    transition: all 0.3s ease;
    }

    button.btn-primary:hover {
        background-color: #45c657;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    .star-rating .fa {
    cursor: pointer;
    transition: color 0.2s;
    }

    .star-rating .fa-star {
        color: #FFD700;
    }

    .star-rating .fa-star-o {
        color: #d6e80c;
    }
        </style>
@endpush

@section('x-content')
    @include('user.includes.navbar-consumer')
    <div class="main-content-wrapper">
        <!-- All your main page content goes here -->
        @livewire('consumer.product-view', ['productId' => $product->id])
    </div>
@endsection

@section('scripts')

@endsection



