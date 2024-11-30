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

<style>
    @keyframes fadeInDown {
        from {
            transform: translate(-50%, -55%); /* Start from above the screen */
            opacity: 0;
        }
        to {
            transform: translate(-50%, -50%); /* Center in the screen */
            opacity: 1;
        }
    }

    @keyframes fadeOutUp {
        from {
            transform: translate(-50%, -50%); /* Start from center */
            opacity: 1;
        }
        to {
            transform: translate(-50%, -55%); /* Move up to above the screen */
            opacity: 0;
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 0.6;
        }
    }

    @keyframes fadeOut {
        from {
            opacity: 0.6;
        }
        to {
            opacity: 0;
        }
    }

    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        z-index: 999;
        animation: fadeIn 0.2s ease-out forwards; /* Fade in animation for the overlay */
    }

    .overlay.hidden {
        animation: fadeOut 0.2s ease-in forwards; /* Fade out animation for the overlay */
    }

    .popup {
        width: 400px;
        background-color: #ffffff;
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
        animation: fadeInDown 0.3s ease-out forwards; /* Slide down animation for the modal */
    }

    .popup.hidden {
        animation: fadeOutUp 0.3s ease-in forwards; /* Slide up animation for the modal */
    }

    .container-contents {
        padding: 20px;
    }

    .popup .icon-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 120px;
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

    .popup button:hover {
        background-color: #e0a800;
    }

    .icon-container .icon {
        color: #ffffff;
    }

    .popup .close {
        color: #fff;
        position: absolute;
        top: 10px;
        right: 10px;
    }

    .min-height {
        min-height: 100vh;
    }

    .clickable-forgot-password
    {
        cursor: pointer;
        color: rgb(255, 255, 255)
    }

    .clickable-forgot-password:hover {
        color: rgba(244, 225, 22, 0.974)
    }
</style>

<style>
    .error{
        color: #842029;
    }
    .error-bg{
        background-color: #e85e6c;
    }

    .success{
        color: #208428;
    }
    .success-bg{
        background-color: #42dc3d;
    }
</style>


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
    function closePopup() {
        const overlay = document.getElementById('overlay');
        const popup = document.querySelector('.popup');

        // Add the hidden class to trigger the fade-out animation
        overlay.classList.add('hidden');
        popup.classList.add('hidden');

        // After animation ends, hide the elements entirely
        setTimeout(() => {
            overlay.style.display = 'none';
            popup.style.display = 'none';
        }, 300); // Match the duration of the animation
    }

    function showPopup() {
        const overlay = document.getElementById('overlay');
        const popup = document.querySelector('.popup');

        // Show elements and remove hidden class for fade-in animation
        overlay.style.display = 'block';
        popup.style.display = 'block';
        overlay.classList.remove('hidden');
        popup.classList.remove('hidden');
    }
</script>

@endsection
