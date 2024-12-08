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
    .head-sign{
        font-size: 40px;
    }



    @media (max-width: 576px) {
        /* Adjust the container padding for smaller screens */
        .container-fluid.custom-font-content {
            padding: 10px;
        }

        /* Make text and titles smaller for better readability on mobile */
        .custom-font-content h1, .custom-font-content h2, .custom-font-content h3 {
            font-size: 1.5rem;
            text-align: center;
        }

        /* Adjust form elements for mobile */
        .form-group {
            margin-bottom: 15px;
        }

        .form-control {
            font-size: 1rem;
            padding: 10px;
        }

        .btn {
            width: 100%;
            font-size: 1.2rem;
        }

        /* Adjust the breadcrumb text size and positioning */
        .breadcrumb {
            font-size: 0.9rem;
        }

        .breadcrumb-item {
            display: block;
        }

        /* Stack the image and text in the banner for smaller screens */
        .banner {
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .banner img {
            width: 100%;
            height: auto;
        }

        /* Make the password toggle icons larger and more touch-friendly */
        .toggle-password i {
            font-size: 1.5rem;
        }

        /* Style the error message popup for smaller screens */
        .message {
            width: 90%;
            left: 5%;
            padding: 1rem;
        }

        .message span {
            font-size: 1.5rem;
        }

        .message i {
            font-size: 2rem;
        }

        /* Ensure the modal popup is responsive */
        .popup {
            width: 80%;
        }

        /* Make checkboxes smaller and more aligned */
        .form-check-input {
            width: 20px;
            height: 20px;
        }

        .form-check-label {
            font-size: 1rem;
        }
        .head-sign {
            font-size: 1rem;
        }
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
