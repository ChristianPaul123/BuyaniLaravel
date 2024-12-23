{{-- @extends('errors::minimal')

@section('title', __('Too Many Requests'))
@section('code', '429')
@section('message', __('Too Many Requests')) --}}


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
    <h1 class="error-code">429</h1>
    <p>Too Many Requests</p>
    <p>You’ve sent too many requests in a short period. Please wait and try again later.</p>
    <button onclick="location.reload()" class="btn btn-primary btn-home">Retry</button>
</div>
@endsection
