@extends('layouts.app') {{-- Extend the main parent layout --}}

@section('title', 'About Us') {{-- Set the page title --}}

@push('styles')
<style>
    .about-section {
        padding: 60px 0;
        color: white;
    }
    .team-member {
        margin-bottom: 30px;
    }

</style>
@endpush

@section('x-content')
 @include('user.includes.navbar-consumer')

<!-- About Us Section -->
<div class="container about-section" style="background-image: url('{{ asset('img/background.jpg') }}'); background-repeat: no-repeat; background-size: cover; background-position: center;">
    <h2 class="text-center mb-4 text-white">About Us</h2>
    <p class="text-center text-white">We are a team of passionate individuals committed to delivering the best services to our clients.</p>
    <div class="row">
        <!-- Team Member 1 -->
        <div class="col-lg-3 col-md-6 text-center team-member">
            <img src="{{ asset('img/about_profile/reola_prof.png') }}" class="rounded-circle mb-2 img-fluid" style="width: 150px; height: 150px; object-fit: cover;" alt="Team Member">
            <h4 class="text-white">Carmilo Kim Reola</h4>
            <p class="text-white">Founder & CEO</p>
            <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>

        <!-- Team Member 2 -->
        <div class="col-lg-3 col-md-6 text-center team-member">
            <img src="{{ asset('img/about_profile/chapman_prof.png') }}" class="rounded-circle mb-2 img-fluid" style="width: 150px; height: 150px; object-fit: cover;" alt="Team Member">
            <h4 class="text-white">Kian Chester Chapman</h4>
            <p class="text-white">Chief Operating Officer</p>
            <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>

        <!-- Team Member 3 -->
        <div class="col-lg-3 col-md-6 text-center team-member">
            <img src="{{ asset('img/about_profile/espares_prof.png') }}" class="rounded-circle mb-2 img-fluid" style="width: 150px; height: 150px; object-fit: cover;" alt="Team Member">
            <h4 class="text-white">Christian Paul Espares</h4>
            <p class="text-white">Chief Technology Officer</p>
            <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>

        <!-- Team Member 4 -->
        <div class="col-lg-3 col-md-6 text-center team-member">
            <img src="{{ asset('img/about_profile/vista_prof.png') }}" class="rounded-circle mb-2 img-fluid" style="width: 150px; height: 150px; object-fit: cover;" alt="Team Member">
            <h4 class="text-white">Melinda Vista</h4>
            <p class="text-white">Marketing Manager</p>
            <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
    </div>
</div>

@endsection
