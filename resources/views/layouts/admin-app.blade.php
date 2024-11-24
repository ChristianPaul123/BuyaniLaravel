<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title', 'Default Title')</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo1.svg') }}">
    @include('layouts.admin-head')
    @include('admin.styles.admin_styles')
    @stack('styles')
</head>
<body>
@auth('admin')
    @include('admin.includes.navbar')
    @yield('content')
    @yield('scripts')
@else
    <script>
        window.location.href = "{{ route('session.expire') }}";
    </script>
@endauth

    @include('layouts.admin-script')
{{-- <script>
    window.addEventListener('popstate', function(event) {
        // If the user presses the back button, log them out
        window.location.href = "{{ route('admin.logout') }}";
    });
</script> --}}
</body>
</html>
