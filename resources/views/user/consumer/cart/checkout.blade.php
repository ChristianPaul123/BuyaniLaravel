@extends('layouts.app')

@section('title', 'Checkout Page')

@push('styles')
    <style>
        .card {
            border-radius: 8px;
        }

        .btn-custom {
            background-color: #4CAF50;
            color: white;
            border-radius: 8px;
        }

        .btn-custom:hover {
            background-color: #45a049;
        }

        #stripe-div {
            max-height: 0;
            overflow: hidden;
            /* transition: max-height 0.2s ease-out; */
        }

        #stripe-div.active {
            max-height: 200px;
            transition: max-height 0.2s ease-out;
        }

        #spinner-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.75);
            /* Semi-transparent black */
            display: flex;
            justify-content: center;
            /* Center horizontally */
            align-items: center;
            /* Center vertically */
            z-index: 1050;
            /* Ensure it appears above other elements */
            flex-direction: column;
            /* Stack spinner and text vertically */
        }
    </style>
@endpush

@section('content')
    @include('user.includes.navbar-consumer')
    <div class="container mt-4 mb-5">
        {{-- <h2 class="mb-4">Checkout</h2>

        <!-- 1. Shipping Address Dropdown -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card p-4">
                    <h5>Select Shipping Address</h5>
                    <select class="form-select mt-3" id="shippingAddressDropdown">
                        <option value="" selected disabled>Select a saved address</option>
                        @foreach ($shippingAddresses as $address)
                            <option value="{{ $address->id }}">
                                {{ $address->shipping_name }}, {{ $address->street }}, {{ $address->city }}, {{ $address->state }}, {{ $address->country }}
                            </option>
                        @endforeach
                        <option value="new">Add New Address</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- 2. Shipping Information Form -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card p-4">
                    <h5>Shipping Information</h5>
                    <form id="shippingForm" class="mt-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="Enter your full name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" class="form-control" id="phone" placeholder="Enter your phone number">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control" id="city" placeholder="City">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="state" class="form-label">State</label>
                                    <input type="text" class="form-control" id="state" placeholder="State">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="zipCode" class="form-label">Zip Code</label>
                                    <input type="text" class="form-control" id="zipCode" placeholder="Zip Code">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="street" class="form-label">Street</label>
                                    <input type="text" class="form-control" id="street" placeholder="Street">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- 3. Cart Items -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card p-4">
                    <h5>Cart Items</h5>
                    @foreach ($cartItems as $item)
                        <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                            <p>{{ $item->product_specification->specification_name }} x {{ $item->quantity }}</p>
                            <p>${{ $item->price }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- 4. Payment Method -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card p-4">
                    <h5>Payment Method</h5>
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="radio" name="paymentMethod" id="cod" value="cod">
                        <label class="form-check-label" for="cod">
                            Cash on Delivery
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="paymentMethod" id="gcash" value="gcash">
                        <label class="form-check-label" for="gcash">
                            GCash
                        </label>
                    </div>

                    <!-- GCash Modal -->
                    <div class="mt-3" id="gcashUploadSection" style="display: none;">
                        <label for="gcashReceipt" class="form-label">Upload GCash Receipt</label>
                        <input type="file" class="form-control" id="gcashReceipt">
                    </div>
                </div>
            </div>
        </div>

        <!-- 5. Action Buttons -->
        <div class="row mt-4">
            <div class="col-6 text-start">
                <button class="btn btn-danger w-100">Cancel</button>
            </div>
            <div class="col-6 text-end">
                <button class="btn btn-custom w-100">Continue</button>
            </div>
        </div> --}}
        @livewire('consumer.user-cart-checkout', ['cartId' => $cart->id])
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Toggle GCash receipt upload
            // document.getElementById("gcash").addEventListener("change", function() {
            //     document.getElementById("gcashUploadSection").style.display = "block";
            // });
            // document.getElementById("cod").addEventListener("change", function() {
            //     document.getElementById("gcashUploadSection").style.display = "none";
            // });

            // document.getElementById("stripe").addEventListener("change", function() {
            //     document.getElementById("stripe-div").
            // });

            // // Handle shipping address selection
            // document.getElementById("shippingAddressDropdown").addEventListener("change", function() {
            //     if (this.value === "new") {
            //         document.getElementById("shippingForm").reset();
            //     } else {
            //         // Load selected shipping address into the form (logic to be implemented)
            //     }
            // });
        });
    </script>

@endsection
