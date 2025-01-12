{{-- @if(session('success')) <!-- Check for flash message -->
<div class="notif success d-flex alert alert-dismissible fade show" role="alert" id="flashMessage">
    <i class="fa-solid fa-info"></i>
    <div class="container-right">
        <h5 class="m-0">{{ session('success') }}</h5> <!-- Display the flash message -->
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif --}}


@if(session('success')) <!-- Check for flash message -->
<div class="notif success d-flex alert alert-dismissible fade show notif-success" role="alert" id="flashMessage">
    <div class="container1 container-success">
        <i class="fa-solid fa-info icon-modal"></i>
    </div>
    <div class="container2">
        <h2 class="m-0 pl-2" style="color: black; font-size: 1rem;">{{ session('success') }}</h2> <!-- Display the flash message -->
    </div>
    <i class="bi bi-x exit-modal" role="button" data-bs-dismiss="alert" aria-label="Close"></i>
</div>
@endif
