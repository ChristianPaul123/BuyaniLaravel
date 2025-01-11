@extends('layouts.app') {{-- Extend the main parent layout --}}

@section('title', 'Home') {{-- Set the page title --}}

@push('styles')
    <style>
        body {
            font-family: Arial, sans-serif;
        }


        /* design for the modal popup */
        /* Modal Background */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Modal Content */
        .modal-content {
            background: #fff;
            width: 90%;
            max-width: 500px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.3s ease-in-out;
        }

        /* Modal Header */
        .modal-header {
            background-color: #f8f9fa;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #dee2e6;
        }

        .modal-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: #343a40;
        }

        /* Close Button */
        .close-btn {
            background: none;
            border: none;
            font-size: 1.5rem;
            font-weight: bold;
            color: #343a40;
            cursor: pointer;
            outline: none;
        }

        .close-btn:hover {
            color: #dc3545;
        }

        /* Modal Body */
        .modal-body {
            padding: 20px;
            font-size: 1rem;
            color: #495057;
            text-align: center;
        }

        /* Modal Footer */
        .modal-footer {
            padding: 15px 20px;
            background-color: #f8f9fa;
            border-top: 1px solid #dee2e6;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .modal-footer .btn {
            padding: 10px 20px;
            font-size: 0.9rem;
            border-radius: 5px;
            cursor: pointer;
        }

        .modal-footer .btn-primary {
            background-color: #28a745;
            color: #fff;
            border: none;
        }

        .modal-footer .btn-primary:hover {
            background-color: #218838;
        }

        .modal-footer .btn-secondary {
            background-color: #6c757d;
            color: #fff;
            border: none;
        }

        .modal-footer .btn-secondary:hover {
            background-color: #5a6268;
        }



        .modal.hide {
            display: none;
            /* Hidden modal */
        }


        .section-1 {
            padding: 100px 100px 50px 100px;
        }

        .section-1 .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .section-1 h1 {
            font-size: 60px;
            font-weight: bold;
            padding: 0;
        }

        .section-1 h1:nth-of-type(1) {
            color: #ffffff;
        }

        .section-1 span:nth-of-type(1) {
            color: #ffa500;
        }

        .section-1 h1:nth-of-type(2) span:nth-of-type(2) {
            color: #00cc1a;
        }

        .section-1 h4 {
            color: #ffffff;
        }

        .section-1 button {
            width: 150px;
            height: 40px;
            border: 3px solid #00cc1a;
            border-radius: 7px;
            background-color: rgb(25, 179, 17);
            color: rgb(255, 255, 255);
            transition: all 0.5s ease;
        }

        .section-1 button:hover {
            scale: 1.1;
        }

        .hero {
            background: url('{{ asset('img/title/farmer-bg.jpg') }}') no-repeat center center/cover;
            color: white;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .best-selling {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1rem;
        }

        .product-card {
            flex: 1 1 calc(20% - 1rem);
            min-width: 200px;
            max-width: 220px;
            text-align: center;
            color: rgb(0, 0, 0);
            cursor: pointer;
            transition: 400ms;
            margin-right: 20px;
        }

        .product-card img {
            max-height: 150px;
            margin-bottom: 10px;
        }

        .product-card:hover {
            transform: scale(1.1, 1.1);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover>.product-card:not(:hover) {
            transform: scale(0.9, 0.9);
        }

        /* Analytics */
        .analytics {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            gap: 4rem;
        }

        .farmers {
            display: flex;
            justify-content: space-around;
            align-items: center;
        }

        .text-center {
            font-family: 'Poppins', sans-serif;
            font-weight: bold;
        }

        /* Carousel */
        .Promote {
            padding: 20px;
            background-color: #F5F5F5;
            margin-bottom: 20px;
        }

        h2 {
            font-family: 'Poppins', sans-serif;
            font-weight: bold;
            margin-bottom: 30px;
            text-align: center;
            color: #2c3e50;
            /* Dark header text */
        }

        .carousel-inner img {
            height: 400px;
            object-fit: cover;
            border-radius: 10px;
        }

        .carousel-indicators button {
            background-color: #2c3e50;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: #2c3e50;
            /* Dark arrows */
            border-radius: 50%;
            padding: 5px;
        }

        /* End of Carousel */


        /* Section 2 Sponsors Styling */
        .sponsors img {
            max-height: 100px;
            object-fit: contain;
            margin: 10px;
            filter: grayscale(100%);
            transition: filter 0.3s ease-in-out;
        }

        .sponsors img:hover {
            filter: grayscale(0%);
        }

        .section3 {
            background-color: #F8F9FA;
        }


        /* Bar Chart */
        #barChart {
            height: 20;
            border: 2px solid #f4f4f4;
            border-radius: 10px;
            background-color: #f8f9fa;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
@endpush

@section('content')
    @include('user.includes.navbar-farmer')


    <div class="main-div">
        @include('user.includes.messageBox')

        <!-- Profile Incomplete Modal -->
        <div id="profileIncompleteModal" class="modal fade" tabindex="-1" aria-labelledby="profileIncompleteModalLabel"
            aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-warning text-dark">
                        <h5 class="modal-title">Profile Incomplete</h5>
                        <button type="button" class="btn-close" data-close="modal" onclick="hideProfileModal()"></button>
                    </div>
                    <div class="modal-body">
                        <p>Looks like you don't have any other info yet. Why not try editing it?</p>
                    </div>
                    <div class="modal-footer">
                        <a href="/user/farmer/profile" class="btn btn-primary">Edit Profile</a>
                        <button type="button" class="btn btn-secondary" onclick="hideProfileModal()">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <button id="profileIncompleteBtn" data-bs-toggle="modal" data-bs-target="#profileIncompleteModal"></button>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                @if ($isProfileIncomplete)
                    document.getElementById('profileIncompleteBtn').click();
                @endif
            });

            function hideProfileModal() {
                // Hide the modal
                let modal = document.getElementById('profileIncompleteModal');
                modal.classList.remove('show');
                modal.classList.add('hide');
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';

                // Remove the backdrop
                let backdrops = document.getElementsByClassName('modal-backdrop');
                while (backdrops.length > 0) {
                    backdrops[0].remove();
                }

                // Enable page scrolling
                document.body.classList.remove('modal-open');
            }
        </script>

        <!-- Hero Section -->
        <section class="hero">
            <div class="container text-center">
                <div class="container section-1">
                    <h1 style="margin-bottom: -10px;">WELCOME <span style="color:orange;font-weight:bold">FARMERS</span>
                    </h1>
                    <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam et lacinia dolor, ac varius massa.
                        Interdum et malesuada fames ac ante ipsum primis in faucibus. Quisque dapibus orci eu tempor
                        ullamcorper.</h4>
                    <button>Sell Now!</button>
                </div>
            </div>
        </section>

        <!-- Best Selling Section -->
        <section class="py-5">
            <h1 class="text-center section1 mb-4">Best Selling Products This Month</h1>
            <div class="best-selling">
                @forelse ($bestSellingProducts as $index => $productSale)
                    <div class="card product-card">
                        <img src="{{ asset($productSale->product->image ?? 'img/placeholder.png') }}" class="card-img-top"
                            alt="{{ $productSale->product->name ?? 'Unknown Product' }}">
                        <div class="card-body">
                            <h5>#{{ $index + 1 }} {{ $productSale->product->name ?? 'Unknown Product' }}</h5>
                            <p>Amount: {{ $productSale->total_sales }} kg</p>
                        </div>
                    </div>
                @empty
                    <p>No best selling products found.</p>
                @endforelse
            </div>

            <!-- Best Selling Product Variants -->
            <h1 class="text-center section1 mb-4 mt-5">Best Selling Product Variants This Month</h1>
            <div class="best-selling">
                @forelse ($bestSellingVariants as $index => $variantSale)
                    <div class="card product-card">
                        <img src="{{ asset($variantSale->productSpecification->product->image ?? 'img/placeholder.png') }}"
                            class="card-img-top"
                            alt="{{ $variantSale->productSpecification->product->name ?? 'Unknown Variant' }}">
                        <div class="card-body">
                            <h5>#{{ $index + 1 }} {{ $variantSale->productSpecification->name ?? 'Unknown Variant' }}
                            </h5>
                            <p>Amount: {{ $variantSale->total_sales }} kg</p>
                        </div>
                    </div>
                @empty
                    <p>No best selling product variants found.</p>
                @endforelse
            </div>
        </section>

        <!-- Analytics Section -->
        <section class="py-5 bg-light">
            <div class="container">
                <h1 class="text-center mb-4">This Month's Top Consumer Vote</h1>
                <div class="analytics">
                    <canvas id="barChart" width="500" height="400"></canvas>
                </div>
            </div>
        </section>

        <section class="Promote">
            <div class="container text-center py-5">
                <!-- Section Title -->
                <p class="text-uppercase text-success fw-bold">Portfolio</p>
                <h2>We Have Done</h2>

                <!-- Carousel -->
                <div id="portfolioCarousel" class="carousel slide" data-bs-ride="carousel">
                    <!-- Indicators -->
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#portfolioCarousel" data-bs-slide-to="0"
                            class="active"></button>
                        <button type="button" data-bs-target="#portfolioCarousel" data-bs-slide-to="1"></button>
                        <button type="button" data-bs-target="#portfolioCarousel" data-bs-slide-to="2"></button>
                        <button type="button" data-bs-target="#portfolioCarousel" data-bs-slide-to="3"></button>
                        <button type="button" data-bs-target="#portfolioCarousel" data-bs-slide-to="4"></button>
                        <button type="button" data-bs-target="#portfolioCarousel" data-bs-slide-to="5"></button>
                    </div>

                    <!-- Carousel Items -->
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('img/farmer-home/blog3.jpg') }}" class="d-block w-100" alt="Image 1">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('img/farmer-home/blog1.jpg') }}" class="d-block w-100" alt="Image 2">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('img/farmer-home/blog2.jpg') }}" class="d-block w-100" alt="Image 3">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('img/farmer-home/blog6.jpg') }}" class="d-block w-100" alt="Image 4">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('img/farmer-home/blog8.jpg') }}" class="d-block w-100" alt="Image 5">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('img/farmer-home/blog4.jpg') }}" class="d-block w-100" alt="Image 6">
                        </div>
                    </div>

                    <!-- Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#portfolioCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#portfolioCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </section>

        <!-- Section 2: Sponsors -->
        <section>
            <div class="container text-center py-5">
                <p class="text-uppercase text-success fw-bold">Sponsors</p>
                <h2>Supported By</h2>
                <div class="row sponsors justify-content-center">
                    @forelse ($sponsors as $sponsor)
                        <div class="col-md-2 col-sm-4 col-6">
                            <img src="{{ asset($sponsor->img) }}" alt="{{ $sponsor->img_title }}" class="img-fluid">
                        </div>
                    @empty
                        <p>No sponsors found.</p>
                    @endforelse
                </div>
            </div>
        </section>

        {{-- popup modal on startup page --}}



        @include('user.includes.unverified-modal')

    </div>

@endsection

@section('scripts')
    <script>
        //this is the script that modal to popup when start of the page
        document.addEventListener('DOMContentLoaded', function() {
            // Select modal and close button
            const modal = document.getElementById('profileIncompleteModal');
            const closeButton = modal.querySelector('[data-close="modal"]');

            // Add event listener to the close button
            closeButton.addEventListener('click', function() {
                modal.classList.remove('show');
                modal.classList.add('hide');
            });
        });
    </script>

    <script>
        // Data passed from the controller
        const chartLabels = @json($topVotedProducts->pluck('suggest_name'));
        const chartData = @json($topVotedProducts->pluck('total_vote_count'));

        // Bar Chart Configuration
        const ctx = document.getElementById('barChart').getContext('2d');
        const barChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: 'Vote Count',
                    data: chartData,
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
