@extends('layouts.app') <!-- Extending the parent layout -->

@section('title', 'Login Selection') <!-- Defining a title for this view -->

@push('styles')
<style>
    .custom-font-content {
        font-family: 'Poppins', sans-serif;
        font-weight: bold;
        color: aliceblue;
    }
</style>
@endpush
@section('x-content')
    @include('user.includes.navbar-consumer')
    @if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif
    <!--CONTENT-->

    <div class=" d-flex row custom-font-content g-2">
        <div class="col-lg-6 border border-primary login-card d-flex flex-row align-items-center justify-content-center" style="background-color:green; height: 80vh;">
          <form action="{{ route('user.register') }}" method="GET">
              <input type="hidden" name="user_type" value="1">
              <button type="submit" class="btn btn-primary">Register as Consumer</button>
          </form>
          <form action="{{ route('user.register') }}" method="GET">
              <input type="hidden" name="user_type" value="2">
              <button type="submit" class="btn btn-primary">Register as Farmer</button>
          </form>
        </div>
        <div class="col-lg-6 border border-primary login-card d-flex flex-row align-items-center justify-content-center" style="background-color:rgb(255, 128, 0); height: 80vh;">
            <form action="{{ route('user.login') }}" method="GET">
                <input type="hidden" name="user_type" value="1">
                <button type="submit" class="btn btn-primary">login as Consumer</button>
            </form>
            <form action="{{ route('user.login') }}" method="GET">
                <input type="hidden" name="user_type" value="2">
                <button type="submit" class="btn btn-primary">login as Farmer</button>
            </form>
          </div>
    </div>
@endsection
@section('scripts')
{{-- if meron --}}
@endsection
