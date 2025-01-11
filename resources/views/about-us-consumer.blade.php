@extends('layouts.app') {{-- Extend the main parent layout --}}

@section('title', 'About Us') {{-- Set the page title --}}

@push('styles')
<style>

    .team-member img {
    width: 150px; /* Adjusted size */
    height: 150px; /* Adjusted size */
    object-fit: cover;
    border-radius: 50%;
    }

    .team-member p {
    margin-top: 10px;
    font-size: 1.1rem; /* Optional: Slightly increase the text size */
    }

    .section-title {
        font-weight: bold;
        margin-bottom: 20px;
    }

    .vision-mission {
        margin-top: 30px;
    }

    .text-justify {
        text-align: justify;
    }

    /* Contact Us Styling */
    .contact-section {
        background: #333; /* Dark background */
        color: #fff;
        padding: 50px 20px;
        margin-top: 50px;
    }

    .contact-section h2 {
        font-size: 2rem;
        margin-bottom: 20px;
    }

    .contact-info {
        margin-bottom: 30px;
    }

    .contact-info h4 {
        font-size: 1.2rem;
        color: #00d1e0; /* Accent color for headings */
    }

    .contact-info p {
        margin-bottom: 0;
    }

    .contact-form input,
    .contact-form textarea {
        width: 100%;
        margin-bottom: 15px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .contact-form textarea {
        height: 100px;
        resize: none;
    }

    .contact-form button {
        background: #00d1e0;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }

    .contact-form button:hover {
        background: #00b1c1;
    }

    .min-height {
        min-height: 100vh;
    }

    .faq-header {
            text-align: center;
            margin-top: 30px;
            margin-bottom: 30px;
            font-weight: bold;
            font-family: Poppins, sans-serif;
            color: #000000;
        }

        .accordion-button {
            color: #000; /* Black text */
            background-color: #fff; /* White background for buttons */
        }

        .accordion-button:focus {
            box-shadow: none;
        }

        .accordion-button.collapsed {
            color: #000;
        }

        .accordion-item {
            border: none;
            margin-bottom: 10px;
        }

        .faq-container {
            background-color: rgba(32, 160, 49, 0.9); /* Slightly transparent white */
            color: #000;
            border-radius: 8px;
            padding: 20px;
            width: 100%;
            margin-bottom: 8rem;
            margin-top: 8rem; /* Add some space above the first FAQ item */
        }
</style>
@endpush

@section('x-content')
 @include('user.includes.navbar-consumer')


<!-- About Us Section -->
<section class="min-height">
    <div class="container mt-5">
        <!-- BuyAni Vision -->
        <h1 class="text-center pt-3 mb-4">About Us Buyani</h1>
        <div class="row align-items-center">
            <div class="col-md-6 text-center">
                <img src="{{ asset('img/blog/fruit basket.png') }}" alt="Basket of Produce" class="img-fluid">
            </div>
            <div class="col-md-6">
                <h2 class="section-title">BuyAni Vision</h2>
                <p class="text-justify">We dream of a world where each purchase becomes a ray of hope for our local farmers and inspires them to continue their efforts by giving the people the goods they grew and showing that their position in society is a respectable profession.</p>
                <p class="text-justify">We entice in nurturing a community-driven journey towards sustainable and ecological prospect.</p>
                <p class="text-justify">Our passion is to turn simple transactions into a powerful force for positive change, creating moments that inspire wonder and make a lasting impact.</p>
            </div>
        </div>

        <!-- BuyAni Mission -->
        <div class="row align-items-center vision-mission">
            <div class="col-md-6">
                <h2 class="section-title">BuyAni Mission</h2>
                <p class="text-justify">We're focused on building a connection between discerning consumers with the exceptional produce of local farmers, ensuring fair compensation and recognition for their hard work.</p>
                <p class="text-justify">We serve both farmers seeking a way to showcase their goods and consumers looking for high-quality, ethically sourced products.</p>
                <p class="text-justify">Through our transparent and community-driven approach, we facilitate sustainable transactions that empower farmers and nurture a stronger, more equitable food ecosystem.</p>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('img/blog/stockimage.jpg') }}" alt="Produce Showcase" class="img-fluid">
            </div>
        </div>

        <!-- Video Section -->
        <div class="text-center my-5 px-3">
            <video controls class="w-100">
                <source src="{{ asset('img/blog/vid.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>


        <!-- Meet the Team -->
        <div>
            <h2 class="section-title text-center">Meet the Team</h2>
            <div class="row text-center">
                <div class="col-6 col-md-3 team-member">
                    <img src="{{ asset('img/blog/espares_prof.png') }}" alt="Backend Developer">
                    <p>Backend Developer</p>
                </div>
                <div class="col-6 col-md-3 team-member">
                    <img src="{{ asset('img/blog/chapman_prof.png') }}" alt="Frontend Developer">
                    <p>Frontend Developer</p>
                </div>
                <div class="col-6 col-md-3 team-member">
                    <img src="{{ asset('img/blog/reola_prof.png') }}" alt="Project Manager">
                    <p>Project Manager</p>
                </div>
                <div class="col-6 col-md-3 team-member">
                    <img src="{{ asset('img/blog/vista_prof.png') }}" alt="System Analyst">
                    <p>System Analyst</p>
                </div>
            </div>
        </div>

        <!-- Contact Us Section -->
            {{-- <div class="contact-section pb-5" style="margin-bottom: 50px;"> <!-- Added inline margin for spacing -->
                <div class="container">
                    <h2 class="text-center">Contact Us</h2>
                    <p class="text-center">BuyAni, Where Every Purchase is a Celebration of Hard Work and Fresh Harvests</p>
                    <div class="row align-items-center">
                        <!-- Contact Info -->
                        <div class="col-md-6 contact-info">
                            <div class="mb-4">
                                <h4>Address</h4>
                                <p>4502 Maroroy Road,<br>Purok 4, Maroroy, Daraga, Albay</p>
                            </div>
                            <div class="mb-4">
                                <h4>Phone</h4>
                                <p>09123456789</p>
                            </div>
                            <div>
                                <h4>Email</h4>
                                <p>buyani@gmail.com</p>
                            </div>
                        </div>
                        <!-- Contact Form -->
                        <div class="col-md-6">
                            <form class="contact-form">
                                <input type="text" placeholder="Full Name" required>
                                <input type="email" placeholder="Email" required>
                                <textarea placeholder="Type your Message..." required></textarea>
                                <button type="submit">Send</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div> --}}

            {{-- <div class="contact-section pb-5" style="margin-bottom: 50px;"> <!-- Added inline margin for spacing --> --}}
            <div class="container faq-container pb-5" >
                <h2 class="faq-header">Frequently Asked Questions</h2>
                <div class="accordion" id="faqAccordion">
                    <!-- FAQ Item 1 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                What is Buyani?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Buyani is an innovative e-commerce platform that connects farmers directly with consumers. Farmers use Buyani to sell their fresh produce, while customers use it to purchase high-quality, locally grown products.
                            </div>
                        </div>
                    </div>
                    <!-- FAQ Item 2 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                How do farmers use Buyani?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Farmers can connect to Buyani by creating an account on the platform. Once registered, they can list their produce, manage inventory, track orders, and receive payments securely. This helps farmers reach a wider audience and sell their products more efficiently.
                            </div>
                        </div>
                    </div>
                    <!-- FAQ Item 3 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                How do customers use Buyani?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Customers can connect to Buyani by signing up on the platform. They can browse the available produce, place orders, make payments, and have fresh produce delivered to their doorstep. This provides customers with easy access to fresh, locally sourced products.
                            </div>
                        </div>
                    </div>
                    <!-- FAQ Item 4 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                How to Order as Ka-Ani Customer at Buyani?
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                To order on Buyani, simply sign up, browse products, add items to your cart, and proceed to checkout with your preferred payment method. You'll receive order updates and can track delivery through the platform.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </div>
</section>
@endsection
@section('scripts')
@endsection
