@extends('frontend.app')

@section('title', 'Beauty Expert Dashboard')

@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/css/dashboard.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/categories.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/tarek.css') }}">

    <style>
        .profile-availability {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            margin-top: 24px;
            border-bottom: 1px solid #BABABA;
            padding-bottom: 16px;
        }

        .profile-availability-left {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }

        .profile-availability-right {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .profile-availability-left h4 {
            color: #6B6B6B;
        }

        .profile-availability-left h4,
        .profile-availability-right h4 {
            font-size: 16px;
            font-weight: 400;
        }

        .profile-availability-right .point {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background-color: #6B6B6B;
        }

        .profile-availability-right .point.available {
            background-color: #27AE60;
        }

        .profile-availability .form-check-input {
            cursor: pointer;
        }

        .profile-availability .form-check-input:checked {
            background-color: #27AE60;
            border-color: #27AE60;
            box-shadow: none;
        }

        .profile-availability .form-check-input:focus {
            box-shadow: none;
        }
    </style>
@endpush

@section('content')
    <div class="dashboard-layout section-padding-x">
        <div class="dashboard-left">
            <div class="dashboard-profile-container">
                <div class="">
                    <div style=" padding-bottom: 0 !important; border-bottom: 0 !important; " class="top">
                        <div class="img-content">
                            <img src="{{ Auth::user()->businessInformation?->avatar ? asset(Auth::user()->businessInformation->avatar) : asset('backend/images/default_images/user_1.jpg') }}"
                                alt="">
                            <div class="active-status"></div>
                        </div>
                        <div class="text-content">
                            <div class="profile-title">
                                {{ ucfirst(Auth::user()->first_name) . ' ' . ucfirst(Auth::user()->last_name) ?? '' }}
                            </div>
                            <div class="profile-text">{{ Auth::user()->businessInformation?->business_address ?? '' }}</div>
                        </div>
                    </div>
                    <div class="profile-availability">
                        <div class="profile-availability-left">
                            <h4>Availability</h4>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked">
                                <label class="form-check-label" for="flexSwitchCheckChecked">
                            </div>
                        </div>
                        <div class="profile-availability-right">
                            <h4 class="availability-status">Unavailable</h4>
                            <div class="point"></div>
                        </div>
                    </div>
                </div>

                <div class="bottom">
                    <div class="bottom-top">
                        <div class="item">
                            <div class="title">Rating as buyer</div>
                            <div class="ratings">
                                @if ($averageRating)
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= floor($averageRating))
                                            ★
                                        @elseif($i - floor($averageRating) == 0.5)
                                            ☆
                                        @else
                                            ☆
                                        @endif
                                    @endfor
                                    <span>({{ number_format($averageRating, 1) }})</span>
                                @else
                                    ★★★★☆ <span>(0.0)</span>
                                @endif
                            </div>
                        </div>
                        <div class="item">
                            <div class="title">Upcoming Bookings ({{ $upcomingBookings->count() }})</div>
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
                    <div class="banner-title">
                        {{ ucfirst(Auth::user()->first_name) . ' ' . ucfirst(Auth::user()->last_name) ?? '' }}
                    </div>
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

            <section class="armie-appointment-wrapper">
                {{-- Upcoming Appointments Start --}}
                <div class="upcoming-apointment-section">
                    <div class="armie-event-view-all d-flex align-items-center justify-content-between">
                        <h1 class="tm-dashboard-heading">Upcoming Appointments</h1>
                    </div>

                    <div class="categories-tax-card-wrapper armie-upcoming-appointment-card-wrapper">
                        @forelse($upcomingBookings as $booking)
                            <div class="explore-tax-single-card">
                                <div class="upcoming-apointments-user">
                                    <div class="upcoming-apointments-user-img-name">
                                        <div class="upcoming-apointments-user-img">
                                            <img src="{{ $booking->user->avatar ? asset($booking->user->avatar) : asset('backend/images/default_images/user_1.jpg') }}"
                                                alt="client" />
                                            <div class="tm-active-status"></div>
                                        </div>
                                        <div class="upcoming-apointments-user-name-city">
                                            <h5>
                                                {{ ucfirst($booking->user->first_name) . ' ' . ucfirst($booking->user->last_name) ?? '' }}
                                            </h5>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <a class="armie-message" href="">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                                viewBox="0 0 32 32" fill="none">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M7.33333 5C6.45513 5 5.60918 5.35501 4.98262 5.99291C4.35547 6.63142 4 7.50118 4 8.41176V20.1765C4 21.0871 4.35547 21.9568 4.98262 22.5953C5.60918 23.2332 6.45512 23.5882 7.33333 23.5882H10.2222C10.7745 23.5882 11.2222 24.0359 11.2222 24.5882V27.2173L16.9232 23.7349C17.0801 23.639 17.2605 23.5882 17.4444 23.5882H24.6667C25.5449 23.5882 26.3908 23.2332 27.0174 22.5953C27.6445 21.9568 28 21.0871 28 20.1765V8.41176C28 7.50118 27.6445 6.63142 27.0174 5.99291C26.3908 5.35501 25.5449 5 24.6667 5H7.33333ZM3.55578 4.59144C4.55454 3.57461 5.913 3 7.33333 3H24.6667C26.087 3 27.4455 3.57461 28.4442 4.59144C29.4424 5.60766 30 6.98221 30 8.41176V20.1765C30 21.606 29.4424 22.9806 28.4442 23.9968C27.4455 25.0136 26.087 25.5882 24.6667 25.5882H17.7257L10.7435 29.8534C10.4349 30.0419 10.0484 30.0491 9.73299 29.8722C9.41753 29.6952 9.22222 29.3617 9.22222 29V25.5882H7.33333C5.913 25.5882 4.55454 25.0136 3.55578 23.9968C2.55763 22.9806 2 21.606 2 20.1765V8.41176C2 6.98221 2.55763 5.60766 3.55578 4.59144ZM9.22222 11.3529C9.22222 10.8007 9.66994 10.3529 10.2222 10.3529H21.7778C22.3301 10.3529 22.7778 10.8007 22.7778 11.3529C22.7778 11.9052 22.3301 12.3529 21.7778 12.3529H10.2222C9.66994 12.3529 9.22222 11.9052 9.22222 11.3529ZM9.22222 17.2353C9.22222 16.683 9.66994 16.2353 10.2222 16.2353H18.8889C19.4412 16.2353 19.8889 16.683 19.8889 17.2353C19.8889 17.7876 19.4412 18.2353 18.8889 18.2353H10.2222C9.66994 18.2353 9.22222 17.7876 9.22222 17.2353Z"
                                                    fill="#222222" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                <div class="upcoming-apointment-devider"></div>
                                <div class="explore-card-heading-para">
                                    <h4>
                                        {{ \Carbon\Carbon::parse($booking->appointment_date)->format('D, M j') }}
                                        at {{ $booking->appointment_time }}
                                    </h4>
                                    <div
                                        class="armie-service-location-type d-flex align-items-center justify-content-between">
                                        <p class="armie-service-type-name">
                                            {{ $booking->userService->service->services_name ?? '' }}
                                        </p>
                                    </div>
                                    <div class="check-availability-bookmarks">
                                        <a
                                            href="{{ route('service-provider-profile', [
                                                'userId' => $booking->user->id,
                                                'serviceId' => $booking->userService->service->id,
                                            ]) }}">
                                            View
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>No upcoming appointments found.</p>
                        @endforelse
                    </div>
                </div>
                {{-- Upcoming Appointments End --}}
            </section>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const checkbox = document.getElementById("flexSwitchCheckChecked");
            const statusText = document.querySelector(".availability-status");
            const point = document.querySelector(".point");

            function updateAvailability() {
                if (checkbox.checked) {
                    statusText.textContent = "Available";
                    point.classList.add("available");
                } else {
                    statusText.textContent = "Unavailable";
                    point.classList.remove("available");
                }
            }

            checkbox.addEventListener("change", updateAvailability);
            updateAvailability(); // Ensure initial state is correct
        });
    </script>
@endpush
