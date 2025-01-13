@extends('layouts.admin-app') {{-- Extend the main parent layout --}}

@section('title', 'Admin | View Product Suggestion') {{-- Set the page title --}}

@push('styles')
<style>
    .card {
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
        background-color: #fff;
        margin-top: 1rem;
    }
    .card-title {
        font-size: 1.25rem;
        font-weight: 500;
    }
    .form-control-plaintext {
        padding: 0.375rem 0.75rem;
    }
    .btn-back {
        margin-bottom: 15px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('admin.includes.sidebar') {{-- Include the sidebar --}}

        <section class="col-md-10 ml-sm-auto col-lg-10 px-3 py-5 main-section">
            <div class="container-fluid">
                {{-- Header Section --}}
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                    <h1 class="h2" style="font-weight: bold;">View Product Suggestion</h1>
                </div>

                {{-- Back Button --}}
                <button type="button" class="btn btn-primary btn-back" onclick="window.history.back()"><i class="bi bi-arrow-left-circle"> </i> Back to previous</button>

                {{-- Error Messages --}}
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{-- Product Suggestion Details --}}
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Suggestion Details</h4>
                    </div>
                    <div class="card-body">
                        {{-- Suggested Name --}}
                        <div class="form-group">
                            <label for="suggest_name">Suggested Name</label>
                            <p class="form-control-plaintext" id="suggest_name">{{ $suggestion->suggest_name }}</p>
                        </div>

                        {{-- Suggested Description --}}
                        <div class="form-group">
                            <label for="suggest_description">Suggested Description</label>
                            <p class="form-control-plaintext" id="suggest_description">{{ $suggestion->suggest_description }}</p>
                        </div>

                        {{-- Suggestion Image --}}
                        <div class="form-group">
                            <label for="suggest_image">Suggested Image</label>
                            @if($suggestion->suggest_image)
                                <img src="{{ asset('storage/' . $suggestion->suggest_image) }}" alt="Suggested Image" class="img-fluid rounded" style="max-width: 300px;">
                            @else
                                <p class="form-control-plaintext">No image provided.</p>
                            @endif
                        </div>

                        {{-- Total Votes --}}
                        <div class="form-group">
                            <label for="total_vote_count">Total Votes</label>
                            <p class="form-control-plaintext" id="total_vote_count">{{ $suggestion->total_vote_count }}</p>
                        </div>

                        {{-- Suggestion Submitted By --}}
                        <div class="form-group">
                            <label for="submitted_by">Submitted By</label>
                            <p class="form-control-plaintext" id="submitted_by">{{ $suggestion->user->username ?? 'Unknown User' }}</p>
                        </div>
                    </div>

                    {{-- Accept and Reject Buttons --}}
                    <div class="card-footer d-flex justify-content-between">
                        {{-- Accept Suggestion --}}
                        @if (!$suggestion->is_accepted)
                        <form action="{{ route('admin.voted-products.suggestions.accept', $suggestion->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-success" title="Accept">
                                <i class="fa fa-check"></i> Accept
                            </button>
                        </form>
                        @endif

                        {{-- Reject Suggestion --}}
                        <form action="{{ route('admin.voted-products.suggestions.reject', $suggestion->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-danger" title="Reject">
                                <i class="fa fa-times"></i> Reject
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
