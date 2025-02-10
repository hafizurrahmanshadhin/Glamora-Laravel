@extends('auth.app')

@section('title', 'OTP Verification')

@section('content')
    <section class="sign-in-up-common-section">
        <div class="container">
            <div class="sign-in-up-content-wrapper">
                <div class="sign-in-up-image-area">
                    <img src="{{ asset('frontend/images/sign-in-banner.png') }}" alt="">
                </div>
                <div class="sign-in-up-form-area">
                    <div class="form-header-para">
                        <h1>Enter 4 digit code</h1>
                        <p>A four-digit code should have come to your email address that you indicated.</p>
                    </div>
                    <form class="tm-sign-in-up-form" action="../dashboard/index.html">
                        <div class="pin-container">
                            <input type="text" maxlength="1" class="pin-box" id="pin-1" />
                            <input type="text" maxlength="1" class="pin-box" id="pin-2" />
                            <input type="text" maxlength="1" class="pin-box" id="pin-3" />
                            <input type="text" maxlength="1" class="pin-box" id="pin-4" />
                        </div>
                        <button type="submit">Verify</button>
                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection
