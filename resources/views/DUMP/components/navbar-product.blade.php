<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('user.consumer.product') }}">Product Catalog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#categoryNav" aria-controls="categoryNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="categoryNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- Loop through categories -->
                @foreach ($categories as $category)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ $category->category_name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <!-- Link to the main category -->
                            <li>
                                <a class="dropdown-item" href="{{ route('user.consumer.product.category', ['category' => $category->id]) }}">
                                    All {{ $category->category_name }}
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <!-- Loop through subcategories -->
                            @foreach ($category->subcategories as $subcategory)
                                <li>
                                    <a class="dropdown-item" href="{{ route('user.consumer.product.subcategory', ['subcategory' => $subcategory->id]) }}">
                                        {{ $subcategory->sub_category_name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>

            <!-- Search Bar -->
            <form class="d-flex" method="GET" action="{{ route('user.consumer.product.search') }}" onsubmit="return validateSearchInput()">
                <input class="form-control me-2" type="search" name="query" placeholder="Search" aria-label="Search" required>
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            <script>
                function validateSearchInput() {
                    var input = document.querySelector('input[name="query"]');
                    if (input.value.length < 4) {
                        alert('Please enter at least 4 characters.');
                        return false;
                    }
                    return true;
                }
            </script>
        </div>
    </div>
</nav>

