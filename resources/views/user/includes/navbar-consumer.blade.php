<nav class="navbar navbar-expand-xl navbar-light bg-light fixed-top" style="background-color: #FFFFFF;">
    <div class="container-fluid">
        <!-- Logo Section -->
        <a class="nav-link @if(request()->is('user/consumer')) active @endif" href="/user/consumer" data-page="home">
            <img src="{{ asset('img/logo1.svg') }}" style="width: 65px;">
            <img src="{{ asset('img/logo2.svg') }}">
        </a>

        <!-- Toggler Button for Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center" style="font-family: 'Poppins', sans-serif; font-size: 20px; font-weight: bold;">
                <!-- Standard Links -->
                <li class="nav-item px-1">
                    <a class="nav-link @if(request()->is('user/consumer')) active @endif" href="/user/consumer" data-page="home">HOME</a>
                </li>
                <li class="nav-item px-1">
                    <a class="nav-link @if(request()->is('user/consumer/about-us')) active @endif" href="/user/consumer/about-us" data-page="about">ABOUT US</a>
                </li>
                <li class="nav-item px-1">
                    <a class="nav-link @if(request()->is('user/consumer/products')) active @endif" href="/user/consumer/products" data-page="shop">SHOP</a>
                </li>
                @if(Auth::guard('user')->check())
                <li class="nav-item px-1">
                    <a class="nav-link @if(request()->is('user/consumer/orders')) active @endif" href="/user/consumer/orders" data-page="orders">ORDERS</a>
                </li>
                <li class="nav-item px-1">
                    <a class="nav-link @if(request()->is('user/consumer/blogs')) active @endif" href="/user/consumer/blogs" data-page="blogs">BLOGS</a>
                </li>
                <li class="nav-item px-1">
                    <a class="nav-link @if(request()->is('user/consumer/voting')) active @endif" href="/user/consumer/voting" data-page="voting">VOTING</a>
                </li>
                @else
                @endif
                <li class="nav-item px-1">
                    <a class="nav-link @if(request()->is('user/consumer/contacts')) active @endif" href="/user/consumer/contacts" data-page="contacts">CONTACTS</a>
                </li>

                <!-- Cart Icon -->
                <li class="nav-item px-1 position-relative">
                    <a class="nav-link @if(request()->is('user/consumer/cart')) active @endif" href="/user/consumer/cart" data-page="cart">
                        <i class="fas fa-shopping-basket" style="font-size: 25px;">@livewire('blocks.navbar-cart-counter')</i>
                    </a>
                </li>

                <!-- Favorites Icon -->
                <li class="nav-item px-1 position-relative">
                    <a class="nav-link @if(request()->is('user/consumer/favorites')) active @endif" href="/user/consumer/favorites" data-page="favorites">
                        <i class="fas fa-heart" style="font-size: 25px;">@livewire('blocks.navbar-favorite-counter')</i>
                    </a>
                </li>


                  <!-- Favorites Icon -->
                <li class="nav-item px-1 position-relative">
                    <a class="nav-link @if(request()->is('user/consumer/chat')) active @endif" href="/user/consumer/chat" data-page="chat">
                        <i class="fas fa-comment-alt" style="font-size: 25px;"></i>

                    </a>
                </li>

                <!-- Profile Dropdown or Login/Register -->
                @auth('user')
                <li class="nav-item dropdown px-1">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarProfile" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @if (auth()->guard('user')->user()->profile_pic == null)
                            <i class="fas fa-user-circle" style="font-size: 25px;"></i>
                            @else
                            <img src="{{ auth()->guard('user')->user()->profile_pic ? asset(auth()->guard('user')->user()->profile_pic) : asset('img/logo1.svg') }}" alt="Profile Image" class="rounded-circle" style="width: 30px; height: 30px; margin-right: 8px;">
                            @endif
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end border-0" aria-labelledby="navbarProfile">
                        <li class="dropdown-header text-center fw-bold">User Profile</li>
                        <li class="text-center my-2">
                            <img src="{{ auth()->guard('user')->user()->profile_pic ? asset(auth()->guard('user')->user()->profile_pic) : asset('img/logo1.svg') }}"
                            alt="Profile Image"
                            class="rounded-circle"
                            style="width: 50px; height: 50px; object-fit: cover;">
                        </li>
                        <li>
                            <p class="dropdown-item text-muted text-center mb-0">
                                {{ auth()->guard('user')->user()->username }}
                            </p>
                        </li>

                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/user/consumer/profile">Show Profile</a></li>
                        <li>
                            <form method="POST" action="{{ route('user.logout') }}" class="dropdown-item p-0 m-0">
                                @csrf
                                <button type="submit" class="btn btn-link text-decoration-none text-dark w-100 text-start">
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
                @else
                <li class="nav-item px-1">
                    <a class="nav-link" @if(request()->is('user/consumer/login')) active @endif href="/" data-page="login">LOGIN/SIGNUP</a>
                </li>
                {{-- <li class="nav-item px-1">
                    <a class="nav-link" @if(request()->is('user/consumer/register')) active @endif href="/" data-page="register">REGISTER</a>
                </li> --}}
                @endauth
            </ul>
        </div>
    </div>
</nav>
