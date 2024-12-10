@extends('layouts.app') <!-- Extend your main layout -->

@section('title', 'Product Catalog') <!-- Define the title for this page -->

@push('styles')
<style>
    /* Card Styling */
    .card {
        border: 1px solid #e0e0e0; /* Subtle border for each card */
        border-radius: 0.5rem; /* Rounded corners */
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out, border-color 0.3s ease-in-out;
    }

    .card:hover {
        transform: translateY(-10px); /* Subtle lift effect */
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2); /* Soft shadow */
        border-color: #007bff; /* Change border color on hover */
    }

    /* Card Image Styling */
    .card-img-top-wrapper {
        position: relative;
        width: 100%;
        height: 300px; /* Fixed height for uniformity */
        overflow: hidden;
        border-radius: .25rem .25rem 0 0; /* Rounded top corners */
    }

    .card-img-top {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Maintains aspect ratio while filling the container */
        transition: transform 0.3s ease-in-out;
    }

    .card:hover .card-img-top {
        transform: scale(1.05); /* Slight zoom effect on the image */
    }

    /* Favorite Button Active State */
    .btn-outline-danger.active i {
        color: red; /* Solid red heart for favorited items */
    }

    /* Pagination Styling */
    .pagination {
        display: flex;
        justify-content: center;
        padding: 1rem 0;
    }

    .pagination .page-item {
        margin: 0 0.25rem;
    }

    .pagination .page-item.active .page-link {
        background-color: #69a543; /* Primary color */
        color: white;
        border-color: #5f8d4e;
    }

    .pagination .page-link {
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }

    .pagination .page-link:hover {
        background-color: #f39634;
        color: white;
    }

    /* Search Bar Sticky */
    form.d-flex {
        position: sticky;
        top: 0;
        z-index: 1020; /* Ensure it's above other content */
        background: #f8f9fa;
        padding: 0.5rem;
        border-radius: 0.5rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Overlay for Error Popup */
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1040;
    }

    .error-popup {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: white;
        padding: 2rem;
        border-radius: 0.5rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        z-index: 1050;
        width: 90%;
        max-width: 400px;
        text-align: center;
    }

    .error-popup .error-icon {
        font-size: 3rem;
        color: red;
    }

    .error-popup h3 {
        margin-top: 1rem;
        color: #333;
    }

    .error-popup p {
        color: #666;
    }

    /* Responsive Adjustments for Small Screens */
    @media (max-width: 768px) {
        .card-img-top-wrapper {
            height: 200px; /* Adjust image height for smaller screens */
        }

        form.d-flex {
            padding: 0.25rem;
        }

        .pagination .page-link {
            width: 30px;
            height: 30px;
        }
    }

</style>

@endpush

@section('x-content')

@include('user.includes.navbar-consumer')

<div class="main-content-wrapper pt-3">
        <!-- All your main page content goes here -->
    <div class="container container-fluid mt-3">
    <!-- Navbar -->
    <section class="p-3">
        @livewire('product-show')
    <section>
    </div>
</div>
@endsection

{{-- etong part below ayaw nya mag run pa, pero ayos yan na code --}}
@push('scripts')
<script>
    function closePopup() {
        const overlay = document.getElementById('overlay');
        const popup = document.querySelector('.error-popup');

        // Add the hidden class to trigger the fade-out animation
        overlay.classList.add('hidden');
        popup.classList.add('hidden');

        // After animation ends, hide the elements entirely
        setTimeout(() => {
            overlay.style.display = 'none';
            popup.style.display = 'none';
        }, 300); // Match the duration of the animation
    }

    function showPopup() {
        const overlay = document.getElementById('overlay');
        const popup = document.querySelector('.error-popup');

        // Show elements and remove hidden class for fade-in animation
        overlay.style.display = 'block';
        popup.style.display = 'block';
        overlay.classList.remove('hidden');
        popup.classList.remove('hidden');
    }
</script>
@endpush


