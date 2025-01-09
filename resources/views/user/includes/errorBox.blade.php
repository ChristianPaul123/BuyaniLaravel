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
