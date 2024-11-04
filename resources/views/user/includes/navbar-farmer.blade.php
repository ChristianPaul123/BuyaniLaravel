 <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top" style="background-color: #FFFFFF;">
        <div class="container-fluid">
            <a class="navbar-brand" href="farmer-home.php">
                <img src="{{ asset('img/logo1.svg') }}" style="width: 65px;">
                <img src="{{ asset('img/logo2.svg') }}">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center" style="font-family: 'Poppins', sans-serif; font-size: 20px; font-weight: bold;">
                    <li class="nav-item px-1 py-0 position-relative">
                        <a class="nav-link @if(request()->is('user/consumer/cart')) active @endif" href="/user/farmer" data-page="home">HOME</a>
                    </li>
                    <li class="nav-item px-1 position-relative">
                        <a class="nav-link @if(request()->is('user/consumer/cart')) active @endif" href="/user/farmer/analytics" data-page="analytics">ANALYTICS </a>
                    </li>
                    <li class="nav-item px-1 position-relative">
                        <a class="nav-link @if(request()->is('user/consumer/cart')) active @endif" href="/user/farmer/products" data-page="s-products">SUPPLY PRODUCTS </a>
                    </li>
                    <li class="nav-item px-1 position-relative">
                        <a class="nav-link @if(request()->is('user/consumer/cart')) active @endif" href="/user/farmer/blogs" data-page="blogs">BLOGS</a>
                    </li>
                    <li class="nav-item px-1 position-relative">
                        <a class="nav-link @if(request()->is('user/consumer/cart')) active @endif"  href="/user/farmer/contact" data-page="contact">CONTACT </a>
                    </li>
                    <li class="nav-item px-1 position-relative">
                        <a class="nav-link @if(request()->is('user/consumer/cart')) active @endif"  href="/user/farmer/about-us" data-page="about-us">ABOUT US </a>
                    </li>
                    <li class="nav-item px-1 position-relative">
                        <a class="nav-link @if(request()->is('user/consumer/cart')) active @endif"  href="/user/farmer/notification" data-page="notification">
                            <i class="fas fa-bell" style="font-size: 25px;"></i>
                        </a>
                    </li>
                    <li class="nav-item px-1 position-relative">
                        <a class="nav-link"  href="/user/farmer/chat" data-page="chat">
                            <i class="fas fa-comment-dots" style="font-size: 25px;"></i>
                        </a>
                    </li>
                    <li class="nav-item px-1 position-relative">
                        <a class="nav-link" href="/user/farmer/profile" data-page="profile">
                            <i class="fas fa-user-circle" style="font-size: 25px;"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    {{-- !--This is for the nav bar consumer--> --}}
    <script>
    document.addEventListener('DOMContentLoaded', (event) => {
                // Get the current page URL
                const currentPage = window.location.pathname.split('/').pop();

                // Find all nav-links
                const navLinks = document.querySelectorAll('.nav-link');

                navLinks.forEach(link => {
                    // Extract the page from the data-page attribute
                    const page = link.getAttribute('data-page');

                    // Check if the link's href matches the current page
                    if (link.getAttribute('href').includes(currentPage) || page === currentPage.replace('.html', '')) {
                        link.classList.add('active');
                    }

                    // Add click event listener to each link
                    link.addEventListener('click', () => {
                        // Remove active class from all links
                        navLinks.forEach(link => link.classList.remove('active'));
                        // Add active class to clicked link
                        link.classList.add('active');
                    });
                });
            });
    </script>
