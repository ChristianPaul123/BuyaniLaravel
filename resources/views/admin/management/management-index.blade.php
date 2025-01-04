@extends('layouts.admin-app')

@section('title', 'Admin | Management')

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
                <h1 class="h2">User Management</h1>
            </div>
            {{-- Tabs Navigation --}}
            <ul class="nav nav-tabs" id="managementTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="consumers-tab" data-bs-toggle="tab" href="#consumers" role="tab">Consumer Management</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="farmers-tab" data-bs-toggle="tab" href="#farmers" role="tab">Farmer Management</a>
                </li>

            </ul>

            {{-- Tab Content --}}
            <div class="tab-content mt-4" id="managementTabsContent">

                {{-- Manage User Type with 1 means Consumer Tab --}}
                <div class="tab-pane fade" id="consumers" role="tabpanel">
                    @include('admin.management.tabs.user-consumer', ['users' => $consumers])
                </div>

                {{-- Manage User type with 2 means Farmers Tab --}}
                <div class="tab-pane fade" id="farmers" role="tabpanel">
                    @include('admin.management.tabs.user-farmer', ['users' => $farmers])
                </div>


            </div>
        </section>
    </div>
</div>
@endsection
