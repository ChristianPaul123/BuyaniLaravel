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
            overflow: hidden;
            /* Prevents overflow */
            width: 100%;
            /* 5 items + gap compensation */
        }

        .item-list .card {
            flex: 0 0 250px;
            /* Fixed width for each card */
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

        /* .btn {
                                            background-color: rgb(224, 121, 31);
                                            color: white;
                                            border-color: rgb(224, 121, 31);
                                        } */

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
            /* max-width: 1000px; */
            /* Increase the modal width */
            /* max-height: 800px; */
        }



        #productForm {
            flex: 1;
            /* Make it take up equal space */
            min-width: 300px;
            /* Set a minimum width */
        }


        #liveTitle,
        #liveDescription {
            word-break: break-word;
            /* Break long words */
            width: 100%;
            /* Ensure it spans the available width */
            max-height: 100px;
            /* Limit the height */
            overflow-y: auto;
            /* Add scroll if content is too long */
        }

        #productTitle,
        #productDescription {
            max-height: 100px;
            /* Limit the height */
            overflow-y: auto;
            /* Add scroll if content is too long */
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
            overflow-y: auto;
            /* Add scroll if modal content is too long */
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
                    @foreach ($lowStockProducts as $product)
                        <div class="card">
                            <!-- If you have a product_pic or similar field -->
                            <img class="card-img-top item" src="{{ $product->product_pic ?? 'img/default.png' }}"
                                alt="{{ $product->product_name }}">

                            <div class="card-body">
                                <h5 class="card-title">{{ $product->product_name }}</h5>
                                @php
                                $prices = $product->productSpecification()->pluck('product_price');
                                @endphp
                                @if ($prices->isNotEmpty())
                                    <p class="mb-0 text-success fw-bold">
                                        ₱{{ number_format($prices->min(), 2) }} ~ ₱{{ number_format($prices->max(), 2) }}
                                    </p>
                                @else
                                    <p class="text-info fw-bold">NEW</p>
                                @endif
                                <!-- The “Low Stock” badge or button -->
                                @if ($product->inventory && $product->inventory->product_total_stock < 50)
                                    <a href="#" class="btn-stock btn-primary">
                                        Low Stock ({{ $product->inventory->product_total_stock }})
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Button to trigger modal -->
        <div class="mt-3 d-flex justify-content-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productModal">
                <h5> <i class="fa fa-add fa-md"></i> Add Product </h5>
            </button>
        </div>

        <div class="table-responsive mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>PRODUCT NAME</th>
                        <th>DESCRIPTION</th>
                        <th>IMAGE</th>
                        <th>SUGGESTED PRICE</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        if (count($farmerProduce) > 0) {
                            foreach ($farmerProduce as $produce) {
                                echo '<tr>';
                                echo '<td>' . $produce->produce_name . '</td>';
                                echo '<td>' . $produce->produce_description . '</td>';
                                echo '<td><img src="' .
                                    asset('farmer_produce_images/' . $produce->produce_image) .
                                    '" alt="Product Image" style="width: 100px; height: 100px;"></td>';
                                echo '<td>' . $produce->suggested_price . '</td>';
                                echo '<td>
                                    <a class="btn btn-primary" onclick=editProduct("' .
                                    $produce->id .
                                    '")>
                                        <i class="fa fa-edit fa-sm me-2"></i>Edit
                                    </a>
                                    <a class="btn btn-danger" onclick=showDeleteConfirmation("' .
                                    $produce->id .
                                    '")>
                                        <i class="fa fa-trash fa-sm me-2"></i>Delete
                                    </a>
                                    </td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="5">No products found.</td></tr>';
                        }
                    @endphp
                </tbody>
            </table>
        </div>


    </div>

    <!-- Modal -->
    <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title" id="productModalLabel">Add Product</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                        style="border: none;background: none;">
                        <span aria-hidden="true" style="font-size: 1.5rem; color: #333; font-weight: bold;">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="productForm">
                        {{-- action="{{ route('user.farmer.supply.product.save') }}" method="POST" enctype="multipart/form-data" --}}
                        @csrf
                        <div class="row">
                            <!-- Form Section -->
                            <div class="col-md-6">

                                <div class="form-group mb-2">
                                    <label for="productImage">Upload Image:</label>
                                    <input type="file" class="form-control" id="productImage" accept="image/*"
                                        name="produce_image">
                                </div>
                                <div class="form-group mb-2">
                                    <label for="productTitle">Title:</label>
                                    <input type="text" class="form-control" id="productTitle" maxlength="20"
                                        placeholder="Enter product title" name="produce_name">
                                </div>
                                <div class="form-group mb-2">
                                    <label for="productDescription">Description:</label>
                                    <textarea class="form-control" id="productDescription" maxlength="40" rows="3"
                                        placeholder="Enter product description" name="produce_description"></textarea>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="productPrice">Suggested Price:</label>
                                    <input type="number" class="form-control" id="productPrice"
                                        placeholder="Enter suggested price" step="0.01" name="suggested_price">
                                </div>

                            </div>

                            <!-- Live Preview Section -->
                            <div class="col-md-6">
                                <div class="live-preview">
                                    <h5 class="mb-4">Live Preview</h5>
                                    <p class="mb-4"><strong>Title:</strong> <span id="liveTitle"></span></p>
                                    <p class="mb-4"><strong>Description:</strong> <span id="liveDescription"></span></p>
                                    <p class="mb-4"><strong>Suggested Price:</strong> <span id="livePrice"></span></p>
                                    <p class="mb-4"><strong>Image Preview:</strong></p>
                                    <img id="liveImage" src="#" alt="Image Preview" class="img-fluid"
                                        style="max-height: 200px;">
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="submit" class="btn btn-primary">Submit Product</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    {{-- Edit Modal --}}

    <div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                        style="border: none;background: none;">
                        <span aria-hidden="true" style="font-size: 1.5rem; color: #333; font-weight: bold;">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editProductForm">
                        @csrf
                        <div class="row">
                            <!-- Form Section -->
                            <div class="col-md-6">
                                <input type="hidden" name="id" id="productId2">
                                <div class="form-group mb-2">
                                    <label for="productImage">Upload Image:</label>
                                    <input type="file" class="form-control" id="productImage2" accept="image/*"
                                        name="produce_image">
                                </div>
                                <div class="form-group mb-2">
                                    <label for="productTitle">Title:</label>
                                    <input type="text" class="form-control" id="productTitle2" maxlength="20"
                                        placeholder="Enter product title" name="produce_name">
                                </div>
                                <div class="form-group mb-2">
                                    <label for="productDescription">Description:</label>
                                    <textarea class="form-control" id="productDescription2" maxlength="40" rows="3"
                                        placeholder="Enter product description" name="produce_description"></textarea>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="productPrice">Suggested Price:</label>
                                    <input type="number" class="form-control" id="productPrice2"
                                        placeholder="Enter suggested price" step="0.01" name="suggested_price">
                                </div>

                            </div>

                            <!-- Live Preview Section -->
                            <div class="col-md-6">
                                <div class="live-preview">
                                    <h5 class="mb-4">Live Preview</h5>
                                    <p class="mb-4"><strong>Title:</strong> <span id="liveTitle2"></span></p>
                                    <p class="mb-4"><strong>Description:</strong> <span id="liveDescription2"></span>
                                    </p>
                                    <p class="mb-4"><strong>Suggested Price:</strong> <span id="livePrice2"></span></p>
                                    <p class="mb-4"><strong>Image Preview:</strong></p>
                                    <img id="liveImage2" src="#" alt="Image Preview" class="img-fluid"
                                        style="max-height: 200px;">
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Delete Modal  -->
    <div class="modal fade" id="deleteProductModal" tabindex="-1" role="dialog"
        aria-labelledby="deleteProductModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteProductModalLabel">Confirm Deletion</h5>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this product? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <div id="successMessage" class="position-fixed top-0 start-50 translate-middle-x mt-3" style="display: none; z-index: 1050; width: 50%;">
        <div class="alert alert-success d-flex align-items-center w-100 shadow" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i>
            <h5 class="m-0 flex-grow-1" id="notif-msg"></h5> <!-- Flash message content -->
            <button type="button" class="btn-close ms-2" onclick="this.parentElement.parentElement.style.display='none';" aria-label="Close"></button>
        </div>
    </div>


    @include('user.includes.unverified-modal')
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function editProduct(id) {
            $.ajax({
                url: "{{ route('user.farmer.supply.product.edit') }}",
                type: "GET",
                data: {
                    id: id
                },
                success: function(response) {
                    $('#productId2').val(id);
                    $('#productTitle2').val(response.produce_name);
                    $('#productDescription2').val(response.produce_description);
                    $('#productPrice2').val(response.suggested_price);
                    $('#liveTitle2').text(response.produce_name);
                    $('#liveDescription2').text(response.produce_description);
                    $('#livePrice2').text(response.suggested_price);
                    $('#liveImage2').attr('src', "{{ asset('farmer_produce_images') }}/" + response
                        .produce_image);
                    $('#editProductModal').modal('show');
                }
            });
        }

        var productIdToDelete = null; // Variable to store the ID of the product to be deleted

        // Function to show the confirmation modal
        function showDeleteConfirmation(id) {
            productIdToDelete = id; // Store the product ID to delete
            $('#deleteProductModal').modal('show'); // Show the confirmation modal
        }

        // Function to handle product deletion when confirmed
        $('#confirmDeleteButton').on('click', function() {
            // Send AJAX request to delete the product
            $.ajax({
                url: "{{ route('user.farmer.supply.product.delete') }}", // The route for deletion
                type: "POST",
                data: {
                    id: productIdToDelete,
                    _token: "{{ csrf_token() }}" // Include CSRF token for security
                },
                success: function(response) {
                    $('#deleteProductModal').modal('hide'); // Close the confirmation modal
                    $('#notif-msg').text(response.success);
                    $('#successMessage').slideDown();
                    setTimeout(() => {
                        $('#successMessage').slideUp();
                        window.location.reload();
                    }, 1000);
                },
                error: function(xhr, status, error) {
                    alert('Error: ' + error); // Show error message
                }
            });
        });


        $(document).ready(function() {
            $('#editProductForm').on('submit', function(e) {
                e.preventDefault(); // Prevent the form from submitting the traditional way

                var formData = new FormData(this); // Collect form data, including the file

                $.ajax({
                    url: "{{ route('user.farmer.supply.product.update') }}", // Define the correct route
                    type: "POST",
                    data: formData,
                    contentType: false, // Necessary for file uploads
                    processData: false, // Don't process the data
                    success: function(response) {
                        $('#notif-msg').text(response.success);
                        $('#editProductModal').modal('hide');
                        $('#successMessage').slideDown();
                        setTimeout(() => {
                            $('#successMessage').slideUp();
                            window.location.reload();
                        }, 1000);
                    },
                    error: function(xhr, status, error) {
                        let errors = xhr.responseJSON.errors;
                        $('.invalid-feedback').remove();
                        $('.is-invalid').removeClass('is-invalid');

                        $.each(errors, function(key, value) {
                            let input = $(`[name="${key}"]`);
                            input.addClass('is-invalid');
                            input.after(
                                `<div class="invalid-feedback">${value[0]}</div>`);
                        });
                    }
                });
            });
        });
        $('#productForm').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('user.farmer.supply.product.save') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#productForm')[0].reset();
                    $('#liveTitle, #liveDescription, #livePrice').text('');
                    $('#liveImage').attr('src', '#');
                    $('#productModal').modal('hide');
                    $('#notif-msg').text(response.success);
                    $('#successMessage').slideDown();
                    setTimeout(() => {
                        $('#successMessage').slideUp();
                        window.location.reload();
                    }, 1000);
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    $('.invalid-feedback').remove();
                    $('.is-invalid').removeClass('is-invalid');

                    $.each(errors, function(key, value) {
                        let input = $(`[name="${key}"]`);
                        input.addClass('is-invalid');
                        input.after(`<div class="invalid-feedback">${value[0]}</div>`);
                    });
                }
            });
        });
    </script>

    <script>
        // code for carousel
        const list = document.getElementById('item-list');
        const items = document.querySelectorAll('.item');
        const itemWidth = 210;
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
        // $('#productTitle').on('input', function() {
        //     const badWords = /fuck|butt|tangina|nigga|shit|nig|fck|butsalo|tanga|tanginamo/gi;
        //     const sanitized = $(this).val().replace(badWords, '***********');
        //     $('#liveTitle').text(sanitized);
        // });

        // $('#productTitle2').on('input', function() {
        //     const badWords = /fuck|butt|tangina|nigga|shit|nig|fck|butsalo|tanga|tanginamo/gi;
        //     const sanitized = $(this).val().replace(badWords, '***********');
        //     $('#liveTitle2').text(sanitized);
        // });

        // $('#productDescription').on('input', function() {
        //     const badWords = /fuck|butt|tangina|nigga|shit|nig|fck|butsalo|tanga|tanginamo/gi;
        //     const sanitized = $(this).val().replace(badWords, '**********');
        //     $('#liveDescription').text(sanitized);
        // });

        // $('#productDescription2').on('input', function() {
        //     const badWords = /fuck|butt|tangina|nigga|shit|nig|fck|butsalo|tanga|tanginamo/gi;
        //     const sanitized = $(this).val().replace(badWords, '**********');
        //     $('#liveDescription2').text(sanitized);
        // });

        // Define the bad words regex once
        const badWords = /fuck|butt|tangina|nigga|shit|nig|fck|butsalo|tanga|tanginamo|bitch|asshole|crap|dumb|slut|whore|bastard|piss|dick|cock|pussy|damn|hell|cunt|retard|idiot|jerk|prick/gi;

        // Event listener for productTitle
        $('#productTitle').on('input', function() {
            const sanitized = $(this).val().replace(badWords, '***********');
            $('#liveTitle').text(sanitized);
        });

        // Event listener for productTitle2
        $('#productTitle2').on('input', function() {
            const sanitized = $(this).val().replace(badWords, '***********');
            $('#liveTitle2').text(sanitized);
        });

        // Event listener for productDescription
        $('#productDescription').on('input', function() {
            const sanitized = $(this).val().replace(badWords, '**********');
            $('#liveDescription').text(sanitized);
        });

        // Event listener for productDescription2
        $('#productDescription2').on('input', function() {
            const sanitized = $(this).val().replace(badWords, '**********');
            $('#liveDescription2').text(sanitized);
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

        $('#productPrice2').on('input', function() {
            let price = parseFloat($(this).val());

            // If the input is not a number or is less than 0, reset the input and live preview
            if (isNaN(price) || price < 0) {
                $('#productPrice2').val('');
                $('#livePrice2').text('');
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

            $('#livePrice2').text(formattedPrice);
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

        $('#productImage2').on('change', function(event) {
            const file = event.target.files[0];
            if (file && file.size > 2 * 1024 * 1024) { // Limit to 2MB
                alert('Image size should not exceed 2MB.');
                $(this).val('');
            } else if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#liveImage2').attr('src', e.target.result).show();
                };
                reader.readAsDataURL(file);
            }
        });

        // Submit product form
        // $('#productForm').on('submit', function(event) {
        //     event.preventDefault();

        //     const title = $('#productTitle').val();
        //     const description = $('#productDescription').val();
        //     const price = $('#productPrice').val();
        //     const imageInput = $('#productImage')[0];

        //     if (!title || !description || !price || !imageInput.files.length) {
        //         alert('Please fill in all fields and upload an image.');
        //         return;
        //     }

        //     const reader = new FileReader();
        //     reader.onload = function(e) {
        //         products.push({
        //             title: title,
        //             description: description,
        //             price: parseFloat(price).toFixed(2),
        //             image: e.target.result,
        //             lowStock: true
        //         });
        //         // updateCarousel();
        //         alert('Product submitted successfully!');
        //     };
        //     reader.readAsDataURL(imageInput.files[0]);

        //     $('#productForm')[0].reset();
        //     $('#liveTitle, #liveDescription, #livePrice').text('');
        //     $('#liveImage').hide();
        // });

        // updateCarousel();
    </script>
@endsection
