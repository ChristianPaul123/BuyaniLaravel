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

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: rgba(0, 0, 0, 0.5);
        border-radius: 50%;
        padding: 5px;
    }

    .card {
        border: none;
        border-radius: 8px;
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .btn-outline-primary:hover {
        background-color: #2d6a4f;
        color: white;
        border-color: #2d6a4f;
    }

    .btn-outline-danger:hover {
        background-color: #ff4d4d;
        color: white;
        border-color: #ff4d4d;
    }
</style>

<style>
    /* Keyframe animations */
    @keyframes fadeInDown {
        from {
            transform: translate(-50%, -55%); /* Start from above the screen */
            opacity: 0;
        }
        to {
            transform: translate(-50%, -50%); /* Center in the screen */
            opacity: 1;
        }
    }

    @keyframes fadeOutUp {
        from {
            transform: translate(-50%, -50%); /* Start from center */
            opacity: 1;
        }
        to {
            transform: translate(-50%, -55%); /* Move up to above the screen */
            opacity: 0;
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 0.6;
        }
    }

    @keyframes fadeOut {
        from {
            opacity: 0.6;
        }
        to {
            opacity: 0;
        }
    }

    /* Overlay styles */
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        z-index: 999;
        animation: fadeIn 0.2s ease-out forwards; /* Fade in animation for the overlay */
    }

    .overlay.hidden {
        animation: fadeOut 0.2s ease-in forwards; /* Fade out animation for the overlay */
    }

    /* Error popup styles */
    .error-popup {
        width: 400px;
        background-color: #ffffff;
        color: #842029;
        border: 1px solid black;
        border-radius: 5px;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        z-index: 1000;
        animation: fadeInDown 0.3s ease-out forwards; /* Slide down animation for the modal */
    }

    .error-popup.hidden {
        animation: fadeOutUp 0.3s ease-in forwards; /* Slide up animation for the modal */
    }

    /* Container contents for popup */
    .container-contents {
        padding: 20px;
    }

    /* Error icon styles */
    .error-popup .error-icon {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 120px;
        background-color: #e85e6c;
        font-size: 60px;
    }

    .error-icon .icon {
        color: #ffffff;
    }

    /* Button styles */
    button {
        background-color: #ffc107;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }

    .error-popup button:hover {
        background-color: #e0a800;
    }

    /* Close button styles */
    .error-popup .bi-x-lg {
        color: #fff;
        position: absolute;
        top: 10px;
        right: 10px;
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

