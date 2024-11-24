<nav class="navbar navbar-expand-lg bg-light border sticky-top py-2">
    <div class="container-fluid">
        <!-- Branding -->
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="{{ asset('img/logo1.svg') }}" alt="logo1" class="me-2" height="40">
            <img src="{{ asset('img/logo2.svg') }}" alt="logo2" class="me-2" height="30">
        </a>

        <!-- Toggler for mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar content -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 hide-in-full-view">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a class="nav-link @if(request()->is('admin/dashboard')) active @endif" href="/admin/dashboard">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </li>

                <!-- Orders -->
                <li class="nav-item">
                    <a class="nav-link @if(request()->is('admin/order')) active @endif" href="/admin/order">
                        <i class="fas fa-file"></i> Orders
                    </a>
                </li>

                <!-- Products Dropdown -->
                @if(auth()->guard('admin')->user()->admin_type == 1)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle @if(request()->is('admin/product') || request()->is('admin/product/*')) active @endif" href="#" id="productsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-shopping-cart"></i> Products
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item @if(request()->is('admin/product')) active @endif" href="/admin/product">Product List</a></li>
                        <li><a class="dropdown-item @if(request()->is('admin/product/specification')) active @endif" href="/admin/product/specification">Product Specifications</a></li>
                        <li><a class="dropdown-item @if(request()->is('admin/product/inventory')) active @endif" href="/admin/product/inventory">Inventory</a></li>
                    </ul>
                </li>

                <!-- Categories Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle @if(request()->is('admin/category') || request()->is('admin/subcategory')) active @endif" href="#" id="categoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-layer-group"></i> Categories
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item @if(request()->is('admin/category')) active @endif" href="/admin/category">Main Categories</a></li>
                        <li><a class="dropdown-item @if(request()->is('admin/subcategory')) active @endif" href="/admin/subcategory">Subcategories</a></li>
                    </ul>
                </li>
                @endif

                <!-- Community Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="communityDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-users"></i> Community
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Reviews</a></li>
                        <li><a class="dropdown-item" href="#">Blogs</a></li>
                        <li><a class="dropdown-item" href="#">Votes</a></li>
                    </ul>
                </li>

                <!-- Reports -->
                <li class="nav-item">
                    <a class="nav-link @if(request()->is('admin/report')) active @endif" href="/admin/report">
                        <i class="fas fa-chart-bar"></i> Reports
                    </a>
                </li>
            </ul>

            <!-- User Profile Dropdown -->
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('img/user.svg') }}" alt="user" class="rounded-circle me-2" width="30">
                        {{ auth()->guard('admin')->user()->username }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Edit Profile</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.logout') }}">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
