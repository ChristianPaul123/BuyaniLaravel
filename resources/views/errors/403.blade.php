{{-- @extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden')) --}}


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
    <h1 class="error-code">403</h1>
    <p>Forbidden</p>
    <p>You don’t have permission to access this page or resource.</p>
    <button onclick="window.history.back()" class="btn btn-primary btn-home">Go Back</button>
</div>
@endsection
@section('message', __($exception->getMessage() ?: 'Forbidden'))
