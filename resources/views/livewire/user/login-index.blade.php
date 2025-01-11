
<div class="row custom-font-content">
    <div class="col-lg-6 col-sm-12 left-div">
        <div class="left-side w-100">
            <div>

{{-- <div class="row mt-4 h-100" style="background-color: #48722e;">
    <div class="col-lg-6 col-sm-12 a d-flex align-items-center justify-content-center">
        <div class="left-side a w-100">
            <div class="a mb-5"> --}}

            @livewire('session-modal')
                <h2 class="login-as">
                    Login as {{ $user_type == 1 ? 'Consumer' : 'Farmer' }}
                </h2>
            </div>

            <form class="my-3 form-part" wire:submit.prevent="login" id="loginForm" autocomplete="off" style="margin: 100px  0px;">
                <div class="form-group my-3">
                    <label for="email">Email or Phone Number:</label>
                    <input type="text" wire:model="email_phoneNum" class="form-control" id="email_phoneNum" placeholder="Enter email or phone number" required>
                    <small id="emailPhoneError" class="text-warning" style="display: none;">Invalid email or phone number format.</small>
                    {{-- @error('email_phoneNum') <span class="text-danger">{{ $message }}</span> @enderror --}}
                </div>

                <div class="form-group mt-3 a">
                    <label for="password">Password:</label>
                    <div class="input-group">
                        <input type="password" wire:model="password" class="form-control" id="passwordField" placeholder="Enter password" required>
                        <div class="input-group-append z-10">
                            <span class="input-group-text toggle-password fix-edge" id="togglePassword" style="height: 100%; width: 40px; border-top-left-radius: 0px; border-bottom-left-radius: 0px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-eye toggleEye"></i>
                            </span>
                        </div>
                    </div>
                    <input type="hidden" wire:model="user_type" value="{{ $user_type }}" />
                </div>
                <div id="captcha" wre:model="captcha" class="mt-4" wire:ignore></div>
                @error('captcha')
                <div class="bg-red-300 text-red-700 p-3 rounded">{{ $message }}</div>
                @enderror

                <div class="form-group d-flex justify-content-end mb-3">
                    <a class="clickable-forgot-password" data-bs-toggle="modal" wire:click="showModal()"> Forgot Password?</a>
                </div>

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
                    <a class="text-white" href="{{ route('user.register', ['user_type' => $user_type]) }}">Create Account | Sign Up</a>
                </div>
            </div>

        </div>
    </div>

    <div class="col-lg-6 col-sm-12 hide" style="background-image: url('{{ $user_type == 1 ? asset('img/consumerPhoto.jpg') : asset('img/farmerPhoto.jpg') }}'); background-size: cover; background-position: center;">
        <!-- Content inside the div (if any) can go here -->
    </div>


    {{-- <div> --}}

            @if($showEmailModal)
            <div class="modal fade show d-block" tabindex="-1" role="dialog" style="background: rgba(0,0,0,0.5);">
                @include('user.includes.messageBox')
                <div class="modal-dialog modal-dialog-centered mobile-modal">
                    <div class="modal-content">
                        <i class="close bi bi-x" aria-label="Close" wire:click="$set('showEmailModal', false)" data-bs-dismiss="modal"></i>
                        <i class="icon icon-bg-info bi bi-envelope-at"></i>
                        <div class="container-contents container-contents-info">
                            <h3>Verify OTP</h3>
                            <form wire:submit.prevent="requestOtp">
                                <div class="form-group">
                                    <label for="email" class="form-label">Enter your registered email.</label>
                                    <input type="email" id="email" wire:model="selectedEmail" class="form-control" placeholder="Enter your email">
                                    @error('selectedEmail') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Send OTP</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Confirm OTP -->
            @if($showOtpModal)
            <div class="modal fade show d-block" tabindex="-1" role="dialog" style="background: rgba(0,0,0,0.5);">
                @include('user.includes.messageBox')
            <div class="modal-dialog modal-dialog-centered mobile-modal">
                <div class="modal-content">
                    <i class="close bi bi-x" aria-label="Close" wire:click="$set('showOtpModal', false)" data-bs-dismiss="modal"></i>
                    <i class="icon icon-bg-info bi bi-patch-check"></i>
                    <div class="container-contents container-contents-info">
                        <h3>Confirm OTP</h3>
                        <form wire:submit.prevent="verifyOtp">
                            <div class="form-group">

                                <label for="otp" class="form-label">Enter OTP sent to {{ $selectedEmail }}</label>
                                <input type="text" id="otp" wire:model="otp" class="form-control" placeholder="Enter OTP" width="100%">

                                @error('otp')<span class="text-danger">{{ $message }}</span>@enderror
                                {{-- @if (session()->has('error'))<span id="errorMessage" class="text-danger">{{ session('error') }}</span>@endif --}}
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Verify OTP</button>
                        </form>
                    </div>
                </div>
            </div>
            </div>
            @endif


            <!-- Change Password -->
            @if($showPasswordResetForm)
            <div class="modal fade show d-block" tabindex="-1" role="dialog" style="background: rgba(0,0,0,0.5);">
                @include('user.includes.messageBox')
            <div class="modal-dialog modal-dialog-centered mobile-modal">
                <div class="modal-content">
                    <i class="close bi bi-x" aria-label="Close" wire:click="$set('showPasswordResetForm', false)" data-bs-dismiss="modal"></i>
                    <i class="icon icon-bg-info bi bi-shield-lock"></i>
                    <div class="container-contents container-contents-info">
                        <h3>Confirm Change Password</h3>
                        <form wire:submit.prevent="resetPassword">
                            <div class="text-start">
                                <label for="newPassword" class="form-label">New Password:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control password1" id="newPassword" wire:model="newPassword" placeholder="Enter your password">
                                    {{-- <span class="input-group-text" id="togglePasswordOTP" style="cursor: pointer;">
                                        <i class="bi bi-eye" id="toggleIcon"></i>
                                    </span> --}}
                                </div>
                                @error('newPassword') <span class="text-danger">{{ $message }}</span> @enderror
                                {{-- <div style="color: red; font-size: 14px;">
                                    <span id="title" class="invalid">Must contain: </span>
                                    <span id="lowercase" class="invalid">Lowercase letter | </span>
                                    <span id="uppercase" class="invalid">Uppercase letter | </span>
                                    <span id="number" class="invalid">Number | </span>
                                    <span id="special" class="invalid">Special char | </span>
                                    <span id="length" class="invalid">8+ chars</span>
                                </div> --}}

                                <label for="newPasswordConfirmation" class="form-label mt-3">Confirm New Password:</label>
                                <input type="text" class="form-control password2" id="newPasswordConfirmation" wire:model="newPassword_confirmation" placeholder="Confirm your password">
                                @error('newPasswordConfirmation') <span class="text-danger">{{ $message }}</span> @enderror
                                {{-- <div style="color: red; font-size: 14px;">
                                    <span id="title" class="invalid">Password does not match</span>
                                </div> --}}
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Confirm New Password</button>
                        </form>
                    </div>
                </div>
            </div>
            </div>
            @endif
    {{-- </div> --}}
</div>

@assets
<script src="https://www.google.com/recaptcha/api.js?onload=handle&render=explicit"
async
defer>
</script>
@endassets

@script
@endscript

{{--CODE --}}
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

