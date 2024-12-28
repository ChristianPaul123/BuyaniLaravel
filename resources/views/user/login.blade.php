@extends('layouts.app') <!-- Extending the parent layout -->

@section('title', 'login') <!-- Defining a title for this view -->

@push('styles')
<style>
    *{
        /* border: 1px solid black; */
    }

    .a, .b, .c{
        /* border: 1px solid black; */
    }

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

    .left-side{
        margin: 30px;
    }

    .form-part {
        margin: 0 50px;
    }


    .button-login{
        border-color: #ffa500;
        background-color: #ffa500;
        color: #fff8dd;
    }

    .button{
        width: 120px;
        margin: 10px;
        border: 4px solid;
        border-radius: 10px;
        padding: 10px;
        font-weight: bold;
        transition: all 0.3s ease;
    }

    .button:hover{
        transform: scale(1.1);
    }


    @media (max-width: 768px) {
        .hide{
            display: none;
        }

        .form-part{
            margin: 0 0;
        }
    }

</style>

@include('user.includes.popup-style')
{{-- @include('user.includes.notif-style') --}}

@endpush
@section('x-content')
    @include('user.includes.navbar-consumer')
  {{-- Display success or error messages --}}
    <!--CONTENT-->
            @livewire('user.login-index', ['user_type' => request()->user_type])

            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">


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
document.addEventListener("DOMContentLoaded", function () {
    const emailPhoneInput = document.getElementById("email_phoneNum");
    const emailPhoneError = document.getElementById("emailPhoneError");
    const form = document.getElementById("loginForm");

    emailPhoneInput.addEventListener("input", function () {
        const value = emailPhoneInput.value.trim();
        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        const phoneRegex = /^\+?\d{10,15}$/;

        if (emailRegex.test(value) || phoneRegex.test(value)) {
            emailPhoneError.style.display = "none";
            emailPhoneInput.setCustomValidity("");
        } else {
            emailPhoneError.style.display = "block";
            emailPhoneInput.setCustomValidity("Invalid email or phone number format.");
        }
    });
});
</script>
{{-- @include('user.includes.notif-js') --}}
@include('user.includes.popup-js')

@endsection
