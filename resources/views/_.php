<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Shop - Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .profile-pic {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
        }
        .profile-section {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="text-center">
                    <img src="https://via.placeholder.com/150" alt="Profile Picture" class="profile-pic">
                    <h3 class="mt-3">John Doe</h3>
                    <p class="text-muted">johndoe@example.com</p>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit Profile</button>
                </div>
            </div>

            <div class="col-md-8">
                <div class="profile-section">
                    <h4>Personal Information</h4>
                    <ul class="list-group mb-3">
                        <li class="list-group-item">Name: John Doe</li>
                        <li class="list-group-item">Email: johndoe@example.com</li>
                        <li class="list-group-item">Phone: +123456789</li>
                        <li class="list-group-item">Address: 123 Main St, City, Country</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Profile Modal -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="nameInput" class="form-label">Name</label>
                            <input type="text" class="form-control" id="nameInput" value="John Doe">
                        </div>
                        <div class="mb-3">
                            <label for="emailInput" class="form-label">Email</label>
                            <input type="email" class="form-control" id="emailInput" value="johndoe@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="phoneInput" class="form-label">Phone</label>
                            <input type="tel" class="form-control" id="phoneInput" value="+123456789">
                        </div>
                        <div class="mb-3">
                            <label for="addressInput" class="form-label">Address</label>
                            <input type="text" class="form-control" id="addressInput" value="123 Main St, City, Country">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
