<main class="row mt-4 a" style="background-color: #48722e;">
    <div class="col-lg-6 col-sm-12 a d-flex align-items-center justify-content-center" style="height: 500px;">
        <div class="left-side a w-100">
            <div class="a mb-5">

            @livewire('session-modal')


                <h2>
                    Login as {{ $user_type == 1 ? 'Consumer' : 'Farmer' }}
                </h2>
            </div>

            <form class="my-3 a form-part" wire:submit.prevent="login" id="loginForm" autocomplete="off">
                <div class="form-group my-3">
                    <label for="email">Email or Phone Number</label>
                    <input type="text" wire:model="email_phoneNum" class="form-control" id="email_phoneNum" placeholder="Enter email or phone number" required>
                    <small id="emailPhoneError" class="text-warning" style="display: none;">Invalid email or phone number format.</small>
                    {{-- @error('email_phoneNum') <span class="text-danger">{{ $message }}</span> @enderror --}}
                    @if (session()->has('error'))<span id="errorMessage" class="text-danger">{{ session('error') }}</span>@endif
                </div>

                <div class="form-group mt-3 a">
                    <label for="password">Password:</label>
                    <div class="input-group">
                        <input type="password" wire:model="password" class="form-control" id="password" placeholder="Enter password" required>
                        <div class="input-group-append z-10">
                            <span class="input-group-text toggle-password fix-edge" id="togglePassword" style="height: 100%; width: 40px;">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>
                    <input type="hidden" wire:model="user_type" value="{{ $user_type }}" />
                </div>
                {{-- <div id="captcha" wre:model="captcha" class="mt-4" wire:ignore></div>
                @error('captcha')
                <div class="bg-red-300 text-red-700 p-3 rounded">{{ $message }}</div>
                @enderror --}}

                <div class="form-group d-flex justify-content-end mb-3">
                    <a class="clickable-forgot-password" href="#" data-bs-toggle="modal" data-bs-target="#modal1">Forgot Password?</a>
                </div>
            </form>

            <form wire:submit.prevent="login" id="loginForm" autocomplete="off">
                <div class="container d-flex justify-content-center my-">
                    <button type="submit" class="button-login button my-1 px-4">LOGIN</button>
                </div>
            </form>
            <script>
                var  handle = function(e) {
                    widget = grecaptcha.render('captcha', {
                        'sitekey': '{{ env('RECAPCHA_SITEKEY') }}',
                        'theme': 'light', // you could switch between dark and light mode.
                        'callback': verify
                    });

                }
                var verify = function (response) {
                    @this.set('captcha', response)
                }
            </script>

            <div class="">
                <div class="text-center pt-3">
                    <a href="{{ route('user.register', ['user_type' => $user_type]) }}">Create Account | Sign Up</a>
                </div>
            </div>

        </div>
    </div>

    <div class="col-lg-6 col-sm-12 hide" style="background-image: url('{{ $user_type == 1 ? asset('img/consumerPhoto.jpg') : asset('img/farmerPhoto.jpg') }}'); background-size: cover; background-position: center;">
        <!-- Content inside the div (if any) can go here -->
    </div>


    <div>
        <!-- Request OTP -->
        <div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <i class="close bi bi-x" aria-label="Close" data-bs-dismiss="modal"></i>
                    <i class="icon icon-bg-info bi bi-envelope-at"></i>
                    <div class="container-contents container-contents-info">
                        <h3>Verify OTP</h3>
                        <form wire:submit.prevent="requestOtp">
                            <label for="email" class="form-label">Enter your registered email.</label>
                            <input type="email" id="email" wire:model="selectedEmail" class="form-control" placeholder="Email">
                            @error('selectedEmail') <span class="text-danger">{{ $message }}</span> @enderror
                            <button id="openModal2" type="button" class="btn btn-primary mt-3">Send OTP</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Confirm OTP -->
        <div class="modal fade" id="modal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <i class="close bi bi-x" aria-label="Close" data-bs-dismiss="modal"></i>
                    <i class="icon icon-bg-info bi bi-patch-check"></i>
                    <div class="container-contents container-contents-info">
                        <h3>Confirm OTP</h3>
                        <form wire:submit.prevent="verifyOtp">
                            <label for="email" class="form-label">Enter OTP {{ $selectedEmail }}</label>
                            <input type="text" id="otp" wire:model="otp" class="form-control" placeholder="Enter OTP">
                                @error('otp') <span class="text-danger">{{ $message }}</span> @enderror

                            <button id="openModal3" type="button" class="btn btn-primary mt-3">Send OTP</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Change Password -->
        <div class="modal fade" id="modal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <i class="close bi bi-x" aria-label="Close" data-bs-dismiss="modal"></i>
                    <i class="icon icon-bg-info bi bi-shield-lock"></i>
                    <div class="container-contents container-contents-info">
                        <h3>Confirm Change Password</h3>
                        <form wire:submit.prevent="resetPassword">
                            <div class="form-group">
                                <label for="newPassword">New Password</label>
                                <input type="password" id="newPassword" wire:model="newPassword" class="form-control" placeholder="New Password">
                                @error('newPassword') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="newPasswordConfirmation">Confirm New Password</label>
                                <input type="password" id="newPasswordConfirmation" wire:model="newPassword_confirmation" class="form-control" placeholder="Confirm New Password">
                                @error('newPasswordConfirmation') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Reset Password</button>
                        </form>
                        <form wire:submit.prevent="resetPassword">
                            <div class="text-start">
                                <label for="password" class="form-label">New Password:</label>
                                <div class="input-group">
                                    <input type="password"  wire:model="newPassword" class="form-control" id="password1" placeholder="Enter your password">
                                    <span class="input-group-text" id="togglePasswordOTP" style="cursor: pointer;">
                                        <i class="bi bi-eye" id="toggleIcon"></i>
                                    </span>
                                </div>
                                <div style="color: red; font-size: 14px;">
                                    <span id="title" class="invalid">Must contain: </span>
                                    <span id="lowercase" class="invalid">Lowercase letter | </span>
                                    <span id="uppercase" class="invalid">Uppercase letter | </span>
                                    <span id="number" class="invalid">Number | </span>
                                    <span id="special" class="invalid">Special char | </span>
                                    <span id="length" class="invalid">8+ chars</span>
                                </div>

                                <label for="password2" class="form-label mt-3">Confirm New Password:</label>
                                <input type="password" class="form-control" id="password2" placeholder="Enter your password" wire:model="newPassword_confirmation">
                                @error('newPasswordConfirmation') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <button id="openModal4" type="button" class="btn btn-primary mt-3">Confirm New Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success -->
        <div class="modal fade" id="modal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <i class="close bi bi-x" aria-label="Close" data-bs-dismiss="modal"></i>
                    <i class="icon icon-bg-success bi bi-check-circle"></i>
                    <div class="container-contents container-contents-success">
                        <h3>Password Change Successful!</h3>
                        <p>Login now with your new password</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- <div>   <!-- Step 1: Request OTP Form -->
        @if($showEmailModal)
        <div class="modal fade show d-block" tabindex="-1" role="dialog" style="background: rgba(0,0,0,0.5);">
            @if (session('message'))
            <div class="alert alert-danger text-center my-3 d-block col-12 mt-5">
                {{ session('message') }}
            </div>
            @endif
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Verify OTP</h5>
                        <button type="button" class="close" wire:click="$set('showEmailModal', false)" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="requestOtp">
                            <div class="form-group">
                                <label for="email">Enter your registered email</label>
                                <input type="email" id="email" wire:model="selectedEmail" class="form-control" placeholder="Email">
                                @error('selectedEmail') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Send OTP</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Step 2: OTP Verification Modal -->
        @if($showOtpModal)
            <div class="modal fade show d-block" tabindex="-1" role="dialog" style="background: rgba(0,0,0,0.5);">
                @if (session('message'))
                <div class="alert alert-danger text-center my-3 d-block col-12 mt-5">
                    {{ session('message') }}
                </div>
                @endif
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Verify OTP</h5>
                            <button type="button" class="close" wire:click="$set('showOtpModal', false)" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form wire:submit.prevent="verifyOtp">
                                <div class="form-group">
                                    <label for="otp">OTP</label>
                                    <input type="text" id="otp" wire:model="otp" class="form-control" placeholder="Enter OTP">
                                    @error('otp') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Verify OTP</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Step 3: Reset Password Form -->
        @if($showPasswordResetForm)
        <div class="modal fade show d-block" tabindex="-1" role="dialog" style="background: rgba(0,0,0,0.5);">
            @if (session('message'))
            <div class="alert alert-danger text-center my-3 d-block col-12 mt-5">
                {{ session('message') }}
            </div>
            @endif
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Verify OTP</h5>
                        <button type="button" class="close" wire:click="$set('showPasswordResetForm', false)" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="resetPassword">
                            <div class="form-group">
                                <label for="newPassword">New Password</label>
                                <input type="password" id="newPassword" wire:model="newPassword" class="form-control" placeholder="New Password">
                                @error('newPassword') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="newPasswordConfirmation">Confirm New Password</label>
                                <input type="password" id="newPasswordConfirmation" wire:model="newPassword_confirmation" class="form-control" placeholder="Confirm New Password">
                                @error('newPasswordConfirmation') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Reset Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div> --}}
