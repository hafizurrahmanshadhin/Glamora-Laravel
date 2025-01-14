@extends('frontend.app')

@section('title', 'Admin Dashboard Dosix')

@push('styles')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
            font-family: Arial, sans-serif;
        }

        body {
            background-image: url('{{ asset('frontend/mockup_image.jpg') }}');
            background-size: cover;
            background-position: top center;
            background-repeat: no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .auth-buttons {
            position: absolute;
            bottom: 20px;
            left: 20px;
            display: flex;
            gap: 10px;
        }

        .login-btn,
        .register-btn,
        .dashboard-btn {
            padding: 0.8em 2em;
            font-size: 1.2em;
            color: white;
            background-color: rgba(0, 0, 0, 0.7);
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .login-btn:hover,
        .register-btn:hover,
        .dashboard-btn:hover {
            background-color: rgba(0, 0, 0, 0.9);
            transform: scale(1.05);
        }

        @media (max-width: 600px) {

            .login-btn,
            .register-btn,
            .dashboard-btn {
                padding: 0.6em 1.5em;
                font-size: 1em;
                bottom: 10px;
                left: 10px;
            }

            .auth-buttons {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
@endpush

@section('content')
    @if (Route::has('login'))
        @auth
            <div class="auth-buttons">
                <a href="{{ route('dashboard') }}" class="dashboard-btn">
                    Dashboard
                </a>
            </div>
        @else
            <div class="auth-buttons">
                <a href="{{ route('login') }}" class="login-btn">
                    Log in
                </a>

                <a href="{{ route('register') }}" class="register-btn">
                    Register
                </a>
            </div>
        @endauth
    @endif
@endsection
