<div>
    @if ($products->count() === 0)
    <div class="d-block-12 m-5"></div>
    @else
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="">Product Catalog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#categoryNav" aria-controls="categoryNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="categoryNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- Loop through categories using Livewire -->
                    @foreach ($categories as $category)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $category->category_name }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <!-- Link to the main category -->
                                <li>
                                    <a class="dropdown-item" href="#" wire:click.prevent="filterByCategory({{ $category->id }})">
                                        All {{ $category->category_name }}
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <!-- Loop through subcategories -->
                                @foreach ($category->subcategories as $subcategory)
                                    <li>
                                        <a class="dropdown-item" href="#" wire:click.prevent="filterBySubcategory({{ $subcategory->id }})">
                                            {{ $subcategory->sub_category_name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>

                <!-- Search Bar -->
                <form class="d-flex" wire:submit.prevent="searchConsumerProduct">
                    <input class="form-control me-2" type="search" wire:model.lazy="searchQuery" placeholder="Search" aria-label="Search" required>
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    @endif

    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
            @if ($message)
                <div class="alert alert-info">
                    {{ $message }}
                </div>
            @endif
        @if ($products->count() === 0)
            <div class="m-3 p-3">
            <h2 class="text-center">Sorry We're Out At the Moment</h2>
            </div>
        @else
            <div class="m-3 p-3">
                <h2 class="text-center">All Products</h2>
            </div>
        @endif
            <main class="row justify-content-center main-content">
                @forelse ($products as $product)
                <div wire:key="{{ $product->id }}" class="col-md-2 m-1">
                    <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-center">
                            <div class="ms-3">
                                <h6 class="mb-0 fs-sm text-center">{{ $product->product_name }}</h6>
                            </div>
                        </div>
                        <img src="{{ asset( "$product->product_pic" ) }}" class="card-img-top" alt="products {{ asset( "$product->product_name" ) }}" />
                        <div class="card-body">
                            <p class="card-text text-truncate">
                                {{ Str::limit($product->product_details, 50) }}
                            </p>
                        </div>
                        <div class="card-footer d-flex">
                            <button class="btn btn-subtle" type="button"><i class="fas fa-heart fa-lg"></i></button>
                            <button class="btn btn-primary w-100 p-0 me-auto fw-bold"
                            wire:click.prevent="viewProduct({{ $product->id }})">View</button>
                            <button class="btn btn-subtle" type="button"><i class="fas fa-share fa-lg"></i></button>
                        </div>
                    </div>
                </div>
                @empty
                <div class="container d-flex justify-content-center align-items-center" style="height: 390px;">
                    <div class="text-center">
                        <img src="{{ asset('img/outOfStock.png') }}" style="width: 35%;">
                        <h3 class="message">We’re currently out of stock, but don’t worry—we’ll have more products available soon! Be sure to check back or subscribe for updates.</h3>
                    </div>
                </div>
                @endforelse
            </main>
        </div>
    </div>



</div>

