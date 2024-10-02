<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <title>Admin | Management</title>
    <link rel="icon" type="image/png" href="../img/logo1.svg">
    @include('layouts.head')
    @include('admin.styles.admin_styles')

</head>
<body class="body">
@auth('admin')
    @include('admin.includes.navbar')


     <div class="container-fluid">
        <div class="row">


        @include('admin.includes.sidebar')

            <section role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Management</h1>
                </div>

            </section>
        </div>
    </div>
     <form action="{{ route('admin.logout') }}" method="POST">
        {{-- @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
     <h1>Welcome to Admin Dashboard, {{ auth()->guard('admin')->user()->username }}</h1> --}}
     @session('message')


    @endsession


@else
            <p>not logged in</p>
            @session('message')
            <div class="success-message">
                {{ session('message') }}
            </div>
            @endsession
@endauth
    @include('layouts.script')
<script>
    window.addEventListener('popstate', function(event) {
        // If the user presses the back button, log them out
        window.location.href = "{{ route('admin.logout') }}";
    });
  </script>
</body>
</html>
