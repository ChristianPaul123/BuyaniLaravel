<main class="row mt-4 a" style="background-color: #48722e;">
    <div class="col-lg-6 col-sm-12 a d-flex align-items-center justify-content-center" style="height: 500px;">
        <div class="left-side a w-100">
            <div class="a mb-5">

            @livewire('session-modal')

            {{-- @if (session('success'))
                <div>
                    <div class="overlay" id="overlay" aria-label="Close" onclick="closePopup()"></div>

                    <div class="popup success">
                        <i class="close bi bi-x-lg fs-4" aria-label="Close" onclick="closePopup()"></i>
                        <div class="icon-container success-bg">
                            <i class="icon bi bi-check-circle"></i>
                        </div>
                        <div class="container-contents">
                            <h3>Yay!</h3>
                            <p>{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif --}}

            {{-- <div class="container-fluid custom-font-content p-2 mt-5 d-flex">
                <nav aria-label="breadcrumb d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Role Selection</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Logging</li>
                    </ol>
                </nav>
            </div> --}}

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
                <div id="captcha" wre:model="captcha" class="mt-4" wire:ignore></div>
                @error('captcha')
                <div class="bg-red-300 text-red-700 p-3 rounded">{{ $message }}</div>
                @enderror

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
                        <form>
                            <label for="email" class="form-label">Enter your registered email.</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter your email">

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
                        <form>
                            <label for="email" class="form-label">Enter OTP sent to _NAME_</label>
                            <input type="text" class="form-control" id="text" placeholder="Enter OTP">

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
                        <form>
                            <div class="text-start">
                                <label for="password" class="form-label">New Password:</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" placeholder="Enter your password">
                                    <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
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
                                <input type="password" class="form-control" id="password2" placeholder="Enter your password">
                                <div style="color: red; font-size: 14px;">
                                    <span id="title" class="invalid">Password does not match</span>
                                </div>
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
