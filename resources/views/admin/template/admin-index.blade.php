@extends('layouts.admin-app') {{-- Extend your main layout --}}

@section('title', 'Admin | template') {{-- Set the page title --}}

@push('styles')
<style>
    .main-section {
        max-height: 33rem;
    }
    .tab-pane {
        margin-top: 20px;
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
    min-height: 90vh;
    max-height: 90vh;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('admin.includes.sidebar') {{-- Include the sidebar --}}
        <section class="col-md-10 ml-sm-auto col-lg-10 px-3 py-2 overflow-y-scroll main-section">
            {{-- Session Messages --}}

            {{-- Page Header --}}
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-1 pb-2 mb-3 border-bottom">
                <h1 class="h2">Sales Reports</h1>
            </div>

            {{-- Tabs for Navigation --}}
            <ul class="nav nav-tabs" id="adminTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="admin-tab" data-bs-toggle="tab" href="#admin-1" role="tab">admin </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="admin2-tab" data-bs-toggle="tab" href="#admin2-2" role="tab">  admin2</a>
                </li>
            </ul>

            {{-- Tab Contents --}}
            <div class="tab-content mt-4" id="adminTabsContent">
                {{-- Current Inventory Tab --}}
                <div class="tab-pane fade show active" id="admin-1" role="tabpanel">
                    @include('admin.template.admin-tab')
                </div>

                {{-- Past Inventory Tab --}}
                <div class="tab-pane fade" id="admin2-2" role="tabpanel">
                    @include('admin.template.admin-tab')
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

