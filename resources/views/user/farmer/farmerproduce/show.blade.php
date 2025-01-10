@extends('layouts.app')

@section('title', 'Farmer Shop')

@push('styles')
<style>
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f8f9fa;
        }

        .carousel-item img {
            max-height: 300px;
            object-fit: cover;
        }

        .container {
            margin-bottom: 30px;
        }

        .low-stock {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: red;
            color: white;
            padding: 5px;
            font-size: 12px;
            border-radius: 5px;
        }

        .carousel-container {
            overflow: hidden;
            width: 100%;
        }

        .item-list {
            display: flex;
            gap: 10px;
            scroll-behavior: smooth;
            transition: transform 0.5s ease-in-out;
        }

        .card {
            position: relative;
            width: 18rem;
        }

        .card img {
            height: 200px;
            object-fit: cover;
            width: 100%;
        }

        .card-body {
            text-align: center;
        }

        #liveImage {
            max-width: 100%;
            max-height: 200px;
            display: none;
            align-items: center;
        }

        .btn {
            background-color: rgb(224, 121, 31);
            color: white;
            border-color: rgb(224, 121, 31);
        }

        .btn-stock {
            background-color: rgb(238, 11, 11);
            color: white;
            border-color: rgb(224, 121, 31);
            padding: .375rem .75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: .25rem;
        }

        .add-btn {
            background-color: rgb(224, 121, 31);
            color: white;
            border-color: rgb(224, 121, 31);
            float: right;
            margin-top: -65px;
            margin-right: 25px;
            padding: .375rem .75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: .25rem;
        }

        /* css for modal*/
        .modal-dialog {
            max-width: 1000px; /* Increase the modal width */
            max-height: 800px;
        }

        .modal-body {
            display: flex;
            flex-wrap: wrap; /* Allow wrapping */
            align-items: flex-start; /* Align items at the top */
        }

        #productForm {
            flex: 1; /* Make it take up equal space */
            min-width: 300px; /* Set a minimum width */
        }

        .live-preview {
            flex: 1; /* Make it take up equal space */
            min-width: 300px; /* Set a minimum width */
            text-align: left; /* Center the content */
            border: 1px solid;
        }

        .live-preview img {
            margin: 0 auto; /* Center the image */
        }

        #liveTitle, #liveDescription {
            word-break: break-word; /* Break long words */
            width: 100%; /* Ensure it spans the available width */
            max-height: 100px; /* Limit the height */
            overflow-y: auto; /* Add scroll if content is too long */
        }

        #productTitle, #productDescription {
            max-height: 100px; /* Limit the height */
            overflow-y: auto; /* Add scroll if content is too long */
        }

        /* Ensure the modal does not move and limit character input */
        #productTitle {
            max-width: 100%;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;

        }

        #productDescription {
            max-width: 100%;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;

        }

        /* Additional styles to ensure modal stability */
        .modal {
            overflow-y: auto; /* Add scroll if modal content is too long */
        }


        .image-row .col img {
            width: 100%;
            height: auto;
            background: orange;
            display: block;
            text-align: center;
            color: white;
            font-weight: bold;
            padding: 20px;
        }

        table th {
            background-color: #62b613;
            color: white;
            text-align: center;
        }

        table td {
            text-align: center;
        }

        .btn-add-product {
            background-color: orange;
            color: white;
            border: none;
            font-size: 16px;
        }
    </style>
@endpush

@section('content')
@include('user.includes.navbar-farmer')
    <div class="container mt-5">
        <div class="carousel-container">
            <div class="carousel-view">
                <div id="item-list" class="item-list">
                    <div class="card">
                        <img class="card-img-top item" src="img/product1.png" alt="Product 1">
                        <div class="card-body">
                            <h5 class="card-title">Product 1</h5>
                            <p class="card-text">Description of Product 1</p>
                            <a href="#" class="btn-stock btn-primary">Low Stock</a>
                        </div>
                    </div>
                    <div class="card">
                        <img class="card-img-top item" src="img/product2.png" alt="Product 2">
                        <div class="card-body">
                            <h5 class="card-title">Product 2</h5>
                            <p class="card-text">Description of Product 2</p>
                            <a href="#" class="btn-stock btn-primary">Low Stock</a>
                        </div>
                    </div>
                    <div class="card">
                        <img class="card-img-top item" src="img/product3.png" alt="Product 3">
                        <div class="card-body">
                            <h5 class="card-title">Product 3</h5>
                            <p class="card-text">Description of Product 3</p>
                            <a href="#" class="btn-stock btn-primary">Low Stock</a>
                        </div>
                    </div>
                    <div class="card">
                        <img class="card-img-top item" src="img/product4.png" alt="Product 4">
                        <div class="card-body">
                            <h5 class="card-title">Product 4</h5>
                            <p class="card-text">Description of Product 4</p>
                            <a href="#" class="btn-stock btn-primary">Low Stock</a>
                        </div>
                    </div>
                    <div class="card">
                        <img class="card-img-top item" src="img/squash.png" alt="Product 5">
                        <div class="card-body">
                            <h5 class="card-title">Product 5</h5>
                            <p class="card-text">Description of Product 5</p>
                            <a href="#" class="btn-stock btn-primary">Low Stock</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>PRODUCT NAME</th>
                        <th>DETAILS</th>
                        <th>ADD IMAGE</th>
                        <th>PRICE PER KILO</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>APPLE</td>
                        <td>AVAILABLE</td>
                        <td>IMG</td>
                        <td>60.00</td>
                        <td><a href="#" class="text-primary">Edit</a> | <a href="#" class="text-danger">Delete</a></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Button to trigger modal -->
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#productModal">
                Add Product
            </button>
        </div>
    </div>

    <!-- Modal -->
