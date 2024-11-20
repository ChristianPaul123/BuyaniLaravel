<div class="d-flex flex-row mt-5 pt-3" >

    <div class="col-lg-6 login-card d-flex flex-column align-items-center justify-content-center" style="height: 500px;">
        <div class="container d-block align-items-center">

            @if (session('message'))
            <div>
                <style>
                    .overlay {
                        position: fixed;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        background-color: rgba(0, 0, 0, 0.6);
                        z-index: 999;
                    }

                    .error-popup {
                        width: 400px;
                        background-color: #ffffff;
                        color: #842029;
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
                    }

                    .container-contents {
                        padding: 20px;
                    }

                    .error-popup .error-icon {
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        height: 120px;
                        background-color: #e85e6c;
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

                    .error-popup button:hover {
                        background-color: #e0a800;
                    }

                    .error-icon .bi-x-circle {
                        color: #ffffff;
                    }

                    .error-popup .bi-x-lg {
                        color: #fff;
                        position: absolute;
                        top: 10px;
                        right: 10px;
                    }
                </style>

                <div class="overlay" id="overlay" aria-label="Close" onclick="closePopup()"></div>

                <div class="error-popup">
                    <i class="bi bi-x-lg fs-4" aria-label="Close" onclick="closePopup()"></i>
                    <div class="error-icon">
                        <i class="bi bi-x-circle"></i>
                    </div>
                    <div class="container-contents">
                        <h3>Ooops!</h3>
                        <p>{{ session('message') }}</p>
                        {{-- <button onclick="">Button</button> --}}
                    </div>
                </div>

                {{-- <script>
                    function closePopup() {
                        document.querySelector('.error-popup').style.display = 'none';
                        document.querySelector('.overlay').style.display = 'none';
                    }
                </script> --}}

            </div>
            @endif
            <div class="container-fluid custom-font-content p-2 mt-5 d-flex">
                <nav aria-label="breadcrumb d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Role Selection</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Logging</li>
                    </ol>
                </nav>
            </div>

            <h2 class="text-center my-3 mx-2" style="font-size: 40px; white-space: nowrap;">
                Login as {{ $user_type == 1 ? 'Consumer' : 'Farmer' }}
            </h2>
        </div>

        <form class="my-3" wire:submit.prevent="login" style="width: 400px;" id="loginForm" autocomplete="off">
            <div class="form-group my-3">
                <label for="email">Email</label>
                <input type="email" wire:model="email" class="form-control" id="email" placeholder="Enter email" required>
                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
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

                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                <input type="hidden" wire:model="user_type" value="{{ $user_type }}" />
            </div>

             <div class="form-group my-1 d-flex justify-content-end">
                <a wire:click.prevent="showModal()"> Forgot Password?</a>
            </div>

            <div class="container d-flex justify-content-center">
                <button type="submit" class="btn btn-warning btn-block my-1 px-4">LOGIN</button>
            </div>
        </form>

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
                                <input type="email" id="email" wire:model="email" class="form-control" placeholder="Email">
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
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
