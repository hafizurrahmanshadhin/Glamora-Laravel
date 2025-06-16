@extends('auth.app')

@section('title', 'OTP Verification')

@section('content')
    <section class="sign-in-up-common-section">
        <div class="container">
            <div class="sign-in-up-content-wrapper">
                <div class="sign-in-up-image-area">
                    <img src="{{ asset($authBanner->image ?? 'frontend/images/sign-in-banner.png') }}" alt="Auth Banner">
                </div>
                <div class="sign-in-up-form-area">
                    <div class="form-header-para">
                        <h1>Enter 4 Digit Code</h1>
                        <p>A four-digit code should have been sent to your email address.</p>
                    </div>
                    <form class="tm-sign-in-up-form" method="POST" action="{{ route('verify-otp') }}">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}">

                        <div class="pin-container mb-3">
                            <input type="text" maxlength="1" class="pin-box" name="otp_part[]" required
                                oninput="this.value=this.value.replace(/[^0-9]/g,'');" />
                            <input type="text" maxlength="1" class="pin-box" name="otp_part[]" required
                                oninput="this.value=this.value.replace(/[^0-9]/g,'');" />
                            <input type="text" maxlength="1" class="pin-box" name="otp_part[]" required
                                oninput="this.value=this.value.replace(/[^0-9]/g,'');" />
                            <input type="text" maxlength="1" class="pin-box" name="otp_part[]" required
                                oninput="this.value=this.value.replace(/[^0-9]/g,'');" />
                        </div>

                        @error('otp')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <button type="submit">Verify</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
