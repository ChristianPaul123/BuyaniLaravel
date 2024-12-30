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
    #password {
        transition: border-color 0.3s, box-shadow 0.3s;
    }
    #password.invalid-input {
        border-color: red;
        box-shadow: 0 0 5px red;
    }
    #password.valid-input {
        border-color: green;
        box-shadow: 0 0 5px green;
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

{{-- OTP Modal --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
<script>
    // JavaScript to handle modal transitions
    document.getElementById('openModal2').addEventListener('click', function () {
        // Close the first modal
        let modal1 = bootstrap.Modal.getInstance(document.getElementById('modal1'));
        modal1.hide();

        // Show the second modal
        let modal2 = new bootstrap.Modal(document.getElementById('modal2'));
        modal2.show();
    });

    document.getElementById('openModal3').addEventListener('click', function () {
        // Close the second modal
        let modal2 = bootstrap.Modal.getInstance(document.getElementById('modal2'));
        modal2.hide();

        // Show the third modal
        let modal3 = new bootstrap.Modal(document.getElementById('modal3'));
        modal3.show();
    });

    document.getElementById('openModal4').addEventListener('click', function () {
        // Close the second modal
        let modal2 = bootstrap.Modal.getInstance(document.getElementById('modal3'));
        modal2.hide();

        // Show the third modal
        let modal3 = new bootstrap.Modal(document.getElementById('modal4'));
        modal3.show();
    });






    // Password Valiation
    const passwordInput = document.getElementById('password');
    const lowercase = document.getElementById('lowercase');
    const uppercase = document.getElementById('uppercase');
    const number = document.getElementById('number');
    const special = document.getElementById('special');
    const length = document.getElementById('length');
    const title = document.getElementById('title');

    passwordInput.addEventListener('input', () => {
        const value = passwordInput.value;

        // Flags for validation
        const isLowercaseValid = /[a-z]/.test(value);
        const isUppercaseValid = /[A-Z]/.test(value);
        const isNumberValid = /[0-9]/.test(value);
        const isSpecialValid = /[!@#$%^&*(),.?":{}|<>]/.test(value);
        const isLengthValid = value.length >= 8;

        // Update criteria indicators
        toggleValidation(lowercase, isLowercaseValid);
        toggleValidation(uppercase, isUppercaseValid);
        toggleValidation(number, isNumberValid);
        toggleValidation(special, isSpecialValid);
        toggleValidation(length, isLengthValid);

        // Update input box aura
        if (isLowercaseValid && isUppercaseValid && isNumberValid && isSpecialValid && isLengthValid) {
            passwordInput.classList.add('valid-input');
            passwordInput.classList.remove('invalid-input');
            title.style.display = 'none';  // Hide the title when all conditions are met
        } else {
            passwordInput.classList.add('invalid-input');
            passwordInput.classList.remove('valid-input');
            title.style.display = 'inline'; // Show the title when conditions are not met
        }
    });

    function toggleValidation(element, isValid) {
        if (isValid) {
            element.classList.add('valid');
            element.classList.remove('invalid');
        } else {
            element.classList.add('invalid');
            element.classList.remove('valid');
        }
    }





    // Confirm Password Validation
    const confirmPasswordInput = document.getElementById('password2');
    const passwordMismatchMessage = document.querySelector('#password2 + div span');

    // Function to check password match
    function validatePasswordMatch() {
        const passwordValue = passwordInput.value;
        const confirmPasswordValue = confirmPasswordInput.value;

        // Check if passwords match
        if (passwordValue === confirmPasswordValue && passwordValue !== "") {
            confirmPasswordInput.classList.add('valid-input');
            confirmPasswordInput.classList.remove('invalid-input');
            passwordMismatchMessage.style.display = 'none'; // Hide the mismatch message
        } else if (confirmPasswordValue !== "") {
            confirmPasswordInput.classList.add('invalid-input');
            confirmPasswordInput.classList.remove('valid-input');
            passwordMismatchMessage.style.display = 'inline'; // Show the mismatch message
        }

        // If both fields are empty, reset the styles and message
        if (!passwordValue && !confirmPasswordValue) {
            confirmPasswordInput.classList.remove('valid-input', 'invalid-input');
            passwordMismatchMessage.style.display = 'none';
        }
    }

    // Event listeners for both password inputs
    passwordInput.addEventListener('input', validatePasswordMatch);
    confirmPasswordInput.addEventListener('input', validatePasswordMatch);





    // Toggle Password
    const togglePassword = document.getElementById('togglePassword');
    const passwordField1 = document.getElementById('password');
    const passwordField2 = document.getElementById('password2');
    const toggleIcon = document.getElementById('toggleIcon');

    // Function to toggle visibility for both fields
    function toggleVisibility() {
        const type1 = passwordField1.getAttribute('type') === 'password' ? 'text' : 'password';
        const type2 = passwordField2.getAttribute('type') === 'password' ? 'text' : 'password';

        // Set both fields' type to text or password
        passwordField1.setAttribute('type', type1);
        passwordField2.setAttribute('type', type2);

        // Toggle the icon
        toggleIcon.classList.toggle('bi-eye');
        toggleIcon.classList.toggle('bi-eye-slash');
    }

    // Add event listener to toggle both password fields
    togglePassword.addEventListener('click', toggleVisibility);

</script>

@include('user.includes.popup-js')

@endsection
