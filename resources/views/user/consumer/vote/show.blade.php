@extends('layouts.app')

@section('title', 'Voting System')

@push('styles')
<style>
    /* General Page Styles */
    .voting-header {
        margin-top: 50px;
        text-align: center;
        font-family: 'Poppins', sans-serif;
        color: #333;
    }

    /* Card Styling */
    .card {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        border-radius: 15px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        border: none;
        overflow: hidden;
    }

        /* Card Styling */
        .card .card-body{
        padding: auto;
    }

    .voting-poll {
        background-color:#cbcbcb;
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        border: none;
        overflow: hidden;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    /* Product Image */
    .product-image img {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #ddd;
    }

    /* Product Details */
    .details h5 {
        font-size: 18px;
        font-weight: bold;
        color: #333;
        margin-bottom: 8px;
    }

    .details p {
        font-size: 14px;
        color: #777;
        margin: 0;
    }

    /* Buttons */
    .actions button {
        border: none;
        border-radius: 30px;
        padding: 8px 20px;
        font-size: 14px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .actions .btn-info {
        background-color: #17a2b8;
        color: white;
    }

    .actions .btn-info:hover {
        background-color: #138496;
        transform: scale(1.05);
    }

    .actions .btn-success {
        background-color: #28a745;
        color: white;
    }

    .actions .btn-success:hover {
        background-color: #218838;
        transform: scale(1.05);
    }

    /* Modal Styling */
    .modal-content {
        border-radius: 15px;
        overflow: hidden;
    }

    .modal-header {
        background-color: #4caf50;
        color: white;
    }

    .modal-body {
        padding: 30px;
    }

    .product-image-modal img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #ddd;
    }

    .modal-title {
        font-size: 22px;
        font-weight: bold;
    }

    .modal-footer button {
        border-radius: 20px;
        padding: 10px 20px;
    }

    /* Chart Container */
    .chart-container {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 15px;
        margin-top: 20px;
    }

    /* Request Product Section */
    .request-product {
        margin-top: 30px;
        text-align: right;
    }

    .request-product .btn-primary {
        background: #007bff;
        border: none;
        padding: 10px 20px;
        border-radius: 30px;
        font-size: 14px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .request-product .btn-primary:hover {
        background-color: #0056b3;
        transform: translateY(-3px);
    }

</style>
@endpush

@section('content')
@include('user.includes.navbar-consumer')

<div class="main-content-wrapper">
    <div class="container my-5">
        <!-- Voting Header -->
        <div class="voting-header">
            <h1>Product Voting</h1>
            <p>Vote for your favorite products this month!</p>
        </div>

        <!-- Top Voted Products Section -->
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Top Voted Products</h5>
                    </div>
                    <div class="card-body chart-container">
                        <canvas id="topVotedChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Voting Poll Section -->
        <div class="row voting-poll mt-4">
            <h3 class="mb-3">Product Voting Poll</h3>
            <div class="col-lg-8 col-md-10 col-sm-12 mb-4">
                <div class="row">
                    <!-- Dummy Data for Suggested Products -->
                    @php
                        $suggestedProducts = [
                            [
                                'id' => 1,
                                'suggest_name' => 'Apple',
                                'suggest_description' => 'Apples are a quintessential fruit celebrated for their crisp texture, sweet-tart flavor, and remarkable health benefits.',
                                'suggest_image' => null, // No image provided
                                'user' => 'Beanz',
                                'total_vote_count' => 69,
                                'rank' => 5,
                                'date' => 'January 2024',
                                'category' => 'Fruit'
                            ],
                            [
                                'id' => 2,
                                'suggest_name' => 'Corn',
                                'suggest_description' => 'Corn is a versatile grain that is a staple food in many cultures.',
                                'suggest_image' => null, // No image provided
                                'user' => 'User123',
                                'total_vote_count' => 1500,
                                'rank' => 1,
                                'date' => 'January 2024',
                                'category' => 'Vegetable'
                            ]
                        ];
                    @endphp

                    @foreach ($suggestedProducts as $product)
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm border-0">
                            <div class="card-body d-flex align-items-center gap-3">
                                <!-- Product Image -->
                                <div class="product-image">
                                    <img
                                        src="{{ $product['suggest_image'] ? asset($product['suggest_image']) : asset('img/default.jpg') }}"
                                        alt="{{ $product['suggest_name'] }}"
                                        class="rounded-circle"
                                        style="width: 70px; height: 70px; object-fit: cover;"
                                    >
                                </div>

                                <!-- Product Details -->
                                <div class="details flex-grow-1">
                                    <h5 class="card-title mb-2 font-weight-bold" style="font-size: 18px; color: #333;">{{ $product['suggest_name'] }}</h5>
                                    <p class="card-text mb-0" style="color: #777; font-size: 14px;">Requested by: <span style="font-weight: 500;">{{ $product['user'] }}</span></p>
                                </div>

                                <!-- Action Buttons -->
                                <div class=" actions d-flex align-items-center gap-2">
                                    <button
                                        class="btn btn-info btn-sm text-nowrap"
                                        style="border-radius: 20px; padding: 5px 15px; font-size: 14px;"
                                        data-bs-toggle="modal"
                                        data-bs-target="#viewProductModal"
                                        onclick="populateProductModal(
                                            '{{ $product['suggest_name'] }}',
                                            '{{ $product['category'] }}',
                                            '{{ $product['suggest_description'] }}',

                                            '{{ $product['user'] }}',
                                            '{{ $product['total_vote_count'] }}',
                                            '{{ $product['rank'] }}',
                                            '{{ $product['date'] }}'
                                        )">
                                        👁️ View
                                    </button>
                                    <button class="btn btn-success btn-sm text-nowrap" style="border-radius: 20px; padding: 5px 15px; font-size: 14px;">
                                        👍 {{ $product['total_vote_count'] }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
        </div>

        <!-- Request Product Button -->
        <div class="request-product">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#requestProductModal">+ Request Product</button>
        </div>
    </div>
    </div>

    <div class="modal fade" id="viewProductModal" tabindex="-1" aria-labelledby="viewProductModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewProductModalLabel">View Voted Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Image Section -->
                        <div class="col-md-4 product-image">
                            {{-- <img id="modalProductImage" src="" alt="Product Image" class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;"> --}}
                            <h5 id="modalProductName" class="mt-3"></h5>
                            <p id="modalProductRequestedBy" class="product-details"></p>
                            <p id="modalProductVotes" class="product-details"></p>
                            <p id="modalProductRank" class="product-details"></p>
                            <p id="modalProductDate" class="product-details"></p>
                        </div>
                        <!-- Description Section -->
                        <div class="col-md-8">
                            <h6>Category: <span id="modalProductCategory"></span></h6>
                            <h6>Introduction to requested product:</h6>
                            <p id="modalProductDescription" class="text-muted"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Request Product Modal -->
    <div class="modal fade" id="requestProductModal" tabindex="-1" aria-labelledby="requestProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="requestProductModalLabel">Request Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="suggest_name">Product Name</label>
                            <input type="text" class="form-control" name="suggest_name" required>
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select class="form-control" name="category" required>
                                <option value="">Select Category</option>
                                <!-- Dynamic categories -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="suggest_description">Description</label>
                            <textarea class="form-control" name="suggest_description" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="suggest_image">Product Image</label>
                            <input type="file" class="form-control" name="suggest_image" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script>
    function populateProductModal(name, category, description, image, requestedBy, votes, rank, date) {
        // Populate modal with data
        document.getElementById('modalProductName').innerText = name;
        document.getElementById('modalProductCategory').innerText = category;
        document.getElementById('modalProductDescription').innerText = description;
        // document.getElementById('modalProductImage').src = image;
        document.getElementById('modalProductRequestedBy').innerText = `Requested By: ${requestedBy}`;
        document.getElementById('modalProductVotes').innerText = `Votes: ${votes}`;
        document.getElementById('modalProductRank').innerText = `Rank: ${rank}`;
        document.getElementById('modalProductDate').innerText = `Date: ${date}`;
    }
</script>

<script>
    document.getElementById('viewProductModal').addEventListener('hidden.bs.modal', function () {
    document.querySelector('[data-bs-target="#viewProductModal"]').focus();
});

    document.getElementById('requestProductModal').addEventListener('hidden.bs.modal', function () {
    document.querySelector('[data-bs-target="#requestProductModal"]').focus();
});
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('topVotedChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Red', 'Blue', 'Green', 'Yellow', 'Purple', 'Orange'], // Product names
            datasets: [{
                label: 'Votes',
                data: [12, 19, 3, 5, 2, 3], // Vote counts
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            indexAxis: 'y',
            maintainAspectRatio: false,
            responsive: true,
            scales: {
                x: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