</main>
@assets
<script src="https://www.google.com/recaptcha/api.js?onload=handle&render=explicit"
async
defer>
</script>
@endassets

@script
<script>
document.addEventListener('livewire:initialized',()=>{
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
        // Close the third modal
        let modal3 = bootstrap.Modal.getInstance(document.getElementById('modal3'));
        modal3.hide();

        // Show the fourth modal
        let modal4 = new bootstrap.Modal(document.getElementById('modal4'));
        modal4.show();
    });

    // Reset form inputs when modals are closed
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        modal.addEventListener('hidden.bs.modal', () => {
            const inputs = modal.querySelectorAll('input');
            inputs.forEach(input => {
                input.value = ''; // Clear the value
                input.classList.remove('valid-input', 'invalid-input'); // Remove validation classes
            });

            // Reset any specific validation messages
            const validationMessages = modal.querySelectorAll('.invalid, .valid');
            validationMessages.forEach(message => {
                message.classList.add('invalid'); // Reset to invalid by default
                message.classList.remove('valid');
            });

            const title = modal.querySelector('#title');
            if (title) {
                title.style.display = 'inline'; // Ensure title is shown again
            }
        });
    });

    // Password Validation
    const passwordInput = document.getElementById('password1');
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
    const togglePasswordOTP = document.getElementById('togglePasswordOTP');
    const passwordField1 = document.getElementById('password1');
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
    togglePasswordOTP.addEventListener('click', toggleVisibility);

})
</script>
@endscript
{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const siteKey = "{{ config('services.recaptcha.public_key') }}";
        // Dynamically load the Google reCAPTCHA script if it is not already loaded
        if (!window.recaptchaLoaded) {
            const script = document.createElement('script');
            script.src = 'https://www.google.com/recaptcha/api.js?render=' + siteKey;
            script.onload = () => { window.recaptchaLoaded = true; };
            document.body.appendChild(script);
        }

        // Form submission handler
        document.getElementById('loginForm').addEventListener('submit', function (e) {
            e.preventDefault();

            // Wait for Google reCAPTCHA to load, then execute it
            if (window.grecaptcha) {
                grecaptcha.execute(siteKey, { action: 'submit' }).then(function (token) {
                    // Dispatch a Livewire event with the reCAPTCHA token
                    Livewire.dispatch('formSubmitted', { token: token });
                });
            } else {
                alert('reCAPTCHA not loaded. Please try again.');
            }
        });
    });
</script> --}}
