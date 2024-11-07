@extends('layouts.app') <!-- Extending the parent layout -->

@section('title', 'Profile page') <!-- Defining a title for this view -->

@push('styles')
<style>
    .small-input {
        width: 80px; /* Adjust this value to change the width */
    }
    <style>
        .profile-pic {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
        }
        .profile-section {
            margin-top: 20px;
        }
    </style>
</style>
@endpush
@section('content')
    @include('user.includes.navbar-farmer')

    @livewire('user-profile-farmer')

@endsection
@section('scripts')
@endsection
