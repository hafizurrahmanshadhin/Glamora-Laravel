@extends('auth.app')

@section('title', 'Login')

@section('content')
    <section class="sign-in-up-common-section">
        <div class="container">
            <div class="sign-in-up-content-wrapper">
                <div class="sign-in-up-image-area">
                    <img src="{{ asset('frontend/images/sign-in-banner.png') }}" alt="">
                </div>

                <div class="sign-in-up-form-area">
                    <div class="form-header-para">
                        <h1>Sign in</h1>
                        <p>New user? <a href="{{ route('join') }}">Create an account</a></p>
                    </div>

                    <form class="tm-sign-in-up-form" action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="form-floating">
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Please Enter Your Email" value="{{ old('email') }}">
                            <label for="email">Email address</label>

                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-floating">
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Please Enter Your Password">
                            <label for="password">Password</label>

                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit">Sign In</button>
                        <p class="tm-create-btn-link">Forgot Password?
                            <a href="{{ route('password.request') }}">
                                Click Here
                            </a>
                        </p>

                        <p class="tm-create-btn-link">Verify account?
                            <a href="{{ route('phone-number-verification') }}">Click here</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
