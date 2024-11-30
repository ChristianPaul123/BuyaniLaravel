<nav class="col-sm-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky min-height">
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
        @if(auth()->guard('admin')->check() && auth()->guard('admin')->user()->admin_type == 1)
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="productsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-shopping-cart"></i> Products
                </a>
                <ul class="dropdown-menu" aria-labelledby="productsDropdown">
                    <li><a class="dropdown-item @if(request()->is('admin/product/specification')) active @endif" href="/admin/product/specification"> <i class="fas fa-tags"></i> Product Specifications</a></li>
                    <li><a class="dropdown-item @if(request()->is('admin/product/inventory')) active @endif" href="/admin/product/inventory"><i class="fas fa-warehouse"></i> Inventory</a></li>
                </ul>
            </li>

            <!-- Customization -->
            <li class="nav-item">
                <a class="nav-link @if(request()->is('admin/customization')) active @endif" href="/admin/customization">
                    <i class="fas fa-users"></i> Customization
                </a>
            </li>



        @else
            <li class="nav-item dropdown" style="opacity: 0.5; pointer-events: none;">
                <a class="nav-link dropdown-toggle" href="#" id="productsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-shopping-cart"></i> Products
                </a>
                <ul class="dropdown-menu" aria-labelledby="productsDropdown">
                    <li><a class="dropdown-item" href="#">Product Specifications</a></li>
                    <li><a class="dropdown-item" href="#">Inventory</a></li>
                </ul>
            </li>
        @endif

            <hr class="hr hr-blurry" />

            <!-- Blogs -->
            <li class="nav-item">
                <a class="nav-link @if(request()->is('admin/blog')) active @endif" href="/admin/blog">
                    <i class="fas fa-blog"></i> Blogs
                </a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="communityDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-users"></i> Community
                </a>
                <ul class="dropdown-menu" aria-labelledby="communityDropdown">
                    <li><a class="dropdown-item" href="#"> <i class="fas fa-star me-2"></i> Reviews</a></li>
                    <li><a class="dropdown-item"  href="/admin/blog">  <i class="fas fa-blog me-2"></i> Blogs</a></li>
                    <li><a class="dropdown-item" href="#">  <i class="fas fa-poll me-2"></i> Votes</a></li>
                </ul>
            </li>


            <hr class="hr hr-blurry" />

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle @if(request()->is('admin/report*')) active @endif" href="#" id="reportsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-chart-bar"></i> Reports
                </a>
                <ul class="dropdown-menu" aria-labelledby="reportsDropdown">
                    <li> <a class="dropdown-item @if(request()->is('admin/report/inventory')) active @endif" href="{{ route('admin.reports.inventory') }}"> Inventory Reports </a> </li>
                    <li> <a class="dropdown-item @if(request()->is('admin/report/sales')) active @endif" href="{{ route('admin.reports.sales') }}"> Sales Reports </a> </li>
                </ul>
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
