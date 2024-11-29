@extends('layouts.app') {{-- Extend the main parent layout --}}

@section('title', 'About Us') {{-- Set the page title --}}

@push('styles')
<style>
    .container{
        height: auto;
        padding: 70px 20px;
        margin-top: 35px;
    }

    /* Card hover effect */
    .card {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    /* Footer animation */
    footer {
        opacity: 0;
        animation: fadeIn 2s forwards;
    }

    @keyframes fadeIn {
        0% {
            opacity: 0;
        }
        100% {
            opacity: 1;
        }
    }

    /* Smooth transition for text when hovered */
    .card-title, .card-text {
        transition: color 0.3s ease;
    }

    .card:hover .card-title {
        color: #007bff;
    }

    .card:hover .card-text {
        color: #555;
    }

    .min-height {
        min-height: 100vh;
    }
</style>
@endpush

@section('x-content')
 @include('user.includes.navbar-consumer')


<!-- About Us Section -->
<section class="min-height">
<div class="container">
    <h1 class="text-center mb-4">Meet Our Team</h1>
    <div class="row text-center">
        <!-- Team Member 1 -->
        <div class="col-md-3">
            <div class="card">
                <img src="{{ asset('img/about_profile/reola_prof.png') }}" class="card-img-top" alt="Member 1">
                <div class="card-body">
                    <h5 class="card-title">Carmilo Kim Reola</h5>
                    <p class="card-text">CEO & Founder</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla euismod sapien vel urna gravida, a luctus lectus vulputate.</p>
                </div>
            </div>
        </div>
        <!-- Team Member 2 -->
        <div class="col-md-3">
            <div class="card">
                <img src="{{ asset('img/about_profile/chapman_prof.png') }}" class="card-img-top" alt="Member 2">
                <div class="card-body">
                    <h5 class="card-title">Kian Chester Chapman</h5>
                    <p class="card-text">Chief Designer</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla euismod sapien vel urna gravida, a luctus lectus vulputate.</p>
                </div>
            </div>
        </div>
        <!-- Team Member 3 -->
        <div class="col-md-3">
            <div class="card">
                <img src="{{ asset('img/about_profile/espares_prof.png') }}" class="card-img-top" alt="Member 3">
                <div class="card-body">
                    <h5 class="card-title">Christian Paul Espares</h5>
                    <p class="card-text">Lead Developer</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla euismod sapien vel urna gravida, a luctus lectus vulputate.</p>
                </div>
            </div>
        </div>
        <!-- Team Member 4 -->
        <div class="col-md-3">
            <div class="card">
                <img src="{{ asset('img/about_profile/vista_prof.png') }}" class="card-img-top" alt="Member 4">
                <div class="card-body">
                    <h5 class="card-title">Melinda Vista</h5>
                    <p class="card-text">Marketing Manager</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla euismod sapien vel urna gravida, a luctus lectus vulputate.</p>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection
