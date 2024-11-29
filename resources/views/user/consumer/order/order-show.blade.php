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

    .status-standby { background-color: #6c757d; color: white; }
    .status-to-pay { background-color: #ffc107; color: black; }
    .status-to-ship { background-color: #0d6efd; color: white; }
    .status-completed { background-color: #28a745; color: white; }
    .status-cancelled { background-color: #dc3545; color: white; }


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

            <ul class="nav nav-tabs" id="orderTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="standby-tab" data-bs-toggle="tab" href="#standby" role="tab">To Standby</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="to-pay-tab" data-bs-toggle="tab" href="#to-pay" role="tab">To Pay</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="to-ship-tab" data-bs-toggle="tab" href="#to-ship" role="tab">To Ship</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="completed-tab" data-bs-toggle="tab" href="#completed" role="tab">Completed</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="cancelled-tab" data-bs-toggle="tab" href="#cancelled" role="tab">Cancelled</a>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content mt-3" id="orderTabsContent">
                    <!-- Standby Orders -->
                    <div class="tab-pane fade show active" id="standby" role="tabpanel">
                        @forelse($ordersToStandby as $order)
                            @include('user.consumer.order.tabs.order-standby', ['order' => $order])
                        @empty
                            <p>No orders in this status.</p>
                        @endforelse
                    </div>

                    <!-- To Pay Orders -->
                    <div class="tab-pane fade" id="to-pay" role="tabpanel">
                        @forelse($ordersToPay as $order)
                            @include('user.consumer.order.tabs.order-pay', ['order' => $order])
                        @empty
                            <p>No orders in this status.</p>
                        @endforelse
                    </div>

                    <!-- To Ship Orders -->
                    <div class="tab-pane fade" id="to-ship" role="tabpanel">
                        @forelse($ordersToShip as $order)
                            @include('user.consumer.order.tabs.order-ship', ['order' => $order])
                        @empty
                            <p>No orders in this status.</p>
                        @endforelse
                    </div>

                    <!-- Completed Orders -->
                    <div class="tab-pane fade" id="completed" role="tabpanel">
                        @forelse($ordersCompleted as $order)
                            @include('user.consumer.order.tabs.order-completed', ['order' => $order])
                        @empty
                            <p>No orders in this status.</p>
                        @endforelse
                    </div>

                    <!-- Cancelled Orders -->
                    <div class="tab-pane fade" id="cancelled" role="tabpanel">
                        @forelse($ordersCancelled as $order)
                            @include('user.consumer.order.tabs.order-cancelled', ['order' => $order])
                        @empty
                            <p>No orders in this status.</p>
                        @endforelse
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





