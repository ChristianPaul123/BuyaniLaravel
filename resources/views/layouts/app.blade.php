<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('img/logo1.svg') }}" type="image/png">
    <title>@yield('title', 'Default Title')</title> <!-- Default title fallback -->

    @include('layouts.head')
    @include('user.styles.user_styles')
    @stack('styles')
</head>

<body>
    <div class="wrapper pt-5">
        <main>
            @auth('user')
                @if (View::hasSection('x-content'))
                    @yield('x-content')
                @endif
                @yield('content')
            @else
                @if (View::hasSection('x-content'))
                    @yield('x-content')
                @else
                    <p>You are not logged in. Please log in or your session has expired.</p>
                    <p>Please <a href="{{ route('user.index') }}">log in</a> again to continue.</p>
                @endif
            @endauth
            @include('layouts.footer')
        </main>
        @yield('scripts')
    </div>
    @include('layouts.script')

    <script>
        window.addEventListener('popstate', function(event) {
            if (confirm("Are you sure you want to log out?")) {
                window.location.href = "{{ route('user.logout') }}";
            } else {
                history.pushState(null, null, window.location.href);
            }
        });
    </script>
</body>
</html>
