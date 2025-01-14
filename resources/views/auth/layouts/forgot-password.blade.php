@extends('auth.app')

@section('title', 'Forgot Password')

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
                    <h5 class="fs-3xl">Forgot Your Password?</h5>
                    <p class="text-muted">No problem. Just let us know your email address and we will email you a password
                        reset link that will allow you to choose a new one.</p>
                </div>

                <div class="p-2 mt-4">
                    {{-- Session Status --}}
                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        {{-- Email Address --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <div class="position-relative">
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter email" value="{{ old('email') }}" required autofocus>
                            </div>

                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mt-3 text-end">
                            <a href="{{ route('login') }}" class="text-muted">Back to Login</a>
                        </div>

                        <div class="mt-4">
                            <button class="btn btn-primary w-100" type="submit">Email Password Reset Link</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
