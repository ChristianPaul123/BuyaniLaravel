@extends('layouts.app') <!-- Extend your main layout -->

@section('title', 'User Orders') <!-- Define the title for this page -->

@push('styles')
<style>
    .navbar-category {
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1000;
    background-color: #175593;
    border-bottom: 1px solid #ddd;
    }
    .navbar-nav .nav-link {
        color: #333;
    }
    .navbar-nav .nav-link.active {
        font-weight: bold;
    }
    .message {
        color: black;
        font-size: 25px;
    }

</style>
@endpush

@section('content')
<body>
    @include('user.includes.navbar-consumer')

<div class="main-content-wrapper">
        <!-- All your main page content goes here -->
    <div class="container container-fluid mt-1">
    <!-- Navbar -->
    <section class="p-3">

        <div class="container mt-5 mb-5">
            <h2 class="mb-4">Pending Orders</h2>

            <!-- Tabs for Order Categories -->
            <ul class="nav nav-tabs" id="orderTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="toPay-tab" data-bs-toggle="tab" data-bs-target="#toPay" type="button" role="tab">To Pay</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="toShip-tab" data-bs-toggle="tab" data-bs-target="#toShip" type="button" role="tab">To Ship</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="toReceive-tab" data-bs-toggle="tab" data-bs-target="#toReceive" type="button" role="tab">To Receive</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed" type="button" role="tab">Completed</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="canceled-tab" data-bs-toggle="tab" data-bs-target="#canceled" type="button" role="tab">Canceled</button>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="orderTabsContent">
                <!-- To Pay -->
                <div class="tab-pane fade show active" id="toPay" role="tabpanel">
                    <div class="mt-3">
                        <h5>Orders Pending Payment</h5>
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row align-items-center g-3">
                                    <div class="col-md-2">
                                        <img src="https://via.placeholder.com/100" alt="Product" class="img-fluid">
                                    </div>
                                    <div class="col-md-4">
                                        <h5 class="card-title">Chili</h5>
                                        <p>Quantity: 1 kg</p>
                                        <p class="text-muted">Price: $3</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p>Status: <span class="badge bg-warning">Pending Payment</span></p>
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-primary w-100" onclick="showPaymentModal()">Pay Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- To Ship -->
                <div class="tab-pane fade" id="toShip" role="tabpanel">
                    <div class="mt-3">
                        <h5>Orders Waiting to be Shipped</h5>
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row align-items-center g-3">
                                    <div class="col-md-2">
                                        <img src="https://via.placeholder.com/100" alt="Product" class="img-fluid">
                                    </div>
                                    <div class="col-md-4">
                                        <h5 class="card-title">Peanut</h5>
                                        <p>Quantity: 2 kg</p>
                                        <p class="text-muted">Price: $8</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p>Status: <span class="badge bg-info">To Ship</span></p>
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-secondary w-100" disabled>Shipping Soon</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- To Receive -->
                <div class="tab-pane fade" id="toReceive" role="tabpanel">
                    <div class="mt-3">
                        <h5>Orders on the Way</h5>
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row align-items-center g-3">
                                    <div class="col-md-2">
                                        <img src="https://via.placeholder.com/100" alt="Product" class="img-fluid">
                                    </div>
                                    <div class="col-md-4">
                                        <h5 class="card-title">Chili</h5>
                                        <p>Quantity: 1 kg</p>
                                        <p class="text-muted">Price: $3</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p>Status: <span class="badge bg-success">On the Way</span></p>
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-success w-100" onclick="confirmReceipt()">Confirm Receipt</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Completed -->
                <div class="tab-pane fade" id="completed" role="tabpanel">
                    <div class="mt-3">
                        <h5>Completed Orders</h5>
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row align-items-center g-3">
                                    <div class="col-md-2">
                                        <img src="https://via.placeholder.com/100" alt="Product" class="img-fluid">
                                    </div>
                                    <div class="col-md-4">
                                        <h5 class="card-title">Peanut</h5>
                                        <p>Quantity: 2 kg</p>
                                        <p class="text-muted">Price: $8</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p>Status: <span class="badge bg-dark">Completed</span></p>
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-outline-secondary w-100" disabled>Order Complete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Canceled -->
                <div class="tab-pane fade" id="canceled" role="tabpanel">
                    <div class="mt-3">
                        <h5>Canceled Orders</h5>
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row align-items-center g-3">
                                    <div class="col-md-2">
                                        <img src="https://via.placeholder.com/100" alt="Product" class="img-fluid">
                                    </div>
                                    <div class="col-md-4">
                                        <h5 class="card-title">Chili</h5>
                                        <p>Quantity: 1 kg</p>
                                        <p class="text-muted">Price: $3</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p>Status: <span class="badge bg-danger">Canceled</span></p>
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-outline-danger w-100" disabled>Order Canceled</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    <section>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Your custom scripts for this page go here
</script>
@endpush





