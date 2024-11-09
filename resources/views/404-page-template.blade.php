{{-- contact.blade.php --}}

@extends('layouts.app') {{-- Assuming 'app.blade.php' is the base layout --}}

@section('title', '404 NOT FOUND') {{-- Set the title for this page --}}

{{-- Add Page-Specific Styles --}}
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

@section('x-content')

<div class="container">
    <h1 class="error-code">404</h1>
    <p>Oops! The page you're looking for isn't here.</p>
    <p>It might have been removed, renamed, or did not exist in the first place.</p>
    <button onclick="history.back()" class="btn btn-primary btn-back">Go Back</button>
</div>
@endsection

@push('scripts')
{{-- Any page-specific scripts can be added here --}}
@endpush


