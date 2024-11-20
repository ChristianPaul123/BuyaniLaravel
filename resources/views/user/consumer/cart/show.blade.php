@extends('layouts.app') <!-- Extending the parent layout -->

@section('title', 'Show Cart Page') <!-- Defining a title for this view -->

@push('styles')
<style>
    .small-input {
        width: 80px; /* Adjust this value to change the width */
    }
</style>
@endpush
@section('content')
     @include('user.includes.navbar-consumer')

    <!-- Placeholder for AJAX Messages -->
    @livewire('user-cart',['cart' => $cart]);
@endsection

@section('scripts')
@endsection
