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
    <div class="container-fluid">
    <div class="container mt-4">
                    {{-- Back button --}}
        <div class="d-flex justify-content-start flex-wrap flex-md-nowrap align-items-center pt-1 pb-2 mb-3 border-bottom">
            <button type="button" class="btn btn-primary" onclick="window.history.back()"> &#9754; Back to previous</button>
        </div>
                            <!-- First Row: User Information -->
        <div class="row mb-4">



            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>User Information</h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Order Number:</strong> #ORD123456</p>
                        <p><strong>Order ID:</strong> 101</p>
                        <p><strong>Customer Name:</strong> John Doe</p>
                        <p><strong>Customer Email:</strong> john.doe@example.com</p>
                        <p><strong>Customer Phone:</strong> +1234567890</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Second Row: Address Information -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Address Information</h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Street:</strong> 123 Elm Street</p>
                        <p><strong>City:</strong> Springfield</p>
                        <p><strong>State:</strong> Illinois</p>
                        <p><strong>Zip Code:</strong> 62704</p>
                        <p><strong>Country:</strong> USA</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Third Row: Order Items -->
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
                                    <td>Product A</td>
                                    <td>2</td>
                                    <td>$50</td>
                                    <td>$100</td>
                                </tr>
                                <tr>
                                    <td>Product B</td>
                                    <td>1</td>
                                    <td>$80</td>
                                    <td>$80</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Fourth Row: Payment Method -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Payment Method</h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Method:</strong> Credit Card</p>
                        <p><strong>Transaction ID:</strong> TXN987654</p>
                        <p><strong>Status:</strong> Paid</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Fifth Row: Actions -->
        <div class="row mb-4">
            <div class="col-12 text-center">
                <form action="{{ route('admin.orders.accept', 101) }}" method="POST" style="display:inline-block;">
                    @csrf
                    <button class="btn btn-success">Accept Order</button>
                </form>
                <form action="{{ route('admin.orders.cancel', 101) }}" method="POST" style="display:inline-block;">
                    @csrf
                    <button class="btn btn-danger">Cancel Order</button>
                </form>
            </div>
        </div>
    </div>

<!-- Scroll-to-Bottom Button -->
<button class="scroll-to-bottom" id="scrollToBottomBtn">
    <i class="fas fa-arrow-down"></i>
</button>
</section>
    </div>
</div>
@endsection

@section('scripts')

@endsection
