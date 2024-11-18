<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Product</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Stars -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        * {
            /* border: 1px solid black;   */
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Input Box Buttons */
        #decrementBtn,
        #incrementBtn {
            width: 40px;
            font-size: 1.25em;
            font-weight: bold;
        }

        #inputBox {
            text-align: center;
            border: none;
            outline: none;
            padding: 0.5em;
            font-size: 1.25em;
            border-radius: 0;
            -moz-appearance: textfield; /* Remove arrows in Firefox */
        }

        #inputBox::-webkit-outer-spin-button,
        #inputBox::-webkit-inner-spin-button {
            -webkit-appearance: none; /* Remove arrows in WebKit browsers */
            margin: 0;
        }

        .btn-outline-secondary:hover {
            background-color: #e0e0e0; /* Slight gray on hover */
            color: #333;
        }

        .input-group {
            display: flex;
            align-items: center;
            justify-content: center;
        }



        /* Star Rating */
        .star-rating {
            font-size: 2rem;
            color: #ddd;
            cursor: pointer;
        }
        .star-rating .fas {
            color: #FFD700; /* Gold color for selected stars */
        }


        /* Comment Section */
        .comment-box {
            max-height: 300px; /* Adjust height as needed */
            overflow-y: auto;
            padding: 15px;
            border: 1px solid #ddd;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
        .comment {
            padding: 10px 0;
        }
        .comment-header {
            font-weight: bold;
            display: flex;
            justify-content: space-between;
        }
        .rating {
            font-size: 0.9em;
            color: #888;
        }
        .divider {
            border-top: 1px solid #e9ecef;
            margin: 10px 0;
        }
        /* Style for the star icons */
        .star-rating-comments i {
            color: #ffc107; /* Bootstrap yellow for stars */
            margin-left: 3px; /* Space between stars */
        }
    </style>
</head>
<body>
    <div class="container mb-5 pt-5 pb-3">
        <div class="row">
            <!-- Image Section -->
            <div class="col-12 col-md-6 p-3">
                <div class="image-container" style="height: 400px; width: 100%; overflow: hidden;">
                    <img src="img/logo1.svg" style="object-fit: fill; width: 100%; height: 100%;">
                </div>
            </div>
            <!-- Content Section -->
            <div class="col-12 col-md-6 d-flex flex-column gap-3">
                <h4>PRODUCT INFORMATION</h4>
                <h5>Name</h5>
                <h5>Tags</h5>
                <h5>In Store</h5>
                <h5>Product Specifications</h5>
                <div class="row m-0">
                    <div class="col-3 w-auto p-0">
                        <h5>Quantity in KG:</h5>
                    </div>
                    <div class="col-4 w-auto px-2">
                        <form action="/submit" method="POST" class="w-auto d-flex flex-column align-items-center">
                            <div class="input-group justify-content-center">
                                <button class="btn btn-outline-secondary" type="button" id="decrementBtn">-</button>
                                <input type="number" class="form-control text-center" id="inputBox" name="quantity" value="0" max="20" min="0" step="1" style="width: 100px;">
                                <button class="btn btn-outline-secondary" type="button" id="incrementBtn">+</button>
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Add To Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <h4>Product Reviews</h4>
            <div class="container px-5">
                <h5>Your Rating:</h5>
                <div class="star-rating">
                    <i class="far fa-star" data-index="1"></i>
                    <i class="far fa-star" data-index="2"></i>
                    <i class="far fa-star" data-index="3"></i>
                    <i class="far fa-star" data-index="4"></i>
                    <i class="far fa-star" data-index="5"></i>
                    <!-- lagayan ng value variable for submission -->
                    <input type="hidden" id="star-rating-input" name="starRating" value="0">
                </div>
                <textarea id="user-comment" class="form-control" rows="4" placeholder="Add your comment here..." maxlength="200"></textarea>
                <!-- <p class="mt-3">Your Rating: <span id="rating-value">0</span>/5</p> -->
                <button type="submit" class="btn btn-primary mt-3">Submit Review</button>
            </div>
        </div>


        <div class="row mt-3 mb-5">
            <h4>Product Comments</h4>
            <div class="container px-5">
                <div class="comment-box">
                    <div class="comment">
                        <div class="comment-header">
                            <div class="user-name">
                                <span>User 1</span>
                                <span class="comment-date" style="font-size: 0.85em; color: #888; margin-left: 10px;">2024-11-13</span>
                            </div>
                            <span class="rating">Rating:
                                <span class="star-rating-comments" id="rating-user-1"></span>
                            </span>
                        </div>
                        <p>This is a sample comment from User 1.</p>
                        <div class="divider"></div>
                    </div>

                    <div class="comment">
                        <div class="comment-header">
                            <div class="user-name">
                                <span>User 2</span>
                                <span class="comment-date" style="font-size: 0.85em; color: #888; margin-left: 10px;">2024-11-13</span>
                            </div>
                            <span class="rating">Rating:
                                <span class="star-rating-comments" id="rating-user-2"></span>
                            </span>
                        </div>
                        <p>This is a sample comment from User 1.</p>
                        <div class="divider"></div>
                    </div>

                    <div class="comment">
                        <div class="comment-header">
                            <div class="user-name">
                                <span>User 3</span>
                                <span class="comment-date" style="font-size: 0.85em; color: #888; margin-left: 10px;">2024-11-13</span>
                            </div>
                            <span class="rating">Rating:
                                <span class="star-rating-comments" id="rating-user-3"></span>
                            </span>
                        </div>
                        <p>This is a sample comment from User 1.</p>
                        <div class="divider"></div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap and JavaScript dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- User Rating -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <!-- Comment Section -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



    <script>
        const decrementBtn = document.getElementById('decrementBtn');
        const incrementBtn = document.getElementById('incrementBtn');
        const inputBox = document.getElementById('inputBox');

        // Function to ensure value is between 0 and 20 and not empty
        function ensureValueLimit() {
            let currentValue = parseInt(inputBox.value) || 0;  // If value is empty, set it to 0
            if (currentValue < 0) {
                inputBox.value = 0;
            } else if (currentValue > 20) {
                inputBox.value = 20;
            } else {
                inputBox.value = currentValue;
            }
        }

        // Event listener for the decrement button
        decrementBtn.addEventListener('click', () => {
            let currentValue = parseInt(inputBox.value) || 0;
            if (currentValue > 0) {
                inputBox.value = currentValue - 1;
            }
            ensureValueLimit();
        });

        // Event listener for the increment button
        incrementBtn.addEventListener('click', () => {
            let currentValue = parseInt(inputBox.value) || 0;
            if (currentValue < 20) {
                inputBox.value = currentValue + 1;
            }
            ensureValueLimit();
        });

        // Event listener to ensure the input box never becomes empty
        inputBox.addEventListener('input', () => {
            if (inputBox.value === '') {
                inputBox.value = 0;
            }
            ensureValueLimit();
        });

        // Ensure that input starts with 0
        ensureValueLimit();
    </script>

    <!-- Star Rating -->
    <script>
        $(document).ready(function() {
            let rating = 0;
            highlightStars(rating); // Highlight stars up to the initial rating

            // Handle star hover effect
            $('.star-rating i').on('mouseenter', function() {
                const index = $(this).data('index');
                highlightStars(index);
            });

            // Remove highlight when not hovering
            $('.star-rating i').on('mouseleave', function() {
                highlightStars(rating); // Keep selected rating highlighted
            });

            // Handle star click
            $('.star-rating i').on('click', function() {
                rating = $(this).data('index');
                $('#rating-value').text(rating);
                $('#star-rating-input').val(rating); // Update the hidden input with the rating value
                highlightStars(rating);
            });

            // Function to highlight stars up to a specific index
            function highlightStars(index) {
                $('.star-rating i').each(function() {
                    const starIndex = $(this).data('index');
                    $(this).toggleClass('fas', starIndex <= index);
                    $(this).toggleClass('far', starIndex > index);
                });
            }
        });
    </script>

    <!-- Comment Section Star Ratings -->
    <script>
        // Function to render stars based on the rating variable
        function renderStars(rating, elementId) {
            const starContainer = document.getElementById(elementId);
            starContainer.innerHTML = ''; // Clear previous stars
            for (let i = 1; i <= 5; i++) {
                const starClass = i <= rating ? 'fas fa-star' : 'far fa-star';
                const star = document.createElement('i');
                star.className = starClass;
                starContainer.appendChild(star);
            }
        }

        // Set ratings dynamically
        const ratingUser1 = 1;
        const ratingUser2 = 3;
        const ratingUser3 = 4;

        renderStars(ratingUser1, 'rating-user-1');
        renderStars(ratingUser2, 'rating-user-2');
        renderStars(ratingUser3, 'rating-user-3');
    </script>

</body>
</html>
