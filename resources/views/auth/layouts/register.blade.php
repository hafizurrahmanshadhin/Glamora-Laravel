@extends('auth.app')

@section('title', 'Sign Up')

@section('content')
    <section class="sign-in-up-common-section sign-up-form-area">
        <div class="container">
            <div class="sign-in-up-content-wrapper">
                <div class="sign-in-up-image-area">
                    <img src="{{ asset($authBanner->image ?? 'frontend/images/sign-in-banner.png') }}" alt="Auth Banner">
                </div>
                <div class="sign-in-up-form-area">
                    <div class="form-header-para">
                        <h1>Sign Up</h1>
                        <p>Existing User? <a href="{{ route('login') }}">Sign in here</a></p>
                    </div>

                    <form class="tm-sign-in-up-form" method="POST" action="{{ route('register') }}">
                        @csrf
                        <input required type="hidden" name="role" value="{{ request('role') }}">

                        <div class="form-floating">
                            <input required type="text" class="form-control" id="first_name" name="first_name"
                                placeholder="Enter Your First Name" value="{{ old('first_name') }}">
                            <label for="first_name">First Name</label>

                            @error('first_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating">
                            <input required type="text" class="form-control" id="last_name" name="last_name"
                                placeholder="Enter Your Last Name" value="{{ old('last_name') }}">
                            <label for="last_name">Last Name</label>

                            @error('last_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating">
                            <input required type="email" class="form-control" id="email" name="email"
                                placeholder="Please Enter Your Email" value="{{ old('email') }}">
                            <label for="email">Email address</label>

                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating">
                            <input required type="tel" class="form-control" id="phone_number" name="phone_number"
                                placeholder="Please Enter Your Phone Number" value="{{ old('phone_number') }}">
                            <label for="phone_number">Phone Number</label>

                            @error('phone_number')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating">
                            <input required type="text" class="form-control" id="address" name="address"
                                placeholder="Enter Your Address" value="{{ old('address') }}">
                            <label for="address">Address</label>

                            @error('address')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating">
                            <input required type="password" class="form-control" id="password-input" name="password"
                                placeholder="Please Enter Your Password">
                            <label for="password-input">Create Password</label>

                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating">
                            <input required type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" placeholder="Please Retype Your Password">
                            <label for="password_confirmation">Retype Password</label>

                            @error('password_confirmation')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button class="sign-up-common-btn" type="submit">Sign Up</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
