<div>
    <section>
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
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="container my-5">
            <h2 class="mb-4">Checkout</h2>

            <!-- Shipping Address Dropdown -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card p-4">
                        <h5>Select Shipping Address</h5>
                        <select class="form-select mt-3" wire:model.live="selectedAddress">
                            <option value="">Select a saved address</option>
                            @if ($shippingAddresses->isNotEmpty())
                                @foreach ($shippingAddresses as $address)
                                    <option value="{{ $address->id }}">
                                        {{ $address->shipping_name }}, {{ $address->street }}, {{ $address->city }},
                                        {{ $address->state }}, {{ $address->country }}
                                    </option>
                                @endforeach
                            @else
                                <option value="" disabled>No saved addresses available</option>
                            @endif
                        </select>
                        <a class="btn btn-primary mt-3 w-100"
                            wire:click="confirmSelectedAddress({{ $selectedAddress ?? 'null' }})"
                            {{ empty($selectedAddress) ? 'disabled' : '' }}>
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
                                    <input type="text" class="form-control" id="name"
                                        wire:model="shippingInfo.name">
                                    @error('shippingInfo.name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" class="form-control" id="phone"
                                        wire:model="shippingInfo.phone">
                                    @error('shippingInfo.phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="email"
                                        wire:model="shippingInfo.email">
                                    @error('shippingInfo.email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="street" class="form-label">Street</label>
                                    <input type="text" class="form-control" id="street"
                                        wire:model="shippingInfo.street">
                                    @error('shippingInfo.street')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control" id="city"
                                        wire:model="shippingInfo.city">
                                    @error('shippingInfo.city')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="state" class="form-label">State</label>
                                    <input type="text" class="form-control" id="state"
                                        wire:model="shippingInfo.state">
                                    @error('shippingInfo.state')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="zip_code" class="form-label">Zip Code</label>
                                    <input type="text" class="form-control" id="zip_code"
                                        wire:model="shippingInfo.zip_code">
                                    @error('shippingInfo.zip_code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="barangay" class="form-label">Barangay</label>
                                    <input type="text" class="form-control" id="barangay"
                                        wire:model="shippingInfo.barangay">
                                    @error('shippingInfo.barangay')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="zip_code" class="form-label">Zip Code</label>
                                    <input type="text" class="form-control" id="zip_code"
                                        wire:model="shippingInfo.zip_code">
                                    @error('shippingInfo.zip_code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="country" class="form-label">Country</label>
                                    <input type="text" class="form-control" id="country"
                                        wire:model="shippingInfo.country">
                                    @error('shippingInfo.country')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="house_number" class="form-label">House Number</label>
                                    <input type="text" class="form-control" id="house_number"
                                        wire:model="shippingInfo.house_number">
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

                        @foreach ($cartItems as $item)
                            <div class="d-flex justify-content-between align-items-center border-bottom py-2"
                                wire:key="{{ $item->id }}">
                                <p>{{ $item->product_specification->product->product_name }} /
                                    {{ $item->product_specification->specification_name }} x {{ $item->quantity }}
                                </p>
                                <p>{{ $item->overall_kg }} / {{ $item->overall_kg }}
                                <p>₱{{ $item->price }}</p>
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
                            <input class="form-check-input" type="radio" wire:model="paymentMethod"
                                name="paymentMethod" id="cod" value="COD">
                            <label class="form-check-label" for="cod">Cash on Delivery</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" wire:model="paymentMethod"
                                name="paymentMethod" id="gcash" value="GCash">
                            <label class="form-check-label" for="gcash">GCash</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" wire:model="paymentMethod"
                                name="paymentMethod" id="stripe" value="Stripe">
                            <label class="form-check-label" for="stripe">Credit Card or Debit Card</label>
                            <div class="mt-3" id="stripe-div">
                                <div class="form-control" id="card-element"></div>
                                <div id="card-errors" role="alert"></div>
                                {{-- <div id="payment-request-button" style="margin-bottom: 20px;"></div>
                                <div class="form-control" id="card-element"></div>
                                <div id="card-errors" role="alert" class="text-danger"></div> --}}
                            </div>
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
                    <button id="confirm" class="btn btn-success w-100">Continue</button>
                    {{--  wire:click="processCheckout" --}}
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const paymentMethodRadios = document.querySelectorAll('input[name="paymentMethod"]');
        const stripeDiv = document.getElementById('stripe-div');

        paymentMethodRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                const selectedValue = document.querySelector(
                    'input[name="paymentMethod"]:checked').value;

                if (selectedValue === 'Stripe') {
                    stripeDiv.classList.add('active');
                    initializeStripe("{{ $stripeKey }}");
                } else {
                    stripeDiv.classList.remove('active');
                }
            });
        });

        // Initial check for page load
        const initiallySelected = document.querySelector('input[name="paymentMethod"]:checked');
        if (initiallySelected && initiallySelected.value === 'Stripe') {
            stripeDiv.classList.add('active');

        }
    });
