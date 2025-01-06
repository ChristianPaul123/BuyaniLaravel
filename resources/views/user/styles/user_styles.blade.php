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

    .notif {
        background-color: #fff8dd;
        border: 3px solid #d97a18;
        border-radius: 10px;
        position: fixed;
        top: 15%;
        left: 50%;
        transform: translateX(-50%);
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        animation: fadeInDown 0.15s ease-out forwards; /* Faster appearance */
        font-weight: bold;
        color: #d97a18;
        overflow: hidden;
        display: none; /* Default hidden */
    }

    .notif.hidden {
        animation: fadeOutUp 0.15s ease-in forwards; /* Faster disappearance */
    }

    .container-right {
        padding: 15px;
    }

    .notif i:nth-of-type(1) {
        z-index: 2;
        background-color: #d97a18;
        color: #fff8dd;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 50px;
        flex-shrink: 0;
        font-size: 30px;
    }

    /* Success notification style */
    .notif.success {
        background-color: #e8f8e5;
        border: 3px solid #28a745;
        color: #28a745;
    }

    .notif.success i {
        background-color: #28a745;
        color: #e8f8e5;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 50px;
        flex-shrink: 0;
        font-size: 30px;
        border-radius: 50%;
    }

    /* Error notification style */
    .notif.error {
        background-color: #fde8e8;
        border: 3px solid #dc3545;
        color: #dc3545;
    }

    .notif.error i {
        background-color: #dc3545;
        color: #fde8e8;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 50px;
        flex-shrink: 0;
        font-size: 30px;
        border-radius: 50%;
    }
</style>
