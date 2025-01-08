@extends('layouts.app')

@section('title', 'Order Details')

@push('styles')
    <style>
        .status-to-standby {
            background-color: #6c757d;
            color: white;
        }

        .status-to-pay {
            background-color: #ffc107;
            color: black;
        }

        .status-to-ship {
            background-color: #0d6efd;
            color: white;
        }

        .status-completed {
            background-color: #28a745;
            color: white;
        }

        .status-cancelled {
            background-color: #dc3545;
            color: white;
        }

        .status-out-for-delivery {
            background-color: #6a17b8;
            color: white;
        }
    </style>
@endpush

@section('content')

    <body>

        <div class="main-content-wrapper h-100">
            <!-- All your main page content goes here -->
            <div class="container container-fluid mt-1">
                <section class="p-3">

                    <div class="container mt-5 mb-5">
                        <h1>Rate Your Order</h1>
                        <form action="{{ route('user.consumer.order.rate.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="order_id" value="{{ $order->id }}">

                            <div class="mb-3">
                                <div class="mb-3">
                                    <label class="form-label" style="color: #555;">Delivery Rating:</label>
                                    <div class="star-rating" id="delivery-rating" style="font-size: 2rem; color: #FFD700;">
                                        <i class="fa-regular fa-star" data-index="1" style="cursor: pointer;"></i>
                                        <i class="fa-regular fa-star" data-index="2" style="cursor: pointer;"></i>
                                        <i class="fa-regular fa-star" data-index="3" style="cursor: pointer;"></i>
                                        <i class="fa-regular fa-star" data-index="4" style="cursor: pointer;"></i>
                                        <i class="fa-regular fa-star" data-index="5" style="cursor: pointer;"></i>
                                    </div>
                                </div>
                                @error('delivery_rating')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                                <input type="hidden" id="delivery-rating-value" name="delivery_rating" value="">
                            </div>

                            <div class="mb-3">
                                <div class="mb-3">
                                    <label class="form-label" style="color: #555;">Overall Rating:</label>
                                    <div class="star-rating" id="overall-rating" style="font-size: 2rem; color: #FFD700;">
                                        <i class="fa-regular fa-star" data-index="1" style="cursor: pointer;"></i>
                                        <i class="fa-regular fa-star" data-index="2" style="cursor: pointer;"></i>
                                        <i class="fa-regular fa-star" data-index="3" style="cursor: pointer;"></i>
                                        <i class="fa-regular fa-star" data-index="4" style="cursor: pointer;"></i>
                                        <i class="fa-regular fa-star" data-index="5" style="cursor: pointer;"></i>
                                    </div>
                                </div>
                                @error('rating')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                                <input type="hidden" id="overall-rating-value" name="rating" value="">
                            </div>

                            <div class="mb-3">
                                <label for="comment" class="form-label">Comment<i>(Optional)</i></label>
                                <textarea name="comment" id="comment" rows="3" class="form-control"></textarea>
                                @error('comment')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-secondary"
                                    onclick="window.history.back()">Cancel</button>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const deliveryStars = document.querySelectorAll('#delivery-rating i');
                const overallStars = document.querySelectorAll('#overall-rating i');
                let deliveryRating = 0; // Default delivery rating
                let overallRating = 0; // Default overall rating

                // Add event listeners for each star in the Delivery Rating
                deliveryStars.forEach(star => {
                    star.addEventListener('click', function() {
                        deliveryRating = parseInt(star.getAttribute('data-index'));
                        updateStarRating(deliveryStars, deliveryRating);
                        // Optional: Update hidden input for delivery rating
                        document.getElementById('delivery-rating-value').value = deliveryRating;
                    });
                });

                // Add event listeners for each star in the Overall Rating
                overallStars.forEach(star => {
                    star.addEventListener('click', function() {
                        overallRating = parseInt(star.getAttribute('data-index'));
                        updateStarRating(overallStars, overallRating);
                        // Optional: Update hidden input for overall rating
                        document.getElementById('overall-rating-value').value = overallRating;
                    });
                });

                // Function to update star icons based on the rating
                function updateStarRating(stars, rating) {
                    stars.forEach(star => {
                        const index = parseInt(star.getAttribute('data-index'));
                        if (index <= rating) {
                            star.classList.remove('fa-regular');
                            star.classList.add('fa-solid');
                        } else {
                            star.classList.remove('fa-solid');
                            star.classList.add('fa-regular');
                        }
                    });
                }
            });
        </script>
    @endsection
