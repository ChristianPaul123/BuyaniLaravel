 <!-- Navbar -->
 <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" style="background-color: #FFFFFF;">
     <!--Logo section-->
     <div class="container-fluid">
         <a class="navbar-brand" href="farmer-home.php">
             <img src="{{ asset('img/logo1.svg') }}" style="width: 65px;">
             <img src="{{ asset('img/logo2.svg') }}">
         </a>

         <!--Navbar toggle button-->
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
             aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
         </button>

         <!-- Navbar Links -->
         <div class="collapse navbar-collapse" id="navbarNav">
             <ul class="navbar-nav ms-auto align-items-center"
                 style="font-family: 'Poppins', sans-serif; font-size: 20px; font-weight: bold;">
                 <li class="nav-item px-1 py-0 position-relative">
                     <a class="nav-link @if (request()->is('user/farmer')) active @endif" href="/user/farmer"
                         data-page="home">HOME</a>
                 </li>
                 @if (Auth::guard('user')->check())
                     {{-- if the user is not verified, this won't show --}}
                     @php
                         $firstForm = Auth::guard('user')->user()->farmerForms->first();
                     @endphp


                     @if ($firstForm && $firstForm->id_verified == 1 && $firstForm->form_verified == 1)
                         <li class="nav-item px-1 position-relative">
                             <a class="nav-link @if (request()->is('user/farmer/supply-products')) active @endif"
                                 href="/user/farmer/supply-products" data-page="supply-products">SUPPLY PRODUCTS</a>
                         </li>
                     @else
                         <li class="nav-item px-1 position-relative">
                             <a class="nav-link" href="javascript:void(0);" onclick="showVerificationModal()">
                                 SUPPLY PRODUCTS
                             </a>
                         </li>
                     @endif
                     <li class="nav-item px-1 position-relative">
                         <a class="nav-link @if (request()->is('user/farmer/blogs')) active @endif" href="/user/farmer/blogs"
                             data-page="blogs">BLOGS</a>
                     </li>
                 @else
                 @endif
                 <li class="nav-item px-1 position-relative">
                     <a class="nav-link @if (request()->is('user/farmer/about-us')) active @endif" href="/user/farmer/about-us"
                         data-page="about-us">ABOUT US </a>
                 </li>
                 <li class="nav-item px-1 position-relative">
                     <a class="nav-link @if (request()->is('user/farmer/contacts')) active @endif" href="/user/farmer/contacts"
                         data-page="contact">CONTACT </a>
                 </li>
                 <li class="nav-item px-1 position-relative">
                     <a class="nav-link" href="/user/farmer/chat" data-page="chat">
                         <i class="fas fa-comment-dots" style="font-size: 25px;"></i>
                     </a>
                 </li>

                 @auth('user')
                     <li class="nav-item dropdown px-1 position-relative">
                         <a class="nav-link dropdown-toggle" href="#" id="navbarProfile" role="button"
                             data-bs-toggle="dropdown" aria-expanded="false">
                             @if (auth()->guard('user')->user()->profile_pic == null)
                                 <i class="fas fa-user-circle" style="font-size: 25px;"></i>
                             @else
                                 <img src="{{ auth()->guard('user')->user()->profile_pic ? asset(auth()->guard('user')->user()->profile_pic) : asset('img/logo1.svg') }}"
                                     alt="Profile Image" class="rounded-circle"
                                     style="width: 30px; height: 30px; margin-right: 8px;">
                             @endif
                         </a>


                         <ul class="dropdown-menu dropdown-menu-end border-0" aria-labelledby="navbarProfile">
                             <li class="dropdown-header text-center fw-bold">User Profile</li>
                             <li class="text-center my-2">
                                 <img src="{{ auth()->guard('user')->user()->profile_pic ? asset(auth()->guard('user')->user()->profile_pic) : asset('img/logo1.svg') }}"
                                     alt="Profile Image" class="rounded-circle"
                                     style="width: 50px; height: 50px; object-fit: cover;">
                             </li>
                             <li>
                                 <p class="dropdown-item text-muted text-center mb-0">
                                     {{ auth()->guard('user')->user()->username }}
                                 </p>
                             </li>

                             <!-- Divider Line -->
                             <li>
                                 <hr class="dropdown-divider">
                             </li>
                             <li><a class="dropdown-item" href="/user/farmer/profile">Show Profile</a></li>
                             <li>
                                 <form method="POST" action="{{ route('user.logout') }}" class="dropdown-item p-0 m-0">
                                     @csrf
                                     <button type="submit"
                                         class="btn btn-link text-decoration-none text-dark w-100 text-start">
                                         Logout
                                     </button>
                                 </form>
                             </li>
                         </ul>
                     </li>
                 @else
                     <li class="nav-item px-1 position-relative">
                         <a class="nav-link" @if (request()->is('user/farmer/login')) active @endif href="/"
                             data-page="login">LOGIN/SIGNUP<span class="sr-only">(current) </span></a>
                     </li>
                     {{-- <li class="nav-item px-1 position-relative">
                        <a class="nav-link" @if (request()->is('user/farmer/register')) active @endif href="/" data-page="register">REGISTER <span class="sr-only">(current) </span></a>
                    </li> --}}
                 @endauth
             </ul>
         </div>
     </div>
 </nav>
