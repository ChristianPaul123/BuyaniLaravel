@extends('layouts.app') <!-- Extending the parent layout -->

@section('title', 'Login Selection') <!-- Defining a title for this view -->

@push('styles')
<style>
    .body {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .body {
        font-family: 'Poppins', sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-image: url('{{ asset('img/title/farm.jpg') }}'); /* Replace with your image URL */
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        color: white;
    }

    .center-content {
        padding: 30px;
        border-radius: 15px;
        text-align: center;
    }

    .buyani {
        font-weight: 100000px;
        font-size: 9rem;
        -webkit-text-stroke: 1px white;
        text-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
        margin-top: 70px;
        margin-bottom: 50px;
    }

    .buyani .buy {
        color: #00cc1a;
    }

    .buyani .ani {
        color: orange;
    }

    .col{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .col .button{
        width: 220px;
        margin: 10px;
        border: 4px solid;
        border-radius: 10px;
        padding: 10px;
        font-weight: bold;
        transition: all 0.3s ease;
    }

    .button:hover{
        transform: scale(1.1);
    }

    .icons{
        height: 150px;
        margin: 10px;
    }

    @keyframes fadeInDown {
        from {
            transform: translate(-50%, -55%); /* Start from above the screen */
            opacity: 0;
        }
        to {
            transform: translate(-50%, -50%); /* Center in the screen */
            opacity: 1;
        }
    }

    @keyframes fadeOutUp {
        from {
            transform: translate(-50%, -50%); /* Start from center */
            opacity: 1;
        }
        to {
            transform: translate(-50%, -55%); /* Move up to above the screen */
            opacity: 0;
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 0.6;
        }
    }

    @keyframes fadeOut {
        from {
            opacity: 0.6;
        }
        to {
            opacity: 0;
        }
    }

    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        z-index: 999;
        animation: fadeIn 0.2s ease-out forwards; /* Fade in animation for the overlay */
    }

    .overlay.hidden {
        animation: fadeOut 0.2s ease-in forwards; /* Fade out animation for the overlay */
    }

    .error-popup {
        width: 400px;
        background-color: #ffffff;
        color: #842029;
        border: 1px solid black;
        border-radius: 5px;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        z-index: 1000;
        animation: fadeInDown 0.3s ease-out forwards; /* Slide down animation for the modal */
    }

    .error-popup.hidden {
        animation: fadeOutUp 0.3s ease-in forwards; /* Slide up animation for the modal */
    }

    .container-contents {
        padding: 20px;
    }

    .error-popup .error-icon {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 120px;
        background-color: #e85e6c;
        font-size: 60px;
    }

    .error-popup .bi-x-lg {
        color: #fff;
        position: absolute;
        top: 10px;
        right: 10px;
    }

    .consumer-container .button-login{
        border-color: #00cc1a;
        background-color: #00cc1a;
        color: #fff8dd;
    }
    .consumer-container .button-signup{
        border-color: #00cc1a;
        background-color: #fff8dd;
        color: #00cc1a;
    }
    .farmer-container .button-login{
        border-color: #ffa500;
        background-color: #ffa500;
        color: #fff8dd;
    }
    .farmer-container .button-signup{
        border-color: #ffa500;
        background-color: #fff8dd;
        color: #ffa500;
    }
</style>
@endpush
@section('x-content')
@include('user.includes.navbar-consumer')
    @if (session('message'))
    <div>
        <div class="overlay" id="overlay" aria-label="Close" onclick="closePopup()"></div>

        <div class="error-popup">
            <i class="bi bi-x-lg fs-4" aria-label="Close" onclick="closePopup()"></i>
            <div class="error-icon">
                <i class="icon bi bi-x-circle"></i>
            </div>
            <div class="container-contents">
                <h3>Ooops!</h3>
                {!! session('message') !!}
                {{-- <button onclick="">Button</button> --}}
            </div>
        </div>

    </div>
    @endif
    <!--CONTENT-->
    <div class="body">
        <div class="container center-content">
            <!-- BuyAni Heading -->
            <h1 class="buyani">
                <span class="buy">Buy</span><span class="ani">Ani</span>
            </h1>


            <div class="row">
                <div class="row">
                    <div class="col col-md-6 consumer-container">
                        <img class="icons" src="{{ asset('img/title/consumer.png') }}">
                        <form action="{{ route('user.login') }}" method="GET">
                            <input type="hidden" name="user_type" value="1">
                            <button type="submit" class="button button-login">Login As Consumer</button>
                        </form>
                        <form action="{{ route('user.register') }}" method="GET">
                            <input type="hidden" name="user_type" value="1">
                            <button class="button button-signup">Sign Up As Consumer</button>
                        </form>
                    </div>
                    <div class="col col-md-6 farmer-container">
                        <img class="icons" src="{{ asset('img/title/farmer.png') }}">
                        <form action="{{ route('user.login') }}" method="GET">
                            <input type="hidden" name="user_type" value="2">
                            <button class="button button-login">Login As Farmer</button>
                        </form>
                        <form action="{{ route('user.register') }}" method="GET">
                            <input type="hidden" name="user_type" value="2">
                            <button class="button button-signup">Sign Up As Farmer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
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
</script>
@endsection
