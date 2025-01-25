@extends('auth.app')

@section('title', 'Forgot Password')

@section('content')
    <section class="sign-in-up-common-section">
        <div class="container">
            <div class="sign-in-up-content-wrapper">
                <div class="sign-in-up-image-area">
                    <img src="{{ asset('frontend/images/sign-in-banner.png') }}" alt="Forgot Password">
                </div>

                <div class="sign-in-up-form-area">
                    <div class="form-header-para">
                        <h1>Forgot Password?</h1>
                        <p>Enter your email address, and we'll send you a link to reset your password.</p>
                    </div>

                    <form class="tm-sign-in-up-form" method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-floating">
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Please Enter Your Email" value="{{ old('email') }}" required autofocus>
                            <label for="email">Email address</label>

                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        @if (session('status'))
                            <div class="alert alert-success mt-3" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <button type="submit">Send Password Reset Link</button>

                        <div class="mt-3 text-center">
                            <p class="tm-create-btn-link">Remember your password? <a href="{{ route('login') }}">Sign In</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
