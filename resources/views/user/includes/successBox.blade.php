@if(session('success')) <!-- Check for flash message -->
<div class="notif success d-flex alert alert-dismissible fade show" role="alert" id="flashMessage">
    <i class="fa-solid fa-info"></i>
    <div class="container-right">
        <h5 class="m-0">{{ session('success') }}</h5> <!-- Display the flash message -->
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
