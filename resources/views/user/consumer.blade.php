@extends('layouts.app') <!-- Extending the parent layout -->

@section('title', 'consumer Page') <!-- Defining a title for this view -->

@push('styles')
<style>
    /* Section 1 */
    *{
        /* border: 1px solid black; */
    }

    .section-1{
        height: 705px;
        padding: 100px 100px 50px 100px;
        background-image: url({{ asset('img/stockImg3.png') }});
    }
    .section-1 .container{
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .section-1 h1{
        font-size: 60px;
        font-weight: bold;
        padding: 0;
    }
    .section-1 h1:nth-of-type(1){
        color: #ffffff;
    }
    .section-1 h1:nth-of-type(2) span:nth-of-type(1){
        color: #ffa500;
    }
    .section-1 h1:nth-of-type(2) span:nth-of-type(2){
        color: #00cc1a;
    }
    .section-1 h4{
        color: #ffffff;
    }
    .section-1 button{
        width: 150px;
        height: 40px;
        border: 3px solid #ffa500;
        border-radius: 7px;
        background-color: #fff8dd;
        color: #ffa500;
        transition: all 0.5s ease;
    }
    .section-1 button:hover{
        scale: 1.1;
    }

    /* Section 2 */
    .section-2{
        padding: 50px 100px 50px 100px;

    }
    .section-2 .row:nth-of-type(1){
        text-align: center;
    }
    .promo-img{
        border-radius: 15px;
        height: 400px;
        width: 600px;
    }

    /* Section 3 */
    .section-3{
        padding: 50px 100px 50px 100px;

    }
    .section-3 .left-panel{
        text-align: center;
    }
    .section-3 .left-panel h3{
        margin-bottom: 20px;
    }
    .section-3 .right-panel .container{
        border: 5px solid #00cc1a;
        border-radius: 15px;
    }
    .section-3 button{
        width: 150px;
        height: 40px;
        border: 3px solid #ffa500;
        border-radius: 7px;
        background-color: #ffa500;
        color: #fff8dd;
        transition: all 0.5s ease;
    }
    .section-3 button:hover{
        scale: 1.1;
    }

</style>

@endpush
@section('x-content')
     @include('user.includes.navbar-consumer')
     <section class="main-page">

        <!-- Section 1 -->
        <div class="row section-1">
            <div class="container">
                <h1 style="margin-bottom: -10px;">EMPOWER FARMERS</h1>
                <h1>
                    <span>ENRICH</span>
                    <span>COMMUNITIES</span>
                </h1>
                <h4>BuyAni, Where Every Purchase is a Celebration of Hard Work and Fresh Harvests</h4>
                <button>Shop Now!</button>
            </div>
        </div>

        <!-- Section 2 -->
        <div class="row section-2">
            <div class="row">
                <h2>Our Products</h2>
                <h4>Freshly delivered from our local farmers!</h4>
            </div>
            <div class="row">
                palagay dito basic na card layout ng products
            </div>
            <div class="row">
                <div class="col-md-6 text-center">
                    <img class="promo-img" src= "{{ asset('img/stockImg.png') }}">
                </div>
                <div class="col-md-6 promo-text pt-5">
                    <h3>Lorem Ipsum</h3>
                    <h6>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </h6>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 promo-text pt-5">
                    <h3>Lorem Ipsum</h3>
                    <h6>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </h6>
                </div>
                <div class="col-md-6 text-center">
                    <img class="promo-img" src= "{{ asset('img/stockImg2.png') }}">
                </div>
            </div>
        </div>

        <!-- Section 3 -->
        <div class="row section-3">
            <div class="col-md-6 left-panel">
                <h3>Contact Us For Inquiries!</h3>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d294.38162674181825!2d123.71843815368132!3d13.15098642433476!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a1015eccf097cb%3A0x8e91fc8310d08926!2sVKY%20FRUITS%20AND%20VEGETABLES%20TRADING!5e0!3m2!1sen!2sph!4v1726749600004!5m2!1sen!2sph"
                    width="400"
                    height="300"
                    style="border: 4px solid #000; border-radius: 20px;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
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

    </section>
@endsection
@section('scripts')
<script>
    window.addEventListener('popstate', function(event) {
        // If the user press the back button, log them out
        window.location.href = "{{ route('user.logout') }}";
    });

    document.addEventListener('DOMContentLoaded', function() {
        AOS.init();
    });
  </script>
@endsection

