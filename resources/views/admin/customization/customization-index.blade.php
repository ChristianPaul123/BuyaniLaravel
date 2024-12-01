@extends('layouts.admin-app')

@section('title', 'Admin | Customization')

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
                <h1 class="h2">Customization</h1>
            </div>
            {{-- Tabs Navigation --}}
            <ul class="nav nav-tabs" id="customizationTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="settings-tab" data-bs-toggle="tab" href="#settings" role="tab">Admin Settings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="admins-tab" data-bs-toggle="tab" href="#admins" role="tab">Manage Admins</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="payments-tab" data-bs-toggle="tab" href="#payments" role="tab">Admin Payments</a>
                </li>
            </ul>

            {{-- Tab Content --}}
            <div class="tab-content mt-4" id="customizationTabsContent">

                {{-- Settings Tab --}}
                <div class="tab-pane fade show active" id="settings" role="tabpanel">
                    @include('admin.customization.tabs.setting-admin', ['admin' => $admin])
                </div>

                {{-- Manage Admins Tab --}}
                <div class="tab-pane fade" id="admins" role="tabpanel">
                    @include('admin.customization.tabs.manage-admin', ['admins' => $admins])
                </div>

                {{-- Admin Payments Tab --}}
                <div class="tab-pane fade" id="payments" role="tabpanel">
                    @include('admin.customization.tabs.payment-admin', ['admin' => $admin])
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
