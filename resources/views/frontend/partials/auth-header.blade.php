@php
    $systemSetting = App\Models\SystemSetting::first();
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
        <a href="./index.html" class="item mobile-service-nav">Services</a>
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
        <a class="item" href="./upcoming-appointments.html">My Bookings</a>
        <a class="item" href="{{ route('contact') }}">Contact</a>
        <a class="item" href="{{ route('faq') }}">Faq</a>
    </div>
    <div class="header-actions">
        <a href="" class="">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M7.33333 5C6.45513 5 5.60918 5.35501 4.98262 5.99291C4.35547 6.63142 4 7.50118 4 8.41176V20.1765C4 21.0871 4.35547 21.9568 4.98262 22.5953C5.60918 23.2332 6.45512 23.5882 7.33333 23.5882H10.2222C10.7745 23.5882 11.2222 24.0359 11.2222 24.5882V27.2173L16.9232 23.7349C17.0801 23.639 17.2605 23.5882 17.4444 23.5882H24.6667C25.5449 23.5882 26.3908 23.2332 27.0174 22.5953C27.6445 21.9568 28 21.0871 28 20.1765V8.41176C28 7.50118 27.6445 6.63142 27.0174 5.99291C26.3908 5.35501 25.5449 5 24.6667 5H7.33333ZM3.55578 4.59144C4.55454 3.57461 5.913 3 7.33333 3H24.6667C26.087 3 27.4455 3.57461 28.4442 4.59144C29.4424 5.60766 30 6.98221 30 8.41176V20.1765C30 21.606 29.4424 22.9806 28.4442 23.9968C27.4455 25.0136 26.087 25.5882 24.6667 25.5882H17.7257L10.7435 29.8534C10.4349 30.0419 10.0484 30.0491 9.73299 29.8722C9.41753 29.6952 9.22222 29.3617 9.22222 29V25.5882H7.33333C5.913 25.5882 4.55454 25.0136 3.55578 23.9968C2.55763 22.9806 2 21.606 2 20.1765V8.41176C2 6.98221 2.55763 5.60766 3.55578 4.59144ZM9.22222 11.3529C9.22222 10.8007 9.66994 10.3529 10.2222 10.3529H21.7778C22.3301 10.3529 22.7778 10.8007 22.7778 11.3529C22.7778 11.9052 22.3301 12.3529 21.7778 12.3529H10.2222C9.66994 12.3529 9.22222 11.9052 9.22222 11.3529ZM9.22222 17.2353C9.22222 16.683 9.66994 16.2353 10.2222 16.2353H18.8889C19.4412 16.2353 19.8889 16.683 19.8889 17.2353C19.8889 17.7876 19.4412 18.2353 18.8889 18.2353H10.2222C9.66994 18.2353 9.22222 17.7876 9.22222 17.2353Z"
                    fill="#222222" />
            </svg>
        </a>

        {{-- notification btn --}}
        <a style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#notificationModal" class="">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                <path
                    d="M28.707 19.293L26 16.586V13C25.9969 10.5218 25.075 8.13285 23.4126 6.29498C21.7502 4.45712 19.4654 3.30093 17 3.05V1H15V3.05C12.5346 3.30093 10.2498 4.45712 8.58737 6.29498C6.92498 8.13285 6.0031 10.5218 6 13V16.586L3.293 19.293C3.10545 19.4805 3.00006 19.7348 3 20V23C3 23.2652 3.10536 23.5196 3.29289 23.7071C3.48043 23.8946 3.73478 24 4 24H11V24.777C10.9778 26.0458 11.4248 27.278 12.2553 28.2375C13.0857 29.197 14.2412 29.816 15.5 29.976C16.1952 30.0449 16.8971 29.9676 17.5606 29.749C18.2241 29.5304 18.8345 29.1753 19.3525 28.7066C19.8706 28.2379 20.2848 27.666 20.5685 27.0277C20.8522 26.3893 20.9992 25.6986 21 25V24H28C28.2652 24 28.5196 23.8946 28.7071 23.7071C28.8946 23.5196 29 23.2652 29 23V20C28.9999 19.7348 28.8946 19.4805 28.707 19.293ZM19 25C19 25.7956 18.6839 26.5587 18.1213 27.1213C17.5587 27.6839 16.7956 28 16 28C15.2044 28 14.4413 27.6839 13.8787 27.1213C13.3161 26.5587 13 25.7956 13 25V24H19V25ZM27 22H5V20.414L7.707 17.707C7.89455 17.5195 7.99994 17.2652 8 17V13C8 10.8783 8.84285 8.84344 10.3431 7.34315C11.8434 5.84285 13.8783 5 16 5C18.1217 5 20.1566 5.84285 21.6569 7.34315C23.1571 8.84344 24 10.8783 24 13V17C24.0001 17.2652 24.1054 17.5195 24.293 17.707L27 20.414V22Z"
                    fill="#222222" />
            </svg>
        </a>

        <div class="header-profile-container">
            <div class="header-profile-btn">
                <img src="{{ Auth::user()->businessInformation?->avatar ? asset(Auth::user()->businessInformation->avatar) : asset('backend/images/default_images/user_1.jpg') }}"
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
