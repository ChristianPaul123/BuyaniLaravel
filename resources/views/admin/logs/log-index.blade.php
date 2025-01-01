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
                    <a class="nav-link active" id="productlogs-tab" data-bs-toggle="tab" href="#productlogs" role="tab">Product Logs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="orderlogs-tab" data-bs-toggle="tab" href="#orderlogs" role="tab">Order Logs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="userlogs-tab" data-bs-toggle="tab" href="#userlogs" role="tab">User Logs</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="adminlogs-tab" data-bs-toggle="tab" href="#adminlogs" role="tab">Admin Logs</a>
                </li>
            </ul>

            {{-- Tab Content --}}
            <div class="tab-content mt-4" id="logmanagementTabsContent">

                {{-- Manage Logs in  log index tab --}}
                <div class="tab-pane fade show active" id="productlogs" role="tabpanel">
                    @include('admin.logs.log-tab.product-log', ['userLogs' => $productLogs])
                </div>

                <div class="tab-pane fade" id="orderlogs" role="tabpanel">
                    @include('admin.logs.log-tab.order-log', ['userLogs' => $orderLogs])
                </div>

                <div class="tab-pane fade" id="userlogs" role="tabpanel">
                    @include('admin.logs.log-tab.user-log', ['userLogs' => $userLogs])
                </div>

                <div class="tab-pane fade" id="adminlogs" role="tabpanel">
                    @include('admin.logs.log-tab.admin-log', ['adminLogs' => $adminLogs])
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
