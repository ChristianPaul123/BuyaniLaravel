
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
                    <div class="mb-3">
                        <label for="fullName" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="fullName" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" required>
                    </div>

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

    <!-- GCash Modal -->
    <div class="modal fade" id="gcashModal" tabindex="-1" aria-labelledby="gcashModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="gcashModalLabel">Enter GCash Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="gcashForm">
                        <div class="mb-3">
                            <label for="gcashNumber" class="form-label">GCash Number</label>
                            <input type="text" class="form-control" id="gcashNumber" required>
                        </div>
                        <div class="mb-3">
                            <label for="gcashName" class="form-label">Name on GCash Account</label>
                            <input type="text" class="form-control" id="gcashName" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="confirmPaymentBtn">Confirm Payment</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        document.getElementById('placeOrderBtn').addEventListener('click', function() {
            const paymentMethod = document.querySelector('input[name="paymentMethod"]:checked').value;
            if (paymentMethod === 'gcash') {
                const gcashModal = new bootstrap.Modal(document.getElementById('gcashModal'));
                gcashModal.show();
            } else {
                alert('Order placed successfully with Cash on Delivery!');
            }
        });

        document.getElementById('confirmPaymentBtn').addEventListener('click', function() {
            const gcashNumber = document.getElementById('gcashNumber').value;
            const gcashName = document.getElementById('gcashName').value;
            alert(`Order placed successfully with GCash! \nGCash Number: ${gcashNumber} \nName: ${gcashName}`);
            const gcashModal = bootstrap.Modal.getInstance(document.getElementById('gcashModal'));
            gcashModal.hide();
        });
    </script>
@endsection
