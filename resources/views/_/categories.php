<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Orders</title>
    <!-- Bootstrap CSS -->

</head>

<body>
    <?php include 'navbar-consumer.php'; ?>

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-10">
                <h2 class="mb-4">Product Category</h2>
            </div>
            <div class="col-2">
                <button type="button" class="btn btn-success">Create Category</button>
                <button type="button" class="btn btn-success">Create Subcategory</button>
            </div>
        </div>


        <!-- Tabs for Order Categories -->
        <ul class="nav nav-tabs" id="orderTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="toPay-tab" data-bs-toggle="tab" data-bs-target="#toPay" type="button" role="tab">Main Category</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="toShip-tab" data-bs-toggle="tab" data-bs-target="#toShip" type="button" role="tab">Sub Category</button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="orderTabsContent">
            <!-- To Pay -->
            <div class="tab-pane fade show active" id="toPay" role="tabpanel">
                <div class="mt-3">
                    <h5>Main Category</h5>
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
                    <h5>Sub Category</h5>
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



        </div>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>
