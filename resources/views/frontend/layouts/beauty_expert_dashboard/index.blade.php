@extends('frontend.app')

@section('title', 'Beauty Expert Dashboard')

@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/css/dashboard.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/categories.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/tarek.css') }}">
@endpush

@section('content')
    <!-- dashboard content start -->
    <div class="dashboard-layout section-padding-x">
        <div class="dashboard-left">
            <div class="dashboard-profile-container">
                <div class="top">
                    <div class="img-content">
                        <img src="{{ Auth::user()->businessInformation?->avatar ? asset(Auth::user()->businessInformation->avatar) : asset('backend/images/default_images/user_1.jpg') }}"
                            alt="">
                        <div class="active-status"></div>
                    </div>
                    <div class="text-content">
                        <div class="profile-title">
                            {{ ucfirst(Auth::user()->first_name) . ' ' . ucfirst(Auth::user()->last_name) ?? '' }}</div>
                        <div class="profile-text">{{ Auth::user()->businessInformation?->business_address ?? '' }}</div>
                    </div>
                </div>
                <div class="bottom">
                    <div class="bottom-top">
                        <div class="item">
                            <div class="title">Rating as buyer</div>
                            <div class="ratings">
                                ★★★★☆ <span>(4.5)</span>
                            </div>
                        </div>
                        <div class="item">
                            <div class="title">Upcoming Bookings (4)</div>
                            <a class="profile-view-btn" href="">View</a>
                        </div>
                    </div>
                    <div class="bottom-bottom">
                        <a href="" class="common-btn">
                            View Bookings
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="dashboard-main-content">
            <div class="dashboard-banner">
                <div class="text-content">
                    <div class="title-italic">Welcome back,</div>
                    <div class="banner-title">Marzia Begum</div>
                    <div class="text">
                        Start now to connect with trusted tax professionals, book appointments, and manage your
                        documents—all in one
                        place for a smooth tax preparation experience.
                    </div>
                </div>
                <div class="img-content">
                    <img src="{{ asset('frontend/images/dashboard-banner-right.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- dashboard content end -->
@endsection
