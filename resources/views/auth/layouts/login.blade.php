@extends('auth.app')

@section('title', 'Login')

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
                    <h5 class="fs-3xl">Welcome Back</h5>
                    <p class="text-muted">Sign in to continue to Dosix.</p>
                </div>

                <div class="p-2 mt-4">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <div class="position-relative ">
                                <input type="text" class="form-control  password-input" id="email" name="email"
                                    placeholder="Enter email" value="{{ old('email') }}" required>
                            </div>

                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="float-end">
                                <a href="{{ route('password.request') }}" class="text-muted">Forgot password?</a>
                            </div>

                            <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
                            <div class="position-relative auth-pass-inputgroup mb-3">
                                <input type="password" class="form-control pe-5 password-input "
                                    placeholder="Enter password" id="password" name="password" required>

                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="auth-remember-check">
                            <label class="form-check-label" for="auth-remember-check">Remember me</label>
                        </div>

                        <div class="mt-4">
                            <button class="btn btn-primary w-100" type="submit">Sign In</button>
                        </div>

                        <div class="mt-4 pt-2 text-center">
                            <div class="signin-other-title position-relative">
                                <h5 class="fs-md mb-4 title">Sign In with</h5>
                            </div>
                            <div class="pt-2 hstack gap-2 justify-content-center">
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

                    <div class="text-center mt-5">
                        <p class="mb-0">Don't have an account ? <a href="{{ route('register') }}"
                                class="fw-semibold text-secondary text-decoration-underline"> SignUp</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
