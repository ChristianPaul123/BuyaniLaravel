@extends('layouts.admin-app') {{-- Extend the main parent layout --}}

@section('title', 'Admin | Edit Order Rating') {{-- Set the page title --}}

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
                    <h1 class="h2">View Order Rating</h1>
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

                {{-- Edit Order Rating Form --}}
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">View Rating for Order: {{ $orderRating->order->id ?? 'Unknown Order' }}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.orderRating.update', $orderRating->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            {{-- Order --}}
                            <div class="form-group">
                                <label for="order_id">Order</label>
                                <p class="form-control-plaintext" id="order_id">{{ $orderRating->order->id ?? 'Unknown Order' }}</p>
                            </div>

                            {{-- User --}}
                            <div class="form-group">
                                <label for="user_name">User</label>
                                <p class="form-control-plaintext" id="user_name">{{ $orderRating->user->username ?? 'Unknown User' }}</p>
                            </div>

                            {{-- Rating --}}
                            <div class="form-group">
                                <label for="rating">Delivery Rating</label>
                                <p class="form-control-plaintext" id="rating">{{ $orderRating->delivery_rating }}</p>
                            </div>

                            {{-- Comment --}}
                            <div class="form-group my-3">
                                <label for="comment">Comment</label>
                                <p class="form-control-plaintext" id="comment">{{ $orderRating->comment }}</p>
                            </div>

                            {{-- Deactivation --}}
                            <div class="form-group my-3">
                                <label for="deactivated_status">Deactivated Status</label>
                                <select class="form-control" id="deactivated_status" name="deactivated_status">
                                    <option value="0" {{ $orderRating->deactivated_status == 0 ? 'selected' : '' }}>Active</option>
                                    <option value="1" {{ $orderRating->deactivated_status == 1 ? 'selected' : '' }}>Deactivated</option>
                                </select>
                            </div>

                            {{-- Submit Button --}}
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block">Update Status</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
