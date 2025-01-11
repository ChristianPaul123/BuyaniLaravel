@extends('layouts.admin-app') {{-- Extend the main parent layout --}}

@section('title', 'Admin | Rejected Order') {{-- Set the page title --}}

@push('styles')
<style>
    .tab-content .card {
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
        background-color: #fff;
        margin-top: 1rem;
    }
    .card-title {
        font-size: 1.25rem;
        font-weight: 500;
    }
    table {
        width: 100%;
        margin-bottom: 1rem;
        color: #212529;
        border-collapse: collapse;
    }
    table th, table td {
        padding: 0.75rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
    }
    table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #dee2e6;
    }

    .main-section {
        min-height: 90vh;
        max-height: 90vh;
    }
    .tab-pane {
        margin-top: 20px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('admin.includes.sidebar')
        <section class="col-md-10 ml-sm-auto col-lg-10 px-3 py-5 overflow-y-scroll main-section">
            <div class="container mt-4">
                        {{-- Back button --}}
                <div class="d-flex justify-content-start pt-1 pb-2 mb-3 border-bottom">
                    <button type="button" class="btn btn-primary" onclick="window.history.back()"><i class="bi bi-arrow-left-circle"> </i>Back to previous</button>
                </div>
                <!-- First Row: Order Information -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Order Information</h4>
                            </div>
                            <div class="card-body">
                                <p><strong>Order Number:</strong> {{ $order->order_number }}<br>
                                <strong>Username:</strong>   {{ $order->user->username ?? 'Guest' }}<br>
                                <strong>First Name:</strong> {{ $order->user->first_name ?? 'Guest'}}<br>
                                <strong>Last Name:</strong> {{ $order->user->last_name ?? 'Guest'}}<br>
                                <strong>Customer Email:</strong> {{ $order->customer_email }}<br>
                                <strong>Customer Phone:</strong> {{ $order->customer_phone }}<br>
                                <strong>Order Status:</strong>
                                <span class="badge
                                @if($order->order_status == \App\Models\Order::STATUS_STANDBY) bg-secondary
                                @elseif($order->order_status == \App\Models\Order::STATUS_TO_PAY) bg-warning
                                @elseif($order->order_status == \App\Models\Order::STATUS_TO_SHIP) bg-info
                                @elseif($order->order_status == \App\Models\Order::STATUS_COMPLETED) bg-success
                                @elseif($order->order_status == \App\Models\Order::STATUS_CANCELLED) bg-danger
                                @else bg-primary @endif">
                                {{ $order->status_label }}
                                </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Second Row: Order Items -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Order Items</h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Product Specification</th>
                                            <th>Category Specifcation</th>
                                            <th>Sub Category Specification</th>
                                            <th>Product Details</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->orderItems as $item)
                                        <tr>
                                            <td>{{ $item->product->product_name ?? 'N/A' }}</td>
                                            <td>{{ $item->productSpecification->specification_name ?? 'N/A' }}</td>
                                            <td>{{ $item->product->category->category_name }}</td>
                                            <td>{{ $item->product->subcategory->sub_category_name }}</td>
                                            <td>{{ $item->product->product_details ?? 'N/A' }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>${{ number_format($item->price, 2) }}</td>
                                            <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Third Row: Payment Information -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Payment Information</h4>
                            </div>
                            <div class="card-body">
                                <p><strong>Payment Method:</strong> {{ $order->payment->payment_method ?? 'N/A' }}</p>
                                <p><strong>Transaction ID:</strong> {{ $order->payment->payment_pic ?? 'N/A' }}</p>
                                <p><strong>Payment Status:</strong> {{ $order->payment->payment_status ?? 'Refunded' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Fourth Row: Order Cancellation -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Order Cancellation</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.orders.processCancel', $order->id) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="reason">Cancellation Reason:</label>
                                        <input type="text" id="reason" name="reason" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="notes">Additional Notes:</label>
                                        <textarea id="notes" name="notes" class="form-control" rows="4"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-danger">Submit Cancellation</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
