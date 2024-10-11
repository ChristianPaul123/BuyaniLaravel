<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('layouts.head')

    @include ('user.styles.user_styles');

</head>
<body class="body">
@auth('user')
     @include ('user.includes.navbar-farmer');
     <form action="{{ route('user.logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
     <h1>Welcome to Farmer Dashboard, {{ auth()->guard('user')->user()->username }}</h1>
     @session('message')
     <div class="success-message">
         {{ session('message') }}
     </div>

    @endsession


@else
            <p>not logged in</p>

@endauth

<script>
    window.addEventListener('popstate', function(event) {
        // If the user press the back button, log them out
        window.location.href = "{{ route('user.logout') }}";
    });
  </script>

@include('layouts.script')
@include ('layouts.footer')
</body>
</html>
