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
<script>

    function updateClockAndDate() {
        // Update Time
        const clockElement = document.getElementById('realTimeClock');
        const now = new Date();
        const timeOptions = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true };
        clockElement.textContent = now.toLocaleTimeString('en-US', timeOptions);

        // Update Date
        const dateElement = document.getElementById('currentDate');
        const dateOptions = { weekday: 'long', month: 'short', day: 'numeric', year: 'numeric' };
        dateElement.textContent = now.toLocaleDateString('en-US', dateOptions);
    }

    // Update clock and date every second
    setInterval(updateClockAndDate, 1000);

    // Initialize clock and date
    updateClockAndDate();

</script>
</body>
</html>
