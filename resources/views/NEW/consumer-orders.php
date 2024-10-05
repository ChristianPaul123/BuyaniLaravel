<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Orders</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include 'navbar-consumer.php'; ?>

    <div class="container mt-5 mb-5">
        <h2 class="mb-4">Pending Orders</h2>

        <!-- Tabs for Order Categories -->
        <ul class="nav nav-tabs" id="orderTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="toPay-tab" data-bs-toggle="tab" data-bs-target="#toPay" type="button" role="tab">To Pay</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="toShip-tab" data-bs-toggle="tab" data-bs-target="#toShip" type="button" role="tab">To Ship</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="toReceive-tab" data-bs-toggle="tab" data-bs-target="#toReceive" type="button" role="tab">To Receive</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed" type="button" role="tab">Completed</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="canceled-tab" data-bs-toggle="tab" data-bs-target="#canceled" type="button" role="tab">Canceled</button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="orderTabsContent">
            <!-- To Pay -->
            <div class="tab-pane fade show active" id="toPay" role="tabpanel">
                <div class="mt-3">
                    <h5>Orders Pending Payment</h5>
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row align-items-center g-3">
                                <div class="col-md-2">
                                    <img src="https://via.placeholder.com/100" alt="Product" class="img-fluid">
                                </div>
                                <div class="col-md-4">
                                    <h5 class="card-title">Chili</h5>
                                    <p>Quantity: 1 kg</p>
                                    <p class="text-muted">Price: $3</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Status: <span class="badge bg-warning">Pending Payment</span></p>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-primary w-100" onclick="showPaymentModal()">Pay Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- To Ship -->
            <div class="tab-pane fade" id="toShip" role="tabpanel">
                <div class="mt-3">
                    <h5>Orders Waiting to be Shipped</h5>
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row align-items-center g-3">
                                <div class="col-md-2">
                                    <img src="https://via.placeholder.com/100" alt="Product" class="img-fluid">
                                </div>
                                <div class="col-md-4">
                                    <h5 class="card-title">Peanut</h5>
                                    <p>Quantity: 2 kg</p>
                                    <p class="text-muted">Price: $8</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Status: <span class="badge bg-info">To Ship</span></p>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-secondary w-100" disabled>Shipping Soon</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- To Receive -->
            <div class="tab-pane fade" id="toReceive" role="tabpanel">
                <div class="mt-3">
                    <h5>Orders on the Way</h5>
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row align-items-center g-3">
                                <div class="col-md-2">
                                    <img src="https://via.placeholder.com/100" alt="Product" class="img-fluid">
                                </div>
                                <div class="col-md-4">
                                    <h5 class="card-title">Chili</h5>
                                    <p>Quantity: 1 kg</p>
                                    <p class="text-muted">Price: $3</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Status: <span class="badge bg-success">On the Way</span></p>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-success w-100" onclick="confirmReceipt()">Confirm Receipt</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Completed -->
            <div class="tab-pane fade" id="completed" role="tabpanel">
                <div class="mt-3">
                    <h5>Completed Orders</h5>
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row align-items-center g-3">
                                <div class="col-md-2">
                                    <img src="https://via.placeholder.com/100" alt="Product" class="img-fluid">
                                </div>
                                <div class="col-md-4">
                                    <h5 class="card-title">Peanut</h5>
                                    <p>Quantity: 2 kg</p>
                                    <p class="text-muted">Price: $8</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Status: <span class="badge bg-dark">Completed</span></p>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-outline-secondary w-100" disabled>Order Complete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Canceled -->
            <div class="tab-pane fade" id="canceled" role="tabpanel">
                <div class="mt-3">
                    <h5>Canceled Orders</h5>
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row align-items-center g-3">
                                <div class="col-md-2">
                                    <img src="https://via.placeholder.com/100" alt="Product" class="img-fluid">
                                </div>
                                <div class="col-md-4">
                                    <h5 class="card-title">Chili</h5>
                                    <p>Quantity: 1 kg</p>
                                    <p class="text-muted">Price: $3</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Status: <span class="badge bg-danger">Canceled</span></p>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-outline-danger w-100" disabled>Order Canceled</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                            <input type="text" class="form-control" id="gcashNumber" placeholder="Enter GCash number">
                        </div>
                        <div class="mb-3">
                            <label for="gcashAmount" class="form-label">Amount to Pay</label>
                            <input type="number" class="form-control" id="gcashAmount" placeholder="Enter amount">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Pay with GCash</button>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <script>
        function showPaymentModal() {
            var modal = new bootstrap.Modal(document.getElementById('gcashModal'));
            modal.show();
        }

        function confirmReceipt() {
            alert('Order has been marked as received.');
        }
    </script>

</body>

</html>
