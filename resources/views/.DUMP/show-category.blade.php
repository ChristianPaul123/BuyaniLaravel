<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Catalog</title>
    @include('layouts.head')
    @include('user.styles.user_styles')
    <style>

        .navbar-category {
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 1000;
        background-color: #175593;
        border-bottom: 1px solid #ddd;
    }
    .navbar-nav .nav-link {
        color: #333;
    }
    .navbar-nav .nav-link.active {
        font-weight: bold;
    }

        .product-card img {
            max-width: 100%;
            height: auto;
        }
        .main-content {
            margin: 0 auto;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: start;
        }
        .card-container .col-md-2 {
            margin: 0.5rem;
        }
        .more-container {
            display: none;
            overflow: hidden;
        }
        .more-container.visible {
            display: flex;
            flex-wrap: wrap;
            animation: fadeIn 0.5s ease-out;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .show-more-btn {
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    @include('user.includes.navbar-consumer')
<div class="main-content-wrapper">
    <div class="container container-fluid mt-1">
    <!-- Navbar -->
    <section class="p-3">
        @include('components.navbar-product')

        <div class="container-fluid">
            <div class="row justify-content-center align-items-center">

                @if (isset($message))
                    <div class="alert alert-info">
                        {{ $message }}
                    </div>
                @endif


                <!-- Main content -->
                <main class="d-flex d-flex-row col-md-12 col-lg-10 px-md-4 mt-3 main-content">
                            @foreach ($products as $product)
                            <div class="col-md-3 offset-md-2 m-1">
                                    <div class="card">
                                        <div class="card-header d-flex align-items-center justify-content-center">
                                          <div class="ms-3">
                                            <h6 class="mb-0 fs-sm text-center">{{ $product->product_name }}</h6>
                                          </div>
                                          {{-- <div class="dropstart ms-auto">
                                            <button class="btn text-muted" type="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                              <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                              <li>
                                                <a class="dropdown-item" href="#">Action</a>
                                              </li>
                                              <li><a class="dropdown-item" href="#">Another action</a></li>
                                            </ul>
                                          </div> --}}

                                        </div>
                                        <img src="{{ asset( "$product->product_pic" ) }}" class="card-img-top" alt="products {{ asset( "$product->product_name" ) }}" />
                                        <div class="card-body align-items-center">
                                            <p class="card-text">{{ $product->product_details }}</p>
                                        </div>
                                        <div class="card-footer d-flex">
                                            <button class="btn btn-subtle" type="button"><i class="fas fa-heart fa-lg"></i></button>
                                          <button class="btn btn-primary w-100 p-0 me-auto fw-bold" href=" {{-- {{ route('product.info', $product->id) --}}">View</button>
                                          <button class="btn btn-subtle" type="button"><i class="fas fa-share fa-lg"></i></button>
                                        </div>
                                    </div>
                                    </div>
                            @endforeach

                </main>
            </div>
        </div>
    </section>
    </div>

</div>

    @include('layouts.footer')
    @include('layouts.script')
</body>
</html>
