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
 @include('user.includes.navbar-farmer')

<!-- About Us Section -->
<div class="container about-section" style="background-image: url('{{ asset('img/stockImg4.png') }}'); background-repeat: no-repeat; background-size: cover; background-position: center;">
    <h2 class="text-center mb-4">About Us</h2>
    <p class="text-center">We are a team of passionate individuals committed to delivering the best services to our clients.</p>
    <div class="row">
        <div class="col-lg-3 col-md-6 text-center team-member">
            <img src="https://via.placeholder.com/150" class="rounded-circle mb-2" alt="Team Member">
            <h4>John Doe</h4>
            <p>Founder & CEO</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
        <div class="col-lg-3 col-md-6 text-center team-member">
            <img src="https://via.placeholder.com/150" class="rounded-circle mb-2" alt="Team Member">
            <h4>Jane Smith</h4>
            <p>Chief Operating Officer</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
        <div class="col-lg-3 col-md-6 text-center team-member">
            <img src="https://via.placeholder.com/150" class="rounded-circle mb-2" alt="Team Member">
            <h4>Emily Johnson</h4>
            <p>Chief Technology Officer</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
        <div class="col-lg-3 col-md-6 text-center team-member">
            <img src="https://via.placeholder.com/150" class="rounded-circle mb-2" alt="Team Member">
            <h4>Michael Brown</h4>
            <p>Marketing Manager</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
    </div>
</div>
@endsection
