<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    @include('layouts.head')
    @include('user.styles.user_styles')
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .about-section {
            padding: 60px 0;
            color: white;
        }
        .team-member {
            margin-bottom: 30px;
        }
    </style>
</head>
<body style="background-image: url('{{ asset('img/stockImg4.png') }}'); background-repeat: no-repeat; background-size: cover; background-position: center;">

    <!-- NavBar -->
   @include('user.includes.navbar-consumer')

    <!-- About Us Section -->
    <div class="container about-section">
        <h2 class="text-center mb-4">Comming Soon!</h2>
    </div>

    <!-- Footer -->
    @include('layouts.footer')
    @include('layouts.script')

</body>
</html>
