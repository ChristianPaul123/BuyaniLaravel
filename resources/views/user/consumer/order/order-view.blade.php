@extends('layouts.app')

@section('title', 'Order Details')

@push('styles')
    <style>
        .status-to-standby {
            background-color: #6c757d;
            color: white;
        }

        .status-to-pay {
            background-color: #ffc107;
            color: black;
        }

        .status-to-ship {
            background-color: #0d6efd;
            color: white;
        }

        .status-completed {
            background-color: #28a745;
            color: white;
        }

        .status-cancelled {
            background-color: #dc3545;
            color: white;
        }

        .status-out-for-delivery {
            background-color: #6a17b8;
            color: white;
        }
    </style>
@endpush

@section('content')
    <section>
        <div class="container mt-4">
            <h2>Order Details</h2>

            <!-- Order Summary -->

            @php
                $totalQuantity = 0;
            @endphp

            @foreach ($order->orderItems as $item)
                @php
                    $totalQuantity += $item->quantity;
                @endphp
            @endforeach

            <div class="card mb-4">
                <div class="card-body">
                    <h5>Order Summary</h5>
                    <p><strong>Order Number:</strong> {{ $order->order_number }}</p>
                    <p><strong>Status:</strong>
                        <span
                            class="badge {{ 'status-' . strtolower(str_replace(' ', '-', $order->getStatusLabelAttribute())) }}">
                            {{ $order->getStatusLabelAttribute() }}
                        </span>
                    </p>
                    <p><strong>Total Quantity:</strong> {{ $totalQuantity }}</p>
                    <p><strong>Overall Weight:</strong> {{ $order->overall_orderKG }} KG</p>
                    <p><strong>Total Price:</strong> ₱{{ number_format($order->total_price, 2) }}</p>
                </div>
            </div>

            <!-- Shipping Information -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5>Shipping Information</h5>
                    <p><strong>Name:</strong> {{ $order->customer_name }}</p>
                    <p><strong>Phone:</strong> {{ $order->customer_phone }}</p>
                    <p><strong>Email:</strong> {{ $order->customer_email }}</p>
                    <p><strong>House Number:</strong> {{ $order->customer_house_number }}</p>
                    <p><strong>Street:</strong> {{ $order->customer_street }}</p>
                    <p><strong>Barangay:</strong> {{ $order->customer_barangay }}</p>
                    <p><strong>City:</strong> {{ $order->customer_city }}</p>
                    <p><strong>State:</strong> {{ $order->customer_state }}</p>
                    <p><strong>Zip Code:</strong> {{ $order->customer_zip }}</p>
                    <p><strong>Country:</strong> {{ $order->customer_country }}</p>
                </div>
            </div>

            <!-- Order Items -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5>Order Items</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Specification</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total Weight</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderItems as $item)
                                <tr>
                                    <td>{{ $item->product->product_name ?? 'N/A' }}</td>
                                    <td>{{ $item->productSpecification->specification_name ?? 'N/A' }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>₱{{ number_format($item->price, 2) }}</td>
                                    <td>{{ $item->overall_kg }} KG</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Payment Information -->
            @if ($order->payment)
                <div class="card mb-4">
                    <div class="card-body">
                        <h5>Payment Information</h5>
                        <p><strong>Payment Method:</strong> {{ ucfirst($order->payment->payment_method) }}</p>
                        <p><strong>Payment Amount:</strong> ₱{{ number_format($order->payment->payment_amount, 2) }}</p>
                        <p><strong>Payment Status:</strong>
                            @if ($order->payment->payment_status === 0)
                                Pending
                            @elseif ($order->payment->payment_status === 1)
                                @if ($order->getStatusLabelAttribute() === 'Cancelled')
                                    Refunded
                                @else
                                    Paid
                                @endif
                            @else
                                Unknown
                            @endif
                        </p>
                        @if ($order->payment->payment_pic)
                            <p><strong>Payment Receipt:</strong></p>
                            <img src="{{ asset($order->payment->payment_pic) }}" alt="Payment Receipt"
                                style="max-width: 300px;">
                        @endif
                    </div>
                </div>
            @endif

            @if ($order->order_status == 4 && $order->rating)
                <!-- Rating Information -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5>Rating Information</h5>

                        <!-- Delivery Rating -->
                        <p><strong>Delivery Rating:</strong>
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="{{ $i <= $order->rating->delivery_rating ? 'fa-solid fa-star' : 'fa-regular fa-star' }}"
                                    style="font-size: 2rem; color: {{ $i <= $order->rating->delivery_rating ? '#FFD700' : '#D3D3D3' }};"></i>
                            @endfor
                        </p>

                        <!-- Overall Rating -->
                        <p><strong>Overall Rating:</strong>
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="{{ $i <= $order->rating->rating ? 'fa-solid fa-star' : 'fa-regular fa-star' }}"
                                    style="font-size: 2rem; color: {{ $i <= $order->rating->rating ? '#FFD700' : '#D3D3D3' }};"></i>
                            @endfor
                        </p>

                        <!-- Comment -->
                        <p><strong>Comment:</strong> {{ $order->rating->comment }}</p>
                    </div>
                </div>
            @endif


            <!-- Action Buttons -->
            <div class="d-flex justify-content-end">
                <!-- Always visible: Return Button -->
                <button class="btn btn-danger me-2" onclick="window.history.back()">Return</button>

                <!-- Conditional Buttons -->
                @if ($order->order_status == 1)
                    <!-- Status: 1 -->
                    <a class="btn btn-secondary me-2"
                        href="{{ route('user.consumer.order.cancel', $order->id) }}">Cancel</a>
                @elseif($order->order_status == 2)
                    <!-- Status: 2 -->
                    {{-- <a class="btn btn-warning me-2" href="{{ route('user.consumer.order.update-payment', $order->id) }}">Update Payment</a> --}}
                    <a class="btn btn-secondary me-2"
                        href="{{ route('user.consumer.order.cancel', $order->id) }}">Cancel</a>
                    {{-- @elseif($order->order_status == 3) <!-- Status: 3 -->
            <a class="btn btn-primary me-2" href="{{ route('user.consumer.order.track', $order->id) }}">Track Order</a> --}}
                @elseif($order->order_status == 4 && !$order->rating)
                    <!-- Status: 4 -->
                    <a class="btn btn-success me-2" href="{{ route('user.consumer.order.rate', $order->id) }}">Rate
                        Order</a>
                    {{-- @elseif($order->order_status == 5) <!-- Status: 5 --> --}}
                    {{-- <a class="btn btn-info me-2" href="{{ route('user.consumer.order.cancellation-details', $order->id) }}">View Cancellation</a> --}}
                @endif
            </div>
        </div>
    </section>
@endsection
