<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Testing</title>

    @include('layouts.head')

    <style>
        html,body {
            overflow: hidden;
        }

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
<body>
<!--CONTENT-->
<div class="row custom-font-content d-flex align-items-center justify-content-center wallpaper" style="height: 100vh;">
  <div class="col-lg-4 login-card d-flex flex-column align-items-center pt-5">
      <h2 class="text-center mb-3 mx-2" style="font-size: 40px;">Welcome Admin!</h2>
      @session('message')
      <div>
          {{ session('message') }}
      </div>
     @endsession
      <form action={{route('admin.register')}} class="my-3" method="post" style="width: 400px;" autocomplete="off">
        @csrf
          <div class="form-group my-3">
              <label for="username">Username</label>
              <input type="text" name="username" class="form-control" placeholder="Enter username" required>
          </div>
          <div class="form-group my-3">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Enter email" required>
        </div>
          {{-- <div class="form-group my-3">
            <label for="username">Email</label>
            <input type="email" name="email" class="form-control"  placeholder="Enter email" required>
        </div> --}}
          <div class="form-group my-3">
              <label for="password">Password:</label>
              <div class="input-group">
                  <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" required>
                  <input type="hidden" name="admin_type" value=1>
                  <div class="input-group-append">
                  <span class="input-group-text toggle-password"
                      style="height: 100%; width: 40px; border-top-left-radius: 0px; border-bottom-left-radius: 0px; display: flex; align-items: center; justify-content: center;">
                      <i class="fas fa-eye"></i>
                  </span>
                  </div>
              </div>
          </div>

          <div class="container d-flex justify-content-center">
              <button type="submit" class="btn btn-block my-3 px-4" style="background-color: #E2E2B6;">For testing Register</button>
          </div>
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
