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
            content: "Cancel this appointment";
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
    </style>

    <style>
        #calendar {
            display: none;
        }

        .unavailable-container {
            display: none;
            margin-top: 16px;
            /* grid-template-columns: repeat(2, 1fr); */
            gap: 16px;
            /* align-items: end; */
            flex-direction: column;
        }

        .unavailable-container h6 {
            margin-bottom: 4px;
            font-size: 14px;
            font-weight: 500;
        }

        .date-picker-container-from,
        .date-picker-container-to {
            position: relative;
            cursor: pointer;
        }

        .date-picker-container-from input,
        .date-picker-container-to input {
            width: 100%;
            padding: 8px 36px 8px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #fff;
        }

        .date-picker-container-from svg,
        .date-picker-container-to svg {
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
        }

        /* Add a style to highlight the green days */
        .green-highlight {
            background-color: #70e862 !important;
            color: #fff !important;
            border-radius: 50%;
        }
    </style>


    <style>
        /* custom override */
        #weekendModal .modal-dialog {
            max-width: 400px;
        }

        .availability-container {
            width: 100%;
        }

        .day-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 10px 0;
        }

        .day-label {
            flex: 1;
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .time-selectors {
            flex: 2;
            display: flex;
            gap: 10px;
        }

        select {
            padding: 6px;
            border-radius: 6px;
            border: 1px solid #ccc;
            min-width: 100px;
        }

        .remove-btn {
            background: none;
            border: none;
            color: black;
            font-size: 18px;
            cursor: pointer;
        }

        /* Add your red-highlight class */
        .red-highlight {
            background-color: #808080 !important;
            color: #000 !important;
            border-radius: 50%;
        }
    </style>

    <style>
        .delete-range:hover {
            background-color: #dc3545 !important;
            color: white !important;
            transform: scale(1.05);
        }

        .delete-range:active {
            transform: scale(0.95);
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

                    <div class="profile-availability">
                        <div class="profile-availability-left">
                            <h4>Availability</h4>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
                                    {{ $availability === 'available' ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                            </div>
                        </div>
                        <div class="profile-availability-right">
                            <h4 class="availability-status">
                                {{ $availability === 'available' ? 'Available' : 'Unavailable' }}
                            </h4>
                            <div class="point {{ $availability === 'available' ? 'available' : '' }}"></div>
                        </div>
                    </div>

                    {{-- Date-range + Save --}}
                    @php
                        $hasWindow = !is_null($user->unavailable_from) && !is_null($user->unavailable_to);
                    @endphp
                    <div class="unavailable-container"
                        style="{{ $availability === 'unavailable' ? 'display: flex;' : 'display: none;' }}">
                        <div id="unavailable-ranges">
                            @if (!empty($user->unavailable_ranges))
                                @foreach ($user->unavailable_ranges as $index => $range)
                                    <div class="range-row" data-index="{{ $index ?? '' }}" style="margin-top: 8px;">
                                        <div class="row" style="align-items: center;">
                                            <div class="col-md-5">
                                                <h6>From</h6>
                                                <div class="date-picker-container-from">
                                                    <input style="padding-right: 8px" class="range-from"
                                                        placeholder="DD/MM/YY" readonly
                                                        value="{{ isset($range['from_date']) ? \Carbon\Carbon::createFromFormat('d/m/Y', $range['from_date'])->format('d/m/Y') : '' }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="20"
                                                        viewBox="0 0 19 20" fill="none">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M13.9109…"
                                                            fill="#767676" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <h6>To</h6>
                                                <div class="date-picker-container-to">
                                                    <input style="padding-right: 8px" class="range-to"
                                                        placeholder="DD/MM/YY" readonly
                                                        value="{{ isset($range['to_date']) ? \Carbon\Carbon::createFromFormat('d/m/Y', $range['to_date'])->format('d/m/Y') : '' }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="20"
                                                        viewBox="0 0 19 20" fill="none">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M13.9109…"
                                                            fill="#767676" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="col-md-2 d-flex align-items-end" style="margin-top: 23.5px">
                                                <button type="button" class="delete-range"
                                                    data-index="{{ $index ?? '' }}" title="Delete this range"
                                                    style="background: #f8f9fa; border: 1px solid #dee2e6; border-radius: 50px; color: #dc3545; font-size: 18px; font-weight: bold; height: 28px; width: 28px; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center; hover:background-color: #dc3545; hover:color: white; padding: 0;">
                                                    ×
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                {{-- Fallback: show a single blank range --}}
                                <div class="range-row" data-index="0">
                                    <div class="row" style="align-items: center;">
                                        <div class="col-md-5">
                                            <h6>From</h6>
                                            <div class="date-picker-container-from">
                                                <input style="padding-right: 8px" class="range-from" placeholder="DD/MM/YY"
                                                    readonly value="">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="20"
                                                    viewBox="0 0 19 20" fill="none">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M13.9109…"
                                                        fill="#767676" />
                                                </svg>
                                            </div>
                                        </div>

                                        <div class="col-md-5">
                                            <h6>To</h6>
                                            <div class="date-picker-container-to">
                                                <input style="padding-right: 8px" class="range-to" placeholder="DD/MM/YY"
                                                    readonly value="">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="20"
                                                    viewBox="0 0 19 20" fill="none">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M13.9109…"
                                                        fill="#767676" />
                                                </svg>
                                            </div>
                                        </div>

                                        <div class="col-md-2 d-flex align-items-end" style="margin-top: 23.5px">
                                            <button type="button" class="delete-range" data-index="{{ $index ?? '' }}"
                                                title="Delete this range"
                                                style="background: #f8f9fa; border: 1px solid #dee2e6; border-radius: 50px; color: #dc3545; font-size: 18px; font-weight: bold; height: 28px; width: 28px; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center; hover:background-color: #dc3545; hover:color: white; padding: 0;">
                                                ×
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div
                            style="display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); align-items: center; gap: 8px; margin-top: 8px;">
                            <button type="button" class="common-btn" style="grid-column: span 2 / span 2;"
                                id="add-unavailability-range">Add Another</button>
                            <button id="save-unavailability" class="common-btn">Save</button>
                        </div>
                    </div>
                </div>

                <div class="bottom">
                    <div class="bottom-top">
                        <div class="item">
                            <div class="title">Rating</div>
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
                        <a type="button" class="common-btn" data-bs-toggle="modal" data-bs-target="#weekendModal"
                            style="margin-bottom: 1px;">
                            My Weekly Availability
                        </a>

                        <a href="{{ route('edit-profile') }}" class="common-btn">
                            View Profile
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

                <div class="img-content d-flex align-items-center justify-content-center ps-4">
                    <input type="text" id="calendar" />
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
                                        <a class="armie-message" href="{{ route('chat', $booking->user->id) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                                viewBox="0 0 32 32" fill="none">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M7.33333 5C6.45513 5 5.60918 5.35501 4.98262 5.99291C4.35547 6.63142 4 7.50118 4 8.41176V20.1765C4 21.0871 4.35547 21.9568 4.98262 22.5953C5.60918 23.2332 6.45512 23.5882 7.33333 23.5882H10.2222C10.7745 23.5882 11.2222 24.0359 11.2222 24.5882V27.2173L16.9232 23.7349C17.0801 23.639 17.2605 23.5882 17.4444 23.5882H24.6667C25.5449 23.5882 26.3908 23.2332 27.0174 22.5953C27.6445 21.9568 28 21.0871 28 20.1765V8.41176C28 7.50118 27.6445 6.63142 27.0174 5.99291C26.3908 5.35501 25.5449 5 24.6667 5H7.33333ZM3.55578 4.59144C4.55454 3.57461 5.913 3 7.33333 3H24.6667C26.087 3 27.4455 3.57461 28.4442 4.59144C29.4424 5.60766 30 6.98221 30 8.41176V20.1765C30 21.606 29.4424 22.9806 28.4442 23.9968C27.4455 25.0136 26.087 25.5882 24.6667 25.5882H17.7257L10.7435 29.8534C10.4349 30.0419 10.0484 30.0491 9.73299 29.8722C9.41753 29.6952 9.22222 29.3617 9.22222 29V25.5882H7.33333C5.913 25.5882 4.55454 25.0136 3.55578 23.9968C2.55763 22.9806 2 21.606 2 20.1765V8.41176C2 6.98221 2.55763 5.60766 3.55578 4.59144ZM9.22222 11.3529C9.22222 10.8007 9.66994 10.3529 10.2222 10.3529H21.7778C22.3301 10.3529 22.7778 10.8007 22.7778 11.3529C22.7778 11.9052 22.3301 12.3529 21.7778 12.3529H10.2222C9.66994 12.3529 9.22222 11.9052 9.22222 11.3529ZM9.22222 17.2353C9.22222 16.683 9.66994 16.2353 10.2222 16.2353H18.8889C19.4412 16.2353 19.8889 16.683 19.8889 17.2353C19.8889 17.7876 19.4412 18.2353 18.8889 18.2353H10.2222C9.66994 18.2353 9.22222 17.7876 9.22222 17.2353Z"
                                                    fill="#222222" />
                                            </svg>
                                        </a>

                                        <a class="appointment-done" data-bs-toggle="modal"
                                            data-bs-target="#appointmentDone" data-booking-id="{{ $booking->id }}"
                                            style="cursor: pointer;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                                fill="none" viewBox="0 0 32 32">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M16 3C8.82 3 3 8.82 3 16C3 23.18 8.82 29 16 29C23.18 29 29 23.18 29 16C29 8.82 23.18 3 16 3ZM16 27C9.93 27 5 22.07 5 16C5 9.93 9.93 5 16 5C22.07 5 27 9.93 27 16C27 22.07 22.07 27 16 27ZM11.29 11.29L16 16L20.71 11.29L22.12 12.71L17.41 16L22.12 19.29L20.71 20.71L16 17.41L11.29 20.71L9.88 19.29L14.59 16L9.88 12.71L11.29 11.29Z"
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
                                            {!! $booking->servicesText !!}
                                        </p>
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

    {{-- Appointments Cancel Modal Start --}}
    <div class="modal fade" id="appointmentDone" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body tm-modal-body">
                    <h2>Do you want to cancel this appointment?</h2>
                    <div class="tm-multistep-btn-wrapper">
                        <button id="confirmCancellationBtn" class="tm-multi-step-submit-form" type="button">
                            Yes
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Appointments Cancel Modal End --}}


    {{-- Weekend Modal Start --}}
    <div class="modal fade" id="weekendModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h3 class="modal-title text-center w-100">Set Availability</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="availability"></div>
                </div>
                <div class="modal-footer border-0">
                    <button class="common-btn w-100" id="saveWeekendBtn" data-bs-dismiss="modal">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- Weekend Modal End --}}


    {{-- Booking Details of specific Date Details Modal Start --}}
    <div class="modal fade" id="dateDetailsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-calendar-day"></i>
                        Appointment Details
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body modal-scrollbar" id="dateDetailsModalBody"
                    style="max-height: 500px; overflow-y: auto;">
                    {{-- Dynamically filled content --}}
                </div>
            </div>
        </div>
    </div>
    {{-- Booking Details of specific Date Details Modal End --}}
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Prevent multiple initialization
            if (window.availabilityInitialized) {
                return;
            }
            window.availabilityInitialized = true;

            // Global array for unchecked days of week (0=SUN,1=MON,...6=SAT)
            window.unselectedDaysOfWeek = window.unselectedDaysOfWeek || [];

            const highlightDates = @json($highlightDates);
            // "disableDates" is an array of { from: "YYYY-MM-DD", to: "YYYY-MM-DD" }
            // representing current disabled ranges
            let disableDates = @json($unavailableRanges);

            // Initialize the embedded calendar
            window.calendar = flatpickr("#calendar", {
                inline: true,
                defaultDate: "today",
                disable: disableDates,
                onDayCreate: function(dObj, dStr, fp, dayElem) {
                    const dateString = fp.formatDate(dayElem.dateObj, "Y-m-d");

                    if (highlightDates.includes(dateString)) {
                        dayElem.classList.add("green-highlight");
                        dayElem.style.cursor = "pointer";

                        dayElem.addEventListener("click", function() {
                            axios.get("{{ route('booking.details.by.date') }}", {
                                    params: {
                                        date: dateString
                                    }
                                })
                                .then(response => {
                                    const {
                                        bookings
                                    } = response.data;
                                    const modalBody = document.getElementById(
                                        "dateDetailsModalBody");
                                    modalBody.innerHTML = "";

                                    if (bookings.length > 0) {
                                        bookings.forEach(b => {
                                            const avatarUrl = b.user.avatar ?
                                                "{{ url('/') }}".replace(
                                                    /\/$/, '') + '/' + b.user
                                                .avatar :
                                                "{{ asset('backend/images/default_images/user_1.jpg') }}";

                                            // Format the date to be user-friendly
                                            const appointmentDate = new Date(b
                                                .appointment_date);
                                            const formattedDate = appointmentDate
                                                .toLocaleDateString('en-US', {
                                                    weekday: 'short',
                                                    year: 'numeric',
                                                    month: 'short',
                                                    day: 'numeric'
                                                });

                                            const div = document.createElement(
                                                "div");
                                            div.classList.add("p-3", "mb-3",
                                                "border", "rounded");
                                            div.innerHTML = `
                                                <div class="d-flex align-items-start">
                                                    <img src="${avatarUrl}" alt="Client Avatar"
                                                         style="width:50px;height:50px;border-radius:50%;object-fit:cover;margin-right:15px;">
                                                    <div>
                                                        <p class="mb-1"><strong>Client:</strong>
                                                            ${b.user.first_name} ${b.user.last_name}
                                                        </p>
                                                        <p class="mb-1">
                                                            <strong>Date:</strong> ${formattedDate},
                                                            <strong>Time:</strong> ${b.appointment_time}
                                                        </p>
                                                        <p class="mb-1"><strong>Services:</strong><br>
                                                            ${b.services_text ?? "N/A"}
                                                        </p>
                                                    </div>
                                                </div>
                                            `;
                                            modalBody.appendChild(div);
                                        });
                                    } else {
                                        modalBody.innerHTML =
                                            "<p>No details found for this date.</p>";
                                    }

                                    const myModal = new bootstrap.Modal(document
                                        .getElementById("dateDetailsModal"));
                                    myModal.show();
                                })
                                .catch(err => {
                                    console.error(err);
                                    toastr.error("Could not fetch appointment details.");
                                });
                        });
                    }

                    // Highlight unselected weekdays in red
                    const dayOfWeek = dayElem.dateObj.getDay();
                    if (window.unselectedDaysOfWeek.includes(dayOfWeek)) {
                        dayElem.classList.add("red-highlight");
                    }
                }
            });

            // Coloring previous cancellation messages (not related to the range logic)
            const storedMessage = localStorage.getItem('cancellationMessage');
            if (storedMessage) {
                toastr.success(storedMessage);
                localStorage.removeItem('cancellationMessage');
            }

            // Main availability toggle
            const checkbox = document.getElementById("flexSwitchCheckChecked");
            const statusText = document.querySelector(".availability-status");
            const point = document.querySelector(".point");
            const unavailableContainer = document.querySelector(".unavailable-container");

            function showAvailable() {
                statusText.textContent = "Available";
                point.classList.add("available");
                unavailableContainer.style.display = "none";
                // Clear out local input fields
                document.querySelectorAll(".range-from, .range-to").forEach(el => el.value = "");

                axios.post("{{ route('toggle-availability') }}", {
                        status: "available"
                    })
                    .then(() => {
                        toastr.success("You are now Available");
                        disableDates = [];
                        window.calendar.set("disable", disableDates);
                        window.calendar.redraw();
                    })
                    .catch(err => {
                        toastr.error(err.response?.data?.message || "Error updating availability");
                    });
            }

            function showUnavailable() {
                statusText.textContent = "Unavailable";
                point.classList.remove("available");
                unavailableContainer.style.display = "grid";
            }

            checkbox.onchange = function() {
                this.checked ? showAvailable() : showUnavailable();
            };

            // Convert dd/mm/yyyy => yyyy-mm-dd
            function convertToYYYYMMDD(dateStr) {
                const [day, month, year] = dateStr.split("/");
                return `${year}-${month.padStart(2, "0")}-${day.padStart(2, "0")}`;
            }

            // Setup flatpickr on new range inputs
            function initRangePickers(rangeRow) {
                const fromInput = rangeRow.querySelector(".range-from");
                const toInput = rangeRow.querySelector(".range-to");

                // Destroy existing flatpickr instances if they exist
                if (fromInput._flatpickr) {
                    fromInput._flatpickr.destroy();
                }
                if (toInput._flatpickr) {
                    toInput._flatpickr.destroy();
                }

                flatpickr(fromInput, {
                    dateFormat: "d/m/Y",
                    minDate: "today",
                    defaultDate: fromInput.value || null
                });
                flatpickr(toInput, {
                    dateFormat: "d/m/Y",
                    minDate: "today",
                    defaultDate: toInput.value || null
                });
            }

            // Initialize pickers for any existing range row
            document.querySelectorAll(".range-row").forEach(row => initRangePickers(row));

            // Use event delegation for both "Add Another" and "Delete" buttons
            document.body.addEventListener("click", function(e) {
                // Handle "Add Another" button
                if (e.target && e.target.id === "add-unavailability-range") {
                    e.preventDefault();
                    e.stopPropagation();
                    e.stopImmediatePropagation();

                    const container = document.getElementById("unavailable-ranges");
                    const index = container.querySelectorAll(".range-row").length;

                    // Create a new range row with blank inputs and delete button
                    const newRow = document.createElement("div");
                    newRow.className = "range-row";
                    newRow.setAttribute("data-index", index);
                    newRow.style.marginTop = "8px";
                    newRow.innerHTML = `
                        <div class="row" style="align-items: center;">
                            <div class="col-md-5">
                                <h6>From</h6>
                                <div class="date-picker-container-from">
                                    <input style="padding-right: 8px" class="range-from" placeholder="DD/MM/YY" readonly value="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="20"
                                        viewBox="0 0 19 20" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M13.9109…"
                                            fill="#767676" />
                                    </svg>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <h6>To</h6>
                                <div class="date-picker-container-to">
                                    <input style="padding-right: 8px" class="range-to" placeholder="DD/MM/YY" readonly value="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="20"
                                        viewBox="0 0 19 20" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M13.9109…"
                                            fill="#767676" />
                                    </svg>
                                </div>
                            </div>

                            <div class="col-md-2 d-flex align-items-end" style="margin-top: 23.5px">
                                <button type="button" class="delete-range"
                                    data-index="{{ $index ?? '' }}" title="Delete this range"
                                    style="background: #f8f9fa; border: 1px solid #dee2e6; border-radius: 50px; color: #dc3545; font-size: 18px; font-weight: bold; height: 28px; width: 28px; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center; hover:background-color: #dc3545; hover:color: white; padding: 0;">
                                    ×
                                </button>
                            </div>
                        </div>
                    `;
                    container.appendChild(newRow);
                    // Initialize flatpickr for our new inputs
                    initRangePickers(newRow);
                }

                // Handle delete button clicks
                if (e.target && e.target.classList.contains("delete-range")) {
                    e.preventDefault();

                    const rangeRow = e.target.closest(".range-row");
                    const container = document.getElementById("unavailable-ranges");
                    const allRanges = container.querySelectorAll(".range-row");

                    // If this is the only range and it has no values, don't delete
                    if (allRanges.length === 1) {
                        const fromInput = rangeRow.querySelector(".range-from");
                        const toInput = rangeRow.querySelector(".range-to");
                        if (!fromInput.value && !toInput.value) {
                            toastr.warning("Cannot delete the last empty range.");
                            return;
                        }
                    }

                    // Remove the range directly without confirmation
                    rangeRow.remove();

                    // If no ranges left, add one empty range
                    if (container.querySelectorAll(".range-row").length === 0) {
                        const emptyRow = document.createElement("div");
                        emptyRow.className = "range-row";
                        emptyRow.setAttribute("data-index", 0);
                        emptyRow.style.marginTop = "8px";
                        emptyRow.innerHTML = `
                            <div class="row" style="align-items: center;">
                                <div class="col-md-5">
                                    <h6>From</h6>
                                    <div class="date-picker-container-from">
                                        <input style="padding-right: 8px" class="range-from" placeholder="DD/MM/YY" readonly value="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="20"
                                            viewBox="0 0 19 20" fill="none">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M13.9109…"
                                                fill="#767676" />
                                        </svg>
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <h6>To</h6>
                                    <div class="date-picker-container-to">
                                        <input style="padding-right: 8px" class="range-to" placeholder="DD/MM/YY" readonly value="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="20"
                                            viewBox="0 0 19 20" fill="none">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M13.9109…"
                                                fill="#767676" />
                                        </svg>
                                    </div>
                                </div>

                                <div class="col-md-2 d-flex align-items-end" style="margin-top: 23.5px">
                                    <button type="button" class="delete-range"
                                        data-index="{{ $index ?? '' }}" title="Delete this range"
                                        style="background: #f8f9fa; border: 1px solid #dee2e6; border-radius: 50px; color: #dc3545; font-size: 18px; font-weight: bold; height: 28px; width: 28px; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center; hover:background-color: #dc3545; hover:color: white; padding: 0;">
                                        ×
                                    </button>
                                </div>
                            </div>
                        `;
                        container.appendChild(emptyRow);
                        initRangePickers(emptyRow);
                    }

                    toastr.success("Date range deleted locally. Click 'Save' to update.");
                }
            });

            // Handle saving multiple ranges
            const saveBtn = document.getElementById("save-unavailability");
            saveBtn.onclick = function() {
                // Gather all from/to pairs
                const rows = document.querySelectorAll(".range-row");
                const rangesToSend = [];
                for (let row of rows) {
                    const fromVal = row.querySelector(".range-from").value.trim();
                    const toVal = row.querySelector(".range-to").value.trim();
                    if (fromVal && toVal) {
                        rangesToSend.push({
                            from_date: fromVal,
                            to_date: toVal
                        });
                    }
                }
                if (!rangesToSend.length) {
                    return toastr.error("Please set at least one 'From' and 'To' dates.");
                }

                // Post all ranges to the server
                axios.post("{{ route('toggle-availability') }}", {
                        status: "unavailable",
                        ranges: rangesToSend
                    })
                    .then(r => {
                        if (r.data.status === "success") {
                            toastr.success("Unavailability ranges saved successfully");

                            // Update the UI based on current availability returned from server
                            const currentAvailability = r.data.current_availability;
                            if (currentAvailability === 'available') {
                                statusText.textContent = "Available";
                                point.classList.add("available");
                                checkbox.checked = true;
                            } else {
                                statusText.textContent = "Unavailable";
                                point.classList.remove("available");
                                checkbox.checked = false;
                            }

                            // Update local disableDates to reflect all new ranges
                            disableDates = [];
                            for (const rng of rangesToSend) {
                                disableDates.push({
                                    from: convertToYYYYMMDD(rng.from_date),
                                    to: convertToYYYYMMDD(rng.to_date)
                                });
                            }
                            window.calendar.set("disable", disableDates);
                            window.calendar.redraw();
                        } else {
                            toastr.error(r.data.message || "Save failed");
                        }
                    })
                    .catch(err => {
                        toastr.error(err.response?.data?.message || "Error saving unavailability");
                    });
            };

            // If the user is already "unavailable," show the container
            @if ($availability === 'unavailable')
                showUnavailable();
            @endif
        });
    </script>

    <script>
        // If there's a stored message, show it after page load
        document.addEventListener('DOMContentLoaded', function() {
            const storedMessage = localStorage.getItem('cancellationMessage');
            if (storedMessage) {
                toastr.success(storedMessage);
                localStorage.removeItem('cancellationMessage');
            }
        });

        let bookingIdForCancellation = null;
        document.querySelectorAll('.appointment-done').forEach(function(element) {
            element.addEventListener('click', function() {
                bookingIdForCancellation = this.getAttribute('data-booking-id');
            });
        });

        document.getElementById('confirmCancellationBtn').addEventListener('click', function() {
            if (!bookingIdForCancellation) {
                return;
            }
            axios.post('{{ route('booking-cancellation-after-appointments') }}', {
                    booking_id: bookingIdForCancellation
                })
                .then(function(response) {
                    if (response.data.status) {
                        // Save success message, then reload
                        localStorage.setItem('cancellationMessage', response.data.message ||
                            'Appointment canceled successfully.');
                        location.reload();
                    } else {
                        alert(response.data.message || 'Failed to cancel appointment.');
                    }
                })
                .catch(function(error) {
                    console.error(error);
                    alert('Error occurred while canceling appointment.');
                });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const availabilityContainer = document.getElementById('availability');
            const existingWeekendData = @json(Auth::user()->weekend_data ?? []);
            if (availabilityContainer.dataset.built) return;
            availabilityContainer.dataset.built = 'true';

            // Days: 0=SUN,1=MON,2=TUE,3=WED,4=THU,5=FRI,6=SAT
            const days = ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'];
            const times = Array.from({
                length: 24
            }, (_, i) => {
                const hour = i % 12 === 0 ? 12 : i % 12;
                const ampm = i < 12 ? 'AM' : 'PM';
                return `${hour}:00 ${ampm}`;
            });

            // Build the modal day/time rows
            days.forEach((day, index) => {
                const row = document.createElement('div');
                row.className = 'day-row';
                row.innerHTML = `
                <div class="day-label">
                    <input class="form-check-input" type="checkbox" id="check-${day}">
                    <label for="check-${day}">${day}</label>
                </div>
                <div class="time-selectors" id="time-${day}">
                    <select class="start-time" disabled>
                        <option value="">Select</option>
                        ${times.map(t => `<option value="${t}">${t}</option>`).join('')}
                    </select>
                    <select class="end-time" disabled>
                        <option value="">Select</option>
                        ${times.map(t => `<option value="${t}">${t}</option>`).join('')}
                    </select>
                </div>
            `;
                availabilityContainer.appendChild(row);

                // If database has this day as selected, pre-check
                const existing = existingWeekendData.find(item => item.day === index);
                if (existing) {
                    const checkbox = row.querySelector(`#check-${day}`);
                    const startSel = row.querySelector('.start-time');
                    const endSel = row.querySelector('.end-time');
                    checkbox.checked = true;
                    startSel.disabled = false;
                    endSel.disabled = false;
                    startSel.value = existing.time_from || '';
                    endSel.value = existing.time_to || '';
                }

                // Toggle time selects when the checkbox changes
                const checkbox = row.querySelector(`#check-${day}`);
                const selects = row.querySelectorAll('select');
                checkbox.addEventListener('change', () => {
                    const isChecked = checkbox.checked;
                    selects.forEach(s => {
                        s.disabled = !isChecked;
                        if (!isChecked) s.selectedIndex = 0;
                    });
                });
            });

            // Figure out which days are currently "unselected" and highlight them in red on load
            window.unselectedDaysOfWeek = [0, 1, 2, 3, 4, 5, 6];
            existingWeekendData.forEach(d => {
                const idx = window.unselectedDaysOfWeek.indexOf(d.day);
                if (idx !== -1) window.unselectedDaysOfWeek.splice(idx, 1);
            });

            // Redraw calendar so unselected days become red
            if (window.calendar) {
                window.calendar.redraw();
            }

            // Save data to DB + re-highlight
            const saveWeekendBtn = document.getElementById('saveWeekendBtn');
            saveWeekendBtn.addEventListener('click', () => {
                window.unselectedDaysOfWeek = [];
                const dayCheckboxes = availabilityContainer.querySelectorAll(
                    '.day-label input[type="checkbox"]');
                const selectedDays = [];

                dayCheckboxes.forEach((cb, idx) => {
                    if (cb.checked) {
                        const row = cb.closest('.day-row');
                        const startTime = row.querySelector('.start-time').value;
                        const endTime = row.querySelector('.end-time').value;
                        selectedDays.push({
                            day: idx,
                            time_from: startTime,
                            time_to: endTime
                        });
                    } else {
                        window.unselectedDaysOfWeek.push(idx);
                    }
                });

                if (window.calendar) {
                    window.calendar.redraw();
                }

                axios.post("{{ route('store-weekend-data') }}", {
                        weekend_data: selectedDays
                    })
                    .then((r) => {
                        if (r.data.status === 'success') {
                            toastr.success(r.data.message);
                        } else {
                            toastr.error('Could not save weekend data');
                        }
                    })
                    .catch((err) => {
                        toastr.error(err.response?.data?.message || "Error saving weekend data");
                    });
            });
        });
    </script>
@endpush
