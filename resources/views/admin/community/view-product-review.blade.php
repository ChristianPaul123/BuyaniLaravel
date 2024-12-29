@extends('layouts.admin-app') {{-- Extend the main parent layout --}}

@section('title', 'Admin | Edit Product Rating') {{-- Set the page title --}}

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
    .form-control:focus {
        box-shadow: none;
        border-color: #80bdff;
    }
    .main-section {
        max-height: 35rem;
        overflow-y: auto;
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
                    <h1 class="h2">Edit Product Rating</h1>
                </div>

                {{-- Back Button --}}
                <button type="button" class="btn btn-primary btn-back" onclick="window.history.back()">&#9754; Back to previous</button>

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

                {{-- Edit Product Rating Form --}}
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Rating for Product: {{ $productRating->product->name ?? 'Unknown Product' }}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.productRating.update', $productRating->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            {{-- Product --}}
                            <div class="form-group">
                                <label for="product_name">Product</label>
                                <input type="text" class="form-control" id="product_name" value="{{ $productRating->product->name ?? 'Unknown Product' }}" disabled>
                            </div>

                            {{-- User --}}
                            <div class="form-group">
                                <label for="user_name">User</label>
                                <input type="text" class="form-control" id="user_name" value="{{ $productRating->user->username ?? 'Unknown User' }}" disabled>
                            </div>

                            {{-- Rating --}}
                            <div class="form-group">
                                <label for="rating">Rating</label>
                                <select class="form-control" id="rating" name="rating" required>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}" {{ $productRating->rating == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>

                            {{-- Comment --}}
                            <div class="form-group my-3">
                                <label for="comment">Comment</label>
                                <textarea class="form-control" style="resize: none;" id="comment" name="comment" rows="3" required>{{ $productRating->comment }}</textarea>
                            </div>

                            {{-- Deactivated Status --}}
                            <div class="form-group my-3">
                                <label for="deactivated_status">Deactivated Status</label>
                                <select class="form-control" id="deactivated_status" name="deactivated_status">
                                    <option value="0" {{ $productRating->deactivated_status == 0 ? 'selected' : '' }}>Active</option>
                                    <option value="1" {{ $productRating->deactivated_status == 1 ? 'selected' : '' }}>Deactivated</option>
                                </select>
                            </div>

                            {{-- Deactivated Date --}}
                            <div class="form-group my-3">
                                <label for="deactivated_date">Deactivated Date</label>
                                <input type="date" class="form-control" id="deactivated_date" name="deactivated_date" value="{{ $productRating->deactivated_date }}">
                            </div>

                            {{-- Submit Button --}}
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block">Update Product Rating</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
