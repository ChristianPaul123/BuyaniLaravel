<?php
    session_start();
    @include '../include/config.php'; 

    $showErrorModal = false;
    $showSuccessModal = false;

    if(isset($_POST['submitlogin'])){

        $filter_email = htmlspecialchars($_POST['email']);
        $email = mysqli_real_escape_string($conn, $filter_email);
        $filter_pass = htmlspecialchars($_POST['password']);
        $password = mysqli_real_escape_string($conn, $filter_pass );
        $pass = md5($password);

        $select_users = mysqli_query($conn, "SELECT * FROM `user` WHERE email = '$email' AND password = '$pass'") or die('query failed');

        if(mysqli_num_rows($select_users) > 0){
            
            $row = mysqli_fetch_assoc($select_users);

            if($row['user_type'] == 'farmer'){
                
                $_SESSION['user_name'] = $row['username'];
                $_SESSION['user_email'] = $row['email'];
                $_SESSION['user_id'] = $row['id'];

                // This session is for log out logs
                $_SESSION['login'] = $row['email'];

                $extra = "../landingPage/farmerPage.php";
                $uip = $_SERVER['REMOTE_ADDR'];
                $status = 1;
                $log = mysqli_query($conn, "insert into userlog(user_email,user_ip,status) values('$email','$uip','$status')");
                $host = $_SERVER['HTTP_HOST'];
                $uri = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
                $showSuccessModal = true; // Set the flag for the success modal
                // Set extra variable for redirection
                $_SESSION['redirect_url'] = $extra;
                        
            } else {
                $extra = "farmer-login.php";
                $email = $_POST['email'];
                $uip = $_SERVER['REMOTE_ADDR'];
                $status = 0;
                $log = mysqli_query($conn, "insert into userlog(user_email,user_ip,status) values('$email','$uip','$status')");
                $host = $_SERVER['HTTP_HOST'];
                $uri = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
                header("location:http://$host$uri/$extra");
                $_SESSION['message'] = "Consumer account not found!.....Are you really a consumer";
                exit();
            }

        } else {
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
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script> -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        .custom-font-content {
            font-family: 'Poppins', sans-serif;
            font-weight: bold;
            color: aliceblue;
        }

        .login-card {
            background-color: #3F6F23;
            color: #fff;
            padding: 20px;
        }

        .form-control:focus {
            box-shadow: none;
        }
    </style>
</head>
<body style="overflow-x: hidden;">
    <?php include '../navBar/navbar-farmer.php'?>
    <?php @include '../include/message.php'; ?>

    <!--CONTENT-->
    <div class="row custom-font-content">
        <div class="col-lg-6 login-card d-flex flex-column align-items-center justify-content-center" style="height: 500px;">
            <div class="container d-flex align-items-center justify-content-center">
                <h2 class="text-center my-3 mx-2" style="font-size: 40px; white-space: nowrap;" >Login as Farmer!</h2>
                <div class="container d-flex align-items-center justify-content-end">
                    <button type="button" class="btn btn-primary mx-2" style="width: 120px;" onclick="window.location.href='consumer-login.php';">Consumer</button>
                    <button type="button" class="btn btn-danger mx-2" style="width: 120px;" onclick="window.location.href='farmer-login.php';">Farmer</button>    
                </div>
            </div>
            <form class="my-3" method="post" style="width: 400px;" id="loginForm" autocomplete="off">
                <div class="form-group my-3">
                    <label for="username">Email</label>
                    <input type="text" name="email" class="form-control" id="username" placeholder="Enter email" required>
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
                <div class="form-group my-3 d-flex justify-content-end">
                    <a href="forgot_password.php" class="custom-font-content" style="color: chartreuse;">Forget Password?</a>
                </div>
                <div class="container d-flex justify-content-center">
                    <button type="submit" name="submitlogin" class="btn btn-warning btn-block my-3 px-4">LOGIN</button>
                </div>
            </form>
            <div class="text-center mt-3 my-3">
                <a href="../signUp/signUp-farmer.php">Create Account | Sign Up</a>
            </div>
        </div>
        <div class="col-lg-6 d-flex align-items-center justify-content-center p-0">
            <img src="../img/farmerPhoto.jpg" alt="farmer logo" style="width: 100%; height: 500px;">
        </div>
    </div>

    <?php include '../modalMessage/error/loginError.html'?>
    <?php include '../modalMessage/success/loginSuccess.html'?>

    <?php include '../include/footer.html'?>
    <?php include '../include/forgotPassword.html'?>

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
            window.location.href = "<?php echo isset($_SESSION['redirect_url']) ? $_SESSION['redirect_url'] : '../landingPage/farmerPage.php'; ?>";
        });

    </script>

</body>
</html>
