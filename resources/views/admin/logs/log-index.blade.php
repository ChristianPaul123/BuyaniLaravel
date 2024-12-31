@extends('layouts.admin-app')

@section('title', 'Admin | Logs')

@push('styles')
<style>
    .tab-pane {
        margin-top: 20px;
    }

    .form-control {
        margin-bottom: 10px;
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

        <section class="col-md-10 ml-sm-auto col-lg-10 px-3 py-2 overflow-y-scroll main-section">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Log Management</h1>
            </div>
            {{-- Tabs Navigation --}}
            <ul class="nav nav-tabs" id="logmanagementTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="product-logs-tab" data-bs-toggle="tab" href="#product-logs" role="tab">Product Logs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="order-logs-tab" data-bs-toggle="tab" href="#order-logs" role="tab">Order Logs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="user-logs-tab" data-bs-toggle="tab" href="#user-logs" role="tab">User Logs</a>
                </li>
            </ul>

            {{-- Tab Content --}}
            <div class="tab-content mt-4" id="logmanagementTabsContent">

                {{-- Manage Logs in  log index tab --}}
                <div class="tab-pane fade show active" id="product-logs" role="tabpanel">
                    @include('admin.logs.log-tab.product-log', ['userLogs' => $productLogs])
                </div>

                <div class="tab-pane fade" id="order-logs" role="tabpanel">
                    @include('admin.logs.log-tab.order-log', ['userLogs' => $orderLogs])
                </div>

                <div class="tab-pane fade" id="user-logs" role="tabpanel">
                    @include('admin.logs.log-tab.user-log', ['userLogs' => $userLogs])
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
