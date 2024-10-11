<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Catalog</title>
    @include('layouts.head')
    @include('user.styles.user_styles')
    <style>
        body {
            padding-top: 70px; /* Adjusted for navbar */
        }
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            background-color: #f8f9fa;
            border-bottom: 1px solid #ddd;
        }
        .navbar-nav .nav-link {
            color: #333;
        }
        .navbar-nav .nav-link.active {
            font-weight: bold;
        }
        .product-card img {
            max-width: 100%;
            height: auto;
        }
        .main-content {
            margin: 0 auto;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: start;
        }
        .card-container .col-md-2 {
            margin: 0.5rem;
        }
        .more-container {
            display: none;
            overflow: hidden;
        }
        .more-container.visible {
            display: flex;
            flex-wrap: wrap;
            animation: fadeIn 0.5s ease-out;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .show-more-btn {
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    @include('user.includes.navbar-consumer')

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="beta.php">Product Catalog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#fruits">Fruits</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#vegetables">Vegetables</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#grains">Grains</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#legumes">Legumes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#nuts-seeds">Nuts and Seeds</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#herbs-spices">Herbs and Spices</a>
                    </li>
                </ul>

                <!-- Search Bar -->
                <form class="d-flex" method="GET" action="beta.php">
                    <input class="form-control me-2" type="search" name="query" placeholder="Search" aria-label="Search" required>
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <!-- Main content -->
            <main class="col-md-12 col-lg-10 px-md-4 main-content">


            </main>
        </div>
    </div>

    @include('layouts.footer')
    @include('layouts.script')
    <script>
        function showMore(category) {
            const moreContainer = document.getElementById(category + '-more');
            const button = moreContainer.previousElementSibling;

            if (moreContainer.classList.contains('visible')) {
                moreContainer.classList.remove('visible');
                button.textContent = 'Show More';
            } else {
                moreContainer.classList.add('visible');
                button.textContent = 'Show Less';
            }
        }
    </script>
</body>
</html>
