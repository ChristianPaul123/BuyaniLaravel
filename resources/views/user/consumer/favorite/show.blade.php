@extends('layouts.app') <!-- Extend your main layout -->

@section('title', 'My Favorites') <!-- Page title -->

@push('styles')
<style>
    /* Wishlist Page Styles */
    .wishlist-header {
        text-align: center;
        padding: 2rem 0;
        font-family: 'Arial', sans-serif;
        color: #175593;
    }

    .wishlist-header i {
        font-size: 3rem;
        color: #ff6b6b;
    }

    .wishlist-header h1 {
        margin-top: 0.5rem;
        font-size: 2rem;
        font-weight: bold;
    }

    .wishlist-container {
        margin: 2rem auto;
        max-width: 1200px;
    }

    .wishlist-table {
        width: 100%;
        border-collapse: collapse;
        margin: 1.5rem 0;
    }

    .wishlist-table th, .wishlist-table td {
        padding: 1rem;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .wishlist-table th {
        font-weight: bold;
        color: #333;
        text-transform: uppercase;
    }

    .wishlist-table img {
        width: 80px;
        height: auto;
        border-radius: 5px;
    }

    .wishlist-table .stock-status {
        font-weight: bold;
        color: #2d6a4f;
    }

    .wishlist-table .out-of-stock {
        color: #ff4d4d;
    }

    .btn-add-to-cart {
        background-color: #2d6a4f;
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .btn-add-to-cart:hover {
        background-color: #175593;
    }

    .btn-delete {
        background-color: transparent;
        border: none;
        color: #ff6b6b;
        font-size: 1.5rem;
        cursor: pointer;
        transition: color 0.3s;
    }

    .btn-delete:hover {
        color: #ff4d4d;
    }

    .wishlist-empty {
        text-align: center;
        color: #999;
        font-size: 1.5rem;
    }

    .min-height {
        min-height: 100vh;
    }
</style>
@endpush

@section('content')
@include('user.includes.navbar-consumer')
<div class="main-content-wrapper">
 @livewire('consumer.user-favorites')
@endsection

@section('scripts')
<script>
    // You can add JavaScript functionality if needed
</script>
@endsection
