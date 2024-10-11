<!--NAVIGATION BAR-->
{{-- <nav class="navbar navbar-expand-lg bg-body-tertiary border sticky-top py-2">
    <div class="container-fluid py-0">
        <a class="navbar-brand p-0" href="#" data-toggle="modal" data-target="#pendingMessageModal">
            <img class="mx-2" src="../img/logo1.svg" alt="logo" width="80">
            <img class="mx-2" src="../img/logo2.svg" alt="logo" width="130">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                <li class="nav-item mx-2">
                    <a class="nav-link custom-font-navbar" href="#">HOME</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link custom-font-navbar" href="#" data-toggle="modal" data-target="#pendingMessageModal">ABOUT US</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link custom-font-navbar" href="#" data-toggle="modal" data-target="#pendingMessageModal">CONTACTS</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link custom-font-navbar" href="#" data-toggle="modal" data-target="#pendingMessageModal">SHOP</a>
                </li>

            </ul>
        </div>
    </div>
</nav> --}}
{{-- <li class="nav-item">
    <a class="nav-link @if(request()->is('admin/order')) active @endif" href="/admin/order">
        <i class="fas fa-file"></i>
        Orders <span class="sr-only">(current)</span>
    </a>
</li> --}}

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top" style="background-color: #FFFFFF;">
        <div class="container-fluid">
            <a class="nav-link" @if(request()->is('user/consumer')) active @endif href="/user/consumer" data-page="home">
                <img src="{{ asset('img/logo1.svg') }}" style="width: 65px;">
                <img src="{{ asset('img/logo2.svg') }}">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center" style="font-family: 'Poppins', sans-serif; font-size: 20px; font-weight: bold;">
                    <li class="nav-item px-1 py-0">
                        <a class="nav-link" @if(request()->is('user/consumer')) active @endif href="/user/consumer" data-page="home">HOME <span class="sr-only">(current) </span></a>
                    </li>
                    <li class="nav-item px-1">
                        <a class="nav-link" @if(request()->is('user/consumer/about-us')) active @endif href="/user/consumer/about-us" data-page="about">ABOUT US <span class="sr-only">(current) </span></a>
                        {{-- <a class="nav-link" href="consumer-aboutUs.php" data-page="about">ABOUT US </a> --}}
                    </li>
                    <li class="nav-item px-1">
                        <a class="nav-link" @if(request()->is('user/consumer/products')) active @endif href="/user/consumer/products" data-page="shop">SHOP <span class="sr-only">(current) </span></a>
                        {{-- <a class="nav-link" href="consumer-shop.php" data-page="shop">SHOP</a> --}}
                    </li>
                    <li class="nav-item px-1">
                        <a class="nav-link" @if(request()->is('user/consumer/orders')) active @endif href="/user/consumer/orders" data-page="orders">ORDERS <span class="sr-only">(current) </span></a>
                        {{-- <a class="nav-link" href="#" data-page="orders">ORDERS</a> --}}
                    </li>
                    <li class="nav-item px-1">
                        <a class="nav-link" @if(request()->is('user/consumer/contacts')) active @endif href="/user/consumer/contacts" data-page="contacts">CONTACTS <span class="sr-only">(current) </span></a>
                    </li>
                    <li class="nav-item px-1">
                        <a class="nav-link" @if(request()->is('user/consumer/cart')) active @endif href="/user/consumer/cart" data-page="cart">
                            <i class="fas fa-shopping-basket" style="font-size: 25px;"></i> <span class="sr-only">(current) </span></a>
                    </li>
                    <li class="nav-item px-1">
                        <a class="nav-link" @if(request()->is('user/consumer/user-profile')) active @endif href="/user/consumer/user-profile" data-page="profile">
                            <i class="fas fa-user-circle" style="font-size: 25px;"></i> <span class="sr-only">(current) </span></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
