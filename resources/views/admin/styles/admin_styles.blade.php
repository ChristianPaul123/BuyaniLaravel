<style>

    :root {
        --primary-color: #228B22; /* Green */
        --secondary-color: #FFA500; /* Orange */
        --bg-color: #f4f9f4; /* Light green */
        --hover-bg-color: #e8f5e8; /* Slightly darker green */
        --active-color: #228B22; /* Stronger green */
        --text-color: #333; /* Dark text */
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
        /* color: rgb(0, 123, 230); */
    }


    .sidebar {
        background-color: var(--bg-color);
        border-right: 1px solid rgba(0, 0, 0, 0.1);
    }

    .nav-link {
        color: var(--text-color);
        font-weight: 500;
        transition: all 0.3s;
    }

    .nav-link.active {
        color: var(--primary-color);
        background-color: var(--hover-bg-color);
        border-radius: 5px;
    }

    .nav-link:hover {
        background-color: var(--hover-bg-color);
        color: var(--primary-color);
    }

    .nav-item.dropdown .dropdown-toggle {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .dropdown-menu {
        padding-left: 20px;
        background-color: var(--bg-color);
    }

    .dropdown-item:hover {
        background-color: var(--hover-bg-color);
        color: var(--primary-color);
    }

    .admin-info img {
        border: 2px solid var(--primary-color);
        padding: 5px;
        border-radius: 50%;
    }


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

    /* this is for the tabs design things */
    .tab-pane {
        margin-top: 20px;
    }

    .nav-tabs .nav-link.active {
        color: #28a745 !important; /* Green color */
        font-weight: bold; /* Optional: Make the active tab text bold */
    }

    /* Optional: Add a green underline to the active tab */
    .nav-tabs .nav-link.active {
        border-bottom: 2px solid #28a745;
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

    @keyframes fadeInDown {
        from {
            transform: translate(-50%, -55%);
            opacity: 0;
        }
        to {
            transform: translate(-50%, -50%);
            opacity: 1;
        }
    }

    @keyframes fadeOutUp {
        from {
            transform: translate(-50%, -50%);
            opacity: 1;
        }
        to {
            transform: translate(-50%, -55%);
            opacity: 0;
        }
    }

    .notif {
        background-color: #fff8dd;
        border: 3px solid black;
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
        max-width: 50rem;
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

    .dropdown-menu{
        margin-left:-100px;
    }

    @media (max-width: 768px) {
        .dropdown-menu{
            margin-left: 0;
        }
    }


</style>
