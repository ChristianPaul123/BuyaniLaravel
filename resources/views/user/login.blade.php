@extends('layouts.app') <!-- Extending the parent layout -->

@section('title', 'login') <!-- Defining a title for this view -->

@push('styles')
<style>
     .custom-font-content {
        font-family: 'Poppins', sans-serif;
        font-weight: bold;
        color: aliceblue;
        background-color: #3F6F23;
        color: #fff;
    }

    .form-control:focus {
        box-shadow: none;
    }

    .toggle-password {
        cursor: pointer;
    }
</style>

<style>
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        z-index: 999;
    }

    .error-popup {
        width: 400px;
        background-color: #ffffff;
        color: #842029;
        border: 1px solid black;
        border-radius: 5px;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        z-index: 1000;
    }

    .container-contents {
        padding: 20px;
    }

    .error-popup .error-icon {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 120px;
        background-color: #e85e6c;
        font-size: 60px;
    }

    button {
        background-color: #ffc107;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }

    .error-popup button:hover {
        background-color: #e0a800;
    }

    .error-icon .bi-x-circle {
        color: #ffffff;
    }

    .error-popup .bi-x-lg {
        color: #fff;
        position: absolute;
        top: 10px;
        right: 10px;
    }
</style>

@endpush
@section('x-content')
    @include('user.includes.navbar-consumer')
  {{-- Display success or error messages --}}
    <!--CONTENT-->
            @livewire('login-user', ['user_type' => request()->user_type])

@endsection

@section('scripts')
<script>
    function togglePasswordVisibility(passwordFieldId, toggleIcon) {
        const passwordField = document.getElementById(passwordFieldId);
        const icon = toggleIcon.querySelector('i');

        // Toggle the password field type and icon class
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            passwordField.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }

        // Event listeners for the password toggle icons
        document.getElementById('togglePassword').addEventListener('click', function () {
        togglePasswordVisibility('password', this);
    });
</script>

<script>
    function closePopup() {
        document.querySelector('.error-popup').style.display = 'none';
        document.querySelector('.overlay').style.display = 'none';
    }
</script>

@endsection
