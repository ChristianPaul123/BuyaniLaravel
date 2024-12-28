<div class="d-flex flex-row mt-3 pt-0" >
    <div class="col-lg-6 login-card d-flex flex-column align-items-center justify-content-center" style="height: 500px;">
        <div class="container d-block align-items-center">

            @livewire('session-modal')

            <h2 class="text-center my-3 mx-2" style="font-size: 40px; white-space: nowrap;">
                Login as {{ $user_type == 1 ? 'Consumer' : 'Farmer' }}
            </h2>
        </div>

        <form class="my-3" wire:submit.prevent="login" style="width: 400px;" id="loginForm" autocomplete="off">
            <div class="form-group my-3">
                <label for="email">Email or Phone Number</label>
                <input type="text" wire:model="email_phoneNum" class="form-control" id="email_phoneNum" placeholder="Enter email or phone number" required>
                <small id="emailPhoneError" class="text-warning" style="display: none;">Invalid email or phone number format.</small>
                {{-- @error('email_phoneNum') <span class="text-danger">{{ $message }}</span> @enderror --}}
                @if (session()->has('error'))<span id="errorMessage" class="text-danger">{{ session('error') }}</span>@endif
            </div>

            <div class="form-group my-3">
                <label for="password">Password:</label>
                <div class="input-group">
                    <input type="password" wire:model="password" class="form-control" id="password" placeholder="Enter password" required>
                    <div class="input-group-append">
                        <span class="input-group-text toggle-password" id="togglePassword" style="height: 100%; width: 40px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                </div>
                <input type="hidden" wire:model="user_type" value="{{ $user_type }}" />
            </div>
            <div id="captcha" wre:model="captcha" class="mt-4" wire:ignore></div>
            @error('captcha')
            <div class="bg-red-300 text-red-700 p-3 rounded">{{ $message }}</div>
            @enderror

             <div class="form-group my-1 d-flex justify-content-end">
                <a class="clickable-forgot-password" wire:click.prevent="showModal()"> Forgot Password?</a>
            </div>

            <div class="container d-flex justify-content-center">
                <button type="submit" class="btn btn-warning btn-block my-1 px-4">LOGIN</button>
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


        <div class="text-center">
            <a href="{{ route('user.register', ['user_type' => $user_type]) }}">Create Account | Sign Up</a>
        </div>
    </div>

    <div class="col-lg-6 d-flex align-items-center justify-content-center p-0">
        <img src="{{ $user_type == 1 ? asset('img/consumerPhoto.jpg') : asset('img/farmerPhoto.jpg') }}" alt="{{ $user_type == 1 ? 'consumer' : 'farmer' }} logo" style="width: 100%; height: 500px;">
    </div>

    <div>   <!-- Step 1: Request OTP Form -->
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
    </div>
</div>
@assets
<script src="https://www.google.com/recaptcha/api.js?onload=handle&render=explicit"
async
defer>
</script>
@endassets

@script
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
