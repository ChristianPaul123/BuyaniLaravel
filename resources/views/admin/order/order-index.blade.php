@extends('layouts.admin-app') {{-- Extend the main parent layout --}}

@section('title', 'Admin | Order') {{-- Set the page title --}}

@push('styles')
<style>
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
        <section class="col-md-10 ml-sm-auto col-lg-10 px-3 py-2 overflow-y-scroll main-section">
            @if (session('message'))
                <div class="alert alert-success mx-3 my-2 px-3 py-2">
                    <button type="button" class="close btn btn-success" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('message') }}
                </div>
            @endif

            {{-- Error Messages --}}
            @if ($errors->any())
                <div class="alert alert-danger mx-3 my-2 px-3 py-2">
                    <button type="button" class="close btn btn-danger" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-1 pb-2 mb-3 border-bottom">
                <h1 class="h2">Order Management</h1>
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.product.special') }}" class="btn btn-primary">
                    Go to Product Special
                </a>
            </div>

            <ul class="nav nav-tabs" id="orderTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="order-standby-tab" data-bs-toggle="tab" href="#order-standby" role="tab">To Standby</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="order-pay-tab" data-bs-toggle="tab" href="#order-pay" role="tab">To Pay</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="order-ship-tab" data-bs-toggle="tab" href="#order-ship" role="tab">To Ship</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="order-deliver-tab" data-bs-toggle="tab" href="#order-deliver" role="tab">To Deliver</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="order-completed-tab" data-bs-toggle="tab" href="#order-completed" role="tab">Order Completed</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="order-cancelled-tab" data-bs-toggle="tab" href="#order-cancelled" role="tab">Order Cancelled</a>
                </li>
            </ul>

            <div class="tab-content mt-4" id="orderTabsContent">
                <div class="tab-pane fade show active" id="order-standby" role="tabpanel">
                    @include('admin.order.tabs.order-standby',['ordersToStandby' => $ordersToStandby])
                </div>
                <div class="tab-pane fade" id="order-pay" role="tabpanel">
                    @include('admin.order.tabs.order-pay',['ordersToPay' => $ordersToPay])
                </div>
                <div class="tab-pane fade" id="order-ship" role="tabpanel">
                    @include('admin.order.tabs.order-ship',['ordersToShip' => $ordersToShip])
                </div>
                <div class="tab-pane fade" id="order-deliver" role="tabpanel">
                    @include('admin.order.tabs.order-deliver', ['ordersToShip' => $ordersToShip])
                </div>
                <div class="tab-pane fade" id="order-completed" role="tabpanel">
                    @include('admin.order.tabs.order-completed',['ordersCompleted' => $ordersCompleted])
                </div>
                <div class="tab-pane fade" id="order-cancelled" role="tabpanel">
                    @include('admin.order.tabs.order-cancelled',['ordersCancelled' => $ordersCancelled])
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

@section('scripts')
<script>

</script>
@endsection
