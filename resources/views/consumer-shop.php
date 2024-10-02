<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Catalog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
    <?php include 'navbar-consumer.php' ?>

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
                <?php
                include 'DATA.php';

                // Function to display product cards
                function display_items($items, $start = 0, $limit = null) {
                    echo '<div class="card-container">';
                    $end = $limit ? min($start + $limit, count($items)) : count($items);
                    for ($i = $start; $i < $end; $i++) {
                        $item = $items[$i];
                        echo '<div class="col-md-2 mb-4">
                                <div class="card product-card">
                                    <img src="' . $item["img"] . '" alt="' . $item["name"] . '" class="card-img-top">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">' . $item["name"] . '</h5>
                                        <p class="card-text">' . $item["price"] . '</p>
                                    </div>
                                </div>
                            </div>';
                    }
                    echo '</div>';
                }

                // Function to search products
                function search_products($query, $categories) {
                    $found_items = [];
                    foreach ($categories as $category) {
                        foreach ($category as $product) {
                            if (stripos($product['name'], $query) !== false) {
                                $found_items[] = $product;
                            }
                        }
                    }
                    return $found_items;
                }

                // Categories array
                $categories = [
                    "fruits" => $fruits,
                    "vegetables" => $vegetables,
                    "grains" => $grains,
                    "legumes" => $legumes,
                    "nuts-seeds" => $nuts_seeds,
                    "herbs-spices" => $herbs_spices
                ];

                // Check if there is a search query
                if (isset($_GET['query']) && !empty($_GET['query'])) {
                    $query = $_GET['query'];
                    $search_results = search_products($query, $categories);
                    if (!empty($search_results)) {
                        echo '<h2>Search Results for "' . htmlspecialchars($query) . '"</h2>';
                        display_items($search_results);
                    } else {
                        echo '<div class="alert alert-danger" role="alert">
                                No products found for "' . htmlspecialchars($query) . '".
                              </div>';
                    }
                } else {
                    // Display items for each category
                    foreach ($categories as $key => $items) {
                        echo '<h2 id="' . $key . '">' . ucfirst(str_replace('-', ' ', $key)) . '</h2>';
                        display_items($items, 0, 10); // Show first 10 items initially
                        echo '<button class="btn btn-primary show-more-btn" onclick="showMore(\'' . $key . '\')">Show More</button>';
                        echo '<div id="' . $key . '-more" class="more-container">';
                        display_items($items); // Show all remaining items
                        echo '</div>';
                    }
                }
                ?>
            </main>
        </div>
    </div>

    <?php include 'footer.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
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
