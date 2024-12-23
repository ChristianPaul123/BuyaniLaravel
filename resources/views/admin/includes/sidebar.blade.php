
<nav class="col-sm-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column text-nowrap">
            <li class="nav-item">
                <a class="nav-link @if(request()->is('admin/dashboard')) active @endif" href="/admin/dashboard">
                    <i class="fas fa-home"></i>
                    Dashboard <span class="sr-only">(current)</span>
                </a>
            </li>
            <hr class="hr hr-blurry" />
            <li class="nav-item">
                <a class="nav-link @if(request()->is('admin/order')) active @endif" href="/admin/order">
                    <i class="fas fa-file"></i>
                    Orders <span class="sr-only">(current)</span>
                </a>
            </li>


            @if(auth()->guard('admin')->user()->admin_type == 1)
            <hr class="hr hr-blurry" />
            <li class="nav-item">
               <a class="nav-link @if(request()->is('admin/product')) active @endif" href="/admin/product">
                    <i class="fas fa-shopping-cart"></i>
                    Products
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->is('admin/product/specification')) active @endif" href="/admin/product/specification">
                     <i class="fas fa-shopping-cart"></i>
                     Products Specification
                 </a>
             </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->is('admin/category')) active @endif" href="/admin/category">
                    <i class="fas fa-layer-group"></i>
                    Category
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->is('admin/subcategory')) active @endif" href="/admin/subcategory">
                    <i class="fas fa-layer-group"></i>
                    SubCategory
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->is('admin/product/inventory')) active @endif" href="/admin/product/inventory">
                     <i class="fas fa-shopping-cart"></i>
                     Products Inventory
                 </a>
             </li>
            <hr class="hr hr-blurry" />
            <li class="nav-item">
                <a class="nav-link @if(request()->is('admin/customization')) active @endif" href="/admin/customization">
                    <i class="fas fa-users"></i>
                    Customization
                </a>
            </li>

            @elseif(auth()->guard('admin')->user()->admin_type == 2)
            @endif

            <li class="nav-item">
                <a class="nav-link @if(request()->is('admin/blog')) active @endif" href="/admin/blog">
                     <i class="fas fa-chart-bar"></i>
                     Blogs
                 </a>
             </li>
             <hr class="hr hr-blurry" />
            <li class="nav-item">
               <a class="nav-link @if(request()->is('admin/report')) active @endif" href="/admin/report">
                    <i class="fas fa-chart-bar"></i>
                    Reports
                </a>
            </li>
            <li class="nav-item">
               <a class="nav-link @if(request()->is('admin/message')) active @endif" href="/admin/message">
                    <i class="fas fa-layer-group"></i>
                    Chats
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->is('admin/management')) active @endif" href="/admin/management">
                    <i class="fas fa-layer-group"></i>
                    Management
                </a>
            </li>
        </ul>
    </div>
</nav>
