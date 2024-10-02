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
                                    <p style='font-size: 16px; font-family: Arial, sans-serif; color: #333333; margin-bottom: 10px;'>Recovery Code for Password</p>
                                    <p style='font-size: 14px; font-family: Arial, sans-serif; color: #333333; margin-bottom: 20px;'>Check the OTP below!</p>
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

function generateOTP($length = 6) {
  return substr(str_shuffle("0123456789"), 0, $length);
}


function getAccessToken($clientId, $clientSecret, $refreshToken) {
  $client = new \Google_Client();
  $client->setClientId($clientId);
  $client->setClientSecret($clientSecret);
  $client->refreshToken($refreshToken);
  $client->fetchAccessTokenWithRefreshToken($refreshToken);

  return $client->getAccessToken();
}

?>

<?php
if (isset($_POST['submitrequest'])) {
  $filter_email = htmlspecialchars($_POST['email']);
  $email = mysqli_real_escape_string($conn, $filter_email);

  // Check if email exists in the user table
  $check_email = mysqli_query($conn, "SELECT * FROM `user` WHERE email = '$email'") or die('query failed');
  
  if (mysqli_num_rows($check_email) > 0) {
      $otp = generateOTP();
      $otp_expiry = date("Y-m-d H:i:s", strtotime('+10 minutes'));

      $_SESSION['LOGIN'] = $email;
      sendVerificationEmail($email, $otp);
      // Count the existing occurrences of the email in the temp_verify table
      $result = mysqli_query($conn, "SELECT COUNT(*) as count FROM `temp_verify` WHERE email = '$email'") or die('query failed');
      $row = mysqli_fetch_assoc($result);
      $counter = $row['count'] + 1; // Increment the counter for the new entry
      $reason = "forgotpassword";
      // Insert OTP and email into temp_verify table
      $insert_temp_verify = mysqli_query($conn, "INSERT INTO `temp_verify` (email, otp, otp_expiry, verified, count,v_purpose) VALUES ('$email', '$otp', '$otp_expiry', 0, '$counter','$reason')") or die('query failed');

      if ($insert_temp_verify) {
          $_SESSION['RESET_EMAIL'] = $email;
          header('Location: verify_fpassword.php');
          exit();
      } else {
          echo '<script>alert("Failed to initiate password reset!")</script>';
      }
  } else {
      echo '<script>alert("Email not found in our records!")</script>';
  }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
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
            align-items: center;
            gap: 10px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .form-container input {
            flex: 1;
        }

        .form-container button {
            flex-shrink: 0;
        }

        .emailInput{
            width: 500px;
        }
    </style>
</head>
<body>
    <?php include '../navBar/navbar-consumer.php'?>
    <?php @include '../include/message.php'; ?>
    
    <div class="custom-container" style="border: 0px;">
        <form class="form-container" action="" method="post">
            <input type="email" class="form-control emailInput" name="email" placeholder="Enter your email" required autocomplete="off">
            <button type="submit" class="btn btn-warning" name="submitrequest">Request Password Reset</button>
        </form>
    </div>
</body>
</html>

