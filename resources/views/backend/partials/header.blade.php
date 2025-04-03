@php
    $systemSetting = App\Models\SystemSetting::first();
@endphp

<style>
    @media (max-width: 768px) {
        .app-menu.navbar-menu {
            z-index: 9999;
            /* ensure sidebar is on top */
        }

        .topbar-wrapper {
            z-index: 1000;
            /* ensure header is below sidebar */
        }
    }
</style>

<div class="topbar-wrapper shadow">
    <header id="page-topbar">
        <div class="layout-width">
            <div class="navbar-header">
                <div class="d-flex">
                    {{-- LOGO --}}
                    <div class="navbar-brand-box horizontal-logo">
                        <a href="{{ route('dashboard') }}" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="{{ asset($systemSetting->logo ?? 'frontend/logo_black.png') }}" alt="Logo"
                                    style="width: 125px; height: 30px;">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset($systemSetting->logo ?? 'frontend/logo_black.png') }}" alt="Logo"
                                    style="width: 125px; height: 30px;">
                            </span>
                        </a>

                        <a href="{{ route('dashboard') }}" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="{{ asset($systemSetting->logo ?? 'frontend/logo_black.png') }}" alt="Logo"
                                    style="width: 125px; height: 30px;">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset($systemSetting->logo ?? 'frontend/logo_black.png') }}" alt="Logo"
                                    style="width: 125px; height: 30px;">
                            </span>
                        </a>
                    </div>
                    {{-- LOGO --}}

                    <div class="header-item flex-shrink-0 me-3 vertical-btn-wrapper">
                        <button type="button"
                            class="btn btn-sm px-0 fs-xl vertical-menu-btn topnav-hamburger border hamburger-icon"
                            id="topnav-hamburger-icon">
                            <i class='bx bx-chevrons-right arrow-right'></i>
                            <i class='bx bx-chevrons-left arrow-left'></i>
                        </button>
                    </div>

                    <h4 class="mb-sm-0 header-item page-title lh-base">@yield('title')</h4>
                </div>

                <div class="d-flex align-items-center">
                    <div class="dropdown ms-sm-3 header-item">
                        <button type="button" class="btn shadow-none" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="d-flex align-items-center">
                                <img class="rounded-circle header-profile-user"
                                    src="{{ Auth::user()->avatar ? asset(Auth::user()->avatar) : asset('backend/images/default_images/user_1.jpg') }}"
                                    alt="Header Avatar">
                                <span class="text-start ms-xl-2">
                                    <span
                                        class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{ ucfirst(Auth::user()->first_name) . ' ' . ucfirst(Auth::user()->last_name) ?? '' }}</span>
                                    <span
                                        class="d-none d-xl-block ms-1 fs-sm user-name-sub-text">{{ ucfirst(Auth::user()->role) ?? '' }}</span>
                                </span>
                            </span>
                        </button>

                        <div class="dropdown-menu dropdown-menu-end" style="">
                            <h6 class="dropdown-header">
                                {{ 'Welcome ' . ucfirst(Auth::user()->first_name) . ' ' . ucfirst(Auth::user()->last_name) . '!' ?? '' }}
                            </h6>
                            <a class="dropdown-item" href="{{ route('profile.setting') }}"><i
                                    class="mdi mdi-account-circle text-muted fs-lg align-middle me-1"></i>
                                <span class="align-middle">Profile</span></a>
                            <a class="dropdown-item" href="{{ route('system.index') }}"><i
                                    class="mdi mdi-cog-outline text-muted fs-lg align-middle me-1"></i> <span
                                    class="align-middle">Settings</span></a>
                            <a class="dropdown-item" href="javascript:void(0);"
                                onclick="event.preventDefault(); document.getElementById('logoutForm').submit()"><i
                                    class="mdi mdi-logout text-muted fs-lg align-middle me-1"></i> <span
                                    class="align-middle" data-key="t-logout">Logout</span></a>
                            <form action="{{ route('logout') }}" method="post" id="logoutForm">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
</div>
