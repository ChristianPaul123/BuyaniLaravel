<div>
    @if ($categories->count() === 0)
    <div class="d-block-12 m-5"></div>
    @else
        <div class="row container my-4">
            <nav class="navbar navbar-expand-lg navbar-light bg-light rounded shadow-sm px-3 py-2">
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
                    <div class="d-flex gap-3">
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
                        <input class="form-control me-2" type="search" wire:model.lazy="searchQuery" placeholder="Search" required>
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </nav>
        </div>
        @endif

        <div class="container-fluid">
            <div class="row justify-content-center align-items-center">
                @if ($message)
                    <div class="alert alert-info text-center w-75 mx-auto my-3">
                        {{ $message }}
                    </div>
                @endif

                <div class="container my-4">
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
                                <div class="col-md-3">
                                    <div class="card shadow-sm border-0 rounded">
                                        <div class="card-img-top-wrapper position-relative">
                                            <img src="{{ asset($product->product_pic) }}" class="card-img-top rounded-top" alt="{{ $product->product_name }}">
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title text-center text-truncate fw-bold">{{ $product->product_name }}</h5>
                                            <p class="card-text text-muted text-center text-truncate mb-3">{{ Str::limit($product->product_details, 50) }}</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <button class="btn btn-sm btn-outline-primary" wire:click.prevent="viewProduct({{ $product->id }})">
                                                    View
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger {{ in_array($product->id, $userFavorites) ? 'active' : '' }}" wire:click.prevent="toggleFavorite({{ $product->id }})">
                                                    <i class="fas fa-heart"></i>
                                                </button>
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
