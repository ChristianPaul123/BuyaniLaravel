<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    @include('layouts.head');
    @include()
    <style>
        .small-input {
            width: 80px; /* Adjust this value to change the width */
        }
    </style>

    <script>
        // Function to update the subtotal and total
        function updateTotal() {
            let chiliPrice = 3; // Price of Chili per kg
            let peanutPrice = 4; // Price of Peanut per kg
            let shippingCost = 5; // Flat shipping cost

            let chiliQuantity = parseFloat(document.getElementById('quantity1').value);
            let peanutQuantity = parseFloat(document.getElementById('quantity2').value);

            let chiliChecked = document.getElementById('checkChili').checked;
            let peanutChecked = document.getElementById('checkPeanut').checked;

            // Calculate subtotal based on selected items
            let subtotal = 0;
            if (chiliChecked) subtotal += chiliPrice * chiliQuantity;
            if (peanutChecked) subtotal += peanutPrice * peanutQuantity;

            // Update subtotal and total
            document.getElementById('subtotal').innerText = `$${subtotal}`;
            document.getElementById('total').innerText = `$${subtotal + shippingCost}`;
        }
    </script>
</head>

<body>

    <?php include 'navbar-consumer.php'; ?>

    <div class="container mt-5 mb-5">
        <h2 class="mb-4">Shopping Cart</h2>
        <div class="row">
            <!-- Cart Items -->
            <div class="col-lg-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row align-items-center g-3">
                            <div class="col-md-1 text-center">
                                <input type="checkbox" id="checkChili" class="form-check-input" onchange="updateTotal()">
                            </div>
                            <div class="col-md-2">
                                <img src="https://via.placeholder.com/100" alt="Vegetable" class="img-fluid">
                            </div>
                            <div class="col-md-3">
                                <h5 class="card-title mb-1">Chili</h5>
                                <p class="text-muted mb-0">Category: Spices</p>
                            </div>
                            <div class="col-md-2">
                                <span class="fw-bold">$3/kg</span>
                            </div>
                            <div class="col-md-3">
                                <label for="quantity1" class="form-label">Weight (kg)</label>
                                <input type="number" class="form-control small-input" id="quantity1" value="1" min="1" step="0.5" onchange="updateTotal()" style="width: 80%;">
                            </div>
                            <div class="col-md-1 d-flex justify-content-end">
                                <button class="btn btn-danger btn-sm">Remove</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row align-items-center g-3">
                            <div class="col-md-1 text-center">
                                <input type="checkbox" id="checkPeanut" class="form-check-input" onchange="updateTotal()">
                            </div>
                            <div class="col-md-2">
                                <img src="https://via.placeholder.com/100" alt="Vegetable" class="img-fluid">
                            </div>
                            <div class="col-md-3">
                                <h5 class="card-title mb-1">Peanut</h5>
                                <p class="text-muted mb-0">Category: Nuts</p>
                            </div>
                            <div class="col-md-2">
                                <span class="fw-bold">$4/kg</span>
                            </div>
                            <div class="col-md-3">
                                <label for="quantity2" class="form-label">Weight (kg)</label>
                                <input type="number" class="form-control small-input" id="quantity2" value="1" min="1" step="0.5" onchange="updateTotal()" style="width: 80%;">
                            </div>
                            <div class="col-md-1 d-flex justify-content-end">
                                <button class="btn btn-danger btn-sm">Remove</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cart Summary -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5>Order Summary</h5>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <p>Subtotal</p>
                            <p id="subtotal">$0</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p>Shipping</p>
                            <p>$5</p>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <h6>Total</h6>
                            <h6 id="total">$5</h6>
                        </div>
                        <button class="btn btn-primary w-100 mt-3">Proceed to Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

</body>

</html>
