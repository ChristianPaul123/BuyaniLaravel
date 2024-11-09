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
    .message {
        color: black;
        font-size: 25px;
    }




    .row {
        display: flex;
        justify-content: flex-start;
        flex-wrap: wrap;
    }

    .card {
        width: 100%;
        margin-bottom: 1rem;
    }

    .containerN{
        display: flex;
        justify-content: space-between;
        align-items: baseline;
    }

    .pagination {
        justify-content: flex-end;
    }


</style>
@endpush

@section('x-content')
<body>
    @include('user.includes.navbar-consumer')

<div class="main-content-wrapper pt-3">
        <!-- All your main page content goes here -->
    <div class="container container-fluid mt-3">
    <!-- Navbar -->
    <section class="p-3">
        <livewire:user-product />
    <section>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Your custom scripts for this page go here
</script>
@endpush

