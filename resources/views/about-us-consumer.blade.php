@extends('layouts.app') {{-- Extend the main parent layout --}}

@section('title', 'About Us') {{-- Set the page title --}}

@push('styles')
<style>

    .container{
            height: auto;
            padding: 70px 20px;
            margin-top: 35px;
    }

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
</style>
@endpush

@section('x-content')
 @include('user.includes.navbar-consumer')


<!-- About Us Section -->
<section class="min-height">
    <div class="container mt-5">
        <!-- BuyAni Vision -->
        <h1 class="text-center mb-4">About Us Buyani</h1>
        <div class="row align-items-center">
            <div class="col-md-6 text-center">
                <img src="Images/fruit basket.png" alt="Basket of Produce" class="img-fluid">
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
                <img src="Images/stockimage.jpg" alt="Produce Showcase" class="img-fluid">
            </div>
        </div>

        <!-- Video Section -->
        <div class="text-center my-5 px-3">
            <video controls class="w-100">
                <source src="Images/vid.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>


        <!-- Meet the Team -->
        <div>
            <h2 class="section-title text-center">Meet the Team</h2>
            <div class="row text-center">
                <div class="col-6 col-md-3 team-member">
                    <img src="Images/espares_prof.png" alt="Backend Developer">
                    <p>Backend Developer</p>
                </div>
                <div class="col-6 col-md-3 team-member">
                    <img src="Images/chapman_prof.png" alt="Frontend Developer">
                    <p>Frontend Developer</p>
                </div>
                <div class="col-6 col-md-3 team-member">
                    <img src="Images/reola_prof.png" alt="Project Manager">
                    <p>Project Manager</p>
                </div>
                <div class="col-6 col-md-3 team-member">
                    <img src="Images/vista_prof.png" alt="System Analyst">
                    <p>System Analyst</p>
                </div>
            </div>
        </div>

        <!-- Contact Us Section -->
            <div class="contact-section pb-5" style="margin-bottom: 50px;"> <!-- Added inline margin for spacing -->
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
            </div>

    </div>
</section>
@endsection
