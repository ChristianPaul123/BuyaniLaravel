<div id="ajaxMessage" class="alert d-none mx-3 my-2 px-3 py-2" role="alert">
    <button type="button" class="close" onclick="hideMessage()">
        <span aria-hidden="true">&times;</span>
    </button>
    <span id="messageContent"></span>
</div>

<div class="container mt-5 mb-5">
<!-- Shopping Cart Section -->
<section class="container-fluid">
    <h2 class="mb-4">Shopping Cart</h2>
    <div class="row md-12">
        <!-- Cart Items -->
        <div class="col-lg-9" id="cartItemsContainer">
            @foreach($cartItems as $item)
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row align-items-center g-3">
                        <div class="col-md-1">
                            <img src="{{ asset($item->product_specification->product->product_pic) }}" alt="{{ $item->product_specification->specification_name }}" class="img-fluid">
                        </div>
                        <div class="col-md-2">
                            <p class="h5 card-title mb-1">{{ $item->product_specification->specification_name }}</p>
                        </div>
                        <div class="col-md-2">
                            <label for="numberInput{{ $item->id }}" class="form-label">Quantity</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="input-group-text input-group-button" onclick="updateQuantity({{ $item->id }}, 'decrement')">-</button>
                                </div>
                                <input type="number" class="form-control" id="numberInput{{ $item->id }}" value="{{ $item->quantity }}" min="1" readonly>
                                <div class="input-group-append">
                                    <button class="input-group-text input-group-button" onclick="updateQuantity({{ $item->id }}, 'increment')">+</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Weight (kg)</label>
                            <p class="text-muted mb-0">{{ $item->product_specification->product_kg * $item->quantity }}</p>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Price per item</label>
                            <p class="text-muted mb-0">{{ $item->product_specification->product_price }}</p>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Total price</label>
                            <p class="text-muted mb-0">{{ $item->price }}</p>
                        </div>
                        <div class="col-md-1 d-flex justify-content-end">
                            <button class="btn btn-danger btn-sm" onclick="removeCartItem({{ $item->id }})">Remove</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!-- Cart Summary -->
       <!-- Cart Summary Section -->
        <div class="col-lg-2">
            <div class="card">
                <div class="card-body">
                    <h5>Cart Summary</h5>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <p>Total weight:</p>
                        <p>{{ $cart->overall_cartKG }} kg</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p>Total price:</p>
                        <h6>${{ $cart->total_price }}</h6>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <h6>Total</h6>
                        <h6 id="total">${{ $cart->total_price }}</h6>
                    </div>
                    {{-- <a class="btn btn-primary w-100 mt-3" href="{{ route('user.consumer.checkout') }}">Proceed to Checkout</a> --}}
                </div>
            </div>
        </div>
    </div>
</section>
</div>
