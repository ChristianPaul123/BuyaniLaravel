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

        .main-section {
            min-height: 90vh;
            max-height: 90vh;
        }
    </style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('admin.includes.messageBox')
        @include('admin.includes.sidebar')
        <section class="col-md-10 ml-sm-auto col-lg-10 px-3 py-2 overflow-y-scroll main-section">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">User Management</h1>
            </div>
            {{-- Back Button --}}
            <button type="button" class="btn btn-primary btn-back" onclick="window.history.back()"><span
                    class="fa fa-arrow-left" aria-hidden="true"></span> Back to previous</button>

            {{-- Tabs --}}
            <ul class="nav nav-tabs mt-4" id="userTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="personal-tab" data-bs-toggle="tab" href="#personal"
                        role="tab">Personal Information</a>
                </li>
                @if ($user->user_type == 1) {{-- Consumer Tabs --}}
                    <li class="nav-item">
                        <a class="nav-link" id="shipping-tab" data-bs-toggle="tab" href="#shipping" role="tab">Shipping
                            Address</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="orders-tab" data-bs-toggle="tab" href="#orders" role="tab">Order History</a>
                    </li>
                @elseif ($user->user_type == 2) {{-- Farmer Tabs --}}
                    <li class="nav-item">
                        <a class="nav-link" id="farmers-address-tab" data-bs-toggle="tab" href="#farmers-address"
                            role="tab">Farmer's Address</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="produce-tab" data-bs-toggle="tab" href="#produce" role="tab">Farmer's
                            Produce</a>
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
                    <div class="card  overflow-x-scroll">
                        <div class="card-header">
                            <h3 class="card-title">User Information</h3>
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
                        <div class="card  overflow-x-scroll">
                            <div class="card-header">
                                <h5>Farmer Address Information</h5>
                            </div>
                            @if ($user->shippingAddresses->isEmpty())
                                <div class="card-body">
                                    <p>No shipping addresses found.</p>
                                </div>
                            @else
                                <div class="card-body">
                                    <ul class="list-group">
                                        @foreach ($user->shippingAddresses as $address)
                                            <li class="list-group-item">
                                                <p><strong>House Number:</strong> {{ $address->house_number }} </p>
                                                <p><strong>Street:</strong> {{ $address->street }} </p>
                                                <p><strong>City:</strong> {{ $address->city }} </p>
                                                <p><strong>Province:</strong> {{ $address->state }} </p>
                                                <p><strong>Country:</strong> {{ $address->country }} </p>
                                                <p><strong>Barangay:</strong> {{ $address->barangay }}</p>
                                                <p><strong>Postal Code:</strong> {{ $address->zip_code }}</p>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Order History Tab --}}
                    <div class="tab-pane fade" id="orders" role="tabpanel">
                        <div class="card overflow-x-scroll">
                            <div class="card-header">
                                <h5>Order History Information</h5>
                            </div>
                            @if ($user->orders->isEmpty())
                                <div class="card-body">
                                    <p>No Orders found.</p>
                                </div>
                            @else
                                <div class="card-body">
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
                                </div>
                            @endif
                        </div>

                @elseif ($user->user_type == 2) {{-- Farmer Content --}}
                    {{-- Farmer's Address Tab --}}
                    <div class="tab-pane fade" id="farmers-address" role="tabpanel">
                        <div class="card overflow-x-scroll">
                            <div class="card-header">
                                <h5>Farmer's Address</h5>
                            </div>
                            @if ($user->shippingAddresses->isEmpty())
                                <div class="card-body">
                                    <p>No address information found.</p>
                                </div>
                            @else
                                <div class="card-body">
                                    @php        $address = $user->shippingAddresses->first(); @endphp
                                    <li class="list-group-item">
                                        <p><strong>House Number:</strong> {{ $address->house_number }} </p>
                                        <p><strong>Street:</strong> {{ $address->street }} </p>
                                        <p><strong>City:</strong> {{ $address->city }} </p>
                                        <p><strong>Province:</strong> {{ $address->state }} </p>
                                        <p><strong>Country:</strong> {{ $address->country }} </p>
                                        <p><strong>Barangay:</strong> {{ $address->barangay }}</p>
                                        <p><strong>Postal Code:</strong> {{ $address->zip_code }}</p>
                                    </li>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Farmer's Produce Tab --}}
                    <div class="tab-pane fade" id="produce" role="tabpanel">
                        <div class="card overflow-x-scroll">
                            <div class="card-header">
                                <h5>Farmer's Produce</h5>
                            </div>
                            @if ($user->farmerProduces->isEmpty())
                                <div class="card-body">
                                    <p>No produce data found.</p>
                                </div>
                            @else
                                <div class="card-body">
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
                                </div>
                            @endif
                        </div>
                    </div>
                    {{-- Farmer Forms Tab --}}
                    <div class="tab-pane fade" id="forms" role="tabpanel">
                        <div class="card overflow-x-scroll">
                            <div class="card-header">
                                <h5>Farmer Forms</h5>
                            </div>
                            <div class="card-body">
                                @foreach ($user->farmerforms as $form)
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <p><strong>Form ID:</strong> {{ $form->id }}</p>
                                            <p><strong>Response:</strong> {{ $form->response }}</p>
                                            <p><strong>ID Verified:</strong> {{ $form->id_verified ? 'Yes' : 'No' }}</p>
                                            <p><strong>Form Verified:</strong> {{ $form->form_verified ? 'Yes' : 'No' }}</p>

                                            <div class="row">
                                                @if ($form->farmer_form)
                                                    <div class="col-md-4 d-flex justify-content-center">
                                                        <div class="text-center">
                                                            <h6>Farmer Form:</h6>
                                                            <img src="{{ asset($form->farmer_form) }}" alt="Farmer Form" class="img-fluid rounded mb-3">
                                                        </div>
                                                    </div>
                                                @endif

                                                @if ($form->identification_card_front)
                                                    <div class="col-md-4 d-flex justify-content-center">
                                                        <div class="text-center">
                                                            <h6>ID Card Front:</h6>
                                                            <img src="{{ asset($form->identification_card_front) }}" alt="ID Front" class="img-fluid rounded mb-3">
                                                        </div>
                                                    </div>
                                                @endif

                                                @if ($form->identification_card_back)
                                                    <div class="col-md-4 d-flex justify-content-center">
                                                        <div class="text-center">
                                                            <h6>ID Card Back:</h6>
                                                            <img src="{{ asset($form->identification_card_back) }}" alt="ID Back" class="img-fluid rounded mb-3">
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>

                                            @if($form->form_verified)
                                                <div class="mt-3">
                                                    <button disabled type="submit" class="btn btn-success btn-lg mt-2">
                                                            <i class="fa fa-check mr-2"></i> Form Verified
                                                    </button>
                                                </div>
                                            @else
                                                <form method="POST" action="{{ route('farmer.form.verify', $form->id) }}" class="mt-3">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-success btn-lg mt-2">
                                                        <i class="fa fa-check mr-2"></i> Verify Form
                                                    </button>
                                                </form>
                                            @endif

                                            @if($form->id_verified)
                                                <div class="mt-3">
                                                    <button disabled type="submit" class="btn btn-success btn-lg mt-2">
                                                            <i class="fa fa-check mr-2"></i> ID Verified
                                                    </button>
                                                </div>
                                            @else
                                                <form method="POST" action="{{ route('farmer.id.verify', $form->id) }}" class="mt-3">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-success btn-lg mt-2">
                                                        <i class="fa fa-check mr-2"></i> Verify ID
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
                </div>
        </section>
    </div>
</div>
@endsection