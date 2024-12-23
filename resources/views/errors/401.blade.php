{{-- @extends('errors::minimal')

@section('title', __('Unauthorized'))
@section('code', '401')
@section('message', __('Unauthorized')) --}}

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
    <h1 class="error-code">401</h1>
    <p>Unauthorized</p>
    <p>You’re not authorized to access this page. Please log in to continue.</p>
    <button onclick="window.location.href='{{ route('user.login') }}'" class="btn btn-primary btn-home">Log In</button>
</div>
@endsection

