@extends('layouts.admin-app')

@section('title', 'User Management | View User')

@push('styles')
<style>
    .tab-pane {
        margin-top: 20px;
    }
    .form-control {
        margin-bottom: 10px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('admin.includes.sidebar')

        <section class="col-md-10 ml-sm-auto col-lg-10 px-3 py-2">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">User Management</h1>
            </div>

            {{-- Tabs --}}
            <ul class="nav nav-tabs mt-4" id="userTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="personal-tab" data-bs-toggle="tab" href="#personal" role="tab">Personal Information</a>
                </li>
                @if ($user->user_type == 1) {{-- Consumer Tabs --}}
                    <li class="nav-item">
                        <a class="nav-link" id="shipping-tab" data-bs-toggle="tab" href="#shipping" role="tab">Shipping Address</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="orders-tab" data-bs-toggle="tab" href="#orders" role="tab">Order History</a>
                    </li>
                @elseif ($user->user_type == 2) {{-- Farmer Tabs --}}
                    <li class="nav-item">
                        <a class="nav-link" id="farmers-address-tab" data-bs-toggle="tab" href="#farmers-address" role="tab">Farmer's Address</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="produce-tab" data-bs-toggle="tab" href="#produce" role="tab">Farmer's Produce</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="forms-tab" data-bs-toggle="tab" href="#forms" role="tab">Farmer Forms</a>
                    </li>
                @endif
            </ul>

            {{-- Tab Content --}}
            <div class="tab-content mt-3" id="userTabsContent">
                {{-- Personal Information Tab --}}
                <div class="tab-pane fade show active" id="personal" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <h5>User Information</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Username:</strong> {{ $user->username }}</p>
                            <p><strong>Email:</strong> {{ $user->email }}</p>
                            <p><strong>Phone:</strong> {{ $user->phone_number ?? 'N/A' }}</p>
                            <p><strong>Status:</strong>
                                <span class="badge {{ $user->deactivated_status ? 'bg-danger' : 'bg-success' }}">
                                    {{ $user->deactivated_status ? 'Deactivated' : 'Active' }}
                                </span>
                            </p>
                            <p><strong>Last Online:</strong> {{ $user->last_online ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                @if ($user->user_type == 1) {{-- Consumer Content --}}
                    {{-- Shipping Address Tab --}}
                    <div class="tab-pane fade" id="shipping" role="tabpanel">
                        @if ($user->shippingAddresses->isEmpty())
                            <p>No shipping addresses found.</p>
                        @else
                            <ul class="list-group">
                                @foreach ($user->shippingAddresses as $address)
                                    <li class="list-group-item">
                                        <p><strong>Address:</strong> {{ $address->house_number }} {{ $address->street }}, {{ $address->city }}, {{ $address->state }}, {{ $address->country }}</p>
                                        <p><strong>Postal Code:</strong> {{ $address->zip_code }}</p>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    {{-- Order History Tab --}}
                    <div class="tab-pane fade" id="orders" role="tabpanel">
                        @if ($user->orders->isEmpty())
                            <p>No orders found.</p>
                        @else
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Order Number</th>
                                        <th>Status</th>
                                        <th>Total Amount</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user->orders as $order)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $order->order_number }}</td>
                                            <td>{{ $order->status_label }}</td>
                                            <td>${{ $order->total_amount }}</td>
                                            <td>
                                                {{ $order->created_at ? $order->created_at->format('Y-m-d') : 'N/A' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                @elseif ($user->user_type == 2) {{-- Farmer Content --}}
                    {{-- Farmer's Address Tab --}}
                    <div class="tab-pane fade" id="farmers-address" role="tabpanel">
                        <p><strong>Address:</strong> {{ $user->shippingAddresses->first()->house_number ?? 'N/A' }} {{ $user->shippingAddresses->first()->street ?? '' }}, {{ $user->shippingAddresses->first()->city ?? '' }}, {{ $user->shippingAddresses->first()->state ?? '' }}, {{ $user->shippingAddresses->first()->country ?? '' }}</p>
                        <p><strong>Postal Code:</strong> {{ $user->shippingAddresses->first()->zip_code ?? 'N/A' }}</p>
                    </div>

                    {{-- Farmer's Produce Tab --}}
                    <div class="tab-pane fade" id="produce" role="tabpanel">
                        @if ($user->farmerProduces->isEmpty())
                            <p>No produce data found.</p>
                        @else
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Produce Name</th>
                                        <th>Description</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user->farmerProduces as $produce)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $produce->produce_name }}</td>
                                            <td>{{ $produce->produce_description }}</td>
                                            <td>{{ $produce->produce_quantity }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>

                    {{-- Farmer Forms Tab --}}
                    <div class="tab-pane fade" id="forms" role="tabpanel">
                        @if ($user->farmerforms->isEmpty())
                            <p>No forms submitted by the farmer.</p>
                        @else
                            @foreach ($user->farmerforms as $form)
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <p><strong>Form ID:</strong> {{ $form->id }}</p>
                                        <p><strong>Response:</strong> {{ $form->response }}</p>
                                        <p><strong>ID Verified:</strong> {{ $form->id_verified ? 'Yes' : 'No' }}</p>
                                        <p><strong>Form Verified:</strong> {{ $form->form_verified ? 'Yes' : 'No' }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                @endif
            </div>
        </section>
    </div>
</div>
@endsection
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

@section('scripts')

@endsection

