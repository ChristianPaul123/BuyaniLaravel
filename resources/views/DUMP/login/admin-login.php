<?php
    session_start();
    @include '../include/config.php'; 

    $showErrorModal = false;
    $showSuccessModal = false;

    if(isset($_POST['submitlogin'])){

        $filter_user = htmlspecialchars($_POST['username']);
        $user = mysqli_real_escape_string($conn, $filter_user);
        $filter_pass = htmlspecialchars($_POST['password']);
        $pass = mysqli_real_escape_string($conn, $filter_pass );
        // $password=md5($password);

        $select_users = mysqli_query($conn, "SELECT * FROM admin_user WHERE username = '$user' AND password = '$pass'") or die('query failed');

        if(mysqli_num_rows($select_users) > 0){
            
            $row = mysqli_fetch_assoc($select_users);

            if($row['admin_type'] == 'admin'){

                $_SESSION['admin_name'] = $row['username'];
                $_SESSION['admin_email'] = $row['email'];
                $_SESSION['admin_id'] = $row['id'];
                $_SESSION['admin_type'] = $row['admin_type'];

                $showSuccessModal = true;

            }else{
                echo '<script>alert("login failed")</script>'; 
            }
        }else{
            $showErrorModal = true;
        }
    }
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
        .wallpaper {
            background-image: url('../img/wallpaper.png');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }

        .custom-font-content {
            font-family: 'Poppins', sans-serif;
            font-weight: bold;
            color: aliceblue;
        }

        .login-card {
            background-color: #03346E;
            padding: 20px;
            border-radius: 15px;

            border: 2px solid #00509e;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2), 0 6px 20px rgba(0, 0, 0, 0.19);
        }

        .form-control:focus {
            box-shadow: none;
        }
    </style>
</head>
<body style="overflow-x: hidden;">
    <?php @include '../include/message.php'; ?>

    <!--CONTENT-->
    <div class="row custom-font-content d-flex align-items-center justify-content-center wallpaper" style="height: 100vh;">
        <div class="col-lg-4 login-card d-flex flex-column align-items-center pt-5">
            <h2 class="text-center mb-3 mx-2" style="font-size: 40px;">Welcome Admin!</h2>
            <form class="my-3" method="post" style="width: 400px;" id="loginForm" autocomplete="off">
                <div class="form-group my-3">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control" id="username" placeholder="Enter username" required>
                </div>
                <div class="form-group my-3">
                    <label for="password">Password:</label>
                    <div class="input-group">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" required>
                        <div class="input-group-append">
                        <span class="input-group-text toggle-password"
                            style="height: 100%; width: 40px; border-top-left-radius: 0px; border-bottom-left-radius: 0px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-eye"></i>
                        </span>
                        </div>
                    </div>
                </div>
                <div class="container d-flex justify-content-center">
                    <button type="submit" name="submitlogin" class="btn btn-block my-3 px-4" style="background-color: #E2E2B6;">LOGIN</button>
                </div>
            </form>
        </div>
    </div>

    <?php include '../modalMessage/error/loginError.html'?>
    <?php include '../modalMessage/success/loginSuccess.html'?>

    <script>
    // Toggle Hide Password
    $(document).ready(function() {
        $('.toggle-password').click(function() {
            const passwordField = $('#password');
            const icon = $(this).find('i');

            if (passwordField.attr('type') === 'password') {
                passwordField.attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                passwordField.attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
    });

    <?php if ($showErrorModal): ?>
        $('#errorMessageModal').modal('show');
    <?php endif; ?>

    <?php if ($showSuccessModal): ?>
        $('#successMessageModal').modal('show');
    <?php endif; ?>

    $('#successMessageModal').on('hide.bs.modal', function () {
        window.location.href = "../landingPage/adminPage.php";
    });
    </script>
    
</body>
</html>
