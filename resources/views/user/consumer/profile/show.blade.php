@extends('layouts.app') <!-- Extending the parent layout -->

@section('title', 'Profile page') <!-- Defining a title for this view -->

@push('styles')
<style>
    /* Profile Section Styling */
    .profile-section, .photo-section {
        background-color: #ffffff;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: box-shadow 0.3s ease;
        word-wrap: break-word;
    }

    .shipping-container {
        border-radius: 8px;
        border: 1px solid #e0e0e0;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        height: 300px;
        overflow-y: auto; /* Enables vertical scrolling */
    }

    .shipping-info{
        border: 1px solid black;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }


    .profile-section h4 {
        font-size: 1.5rem;
        color: #4a4a4a;
        margin-bottom: 20px;
        display: inline-block;
        font: bol
    }

    .profile-section:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
    }

    /* List Group Styling */
    .list-group {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .list-group-item {
        background-color: #ffffff;
        border: none;
        padding: 10px 15px;
        font-size: 1rem;
        border-bottom: 1px solid #eaeaea;
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: #555;
    }

    .list-group-item:last-child {
        border-bottom: none;
    }

    /* Highlight Status */
    .list-group-item span {
        font-weight: bold;
        color: #00aaff;
    }

    .profile-pic {
      width: 100px;
      height: 100px;
      object-fit: cover;
      border-radius: 50%;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .profile-pic:hover {
      transform: scale(1.1);
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
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
    }

    *{
        /* border: 1px solid black; */
    }

</style>
@endpush
@section('content')
    @include('user.includes.navbar-consumer')
    @include('user.styles.messageBox_styles');
    <section style="min-height: 100vh;">
    <div class="container my-5">
        <!-- Tab Navigation -->
        <ul class="nav nav-tabs" id="ConsumerTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true">
                    Consumer Profile
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="address-tab" data-bs-toggle="tab" data-bs-target="#address" type="button" role="tab" aria-controls="address" aria-selected="false">
                    Shipping Address
                </button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content mt-4" id="ConsumerTabsContent">
            <!-- Consumer Profile Tab -->
            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                {{-- <livewire:consumer-profile /> --}}
                @livewire('consumer.consumer-profile')
            </div>

            <!-- Consumer Address Tab -->
            <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                {{-- <livewire:consumer-address /> --}}
                @livewire('consumer.consumer-address')
            </div>

        </div>
    </div>
    </section>
@endsection
@section('scripts')
<script>

    // Password Validation
        const passwordInput = document.getElementById('newPassword');
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
        const confirmPasswordInput = document.getElementById('confirmPassword');
        const passwordMismatchMessage = document.querySelector('#confirmPassword + div span');

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
</script>
@endsection
