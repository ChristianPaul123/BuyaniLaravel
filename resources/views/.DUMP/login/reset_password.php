<?php
session_start();
@include '../include/config.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['resetpassword'])) {
    if (isset($_SESSION['RESET_VERIFIED']) && $_SESSION['RESET_VERIFIED'] == true) {
        $filter_pass = htmlspecialchars($_POST['password']);
        $password = mysqli_real_escape_string($conn, $filter_pass);
        $pass = md5($password);
        $filter_cpass = htmlspecialchars($_POST['cpassword']);
        $cpassword = mysqli_real_escape_string($conn, $filter_cpass);
        $cpass = md5($cpassword);
        $email = $_SESSION['RESET_EMAIL'];

        if ($pass != $cpass) {
            echo '<script>alert("Passwords did not match!")</script>';
        } else {
            // Update password in user table
            $update_user = mysqli_query($conn, "UPDATE `user` SET password = '$pass' WHERE email = '$email'") or die('query failed');
            if ($update_user) {
                echo '<script>alert("Password reset successfully!")</script>';
                header('Location: consumer-login.php');
                exit();
            } else {
                echo '<script>alert("Failed to reset password!")</script>';
            }
        }
    } else {
        echo '<script>alert("OTP not verified!")</script>';
        header('Location: forgot_password.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            font-weight: bold;
            background-color: #3F6F23;
        }

        .custom-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            position: relative;
            top: -100px;
        }

        .form-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }

        .form-container input[type="password"] {
            flex: 1;
        }

        .form-container button {
            width: auto;
            background-color: #ffc107;
            border: none;
            color: #000;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            align-self: center;
        }

        .form-container button:hover {
            background-color: #e0a800;
        }

        .error-message {
            color: red;
            font-size: 0.875em;
        }
    </style>
</head>
<body>
    <?php include '../navBar/navbar-consumer.php'?>
    <?php @include '../include/message.php'; ?>

    <div class="custom-container" style="border: 0px; color: black;">
        <div class="form-container">
            <form id="resetForm" action="reset_password.php" method="post">
                <div class="form-group my-3">
                    <label for="password">New Password:</label>
                    <div class="input-group">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Enter new password" minlength="8" required>
                        <div class="input-group-append">
                            <span class="input-group-text toggle-password" id="togglePassword"
                                style="height: 100%; width: 40px; border-top-left-radius: 0px; border-bottom-left-radius: 0px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group my-3">
                    <label for="cpassword">Confirm New Password:</label>
                    <div class="input-group">
                        <input type="password" name="cpassword" class="form-control" id="password2" placeholder="Re-enter new password" required>
                    </div>
                    <div id="passwordLengthError" class="error-message"></div>
                    <div id="passwordError" class="error-message"></div>
                </div>
                <button type="submit" class="btn btn-warning mt-5 mb-2" name="resetpassword">Reset Password</button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('resetForm').addEventListener('submit', function(event) {
            var password = document.getElementById('password').value;
            var password2 = document.getElementById('password2').value;
            var passwordError = document.getElementById('passwordError');
            var passwordLengthError = document.getElementById('passwordLengthError');

            // Reset error messages
            passwordError.textContent = "";
            passwordLengthError.textContent = "";

            // Check if password meets minimum length requirement
            if (password.length < 8) {
                event.preventDefault();
                passwordLengthError.textContent = "Password must be at least 8 characters long.";
            }

            // Check if passwords match
            if (password !== password2) {
                event.preventDefault();
                passwordError.textContent = "Passwords do not match.";
            }
        });

        // Toggle password visibility for both fields
        document.getElementById('togglePassword').addEventListener('click', function () {
            var passwordField1 = document.getElementById('password');
            var passwordField2 = document.getElementById('password2');
            var toggleIcon = this.querySelector('i');
            if (passwordField1.type === 'password' && passwordField2.type === 'password') {
                passwordField1.type = 'text';
                passwordField2.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordField1.type = 'password';
                passwordField2.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        });
    </script>
</body>
</html>

