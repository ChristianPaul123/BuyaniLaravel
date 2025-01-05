{{-- <div class="container mt-5 mb-5">
    <section class="container-fluid min-height">
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

                        @if($cart->cart_total == 0)
                        <button class="btn btn-secondary w-100 mt-3" disabled>Proceed to Checkout</button>
                        @else
                            <a href="{{ route('user.consumer.product.cart.checkout', ['cartId' => $cart->id]) }}" class="btn btn-primary w-100 mt-3">Proceed to Checkout</a>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </section>
</div> --}}


<div class="container mt-5 mb-5">
    <section class="container-fluid min-height">
        <h2 class="mb-4">Shopping Cart</h2>
        @if(session()->has('message'))
        <div class="alert alert-success mt-3">{{ session('message') }}</div>
        @elseif(session()->has('error'))
            <div class="alert alert-danger mt-3">{{ session('error') }}</div>
        @endif

        <div class="row">
            <div class="col-lg-9" id="cartItemsContainer">
                <button class="btn btn-secondary mb-3" wire:click="toggleSelectAll">
                    {{ $selectAll ? 'Deselect All' : 'Select All' }}
                </button>

                @forelse($cartItems as $item)
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row align-items-center g-3">
                            <div class="col-md-1">
                               <div class="d-flex justify-content-center">
                                    <div>
                                    <input type="checkbox"
                                        value="{{ $item->id }}"
                                        wire:change="selectItem({{ $item->id }})"
                                        {{ in_array($item->id, $selectedItems) ? 'checked' : '' }}>
                                    @if (in_array($item->id, $selectedItems))
                                        <p>true</p>
                                    @endif
                                </div>
                                    <div>
                                        <img src="{{ asset($item->product_specification->product->product_pic) }}" alt="{{ $item->product_specification->specification_name }}" class="img-fluid">
                                    </div>
                               </div>

                            </div>
                            <div class="col-md-2">
                                <p class="h5 card-title mb-1">{{ $item->product_specification->specification_name }}</p>
                            </div>
                            <div class="col-md-3">
                                <label for="numberInput{{ $item->id }}" class="form-label">Manage order (kg)</label>
                                <div class="input-group">
                                    <button class="input-group-text" wire:click="updateQuantity({{ $item->id }}, 'decrement')">Minus</button>
                                    <input
                                    type="number"
                                    class="form-control"
                                    name="product_add_{{ $item->id }}"
                                    id="numberInput{{ $item->id }}"
                                    wire:model="manageOrder.{{ $item->id }}" />
                                    <button class="input-group-text" wire:click="updateQuantity({{ $item->id }}, 'increment')">Add</button>
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
                            <div class="col-md-1">
                                <label class="form-label">Total price</label>
                                <p class="text-muted mb-0">{{ $item->price }}</p>
                            </div>
                            <div class="col-md-1">
                                <button class="btn btn-danger btn-sm" wire:click="removeCartItem({{ $item->id }})"><i class="fas fa-trash"></i></button>
                                @foreach ($selectedItems as $item)
                                    {{ $item }}<br>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <p>No cart items yet!</p>
                @endforelse
            </div>

            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <h5>Cart Summary</h5>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <p>Total quantity:</p>
                            <p>{{ count($selectedItems) }}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p>Total weight:</p>
                            <p>{{ $totalWeightselected }} kg / {{ $maxLimit }} kg</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p>Total price:</p>
                            <h6>${{ $totalSelectedPrice }}</h6> <!-- Display total price of selected items -->
                        </div>

                        @if(count($selectedItems) == 0)
                        <button class="btn btn-secondary w-100 mt-3" disabled>Proceed to Checkout</button>
                        @else
                        <form action="{{ route('user.consumer.product.cart.checkout', ['cartId' => $cart->id]) }}" id="checkout" method="GET">
                            @foreach ($cart->cartItems as $item)
                                <div class="form-check" style="display: none">
                                    <input type="checkbox" class="form-check-input" id="item-{{ $item->id }}" name="selectedItems[]"
                                        value="{{ $item->id }}" {{ in_array($item->id, $selectedItems ?? []) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="item-{{ $item->id }}">
                                        {{ $item->product_specification->product->name }}
                                    </label>
                                </div>
                            @endforeach

                            <button type="submit" class="btn btn-primary w-100 mt-3">Proceed to checkout</button>
                        </form>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



