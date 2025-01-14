@extends('auth.app')

@section('title', 'Register')

@section('content')
    <div class="col-lg-8 col-xxl-4 mx-auto order-first order-xl-last">
        <div class="card shadow-lg border-none m-lg-5">
            <div class="card-body">
                <div class="text-center mt-4">
                    <div class="mb-4 pb-2">
                        <a href="{{ route('index') }}" class="auth-logo">
                            <img src="{{ asset('backend/images/logo-dark.png') }}" alt="" height="30"
                                class="auth-logo-dark mx-auto">
                            <img src="{{ asset('backend/images/logo-light.png') }}" alt="" height="30"
                                class="auth-logo-light mx-auto">
                        </a>
                    </div>
                    <h5 class="fs-3xl">Create New Account</h5>
                </div>

                <div class="p-2 mt-4">
                    <form class="needs-validation" novalidate method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row">
                            {{-- First Name --}}
                            <div class="col-md-6 mb-3">
                                <label for="first_name" class="form-label">First Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="first_name" name="first_name"
                                    placeholder="Enter your first name" value="{{ old('first_name') }}" required>
                                <div class="invalid-feedback">
                                    Please enter your first name
                                </div>
                                @error('first_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Last Name --}}
                            <div class="col-md-6 mb-3">
                                <label for="last_name" class="form-label">Last Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="last_name" name="last_name"
                                    placeholder="Enter your last name" value="{{ old('last_name') }}" required>
                                <div class="invalid-feedback">
                                    Please enter your last name
                                </div>
                                @error('last_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Email Address --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Enter email address" value="{{ old('email') }}" required>
                            <div class="invalid-feedback">
                                Please enter your email
                            </div>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="mb-3">
                            <label class="form-label" for="password-input">Password <span
                                    class="text-danger">*</span></label>
                            <div class="position-relative auth-pass-inputgroup">
                                <input type="password" class="form-control password-input pe-5" id="password-input"
                                    name="password" placeholder="Enter password" required>
                                <div class="invalid-feedback">
                                    Please enter a valid password
                                </div>
                            </div>
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Confirm Password --}}
                        <div class="mb-3">
                            <label class="form-label" for="password_confirmation">Confirm Password <span
                                    class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" placeholder="Confirm your password" required>
                            <div class="invalid-feedback">
                                Please confirm your password
                            </div>
                            @error('password_confirmation')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Terms and Conditions --}}
                        <div class="mb-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                                <label class="form-check-label fs-xs text-muted fst-italic" for="terms">
                                    I agree to the
                                    <a href="#"
                                        class="text-primary text-decoration-underline fst-normal fw-medium">Terms of Use</a>
                                </label>
                            </div>
                        </div>

                        {{-- Sign Up Button --}}
                        <div class="mt-4">
                            <button class="btn btn-primary w-100" type="submit">Sign Up</button>
                        </div>

                        {{-- Social Login --}}
                        <div class="mt-4 text-center">
                            <div class="signin-other-title position-relative">
                                <h5 class="fs-sm mb-4 title text-muted">Create account with</h5>
                            </div>
                            <div>
                                <button type="button" class="btn btn-subtle-primary btn-icon"><i
                                        class="ri-facebook-fill fs-lg"></i></button>
                                <button type="button" class="btn btn-subtle-danger btn-icon"><i
                                        class="ri-google-fill fs-lg"></i></button>
                                <button type="button" class="btn btn-subtle-dark btn-icon"><i
                                        class="ri-github-fill fs-lg"></i></button>
                                <button type="button" class="btn btn-subtle-info btn-icon"><i
                                        class="ri-twitter-fill fs-lg"></i></button>
                            </div>
                        </div>
                    </form>

                    <div class="mt-5 text-center">
                        <p class="mb-0">Already have an account ? <a href="{{ route('login') }}"
                                class="fw-semibold text-primary text-decoration-underline"> Signin </a> </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
