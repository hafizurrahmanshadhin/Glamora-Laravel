@extends('frontend.app')

@section('title', 'Client Dashboard')

@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/css/dashboard.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/categories.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/tarek.css') }}">

    <style>
        .star input[type="radio"] {
            display: none;
        }

        .star svg {
            cursor: pointer;
        }

        .star svg path {
            fill: none;
            stroke: #FFCC47;
            stroke-width: 2;
        }

        .star.selected svg path,
        .star.hover svg path {
            fill: #FFCC47;
            stroke: #FFCC47;
        }
    </style>

    <style>
        .armie-message {
            position: relative;
        }

        /* Tooltip container */
        .armie-message::after {
            content: "Send Message";
            position: absolute;
            top: -40px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #333;
            color: #fff;
            padding: 4px 8px;
            font-size: 14px;
            border-radius: 4px;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s ease-in-out;
            white-space: nowrap;
        }

        /* Show tooltip on hover */
        .armie-message:hover::after {
            opacity: 1;
        }

        /* Appointment done tooltip */
        .appointment-done {
            position: relative;
        }

        .appointment-done::after {
            content: "Complete Appointment and give review";
            position: absolute;
            top: -40px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #333;
            color: #fff;
            padding: 4px 8px;
            font-size: 14px;
            border-radius: 4px;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s ease-in-out;
            white-space: nowrap;
        }

        .appointment-done:hover::after {
            opacity: 1;
        }

        /* Appointment cancel tooltip */
        .appointment-cancel {
            position: relative;
        }

        .appointment-cancel::after {
            content: "Cancel the Booking and send report";
            position: absolute;
            top: -40px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #333;
            color: #fff;
            padding: 4px 8px;
            font-size: 14px;
            border-radius: 4px;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s ease-in-out;
            white-space: nowrap;
        }

        .appointment-cancel:hover::after {
            opacity: 1;
        }
    </style>
@endpush

