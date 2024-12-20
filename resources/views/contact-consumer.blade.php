{{-- contact.blade.php --}}

@extends('layouts.app') {{-- Assuming 'app.blade.php' is the base layout --}}

@section('title', 'Contact Us') {{-- Set the title for this page --}}

{{-- Add Page-Specific Styles --}}
@push('styles')
<style>
    *{
        /* border: 1px solid black; */
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        margin: 0;
        padding: 0;
    }

    .section-3 {
        padding: 50px 0;
        background-color: #fff;
    }

    /* Left Panel */
    .left-panel .div-iframe ,.right-panel{
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
        padding: 20px;
    }

    iframe {
        width: 100%;
        height: 450px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Right Panel */
    .right-panel .container{
        padding: 20px;
        background: #fafafa;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .right-panel h3 {
        text-align: center;
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
    }

    .right-panel .form-group {
        margin-bottom: 15px;
    }

    .form-control {
        border-radius: 10px;
        border: 1px solid #ccc;
        padding: 10px 15px;
        font-size: 16px;
        background-color: #fff;
        transition: border-color 0.3s;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    textarea.scroll {
        resize: none;
    }

    /* Submit Button */
    button[type="submit"] {
        background-color: #ffa500;
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 10px 25px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button[type="submit"]:hover {
        background-color: #cc9100;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .section-3 {
            flex-direction: column;
        }

        .left-panel, .right-panel {
            width: 100%;
            margin-bottom: 20px;
        }

        iframe {
            height: 300px;
        }
    }
</style>

@endpush

@section('x-content')
    @include('user.includes.navbar-consumer')


<body>
<div class="row section-3">
        <div class="col-md-6 left-panel">
            <div class="div-iframe">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!4v1698665449734!6m8!1m7!1seAvRB_mCgHq_5jKGt56U_Q!2m2!1d13.1509736!2d123.7184431!3f44.73!4f0!5f0.7820865974627469"
                    style="border: 4px solid #000; border-radius: 20px;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
        <div class="col-md-6 right-panel">
            <div class="container p-2">
                <h3>Contact Form</h3>
                <form>
                    <div class="form-group p-1">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter your name">
                    </div>
                    <div class="form-group p-1">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter your email">
                    </div>
                    <div class="form-group p-1">
                        <label for="message">Message</label>
                        <textarea class="form-control scroll" id="message" rows="3" placeholder="Enter your message"></textarea>
                    </div>
                    <div class="text-center pt-1">
                        <button type="submit">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
@endsection

@section('scripts')
{{-- Any page-specific scripts can be added here --}}
@endsection
