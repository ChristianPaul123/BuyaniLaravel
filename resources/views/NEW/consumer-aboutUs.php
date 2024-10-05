<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Poppins Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif; 
        }
        .about-section {
            padding: 60px 0;
            color: white; 
        }
        .team-member {
            margin-bottom: 30px;
        }
    </style>
</head>
<body style="background-image: url(img/stockImg4.png); background-repeat: no-repeat; background-size: cover; background-position: center;">

    <!-- NavBar -->
    <?php include 'navbar-consumer.php' ?>

    <!-- About Us Section -->
    <div class="container about-section">
        <h2 class="text-center mb-4">About Us</h2>
        <p class="text-center">We are a team of passionate individuals committed to delivering the best services to our clients.</p>
        <div class="row">
            <div class="col-lg-3 col-md-6 text-center team-member">
                <img src="https://via.placeholder.com/150" class="rounded-circle mb-2" alt="Team Member">
                <h4>John Doe</h4>
                <p>Founder & CEO</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
            <div class="col-lg-3 col-md-6 text-center team-member">
                <img src="https://via.placeholder.com/150" class="rounded-circle mb-2" alt="Team Member">
                <h4>Jane Smith</h4>
                <p>Chief Operating Officer</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
            <div class="col-lg-3 col-md-6 text-center team-member">
                <img src="https://via.placeholder.com/150" class="rounded-circle mb-2" alt="Team Member">
                <h4>Emily Johnson</h4>
                <p>Chief Technology Officer</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
            <div class="col-lg-3 col-md-6 text-center team-member">
                <img src="https://via.placeholder.com/150" class="rounded-circle mb-2" alt="Team Member">
                <h4>Michael Brown</h4>
                <p>Marketing Manager</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'footer.php' ?>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
