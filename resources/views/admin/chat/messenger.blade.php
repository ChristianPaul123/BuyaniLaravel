@extends('layouts.app-admin') {{-- Extend the main admin layout --}}

@section('title', 'Admin | Message') {{-- Set the page title dynamically --}}

@push('styles')
{{-- Add any page-specific styles --}}
<style>
    .main-section {
        max-height: 35rem;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        {{-- Include the sidebar --}}
        @include('admin.includes.sidebar')

        {{-- Main content section --}}
        <section role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Chats</h1>
            </div>

            {{-- Display session messages --}}
            @if (session('message'))
                <div class="alert alert-success mx-3 my-2 px-3 py-2">
                    <button type="button" class="close btn btn-success" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('message') }}
                </div>
            @endif

            {{-- Display errors, if any --}}
            @if ($errors->any())
                <div class="alert alert-danger mx-3 my-2 px-3 py-2">
                    <button type="button" class="close btn btn-danger" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Main content area for chats --}}
            <div>
                {{-- Placeholder for chat content --}}
                <p>Here you can manage admin chats.</p>
            </div>
        </section>
    </div>
</div>
@endsection

@section('scripts')
{{-- Add any page-specific scripts --}}
<script>
    window.addEventListener('popstate', function(event) {
        // If the user presses the back button, log them out
        window.location.href = "{{ route('admin.logout') }}";
    });
</script>
@endsection

