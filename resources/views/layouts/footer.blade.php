{{-- <!--FOOTER-->
<footer class="footer p-0">
    <div class="container-fluid py-4 text-center" style="background-color: #181C1F;">
        <p class="mb-0">Interested in working with us? Drop us a line!</p>
        <a href="mailto:buyani@gmail.com" class="text-white">buyani@gmail.com</a>
    </div>
    <div class="container-fluid py-4" style="background-color: #4A5156;">
        <div class="row">
            <div class="col-md-2 offset-md-2 mb-3 mb-md-0 text-start">
                <h4 class="m-0">Albay</h4>
                <p class="m-0">1234 Sunset Boulevard</p>
                <p class="m-0">Philippines</p>
                <p class="m-0">Legazpi City</p>
            </div>
            <div class="col-md-4 offset-md-1 mb-3 mb-md-0 text-start">
                <h4 class="m-0">Bicol University Main Campus</h4>
                <p class="m-0">Rizal Street, Barangay 1</p>
                <p class="m-0">Legazpi City, Albay 4500</p>
                <p class="m-0">Philippines</p>
            </div>
            <div class="col-md-2 mb-3 mb-md-0 text-start">
                <h4 class="m-0">Careers</h4>
                <p class="m-0"><a href="mailto:buyanijobs@gmail.com" class="text-white">buyanijobs@gmail.com</a></p>
            </div>
        </div>
    </div>
</footer> --}}


<style>
    .footer-container {
        margin: 0;
        font-family: 'Roboto', sans-serif;
    }

    .custom-footer {
        background-color: #5F8D4E; /* #69A543 is the color of the logo */
        color: white;
        padding: 2rem 1rem;
    }

    .footer-title {
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .footer-logo {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1.5rem;
        font-weight: bold;
    }

    .footer-logo img {
        height: 40px;
        width: auto;
    }

    .footer-description {
        margin-bottom: 1.5rem;
        font-size: 0.9rem;
        line-height: 1.6;
    }

    .footer-links a {
        color: white;
        text-decoration: none;
        font-size: 0.95rem;
    }

    .footer-links a:hover {
        text-decoration: underline;
    }

    .social-icons a {
        margin-right: 0.5rem;
        font-size: 1.5rem;
        color: white;
        text-decoration: none;
    }

    .social-icons a:hover {
        color: #FFD700; /* Gold hover effect */
    }

    .footer-bottom {
        padding: 30px;
        background-color: #355937; /* Darker green */
        display: flex; /* Enables Flexbox */
        justify-content: center; /* Centers content horizontally */
        align-items: center; /* Centers content vertically */
        font-size: 1rem;
        text-align: center; /* Ensures multiline text is centered horizontally */
    }
</style>

<div class="footer-container">
    <footer class="custom-footer">
        <div class="container">
            <div class="row">
                <!-- Logo and Description -->
                <div class="col-md-4">
                    <div class="footer-logo">
                        <img src="{{ asset('img/logo1.svg') }}" alt="Logo">
                        <span>Buyani</span>
                    </div>
                    <p class="footer-description">
                        The Philippines' fastest-growing, impact-driven agri-tech platform empowering smallholder farmers and sellers across the albay region.
                    </p>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>

                <!-- Shop Links -->
                <div class="col-md-2 footer-links">
                    <h5 class="footer-title">Shop</h5>
                    <a href="#">Spices</a><br>
                    <a href="#">Vegetables</a><br>
                    <a href="#">Fruits</a><br>
                    <a href="#">Leafy Green</a>
                </div>

                <!-- About Mayani -->
                <div class="col-md-3 footer-links">
                    <h5 class="footer-title">About Bayani</h5>
                    <a href="#">About Us</a><br>
                    <a href="#">Meet the Team</a><br>
                    <a href="#">Partner with Us</a><br>
                    <a href="#">Become a Reseller</a><br>
                    <a href="#">News and Events</a>
                </div>

                <!-- Contact -->
                <div class="col-md-3 footer-links">
                    <h5 class="footer-title">Contact</h5>
                    <a href="#">Contact Us</a><br>
                    <a href="#">Viber</a><br>
                </div>
            </div>
        </div>

    </footer>

    <!-- Footer Bottom Section -->
    <div class="footer-bottom">
        <a href="#" class="text-light">Return & Refund Policy</a> |
        Copyright © 2024 buyanicommerce.ph All Rights Reserved.
    </div>
</div>