<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">Add Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="productForm" class="w-50 mr-3">
                    <div class="form-group">
                        <label for="productImage">Upload Image:</label>
                        <input type="file" class="form-control" id="productImage" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label for="productTitle">Title:</label>
                        <input type="text" class="form-control" id="productTitle" maxlength="20" placeholder="Enter product title">
                    </div>
                    <div class="form-group">
                        <label for="productDescription">Description:</label>
                        <textarea class="form-control" id="productDescription" maxlength="40" rows="3" placeholder="Enter product description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="productPrice">Suggested Price:</label>
                        <input type="number" class="form-control" id="productPrice" placeholder="Enter suggested price" step="0.01">
                    </div>
                </form>
                <div class="live-preview w-50">
                    <h5>Live Preview</h5>
                    <p><strong>Title:</strong> <span id="liveTitle"></span></p>
                    <p><strong>Description:</strong> <span id="liveDescription"></span></p>
                    <p><strong>Suggested Price:</strong> <span id="livePrice"></span></p>
                    <p><strong>Image Preview:</strong></p>
                    <img id="liveImage" src="#" alt="Image Preview" class="img-fluid">
                </div>
            </div>
            <div class="text-center mt-3">
                <button type="submit" class="add-btn btn-primary">Submit Product</button>
            </div>
        </div>
    </div>
</div>
@include('user.includes.unverified-modal')
@endsection

@section('scripts')
    <script>
        // code for carousel
        const list = document.getElementById('item-list');
        const items = document.querySelectorAll('.item');
        const itemWidth = items[0].offsetWidth + 10; // Include gap
        let autoMoveInterval;

        // Function to shift the first image to the end
        const shiftFirstToLast = () => {
            const firstItem = list.firstElementChild;
            list.appendChild(firstItem); // Move the first item to the end
            list.style.transition = "none"; // Disable transition
            list.style.transform = `translateX(0px)`; // Reset the position
            setTimeout(() => {
                list.style.transition = "transform 0.5s ease-in-out"; // Re-enable transition
            }, 50);
        };

        // Automatically move items
        const autoMove = () => {
            list.style.transform = `translateX(-${itemWidth}px)`; // Move to the next item
            setTimeout(() => {
                shiftFirstToLast(); // Shift the first item to the end after the animation
            }, 500); // Match the transition duration
        };

        // Start the auto-moving carousel
        autoMoveInterval = setInterval(autoMove, 2000); // Move every 2 seconds


        // Input validation for bad words
        $('#productTitle').on('input', function() {
            const badWords = /fuck|butt|tangina|nigga|shit|nig|fck|butsalo|tanga|tanginamo/gi;
            const sanitized = $(this).val().replace(badWords, '***********');
            $('#liveTitle').text(sanitized);
        });

        $('#productDescription').on('input', function() {
            const badWords = /fuck|butt|tangina|nigga|shit|nig|fck|butsalo|tanga|tanginamo/gi;
            const sanitized = $(this).val().replace(badWords, '**********');
            $('#liveDescription').text(sanitized);
        });

        $('#productPrice').on('input', function() {
    let price = parseFloat($(this).val());

    // If the input is not a number or is less than 0, reset the input and live preview
    if (isNaN(price) || price < 0) {
        $('#productPrice').val('');
        $('#livePrice').text('');
        return;
    }

    // Limit the price to a maximum of 2000
    if (price > 2000) {
        price = 2000;
        $(this).val(price.toFixed(2));
    }

    // Format the price with commas and two decimal places
    let formattedPrice = price.toLocaleString('en-US', {
        style: 'currency',
        currency: 'PHP',
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }).replace('PHP', '₱');

    $('#livePrice').text(formattedPrice);
});

        // Image preview handling
        $('#productImage').on('change', function(event) {
            const file = event.target.files[0];
            if (file && file.size > 2 * 1024 * 1024) { // Limit to 2MB
                alert('Image size should not exceed 2MB.');
                $(this).val('');
            } else if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#liveImage').attr('src', e.target.result).show();
                };
                reader.readAsDataURL(file);
            }
        });

        // Submit product form
        $('#productForm').on('submit', function(event) {
            event.preventDefault();

            const title = $('#productTitle').val();
            const description = $('#productDescription').val();
            const price = $('#productPrice').val();
            const imageInput = $('#productImage')[0];

            if (!title || !description || !price || !imageInput.files.length) {
                alert('Please fill in all fields and upload an image.');
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                products.push({
                    title: title,
                    description: description,
                    price: parseFloat(price).toFixed(2),
                    image: e.target.result,
                    lowStock: true
                });
                updateCarousel();
                alert('Product submitted successfully!');
            };
            reader.readAsDataURL(imageInput.files[0]);

            $('#productForm')[0].reset();
            $('#liveTitle, #liveDescription, #livePrice').text('');
            $('#liveImage').hide();
        });

        updateCarousel();
    </script>
@endsection
