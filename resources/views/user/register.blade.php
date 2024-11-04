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
@endpush
@section('x-content')
    @include('user.includes.navbar-consumer')
    @livewire('register-user',['user_type' => request()->user_type])

@endsection
@section('scripts')
<script>

        //Toggle function for password fields
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
    document.getElementById('togglePasswordConfirm').addEventListener('click', function () {
        togglePasswordVisibility('password2', this);
    });

    // document.getElementById('togglePasswordfarm').addEventListener('click', function () {
    //     togglePasswordVisibility('password3', this);
    // });

    // document.getElementById('togglePasswordfarmConfirm').addEventListener('click', function () {
    //     togglePasswordVisibility('password4', this);
    // });
</script>
@endsection
