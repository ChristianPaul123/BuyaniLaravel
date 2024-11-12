<style>
    .card {
        width: 100%;
        margin-bottom: 1rem;
    }

    .row {
        display: flex;
        justify-content: flex-start;
        flex-wrap: wrap;
    }

    .pagination {
        justify-content: flex-end;
    }


    <style>
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
</style>


<div class="container container-fluid">
    <section>
        <h3 class='text-center mt-2'>{{ $product->product_name }}</h3>
        <!-- Success Message -->
        @if (session()->has('message'))
            <div class="alert alert-success mx-3 my-2 px-3 py-2">
                <button type="button" class="close btn btn-success" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session('message') }}
            </div>
        @endif

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="alert alert-danger mx-3 my-2 px-3 py-2">
                <button type="button" class="close btn btn-danger" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            {{-- <div class="col-md-6">
                <img class="img-fluid" src="{{ asset($product->product_pic) }}" alt="{{ $product->product_name }}" style="max-width: 80%; height: auto;">
            </div>

            <div class="col-md-6">
                <div class="row md-2 my-2">
                    <p class="h5 text-center">Product Information</p>
                    <div class="col">{{ $product->product_details }}</div>
                </div>
                <div class="row md-2 my-3">
                    <div class="col">Tags: {{ $product->category->category_name }}, {{ $product->subcategory->sub_category_name }}</div>
                </div>
                <div class="row md-2 mb-3">
                    <div class="col">In Store: {{ $product->status_label }}</div>
                </div>

                <div class="row md-2">
                    <div class="col">Product Specification:</div>
                </div>

                <div class="row">
                    @foreach ($specifications as $specification)
                    <div class="col-md-5 m-1">
                        <div class="card"  style="width: auto";>
                            <div class="card-header text-center">
                                <h6 class="mb-0">{{ $specification->specification_name }}</h6>
                            </div>
                            <img src="{{ asset($product->product_pic) }}" class="card-img-top" alt="products {{ $product->product_name }}">
                            <div class="card-body">
                                <p class="card-text">Price: ₱{{ $specification->product_price }}</p>
                                <p class="card-text text-truncate">{{ $specification->specific_product_info }}</p>
                            </div>
                            <form wire:submit.prevent="addToCart({{ $specification->id }})">
                                <div class="row d-flex align-items-center justify-content-center">
                                    <div class="col-8 align-items-center">
                                        <input type="hidden" wire:model="product_status" value="{{ $specification->product->product_status }}">
                                        @error('product_status') <span class="text-warning">{{ $message }}</span> @enderror
                                        <input type="hidden" id="quantity" class="form-control" wire:model="quantities"  min="1">
                                        @error('quantities') <span class="text-warning">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-12 d-flex align-items-end">
                                        <button type="submit" class="btn btn-primary w-100">Add to Cart</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
                </div>
            </div> --}}


            <div class="container mt-5 mb-5 pb-3" style="border: 1px solid #b3b0a1; border-radius: 10px;">
                <div class="row pt-4" style="border: 1px solid #b3b0a1;">
                    <!-- Image Section -->
                    <div class="col-12 col-md-6 p-3">
                        <div class="image-container" style="height: 400px; width: 100%; overflow: hidden;">
                            <img src="{{ asset($product->product_pic) }}" alt="{{ $product->product_name }}" style="object-fit: fill; width: 100%; height: 100%;">
                        </div>
                    </div>
                    <!-- Content Section -->
                    <div class="col-12 col-md-6 d-flex flex-column gap-3">
                        <h4>PRODUCT INFORMATION</h4>
                        <h5>{{ $product->product_details }}</h5>
                        <h5>Tags: {{ $product->category->category_name }}, {{ $product->subcategory->sub_category_name }}</h5>
                        <h5>In Store: {{ $product->status_label }}</h5>
                        <h5>Product Specifications:</h5>
                        <div class="container">
                            <!-- lagay mo dito stuff pa na ilalagay, layout ko nalang -->
                            <h5>Price</h5>

                        </div>
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

        </div>
    </section>

      {{-- Placeholder for Product Reviews --}}
        <section>
@livewire('product-rating-system',['productId' => $product->id])
        </section>


<!-- Bootstrap 5 and JavaScript dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- User Rating -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> <!-- Only if you need jQuery -->


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


</div>
