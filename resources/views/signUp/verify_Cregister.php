<?php
//This is for the Consumer OTP registration
session_start();
@include '../include/config.php'; 

//for bitching people cause y not
if (!isset($_SESSION['LOGIN'])) {
    echo '<script>alert("Session expired. Please try registering again.")</script>';
    header('Location: signUp-consumer.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['verifyotp'])) {
    $entered_otp = htmlspecialchars($_POST['otp']);
    $email = $_SESSION['LOGIN'];

    // Fetch OTP and check expiry also by count now sheesh
    $result = mysqli_query($conn, "SELECT otp, otp_expiry FROM `temp_verify` WHERE email = '$email' ORDER BY count DESC LIMIT 1") or die('query failed');
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $stored_otp = $row['otp'];
        $otp_expiry = $row['otp_expiry'];

        if (strtotime($otp_expiry) > time()) {
            if ($entered_otp == $stored_otp) {
                // OTP is correct and not expired
                mysqli_query($conn, "UPDATE `temp_verify` SET verified = 1 WHERE email = '$email' ORDER BY count DESC LIMIT 1") or die('query failed');
                // Redirect back to registration script with verified something
                header('Location: signUp-consumer.php?verified=1');
                exit();
            } else {
                // OTP is incorrect
                $_SESSION['message']="Invalid OTP please try agian!";
            }
        } else {
            // OTP is expired
            echo '<script>alert("OTP expired. Please try registering again.")</script>';
            header('Location: signUp-consumer.php');
            session_destroy();
            exit();
        }
    } else {
        $_SESSION['message']="Email is not found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verify OTP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script> -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
    body {
        background-color: #3F6F23;
    }

    .custom-container {
        background-color: #3F6F23;
        font-family: 'Poppins', sans-serif;
        color: aliceblue;
        border: 3px solid black;
        border-radius: 15px;     
    }

    .box-code input {
        font-size: 25px;
        width: 50px;
        text-align: center;
    }

    .code-input {
        display: flex;
        justify-content: space-between;
        max-width: 300px;
        margin: auto;
    }

    .code-input input {
        text-align: center;
        width: 100%;
        font-size: 24px;
        border: 1px solid #ced4da;
        border-radius: 0.375rem;
        padding: 0.5rem;
    }

    .code-input input:not(:last-child) {
        margin-right: 0.5rem;
    }

    .message {
        position: absolute;
        top: 0;
        margin: 10px 0 0 0;
        width: 95%;
        background-color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        gap: 1.5rem;
        border-radius: 40px;
        z-index: 10000;
        border: 10px black;
        justify-content: space-between;
    }

    .message span {
        color: black;
        font-size: 2rem;
    }

    .message i {
        font-size: 2.5rem;
        color: red;
        cursor: pointer;
    }

    .message i:active {
        transform: rotate(90deg);
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* New styles for text color */
    .text-aliceblue {
        color: aliceblue;
    }
    </style>
</head>
<body>
<?php @include '../include/message.php'; ?>

<?php include '../navBar/navbar-consumer.php'?>

<div class="box-holder d-flex flex-column align-items-center justify-content-evenly py-5">
    <img src="../img/recoveryCode.svg">
    <h3 class="my-2 text-aliceblue">Verification Code Sent To:</h3>
    <h5 id="displayEmail" class="text-aliceblue"> <?php echo $_SESSION['LOGIN'] ?></h5>
    <form action="" method="post" class="mt-4 d-flex flex-column align-items-center justify-content-evenly">
        <div class="code-input d-flex align-items-center justify-content-center box-code">
            <input type="number" name="otp" maxlength="8" />                
        </div>
        <button type="submit" name="verifyotp" class="btn btn-warning mt-4">Verify</button>
    </form>
</div>
</body>
</html>



