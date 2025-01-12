@extends('layouts.app') <!-- Extending the parent layout -->

@section('title', 'Home') <!-- Defining a title -->

@push('styles')
<style>
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
        z-index: 1050;
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
        display: none; /* Hidden modal */
    }

    /* Animation */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    @media (prefers-reduced-motion: no-preference) {
        .in-view {
            animation: slide-up 1s ease-out both;
        }

        .not-in-view {
            opacity: 0;
        }
    }

    @keyframes slide-up {
        0% {
            opacity: 0;
            transform: translateY(3rem);
        }

        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .section-1 {
        height: 705px;
        padding: 100px 100px 50px 100px;
        background-size: cover; /* Ensures the image covers the section fully */
        background-repeat: no-repeat; /* Prevents the image from repeating */
        background-position: center; /* Centers the image in the section */
        background-image: url({{ asset('img/stockImg3.png') }});
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
        line-height: 0.9;
    }

    .section-1 h1:nth-of-type(1) {
        color: #ffffff;
    }

    .section-1 h1:nth-of-type(2) span:nth-of-type(1) {
        color: #ffa500;
    }

    .section-1 h1:nth-of-type(2) span:nth-of-type(2) {
        color: #00cc1a;
    }

    .section-1 h4 {
        color: #ffffff;
    }

    .section-1 .btn-shop {
        width: 130px;
        padding: 10px 20px;
        border: 3px solid #ffa500;
        border-radius: 7px;
        background-color: #fff8dd;
        color: #ffa500;
        transition: all 0.5s ease;
        text-decoration: none;
    }

    .section-1 .btn-shop:hover {
        transform: scale(1.1);
    }

    /* Section 2 */
    .section-2 {
        padding: 50px 100px 50px 100px;
        margin-top: -20px;
    }

    .section-2 .row:nth-of-type(1) {
        text-align: center;
    }

    .promo-img {
        border-radius: 15px;
        height: 400px;
        width: 600px;
    }

    /* Section 3 */
    .section-3 {
        padding: 50px 100px 50px 100px;
    }

    .section-3 .left-panel {
        text-align: center;
    }

    .section-3 .right-panel .container {
        border: 5px solid #00cc1a;
        border-radius: 15px;
    }

    .section-3 button {
        width: 150px;
        height: 40px;
        border: 3px solid #ffa500;
        border-radius: 7px;
        background-color: #ffa500;
        color: #fff8dd;
        transition: all 0.5s ease;
    }

    .section-3 button:hover {
        scale: 1.1;
    }

    .div-iframe{
        height: 350px;
    }

    iframe{
        height: 100%;
        width: 80%;
    }

    h2 {
        color: #00cc1a;
    }

    h4 {
        color: #00584E;
    }

    /* start of css for card layout */
    .product-card {
        overflow: hidden;
        margin-top: -10px; /* Add margin-bottom */
        opacity: 0; /* Initially hidden for animation */
        transform: translateY(20px); /* Start slightly below */
        animation: fadeInUp 0.8s ease forwards; /* Fade-in animation */
    }

    /* Hover Zoom Effect */
    .product-card:hover {
        transform: scale(1.03);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    /* Zoom on Image */
    .card-img-top {
        transition: transform 0.3s ease;
    }

    .product-card:hover .card-img-top {
        transform: scale(1.1);
    }

    /* Button Float-in */
    .btn-float {
        transform: translateY(20px);
        opacity: 0;
        transition: transform 0.3s ease, opacity 0.3s ease;
    }

    .product-card:hover .btn-float {
        transform: translateY(0);
        opacity: 1;
    }

    /* Keyframe Animation */
    @keyframes fadeInUp {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    } /* end of card layout */

    .py-5 {
        margin-top: -20px;
        margin-bottom: -30px;
    }

    /* Code for text only */
    .promo-text h3 {
        color: #28a745; /* Green title like the uploaded design */
        font-weight: bold;
        padding-top: -50px;
        text-align: left;
        font-size: 3rem;
    }

    .promo-text h2 {
        font-size: 1.5rem;
        color: #09600f; /* Darker green for the subtitle */
        margin-bottom: 10px;
        text-align: left;
    }

    .promo-text h6 {
        text-align: justify; /* Justify the text */
        line-height: 1.8; /* Improve readability */
        font-size: 1rem;
    }

    .promo-img {
        max-width: 100%; /* Ensure images are responsive */
        height: auto;
        border-radius: 10px; /* Add slight border radius for smooth edges */
    }

    .text-center {
        margin-bottom: 20px;
    }

    /* sponsor */
    .main-container {
        padding: 20px;
        max-width: 1200px;
        margin: 0 auto;
        margin-bottom: 50px;
    }

    .top-sponsor-row,
    .bottom-sponsor-row {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        gap: 20px;
        margin-bottom: 3%;
    }

    .top-sponsor-row .logo {
        width: 300px; /* Fixed width for top row */
        height: 150px; /* Fixed height for top row */
        flex-shrink: 0; /* Prevent shrinking */
        flex-grow: 0; /* Prevent growing */
        display: flex;
        justify-content: center;
        align-items: center;
        background: #fff;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .bottom-sponsor-row .logo {
        width: 200px; /* Fixed width for bottom row */
        height: 100px; /* Fixed height for bottom row */
        flex-shrink: 0; /* Prevent shrinking */
        flex-grow: 0; /* Prevent growing */
        display: flex;
        justify-content: center;
        align-items: center;
        background: #fff;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .logo {
        display: flex;
        justify-content: center;
        align-items: center;
        background: #fff;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .logo img {
        max-width: 100%;
        height: auto;
    }

    .top-sponsor-row img {
        width: 300px;
        height: 150px;
    }

    .bottom-sponsor-row img{
        width: 200px;
        height: 100px;
    }



    /* Mini Blogs Css */
    .header-section {
        text-align: center;
        padding: 10px 30px;
        color: #333; /* Text color */
    }

    .header-section img {
        max-width: 150px;
        margin-bottom: 20px;
    }

    .header-section h1 {
        animation: slide-up 2s;
        font-size: 3.5rem;
        color: #2e7d32; /* Green color for the title */
        font-weight: 700;
        margin-bottom: 10px;
    }

    .header-section h2 {
        animation: slide-up 2s;
        font-size: 1.5rem;
        color: #1b5e20; /* Darker green for the subtitle */
        margin-bottom: 20px;
    }

    .header-section p {
        animation: slide-up 2s;
        font-size: 1rem;
        line-height: 1.6;
        color: #555; /* Neutral color for paragraph text */
        max-width: 1300px;
        margin: 0 auto;
    }

    .button {
        display: inline-block;
        margin-top: 20px;
        padding: 12px 25px;
        background-color: #2e7d32;
        color: #fff;
        font-size: 1rem;
        border-radius: 5px;
        text-decoration: none;
        box-shadow: 0 3px 5px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s;
    }

    .button:hover {
        background-color: #1b5e20; /* Darker green on hover */
    }

    /* end */

    /* Subscribe */
    .subscribe-section {
        background-color: #004d22; /* Dark green background */
        color: white;
        padding: 30px 20px;
        margin-bottom: 40px;
    }

    .subscribe-title {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .subscribe-description {
        font-size: 1rem;
        color: #d3d3d3; /* Light gray for the description */
    }

    .subscribe-input {
        border: none;
        border-radius: 0.25rem 0 0 0.25rem;
        padding: 10px 15px;
        font-size: 1rem;
        flex-grow: 1;
    }

    .subscribe-button {
        background-color: #00b34d; /* Bright green button */
        color: white;
        border: none;
        border-radius: 0 0.25rem 0.25rem 0;
        font-size: 1rem;
        padding: 10px 20px;
        transition: background-color 0.3s;
    }

    .subscribe-button:hover {
        background-color: #00873a; /* Darker green on hover */
    }


    /* Contacts */
    .contact-form, .contact-info{
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }




/* ---------------------------------------------------------------------------- */


    /* Mobile */
    @media (max-width: 768px) {
        *{
            /* border: 1px solid black; */
        }

        .contact-form{
            margin-bottom: 20px;
        }

        .section-1 {
            padding: 20px;
            height: 600px;
        }

        .section-1 h1 {
            font-size: 40px;
            line-height: 0.9;
        }

        .section-1 h4{
            padding-top: 20px;
        }

        .section-1 .btn-shop {
            margin: 0 auto; /* Optional for extra alignment safeguard */
        }

        .section-2{
            padding: 80px 20px;
            justify-content: center;
        }

        .section-2 .row h2{
            font-size: 30px;
        }
        .section-2 .row h4{
            font-size: 15px;
        }

        .product-card{
            margin: 20px;
        }

        .header-section h1{
            font-size: 40px;
        }
        .header-section h1{
            font-size: 30px;
        }


        .main-container {
            padding: 10px;
            margin-bottom: 30px;
        }

        /* Adjust top row logos size on mobile */
        .top-sponsor-row .logo {
            width: 150px; /* Fixed smaller width */
            height: 75px; /* Fixed smaller height */
        }

        /* Adjust bottom row logos size on mobile */
        .bottom-sponsor-row .logo {
            width: 140px; /* Fixed smaller width */
            height: 65px; /* Fixed smaller height */
        }

        .top-sponsor-row img,
        .bottom-sponsor-row img {
            width: 100%;
            height: 100%;
            object-fit: contain; /* Ensure images fit within their container */
        }


    }
</style>
@endpush

@section('x-content')
@include('user.includes.navbar-consumer')

<section class="main-page">

    <div id="profileIncompleteModal" class="modal {{ $isProfileIncomplete ? 'show' : 'hide' }}">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Profile Incomplete</h5>
            </div>
            <div class="modal-body">
                <p>Looks like you don't have any other info yet. Why not try editing it?</p>
            </div>
            <div class="modal-footer">
                <a href="{{ route('user.consumer.profile.show') }}" class="btn btn-primary">Edit Profile</a>
                <button type="button" data-close="modal" class="btn btn-secondary">Close</button>
            </div>
        </div>
    </div>

    <!-- Section 1 -->
    <div class="row section-1">
        <div class="container">
            <h1>EMPOWER FARMERS</h1>
            <h1>
                <span>ENRICH</span>
                <span>COMMUNITIES</span>
            </h1>
            <h4>BuyAni, Where Every Purchase is a Celebration o f Hard Work and Fresh Harvests</h4>
           <a href="{{ route('user.consumer.product') }}" class="btn-shop">Shop Now</a>
        </div>
    </div>

    <!-- Section 2 -->
    <div class="row section-2">
        <div class="row">
            <h2>Our Products</h2>
            <h4>Freshly delivered from our local farmers!</h4>
        </div>
        <div class="row"> <!-- Card layout for products -->
            <div class="container py-5">
                <div class="row g-4">
                    @foreach($products->take(4) as $product) {{-- Display only the first 4 products --}}
                    @php
                    $encryptedId = Crypt::encrypt($product->id);
                    @endphp
                    <div class="col-md-6 col-lg-3">
                        <div class="card product-card">
                            {{-- Product Image --}}
                            <img
                                src="{{ asset($product->product_pic ?? 'https://via.placeholder.com/300x200') }}"
                                class="card-img-top"
                                alt="{{ $product->product_name }}">

                            <div class="card-body text-center">
                                {{-- Product Title --}}
                                <h5 class="card-title">{{ $product->product_name }}</h5>

                                {{-- Product Details --}}
                                <p class="card-text">{{ Str::limit($product->product_details, 50, '...') }}</p>

                                {{-- Shop Now Button --}}
                                <a href="{{ route('user.consumer.product.view', $encryptedId) }}" class="btn btn-dark btn-float">Shop Now</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- See More Button --}}
                <div class="row mt-4">
                    <div class="col text-center">
                        <a href="{{ route('user.consumer.product') }}" class="button btn-lg">See More Products</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Mini Blogs --}}
    <div class="header-section">
        <img src="{{ asset('img/logo1.svg') }}" style="height: 150px;" alt="Logo">
        <h1>Transforming the Lives of</h1>
        <h2>Filipino Farmers through Technology</h2>
        <p>
            Buyani is on a mission to uplift the lives of Filipino farmers and fisherfolk by harnessing the transformative power of technology. Our innovative solutions empower local communities and enable them to thrive in a rapidly evolving agricultural landscape.
            Join us in creating a future where technology-driven innovation and sustainable farming practices go hand-in-hand.
        </p>
        <a href="{{ route('user.consumer.about') }}" class="button">Learn More</a>
    </div>
    <div class="top-sponsor-row">
        @if ($sponsorImages->count() >= 3)
        @foreach ($sponsorImages->take(3) as $images) {{-- Display the first 3 sponsors --}}
            <div class="logo">
                <img src="{{ asset($images->img) }}" alt="{{ $images->img_title }}">
            </div>
        @endforeach
    @else
        @for ($i = 0; $i < 3; $i++) {{-- Add placeholders if fewer than 3 images --}}
            <div class="logo">
                <img src="https://via.placeholder.com/200x100?text=Sponsor+Placeholder" alt="Sponsor Placeholder">
            </div>
        @endfor
    @endif
    </div>

    <!-- Bottom Sponsor Row -->
    <div class="bottom-sponsor-row">
        @if ($sponsorImages->count() > 3)
        @foreach ($sponsorImages->skip(3) as $images) {{-- Display the remaining sponsors --}}
            <div class="logo">
                <img src="{{ asset($images->img) }}" alt="{{ $images->img_title }}">
            </div>
        @endforeach
    @else
        @for ($i = 0; $i < max(0, 6 - $sponsorImages->count()); $i++) {{-- Add placeholders for remaining slots --}}
            <div class="logo">
                <img src="https://via.placeholder.com/200x100?text=Sponsor+Placeholder" alt="Sponsor Placeholder">
            </div>
        @endfor
    @endif
    </div>

    {{-- Semi-Contact --}}
    <div class="subscribe-section">
        <div class="container">
            <div class="row align-items-center">
                <!-- Left Text -->
                <div class="col-md-6">
                    <h1 class="subscribe-title">Want to Know More?</h1>
                    <p class="subscribe-description">Get updates by contacting us through our email.</p>
                </div>

                <div class="col-md-6">
                    {{-- <form class="d-flex">
                        <input type="email" class="form-control subscribe-input" placeholder="Email Address">
                        <button type="submit" class="btn subscribe-button">Subscribe</button>
                    </form> --}}
                    <a href="{{ route('user.consumer.contact') }}" class="btn subscribe-button">Contact Us</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row section-2">
        <div class="container text">
            <!-- First Section -->
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12 text-center">
                    <img class="promo-img" src="{{ asset('img/stockImg.png') }}" alt="Stock Image 1">
                </div>
                <div class="col-lg-6 col-md-12 promo-text">
                    <h3>Our Mission</h3>
                    <h2>More than a convenient online shopping experience</h2>
                    <h6>
                        At Buyani, our mission is to empower local farmers by providing them with a platform to showcase and sell their fresh produce directly to consumers.
                        We believe in fostering sustainable agriculture, supporting rural communities, and ensuring that you, our valued customer, enjoy the freshest and
                        healthiest products. Together, we are bridging the gap between the farm and your table, one order at a time.
                    </h6>
                </div>
            </div>
            <!-- Second Section -->
            <div class="row align-items-center flex-md-row-reverse">
                <div class="col-lg-6 col-md-12 text-center">
                    <img class="promo-img" src="{{ asset('img/stockImg2.png') }}" alt="Stock Image 2">
                </div>
                <div class="col-lg-6 col-md-12 promo-text">
                    <h3>Why Buyani</h3>
                    <h2>It's More Fun with Buyani</h2>
                    <h6>
                        Buyani is more than just an online marketplace; it’s a movement to support local farming communities and promote sustainable living.
                        By shopping with us, you contribute to the growth of small-scale farmers, reduce your carbon footprint, and enjoy produce that is as fresh as it gets.
                        We bring convenience, quality, and a touch of community spirit to your shopping experience. Why settle for less when you can make a difference with Buyani?
                    </h6>
                </div>
            </div>
        </div>
    </div>


    <div class="container mb-5">
        <div class="contact-header text-center">
            <h1>Contact Us</h1>
            <p>We would love to hear from you!</p>
        </div>

        <!-- Contact Form and Info -->
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="contact-form">
                        <h3>Get in Touch</h3>
                        <form action="mailto:buyanibusiness1@gmail.com" method="post" enctype="text/plain">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" id="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" required>
                            </div>
                            <div class="form-group">
                                <label for="message">Message:</label>
                                <textarea class="form-control" id="message" rows="4" style="margin-bottom: 20px" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>

                <div class="col-md-5 offset-md-1 contact-info" style="background-color: #5f8d4e; color: #f8f9fa;">
                    <h3>Contact Information</h3>
                    <p class="mb-3" style="font-size: 13px">We'd love to assist you in any way we can! For order updates or questions about any of our products or services, you may contact us through:</p>
                    <p class="mb-3"><strong>Email:</strong> buyani@gmail.com</p>
                    <p class="mb-3"><strong>Phone:</strong> +1 (234) 567-890</p>
                    <p class="mb-3"><strong>Facebook:</strong> vky</p>
                    <p class="mb-0"><strong>Address:</strong> 123 Maroroy St, Daraga, Albay, PH</p>
                </div>
            </div>
        </div>
    </div>

