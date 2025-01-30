@php
    $systemSetting = App\Models\SystemSetting::first();
@endphp

<div class="header section-padding-x">
    <div class="d-flex align-items-center gap-3">
        <svg class="mobile-menu-icon" width="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
            <path
                d="M0 96C0 78.3 14.3 64 32 64l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 128C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32L32 448c-17.7 0-32-14.3-32-32s14.3-32 32-32l384 0c17.7 0 32 14.3 32 32z" />
        </svg>
        <a href="{{ route('index') }}" class="logo">
            <img src="{{ asset($systemSetting->logo ?? 'frontend/logo_black.png') }}" alt=""
                style="width: 194px; height: 42px;">
        </a>
    </div>

    <div class="header-navs">
        <svg class="sidebar-close-btn" width="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
            <path
                d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
        </svg>
        <a href="{{ route('index') }}" class="item">Home</a>
        <div class="header-services">
            <a class="header-service-btn">
                <span class="item">Services</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="8" viewBox="0 0 12 8" fill="none">
                    <path
                        d="M5.34783 8L0 -5.24537e-07L2.08696 -4.33313e-07L5.96739 6.13665L5.83696 6.08696L6.16304 6.08696L6.03261 6.13665L9.91304 -9.12238e-08L12 0L6.65217 8L5.34783 8Z"
                        fill="#111111" />
                </svg>
            </a>
        </div>
        <a class="item" href="{{ route('register', ['role' => 'beauty_expert']) }}">Join as a Beauty Expert</a>
        <a class="item" href="{{ route('contact') }}">Contact</a>
        <a class="item" href="{{ route('faq') }}">Faq</a>
    </div>

    <div class="header-actions">
        <a href="{{ route('login') }}" class="common-btn sign-in-btn">Sign In</a>
        <a href="{{ route('join') }}" class="common-btn">Join</a>
    </div>
</div>
