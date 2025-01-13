@extends('layouts.app') <!-- Extend your main layout -->

@section('title', 'User Orders') <!-- Define the title for this page -->

@push('styles')
<style>
    .tab-content .order-card {
        border: 1px solid #dee2e6;
        border-radius: 5px;
        margin-bottom: 1rem;
        padding: 15px;
        background-color: #fff;
    }

    .tab-height {
        min-height: 400px;
        overflow-y: auto;
    }

    .order-status {
        font-weight: bold;
        padding: 0.2rem 0.5rem;
        border-radius: 3px;
    }

    /* .order-header {
        text-align: center;
        padding: 2rem 0;
        font-family: 'Arial', sans-serif;
        color: #175593;
    }

    .order-header i {
        font-size: 3rem;
        color: #ff6b6b;
    }

    .order-header h1 {
        margin-top: 0.5rem;
        font-size: 2rem;
        font-weight: bold;
    }

    .order-container {
        margin: 2rem auto;
        max-width: 1200px;
    }

    .order-table {
        width: 100%;
        border-collapse: collapse;
        margin: 1.5rem 0;
    }

    .order-table th, .order-table td {
        padding: 1rem;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .order-table th {
        font-weight: bold;
        color: #333;
        text-transform: uppercase;
    }

    .order-table .order-status {
        font-weight: bold;
        padding: 0.3rem 0.6rem;
        border-radius: 5px;
    }

    .order-table .status-standby { background-color: #6c757d; color: white; }
    .order-table .status-to-pay { background-color: #ffc107; color: black; }
    .order-table .status-to-ship { background-color: #0d6efd; color: white; }
    .order-table .status-completed { background-color: #28a745; color: white; }
    .order-table .status-cancelled { background-color: #dc3545; color: white; }

    .btn-view {
        background-color: #2d6a4f;
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .btn-view:hover {
        background-color: #175593;
    }

    .btn-cancel {
        background-color: transparent;
        border: none;
        color: #ff6b6b;
        font-size: 1.5rem;
        cursor: pointer;
        transition: color 0.3s;
    }

    .btn-cancel:hover {
        color: #ff4d4d;
    }

    .order-empty {
        text-align: center;
        color: #999;
        font-size: 1.5rem;
    } */

    .status-standby { background-color: #6c757d; color: white; }
    .status-to-pay { background-color: #ffc107; color: black; }
    .status-to-ship { background-color: #0d6efd; color: white; }
    .status-out-for-delivery { background-color: #6a17b8; color: white; }
    .status-completed { background-color: #28a745; color: white; }
    .status-cancelled { background-color: #dc3545; color: white; }



</style>
@endpush

@section('content')
<body>
    @include('user.includes.navbar-consumer')

<div class="main-content-wrapper h-100">
        <!-- All your main page content goes here -->
    <div class="container container-fluid mt-1">
    <!-- Navbar -->
    <section class="p-3">

        <div class="container mt-5 mb-5">
            <h1 class="text-center pt-3 mb-4" style="color: #00cc1a; font-weight: bold;">Pending Orders</h1>
            <ul class="nav nav-tabs" id="orderTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="standby-tab" data-bs-toggle="tab" href="#standby" role="tab">To Standby</a>
                </li>
                {{-- <li class="nav-item" role="presentation">
                    <a class="nav-link" id="to-pay-tab" data-bs-toggle="tab" href="#to-pay" role="tab">To Pay</a>
                </li> --}}
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="to-ship-tab" data-bs-toggle="tab" href="#to-ship" role="tab">To Ship</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="completed-tab" data-bs-toggle="tab" href="#order-deliver" role="tab">Out for Delivery</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="order-deliver-tab" data-bs-toggle="tab" href="#completed" role="tab">Completed</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="cancelled-tab" data-bs-toggle="tab" href="#cancelled" role="tab">Cancelled</a>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content mt-3" id="orderTabsContent">
                    <!-- Standby Orders -->
                    <div class="tab-pane fade show active" id="standby" role="tabpanel">
                            @include('user.consumer.order.tabs.order-standby', ['order' => $ordersToStandby])
                    </div>

                    <!-- To Pay Orders -->
                    {{-- <div class="tab-pane fade" id="to-pay" role="tabpanel">
                            @include('user.consumer.order.tabs.order-pay', ['order' => $ordersToPay])
                    </div> --}}

                    <!-- To Ship Orders -->
                    <div class="tab-pane fade" id="to-ship" role="tabpanel">
                            @include('user.consumer.order.tabs.order-ship', ['order' => $ordersToShip])
                    </div>

                    <!-- Out for Delivery Orders -->
                    <div class="tab-pane fade" id="order-deliver" role="tabpanel">
                        @include('user.consumer.order.tabs.order-deliver', ['order' => $ordersToDeliver])
                    </div>

                    <!-- Completed Orders -->
                    <div class="tab-pane fade" id="completed" role="tabpanel">
                            @include('user.consumer.order.tabs.order-completed', ['order' => $ordersCompleted])
                    </div>

                    <!-- Cancelled Orders -->
                    <div class="tab-pane fade" id="cancelled" role="tabpanel">
                            @include('user.consumer.order.tabs.order-cancelled', ['order' => $ordersCancelled])
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





