<section class="min-height">
    <!-- Wishlist Header -->
    <div class="h-100">
        <div class="m-auto h-100 d-flex align-items-center">
            <div class="container">
                <div class="wishlist-header text-center my-4">
                    <i class="fas fa-heart" style="font-size: 3rem; color: #f39c12;"></i>
                    <h1>My Favorites</h1>
                </div>

                @if ($message)
                    <div class="alert alert-info text-center">
                        {{ $message }}
                    </div>
                @endif

                @if ($favorites->isEmpty())
                    <div class="text-center my-4">
                        <p>Your wishlist is empty. Add some products to see them here!</p>
                    </div>
                @else
                    <!-- Wishlist Table -->
                    <div class="wishlist-container">
                        <table class="wishlist-table table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Product Name</th>

                                    <th>Stock Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($favorites as $favorite)
                                    <tr>
                                        <td>
                                            <img src="{{ asset($favorite->product->product_pic) }}" alt="Product"
                                                style="width: 80px; height: 80px; object-fit: cover; margin-right: 10px;">
                                            {{ $favorite->product->product_name }}
                                        </td>
                                        {{-- <td>
                                            <strong>${{ $favorite->product->productSpecification }}</strong>
                                        </td> --}}
                                        <td>
                                            @if ($favorite->product->inventory && $favorite->product->inventory->product_total_stock > 0)
                                                <span class="stock-status text-success">In Stock</span>
                                            @else
                                                <span class="out-of-stock text-danger">Out of Stock</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button wire:click.prevent="viewProduct({{ $favorite->product_id }})"
                                                class="btn btn-sm btn-primary">
                                                View Product
                                            </button>
                                            <button wire:click.prevent="removeFavorite({{ $favorite->id }})"
                                                class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- <div class="main-content-wrapper h-100">
    <div class="h-100">
    <div class="m-auto h-100 d-flex align-items-center">
        <div class="container">
            <!-- Chat Header -->
            <div class="text-center mb-3">
                <h3 class="text-center" style="color: green;">Buy<span style="color: orange;">Ani</span> Support Chat</h3>
            </div>
            @livewire('user.user-chat-system',['chatID' => Auth::guard('user')->user()->id])
        </div>
    </div>
    </div>
</div> --}}