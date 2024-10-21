<style>
    html, body {
        height: 100%;
        margin: 0;
        overflow-x: hidden; /* Prevent horizontal scrollbar */
    }

    .notification-circle {
        display: inline-block;
        width: 15px;
        height: 15px;
        border-radius: 50%;
        background-color: red;
        position: absolute;
        top: 0px;
        right: -5px;
        margin-left: 5px;
    }

        .navbar-category {
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 1000;
        background-color: #f8f9fa;
        border-bottom: 1px solid #ddd;
    }
    .navbar-nav-category .nav-link-category {
        color: #333;
    }
    .navbar-nav-category .nav-link-category.active {
        font-weight: bold;
    }

    .custom-font-content {
        font-family: 'Poppins', sans-serif;
        font-weight: bold;
        color: aliceblue;
    }

    .hero-section {
        font-family: 'Poppins', sans-serif;
        background: #f8f9fa;
        padding: 60px 0;
    }
    .feature-icon {
        font-size: 2rem;
    }

    .custom-font-navbar {
        font-family: 'Poppins', sans-serif;
        font-weight: bold;
        font-size: 20px;
        color: #333;
        transition: color 0.3s;
    }

    .custom-font-navbar:hover {
        color: #f39c12;
        text-decoration: none;
    }

    .login-card {
            background-color: #3F6F23;
            color: #fff;
            padding: 20px;
        }

    .form-control:focus {
        box-shadow: none;
    }

    .navbar {
            border: 2px solid black;
    }
    .navbar-nav .nav-link:hover {
        color: #F39634;
    }
    .nav-link.active {
        background-color: orange;
        color: #FFFFFF;
        border-radius: 7px;
        padding: 0.5rem 1rem;
    }
</style>
