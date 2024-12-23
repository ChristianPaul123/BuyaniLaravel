<div>
    <div class="container-fluid custom-font-content p-3">
        <nav aria-label="breadcrumb d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Role Selection</a></li>
                <li class="breadcrumb-item active" aria-current="page">Registration</li>
            </ol>
        </nav>
    </div>

    {{-- Display success or error messages --}}
    {{-- @if($message)
    <div class="alert alert-danger text-center my-3">{{ $message }}</div>
    @endif --}}

    @if (session('message'))
    <div class="alert alert-danger text-center my-3 d-block position-absolute col-12">
        {{ session('message') }}
    </div>
    @endif

    {{-- Display validation errors --}}

      @if($user_type == 1)

            <div class="container-fluid custom-font-content" style="padding: 20px;">
              <div class="row">
                  <div class="col-12">
                      <h2 class="text-center my-3 mx-2" style="font-size: 40px; white-space: nowrap;">Sign Up As Consumer</h2>
                  </div>
              </div>
              <form wire:submit.prevent="register" class="my-3" style="width: 100%;" autocomplete="off">
                @csrf
                <div class="row">
                      <div class="col-lg-4 offset-lg-1 mb-4">
                          <div class="form-group my-3">
                              <label for="username">Username</label>
                              <input type="text" wire:model="username" class="form-control" id="username" placeholder="Enter username" required>
                              @error('username') <span class="text-warning">{{ $message }}</span> @enderror
                            </div>
                          <div class="form-group my-3">
                              <label for="email">Email</label>
                              <input type="email" wire:model="email" class="form-control" id="email" placeholder="Enter email" required>
                              @error('email') <span class="text-warning">{{ $message }}</span> @enderror
                            </div>
                      </div>
                      <div class="col-lg-4 offset-lg-2 mb-4">
                          <div class="form-group my-3">
                              <label for="password">Password:</label>
                              <div class="input-group">
                                  <input type="password" wire:model="password" class="form-control" id="password" placeholder="Enter password" minlength="8" required>
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
                                  <input type="password" wire:model="password_confirmation" class="form-control" id="password2" placeholder="Re-enter password" required>
                                  <div class="input-group-append">
                                        <span class="input-group-text toggle-password" id="togglePasswordConfirm"
                                        style="height: 100%; width: 40px; border-top-left-radius: 0px; border-bottom-left-radius: 0px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-eye"></i>
                                        </span>
                                  </div>
                            </div>
                            @error('password_confirmation') <span class="text-warning">{{ $message }}</span> @enderror
                          </div>
                      </div>
                  </div>
                  <!-- Submit Button -->
                  <div class="row form-group my-3 d-flex justify-content-center">
                      <button type="submit" class="btn btn-warning btn-block px-4" style="width: fit-content;">Sign Up</button>
                  </div>
              </form>
              {{-- <div class="row">
                  <div class="col text-end mt-3 my-4">
                      <a href="../login/consumer-login.php">Has account? | Sign In</a>
                  </div>
              </div> --}}
          </div>
    @elseif($user_type == 2)
          <div class="container-fluid custom-font-content" style="padding: 20px;">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-center my-3 mx-2" style="font-size: 40px; white-space: nowrap;">Sign Up As farmer</h2>
                </div>
            </div>
            <form wire:submit.prevent="register" class="my-3" style="width: 100%;" autocomplete="off">
              @csrf
              <div class="row">
                    <div class="col-lg-4 offset-lg-1 mb-4">
                        <div class="form-group my-3">
                            <label for="username">Username</label>
                            <input type="text" wire:model="username" class="form-control" id="username" placeholder="Enter username" required>
                            @error('username') <span class="text-warning">{{ $message }}</span> @enderror

                        </div>
                        <div class="form-group my-3">
                            <label for="email">Email</label>
                            <input type="email" wire:model="email" class="form-control" id="email" placeholder="Enter email" required>
                            @error('email') <span class="text-warning">{{ $message }}</span> @enderror

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
                <!-- Submit Button -->
                <div class="row form-group my-3 d-flex justify-content-center">
                    <button type="submit" class="btn btn-warning btn-block px-4" style="width: fit-content;">Sign Up</button>
                </div>
            </form>
            {{-- <div class="row">
                <div class="col text-end mt-3 my-4">
                    <a href="../login/consumer-login.php">Has account? | Sign In</a>
                </div>
            </div> --}}
          </div>
    @endif

    @if($showModal)
    <div class="modal fade show d-block" tabindex="-1" role="dialog" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog" role="document">
            <div class="col-12">
                <h2 class="text-center my-3 mx-2" style="font-size: 40px; white-space: nowrap;">Sign Up As Consumer</h2>
            </div>
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title">Enter OTP</h5>
                    <button type="button" class="btn btn-danger close" wire:click="closeModal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">           <!-- OTP Input Field -->
                    <form wire:submit.prevent="verifyOtp">
                        @if (session('error'))
                        <div class="alert alert-danger text-center my-3 d-block position-absolute col-12">
                            {{ session('error') }}
                        </div>
                        @endif
                        <div class="form-group">
                            <p class="text-center">We have sent an OTP to your email at {{ $email }}. </p>
                            <p class="text-center">Please enter the OTP to verify your email address.</p>
                            <label class="form-label" for="otp">OTP</label>
                            <input type="text" id="otp" wire:model="otp" class="form-control" maxlength="6" placeholder="Enter OTP">
                            @error('otp') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <button type="submit" class="btn btn-success my-3">Submit OTP</button>
                        <button type="button" class="btn btn-secondary my-3" wire:click="closeModal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif
</div>

