<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('img/logo1.svg') }}" type="image/png">
    <title>Buyani Register</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    @include('layouts.head')

    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #A9BFA8;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            display: flex;
            width: 900px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin: 15px;
            background-color: #8EB486;
        }

        .logo-section {
            flex: 1;
            background-color: #FBF6E9;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .logo-section img {
            max-width: 100%;
            height: 250px;
        }

        .login-section {
            flex: 1;
            background-color: #2e7d32;
            color: #ffa500;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 40px;
        }

        .login-section h2 {
            margin-bottom: 30px;
            font-size: 2rem;
            font-weight: 700;
        }

        .form-control {
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .form-check-label {
            color: #fff;
        }

        .btn {
            background-color: #ffc107;
            border: none;
            color: #002855;
            font-weight: bold;
            border-radius: 5px;
            padding: 10px 20px;
        }

        .btn:hover {
            background-color: #e0a800;
        }

        .form-icon {
            color: #ffc107;
        }

        .input-group {
            display: flex;
            align-items: center;
        }

        .toggle-password {
            cursor: pointer;
        }

        p {
            margin-top: -90px;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>
<body>
    <!--CONTENT-->
    <div class="login-container">
        <!-- Logo Section -->
        <div class="logo-section">
            <img src="{{ asset('img/logo1.svg') }}" alt="Company Logo">
        </div>

        @if(session('message'))
            <script>
                alert('{{ session('message') }}');
            </script>
        @endif


        <!-- Login Section -->
        <div class="login-section">
            <h2>Admin Register</h2>
            <form action="{{ route('admin.register') }}" method="post" autocomplete="off">
                @csrf
                <div class="form-group">
                    <label for="username" class="form-icon"><i class="bi bi-person-fill"></i> Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Enter username" required>
                </div>
                <div class="form-group">
                    <label for="email" class="form-icon"><i class="fas fa-envelope"></i> Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter email" required>
                </div>
                <div class="form-group">
                    <label for="password" class="form-icon"><i class="fas fa-lock"></i> Password</label>
                    <div class="input-group">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" required>
                        <input type="hidden" name="admin_type" value="1">
                        <div class="input-group-append" style="height: calc(1.5em + 0.75rem + 2px);">
                            <span class="input-group-text toggle-password">
                                <i class="fas fa-eye" id="togglePassword"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-block mt-3">Register</button>
            </form>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Select the toggle password icon
            const togglePassword = document.querySelector('.toggle-password');
            const passwordField = document.getElementById('password');

            // Add click event listener to toggle password visibility
            togglePassword.addEventListener('click', function () {
                const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordField.setAttribute('type', type);

                // Toggle the icon class between 'fa-eye' and 'fa-eye-slash'
                const icon = this.querySelector('i');
                icon.classList.toggle('fa-eye');
                icon.classList.toggle('fa-eye-slash');
            });
        });
    </script>

    @include('layouts.script')

</body>
</html>
