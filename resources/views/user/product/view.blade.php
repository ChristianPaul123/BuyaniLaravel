@extends('layouts.app') <!-- Extend your main layout -->

@section('title', 'Product Catalog') <!-- Define the title for this page -->

@push('styles')
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
    </style>
@endpush

@section('x-content')
<body>
    @include('user.includes.navbar-consumer')
    <div class="main-content-wrapper">
        <!-- All your main page content goes here -->
        <div class="container container-fluid" style="background-color: rgb(195, 184, 184)">
            <section>
                <h3 class= 'text-center mt-2 '>{{ $product->product_name }}</h3>
                <div class="row">
                    @session('message')
                    <div class=" mx-3 my-2 px-3 py-2 alert alert-success">
                        <button type="button" class="close  btn btn-success" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session('message') }}
                    </div>
                   @endsession
                   {{-- if there's errors --}}
                    @if ($errors->any())
                    <div class="alert alert-danger mx-3 my-2 px-3 py-2">
                        <button type="button" class="close btn btn-danger" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col">
                               <img class="img-fluid" src="{{ asset( "$product->product_pic" ) }}" alt="{{ $product->product_name }}" style="max-width: 80%; height: auto;">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row md-2 my-2">
                            <p class="h5 text-center">Product Information</p>
                            <div class="col">{{ $product->product_details }}</div>
                        </div>
                        <div class="row md-2 my-3">
                            <div class="col">Tags: {{ $product->category->category_name }} , {{ $product->subcategory->sub_category_name }}</div>
                        </div>
                        <div class="row md-2 mb-3">
                            <div class="col">In Store: {{ $product->status_label }}</div>
                        </div>
                        {{-- <div class="row mb-2">
                            <div class="col">Stocks: {{ $product->inventory->product_total_stock }}</div>
                        </div> --}}
                        <div class="row md-2">
                            <div class="col">Product Specification:</div>
                        </div>
                        <div class="row md-4" >
                            @foreach ($product->productSpecification as $specification)
                            <div class="col-md-3 offset-md-2 m-1">
                                <div class="card">
                                    <div class="card-header d-flex align-items-center justify-content-center">
                                        <div class="ms-3">
                                            <h6 class="mb-0 fs-sm text-center">{{ $specification->specification_name }}</h6>
                                        </div>
                                    </div>
                                    <img src="{{ asset( "$product->product_pic" ) }}" class="card-img-top" width="40%" height="auto" alt="products {{ asset( "$product->product_name" ) }}" />
                                    <div class="card-body">
                                        <p class="card-text">Price: ₱{{ $specification->product_price }}</p>
                                        <p class="card-text">{{ $specification->specific_product_info }}</p>
                                    </div>
                                    <form action="{{ route('user.consumer.product.cart.add', ['product' => $product->id, 'specification' => $specification->id]) }}" method="POST">
                                        @csrf
                                        <div class="row align-items-center">
                                            <div class="col-8">
                                                <label for="quantity" class="form-label">Quantity</label>
                                                <input hidden id="product_status" name="product_status" value="{{ $product->product_status }}">
                                                <input class="form-control" id="quantity" name="quantity" type="number" value="1" min="1">
                                            </div>
                                            <div class="col-12 d-flex align-items-end">
                                                <button type="submit" class="btn btn-primary w-100">Add to Cart</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Product Reviews</h5>
                                <p class="card-text">Make this.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <div class="row">
                    <div class="col text-center">
                        <h2>Coming Soon</h2>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection


</body>
</html>