@section('content')
    <div class="dashboard-layout section-padding-x" style="padding-top: 20px;">
        <div class="dashboard-left">
            <div class="dashboard-profile-container" style="min-height: 300px;">
                <div class="top">
                    <div class="img-content">
                        <img src="{{ asset(Auth::user()->avatar ?? 'backend/images/default_images/user_1.jpg') }}"
                            alt="">
                        <div class="active-status"></div>
                    </div>
                    <div class="text-content">
                        <div class="profile-title">
                            {{ ucfirst(Auth::user()->first_name ?? '') . ' ' . ucfirst(Auth::user()->last_name ?? '') ?? '' }}
                        </div>
                        <div class="profile-text">{{ Auth::user()->address ?? '' }}</div>
                    </div>
                </div>
                <div class="bottom">
                    <div class="bottom-top">
                        <div class="item">
                            <div class="title">Upcoming Bookings ({{ $upcomingBookings->count() }})</div>
                        </div>
                        <div class="item">
                            <div class="title">Pending Requests ({{ $pendingRequests->count() }})</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="dashboard-main-content">
            <div class="dashboard-banner">
                <div class="text-content">
                    <div class="title-italic">Welcome back,</div>
                    <div class="banner-title">
                        {{ Auth::user()->first_name . ' ' . Auth::user()->last_name ?? '' }}
                    </div>
                    <div class="text">
                        {!! $userDashboardContent->description ?? '' !!}
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
                                            <img src="{{ $booking->userService->user->avatar
                                                ? asset($booking->userService->user->avatar)
                                                : asset('backend/images/default_images/user_1.jpg') }}"
                                                alt="user" />
                                            <div class="tm-active-status"></div>
                                        </div>
                                        <div class="upcoming-apointments-user-name-city">
                                            <h5>
                                                {{ ucfirst($booking->userService->user->first_name) . ' ' . ucfirst($booking->userService->user->last_name) ?? '' }}
                                            </h5>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <a class="armie-message"
                                            href="{{ route('chat', $booking->userService->user->id) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                                viewBox="0 0 32 32" fill="none">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M7.33333 5C6.45513 5 5.60918 5.35501 4.98262 5.99291C4.35547 6.63142 4 7.50118 4 8.41176V20.1765C4 21.0871 4.35547 21.9568 4.98262 22.5953C5.60918 23.2332 6.45512 23.5882 7.33333 23.5882H10.2222C10.7745 23.5882 11.2222 24.0359 11.2222 24.5882V27.2173L16.9232 23.7349C17.0801 23.639 17.2605 23.5882 17.4444 23.5882H24.6667C25.5449 23.5882 26.3908 23.2332 27.0174 22.5953C27.6445 21.9568 28 21.0871 28 20.1765V8.41176C28 7.50118 27.6445 6.63142 27.0174 5.99291C26.3908 5.35501 25.5449 5 24.6667 5H7.33333ZM3.55578 4.59144C4.55454 3.57461 5.913 3 7.33333 3H24.6667C26.087 3 27.4455 3.57461 28.4442 4.59144C29.4424 5.60766 30 6.98221 30 8.41176V20.1765C30 21.606 29.4424 22.9806 28.4442 23.9968C27.4455 25.0136 26.087 25.5882 24.6667 25.5882H17.7257L10.7435 29.8534C10.4349 30.0419 10.0484 30.0491 9.73299 29.8722C9.41753 29.6952 9.22222 29.3617 9.22222 29V25.5882H7.33333C5.913 25.5882 4.55454 25.0136 3.55578 23.9968C2.55763 22.9806 2 21.606 2 20.1765V8.41176C2 6.98221 2.55763 5.60766 3.55578 4.59144ZM9.22222 11.3529C9.22222 10.8007 9.66994 10.3529 10.2222 10.3529H21.7778C22.3301 10.3529 22.7778 10.8007 22.7778 11.3529C22.7778 11.9052 22.3301 12.3529 21.7778 12.3529H10.2222C9.66994 12.3529 9.22222 11.9052 9.22222 11.3529ZM9.22222 17.2353C9.22222 16.683 9.66994 16.2353 10.2222 16.2353H18.8889C19.4412 16.2353 19.8889 16.683 19.8889 17.2353C19.8889 17.7876 19.4412 18.2353 18.8889 18.2353H10.2222C9.66994 18.2353 9.22222 17.7876 9.22222 17.2353Z"
                                                    fill="#222222" />
                                            </svg>
                                        </a>

                                        <a class="appointment-done" data-booking-id="{{ $booking->id }}"
                                            data-bs-toggle="modal" data-bs-target="#appointmentDone">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                                fill="none" viewBox="0 0 32 32">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M16 3C8.82 3 3 8.82 3 16C3 23.18 8.82 29 16 29C23.18 29 29 23.18 29 16C29 8.82 23.18 3 16 3ZM16 27C9.93 27 5 22.07 5 16C5 9.93 9.93 5 16 5C22.07 5 27 9.93 27 16C27 22.07 22.07 27 16 27ZM14.59 20.59L10.59 16.59L9.17 18L14.59 23.41L22.83 15.17L21.41 13.76L14.59 20.59Z"
                                                    fill="#222222" />
                                            </svg>
                                        </a>

                                        <a class="appointment-cancel ms-3" data-booking-id="{{ $booking->id }}"
                                            data-bs-toggle="modal" data-bs-target="#refundConfirmationModal">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                                fill="none" viewBox="0 0 32 32">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M16 3C8.82 3 3 8.82 3 16C3 23.18 8.82 29 16 29
                                                                                             C23.18 29 29 23.18 29 16C29 8.82 23.18 3 16 3ZM11 11
                                                                                             L21 21M21 11L11 21"
                                                    stroke="#222" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                <div class="upcoming-apointment-devider"></div>
                                <div class="explore-card-heading-para">
                                    <h4>
                                        {{ \Carbon\Carbon::parse($booking->appointment_date)->format('D, M j') }}
                                        at {{ \Carbon\Carbon::parse($booking->appointment_time)->format('g:i A') }}
                                    </h4>

                                    <div
                                        class="armie-service-location-type d-flex align-items-center justify-content-between">
                                        <p class="armie-service-type-name">
                                            {!! $booking->servicesText !!}
                                        </p>
                                    </div>
                                    <div class="check-availability-bookmarks">
                                        <a
                                            href="{{ route('service-provider-profile', [
                                                'userId' => $booking->userService->user->id,
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

                {{-- Pending Requests Start --}}
                <div class="upcoming-apointment-section">
                    <div class="armie-event-view-all d-flex align-items-center justify-content-between">
                        <h1 class="tm-dashboard-heading">Pending Requests</h1>
                    </div>
                    <div class="categories-tax-card-wrapper armie-upcoming-appointment-card-wrapper">
                        @forelse($pendingRequests as $booking)
                            <div class="explore-tax-single-card">
                                <div class="upcoming-apointments-user">
                                    <div class="upcoming-apointments-user-img-name">
                                        <div class="upcoming-apointments-user-img">
                                            <img src="{{ $booking->userService->user->avatar
                                                ? asset($booking->userService->user->avatar)
                                                : asset('backend/images/default_images/user_1.jpg') }}"
                                                alt="user" />
                                            <div class="tm-active-status"></div>
                                        </div>
                                        <div class="upcoming-apointments-user-name-city">
                                            {{ ucfirst($booking->userService->user->first_name) . ' ' . ucfirst($booking->userService->user->last_name) ?? '' }}
                                        </div>
                                    </div>
                                </div>
                                <div class="upcoming-apointment-devider"></div>
                                <div class="explore-card-heading-para">
                                    {{ \Carbon\Carbon::parse($booking->appointment_date)->format('D, M j') }}
                                    at {{ $booking->appointment_time }}
                                    <div
                                        class="armie-service-location-type d-flex align-items-center justify-content-between">
                                        <p class="armie-service-type-name">
                                            {!! $booking->servicesText !!}
                                        </p>
                                    </div>
                                    <div class="check-availability-bookmarks">
                                        <a
                                            href="{{ route('service-provider-profile', [
                                                'userId' => $booking->userService->user->id,
                                                'serviceId' => $booking->userService->service->id,
                                            ]) }}">
                                            View
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>You have no pending requests.</p>
                        @endforelse
                    </div>
                </div>
                {{-- Pending Requests End --}}
            </section>
        </div>
    </div>

    {{-- Modal-1: Experience Share Start --}}
    <div class="modal fade" id="appointmentDone" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body tm-modal-body">
                    <h2>Is your appointment Completed?</h2>
                    <p class="modal-para">Help us to let know your experience.</p>
                    <div class="tm-multistep-btn-wrapper">
                        <button class="tm-multi-step-submit-form" type="button" data-bs-toggle="modal"
                            data-bs-target="#appointmentReview">
                            Yes, Done
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal-1: Experience Share End --}}

    {{-- Refund Confirmation Modal Start --}}
    <div class="modal fade" id="refundConfirmationModal" tabindex="-1" aria-labelledby="refundConfirmationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h2>Refund will not provided</h2>
                    <p>Are you sure you want to proceed? This will cancel your appointment and no refund will be provided.
                    </p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" onclick="confirmRefundNotProvided()">Yes</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Refund Confirmation Modal End --}}

    {{-- Modal-2: Experience Share Start --}}
    <div class="modal fade" id="appointmentReview" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body tm-modal-body tm-modal-body-armie-review">
                    <form action="{{ route('client-dashboard.review') }}" method="POST">
                        @csrf
                        <input type="hidden" name="booking_id" value="">
                        <div class="tm-modal-review-div">
                            <h2>Share your experience of Appointment session</h2>
                            <div class="tm-modal-review-star-wrapper">
                                @for ($i = 1; $i <= 5; $i++)
                                    <input type="radio" id="star{{ $i }}" name="rating"
                                        value="{{ $i }}" hidden required>
                                    <label for="star{{ $i }}" class="star">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                            viewBox="0 0 40 40" fill="none">
                                            <path
                                                d="M22.8842 5.85002L25.8175 11.7167C26.2175 12.5334 27.2842 13.3167 28.1842 13.4667L33.5008 14.35C36.9008 14.9167 37.7008 17.3834 35.2508 19.8167L31.1175 23.95C30.4175 24.65 30.0342 26 30.2508 26.9667L31.4342 32.0834C32.3675 36.1334 30.2175 37.7 26.6342 35.5834L21.6508 32.6334C20.7508 32.1 19.2675 32.1 18.3508 32.6334L13.3675 35.5834C9.80083 37.7 7.63416 36.1167 8.56749 32.0834L9.75082 26.9667C9.96749 26 9.58416 24.65 8.88416 23.95L4.75082 19.8167C2.31749 17.3834 3.10083 14.9167 6.50083 14.35L11.8175 13.4667C12.7008 13.3167 13.7675 12.5334 14.1675 11.7167L17.1008 5.85002C18.7008 2.66669 21.3008 2.66669 22.8842 5.85002Z"
                                                fill="none" stroke="#FFCC47" stroke-width="2" />
                                        </svg>
                                    </label>
                                @endfor
                            </div>
                            <p class="modal-para modal-para-armie">
                                Tell others about the appointment
                            </p>
                            <textarea class="tm-modal-textarea" name="review" rows="3" placeholder="Write message here..." required></textarea>
                        </div>
                        <div class="tm-multistep-btn-wrapper w-100">
                            <button type="submit" class="tm-multi-step-submit-form tm-dashboard-booking-landing-btn-1">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal-2: Experience Share End --}}

    {{-- Modal-3: Appointment not done (Report) Start --}}
    <div class="modal fade" id="appointmentReview2" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body tm-modal-body tm-modal-body-armie-review">
                    <form action="{{ route('client-dashboard.report') }}" method="POST">
                        @csrf
                        <input type="hidden" name="booking_id" value="{{ $booking->id ?? '' }}">
                        <div class="appointment-not-done-area">
                            <div class="tm-modal-review-div">
                                <h2>Wasn't complete your appointment?</h2>
                                <div class="tm-report-textarea">
                                    <p>Make A Report</p>
                                    <textarea class="tm-modal-textarea" name="message" rows="3" placeholder="Write your report here..." required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="tm-multistep-btn-wrapper w-100">
                            <button type="submit" class="tm-multi-step-submit-form tm-dashboard-booking-landing-btn-2">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal-3: Appointment not done End --}}
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Star rating handling (existing code)
            const stars = document.querySelectorAll('.star');
            const radios = document.querySelectorAll('input[name="rating"]');

            function updateStars(selectedValue) {
                stars.forEach((star, index) => {
                    if (index < selectedValue) {
                        star.classList.add('selected');
                    } else {
                        star.classList.remove('selected');
                    }
                });
            }

            function handleMouseOver(index) {
                stars.forEach((star, i) => {
                    if (i <= index) star.classList.add('hover');
                    else star.classList.remove('hover');
                });
            }

            function handleMouseOut() {
                stars.forEach((star) => star.classList.remove('hover'));
                const checkedStar = document.querySelector('input[name="rating"]:checked');
                const value = checkedStar ? parseInt(checkedStar.value) : 0;
                updateStars(value);
            }

            radios.forEach((radio) => {
                radio.addEventListener('change', function() {
                    const value = parseInt(this.value);
                    updateStars(value);
                });
            });

            stars.forEach((star, index) => {
                star.addEventListener('mouseover', function() {
                    handleMouseOver(index);
                });
                star.addEventListener('mouseout', function() {
                    handleMouseOut();
                });
                star.addEventListener('click', function() {
                    const radio = document.getElementById(`star${index + 1}`);
                    if (radio) {
                        radio.checked = true;
                        updateStars(index + 1);
                    }
                });
            });
        });
    </script>

    <script>
        // Ensure bookingIdForCancellation is set from the appointment-done elements
        let bookingIdForCancellation = null;

        document.querySelectorAll('.appointment-done').forEach(function(element) {
            element.addEventListener('click', function() {
                bookingIdForCancellation = this.getAttribute('data-booking-id');
                console.log("Selected booking ID:", bookingIdForCancellation);
            });
        });

        document.querySelectorAll('.appointment-cancel').forEach(function(element) {
            element.addEventListener('click', function() {
                bookingIdForCancellation = this.getAttribute('data-booking-id');
                console.log("Selected booking ID for cancel:", bookingIdForCancellation);
            });
        });

        function confirmRefundNotProvided() {
            axios.delete("{{ route('client-dashboard.cancel-booking') }}", {
                    data: {
                        booking_id: bookingIdForCancellation
                    }
                })
                .then(function(response) {
                    if (response.data.status === 'success') {
                        $('#refundConfirmationModal').modal('hide');
                        $('#appointmentReview2').modal('show');
                    } else {
                        toastr.error(response.data.message || 'Failed to cancel booking.');
                    }
                })
                .catch(function(error) {
                    console.error(error);
                    toastr.error('Error occurred while canceling appointment.');
                });
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.appointment-done').forEach(function(element) {
                element.addEventListener('click', function() {
                    const bookingId = this.getAttribute('data-booking-id');
                    const reviewModalBookingIdField = document.querySelector(
                        '#appointmentReview input[name="booking_id"]');
                    if (reviewModalBookingIdField) {
                        reviewModalBookingIdField.value = bookingId;
                    }
                });
            });
        });
    </script>
@endpush
