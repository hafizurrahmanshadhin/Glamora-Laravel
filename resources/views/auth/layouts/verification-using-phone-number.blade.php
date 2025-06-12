@extends('auth.app')

@section('title', 'Phone Number Verification')

@section('content')
    <section class="sign-in-up-common-section">
        <div class="container">
            <div class="sign-in-up-content-wrapper">
                <div class="sign-in-up-image-area">
                    <img src="{{ asset($authBanner->image ?? 'frontend/images/sign-in-banner.png') }}" alt="Auth Banner">
                </div>
                <div class="sign-in-up-form-area">
                    <div class="form-header-para">
                        <h1>Enter Your Phone Number</h1>
                        <p>Enter your number for the verification process. We will send a code to your number.</p>
                    </div>
                    <form class="tm-sign-in-up-form" method="POST" action="{{ route('send-sms-otp') }}">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="phone_number" placeholder="+1234567890"
                                required>
                            <label for="phone_number">Phone Number</label>
                            @error('phone_number')
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
                            Verify via email? <a href="{{ route('email-verification') }}">Click here</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
