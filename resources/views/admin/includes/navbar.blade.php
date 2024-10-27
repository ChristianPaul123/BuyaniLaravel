<!--NAVIGATION BAR-->
<nav class="navbar navbar-expand-lg bg-body-tertiary border sticky-top py-2">
        <div class="container-fluid py-0">
            <a class="navbar-brand p-0">
                <img class="mx-2" src="{{ asset('img/logo1.svg') }}" alt="logo1" width="80">
                <img class="mx-2" src="{{ asset('img/logo2.svg') }}" alt="logo2" width="130">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                    {{-- this --}}
                    <div class="hide-in-full-view">
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
                    </div>

                    <li class="nav-item dropdown mx-4">
                        <a class="nav-link dropdown-toggle" href="#" id="triggerModal" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{-- <img src=" ../" alt="user" height="20"> --}}
                            <img src="{{ asset('img/user.svg') }}" alt="user" height="20">
                        </a>
                        <ul class="dropdown-menu mr-5 position-absolute" aria-labelledby="triggerModal">
                            <li><a class="dropdown-item" href="#">Edit Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.logout') }}">Logout</a></li>
                        </ul>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link custom-font-navbar" href="#" data-toggle="modal" data-target="#pendingMessageModal"> {{ auth()->guard('admin')->user()->username }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
{{-- added it here --}}
    @session('message')
    <div class=" mx-3 my-2 px-3 py-2 alert alert-success">
        <button type="button" class="close  btn btn-success" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ session('message') }}
    </div>
   @endsession
   {{-- if there's errors --}}
    @if ($errors->any())
    <div class="alert alert-danger mx-3 my-2 px-3 py-2">
        <button type="button" class="close btn btn-danger" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

