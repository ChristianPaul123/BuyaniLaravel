<nav class="col-sm-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky min-height">
         <!-- Admin Information Section -->
         @if(auth()->guard('admin')->check())
         @php
             $admin = auth()->guard('admin')->user();
             $adminTypes = [
                 1 => 'Owner',
                 2 => 'Assistant',
                 3 => 'Employee',
             ];
             $adminTypeLabel = $adminTypes[$admin->admin_type] ?? 'Unknown';
             $adminStatusLabel = $admin->status ? 'Active' : 'Inactive';
             $statusBadgeClass = $admin->status ? 'bg-success' : 'bg-danger';
         @endphp
         <div class="admin-info text-center py-3 border-bottom">
             <img src="{{ $admin->profile_pic ? asset('storage/' . $admin->profile_pic) : asset('img/logo1.svg') }}"
                  alt="Profile Picture"
                  class="rounded-circle"
                  width="80"
                  height="80">
             <h6 class="mt-2">{{ $admin->username }}</h6>
             <p class="text-muted">{{ $admin->email }}</p>
             <span class="badge bg-primary">{{ $adminTypeLabel }}</span>
             <span class="badge {{ $statusBadgeClass }}">{{ $adminStatusLabel }}</span>
         </div>
        @endif
        <ul class="nav flex-column text-nowrap">
            <!-- Dashboard -->
            <li class="nav-item">
                <a class="nav-link d-flex justify-content-between @if(request()->is('admin/dashboard')) active @endif" href="/admin/dashboard">
                    <i class="fas fa-home"></i> Dashboard <span>/</span>
                </a>
            </li>

            <hr class="hr hr-blurry" />

            <!-- Orders -->
            <li class="nav-item">
                <a class="nav-link d-flex justify-content-between @if(request()->is('admin/order')) active @endif" href="/admin/order">
                    <i class="fas fa-file"></i> Orders <span>/</</span>
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
                <a class="nav-link d-flex justify-content-between @if(request()->is('admin/customization')) active @endif" href="/admin/customization?tab=settings">
                    <i class="fas fa-cogs"></i> Customization <span>/</</span>
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

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="communityDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-users"></i> Community
                </a>
                <ul class="dropdown-menu" aria-labelledby="communityDropdown">
                    <li><a class="dropdown-item" href="/admin/reviews?tab=productreviews"> <i class="fas fa-star me-2"></i> Reviews</a></li>
                    <li><a class="dropdown-item"  href="/admin/blog">  <i class="fas fa-blog me-2"></i> Blogs</a></li>
                    <li><a class="dropdown-item" href="/admin/votes?tab=managevotes">  <i class="fas fa-poll me-2"></i> Votes</a></li>
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
                <a class="nav-link d-flex justify-content-between @if(request()->is('admin/chat')) active @endif" href="/admin/chat">
                    <i class="fas fa-comments"></i>Chats <span>/</</span>
                </a>
            </li>

            <!-- Management -->
            <li class="nav-item">
                <a class="nav-link d-flex justify-content-between @if(request()->is('admin/user/management')) active @endif" href="/admin/user/management">
                    <i class="fas fa-users"></i> Management <span>/</</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
