@extends('layouts.admin-app') {{-- Extend the main parent layout --}}

@section('title', 'Admin | Order-view') {{-- Set the page title --}}

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
    .scroll-to-bottom {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }
    .scroll-to-bottom:hover {
        background-color: #0056b3;
    }

    .main-section {
    min-height: 90vh;
    max-height: 90vh;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('admin.includes.sidebar')
        <section class="col-md-10 ml-sm-auto col-lg-10 px-3 py-1 overflow-y-scroll main-section">
            <div class="container mt-4">
                {{-- Back button --}}
                <div class="d-flex justify-content-start pt-1 pb-2 mb-3 border-bottom">
                    <button type="button" class="btn btn-primary" onclick="window.history.back()"> &#9754; Back to previous</button>
                </div>
                {{-- First Row: User Information --}}
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>User Information</h4>
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
                                    @elseif($order->order_status == \App\Models\Order::OUT_FOR_DELIVERY) bg-info
                                @else bg-primary @endif">
                                {{ $order->status_label }}
                            </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Second Row: Address Information --}}
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Address Information</h4>
                            </div>
                            <div class="card-body">
                                <p><strong>Street:</strong> {{ $order->customer_street }}</p>
                                <p><strong>City:</strong> {{ $order->customer_city }}</p>
                                <p><strong>Barangay:</strong> {{ $order->customer_barangay }}</p>
                                <p><strong>Province:</strong> {{ $order->customer_state }}</p>
                                <p><strong>Zip Code:</strong> {{ $order->customer_zip }}</p>
                                <p><strong>Country:</strong> {{ $order->customer_country }}</p>

                            </div>
                        </div>
                    </div>
                </div>

                {{-- Third Row: Order Items --}}
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
                                            <th>Product Price</th>
                                            <th>Category Specifcation</th>
                                            <th>Sub Category Specification</th>
                                            <th>Product Details</th>
                                            <th>Quantity</th>
                                            <th>Total Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->orderItems as $item)
                                        <tr>
                                            <td>{{ $item->product->product_name ?? 'N/A' }}</td>
                                            <td>{{ $item->productSpecification->specification_name ?? 'N/A' }}</td>
                                            <td>{{ $item->productSpecification->product_price ?? 'N/A' }}</td>
                                            <td>{{ $item->product->category->category_name }}</td>
                                            <td>{{ $item->product->subcategory->sub_category_name }}</td>
                                            <td>{{  $item->product->product_details ?? 'N/A' }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>${{ number_format($item->price, 2) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Fourth Row: Payment Method --}}
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Payment Method</h4>
                            </div>
                            <div class="card-body">
                                <p><strong>Method:</strong> {{ $order->payment->payment_method ?? 'N/A' }}</p>
                                <p><strong>Transaction ID:</strong> {{ $order->payment->payment_pic ?? 'N/A' }}</p>
                                <p><strong>Payment Status:</strong> {{ $order->payment->payment_status ?? 'Pending' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Fifth Row: Assign Delivery Employee --}}
                @if($order->order_status !== 1 && $order->order_status !== 2)
                    @livewire('admin.assign-employee', ['orderId' => $order->id]) {{-- Include the livewire component --}}
                @endif
                {{-- Fifth Row: Tracking Information --}}
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Tracking Information</h4>
                            </div>
                            <div class="card-body">
                                <ul>
                                    @forelse ($order->trackings as $tracking)
                                    <li>
                                        <strong>Status:</strong> {{ $tracking->tracking_status }}<br>
                                        <strong>Time:</strong> {{ $tracking->tracking_time }}<br>
                                        <strong>Info:</strong> {{ $tracking->tracking_info }}
                                    </li>
                                    @empty
                                    <p class="text-center">No tracking information available yet</p>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sixth Row: Actions --}}
                @if ($order->order_type == 1 && $order->order_status === \App\Models\Order::STATUS_STANDBY) {{-- Delivery --}}
                    <div class="row mb-4">
                        <div class="col-12 text-center">
                            <form action="{{ route('admin.orders.accept', $order->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button class="btn btn-success">Accept Order</button>
                            </form>
                            <form action="{{ route('admin.orders.reject', $order->id) }}" method="GET" style="display:inline-block;">
                                @csrf
                                <button class="btn btn-danger">Cancel Order</button>
                            </form>
                        </div>
                    </div>
                @endif
                {{-- Seventh Row: Actions --}}
                @if ($order->order_type == 1 &&
                        ($order->order_status === \App\Models\Order::STATUS_TO_PAY
                            || $order->order_status === \App\Models\Order::STATUS_TO_SHIP
                            || $order->order_status === \App\Models\Order::OUT_FOR_DELIVERY
                        )
                    ) {{-- Delivery --}}
                    <div class="row mb-4">
                        <div class="col-12 text-center">
                            <form action="{{ route('admin.orders.reject', $order->id) }}" method="GET" style="display:inline-block;">
                                @csrf
                                <button class="btn btn-danger">Cancel Order</button>
                            </form>
                        </div>
                    </div>
                @endif
        </section>
    </div>
</div>
@endsection

@section('scripts')

@endsection
