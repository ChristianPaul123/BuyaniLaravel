{{-- @if ($errors->any())
<div class="notif error d-flex alert alert-dismissible fade show" role="alert" id="flashMessage">
    <i class="fa-solid fa-face-sad-tear"></i>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif --}}


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
