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
    max-height: 35rem;
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
<div class="container-fluid">
    <div class="container mt-4">
        <!-- First Row: Order Information -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Order Information</h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Order Number:</strong> #ORD987654</p>
                        <p><strong>Order ID:</strong> 201</p>
                        <p><strong>Customer Name:</strong> Jane Smith</p>
                        <p><strong>Customer Email:</strong> jane.smith@example.com</p>
                        <p><strong>Customer Phone:</strong> +9876543210</p>
                        <p><strong>Order Status:</strong> Rejected</p>
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
                                    <th>Item Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Product C</td>
                                    <td>1</td>
                                    <td>$30</td>
                                    <td>$30</td>
                                </tr>
                                <tr>
                                    <td>Product D</td>
                                    <td>3</td>
                                    <td>$20</td>
                                    <td>$60</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Third Row: Payment Method -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Payment Information</h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Payment Method:</strong> PayPal</p>
                        <p><strong>Transaction ID:</strong> TXN123456789</p>
                        <p><strong>Payment Status:</strong> Refunded</p>
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
                        <p><strong>Cancelled By:</strong> Admin</p>
                        <p><strong>Reason:</strong> Out of stock</p>
                        <p><strong>Cancellation Date:</strong> {{ now()->format('d-m-Y') }}</p>
                        <p><strong>Status:</strong> Processed</p>
                        {{-- Add potential improvement ideas --}}
                        <p><strong>Notes:</strong> Notify customer via email for further assistance.</p>
                        <p><strong>Follow-Up Action:</strong> Ensure inventory is updated to avoid future cancellations.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
</div>
</div>
@endsection
