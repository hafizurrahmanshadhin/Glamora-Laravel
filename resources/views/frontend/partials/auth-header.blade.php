@php
    $systemSetting = App\Models\SystemSetting::first();
    $notifications = Auth::user()->unreadNotifications;
@endphp

<div class="header dashboard-header section-padding-x">
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

        <a class="item"
            href="
                @if (Auth::check()) @if (Auth::user()->role == 'beauty_expert')
                        {{ route('beauty-expert-dashboard') }}
                    @elseif(Auth::user()->role == 'client')
                        {{ route('client-dashboard') }}
                    @else
                        {{ route('index') }} @endif
@else
{{ route('login') }}
                @endif
            ">Dashboard</a>
        <a class="item" href="{{ route('contact') }}">Contact</a>
        <a class="item" href="{{ route('faq') }}">Faq</a>
    </div>

    <div class="header-actions">
        {{-- Notification Start --}}
        <div class="notifications-container">
            <div class="notification-icon">
                <div class="notification-count">{{ $notifications->count() }}</div>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="29" viewBox="0 0 25 29"
                    fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M12.1663 22.1302C19.6853 22.1302 23.1637 21.1656 23.4997 17.294C23.4997 13.4251 21.0745 13.6739 21.0745 8.92681C21.0745 5.21885 17.56 1 12.1663 1C6.7727 1 3.25814 5.21885 3.25814 8.92681C3.25814 13.6739 0.833008 13.4251 0.833008 17.294C1.17028 21.1802 4.64871 22.1302 12.1663 22.1302Z"
                        stroke="#6B6B6B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M15.3518 26.1426C13.533 28.1622 10.6956 28.1861 8.85938 26.1426" stroke="#6B6B6B"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>

            <div class="notification-list-container">
                <div class="title">Notifications <span class="count">{{ $notifications->count() }}</span></div>
                <div class="notification-list">
                    @foreach ($notifications as $notification)
                        @php
                            $notificationId = $notification->id;
                        @endphp

                        <a href="{{ route('notification.read', $notificationId) }}" class="item">
                            <div class="left">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="19"
                                    viewBox="0 0 16 19" fill="none">
                                    <path
                                        d="M7.56 0.5C6.76828 0.5 6.12 1.14828 6.12 1.94C6.12 2.12563 6.15656 2.30563 6.22125 2.46875C4.19625 2.99469 2.88 4.75391 2.88 6.98C2.88 9.79953 2.18812 11.0834 1.53 11.8063C1.20094 12.1677 0.876094 12.387 0.59625 12.5938C0.455625 12.6964 0.327656 12.7991 0.21375 12.9313C0.0998438 13.0634 0 13.2519 0 13.46C0 13.955 0.30375 14.3755 0.73125 14.6525C1.15875 14.9295 1.71984 15.1081 2.39625 15.2488C3.27375 15.4302 4.35656 15.5258 5.54625 15.575C5.45625 15.8141 5.4 16.0714 5.4 16.34C5.4 17.5283 6.37172 18.5 7.56 18.5C8.74828 18.5 9.72 17.5283 9.72 16.34C9.72 16.07 9.66516 15.8127 9.57375 15.575C10.7634 15.5258 11.8462 15.4302 12.7237 15.2488C13.4002 15.1081 13.9612 14.9295 14.3887 14.6525C14.8162 14.3755 15.12 13.955 15.12 13.46C15.12 13.2519 15.0202 13.0634 14.9062 12.9313C14.7923 12.7991 14.6644 12.6964 14.5237 12.5938C14.2439 12.387 13.9191 12.1677 13.59 11.8063C12.9319 11.0834 12.24 9.79953 12.24 6.98C12.24 4.75531 10.9209 2.9975 8.89875 2.46875C8.96344 2.30563 9 2.12563 9 1.94C9 1.14828 8.35172 0.5 7.56 0.5ZM7.56 1.22C7.96219 1.22 8.28 1.53781 8.28 1.94C8.28 2.34219 7.96219 2.66 7.56 2.66C7.15781 2.66 6.84 2.34219 6.84 1.94C6.84 1.53781 7.15781 1.22 7.56 1.22ZM8.40375 3.0875C10.3233 3.42922 11.52 4.91281 11.52 6.98C11.52 9.92047 12.2681 11.4308 13.05 12.29C13.4409 12.7189 13.8361 12.9875 14.0962 13.1788C14.2256 13.2744 14.3227 13.3545 14.3662 13.4038C14.4098 13.453 14.4 13.4488 14.4 13.46C14.4 13.685 14.2959 13.8495 13.995 14.045C13.6941 14.2405 13.2047 14.4219 12.5775 14.5513C11.3231 14.8114 9.53719 14.9 7.56 14.9C5.58281 14.9 3.79687 14.8114 2.5425 14.5513C1.91531 14.4219 1.42594 14.2405 1.125 14.045C0.824063 13.8495 0.72 13.685 0.72 13.46C0.72 13.4488 0.710156 13.453 0.75375 13.4038C0.797344 13.3545 0.894375 13.2744 1.02375 13.1788C1.28391 12.9875 1.67906 12.7189 2.07 12.29C2.85187 11.4308 3.6 9.92047 3.6 6.98C3.6 4.91422 4.79812 3.44188 6.71625 3.09875C6.95531 3.27453 7.24359 3.38 7.56 3.38C7.87922 3.38 8.16469 3.26609 8.40375 3.0875ZM6.3225 15.5975C6.72609 15.6059 7.13672 15.62 7.56 15.62C7.98328 15.62 8.39391 15.6059 8.7975 15.5975C8.92547 15.8141 9 16.07 9 16.34C9 17.1402 8.36016 17.78 7.56 17.78C6.75984 17.78 6.12 17.1402 6.12 16.34C6.12 16.0672 6.19172 15.8141 6.3225 15.5975Z"
                                        fill="#222222" />
                                </svg>
                            </div>
                            <div class="right">
                                <div class="item-text">
                                    {{ $notification->data['message'] ?? 'New booking notification' }}<br>
                                    Booking ID: {{ $notification->data['booking_id'] ?? '' }}
                                </div>
                                <div class="item-time">
                                    {{ $notification->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        {{-- Notification End --}}

        <div class="header-profile-container">
            <div class="header-profile-btn">
                <img src="{{ Auth::user()->avatar ? asset(Auth::user()->avatar) : asset('backend/images/default_images/user_1.jpg') }}"
                    alt="Profile Image">
            </div>
            <div class="tm-profiledropdown">
                <div class="tm-profile-dropdown-menu-wrapper">
                    <a class="tm-profile-dropdown-item tm-see-profile"
                        href="
                @if (Auth::check()) @if (Auth::user()->role == 'beauty_expert')
                        {{ route('beauty-expert-dashboard') }}
                    @elseif(Auth::user()->role == 'client')
                        {{ route('client-dashboard') }}
                    @else
                        {{ route('index') }} @endif
@else
{{ route('login') }}
                @endif
            ">Profile</a>
                    <a class="tm-profile-dropdown-item" href="javascript:void(0);"
                        onclick="event.preventDefault(); document.getElementById('logoutForm').submit()">Log Out</a>
                    <form action="{{ route('logout') }}" method="post" id="logoutForm">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
