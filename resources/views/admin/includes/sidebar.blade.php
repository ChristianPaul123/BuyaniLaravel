<nav class="col-sm-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column text-nowrap">
            <!-- Dashboard -->
            <li class="nav-item">
                <a class="nav-link @if(request()->is('admin/dashboard')) active @endif" href="/admin/dashboard">
                    <i class="fas fa-home"></i> Dashboard
                </a>
            </li>

            <hr class="hr hr-blurry" />

            <!-- Orders -->
            <li class="nav-item">
                <a class="nav-link @if(request()->is('admin/order')) active @endif" href="/admin/order">
                    <i class="fas fa-file"></i> Orders
                </a>
            </li>

            <hr class="hr hr-blurry" />

            <!-- Products Dropdown -->
            @if(auth()->guard('admin')->user()->admin_type == 1)
            <li class="nav-item">
                <a class="nav-link dropdown-toggle" href="#" id="productsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-shopping-cart"></i> Products
                </a>
                <ul class="dropdown-menu" aria-labelledby="productsDropdown">
                    <li><a class="dropdown-item @if(request()->is('admin/product')) active @endif" href="/admin/product">Product List</a></li>
                    <li><a class="dropdown-item @if(request()->is('admin/product/specification')) active @endif" href="/admin/product/specification">Product Specifications</a></li>
                    <li><a class="dropdown-item @if(request()->is('admin/product/inventory')) active @endif" href="/admin/product/inventory">Inventory</a></li>
                </ul>
            </li>

            <!-- Categories Dropdown -->
            <li class="nav-item">
                <a class="nav-link dropdown-toggle" href="#" id="categoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-layer-group"></i> Categories
                </a>
                <ul class="dropdown-menu" aria-labelledby="categoriesDropdown">
                    <li><a class="dropdown-item @if(request()->is('admin/category')) active @endif" href="/admin/category">Main Categories</a></li>
                    <li><a class="dropdown-item @if(request()->is('admin/subcategory')) active @endif" href="/admin/subcategory">Subcategories</a></li>
                </ul>
            </li>
            @endif

            <hr class="hr hr-blurry" />

            <!-- Customization -->
            <li class="nav-item">
                <a class="nav-link @if(request()->is('admin/customization')) active @endif" href="/admin/customization">
                    <i class="fas fa-users"></i> Customization
                </a>
            </li>

            <hr class="hr hr-blurry" />

            <!-- Blogs -->
            <li class="nav-item">
                <a class="nav-link @if(request()->is('admin/blog')) active @endif" href="/admin/blog">
                    <i class="fas fa-blog"></i> Blogs
                </a>
            </li>

            <hr class="hr hr-blurry" />

            <!-- Reports -->
            <li class="nav-item">
                <a class="nav-link @if(request()->is('admin/report')) active @endif" href="/admin/report">
                    <i class="fas fa-chart-bar"></i> Reports
                </a>
            </li>

            <!-- Chats -->
            <li class="nav-item">
                <a class="nav-link @if(request()->is('admin/message')) active @endif" href="/admin/message">
                    <i class="fas fa-comments"></i> Chats
                </a>
            </li>

            <!-- Management -->
            <li class="nav-item">
                <a class="nav-link @if(request()->is('admin/management')) active @endif" href="/admin/management">
                    <i class="fas fa-cogs"></i> Management
                </a>
            </li>
        </ul>
    </div>
</nav>
