<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('img/logo1.svg') }}" type="image/png">
    <title>@yield('title', 'Default Title')</title> <!-- Default title fallback -->
    <!-- Insert the SEO tags -->
    {{-- {!! seo() !!} --}}
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
            <!-- Modal for confirmation -->
            <div id="logoutModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true" data-bs-backdrop="static" style="z-index: -1;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header justify-content-between">
                            <h5 class="modal-title">Logout Confirmation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to logout?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-danger" id="confirmLogout">Confirm Logout</button>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </main>
        @yield('scripts')


    </div>
    @include('layouts.script')

    <script>
        $('#logoutButton').on('click', function() {
            $('#logoutModal').modal('show');
        });


        $('#logoutModal').on('show.bs.modal', function(event) {
            $('#logoutModal').css('z-index', 1051);
            document.getElementById('confirmLogout').addEventListener('click', function(event) {
                document.getElementById('logoutForm').submit();
            });
        });

        $('#logoutModal').on('hidden.bs.modal', function(event) {
            $('#logoutModal').css('z-index', -1);
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
