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
        document.getElementById('logoutButton').addEventListener('click', function (event) {
            // Show confirmation prompt
            const userConfirmed = confirm('Are you sure you want to log out?');

            // Submit form if user confirmed, otherwise do nothing
            if (userConfirmed) {
                document.getElementById('logoutForm').submit();
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
        // Show the flash message popup if it exists
        const flashPopup = document.querySelector('#flashMessage');
        if (flashPopup) {
            // Display the elements and start fade-in animation
            flashPopup.style.display = 'flex';

            // Automatically hide the popup after 3 seconds
            setTimeout(() => {
                flashPopup.classList.add('hidden');

                // After animation ends, hide the elements entirely
                setTimeout(() => {
                    flashPopup.style.display = 'none';
                }, 150); // Match the duration of the animation
            }, 3000); // 3 seconds
        }
    });
    </script>
</body>
</html>
