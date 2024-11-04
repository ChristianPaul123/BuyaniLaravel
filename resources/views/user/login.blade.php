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
@endsection
