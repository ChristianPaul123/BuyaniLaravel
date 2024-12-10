@extends('layouts.app') <!-- Extend your main layout -->

@section('title', 'Product Catalog') <!-- Define the title for this page -->

@push('styles')
<style>
    .card-img-top-wrapper {
        position: relative;
        width: 100%;
        height: 300px; /* or any fixed height you desire */
        overflow: hidden; /* Prevent overflow */
    }

    .card-img-top {
        width: 100%;
        height: 100%;
        object-fit: fill; /* Stretches the image to fill the container */
        border-radius: .25rem .25rem 0 0; /* rounded-top for the card */
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


