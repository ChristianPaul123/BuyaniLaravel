<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start(); // Start the session if not already started
    }

    // Retrieve user details from session
    $userId = $_SESSION['user_id'] ?? 'Guest'; // Provide a default if session data is missing
    $username = $_SESSION['user_name'] ?? 'Guest';
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        html, body {
            height: 100%;
            margin: 0;
            overflow-x: hidden; /* Prevent horizontal scrollbar */
        }

        .custom-font-content {
            font-family: 'Poppins', sans-serif;
            font-weight: bold;
            color: aliceblue;
        }  
    </style>
</head>
<body class="body">

    <?php include '../navBar/navbar-farmer.php'?>

    <div>
        <img src="../img/homePage/farmerHome.svg" style="width: 100%;">
    </div>

    <?php include '../include/footer.html'?>

    <?php include '../logoutModal/farmerLogoutModal.php'?>
        
</body>
</html>
