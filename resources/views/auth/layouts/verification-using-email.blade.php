@extends('auth.app')

@section('title', 'Email Verification')

@section('content')
    <section class="sign-in-up-common-section">
        <div class="container">
            <div class="sign-in-up-content-wrapper">
                <div class="sign-in-up-image-area">
                    <img src="{{ asset('frontend/images/sign-in-banner.png') }}" alt="">
                </div>
                <div class="sign-in-up-form-area">
                    <div class="form-header-para">
                        <h1>Enter Your email</h1>
                        <p>Enter your email for the verification process, we will send code to your email</p>
                    </div>
                    <form class="tm-sign-in-up-form" action="../dashboard/index.html">
                        <div class="form-floating">
                            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Email address</label>
                        </div>
                        <button type="submit">Continue</button>
                        <div class="or-wrapper">
                            <div class="or-line"></div>
                            <p class="or-text">or</p>
                            <div class="or-line"></div>
                        </div>
                        <p class="tm-create-btn-link">Verify via number?
                            <a href="{{ route('phone-number-verification') }}">Click here</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
