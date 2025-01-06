@extends('layouts.app') {{-- Assuming 'app.blade.php' is the base layout --}}

@section('title', 'Contact Us') {{-- Set the title for this page --}}

{{-- Add Page-Specific Styles --}}
@push('styles')
<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Poppins', sans-serif;
    }
    .contact-header {
        margin-top: 90px;
        text-align: center;
    }
    .contact-form {
        background: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .contact-info {
        padding-top: 25px;
        padding-left: 40px;
        border-radius: 10px;
        margin-left: 20px;
        width: 40%;
    }
</style>
@endpush

@section('x-content')
    @include('user.includes.navbar-farmer')


<body style="background-image: url('{{ asset('img/stockImg4.png') }}'); background-repeat: no-repeat; background-size: cover; background-position: center;">
    <div class="h-100 container d-flex flex-column justify-content-center align-items-center">
        {{-- <!-- Contact Header -->  <div class="d-block-12 m-5"></div>
         --}}
        <div class="contact-header" style="color: #f8f9fa;">
            <h1>Contact Us</h1>
            <p>We would love to hear from you!</p>
        </div>

        <!-- Contact Form and Info -->
        <div class="container mx-5">
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

                <div class="col-md-4 offset-md-1 contact-info" style="background-color: green; color: #f8f9fa;">
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
</body>
@endsection

@section('scripts')
{{-- Any page-specific scripts can be added here --}}
@endsection
