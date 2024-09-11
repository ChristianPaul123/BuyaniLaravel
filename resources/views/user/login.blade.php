<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    @include ('layouts.head')

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
  @include('navBar.navbar-consumer')
  {{-- Display success or error messages --}}
    <!--CONTENT-->
    <div class="row custom-font-content">


            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif  
            
        <div class="col-lg-6 login-card d-flex flex-column align-items-center justify-content-center" style="height: 500px;">

            <div class="container d-flex align-items-center justify-content-center">  
   
                @if ($user_type == 1)
                    <h2 class="text-center my-3 mx-2" style="font-size: 40px; white-space: nowrap;" >Login as Consumer</h2>
                @elseif ($user_type == 2)
                <h2 class="text-center my-3 mx-2" style="font-size: 40px; white-space: nowrap;" >Login as Farmer</h2>
                @endif
            </div>
            <form class="my-3" action="{{ route('user.login.submit') }}" method="post" style="width: 400px;" id="loginForm" autocomplete="off">
              @csrf
                <div class="form-group my-3">
                    <label for="username">username</label>
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

                    <input type="hidden" name="user_type" value="{{ $user_type }}" />
                </div>
                <div class="form-group my-3 d-flex justify-content-end">
                    <a href="forgot_password.php" class="custom-font-content" style="color: chartreuse;">Forget Password?</a>
                </div>
                <div class="container d-flex justify-content-center">
                    <button type="submit" name="submitlogin" class="btn btn-warning btn-block my-3 px-4">LOGIN</button>
                </div>
            </form>
            <div class="text-center mt-3 my-3">
                <a href="../signUp/signUp-consumer.php">Create Account | Sign Up</a>
            </div>
        </div>
@if($user_type == 1)      
        <div class="col-lg-6 d-flex align-items-center justify-content-center p-0">
            <img src="../img/consumerPhoto.jpg" alt="farmer logo" style="width: 100%; height: 500px;">
        </div>
@elseif($user_type == 2)
      <div class="col-lg-6 d-flex align-items-center justify-content-center p-0">
        <img src="../img/farmerPhoto.jpg" alt="farmer logo" style="width: 100%; height: 500px;">
    </div>
@endif
    </div>
    @include ('include.footer')
  </body>
</html>
    
