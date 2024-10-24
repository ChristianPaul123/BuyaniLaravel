<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Custom CSS for Styling -->
    <style>
        .notification-card {
            margin-bottom: 15px;
        }
        .notification-icon {
            font-size: 24px;
            margin-right: 10px;
            vertical-align: middle;
        }
        .icon-orange {
            color: orange;
        }
        .icon-blue {
            color: blue;
        }
        .icon-green {
            color: green;
        }
        .icon-red {
            color: red;
        }
    </style>
</head>
<body>

    <div class="container mt-5">
        <h2 class="mb-4">Notifications</h2>

        <!-- Tabs -->
        <ul class="nav nav-tabs" id="notificationTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="all-updates-tab" data-bs-toggle="tab" data-bs-target="#all-updates" type="button" role="tab" aria-controls="all-updates" aria-selected="true">
                    <span class="material-icons notification-icon icon-orange">notifications</span> All
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="order-updates-tab" data-bs-toggle="tab" data-bs-target="#order-updates" type="button" role="tab" aria-controls="order-updates" aria-selected="false">
                    <span class="material-icons notification-icon icon-blue">local_shipping</span> Order Updates
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="admin-updates-tab" data-bs-toggle="tab" data-bs-target="#admin-updates" type="button" role="tab" aria-controls="admin-updates" aria-selected="false">
                    <span class="material-icons notification-icon icon-red">admin_panel_settings</span> Admin Updates
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="promotions-tab" data-bs-toggle="tab" data-bs-target="#promotions" type="button" role="tab" aria-controls="promotions" aria-selected="false">
                    <span class="material-icons notification-icon icon-green">local_offer</span> Promotions
                </button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content mt-3" id="notificationTabsContent">
            <!-- All Updates -->
            <div class="tab-pane fade show active" id="all-updates" role="tabpanel" aria-labelledby="all-updates-tab">
                <div class="card notification-card">
                    <div class="card-body">
                        <span class="material-icons notification-icon icon-blue">inventory_2</span> Order #12345 has been shipped.
                    </div>
                </div>
                <div class="card notification-card">
                    <div class="card-body">
                        <span class="material-icons notification-icon icon-blue">local_shipping</span> Order #12346 is out for delivery.
                    </div>
                </div>
                <div class="card notification-card">
                    <div class="card-body">
                        <span class="material-icons notification-icon icon-green">check_circle</span> Order #12347 has been delivered.
                    </div>
                </div>
                <div class="card notification-card">
                    <div class="card-body">
                        <span class="material-icons notification-icon icon-orange">warning</span> System maintenance scheduled for Oct 15.
                    </div>
                </div>
                <div class="card notification-card">
                    <div class="card-body">
                        <span class="material-icons notification-icon icon-red">build</span> New admin features have been added.
                    </div>
                </div>
                <div class="card notification-card">
                    <div class="card-body">
                        <span class="material-icons notification-icon icon-red">account_circle</span> Your account settings have been updated.
                    </div>
                </div>
                <div class="card notification-card">
                    <div class="card-body">
                        <span class="material-icons notification-icon icon-green">discount</span> Get 20% off on your next order using code: SAVE20.
                    </div>
                </div>
                <div class="card notification-card">
                    <div class="card-body">
                        <span class="material-icons notification-icon icon-green">local_shipping</span> Free shipping for orders over $50.
                    </div>
                </div>
                <div class="card notification-card">
                    <div class="card-body">
                        <span class="material-icons notification-icon icon-orange">spa</span> New products added to our Fall collection!
                    </div>
                </div>
            </div>

            <!-- Order Updates -->
            <div class="tab-pane fade" id="order-updates" role="tabpanel" aria-labelledby="order-updates-tab">
                <div class="card notification-card">
                    <div class="card-body">
                        <span class="material-icons notification-icon icon-blue">inventory_2</span> Order #12345 has been shipped.
                    </div>
                </div>
                <div class="card notification-card">
                    <div class="card-body">
                        <span class="material-icons notification-icon icon-blue">local_shipping</span> Order #12346 is out for delivery.
                    </div>
                </div>
                <div class="card notification-card">
                    <div class="card-body">
                        <span class="material-icons notification-icon icon-green">check_circle</span> Order #12347 has been delivered.
                    </div>
                </div>
            </div>

            <!-- Admin Updates -->
            <div class="tab-pane fade" id="admin-updates" role="tabpanel" aria-labelledby="admin-updates-tab">
                <div class="card notification-card">
                    <div class="card-body">
                        <span class="material-icons notification-icon icon-orange">warning</span> System maintenance scheduled for Oct 15.
                    </div>
                </div>
                <div class="card notification-card">
                    <div class="card-body">
                        <span class="material-icons notification-icon icon-red">build</span> New admin features have been added.
                    </div>
                </div>
                <div class="card notification-card">
                    <div class="card-body">
                        <span class="material-icons notification-icon icon-red">account_circle</span> Your account settings have been updated.
                    </div>
                </div>
            </div>

            <!-- Promotions -->
            <div class="tab-pane fade" id="promotions" role="tabpanel" aria-labelledby="promotions-tab">
                <div class="card notification-card">
                    <div class="card-body">
                        <span class="material-icons notification-icon icon-green">discount</span> Get 20% off on your next order using code: SAVE20.
                    </div>
                </div>
                <div class="card notification-card">
                    <div class="card-body">
                        <span class="material-icons notification-icon icon-green">local_shipping</span> Free shipping for orders over $50.
                    </div>
                </div>
                <div class="card notification-card">
                    <div class="card-body">
                        <span class="material-icons notification-icon icon-orange">spa</span> New products added to our Fall collection!
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
