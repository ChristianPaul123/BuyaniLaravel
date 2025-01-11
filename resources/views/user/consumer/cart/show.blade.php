@extends('layouts.app') <!-- Extending the parent layout -->

@section('title', 'Shopping Cart') <!-- Defining a title for this view -->

@push('styles')
<style>
    .small-input {
        width: 80px; /* Adjust this value to change the width */
    }

    .min-height {
        min-height: 100vh; /* Adjust this value to change the height */
    }
</style>
@endpush
@section('content')
     @include('user.includes.navbar-consumer')

    <!-- Placeholder for AJAX Messages -->
    @livewire('consumer.user-cart',['cart' => $cart])
@endsection

@section('scripts')
@endsection
