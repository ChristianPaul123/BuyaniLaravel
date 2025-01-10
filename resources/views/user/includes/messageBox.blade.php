@if(session('message')) <!-- Check for flash message -->
<div class="notif d-flex alert alert-dismissible fade show notif-message" role="alert" id="flashMessage">
    <div class="container1 container-message">
        <i class="fa-solid fa-info icon-modal"></i>
    </div>
    <div class="container2">
        <h5 class="m-0 p-2" style="color: black; font-size: 1rem;">{{ session('message') }}</h5> <!-- Display the flash message -->
    </div>
    <i class="bi bi-x exit-modal" role="button" data-bs-dismiss="alert" aria-label="Close"></i>
</div>
@endif

@if ($errors->any())
<div class="notif error d-flex alert alert-dismissible fade show notif-error" role="alert" id="flashMessage">
    <div class="container1 container-error">
        <i class="bi bi-emoji-frown icon-modal"></i>
    </div>
    <div class="container2">
        {{-- <ul> --}}
            @foreach ($errors->all() as $error)
                {{-- <li>{{ $error }}</li> --}}
                <h5 class="m-0 p-2" style="color: black; font-size: 1rem;">{{ $error }}</h5> <!-- Display the flash message -->
            @endforeach
        {{-- </ul> --}}
    </div>
    <i class="bi bi-x exit-modal" role="button" data-bs-dismiss="alert" aria-label="Close"></i>
</div>
@endif

@if(session('success')) <!-- Check for flash message -->
<div class="notif success d-flex alert alert-dismissible fade show notif-success" role="alert" id="flashMessage">
    <div class="container1 container-error">
        <i class="fa-solid fa-info icon-modal"></i>
    </div>
    <div class="container2">
        <h2 class="m-0 pl-2" style="color: black; font-size: 1rem;">{{ session('success') }}</h2> <!-- Display the flash message -->
    </div>
    <i class="bi bi-x exit-modal" role="button" data-bs-dismiss="alert" aria-label="Close"></i>
</div>
@endif
