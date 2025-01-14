@extends('frontend.app')

@section('title', 'User Dashboard')

@section('content')
    <H1>User Dashboard</H1>

    <br>

    <form action="{{ route('stripe.checkout') }}" method="POST">
        @csrf
        <button type="submit">Checkout</button>
    </form>

    <br>

    <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('logoutForm').submit()">Logout</a>
    <form action="{{ route('logout') }}" method="post" id="logoutForm">
        @csrf
    </form>
@endsection
