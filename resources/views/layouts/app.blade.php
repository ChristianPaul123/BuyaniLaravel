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
    @auth('user')
    <div class="wrapper pt-5">
        <main>
            @if (View::hasSection('x-content'))
            {{-- If 'x-content' section is defined, show it --}}
            @yield('x-content')
        @else
        @endif
            @yield('content')
            @include('layouts.footer')
        </main>
        @yield('scripts')
    </div>
        @include('layouts.script')
    @else
    <!-- if not authenticated -->
    <div class="wrapper">
        <main>
        @if (View::hasSection('x-content'))
            {{-- If 'x-content' section is defined, show it --}}
            @yield('x-content')
            @include('layouts.footer')
        @else
            {{-- If 'x-content' section is not defined, show "not logged in" message --}}
            <p>You are not logged in. Please log in or your session have expired.</p>
            <p>Please <a href="{{ route('user.index') }}">log in</a> again to continue.</p>
        @endif
        </main>
        @yield('scripts')
    </div>
        @include('layouts.script')
    @endauth

    <script>
        window.addEventListener('popstate', function(event) {
            // If the user press the back button, log them out
            window.location.href = "{{ route('user.logout') }}";
        });

        document.addEventListener('DOMContentLoaded', function() {
            AOS.init();
        });
      </script>
</body>
</html>
