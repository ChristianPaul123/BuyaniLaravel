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
        font-weight: 700;
        font-size: 7rem;
        margin-bottom: 40px;
        padding: 50px;
        color: transparent;
        -webkit-text-stroke: 1px white;
        text-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
    }

    .buyani .buy {
        color: green;
    }

    .buyani .ani {
        color: orange;
    }

    .clickable-div {
        width: 270px;
        background-color: green;
        color: white;
        padding: 15px;
        border-radius: 8px;
        text-align: center;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        font-size: 1.2rem;
        transition: transform 0.2s ease;
    }

    img {
        width: 20%;
        margin-bottom: 15px;
    }

    .clickable-div:hover {
        transform: translateY(-3px);
    }

    .clickable-div:active {
        transform: translateY(1px);
    }
</style>
@endpush
@section('x-content')
@include('user.includes.navbar-consumer')
    @if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif
    <!--CONTENT-->
    <div class="body">
        <div class="container center-content">
            <!-- BuyAni Heading -->
            <h1 class="buyani">
                <span class="buy">Buy</span><span class="ani">Ani</span>
            </h1>

            <!-- Clickable Divs with Icons in Separate Columns -->
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('user.login') }}" method="GET">
                        <input type="hidden" name="user_type" value="1">
                        <button type="submit" class="clickable-div">
                            <img src="{{ asset('img/title/consumer.png') }}" alt="Consumer Icon">
                            <h5>Interact as Consumer</h5>
                        </button>

                    </form>
                </div>
                <div class="col-md-6">
                    <form action="{{ route('user.login') }}" method="GET">
                        <input type="hidden" name="user_type" value="2">
                        <button type="submit" class="clickable-div">
                            <img src="{{ asset('img/title/farmer.png') }}" alt="Farmer Icon">
                            <h5>Interact as Farmer</h5>
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
{{-- if meron --}}
@endsection
