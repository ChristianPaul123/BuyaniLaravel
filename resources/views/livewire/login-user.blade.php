<div>
    <div class="row custom-font-content">
        {{-- Error Message Display --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="col-lg-6 login-card d-flex flex-column align-items-center justify-content-center" style="height: 500px;">
            <div class="container d-flex align-items-center justify-content-center">
                @if ($user_type == 1)
                    <h2 class="text-center my-3 mx-2" style="font-size: 40px; white-space: nowrap;">Login as Consumer</h2>
                @elseif ($user_type == 2)
                    <h2 class="text-center my-3 mx-2" style="font-size: 40px; white-space: nowrap;">Login as Farmer</h2>
                @endif
            </div>

            <form class="my-3" wire:submit.prevent="login" style="width: 400px;" id="loginForm" autocomplete="off">
                <div class="form-group my-3">
                    <label for="username">Username</label>
                    <input type="text" wire:model="username" class="form-control" id="username" placeholder="Enter username" required>
                    @error('username') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group my-3">
                    <label for="password">Password:</label>
                    <div class="input-group">
                        <input type="password" wire:model="password" class="form-control" id="password" placeholder="Enter password" required>
                        <div class="input-group-append">
                            <span class="input-group-text toggle-password" style="height: 100%; width: 40px; border-top-left-radius: 0px; border-bottom-left-radius: 0px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>
                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror

                    <input type="hidden" wire:model="user_type" value="{{ $user_type }}" />
                </div>

                <div class="form-group my-3 d-flex justify-content-end">
                    <a href="forgot_password.php" class="custom-font-content" style="color: chartreuse;">Forget Password?</a>
                </div>

                <div class="container d-flex justify-content-center">
                    <button type="submit" class="btn btn-warning btn-block my-3 px-4">LOGIN</button>
                </div>
            </form>

            @if ($user_type == 1)
            <div class="text-center mt-3 my-3">
                <a href="register?user_type=1">Create Account | Sign Up</a>
            </div>
            @elseif ($user_type == 2)
            <div class="text-center mt-3 my-3">
                <a href="register?user_type=2">Create Account | Sign Up</a>
            </div>
            @endif
        </div>

        @if ($user_type == 1)
            <div class="col-lg-6 d-flex align-items-center justify-content-center p-0">
                <img src={{ asset('img/consumerPhoto.jpg') }} alt="consumer logo" style="width: 100%; height: 500px;">
            </div>
        @elseif ($user_type == 2)
            <div class="col-lg-6 d-flex align-items-center justify-content-center p-0">
                <img src="{{ asset('img/farmerPhoto.jpg') }}" alt="farmer logo" style="width: 100%; height: 500px;">
            </div>
        @endif
    </div>
</div>
