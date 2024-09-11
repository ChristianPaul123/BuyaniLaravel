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
    @if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif
    <!--CONTENT-->
    <div class="row custom-font-content">
        <div class="col-lg-6 login-card d-flex flex-column align-items-center justify-content-center" style="height: 500px;">
          <form action="{{ route('user.register') }}" method="GET">
              <input type="hidden" name="user_type" value="1">
              <button type="submit" class="btn btn-primary">Register as Consumer</button>
          </form>       
          <form action="{{ route('user.register') }}" method="GET">
              <input type="hidden" name="user_type" value="2">
              <button type="submit" class="btn btn-primary">Register as Farmer</button>
          </form>
        </div>
    </div>

    <div class="row custom-font-content">
      <div class="col-lg-6 login-card d-flex flex-column align-items-center justify-content-center" style="height: 500px;">
        <form action="{{ route('user.login') }}" method="GET">
            <input type="hidden" name="user_type" value="1">
            <button type="submit" class="btn btn-primary">login as Consumer</button>
        </form>       
        <form action="{{ route('user.login') }}" method="GET">
            <input type="hidden" name="user_type" value="2">
            <button type="submit" class="btn btn-primary">login as Farmer</button>
        </form>
      </div>
  </div>