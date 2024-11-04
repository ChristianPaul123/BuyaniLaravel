@extends('layouts.app') <!-- Extending the parent layout -->

@section('title', 'consumer Page') <!-- Defining a title for this view -->

@push('styles')

@endpush
@section('x-content')
     @include('user.includes.navbar-consumer')
     {{-- <form action="{{ route('user.logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
     <h1>Welcome to Consumer Dashboard, {{ auth()->guard('user')->user()->username }}</h1> --}}

    <!-- Main Page -->
    <section class="hero-section d-flex align-items-center" style="background-image: url({{ asset('img/stockImg3.png') }}); background-repeat: no-repeat; background-size: cover; background-position: center; height: 650px;">
        <div class="container">
            <h1 class="display-4" style="color: #FFFF; font-size: 60px; font-weight: bold; margin-bottom: -10px;">EMPOWER FARMERS</h1>
            <h1 style="color: #F39634; font-size: 60px; font-weight: bold; display: inline;">ENRICH </h1><h1 style="color: #69A543; font-size: 60px; font-weight: bold; display: inline;">COMMUNITIES</h1>
            <p class="lead" style="color: #FFFF; font-size: 22px; font-weight: bold;">BuyAni, Where Every Purchase is a Celebration of Hard Work and Fresh Harvests</p>
            <a href="consumer-shop.php" class="btn btn-lg" style="background-color: #F39634; color: #FFFF;">SHOP NOW!</a>
        </div>
    </section>

    <!-- Our Products -->
    <section class="text-center p-3">
        <livewire:test>
        <h1>Our Products</h1>
        <p>Freshly delivered from our local farmers!</p>
        <div class="container-fluid">
            <div class="d-flex flex-row md-4">
                @foreach ($products as $product)
                <div class="col-md-3 offset-md-2 m-1">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-center">
                          <div class="ms-3">
                            <h6 class="mb-0 fs-sm text-center">{{ $product->product_name }}</h6>
                          </div>
                        </div>
                        <img src="{{ asset( "$product->product_pic" ) }}" class="card-img-top" alt="products {{ asset( "$product->product_name" ) }}" />
                        <div class="card-body">
                            <p class="card-text">{{ $product->product_details }}</p>
                        </div>
                        <div class="card-footer d-flex">
                            <button class="btn btn-subtle" type="button"><i class="fas fa-heart fa-lg"></i></button>
                          <a class="btn btn-primary w-100 p-2 me-auto fw-bold" href=" {{ route('user.consumer.product.view', $product->id)}}">View</a>
                          <button class="btn btn-subtle" type="button"><i class="fas fa-share fa-lg"></i></button>
                        </div>
                      </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Details -->
     <section>
        <div class="row p-5">
            <div class="col-md-6 d-flex justify-content-center" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="100">
                <img src= "{{ asset('img/stockImg.png') }}" alt="Landscape Image" width="600" height="400" style="border-radius: 20px;">
            </div>
            <div class="col-md-6 px-5">
                <h4>Lorem Ipsum</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
            </div>
        </div>
        <div class="row p-5">
            <div class="col-md-6 px-5">
                <h4>Lorem Ipsum</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
            </div>
            <div class="col-md-6 d-flex justify-content-center" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="100">
                <img src="../img/stockImg2.png" alt="Landscape Image" width="600" height="400" style="border-radius: 20px;">
            </div>
        </div>
     </section>

     <!-- Contact Us -->
     <section class="p-3" style="background-image: url({{ asset('img/stockImg5.png') }}); background-repeat: no-repeat; background-size: cover; background-position: center; height: 450px;">
        <div class="row h-100 d-flex align-items-center">
            <div class="col-md-6 d-flex flex-column align-items-center justify-content-center">
                <h3 class="pb-2" style="color:chartreuse;">Contact Us For Inquiries!</h3>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d294.38162674181825!2d123.71843815368132!3d13.15098642433476!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a1015eccf097cb%3A0x8e91fc8310d08926!2sVKY%20FRUITS%20AND%20VEGETABLES%20TRADING!5e0!3m2!1sen!2sph!4v1726749600004!5m2!1sen!2sph"
                    width="400"
                    height="300"
                    style="border: 2px solid #000; border-radius: 20px;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
            <div class="col-md-6 d-flex align-items-center">
                <div class="container p-3" style="width:500px; background-color: #5DC14C; border: solid black 2px; border-radius: 20px">
                    <h2 class="text-center">Contact Form</h2>
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
                            <textarea class="form-control" id="message" rows="3" placeholder="Enter your message"></textarea>
                        </div>
                        <div class="text-center pt-1">
                            <button type="submit" class="btn" style="background-color: #F39634; color: #FFFF;">Send</button>
                        </div>
                    </form>
                </div>
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

