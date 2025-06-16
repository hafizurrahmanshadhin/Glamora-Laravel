@extends('auth.app')

@section('title', 'Reset Password')

@section('content')
    <section class="sign-in-up-common-section">
        <div class="container">
            <div class="sign-in-up-content-wrapper">
                <div class="sign-in-up-image-area">
                    <img src="{{ asset($authBanner->image ?? 'frontend/images/sign-in-banner.png') }}" alt="Reset Banner">
                </div>

                <div class="sign-in-up-form-area">
                    <div class="form-header-para">
                        <h1>Reset Password</h1>
                        <p>Remembered your password? <a href="{{ route('login') }}">Sign In</a></p>
                    </div>

                    <form class="tm-sign-in-up-form" action="{{ route('password.store') }}" method="POST">
                        @csrf

                        {{-- Password Reset Token --}}
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div class="form-floating">
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Enter Your Email" value="{{ old('email', $request->email) }}" required
                                autofocus autocomplete="username">
                            <label for="email">Email Address</label>

                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-floating">
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Enter Your New Password" required autocomplete="new-password">
                            <label for="password">New Password</label>

                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-floating">
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" placeholder="Confirm Your New Password" required
                                autocomplete="new-password">
                            <label for="password_confirmation">Confirm New Password</label>

                            @error('password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit">Reset Password</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
