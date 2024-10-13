<?php
session_start();
@include '../include/config.php'; 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use League\OAuth2\Client\Provider\Google;
use PHPMailer\PHPMailer\OAuth;

require '../vendor/autoload.php';

?>

<?php
function sendVerificationEmail($email, $otp) {
    $subject = "Verification.BuyAni";
        $message = "<table cellspacing='0' cellpadding='0' style='width: 100%;'>
                <tr>
                    <td align='center'>
                        <table cellspacing='0' cellpadding='0' style='width: 400px; border-collapse: collapse; border: 1px solid #dddddd; border-radius: 8px; overflow: hidden;'>
                            <tr>
                                <td align='center' bgcolor='#ffffff' style='padding: 20px;'>
                                    <p style='font-size: 20px; font-family: Arial, sans-serif; color: #333333; margin-bottom: 20px; font-weight: bold'>Welcome to Buyani</p>
                                    <p style='font-size: 16px; font-family: Arial, sans-serif; color: #333333; margin-bottom: 30px;'>An E-Commerce Agri market for your future needs!</p>
                                    <p style='font-size: 16px; font-family: Arial, sans-serif; color: #333333; margin-bottom: 10px;'>Verification Code for Registration</p>
                                    <p style='font-size: 14px; font-family: Arial, sans-serif; color: #333333; margin-bottom: 20px;'>Check the OTP below loved customer!</p>
                                    <p style='font-size: 14px; font-family: Arial, sans-serif; color: #333333;margin-bottom: 20px;'>{$otp}</p>
                                    <p style='font-size: 16px; font-family: Arial, sans-serif; color: #333333; margin-bottom: 10px;'>The OTP will Expire in 10mins</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>";
        $CLIENT_ID = '1048667499872-7jj8h2kri7il0p1ldk1l6o2lm59jnhtp.apps.googleusercontent.com';
        $CLIENT_SECRET = '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';
        $REFRESH_TOKEN = '1//04mW9hFaEZHiyCgYIARAAGAQSNwF-L9IrBmKcBqLtKLQnL3H3EZVpOThaJaG2sHgNfr3qtOe0HSfR31WLvnEcwrT4D6DwD0kA-QY';

    if (!$CLIENT_ID || !$CLIENT_SECRET || !$REFRESH_TOKEN) {
        throw new \Exception('Google OAuth2 client credentials are not set.');
    }

    $accessToken = getAccessToken($CLIENT_ID, $CLIENT_SECRET, $REFRESH_TOKEN);

    if (!$accessToken || !isset($accessToken['access_token'])) {
        throw new \Exception('Failed to obtain access token.');
    }

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->SMTPAuth = true;
        $mail->AuthType = 'XOAUTH2';

        $provider = new Google([
            'clientId' => $CLIENT_ID,
            'clientSecret' => $CLIENT_SECRET,
        ]);

        $mail->setOAuth(new OAuth([
            'provider' => $provider,
            'clientId' => $CLIENT_ID,
            'clientSecret' => $CLIENT_SECRET,
            'refreshToken' => $REFRESH_TOKEN,
            'userName' => 'buyanibusiness1@gmail.com',
            'accessToken' => $accessToken['access_token'],
        ]));

        $mail->setFrom('buyanibusiness1@gmail.com', 'Buyani');
        $mail->addAddress($email);
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->isHTML(true);

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return false;
    }
}

function getAccessToken($clientId, $clientSecret, $refreshToken) {
    $client = new \Google_Client();
    $client->setClientId($clientId);
    $client->setClientSecret($clientSecret);
    $client->refreshToken($refreshToken);
    $client->fetchAccessTokenWithRefreshToken($refreshToken);

    return $client->getAccessToken();
}

function generateOTP($length = 6) {
    return substr(str_shuffle("0123456789"), 0, $length);
}
?>


