<!--NAVIGATION BAR-->
<nav class="navbar navbar-expand-lg bg-body-tertiary border sticky-top py-2">
        <div class="container-fluid py-0">
            <a class="navbar-brand p-0" href="#" data-toggle="modal" data-target="#pendingMessageModal">
                <img class="mx-2" src="{{ asset('img/logo1.svg') }}" alt="logo1" width="80">
                <img class="mx-2" src="{{ asset('img/logo2.svg') }}" alt="logo2" width="130">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                    <li class="nav-item dropdown mx-4">
                        <a class="nav-link dropdown-toggle" href="#" id="triggerModal" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{-- <img src=" ../" alt="user" height="20"> --}}
                            <img src="{{ asset('img/user.svg') }}" alt="user" height="20">

                        </a>
                        <ul class="dropdown-menu mr-5" aria-labelledby="triggerModal">
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

