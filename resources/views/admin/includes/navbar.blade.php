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
                            <a class="nav-link d-flex justify-content-between @if(request()->is('admin/dashboard')) active @endif" href="/admin/dashboard">
                                <i class="fas fa-home"></i> Dashboard <span>/</span>
                            </a>
                        </li>

                        @if(auth()->guard('admin')->check() && auth()->guard('admin')->user()->admin_type == 1)

                        <hr class="hr hr-blurry" />
                        <!-- Orders -->
                        <li class="nav-item">
                            <a class="nav-link d-flex justify-content-between @if(request()->is('admin/order')) active @endif" href="/admin/order?tab=order-standby">
                                <i class="fas fa-file"></i> Orders <span>/</</span>
                            </a>
                        </li>

                        <hr class="hr hr-blurry" />

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle @if(request()->is('admin/product*')) active @endif" href="#" id="productsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-shopping-cart"></i> Products
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="productsDropdown">
                                <li><a class="dropdown-item @if(request()->is('admin/product')) active @endif" href="/admin/product?tab=products"> <i class="fas fa-tags"></i> Product Management</a></li>
                                <li><a class="dropdown-item @if(request()->is('admin/product/inventory')) active @endif" href="/admin/product/inventory"><i class="fas fa-warehouse"></i> Inventory</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle @if(request()->is('admin/customization*')) active @endif" href="#" id="customizationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-shopping-cart"></i> Customization
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="customizationDropdown">
                                <li><a class="dropdown-item @if(request()->is('admin/customization')) active @endif" href="/admin/customization?tab=settings"> <i class="fas fa-tags"></i> Admin Customization</a></li>
                                <li><a class="dropdown-item @if(request()->is('admin/customization/sponsorimg')) active @endif" href="/admin/customization/sponsorimg"><i class="fas fa-warehouse"></i> Sponsor Images</a></li>
                            </ul>
                        </li>

                        <hr class="hr hr-blurry" />

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle @if(request()->is('admin/community*')) active @endif" href="#" id="communityDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-users"></i> Community
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="communityDropdown">
                                <li><a class="dropdown-item @if(request()->is('admin/community/reviews')) active @endif" href="/admin/community/reviews?tab=productreviews"> <i class="fas fa-star me-2"></i> Reviews</a></li>
                                <li><a class="dropdown-item @if(request()->is('admin/community/blog')) active @endif" href="/admin/community/blog?tab=settings">  <i class="fas fa-blog me-2"></i> Blogs</a></li>
                                <li><a class="dropdown-item @if(request()->is('admin/community/votes')) active @endif" href="/admin/community/votes?tab=managevotes">  <i class="fas fa-poll me-2"></i> Votes</a></li>
                            </ul>
                        </li>

                        <!-- Management -->
                        <li class="nav-item">
                            <a class="nav-link d-flex justify-content-between @if(request()->is('admin/user/management')) active @endif" href="/admin/user/management?tab=consumers">
                                <i class="fas fa-users"></i> Management <span>/</</span>
                            </a>
                        </li>
                        {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
                        @elseif ((auth()->guard('admin')->check() && auth()->guard('admin')->user()->admin_type == 2))

                        <hr class="hr hr-blurry" />

                        <!-- Orders -->
                        <li class="nav-item">
                            <a class="nav-link d-flex justify-content-between @if(request()->is('admin/order')) active @endif" href="/admin/order?tab=order-standby">
                                <i class="fas fa-file"></i> Orders <span>/</</span>
                            </a>
                        </li>

                        <hr class="hr hr-blurry" />


                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle @if(request()->is('admin/community*')) active @endif" href="#" id="communityDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-users"></i> Community
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="communityDropdown">
                                <li><a class="dropdown-item @if(request()->is('admin/community/reviews')) active @endif" href="/admin/community/reviews?tab=productreviews"> <i class="fas fa-star me-2"></i> Reviews</a></li>
                                <li><a class="dropdown-item @if(request()->is('admin/community/blog')) active @endif" href="/admin/community/blog?tab=settings">  <i class="fas fa-blog me-2"></i> Blogs</a></li>
                                <li><a class="dropdown-item @if(request()->is('admin/community/votes')) active @endif" href="/admin/community/votes?tab=managevotes">  <i class="fas fa-poll me-2"></i> Votes</a></li>
                            </ul>
                        </li>


                        <hr class="hr hr-blurry" />

                        <!-- Management -->
                        <li class="nav-item">
                            <a class="nav-link d-flex justify-content-between @if(request()->is('admin/user/management')) active @endif" href="/admin/user/management?tab=consumers">
                                <i class="fas fa-users"></i> Management <span>/</</span>
                            </a>
                        </li>

                {{-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
                        @elseif ((auth()->guard('admin')->check() && auth()->guard('admin')->user()->admin_type == 3))

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle @if(request()->is('admin/community*')) active @endif" href="#" id="communityDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-users"></i> Community
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="communityDropdown">
                                <li><a class="dropdown-item @if(request()->is('admin/community/reviews')) active @endif" href="/admin/community/reviews?tab=productreviews"> <i class="fas fa-star me-2"></i> Reviews</a></li>
                                <li><a class="dropdown-item @if(request()->is('admin/community/blog')) active @endif" href="/admin/community/blog?tab=settings">  <i class="fas fa-blog me-2"></i> Blogs</a></li>
                                <li><a class="dropdown-item @if(request()->is('admin/community/votes')) active @endif" href="/admin/community/votes?tab=managevotes">  <i class="fas fa-poll me-2"></i> Votes</a></li>
                            </ul>
                        </li>
                        @endif
                        <hr class="hr hr-blurry" />

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle @if(request()->is('admin/report*')) active @endif" href="#" id="reportsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-chart-bar"></i> Reports
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="reportsDropdown">
                                <li> <a class="dropdown-item @if(request()->is('admin/report/inventory')) active @endif" href="/admin/report/inventory?tab=current-inventory"> Inventory Reports </a> </li>
                                <li> <a class="dropdown-item @if(request()->is('admin/report/sales')) active @endif" href="/admin/report/sales?tab=product-sales"> Sales Reports </a> </li>
                                <li> <a class="dropdown-item @if(request()->is('admin/report/logs')) active @endif" href="/admin/report/logs"> Logs Reports </a> </li>
                            </ul>
                        </li>

                        <!-- Chats -->
                        <li class="nav-item">
                            <a class="nav-link d-flex justify-content-between @if(request()->is('admin/chat')) active @endif" href="/admin/chat">
                                <i class="fas fa-comments"></i>Chats <span>/</</span>
                            </a>
                        </li>


                            </ul>
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0 align-items-center hide-in-full-view">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="{{ asset('img/logo1.svg') }}" alt="user" class="rounded-circle me-2" width="30">
                                        {{ auth()->guard('admin')->user()->username }}
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="#">Edit Profile</a></li>
                                        <li><a class="dropdown-item" href="{{ route('admin.logout') }}">Logout</a></li>
                                    </ul>
                                </li>
                            </ul>

            <!-- ADD A SMALL CALENDAR HERE-->


            <div class="ms-auto text-end pe-3 d-flex align-items-center">
                <!-- Clock -->
                <i class="fas fa-clock me-2 text-success"></i>
                <span id="realTimeClock" class="fw-bold text-success fs-5 me-4"></span>

                <!-- Calendar -->
                <i class="fas fa-calendar-alt me-2 text-primary"></i>
                <span id="currentDate" class="fw-bold text-primary fs-5"></span>
            </div>

            <div class="logout-div dropdown" style="position: relative; display: inline-block;">
                <i class="bi bi-power dropdown-toggle" id="logoutDropdown"
                   style="font-size: 30px; color: red; font-weight: bold; cursor: pointer;"
                   data-bs-toggle="dropdown" aria-expanded="false"></i>
                <ul class="dropdown-menu" aria-labelledby="logoutDropdown"
                    style="position: absolute; top: 40px; right: 0; min-width: 120px; padding: 5px 0;
                           background-color: white; border: 1px solid #ccc; border-radius: 5px;
                           box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); text-align: center;">
                    <li>
                        <a class="dropdown-item" href="#" onclick="confirmLogout()"
                           style="display: block; padding: 10px; color: black; text-decoration: none; font-size: 14px; font-weight: bold; color: red;">
                           Logout
                        </a>
                    </li>
                </ul>
            </div>


        </div>
    </div>
</nav>
