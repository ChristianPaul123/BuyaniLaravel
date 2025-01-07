<div class="mt-3 pt-0">
    @if (session('message'))
        <div>
            <div class="overlay" id="overlay" aria-label="Close" onclick="closePopup()"></div>

            <div class="popup error">
                <i class="close bi bi-x-lg fs-4" aria-label="Close" onclick="closePopup()"></i>
                <div class="icon-container error-bg">
                    <i class="icon bi bi-x-circle"></i>
                </div>
                <div class="container-contents">
                    <h3>Oops!</h3>
                    <p>The OTP you have inputted does not match.</p>
                </div>
            </div>
        </div>
    @endif

    {{-- Display validation errors --}}

      @if($user_type == 1)
            <div class="container-fluid custom-font-content register-background" style="padding: 20px;">

                {{-- <div class="row mt-4" style="display: flex; justify-content:center;">
                    <div class="banner p-4 rounded bg-warning text-white d-flex flex-wrap align-items-center" style="width: 1000px">
                        <div class="col-md-6 text-center text-md-start">
                            <h1 class="display-5 fw-bold">Discover Our New Product</h1>
                            <p class="mt-3">
                                Experience innovation and quality like never before.
                                Limited-time offer – don’t miss out!
                            </p>
                            <a href="#" class="btn btn-light btn-lg mt-2">Shop Now</a>
                        </div>
                        <div class="col-md-6 text-center">
                            <img
                                src="https://via.placeholder.com/400x250"
                                alt="Product Image"
                                class="img-fluid rounded"
                                style="height:250px; width:400px">
                        </div>
                    </div>
                </div> --}}

              <div class="row">
                  <div class="col-12">
                      <h2 class="text-center my-3 mx-2 head-sign">Sign Up As Consumer</h2>
                  </div>
              </div>
              <form wire:submit.prevent="register" class="my-3" style="width: 100%;" autocomplete="off">
                @csrf
                <div class="row">
                      <div class="col-lg-4 offset-lg-1 mb-4">
                          <div class="form-group my-3">
                              <label for="username">Username:</label>
                              <input type="text" wire:model="username" class="form-control" id="username" placeholder="Enter username" required>
                              @error('username') <span class="text-warning">{{ $message }}</span> @enderror
                            </div>
                          <div class="form-group my-3">
                              <label for="email">Email:</label>
                              <input type="email" wire:model="email" class="form-control" id="email" placeholder="Enter email" required>
                              @error('email') <span class="text-warning">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group my-3">
                                <label for="username">Phone Number:</label>
                                <input type="text" wire:model="phone_number" class="form-control" id="phone_number" placeholder="Enter phone number" required>
                                @error('phone_number') <span class="text-warning">{{ $message }}</span> @enderror
                            </div>
                      </div>
                      <div class="col-lg-4 offset-lg-2 mb-4">
                        <div class="form-group my-3">
                            <label for="password">Password:</label>
                            <div class="input-group">
                                <input type="password"
                                       wire:model="password"
                                       class="form-control"
                                       id="password"
                                       placeholder="Enter password"
                                       minlength="8"
                                       pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                       title="Minimum of 8 characters, a lower and upper case letter and a number."
                                       required>
                                <div class="input-group-append">
                                    <span class="input-group-text toggle-password" id="togglePassword"
                                        style="height: 100%; width: 40px; border-top-left-radius: 0px; border-bottom-left-radius: 0px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                            @error('password') <span class="text-warning">{{ $message }}</span> @enderror
                            <input type="hidden" name="user_type" value="{{ $user_type }}">
                        </div>
                        <div class="form-group my-3">
                            <label for="password2">Confirm Password:</label>
                            <div class="input-group">
                                <input type="password"
                                       wire:model="password_confirmation"
                                       class="form-control"
                                       id="password2"
                                       placeholder="Re-enter password"
                                       required>
                                <div class="input-group-append">
                                    <span class="input-group-text toggle-password" id="togglePassword"
                                        style="height: 100%; width: 40px; border-top-left-radius: 0px; border-bottom-left-radius: 0px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                            @error('password_confirmation') <span class="text-warning">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-12 d-flex flex-column justify-content-center align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="privacy">
                            <label class="form-check-label" for="privacy">I accept the <a href="{{ route('user.privacy') }}" target="_blank">Privacy Policy</a></label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="terms">
                            <label class="form-check-label" for="terms">I accept the <a href="{{ route('user.terms') }}" target="_blank">Terms and Conditions</a></label>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="row form-group my-3 d-flex justify-content-center">
                    <button id="submit-button" type="submit" class="btn btn-warning btn-block px-4" style="width: fit-content;" disabled>Sign Up</button>
                </div>
              </form>

          </div>
    @elseif($user_type == 2)
          <div class="container-fluid custom-font-content register-background" style="padding: 20px;">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-center my-3 mx-2 head-sign">Sign Up As Farmer</h2>
                </div>
            </div>
            <form wire:submit.prevent="register" class="my-3" style="width: 100%;" autocomplete="off">
              @csrf
              <div class="row">
                    <div class="col-lg-4 offset-lg-1 mb-4">
                        <div class="form-group my-3">
                            <label for="username">Username:</label>
                            <input type="text" wire:model="username" class="form-control" id="username" placeholder="Enter username" required>
                            @error('username') <span class="text-warning">{{ $message }}</span> @enderror

                        </div>
                        <div class="form-group my-3">
                            <label for="email">Email:</label>
                            <input type="email" wire:model="email" class="form-control" id="email" placeholder="Enter email" required>
                            @error('email') <span class="text-warning">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group my-3">
                            <label for="username">Phone Number:</label>
                            <input type="text" wire:model="phone_number" class="form-control" id="phone_number" placeholder="Enter phone number" required>
                            @error('phone_number') <span class="text-warning">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-lg-4 offset-lg-2 mb-4">
                        <div class="form-group my-3">
                            <label for="password">Password:</label>
                            <div class="input-group">
                                <input type="password" wire:model="password" id="password" class="form-control" placeholder="Enter password" minlength="8" required>
                                <div class="input-group-append">
                                    <span class="input-group-text toggle-password" id="togglePassword"
                                        style="height: 100%; width: 40px; border-top-left-radius: 0px; border-bottom-left-radius: 0px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </div>
                                @error('password') <span class="text-warning">{{ $message }}</span> @enderror

                            </div>
                        </div>
                        <input type="hidden" name="user_type" value="{{ $user_type }}">
                        <div class="form-group my-3">
                            <label for="password2">Confirm Password:</label>
                            <div class="input-group">
                                <input type="password" wire:model="password_confirmation" id="password2" class="form-control" placeholder="Re-enter password" required>
                                <div class="input-group-append">
                                    <span class="input-group-text toggle-password" id="togglePasswordConfirm"
                                        style="height: 100%; width: 40px; border-top-left-radius: 0px; border-bottom-left-radius: 0px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </div>
                                @error('password_confirmation') <span class="text-warning">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-12 d-flex flex-column justify-content-center align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" wire:model="policys" id="privacy">
                            <label class="form-check-label" for="privacy">I accept the <a href="{{ route('user.privacy') }}" target="_blank">Privacy Policy</a></label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" wire:model="terms" id="terms">
                            <label class="form-check-label" for="terms">I accept the <a href="{{ route('user.terms') }}" target="_blank">Terms and Conditions</a></label>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="row form-group my-3 d-flex justify-content-center">
                    <button id="submit-button" type="submit" class="btn btn-warning btn-block px-4" style="width: fit-content;" disabled>Sign Up</button>
                </div>
            </form>
          </div>
    @endif

    @if($showModal)
        <div>
            <div class="overlay" id="overlay" aria-label="Close" onclick="closePopup()"></div>

            <div class="popup input">
                <form wire:submit.prevent="verifyOtp">
                    <i class="close bi bi-x-lg fs-4" aria-label="Close" onclick="closePopup()"></i>
                    <div class="icon-container input-bg">
                        <i class="icon bi bi-send-exclamation"></i>
                    </div>
                    <div class="container-contents">
                        <h3>Please enter the OTP</h3>
                        <p>We have sent an OTP to your email at {{ $email }}.</p>
                        <input type="text" id="otp" wire:model="otp" class="form-control" maxlength="6" placeholder="Enter OTP">
                        @error('otp') <span class="text-danger">{{ $message }}</span> @enderror
                        @if (session('error')) <span class="text-danger">{{ session('error') }}</span> @endif
                        <div class="mt-3">
                            <button type="submit" class="btn btn-success">Submit OTP</button>
                            <button type="button" class="btn btn-secondary" wire:click="closeModal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>

