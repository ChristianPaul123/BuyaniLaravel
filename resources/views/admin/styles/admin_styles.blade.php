<style>
html, body {
        height: 100%;
        margin: 0;
        /* overflow: hidden; */
    }

    .custom-font-content {
        font-family: 'Poppins', sans-serif;
        font-weight: bold;
        color: rgb(0, 123, 230);
    }

    .sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        z-index: 100;
        padding: 48px 0 0;
        box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
    }

    .sidebar-sticky {
        position: relative;
        top: 0;
        height: calc(100vh - 48px);
        padding-top: .5rem;
        overflow-x: hidden;
        overflow-y: auto;
    }

    .sidebar .nav-link {
        font-weight: 500;
        color: #333;
    }

    .sidebar .nav-link.active {
        color: #007bff;
    }

    .sidebar .nav-link:hover {
        color: #007bff;
    }

    @media (min-width: 576px) {
        .sidebar {
            position: -webkit-sticky;
            position: sticky;
        }
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
</style>
