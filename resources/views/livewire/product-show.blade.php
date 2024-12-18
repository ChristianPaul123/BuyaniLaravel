<div>
    @if ($categories->count() === 0)
        <div class="d-block-12 m-5"></div>
    @else
        <div class="row container my-4">
            <nav class="navbar navbar-expand-lg navbar-light bg-light rounded shadow-sm px-3 py-2 w-100">
                <div class="container-fluid">
                    <!-- Product Catalog Title -->
                    <a class="navbar-brand fw-bold fs-4" href="#">Product Catalog</a>

                    <!-- Previous Button -->
                    <button class="btn btn-outline-primary me-3"
                            type="button"
                            wire:click.prevent="previousChunk"
                            {{ $currentChunkIndex === 0 ? 'disabled' : '' }}>
                        <i class="fas fa-chevron-left"></i>
                    </button>

                    <!-- Category Dropdowns -->
                    <div class="d-flex gap-3 flex-wrap">
                        @foreach ($categoriesChunked[$currentChunkIndex] as $category)
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle"
                                        type="button"
                                        id="categoryDropdown{{ $category->id }}"
                                        data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                    {{ $category->category_name }}
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="categoryDropdown{{ $category->id }}">
                                    <li>
                                        <a class="dropdown-item" href="#" wire:click.prevent="filterByCategory({{ $category->id }})">
                                            All {{ $category->category_name }}
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    @foreach ($category->subcategories as $subcategory)
                                        <li>
                                            <a class="dropdown-item" href="#" wire:click.prevent="filterBySubcategory({{ $subcategory->id }})">
                                                {{ $subcategory->sub_category_name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>

                    <!-- Next Button -->
                    <button class="btn btn-outline-primary ms-3"
                            type="button"
                            wire:click.prevent="nextChunk"
                            {{ $currentChunkIndex === count($categoriesChunked) - 1 ? 'disabled' : '' }}>
                        <i class="fas fa-chevron-right"></i>
                    </button>

                    <!-- Search Bar -->
                    <form class="d-flex ms-auto" wire:submit.prevent="searchConsumerProduct">
                        <input class="form-control me-2" type="search" id="searchQuery" wire:model.lazy="searchQuery" placeholder="Search" required>
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </nav>
        </div>
    @endif

    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
            @if ($message)
                <div>
                    <!-- Overlay and Error Popup HTML -->
                    <div class="overlay" id="overlay" aria-label="Close" onclick="closePopup()"></div>

                    <div class="error-popup">
                        <i class="bi bi-x-lg fs-4" aria-label="Close" onclick="closePopup()"></i>
                        <div class="error-icon">
                            <i class="icon bi bi-bag-x"></i>
                        </div>
                        <div class="container-contents">
                            <h3>Ooops!</h3>
                            <p>{{ $message }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="container my-4 min-vh-100">
                @if ($products->count() === 0)
                    <div class="text-center">
                        <h2 class="my-4 text-muted">Sorry, We're Out At the Moment</h2>
                        <img src="{{ asset('img/outOfStock.png') }}" alt="Out of Stock" class="img-fluid my-3" style="width: 300px;">
                        <p class="text-muted">We’re currently out of stock, but don’t worry—we’ll have more products available soon!</p>
                    </div>
                @else
                    <h2 class="text-center my-4 fw-bold">{{ $title }}</h2>
                    <div class="row g-4">
                        @foreach ($products as $product)
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div wire:click.prevent="viewProduct({{ $product->id }})" class="card shadow-sm border-0 rounded">
                                    <div class="card-img-top-wrapper position-relative">
                                        <img src="{{ asset($product->product_pic) }}" class="card-img-top rounded-top" alt="{{ $product->product_name }}"  style="cursor: pointer;">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title text-center text-truncate fw-bold">{{ $product->product_name }}</h5>
                                        <div class="text-center mb-2">
                                            @php
                                                $averageRating = $product->productRatings()->avg('rating');
                                            @endphp
                                            @if ($averageRating)
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $averageRating ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                                <span class="text-muted">({{ number_format($averageRating, 1) }})</span>
                                            @else
                                                <p class="text-muted">No ratings yet</p>
                                            @endif
                                        </div>

                                        <!-- Display Price Range -->
                                        <div class="text-center mb-3">
                                            @php
                                                $prices = $product->productSpecification()->pluck('product_price');
                                            @endphp
                                            @if ($prices->isNotEmpty())
                                                <p class="mb-0 text-success fw-bold">
                                                    ₱{{ number_format($prices->min(), 2) }} ~ ₱{{ number_format($prices->max(), 2) }}
                                                </p>
                                            @else
                                                <p class="text-info fw-bold">NEW</p>
                                            @endif
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <button class="btn btn-sm btn-outline-primary" wire:click.prevent="viewProduct({{ $product->id }})">
                                                View
                                            </button>

                                            @if(Auth::guard('user')->check()) <!-- Check if the user is logged in -->
                                                <button class="btn btn-sm btn-outline-danger {{ in_array($product->id, $userFavorites) ? 'active' : '' }}"
                                                        wire:click.prevent="toggleFavorite({{ $product->id }})">
                                                    <i class="fas fa-heart"></i>
                                                </button>
                                            @else
                                                <button class="btn btn-sm btn-outline-secondary disabled" disabled>
                                                    <i class="fas fa-heart"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4 d-flex justify-content-center">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@script
<script>
    // document.addEventListener('clear-input', () => {
    //     console.log('Input cleared');
    //     const searchForm = document.getElementById('searchForm');
    //     const searchInput = searchForm.querySelector('#searchQuery');
    //     searchInput.value = ''; // Clear the input value
    // });
</script>
@endscript
