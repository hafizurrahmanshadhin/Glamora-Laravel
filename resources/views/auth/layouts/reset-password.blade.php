@extends('auth.app')

@section('title', 'Reset Password')

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
                    <h5 class="fs-3xl">Reset Your Password</h5>
                    <p class="text-muted">Enter your email address and new password to reset your password.</p>
                </div>

                <div class="p-2 mt-4">
                    <form method="POST" action="{{ route('password.store') }}">
                        @csrf

                        {{-- Password Reset Token --}}
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        {{-- Email Address --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <div class="position-relative">
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter email" value="{{ old('email', $request->email) }}" required autofocus
                                    autocomplete="username">
                            </div>

                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="mb-3">
                            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                            <div class="position-relative">
                                <input type="password" class="form-control" id="password" name="password" required
                                    autocomplete="new-password">
                            </div>

                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Confirm Password --}}
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password <span
                                    class="text-danger">*</span></label>
                            <div class="position-relative">
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>

                            @error('password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <button class="btn btn-primary w-100" type="submit">Reset Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
