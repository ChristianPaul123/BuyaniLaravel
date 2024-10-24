<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Poppins Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            overflow-x: hidden;
            font-family: 'Poppins', sans-serif;
        }
        .hero-section {
            background: #f8f9fa;
            padding: 60px 0;
        }
        .custom-border-top {
            color: white;
            background-color: #5DC14C;
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
    </style>
</head>
<body>
    <!-- NavBar -->
    <?php include 'navbar-farmer.php'; ?>

    <!-- Main Page -->
    <section class="hero-section">
        <div class="container text-center">
            <h1 class="display-4 mb-4">Analytics Overview</h1>

            <!-- Bar Graph for Top Products -->
            <div class="row mb-5">
                <div class="col-md-12">
                    <h2 class="my-4">Top Products This Month</h2>
                    <canvas id="analyticsChart" style="max-width: 100%;"></canvas>
                </div>
            </div>

            <!-- Bar Graph for My Sales -->
            <div class="row mb-5">
                <div class="col-md-12">
                    <h2 class="my-4">My Sales</h2>
                    <canvas id="mySalesChart" style="max-width: 100%;"></canvas>
                </div>
            </div>

            <!-- Additional Insights -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Top Products</h5>
                            <p class="card-text">These are the top-selling products this month.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Sales Growth</h5>
                            <p class="card-text">Overall sales growth compared to last month.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'footer.php'; ?>

    <!-- JAVASCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Sample Data for Analytics Chart
        const ctxAnalytics = document.getElementById('analyticsChart').getContext('2d');
        const analyticsChart = new Chart(ctxAnalytics, {
            type: 'bar',
            data: {
                labels: ['Apples', 'Bananas', 'Cherries', 'Grapes', 'Oranges', 'Peaches'],
                datasets: [{
                    label: 'Sales in kg',
                    data: [200, 150, 300, 250, 100, 180],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    x: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Sample Data for My Sales Chart
        const ctxMySales = document.getElementById('mySalesChart').getContext('2d');
        const mySalesChart = new Chart(ctxMySales, {
            type: 'bar',
            data: {
                labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                datasets: [{
                    label: 'Sales in kg',
                    data: [120, 200, 150, 300],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(54, 162, 235, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    x: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    
</body>
</html>
