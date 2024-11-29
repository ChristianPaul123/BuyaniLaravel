<div class="container mt-5 mb-5">
    <section class="container-fluid">
        <h2 class="mb-4">Shopping Cart</h2>
        @if(session()->has('message'))
        <div class="alert alert-success mt-3">{{ session('message') }}</div>
        @elseif(session()->has('error'))
            <div class="alert alert-danger mt-3">{{ session('error') }}</div>
        @endif
        <div class="row">
            <div class="col-lg-9" id="cartItemsContainer">
                @forelse($cartItems as $item)
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
                                    <button class="input-group-text" wire:click="updateQuantity({{ $item->id }}, 'decrement')">-</button>
                                    <input type="number" class="form-control" value="{{ $item->quantity }}" min="1" readonly>
                                    <button class="input-group-text" wire:click="updateQuantity({{ $item->id }}, 'increment')">+</button>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Weight (kg)</label>
                                <p class="text-muted mb-0">{{ $item->overall_kg }}</p>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Price per item</label>
                                <p class="text-muted mb-0">{{ $item->product_specification->product_price }}</p>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Total price</label>
                                <p class="text-muted mb-0">{{ $item->price }}</p>
                            </div>
                            <div class="col-md-1">
                                <button class="btn btn-danger btn-sm" wire:click="removeCartItem({{ $item->id }})">Remove</button>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <p>No cart items yet!</p>
                @endforelse
            </div>

            <div class="col-lg-2">
                <div class="card">
                    <div class="card-body">
                        <h5>Cart Summary</h5>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <p>Total quantity: {{ $cart->cart_total }}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p>Total weight:</p>
                            <p>{{ $cart->overall_cartKG }} kg / 25 kg</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p>Total price:</p>
                            <h6>${{ $cart->total_price }}</h6>
                        </div>

                        <a href="{{ route('user.consumer.product.cart.checkout', ['cartId' => $cart->id]) }}" class="btn btn-primary w-100 mt-3">Proceed to Checkout</a>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
