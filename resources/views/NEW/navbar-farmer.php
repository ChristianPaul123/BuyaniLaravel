<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Bootstrap Navbar</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Poppins font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
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
</head>
<body class="p-0">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top" style="background-color: #FFFFFF;">
        <div class="container-fluid">
            <a class="navbar-brand" href="farmer-home.php">
                <img src="img/logo1.svg" style="width: 65px;">
                <img src="img/logo2.svg">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center" style="font-family: 'Poppins', sans-serif; font-size: 20px; font-weight: bold;">
                    <li class="nav-item px-1 py-0">
                        <a class="nav-link" href="farmer-home.php" data-page="home">HOME</a>
                    </li>
                    <li class="nav-item px-1">
                        <a class="nav-link" href="#" data-page="analytics">MY ANALYTICS</a>
                    </li>
                    <li class="nav-item px-1">
                        <a class="nav-link" href="#" data-page="products">SUPPLY PRODUCTS</a>
                    </li>
                    <li class="nav-item px-1">
                        <a class="nav-link" href="#" data-page="orders">ORDERS</a>
                    </li>
                    <li class="nav-item px-1">
                        <a class="nav-link" href="#" data-page="contacts">CONTACTS</a>
                    </li>
                    <li class="nav-item px-1">
                        <a class="nav-link" href="#" data-page="notification">
                            <i class="bi bi-bell-fill" style="font-size: 25px;"></i>
                        </a>
                    </li>
                    <li class="nav-item px-1">
                        <a class="nav-link" href="#" data-page="chat">
                            <i class="bi bi-chat-dots" style="font-size: 25px;"></i>
                        </a>
                    </li>
                    <li class="nav-item px-1">
                        <a class="nav-link" href="#" data-page="profile">
                            <i class="bi bi-person-circle" style="font-size: 25px;"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Button highlight when clicked -->
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
</body>
</html>
