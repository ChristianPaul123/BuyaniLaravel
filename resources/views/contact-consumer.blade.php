{{-- contact.blade.php --}}

@extends('layouts.app') {{-- Assuming 'app.blade.php' is the base layout --}}

@section('title', 'Contact Us') {{-- Set the title for this page --}}

{{-- Add Page-Specific Styles --}}
@push('styles')
<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Poppins', sans-serif;
    }

    .container-main{
        padding: 50px 150px;
    }

    .contact-form, .contact-info{
        box-shadow: 0 0 100px rgba(0, 0, 0, 0.1);
        padding: 20px;
        border-radius: 10px;
    }

    .contact-info{
        background-color: #5f8d4e;
        color: #f8f9fa;
        height:325px;
    }

    .gmap{
        border: 3px solid #000;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 80%;
        height: 500px;
    }



    @media (max-width: 768px) {
        .container-main{
            padding: 50px 20px;
        }

        .contact-form, .contact-info{
            box-shadow: 0 0 100px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .contact-info{
            height: auto;
            margin-top: 20px;
        }

        .gmap{
            border: 3px solid #000;
            width: 100%;
            height: 250px;
        }

    }
</style>
@endpush

@section('x-content')
    @include('user.includes.navbar-consumer')


<body style="background-image: url('{{ asset('img/stockImg4.png') }}'); background-repeat: no-repeat; background-size: cover; background-position: center;">
    <div class="h-100 container d-flex flex-column justify-content-center align-items-center">
        {{-- <div class="d-block-12 m-5"></div> --}}
        <!-- Contact Form and Info -->
        <div class="container">
            <div class="contact-header" style="color: #f8f9fa;">
                <h1>Contact Us</h1>
                <p>We would love to hear from you!</p>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="contact-form text-white">
                        <h3>Get in Touch</h3>
                        <form action="mailto:buyanibusiness1@gmail.com" method="post" enctype="text/plain">
                            <div class="form-group mb-2">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" id="name" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="message">Message:</label>
                                <textarea class="form-control" id="message" rows="4" style="margin-bottom: 20px" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>

                <div class="col-md-5 offset-md-1 contact-info">
                    <h3>Contact Information</h3>
                    <p class="mb-3" style="font-size: 13px">We'd love to assist you in any way we can! For order updates or questions about any of our products or services, you may contact us through:</p>
                    <p class="mb-3"><strong>Email:</strong> buyani@gmail.com</p>
                    <p class="mb-3"><strong>Phone:</strong> +1 (234) 567-890</p>
                    <p class="mb-3"><strong>Facebook:</strong> vky</p>
                    <p class="mb-0"><strong>Address:</strong> 123 Maroroy St, Daraga, Albay, PH</p>
                </div>
            </div>
        </div>


        <div class="container mt-4">
            <div class="div-iframe d-flex justify-content-center">
                <iframe
                    class="gmap"
                    src="https://www.google.com/maps/embed?pb=!4v1698665449734!6m8!1m7!1seAvRB_mCgHq_5jKGt56U_Q!2m2!1d13.1509736!2d123.7184431!3f44.73!4f0!5f0.7820865974627469"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>

    </div>
</body>
@endsection

@section('scripts')
{{-- Any page-specific scripts can be added here --}}
@endsection