</script>
<script src="https://js.stripe.com/v3/"></script>
<script>
    let stripe;
    let elements;
    let card;

    function initializeStripe(stripeKey) {
        stripe = Stripe(stripeKey);
        // elements = stripe.elements();
        elements = stripe.elements({
            externalPaymentMethodTypes: ['external_gcash']
        });
        card = elements.create("card");
        card.mount("#card-element");
    }

    // Initial load
    document.addEventListener("DOMContentLoaded", () => {
        initializeStripe("{{ $stripeKey }}");
    });

    // Optional: Handle errors globally
    function handleStripeErrors(error) {
        if (error) {
            alert(error.message);
        }
    }

    document.getElementById('confirm').addEventListener('click', async (event) => {
        event.preventDefault();
        var selected = document.querySelector('input[name="paymentMethod"]:checked').value;
        // Generate the token

        if (selected === 'Stripe') {
            const {
                token,
                error
            } = await stripe.createToken(card);

            if (error) {
                // Display Stripe errors and stop submission
                document.getElementById('card-errors').textContent = error.message;
            } else {
                // Attach the token to a hidden input for Livewire
                @this.set('stripeToken', token.id);

                console.log(token.id);

                // Trigger the Livewire method
                @this.processCheckout();
            }
        } else {
            @this.processCheckout();
        }
    });
</script>
{{-- <script>
    let stripe;
    let elements;
    let card;
    let paymentRequest;
    let prButton;

    function initializeStripe(stripeKey) {
        stripe = Stripe(stripeKey);

        // Initialize Elements
        elements = stripe.elements();

        // Create the Card Element
        card = elements.create("card");
        card.mount("#card-element");

        // Initialize Payment Request for Wallets
        paymentRequest = stripe.paymentRequest({
            country: "US", // Adjust based on your region
            currency: "usd", // Adjust currency as needed
            total: {
                label: "Total",
                amount: 2000, // Total amount in the smallest currency unit (e.g., 2000 for $20.00)
            },
            requestPayerName: true,
            requestPayerEmail: true,
        });

        // Create the Payment Request Button Element
        prButton = elements.create("paymentRequestButton", {
            paymentRequest: paymentRequest,
        });

        // Check if the Payment Request Button can be displayed
        paymentRequest.canMakePayment().then((result) => {
            if (result) {
                // Mount the Payment Request Button
                prButton.mount("#payment-request-button");
            } else {
                // Hide the Payment Request Button if not supported
                document.getElementById("payment-request-button").style.display = "none";
            }
        });

        // Handle Payment Request Events
        paymentRequest.on("paymentmethod", async (event) => {
            const { error } = await stripe.confirmCardPayment("{{ $clientSecret }}", {
                payment_method: event.paymentMethod.id,
            });

            if (error) {
                event.complete("fail");
                alert(error.message);
            } else {
                event.complete("success");
                alert("Payment successful!");
                // Trigger Livewire checkout process
                @this.processCheckout();
            }
        });
    }

    // Initial load
    document.addEventListener("DOMContentLoaded", () => {
        initializeStripe("{{ $stripeKey }}");
    });

    // Optional: Handle errors globally
    function handleStripeErrors(error) {
        if (error) {
            alert(error.message);
        }
    }

    // Handle form submission
    document.getElementById('confirm').addEventListener('click', async (event) => {
        event.preventDefault();
        var selected = document.querySelector('input[name="paymentMethod"]:checked').value;

        if (selected === 'Stripe') {
            const { token, error } = await stripe.createToken(card);

            if (error) {
                // Display Stripe errors and stop submission
                document.getElementById('card-errors').textContent = error.message;
            } else {
                // Attach the token to a hidden input for Livewire
                @this.set('stripeToken', token.id);
                console.log(token.id);
                // Trigger the Livewire method
                @this.processCheckout();
            }
        } else {
            @this.processCheckout();
        }
    });
</script> --}}

