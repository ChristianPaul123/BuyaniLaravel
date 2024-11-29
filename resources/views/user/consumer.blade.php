@extends('layouts.app') <!-- Extending the parent layout -->

@section('title', 'consumer Page') <!-- Defining a title for this view -->

@push('styles')
<style>
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

    button {
        background-color: #ffc107;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }

    .error-popup button:hover {
        background-color: #e0a800;
    }

    .error-icon .icon {
        color: #ffffff;
    }

    .error-popup .bi-x-lg {
        color: #fff;
        position: absolute;
        top: 10px;
        right: 10px;
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
                 <p>{{ session('message') }}</p>
                 {{-- <button onclick="">Button</button> --}}
             </div>
         </div>

     </div>
     @endif
    <!-- Main Page -->
    <section class="hero-section d-flex align-items-center" style="background-image: url({{ asset('img/stockImg3.png') }}); background-repeat: no-repeat; background-size: cover; background-position: center; height: 650px;">
        <div class="container">
            <h1 class="display-4" style="color: #FFFF; font-size: 60px; font-weight: bold; margin-bottom: -10px;">EMPOWER FARMERS</h1>
            <h1 style="color: #F39634; font-size: 60px; font-weight: bold; display: inline;">ENRICH </h1><h1 style="color: #69A543; font-size: 60px; font-weight: bold; display: inline;">COMMUNITIES</h1>
            <p class="lead" style="color: #FFFF; font-size: 22px; font-weight: bold;">BuyAni, Where Every Purchase is a Celebration of Hard Work and Fresh Harvests</p>
            <a href="/user/consumer/products" class="btn btn-lg" style="background-color: #F39634; color: #FFFF;">SHOP NOW!</a>
        </div>
    </section>

    <!-- Our Products -->
    <section class="text-center p-3">
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
  </script>

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

