@extends('layouts.app') <!-- Extending the parent layout -->

@section('title', 'register') <!-- Defining a title for this view -->

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

    /* Hide the increment and decrement buttons in WebKit browsers */
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .error-message {
        color: red;
        font-size: 0.875rem;
    }

    .message {
    position: absolute;
    top:0;
    margin:10px 0 0 0;
    width: 95%;
    background-color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    padding:2rem;
    gap:1.5rem;
    border-radius: 40px;
    z-index: 10000;
    border: 10px black;
    justify-content: space-between;
    }
    .message span{
    color:black;
    font-size: 2rem;
    }
    .message i{
    font-size: 2.5rem;
    color:red;
    cursor: pointer;
    }
    .message i:active{
    transform: rotate(90deg);
    }

    .toggle-password {
        cursor: pointer;
    }
</style>
@endpush
@section('x-content')
    @include('user.includes.navbar-consumer')
{{-- Display success or error messages --}}
@if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

{{-- Display validation errors --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
  @if($user_type == 1)

        <div class="container-fluid custom-font-content" style="padding: 20px;">
          <div class="row">
              <div class="col-12">
                  <h2 class="text-center my-3 mx-2" style="font-size: 40px; white-space: nowrap;">Sign Up As Consumer</h2>
              </div>
          </div>
          <form action="{{ route('user.register.submit') }}" method="post" class="my-3" style="width: 100%;" autocomplete="off">
            @csrf
            <div class="row">
                  <div class="col-lg-4 offset-lg-1 mb-4">
                      <div class="form-group my-3">
                          <label for="username">Username</label>
                          <input type="text" name="username" class="form-control" id="username" placeholder="Enter username" required>
                      </div>
                      <div class="form-group my-3">
                          <label for="email">Email</label>
                          <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" required>
                      </div>
                  </div>
                  <div class="col-lg-4 offset-lg-2 mb-4">
                      <div class="form-group my-3">
                          <label for="password">Password:</label>
                          <div class="input-group">
                              <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" minlength="8" required>
                              <div class="input-group-append">
                                  <span class="input-group-text toggle-password" id="togglePassword"
                                      style="height: 100%; width: 40px; border-top-left-radius: 0px; border-bottom-left-radius: 0px; display: flex; align-items: center; justify-content: center;">
                                      <i class="fas fa-eye"></i>
                                  </span>
                              </div>
                          </div>
                          <input type="hidden" name="user_type" value="{{ $user_type }}">
                      </div>
                      <div class="form-group my-3">
                          <label for="password2">Confirm Password:</label>
                          <div class="input-group">
                              <input type="password" name="password_confirmation" class="form-control" id="password2" placeholder="Re-enter password" required>
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
@elseif($user_type == 2)
      <div class="container-fluid custom-font-content" style="padding: 20px;">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center my-3 mx-2" style="font-size: 40px; white-space: nowrap;">Sign Up As farmer</h2>
            </div>
        </div>
        <form action="{{ route('user.register.submit') }}" method="post" class="my-3" style="width: 100%;" autocomplete="off">
          @csrf
          <div class="row">
                <div class="col-lg-4 offset-lg-1 mb-4">
                    <div class="form-group my-3">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" id="username" placeholder="Enter username" required>
                    </div>
                    <div class="form-group my-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" required>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-2 mb-4">
                    <div class="form-group my-3">
                        <label for="password">Password:</label>
                        <div class="input-group">
                            <input type="password" name="password" class="form-control" placeholder="Enter password" minlength="8" required>
                            <div class="input-group-append">
                                <span class="input-group-text toggle-password" id="togglePassword"
                                    style="height: 100%; width: 40px; border-top-left-radius: 0px; border-bottom-left-radius: 0px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="user_type" value="{{ $user_type }}">
                    <div class="form-group my-3">
                        <label for="password2">Confirm Password:</label>
                        <div class="input-group">
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Re-enter password" required>
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
@endsection
@section('scripts')
{{-- if meron --}}
@endsection
