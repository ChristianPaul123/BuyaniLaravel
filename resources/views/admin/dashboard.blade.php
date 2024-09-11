<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('layouts.head')

    <style>
        html, body {
            height: 100%;
            margin: 0;
            overflow-x: hidden; /* Prevent horizontal scrollbar */
        }

        .custom-font-content {
            font-family: 'Poppins', sans-serif;
            font-weight: bold;
            color: aliceblue;
        }
    </style>
</head>
<body class="body">
@auth('admin')
     @include ('navBar.navbar-admin');
     <form action="{{ route('admin.logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
     <h1>Welcome to Admin Dashboard, {{ auth()->guard('admin')->user()->username }}</h1>
     @session('message')
     <div class="success-message">
         {{ session('message') }}
     </div>

    @endsession


@else
            <p>not logged in</p>   
            @session('message')
            <div class="success-message">
                {{ session('message') }}
            </div>
            @endsession
@endauth

<script>
    window.addEventListener('popstate', function(event) {
        // If the user presses the back button, log them out
        window.location.href = "{{ route('admin.logout') }}";
    });
  </script>
</body>
</html>
