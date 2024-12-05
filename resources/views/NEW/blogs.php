<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Layout</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Farm-themed loading screen */
        #loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #f1c40f; /* Farm-like yellow */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            color: #fff;
            font-size: 2rem;
            font-weight: bold;
        }

        body {
            background-color: #f9f9f9;
        }
        .card-title {
            font-size: 1.1rem;
            font-weight: bold;
        }
        .card-text {
            color: #666;
        }

        .modal-img {
            width: 100%;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        @media (max-width: 576px) { /* Mobile devices */
            .card img.card-img-top {
                width: 100%;
                height: auto; /* Ensure proper scaling */
                display: block;
                margin-bottom: 10px; /* Add some spacing */
            }

            .card-body {
                text-align: center; /* Center-align the content */
            }

            /* Reduce card padding for better readability */
            .card {
                margin-bottom: 20px;
            }
        }
        /* Make the modal resizeable */
        .modal-sm {
            max-width: 600px; 
        }
    </style>
</head>
<body>
    <!-- Loading Screen -->
    <div id="loading-screen">
        🌾 Farm Loading... 🚜
    </div>

    <div class="container my-5">
        <!-- Heading Blog -->
        <div class="row">
            <div class="col-12 mb-4">
                <div class="card">
                    <img 
                        src="Images/main blog.jpg" 
                        class="card-img-top blog-img" 
                        width="600" 
                        height="650" 
                        alt="Main Blog Image"
                        data-bs-toggle="modal" 
                        data-bs-target="#blogModal" 
                        data-title="The HubSpot Blog's 2023 Marketing Strategy & Trends Report" 
                        data-author="Buyani@2024" 
                        data-date="7/1/22"
                        data-img="Images/main blog.jpg"
                    >
                    <div class="card-body">
                        <h5 class="card-title">The HubSpot Blog's 2023 Marketing Strategy & Trends Report</h5>
                        <p class="card-text">Discover the trends, tactics, and challenges marketers will focus on in 2023 and how they compare...</p>
                        <p class="text-muted">Buyani@2024 | 7/1/22</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Blog Grid -->
        <div class="row g-3">
            <?php 
            // Example blog data (9 blogs)
            $blogs = [
                ["img" => "Images/blog1.jpg", "title" => "Sweet Potato Wonders: Delicious Recipes and Surprising Health Benefits", "date" => "6/5/23", "author" => "Buyani@2024"],
                ["img" => "Images/blog2.jpg", "title" => "Turning Harvests into Profits: A Beginner's Guide to Selling Crops", "date" => "9/15/22", "author" => "Buyani@2024"],
                ["img" => "Images/blog3.jpg", "title" => "Harvest Hacks: Easy Tips for Growing Root Crops at Home", "date" => "8/25/22", "author" => "Buyani@2024"],
                ["img" => "Images/blog4.jpg", "title" => "Harvest Trade Secrets: Mastering the Art of Negotiation in Agriculture", "date" => "5/4/23", "author" => "Buyani@2024"],
                ["img" => "Images/blog5.jpg", "title" => "From Farm to Bulk: How to Thrive in the Crop Wholesale Business", "date" => "5/2/23", "author" => "Buyani@2024"],
                ["img" => "Images/blog6.jpg", "title" => "Root to Table: Exploring the Hidden Nutritional Gems of Root Crops", "date" => "9/15/22", "author" => "Buyani@2024"],
                ["img" => "Images/blog7.jpg", "title" => "The Veggie Rainbow: Adding Color and Nutrition to Your Meals", "date" => "5/4/23", "author" => "Buyani@2024"],
                ["img" => "Images/blog8.jpg", "title" => "Crops Around the World: Cultural Favorites You Should Try", "date" => "8/25/22", "author" => "Buyani@2024"],
                ["img" => "Images/blog9.jpg", "title" => "From the Earth: 10 Root Crops That Deserve a Spot on Your Plate", "date" => "6/5/23", "author" => "Buyani@2024"]
            ];

            // Loop through blogs and display them
            foreach ($blogs as $blog) {
                echo "
                <div class='col-md-4 col-6'>
                    <div class='card'>
                        <img src='{$blog['img']}' class='card-img-top blog-img' alt='Blog Image' data-bs-toggle='modal' data-bs-target='#blogModal' data-title='{$blog['title']}' data-author='{$blog['author']}' data-date='{$blog['date']}' data-img='{$blog['img']}'>
                        <div class='card-body'>
                            <h5 class='card-title'>{$blog['title']}</h5>
                            <p class='text-muted'>{$blog['author']} | {$blog['date']}</p>
                        </div>
                    </div>
                </div>";
            }
            ?>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="blogModal" tabindex="-1" aria-labelledby="blogModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="blogModalLabel">Blog Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="modalImg" src="" alt="Blog Image" class="modal-img">
                    <h5 id="modalTitle"></h5>
                    <p id="modalAuthor"></p>
                    <p id="modalDate"></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Show loading screen until the page fully loads
        window.addEventListener('load', function() {
            document.getElementById('loading-screen').style.display = 'none';
        });

        // Populate modal with data on image click
        document.querySelectorAll('.blog-img').forEach(img => {
            img.addEventListener('click', function() {
                document.getElementById('modalImg').src = img.dataset.img;
                document.getElementById('modalTitle').textContent = img.dataset.title;
                document.getElementById('modalAuthor').textContent = "Author: " + img.dataset.author;
                document.getElementById('modalDate').textContent = "Date: " + img.dataset.date;
            });
        });
    </script>
</body>
</html>
