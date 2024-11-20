@extends('layouts.app')

@section('title','Checkout Page')

@push('styles')
<style>
    .small-input {
        width: 80px; /* Adjust this value to change the width */
    }
</style>
@endpush


@section('content')
    @include('user.includes.navbar-consumer')
    <div class="container mt-4 mb-5">
        <h2 class="mb-4">Checkout</h2>
        <div class="row">
            <div class="col-lg-8">
                <h5>Billing Information</h5>
                <form id="checkoutForm">

                    <h5 class="mt-4">Location Information</h5>

                    <div class="mb-3">
                        <label for="region" class="form-label">Region</label>
                        <input type="text" class="form-control" id="region" value="Bicol Region" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city" required>
                    </div>
                    <div class="mb-3">
                        <label for="province" class="form-label">Province</label>
                        <input type="text" class="form-control" id="province" required>
                    </div>
                    <div class="mb-3">
                        <label for="barangay" class="form-label">Barangay</label>
                        <input type="text" class="form-control" id="barangay" required>
                    </div>
                    <div class="mb-3">
                        <label for="postalCode" class="form-label">Postal Code</label>
                        <input type="text" class="form-control" id="postalCode" required>
                    </div>
                    <div class="mb-3">
                        <label for="streetName" class="form-label">Street Name / Building</label>
                        <input type="text" class="form-control" id="streetName" required>
                    </div>
                    <div class="mb-3">
                        <label for="houseNumber" class="form-label">House Number</label>
                        <input type="text" class="form-control" id="houseNumber" required>
                    </div>
                </form>
            </div>

            <div class="col-lg-4">
                <h5>Order Summary</h5>
                <hr>
                <div class="d-flex justify-content-between">
                    <p>Subtotal</p>
                    <p id="subtotal">Subtotal will be calculated</p>
                </div>
                <div class="d-flex justify-content-between">
                    <p>Shipping</p>
                    <p>$5</p>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <h6>Total</h6>
                    <h6 id="total">Total will be calculated</h6>
                </div>

                <h5 class="mt-4">Payment Method</h5>
                <form id="paymentForm">
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="paymentMethod" id="gcash" value="gcash" checked>
                            <label class="form-check-label" for="gcash">
                                GCash
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="paymentMethod" id="cod" value="cod">
                            <label class="form-check-label" for="cod">
                                Cash on Delivery
                            </label>
                        </div>
                    </div>
                </form>

                <button type="button" class="btn btn-primary mt-3" id="placeOrderBtn">Place Order</button>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>

    </script>
@endsection
