@if(session('message')) <!-- Check for flash message -->
<div class="notif d-flex alert alert-dismissible fade show" role="alert" id="flashMessage">
    <i class="fa-solid fa-info"></i>
    <div class="container-right">
        <h5 class="m-0">{{ session('message') }}</h5> <!-- Display the flash message -->
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if ($errors->any())
<div class="notif error d-flex alert alert-dismissible fade show" role="alert" id="flashMessage">
    <i class="fa-solid fa-face-sad-tear"></i>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session('success')) <!-- Check for flash message -->
<div class="notif success d-flex alert alert-dismissible fade show" role="alert" id="flashMessage">
    <i class="fa-solid fa-info"></i>
    <div class="container-right">
        <h5 class="m-0">{{ session('success') }}</h5> <!-- Display the flash message -->
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Clear session flash messages after rendering
        const flashMessage = document.getElementById('flashMessage');
        if (flashMessage) {
            // Clear message after the alert is dismissed or navigated back
            flashMessage.addEventListener('closed.bs.alert', function () {
                window.history.replaceState({}, document.title, window.location.pathname);
            });
        }
    });
</script>
