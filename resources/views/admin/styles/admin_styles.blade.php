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

    /* Main section adjustments */
    .main-section {
        max-height: 41rem;
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
        padding: 48px 0 0;
        background-color: #f4f9f4; /* Light green for a farmer-friendly theme */
        box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
        border-right: 2px solid rgba(0, 0, 0, 0.1);
    }

    .sidebar-sticky {
        position: relative;
        top: 0;
        height: calc(100vh - 48px);
        padding-top: .5rem;
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
    .navbar {
        z-index: 100;
        background-color: #fff; /* White navbar for contrast */
        border-bottom: 2px solid rgba(0, 0, 0, 0.1);
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
