<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title', 'Default Title')</title>
    <link rel="icon" href="{{ asset('img/logo1.svg') }}" type="image/png">
    @include('layouts.admin-head')
    @include('admin.styles.admin_styles')
    @stack('styles')
</head>
<body>
@auth('admin')
    <section class="min-height">
    @include('admin.includes.navbar')
    @yield('content')
    @yield('scripts')
    </section>
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
