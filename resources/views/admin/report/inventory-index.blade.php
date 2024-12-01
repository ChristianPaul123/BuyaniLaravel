@extends('layouts.admin-app') {{-- Extend your main layout --}}

@section('title', 'Admin | Inventory Reports') {{-- Set the page title --}}

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

            {{-- Page Header --}}
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-1 pb-2 mb-3 border-bottom">
                <h1 class="h2">Inventory Reports</h1>
            </div>

            {{-- Tabs for Navigation --}}
            <ul class="nav nav-tabs" id="inventoryTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="current-inventory-tab" data-bs-toggle="tab" href="#current-inventory" role="tab">Current Inventory</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="past-inventory-tab" data-bs-toggle="tab" href="#past-inventory" role="tab">Past Inventory</a>
                </li>
            </ul>

            {{-- Tab Contents --}}
            <div class="tab-content mt-4" id="inventoryTabsContent">
                {{-- Current Inventory Tab --}}
                <div class="tab-pane fade show active" id="current-inventory" role="tabpanel">
                    @include('admin.report.tabs-inventory.current-inventory')
                </div>

                {{-- Past Inventory Tab --}}
                <div class="tab-pane fade" id="past-inventory" role="tabpanel">
                    @include('admin.report.tabs-inventory.past-inventory')
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

@push('scripts')
<script>

    window.addEventListener('popstate', function(event) {
        // Redirect user if they press the back button
        window.location.href = "{{ route('admin.logout') }}";
    });
</script>
@endpush
