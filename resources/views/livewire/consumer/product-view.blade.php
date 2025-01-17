
<div class="container container-fluid mt-5">


    @include('user.includes.messageBox')

    <div class="container py-4">
        <div class="product-container">
            <div class="row">
                <div class="col-md-6 product-image">
                    <div class="d-flex justify-content-start my-2">
                        <a href="{{ route('user.consumer.product') }}" class="btn btn-secondary" ><span class="fa fa-arrow-left" aria-hidden="true"></span> Back</a>
                    </div>
                    {{-- <div class="image-container shadow-sm rounded" style="height: 400px; width: 100%; overflow: hidden;">
                        <img src="{{ asset($product->product_pic) }}" alt="{{ $product->product_name }}" style="object-fit: fill; width: 100%; height: 100%;">
                    </div> --}}
                    <div class="h-100 bg-light rounded-3 p-4">
                        <div class="product-gallery">
                            <div class="product-gallery-preview order-sm-2">
                                @foreach ($product['productImages'] as $index => $productImg)
                                    <div class="product-gallery-preview-item @if($index === 0) active @endif" id="image-{{ $productImg->id }}">
                                        <img src="{{ asset($productImg->img) }}" alt="Product image">
                                    </div>
                                @endforeach
                            </div>
                            <div class="product-gallery-thumblist order-sm-1">
                                @foreach ($product['productImages'] as $index => $productImg)
                                    <a class="product-gallery-thumblist-item @if($index === 0) active @endif" href="#image-{{ $productImg->id }}">
                                        <img class="h-100" src="{{ asset($productImg->img) }}" alt="Product thumb">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                        @php
                        $stockStatus = $product->inventory->product_total_stock;
                        $statusLabel = '';
                        $statusClass = '';

                        if ($stockStatus > 25) {
                            $statusLabel = 'In Stock';
                            $statusClass = 'text-success'; // Green for normal stock
                        } elseif ($stockStatus >= 1 && $stockStatus <= 25) {
                            $statusLabel = 'Low Stock';
                            $statusClass = 'text-warning'; // Yellow for low stock
                        } else {
                            $statusLabel = 'Out of Stock';
                            $statusClass = 'text-danger'; // Red for out of stock
                        }
                        @endphp
                    <h2 class="product-title">{{ $product->product_name }}</h2>
                    <p style="color: #777;">Tags: <span class="font-weight-bold">{{ $categories->category_name }}, {{ $subcategories->sub_category_name }}</span></p>


                    <p><strong>Price:</strong>
                        <span class="product-price">
                            @if(isset($product->productSpecification[0]->product_price))
                                {{ $product->productSpecification[0]->product_price }}
                            @else
                                Will add soon
                            @endif
                        </span>
                    </p>
                    <p><strong>Condition:</strong>
                        @if ($product->created_at->diffInDays(now()) < 5)
                            <span class="text-success">New</span>
                        @else
                            <span class="text-success">Old</span>
                        @endif
                    </p>
                    <p><strong>Quantity:</strong> <span class="font-weight-bold">{{ $product->inventory->product_total_stock }}</span></p>
                    <p>
                        <strong>Availability:</strong>
                        <span class="font-weight-bold {{ $statusClass }}">{{ $statusLabel }}</span>
                    </p>

                    @auth('user')
                    <div class="row">
                        @forelse ($specifications as $specification)
                            <div class="col-12 col-md-6 mb-3" wire:key="{{ $specification->id }}">
                                <div class="card shadow-sm" style="font-size: 0.9rem; border-radius: 8px; border: none;">
                                    <div class="card-header text-center" style="background-color: #4CAF50; color: white; font-weight: bold;">
                                        {{ $specification->specification_name }} - ₱
                                         {{ $specification->product_price }}
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <h6 class="mx-2">Quantity:</h6>
                                            <div class="input-group ml-2" style="max-width: 130px;">
                                                <button class="btn btn-outline-secondary btn-sm" type="button" wire:click="decrementQuantity({{ $specification->id }})">-</button>
                                                 <input type="text" class="form-control text-center" wire:model="quantities.{{ $specification->id }}" readonly>
                                                <button class="btn btn-outline-secondary btn-sm" type="button" wire:click="incrementQuantity({{ $specification->id }})">+</button>
                                            </div>
                                            <h6 class="mx-2"> {{ intval($product->inventory->product_total_stock) }} kg available</h6>
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
                    @else
                    <p class="text-center" style="color: #777;">Please <a href="{{ route('user.index') }}" style="color: #4CAF50;">log in</a> to buy a product.</p>
                    @endauth

                    <div class="mt-4">
                        <p><strong>Product Features:</strong></p>
                        <ul>
                            @if ($product->product_details)
                            @foreach (explode("\n", $product->product_details) as $detail)
                                @if (trim($detail) !== '')
                                    <li>{{ $detail }}</li>
                                @endif
                            @endforeach
                        @else
                            <li>No product details available.</li>
                        @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Reviews Section -->
    <section class="mt-5">
        @livewire('consumer.product-rating-system', ['productId' => $product->id])
    </section>
</div>

{{-- #code dump --}}
                    {{-- <div class="row">
                        @forelse ($specifications as $specification)
                            <div class="col-12 col-md-6 mb-3" wire:key="{{ $specification->id }}">
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
                    </div> --}}


    {{-- <section class="p-3">
        <div class="d-flex justify-content-start my-5">
            <button class="btn btn-secondary" onclick="window.history.back()">&#9754; Back</button>
        </div>



        <!-- Product Information -->
        <div class="row">
            <div class="col-md-6 product-image">
                <div class="image-container shadow-sm rounded" style="height: 400px; width: 100%; overflow: hidden;">
                    <img src="{{ asset($product->product_pic) }}" alt="{{ $product->product_name }}" style="object-fit: fill; width: 100%; height: 100%;">
                </div>
            </div>
            <div class="col-md-6">
                <h2 class="product-title">Carropts</h2>
                <p class="text-muted">SKU: BUYANI</p>

                <p><strong>Price:</strong> <span class="product-price">$4.99</span></p>
                <p><strong>Condition:</strong> New</p>
                <p><strong>Availability:</strong> Ships from warehouse</p>

                <div class="border p-3 rounded">

                    <label for="quantity" class="form-label">Quantity:</label>
                    <input type="number" id="quantity" class="form-control form-control-sm mb-3" value="1" min="1">

                    <button class="btn btn-primary w-100">Add to Cart</button>
                    <button class="btn btn-secondary w-100 mt-2">Add to Wish List</button>
                </div>

                <div class="mt-4">
                    <p><strong>Product Features:</strong></p>
                    <ul>
                        <li>Rich in Vitamin A for good vision and immune health</li>
                        <li>High in fiber which supports digestive health</li>
                        <li>Low in calories making them a great option for a healthy snack</li>
                    </ul>
                </div>
            </div>
        </div>

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
    </section> --}}
