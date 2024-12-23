{{-- @extends('errors::minimal')

@section('title', __('Page Expired'))
@section('code', '419')
@section('message', __('Page Expired')) --}}

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
    <h1 class="error-code">419</h1>
    <p>Page Expired</p>
    <p>Your session has expired. Please refresh the page or go back to continue.</p>
    <button onclick="location.reload()" class="btn btn-primary btn-home">Refresh</button>
</div>
@endsection
