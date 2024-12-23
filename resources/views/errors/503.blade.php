{{-- @extends('errors::minimal')

@section('title', __('Service Unavailable'))
@section('code', '503')
@section('message', __('Service Unavailable')) --}}


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
    <h1 class="error-code">503</h1>
    <p>Sorry! The service is currently unavailable.</p>
    <p>We might be undergoing scheduled maintenance or facing temporary issues. Please try again later.</p>
    <button onclick="location.reload()" class="btn btn-primary btn-home">Retry</button>
</div>
@endsection
