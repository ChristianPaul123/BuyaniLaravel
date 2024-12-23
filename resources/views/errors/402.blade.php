{{-- @extends('errors::minimal')

@section('title', __('Payment Required'))
@section('code', '402')
@section('message', __('Payment Required')) --}}

@extends('errors::layout')

@push('styles')
<style>
    body, html {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        background-color: #f8f9fa;
    }

    .error-code {
        font-size: 6rem;
        font-weight: bold;
        color: #dc3545;
    }

    .btn-home {
        margin-top: 20px;
    }
</style>
@endpush

@section('content')
<div class="container">
    <h1 class="error-code">402</h1>
    <p>Payment Required</p>
    <p>Access to this resource requires payment. Please complete the payment to proceed.</p>
    <button onclick="window.location.href='{{ url('/') }}'" class="btn btn-primary btn-home">Go to Home</button>
</div>
@endsection