<?php
 ob_start(); // Start output buffering
                if(isset($_POST['submitregister'])){

                $filter_name = htmlspecialchars($_POST['username']);
                $name = mysqli_real_escape_string($conn, $filter_name);
                $filter_email = htmlspecialchars($_POST['email']);
                $email = mysqli_real_escape_string($conn, $filter_email);
                $filter_num = htmlspecialchars($_POST['number']);
                $num = mysqli_real_escape_string($conn, $filter_num);
                $filter_pass = htmlspecialchars($_POST['password']);
                $password = mysqli_real_escape_string($conn, $filter_pass );
                $pass=md5($password);
                $filter_cpass = htmlspecialchars($_POST['cpassword']);
                $cpassword = mysqli_real_escape_string($conn, $filter_cpass);
                $cpass=md5($cpassword);
                $type = "consumer";
                $otp = generateOTP();
                $otp_expiry = date("Y-m-d H:i:s", strtotime('+10 minutes'));
                
                //check email
                $select_users = mysqli_query($conn, "SELECT * FROM `user` WHERE email = '$email'") or die('query failed');
                //check username
                $select_username = mysqli_query($conn, "SELECT * FROM `user` WHERE username = '$name'") or die('query failed');

                if(mysqli_num_rows($select_users) > 0){
                    $_SESSION['message']="The email is already taken!";
                } elseif (mysqli_num_rows($select_username) > 0) {
                    $_SESSION['message']="The username is already taken!";
                }else{
                    if($pass !== $cpass){
                        $_SESSION['message']="Password did not match!";
                    }else{

                        sendVerificationEmail($email, $otp);
                            // Count the existing occurrences of the email in the temp_verify table
                            $result = mysqli_query($conn, "SELECT COUNT(*) as count FROM `temp_verify` WHERE email = '$email'") or die('query failed');
                            $row = mysqli_fetch_assoc($result);
                            $counter = $row['count'] + 1; // Increment the counter for the new entry
                            $reason = "Cregistration";
                            // Insert OTP and email into temp_verify table
                            $insert_temp_verify = mysqli_query($conn, "INSERT INTO `temp_verify` (email, otp, otp_expiry, verified, count,v_purpose) VALUES ('$email', '$otp', '$otp_expiry', 0, '$counter', '$reason')") or die('query failed');
                         
                            // Store registration details in session
                            $_SESSION['registration'] = [
                                'name' => $name,
                                'email' => $email,
                                'num' => $num,
                                'pass' => $pass,
                                'type' => $type
                            ];

                            $_SESSION['LOGIN'] = $email;

                            // Redirect to verify.php
                            if ($insert_temp_verify) {
                                header('Location: verify_Cregister.php');
                                exit();
                            } else {
                                $_SESSION['message']="failed to insert OTP!";
                            }
                        }
                    }
                    ob_end_flush();
                }


            if (isset($_GET['verified']) && $_GET['verified'] == 1) {
                if (isset($_SESSION['registration'])) {
                    $name = $_SESSION['registration']['name'];
                    $email = $_SESSION['registration']['email'];
                    $num = $_SESSION['registration']['num'];
                    $pass = $_SESSION['registration']['pass'];
                    $type = $_SESSION['registration']['type'];
            
                    $insert_user = mysqli_query($conn, "INSERT INTO `user`(username, email, user_type, password,verify_status) VALUES('$name', '$email', '$type', '$pass',1)") or die('query failed');
                    if ($insert_user) {
                        // Get the last inserted id
                        $user_id = mysqli_insert_id($conn);
            
                        $select_customer_details = mysqli_query($conn, "SELECT * FROM `consumer_details` WHERE user_id = '$user_id'") or die('query failed');
            
                        if (mysqli_num_rows($select_customer_details) > 0) {  
                            //Add something here for error shit
                            
                        } else {
                            $insert_consumer_details = mysqli_query($conn, "INSERT INTO `consumer_details` (user_id, contactNum) VALUES ('$user_id', '$num')") or die('query failed');
                            if ($insert_consumer_details) {
                                ob_end_flush();
                                $_SESSION['message']="You have Registered Successfully!";
                                header('Location: ../login/consumer-login.php');
                                exit();
                            }
                        }
                    }
                }
            }
            ob_end_flush();
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
            background-color: #3F6F23;
            color: #fff;
        }

        .form-control:focus {
            box-shadow: none;
        }

        /* Hide the increment and decrement buttons in WebKit browsers */
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .error-message {
            color: red;
            font-size: 0.875rem;
        }

        .message {
        position: absolute;
        top:0;
        margin:10px 0 0 0;
        width: 95%;
        background-color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        padding:2rem;
        gap:1.5rem;
        border-radius: 40px;
        z-index: 10000;
        border: 10px black;
        justify-content: space-between;
        }
        .message span{
        color:black;
        font-size: 2rem;
        }
        .message i{
        font-size: 2.5rem;
        color:red;
        cursor: pointer;
        }
        .message i:active{
        transform: rotate(90deg);
        }
        
        .toggle-password {
            cursor: pointer;
        }
    </style>
