@extends('layouts.app') <!-- Extending the parent layout -->

@section('title', 'register') <!-- Defining a title for this view -->

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

    /* Hide the increment and decrement buttons in WebKit browsers */
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .error-message {
        color: red;
        font-size: 0.875rem;
    }

    .message {
    position: absolute;
    top:0;
    margin:10px 0 0 0;
    width: 95%;
    background-color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    padding:2rem;
    gap:1.5rem;
    border-radius: 40px;
    z-index: 10000;
    border: 10px black;
    justify-content: space-between;
    }
    .message span{
    color:black;
    font-size: 2rem;
    }
    .message i{
    font-size: 2.5rem;
    color:red;
    cursor: pointer;
    }
    .message i:active{
    transform: rotate(90deg);
    }

    .toggle-password {
        cursor: pointer;
    }
</style>

@include('user.includes.popup-style')


@endpush
@section('x-content')
    @include('user.includes.navbar-consumer')
    @livewire('register-user',['user_type' => request()->user_type])

@endsection
@section('scripts')
<script>
    // Function to toggle password visibility for both fields
    function toggleBothPasswordFields() {
        const passwordField1 = document.getElementById('password');
        const passwordField2 = document.getElementById('password2');
        const toggleIcons = document.querySelectorAll('.toggle-password i');

        // Toggle field types and update icons
        const isPasswordVisible = passwordField1.type === 'text';
        passwordField1.type = isPasswordVisible ? 'password' : 'text';
        passwordField2.type = isPasswordVisible ? 'password' : 'text';

        // Update all toggle icons
        toggleIcons.forEach(icon => {
            icon.classList.toggle('fa-eye', isPasswordVisible);
            icon.classList.toggle('fa-eye-slash', !isPasswordVisible);
        });
    }

    // Add click event listener to both toggle elements
    document.querySelectorAll('.toggle-password').forEach(toggleElement => {
        toggleElement.addEventListener('click', toggleBothPasswordFields);
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Select the checkboxes and the submit button
        const termsCheckbox = document.getElementById("terms");
        const privacyCheckbox = document.getElementById("privacy");
        const submitButton = document.getElementById("submit-button");

        // Function to update the button state
        function updateButtonState() {
            submitButton.disabled = !(termsCheckbox.checked && privacyCheckbox.checked);
        }

        // Add event listeners to checkboxes
        termsCheckbox.addEventListener("change", updateButtonState);
        privacyCheckbox.addEventListener("change", updateButtonState);

        // Initialize the button state on page load
        updateButtonState();
    });
</script>


@include('user.includes.popup-js')

@endsection
