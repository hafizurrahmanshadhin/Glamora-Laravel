@php
    $systemSetting = App\Models\SystemSetting::first();
@endphp

<div class="app-menu navbar-menu">
    {{-- Logo & Toggle Button --}}
    <div class="navbar-brand-box">
        <a href="{{ route('dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset($systemSetting->logo ?? 'frontend/logo_black.png') }}" alt="Logo"
                    style="width: 190px; height: 50px;">
            </span>
            <span class="logo-lg">
                <img src="{{ asset($systemSetting->logo ?? 'frontend/logo_black.png') }}" alt="Logo"
                    style="width: 190px; height: 50px;">
            </span>
        </a>

        <a href="{{ route('dashboard') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset($systemSetting->logo ?? 'frontend/logo_black.png') }}" alt="Logo"
                    style="width: 190px; height: 50px;">
            </span>
            <span class="logo-lg">
                <img src="{{ asset($systemSetting->logo ?? 'frontend/logo_black.png') }}" alt="Logo"
                    style="width: 190px; height: 50px;">
            </span>
        </a>

        <button type="button" class="btn btn-sm p-0 fs-3xl header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>

        <div class="vertical-menu-btn-wrapper header-item vertical-icon">
            <button type="button"
                class="btn btn-sm px-0 fs-xl vertical-menu-btn topnav-hamburger shadow hamburger-icon"
                id="topnav-hamburger-icon">
                <i class='bx bx-chevrons-right'></i>
                <i class='bx bx-chevrons-left'></i>
            </button>
        </div>
    </div>
    {{-- Logo & Toggle Button --}}

    <div id="scrollbar">
        {{-- Sidebar Start --}}
        <div class="container-fluid">
            <div id="two-column-menu"></div>
            <ul class="navbar-nav" id="navbar-nav">
                {{-- Dashboard --}}
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="ri-dashboard-line"></i>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>

                {{-- Users --}}
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('admin/user*') ? 'active' : '' }}"
                        href="#sidebarUsers" data-bs-toggle="collapse" role="button"
                        aria-expanded="{{ request()->is('admin/user*') ? 'true' : 'false' }}"
                        aria-controls="sidebarUsers">
                        <i class="ri-group-line"></i>
                        <span data-key="t-users">Users</span>
                    </a>

                    <div class="collapse menu-dropdown {{ request()->is('admin/user*') ? 'show' : '' }}"
                        id="sidebarUsers">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('user.client.index') }}"
                                    class="nav-link {{ request()->routeIs('user.client.index') ? 'active' : '' }}"
                                    data-key="t-client">
                                    Client
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('user.beauty-expert.index') }}"
                                    class="nav-link {{ request()->routeIs('user.beauty-expert.index') ? 'active' : '' }}"
                                    data-key="t-beauty-expert">
                                    Beauty Expert
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- Service --}}
                <li class="nav-item">
                    <a href="{{ route('service.index') }}"
                        class="nav-link menu-link {{ request()->routeIs('service.*') ? 'active' : '' }}">
                        <i class="ri-tools-line"></i>
                        <span data-key="t-faq">Service</span>
                    </a>
                </li>

                {{-- Image Approval Request --}}
                <li class="nav-item">
                    <a href="{{ route('image-approval-request.index') }}"
                        class="nav-link menu-link {{ request()->routeIs('image-approval-request.*') ? 'active' : '' }}">
                        <i class="ri-image-edit-line"></i>
                        <span data-key="t-faq" style="white-space: nowrap">Image Approval Request</span>
                    </a>
                </li>

                {{-- Frequently Asked Questions --}}
                <li class="nav-item">
                    <a href="{{ route('faq.index') }}"
                        class="nav-link menu-link {{ request()->routeIs('faq.*') ? 'active' : '' }}">
                        <i class="ri-question-line"></i>
                        <span data-key="t-faq">FAQ</span>
                    </a>
                </li>

                {{-- Contacts --}}
                <li class="nav-item">
                    <a href="{{ route('contacts.index') }}"
                        class="nav-link menu-link {{ request()->routeIs('contacts.*') ? 'active' : '' }}">
                        <i class="ri-contacts-book-line"></i>
                        <span data-key="t-Contact">Contacts</span>
                    </a>
                </li>

                {{-- Testimonial --}}
                <li class="nav-item">
                    <a href="{{ route('testimonial.index') }}"
                        class="nav-link menu-link {{ request()->routeIs('testimonial.index') ? 'active' : '' }}">
                        <i class="ri-chat-quote-line"></i>
                        <span data-key="t-dashboard">Testimonial</span>
                    </a>
                </li>

                {{-- Report --}}
                <li class="nav-item">
                    <a href="{{ route('report.index') }}"
                        class="nav-link menu-link {{ request()->routeIs('report.index') ? 'active' : '' }}">
                        <i class="ri-alert-line"></i>
                        <span data-key="t-dashboard">Report</span>
                    </a>
                </li>

                {{-- Newsletter Subscriptions --}}
                <li class="nav-item">
                    <a href="{{ route('newsletter-subscription.index') }}"
                        class="nav-link menu-link {{ request()->routeIs('newsletter-subscription.index') ? 'active' : '' }}">
                        <i class="ri-mail-line"></i>
                        <span data-key="t-dashboard" style="white-space: nowrap">Newsletter Subscriptions</span>
                    </a>
                </li>

                {{-- Booking Cancellation List --}}
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('admin/booking-cancellation*') ? 'active' : '' }}"
                        href="#bookingCancellation" data-bs-toggle="collapse" role="button"
                        aria-expanded="{{ request()->is('admin/booking-cancellation*') ? 'true' : 'false' }}"
                        aria-controls="bookingCancellation">
                        <i class="ri-close-circle-line"></i>
                        <span data-key="t-booking-cancellation" style="white-space: nowrap">Booking
                            Cancellation</span>
                    </a>

                    <div class="collapse menu-dropdown {{ request()->is('admin/booking-cancellation*') ? 'show' : '' }}"
                        id="bookingCancellation">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('before-payment.index') }}"
                                    class="nav-link {{ request()->routeIs('before-payment.index') ? 'active' : '' }}"
                                    data-key="t-before-payment">
                                    Before Payment
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('after-payment.index') }}"
                                    class="nav-link {{ request()->routeIs('after-payment.index') ? 'active' : '' }}"
                                    data-key="t-after-payment">
                                    After Payment
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>


                <hr>
                {{-- CMS Sidebar --}}
                @include('backend.partials.cms-sidebar')
                <hr>
                {{-- Settings Sidebar --}}
                @include('backend.partials.settings-sidebar')
            </ul>
        </div>
        {{-- Sidebar End --}}
    </div>

    <div class="sidebar-background"></div>
</div>
<div class="vertical-overlay"></div>
