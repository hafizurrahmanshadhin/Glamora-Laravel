@extends('auth.app')

@section('title', 'Sign Up')

@section('content')
    <section class="sign-in-up-common-section sign-up-form-area">
        <div class="container">
            <div class="sign-in-up-content-wrapper">
                <div class="sign-in-up-image-area">
                    <img src="{{ asset('frontend/images/sign-in-banner.png') }}" alt="">
                </div>
                <div class="sign-in-up-form-area">
                    <div class="form-header-para">
                        <h1>Sign Up</h1>
                        <p>Old user? <a href="{{ route('login') }}">Log Into Your account</a></p>
                    </div>

                    <form class="tm-sign-in-up-form" method="POST" action="{{ route('register') }}">
                        @csrf
                        <input type="hidden" name="role" value="{{ request('role') }}">

                        <div class="form-floating">
                            <input type="text" class="form-control" id="first_name" name="first_name"
                                placeholder="Enter Your First Name" value="{{ old('first_name') }}">
                            <label for="first_name">First Name</label>

                            @error('first_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating">
                            <input type="text" class="form-control" id="last_name" name="last_name"
                                placeholder="Enter Your Last Name" value="{{ old('last_name') }}">
                            <label for="last_name">Last Name</label>

                            @error('last_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating">
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Please Enter Your Email" value="{{ old('email') }}">
                            <label for="email">Email address</label>

                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating">
                            <input type="password" class="form-control" id="password-input" name="password"
                                placeholder="Please Enter Your Password">
                            <label for="password-input">Create Password</label>

                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating">
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" placeholder="Please Retype Your Password">
                            <label for="password_confirmation">Retype Password</label>

                            @error('password_confirmation')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button class="sign-up-common-btn" type="submit">Sign Up</button>
                        <p class="tm-create-btn-link">Already have an account?? <a href="{{ route('login') }}">Sign In</a>
                        </p>

                        <div class="or-wrapper">
                            <div class="or-line"></div>
                            <p class="or-text">or</p>
                            <div class="or-line"></div>
                        </div>

                        <a class="google-link" href="#">
                            <img src="{{ asset('frontend/images/google.png') }}" alt="">
                            Continue with Google
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
