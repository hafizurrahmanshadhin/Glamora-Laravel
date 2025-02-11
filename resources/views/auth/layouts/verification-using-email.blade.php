@extends('auth.app')

@section('title', 'Email Verification')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="sign-in-up-common-section">
        <div class="container">
            <div class="sign-in-up-content-wrapper">
                <div class="sign-in-up-image-area">
                    <img src="{{ asset('frontend/images/sign-in-banner.png') }}" alt="">
                </div>
                <div class="sign-in-up-form-area">
                    <div class="form-header-para">
                        <h1>Enter Your Email</h1>
                        <p>Enter your email for the verification process. We will send a code to your email.</p>
                    </div>
                    <form class="tm-sign-in-up-form" method="POST" action="{{ route('send-otp') }}">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" name="email" placeholder="name@example.com"
                                required>
                            <label for="email">Email address</label>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit">Continue</button>
                        <div class="or-wrapper">
                            <div class="or-line"></div>
                            <p class="or-text">or</p>
                            <div class="or-line"></div>
                        </div>
                        <p class="tm-create-btn-link">
                            Verify via number? <a href="{{ route('phone-number-verification') }}">Click here</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
