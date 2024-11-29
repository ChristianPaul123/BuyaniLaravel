<div class="container container-fluid" style="background-color: rgb(195, 184, 184); border-radius: 8px; padding: 20px;">


    <section class="p-3">
        <div class="d-flex justify-content-start my-5">
            <button class="btn btn-secondary" onclick="window.history.back()">&#9754; Back</button>
        </div>
        <h3 class="text-center mt-2" style="color: #4CAF50;">{{ $product->product_name }}</h3>

        <!-- Success and Error Messages -->
        @if (session()->has('message'))
            <div class="alert alert-success mx-3 my-2 px-3 py-2">
                <button type="button" class="close btn btn-success" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session('message') }}
            </div>
        @endif

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

        <!-- Product Information -->
        <div class="row mb-5">
            <!-- Product Image -->
            <div class="col-12 col-md-6 p-3">
                <div class="image-container shadow-sm rounded" style="height: 400px; width: 100%; overflow: hidden;">
                    <img src="{{ asset($product->product_pic) }}" alt="{{ $product->product_name }}" style="object-fit: cover; width: 100%; height: 100%;">
                </div>
            </div>

            <!-- Product Details -->
            <div class="col-12 col-md-6 d-flex flex-column gap-3">
                <h4 class="text-uppercase font-weight-bold">Product Information</h4>
                <h5 style="color: #555;">{{ $product->product_name }}</h5>
                <p style="color: #777;">Tags: <span class="font-weight-bold">{{ $categories->category_name }}, {{ $subcategories->sub_category_name }}</span></p>
                <p style="color: #777;">In Store: <span class="font-weight-bold text-success">{{ $product->status_label }}</span></p>

                <!-- Product Specifications -->
                <h5 style="color: #555;">Product Specifications</h5>
                <div class="row">
                    @forelse ($specifications as $specification)
                        <div class="col-12 col-md-6 mb-3">
                            <div class="card shadow-sm" style="font-size: 0.9rem; border-radius: 8px; border: none;">
                                <div class="card-header text-center" style="background-color: #4CAF50; color: white; font-weight: bold;">
                                    {{ $specification->specification_name }}
                                </div>
                                <div class="card-body p-3">
                                    <p class="mb-1">Price: <span class="font-weight-bold text-primary">₱{{ $specification->product_price }}</span></p>
                                    <div class="d-flex align-items-center mb-2">
                                        <h6 class="mb-0">Quantity:</h6>
                                        <div class="input-group ml-2" style="max-width: 130px;">
                                            <button class="btn btn-outline-secondary btn-sm" type="button" wire:click="decrementQuantity({{ $specification->id }})">-</button>
                                            <input type="text" class="form-control text-center" wire:model="quantities.{{ $specification->id }}" readonly>
                                            <button class="btn btn-outline-secondary btn-sm" type="button" wire:click="incrementQuantity({{ $specification->id }})">+</button>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-sm w-100" wire:click="addToCart({{ $specification->id }})" style="background-color: #4CAF50; border: none;">Add To Cart</button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p>No specifications found for this product.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination Links -->
                <div class="d-flex justify-content-center mt-3">
                    {{ $specifications->links() }}
                </div>
            </div>
        </div>
    </section>

    <!-- Product Reviews Section -->
    <section class="mt-5">
        @livewire('product-rating-system', ['productId' => $product->id])
    </section>
</div>
