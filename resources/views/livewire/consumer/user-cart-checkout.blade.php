<div>
    <section>
        @include('user.includes.messageBox')
            <div class="container my-5">
                <h2 class="mb-4">Checkout</h2>

                <!-- Shipping Address Dropdown -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card p-4">
                            <h5>Select Shipping Address</h5>
                            <select class="form-select mt-3" wire:model.live="selectedAddress">
                                <option value="">Select a saved address</option>
                                @foreach($shippingAddresses as $address)
                                    <option value="{{ $address->id }}">
                                        {{ $address->shipping_name }}, {{ $address->street }}, {{ $address->city }}, {{ $address->state }}, {{ $address->country }}
                                    </option>
                                @endforeach
                            </select>
                            <a class="btn btn-primary mt-3 w-100" wire:click="confirmSelectedAddress({{ $address->id }})" {{ !$address ? 'disabled' : '' }}>
                                Confirm
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Shipping Information Form -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card p-4">
                            <h5>Shipping Information</h5>
                            <form class="mt-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" wire:model="shippingInfo.name">
                                        @error('shippingInfo.name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" class="form-control" id="phone" wire:model="shippingInfo.phone">
                                        @error('shippingInfo.phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" class="form-control" id="email" wire:model="shippingInfo.email">
                                        @error('shippingInfo.email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="street" class="form-label">Street</label>
                                        <input type="text" class="form-control" id="street" wire:model="shippingInfo.street">
                                        @error('shippingInfo.street')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="city" class="form-label">City</label>
                                        <input type="text" class="form-control" id="city" wire:model="shippingInfo.city">
                                        @error('shippingInfo.city')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="state" class="form-label">State</label>
                                        <input type="text" class="form-control" id="state" wire:model="shippingInfo.state">
                                        @error('shippingInfo.state')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="zip_code" class="form-label">Zip Code</label>
                                        <input type="text" class="form-control" id="zip_code" wire:model="shippingInfo.zip_code">
                                        @error('shippingInfo.zip_code')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="country" class="form-label">Country</label>
                                        <input type="text" class="form-control" id="country" wire:model="shippingInfo.country">
                                        @error('shippingInfo.country')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="house_number" class="form-label">House Number</label>
                                        <input type="text" class="form-control" id="house_number" wire:model="shippingInfo.house_number">
                                        @error('shippingInfo.house_number')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- 3. Cart Items -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card p-4">
                            <h5>Cart Items</h5>

                            @foreach($cartItems as $item)
                                <div class="d-flex justify-content-between align-items-center border-bottom py-2" wire:key="{{ $item->id }}">
                                    <p>{{ $item->product_specification->product->product_name }} / {{ $item->product_specification->specification_name }} x {{ $item->quantity }} </p>
                                    <p>{{  $item->overall_kg }} / {{ $item->overall_kg }}
                                    <p>₱{{ $item->price}}</p>
                                </div>
                            @endforeach
                            <div class="d-flex justify-content-between align-items-center pt-3">
                                <h6>Total</h6>
                                <h6>₱{{ $totalPrice }}</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 4. Payment Method -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card p-4">
                            <h5>Payment Method</h5>
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="radio" wire:model="paymentMethod" id="cod" value="COD">
                                <label class="form-check-label" for="cod">Cash on Delivery</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" wire:model="paymentMethod" id="gcash" value="GCash">
                                <label class="form-check-label" for="gcash">GCash</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 5. Action Buttons -->
                <div class="row mt-4">
                    <div class="col-6 text-start">
                        <button class="btn btn-danger w-100" onclick="window.history.back()">Cancel</button>
                    </div>
                    <div class="col-6 text-end">
                        <button wire:click="processCheckout" class="btn btn-success w-100">Continue</button>
                    </div>
                </div>
            </div>
        </section>
    </div>

@script
<script>
    // Show the flash message popup if it exists
    const flashPopup = document.querySelector('#flashMessage');

    if (flashPopup) {
        // Display the elements and start fade-in animation
        flashPopup.style.display = 'flex';

        // Automatically hide the popup after 3 seconds
        setTimeout(() => {
            flashPopup.classList.add('hidden');

            // After animation ends, hide the elements entirely
            setTimeout(() => {
                flashPopup.style.display = 'none';
            }, 150); // Match the duration of the animation
        }, 3000); // 3 seconds
    }
</script>
@endscript
