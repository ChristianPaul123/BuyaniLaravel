@if(session('message')) <!-- Check for flash message -->
<div class="notif d-flex" id="flashMessage">
    <i class="bi bi-info-square"></i>
    <div class="container-right">
        <h5 class="m-0">{{ session('message') }}</h5> <!-- Display the flash message -->
    </div>
</div>
@endif
