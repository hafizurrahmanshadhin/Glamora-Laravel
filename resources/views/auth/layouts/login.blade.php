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
                        <p>New user? <a href="sign-up.html">Create an account</a></p>
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
                        <p class="tm-create-btn-link">Don't have an account? <a href="sign-up.html">Sign Up</a></p>

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