</section>


@endsection

@section('scripts')
<script>
    //this is the script that modal to popup when start of the page
    document.addEventListener('DOMContentLoaded', function () {
        // Select modal and close button
        const modal = document.getElementById('profileIncompleteModal');
        const closeButton = modal.querySelector('[data-close="modal"]');

        // Add event listener to the close button
        closeButton.addEventListener('click', function () {
            modal.classList.remove('show');
            modal.classList.add('hide');
        });
    });
</script>

<script>
    window.addEventListener('popstate', function(event) {
        // If the user press the back button, log them out
        window.location.href = "{{ route('user.logout') }}";
    });
</script>

<script>
    // transition for img, txt and div
    // Observer for triggering animations
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in-view');
                    entry.target.classList.remove('not-in-view');
                } else {
                    entry.target.classList.remove('in-view');
                    entry.target.classList.add('not-in-view');
                }
            });
        },
        {
            rootMargin: '0px',
            threshold: [0, 0.1, 1],
        }
    );

    // Selecting the elements to observe
    const tags = document.querySelectorAll(
        '.section-2, .header-section, .main-container, .subscribe-section, .section-3'
    );

    tags.forEach((tag) => {
        tag.classList.add('not-in-view'); // Ensure all elements start as not-in-view
        observer.observe(tag);
    });

    function closePopup() {
        const overlay = document.getElementById('overlay');
        const popup = document.querySelector('.error-popup');

        // Add the hidden class to trigger the fade-out animation
        overlay.classList.add('hidden');
        popup.classList.add('hidden');

        // After animation ends, hide the elements entirely
        setTimeout(() => {
            overlay.style.display = 'none';
            popup.style.display = 'none';
        }, 300); // Match the duration of the animation
    }

    function showPopup() {
        const overlay = document.getElementById('overlay');
        const popup = document.querySelector('.error-popup');

        // Show elements and remove hidden class for fade-in animation
        overlay.style.display = 'block';
        popup.style.display = 'block';
        overlay.classList.remove('hidden');
        popup.classList.remove('hidden');
    }

    // Function to add the flying effect based on scroll position
    function checkScroll() {
        var header = document.getElementById("header");
        var scrollPosition = window.scrollY;

        // If scroll position is more than 50px, add the flying-up class
        if (scrollPosition > 50) {
            header.classList.add("flying-up");
        } else {
            header.classList.remove("flying-up");
        }
    }

    // Event listener for scroll event
    window.addEventListener("scroll", checkScroll);

    // Check the scroll position right after the page loads
    document.addEventListener("DOMContentLoaded", function() {
        checkScroll(); // Call checkScroll when the page loads
    });
</script>


@endsection
