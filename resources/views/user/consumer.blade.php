@extends('layouts.app') <!-- Extending the parent layout -->

@section('title', 'Consumer Page') <!-- Defining a title -->

@push('styles')
<style>
    .section-1 {
        height: 100vh;
        padding: 100px 15px 50px;
        background-image: url({{ asset('img/stockImg3.png') }});
        background-size: cover;
        background-position: center;
        color: white;
        text-align: center;
    }

    .section-1 h1 {
        font-size: 4.5rem;
        font-weight: bold;
    }
    .section-1 h1:nth-of-type(2) {
        margin-top: -15px;
    }

    @media (max-width: 576px) {
        .section-1 h1 {
            font-size: 2.5rem;
            font-weight: bold;
        }
        .section-1 h1:nth-of-type(2) {
            margin-top: 0px;
        }
        .section-1 {
            height: 70vh;
            display: flex;
            justify-content: center; /* Horizontally centers items */
            align-items: center;    /* Vertically centers items */
        }

        .section-1 button {
            margin: 0 auto; /* Optional for extra alignment safeguard */
        }

    }

    .section-1 h1 span:nth-of-type(1) {
        color: #ffa500;
    }

    .section-1 h1 span:nth-of-type(2) {
        color: #00cc1a;
    }

    .section-1 button {
        width: auto;
        padding: 10px 20px;
        border: 3px solid #ffa500;
        border-radius: 7px;
        background-color: #fff8dd;
        color: #ffa500;
        transition: all 0.5s ease;
    }

    .section-1 button:hover {
        transform: scale(1.1);
    }

    .promo-img {
        width: 100%;
        height: auto;
        border-radius: 15px;
    }

    .section-3 iframe {
        width: 100%;
        height: 300px;
        border: 4px solid #000;
        border-radius: 20px;
    }

    .section-3 button {
        width: auto;
        padding: 10px 20px;
        border: 3px solid #ffa500;
        border-radius: 7px;
        background-color: #ffa500;
        color: #fff8dd;
        transition: all 0.5s ease;
    }

    .section-3 button:hover {
        transform: scale(1.1);
    }
</style>
@endpush

@section('x-content')
@include('user.includes.navbar-consumer')

<section class="main-page">
    <!-- Section 1 -->
    <div class="container-fluid section-1 d-flex flex-column align-items-start justify-content-center">
        <h1>EMPOWER FARMERS</h1>
        <h1>
            <span>ENRICH</span>
            <span>COMMUNITIES</span>
        </h1>
        <h4>BuyAni, Where Every Purchase is a Celebration of Hard Work and Fresh Harvests</h4>
        <button>Shop Now!</button>
    </div>

    <!-- Section 2 -->
    <div class="container section-2 py-5">
        <div class="text-center mb-4">
            <h2>Our Products</h2>
            <h4>Freshly delivered from our local farmers!</h4>
        </div>
        <div class="row g-4">
            <div class="col-md-6">
                <img class="promo-img" src="{{ asset('img/stockImg.png') }}" alt="Promo Image 1">
            </div>
            <div class="col-md-6 d-flex flex-column justify-content-center">
                <h3>Lorem Ipsum</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
        </div>
        <div class="row g-4 mt-3">
            <div class="col-md-6 d-flex flex-column justify-content-center">
                <h3>Lorem Ipsum</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
            <div class="col-md-6">
                <img class="promo-img" src="{{ asset('img/stockImg2.png') }}" alt="Promo Image 2">
            </div>
        </div>
    </div>

    <!-- Section 3 -->
    <div class="container section-3 py-5">
        <div class="row g-4">
            <div class="col-md-6 text-center">
                <h3>Contact Us For Inquiries!</h3>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!4v1698665449734!6m8!1m7!1seAvRB_mCgHq_5jKGt56U_Q!2m2!1d13.1509736!2d123.7184431!3f44.73!4f0!5f0.7820865974627469"
                    loading="lazy" allowfullscreen="">
                </iframe>
            </div>
            <div class="col-md-6">
                <div class="container p-2 border rounded shadow p-4">
                    <h3>Contact Form</h3>
                    <form>
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter your name">
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter your email">
                        </div>
                        <div class="form-group mb-3">
                            <label for="message">Message</label>
                            <textarea class="form-control" id="message" rows="3" placeholder="Enter your message"></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-warning">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    function closePopup() {
        // Logic for closing popups
    }

    function showPopup() {
        // Logic for showing popups
    }
</script>
@endsection
