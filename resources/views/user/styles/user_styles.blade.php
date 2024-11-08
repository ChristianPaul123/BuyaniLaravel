<style>
    html, body {
        height: 100%;
        margin: 0;
        overflow-x: hidden;
        display: flex;
        flex-direction: column;
        font-family: 'Poppins', sans-serif; /* Prevent horizontal scrollbar */
    }

    .wrapper {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    main {
        flex: 1;
    }


    .footer {
        flex-direction: column;
        background: #343a40;
        color: #fff;
        padding: 20px 0;
    }

    section {
        font-family: 'Poppins', sans-serif;
    }

    /* Main wrapper to grow and push footer down */
    .main-content-wrapper {
    flex: 1;
    }

    /* Container-top border */
    .custom-border-top {
        color: white;
        background-color: #9db19a;
        border-radius: 30px 30px 0px 0px;
        border-style: solid;
        border-color: black;
        border-width: 3px 3px 0px 3px;
    }
    .custom-border-bottom {
        color: black;
        background-color: #FFFFFF;
        border-radius: 0px 0px 30px 30px;
        border: solid black;
    }


    /* Weather */
    #weather i {
        font-size: 50px;
        margin-bottom: 10px;
    }
    #temperature {
        font-size: 20px;
        color: #333;
    }
    .sunny {
        color: orange;
    }
    .rainy {
        color: blue;
    }
    .cloudy {
        color: gray;
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
    .navbar .nav-link:hover {
        color: orange;
    }
    .navbar .nav-link.active {
        color: orange;
        border-radius: 7px;
    }
</style>
