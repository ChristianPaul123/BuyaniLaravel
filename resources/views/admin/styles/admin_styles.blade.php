<style>

    :root {
        --primary-color: rgb(0, 123, 230); /* Custom font content color */
        --sidebar-bg-color: #f4f9f4; /* Light green */
        --sidebar-border-color: rgba(0, 0, 0, 0.1); /* Border color */
        --dropdown-bg-hover: #e9ecef; /* Light gray hover */
        --dropdown-bg-active: #c58e0ee0; /* Orange */
        --dropdown-text-hover: #0e3c04; /* Hover text color */
        --dropdown-text-active: #000000; /* Active text color */
        --nav-text-color: #333; /* Neutral text color */
        --nav-text-active: #2d6a4f; /* Active link color */
        --nav-hover-bg-color: #d9f1d9; /* Hover background color */
        --navbar-bg-color: #ffffff; /* Navbar background color */
        --navbar-hover-color: #f39c12; /* Navbar hover color */
    }
    /* Full-height body setup */
    html, body {
        height: 100%;
        margin: 0;
        overflow-y: hidden;
    }

    /* Custom fonts and colors */
    .custom-font-content {
        font-family: 'Poppins', sans-serif;
        font-weight: bold;
        color: rgb(0, 123, 230);
    }

    /* Sidebar styles */
    .sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        z-index: 100;
        padding: 10px 0 0;
        background-color: #f4f9f4; /* Light green for a farmer-friendly theme */
        box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
        border-right: 2px solid rgba(0, 0, 0, 0.1);
    }


    .sidebar-sticky {
        position: relative;
        top: 0;
        height: calc(100vh - 48px);
        overflow-x: hidden;
        overflow-y: auto;
    }

    .sidebar .dropdown-menu {
        position: relative;
        transform: none; /* Disable automatic positioning by Popper.js */
        left: 0; /* Align to parent */
        width: 100%; /* Full width */
        padding: 0.5rem 1rem; /* Adjust padding */
    }

    .sidebar .dropdown-toggle::after {
        margin-left: 0.5rem;
        vertical-align: middle;
        content: "\f078"; /* Font Awesome down arrow */
        font-family: 'Poppins', sans-serif;
        font-weight: 900;
    }

    .sidebar .dropdown-menu .dropdown-item {
        padding: 0.5rem 1rem;
        color: #333;
    }

    .sidebar .dropdown-menu .dropdown-item:hover {
        background-color: #e9ecef; /* Light gray */
        color: #0e3c04;
    }

    .sidebar .dropdown-menu .dropdown-item:active {
        background-color: #c58e0ee0; /* orange */
        color: #000000;
    }

    .sidebar .nav-link {
        font-weight: 500;
        color: #333; /* Neutral text color */
    }

    .sidebar .nav-link.active {
        color: #2d6a4f; /* Active link color */
    }

    .sidebar .nav-link:hover {
        color: #2d6a4f; /* Hover effect - dark green */
        background-color: #d9f1d9; /* Light green hover */
        border-radius: 4px;
    }

    /* Navbar styles */
      /* Navbar styles */
      .navbar {
        z-index: 100;
        background-color: var(--navbar-bg-color);
        border-bottom: 2px solid var(--sidebar-border-color);
      }

    .custom-font-navbar {
        font-family: 'Poppins', sans-serif;
        font-weight: bold;
        font-size: 20px;
        color: #333;
        transition: color 0.3s;
    }

    .custom-font-navbar:hover {
        color: #f39c12; /* Orange hover effect */
        text-decoration: none;
    }

    .dialog-container {
            text-align: center;
            background: #fff;
            border-radius: 10px;
            padding: 20px 40px;
            width: 400px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .dialog-container img {
            width: 80px;
            margin-bottom: 20px;
        }

        .dialog-container h2 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #333;
        }

        .dialog-container p {
            font-size: 0.9rem;
            color: #555;
            margin-bottom: 20px;
        }

        .refresh-button {
            display: inline-block;
            background-color: #1566d6;
            color: #fff;
            font-size: 1rem;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .refresh-button:hover {
            background-color: #104a9e;
        }



    /* Media query for responsiveness */
    @media (min-width: 576px) {
        .sidebar {
            position: -webkit-sticky;
            position: sticky;
        }
    }

    @media (min-width: 765px) {
        .hide-in-full-view {
            display: none !important;
        }
    }
</style>
