@extends('layouts.app') <!-- Extending the parent layout -->

@section('title', 'Login') <!-- Defining a title for this view -->

@push('styles')
<style>
    *{
        /* border: 1px solid black; */
    }

     .custom-font-content {
        font-family: 'Poppins', sans-serif;
        font-weight: bold;
        color: aliceblue;
        background-color: #3f6f23;
        height: 100vh;
    }

    .left-div{
        height: auto;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .form-control:focus {
        box-shadow: none;
    }

    .toggle-password {
        cursor: pointer;
    }

    .left-side{

        padding: 0px 50px;
        height: 70%;
        margin: 30px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
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

    .login-as {
        font-size: 45px;
        text-align: center;
    }




    @media (max-width: 768px) {
        .hide{
            display: none;
        }

        .form-part{
            margin: 0 0;
        }

        .custom-font-content {
            height: auto;
            padding: 20px;
        }

        .left-side{
            text-align: start;
            padding: 0px 0px;
        }

        .login-as {
            margin-top: -50px;
            font-size: 2.0rem;
        }

        .mobile-modal {
            width: 95% !important;
        }

        .bottom-fix{
            margin-bottom: 50px;
        }

    }



    /* OTP Modal */
    .modal-dialog {
        width: 420px;
    }

    .close {
        font-size: 40px;
        cursor: pointer;
        position: absolute;
        display: flex;
        top: 0;
        right: 0;
        color: white;
    }

    .icon {
        width: 100%;
        height: 100px;
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 60px;
        border-top-left-radius: 7px;
        border-top-right-radius: 7px;
    }

    .container-contents {
        height: auto;
        display: flex;
        flex-direction: column;
        padding: 15px 30px 10px 35px;
        gap: 5px;
        text-align: center;
        justify-content: center;
        overflow: hidden;
    }

    /* Styles for different modals */
    .icon-bg-error {
        background-color: #e85e6c;
    }

    .container-contents-error {
        color: #842029;
    }

    .icon-bg-success {
        background-color: #4caf50;
    }

    .container-contents-success {
        color: #155724;
    }

    .icon-bg-info {
        background-color: #ffc107;
    }

    .container-contents-info {
        color: #b28704;
    }


    /* Password Validation */

    .valid-input {
        border-color: green !important;
        box-shadow: 0 0 5px green !important;
    }

    .invalid-input {
        border-color: red !important;
        box-shadow: 0 0 5px red !important;
    }

    .valid {
        display: none;
    }
    .invalid {
        display: inline;
        color: red;
    }
</style>

@include('user.includes.popup-style')
{{-- @include('user.includes.notif-style') --}}
{{-- @include('user.styles.messageBox_styles'); --}}

@endpush
@section('x-content')
    @include('user.includes.navbar-consumer')
  {{-- Display success or error messages --}}
    <!--CONTENT-->
            @livewire('user.login-index', ['user_type' => request()->user_type])

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

    // Event listener for the password toggle icon
    document.getElementById('togglePassword').addEventListener('click', function () {
        togglePasswordVisibility('passwordField', this);
    });

    function togglePasswords() {
        // Toggle the visibility of both password fields
        togglePasswordVisibility('newPassword');
        togglePasswordVisibility('newPasswordConfirmation');

        const icon = document.getElementById('toggleIcon');
        if (icon) {
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        }
    }

    function togglePasswordVisibility(inputId) {
        const input = document.getElementById(inputId);
        if (input) {
            // Toggle the input type between password and text
            input.type = input.type === "password" ? "text" : "password";
        }
    }
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const emailPhoneInput = document.getElementById("email_phoneNum");
    const emailPhoneError = document.getElementById("emailPhoneError");
    const form = document.getElementById("loginForm");

    emailPhoneInput.addEventListener("input", function () {
        const value = emailPhoneInput.value.trim();
        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        const phoneRegex = /^(?:\+63|09|\d{1})\d{9}$/;

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

{{-- OTP Modal --}}


@include('user.includes.popup-js')

@endsection