</head>
<body style="overflow-x: hidden;">
<?php @include '../include/message.php'; ?>
<?php include '../navBar/navbar-consumer.php'?>

    <!--Sign Up-->
    <div class="container-fluid custom-font-content" style="padding: 20px;">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center my-3 mx-2" style="font-size: 40px; white-space: nowrap;">Sign Up As Consumer</h2>
            </div>
        </div>
        <form id="signupForm" method="post" class="my-3" style="width: 100%;" autocomplete="off">
            <div class="row">
                <div class="col-lg-4 offset-lg-1 mb-4">
                    <div class="form-group my-3">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" id="username" placeholder="Enter username" required>
                    </div>
                    <div class="form-group my-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" required>
                    </div>
                    <div class="form-group my-3">
                        <label for="phone">Phone Number</label>
                        <input type="number" name="number" class="form-control" id="phone" placeholder="Enter number" required maxlength="10">
                        <div id="phoneError" class="error-message"></div>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-2 mb-4">
                    <div class="form-group my-3">
                        <label for="password">Password:</label>
                        <div class="input-group">
                            <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" minlength="8" required>
                            <div class="input-group-append">
                                <span class="input-group-text toggle-password" id="togglePassword"
                                    style="height: 100%; width: 40px; border-top-left-radius: 0px; border-bottom-left-radius: 0px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group my-3">
                        <label for="password2">Confirm Password:</label>
                        <div class="input-group">
                            <input type="password" name="cpassword" class="form-control" id="password2" placeholder="Re-enter password" required>
                        </div>
                        <div id="passwordLengthError" class="error-message"></div>
                        <div id="passwordError" class="error-message"></div>
                    </div>
                </div>
            </div>
            <!-- Submit Button -->
            <div class="row form-group my-3 d-flex justify-content-center">
                <button type="submit" name="submitregister" class="btn btn-warning btn-block px-4" style="width: fit-content;">Sign Up</button>
            </div>
        </form>
        <div class="row">
            <div class="col text-end mt-3 my-4">
                <a href="../login/consumer-login.php">Has account? | Sign In</a>
            </div>
        </div>
    </div>

    <?php include '../include/footer.html'?>

    <script>
        document.getElementById('signupForm').addEventListener('submit', function(event) {
            var password = document.getElementById('password').value;
            var password2 = document.getElementById('password2').value;
            var passwordError = document.getElementById('passwordError');
            var passwordLengthError = document.getElementById('passwordLengthError');
            var phone = document.getElementById('phone').value;
            var phoneError = document.getElementById('phoneError');

            // Reset error messages
            passwordError.textContent = "";
            passwordLengthError.textContent = "";
            phoneError.textContent = "";

            // Check if passwords match
            if (password !== password2) {
                event.preventDefault();
                passwordError.textContent = "Passwords do not match.";
            }

            // Check if password meets minimum length requirement
            if (password.length < 8) {
                event.preventDefault();
                passwordLengthError.textContent = "Password must be at least 8 characters long.";
            }

            //Check if phone number is exactly 10 digits
            if (phone.length !== 10) {
                event.preventDefault();
                phoneError.textContent = "Phone number must be exactly 10 digits.";
            }

            // if (password.length >= 8 && password === password2 && phone.length === 10) {
            //     alert("YAY");
            // }
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
