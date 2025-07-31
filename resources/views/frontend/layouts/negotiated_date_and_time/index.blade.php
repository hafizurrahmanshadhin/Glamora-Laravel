@extends('frontend.app')

@section('title', 'Negotiated Date and Time')

@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/css/dashboard.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/tarek.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/categories.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/custom-downloaded-cdn/jquery-ui.css') }}">
@endpush

@section('content')
    <div class="dashboard-layout section-padding-x">
        <div class="dashboard-main-content">
            <div class="multistepform-section-2">
                <div class="tm-multi-step-form-container">
                    {{-- Booking Summary --}}
                    <div class="tm-multi-step-form-step-booking-details">
                        <h2 class="tm-multistep-form-heading tm-multistep-form-heading-2">Negotiated Time and Date</h2>
                        <div class="tm-multi-step-summary">
                            <div class="tm-multi-step-summary-item">
                                <h3>Date:
                                    <span id="summary-date">
                                        {{ \Carbon\Carbon::parse($booking->appointment_date)->format('l, F jS, Y') }}
                                    </span>
                                </h3>
                                <h3>Time: <span id="summary-time">{{ $booking->appointment_time ?? '' }}</span></h3>
                            </div>

                            <div class="tm-booking-summary-new-design">
                                <div class="tm-multi-step-summary-item">
                                    <h3>Pricing & Inclusions</h3>
                                    <div class="tm-multi-step-summary-item-component-wrapper">
                                        <div class="tm-multi-step-summary-item-component">
                                            <div class="tm-multi-step-summary-item-component-left">
                                                <img src="{{ asset('frontend/images/location.svg') }}" alt="location">
                                            </div>
                                            <div class="tm-multi-step-summary-item-component-right">
                                                <p class="genarel-para-new">Stylist comes to you in</p>
                                                <p class="genarel-para-new-bold">{{ $booking->user->address ?? '' }}</p>
                                            </div>
                                        </div>
                                        @foreach ($selectedServices as $userService)
                                            <div class="tm-multi-step-summary-item-component">
                                                <div class="tm-multi-step-summary-item-component-left">
                                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <g id="vuesax/linear/shopping-bag">
                                                            <g id="shopping-bag">
                                                                <path id="Vector"
                                                                    d="M11.2 8.66699H20.8C25.3334 8.66699 25.7867 10.787 26.0934 13.3737L27.2934 23.3737C27.68 26.6537 26.6667 29.3337 22 29.3337H10.0134C5.33337 29.3337 4.32003 26.6537 4.72003 23.3737L5.92004 13.3737C6.21338 10.787 6.6667 8.66699 11.2 8.66699Z"
                                                                    stroke="#FFB6C1" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path id="Vector_2"
                                                                    d="M10.6719 10.667V6.00033C10.6719 4.00033 12.0052 2.66699 14.0052 2.66699H18.0052C20.0052 2.66699 21.3385 4.00033 21.3385 6.00033V10.667"
                                                                    stroke="#FFB6C1" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path id="Vector_3" d="M27.2185 22.707H10.6719"
                                                                    stroke="#FFB6C1" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                            </g>
                                                        </g>
                                                    </svg>
                                                </div>
                                                <div class="tm-multi-step-summary-item-component-right">
                                                    <p class="genarel-para-new">Service:</p>
                                                    <p class="genarel-para-new-bold">
                                                        {{ $userService->service->services_name ?? 'Service' }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="tm-multi-step-summary-item">
                                    <h3>Pricing & Inclusions</h3>
                                    <div class="tm-new-summary-important-info-wrapper">
                                        <div class="tm-new-summary-important-info">
                                            <p class="genarel-para-new">Book with a deposit of $0 $250 payable on the day
                                            </p>
                                            <a href="{{ route('inclusions-cancellation') }}" class="location-p"
                                                target="_blank">
                                                View inclusions & cancellation policy
                                            </a>
                                            <p class="genarel-para-new tm-bonus-para">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path
                                                        d="M12 2C6.49 2 2 6.49 2 12C2 17.51 6.49 22 12 22C17.51 22 22 17.51 22 12C22 6.49 17.51 2 12 2ZM16.78 9.7L11.11 15.37C10.97 15.51 10.78 15.59 10.58 15.59C10.38 15.59 10.19 15.51 10.05 15.37L7.22 12.54C6.93 12.25 6.93 11.77 7.22 11.48C7.51 11.19 7.99 11.19 8.28 11.48L10.58 13.78L15.72 8.64C16.01 8.35 16.49 8.35 16.78 8.64C17.07 8.93 17.07 9.4 16.78 9.7Z"
                                                        fill="#222222" />
                                                </svg>
                                                Bonus! Includes Free Lashes
                                            </p>
                                        </div>
                                        <p class="tm-multi-step-summary-total">
                                            <span class="tm-multistep-total-value">${{ $booking->price ?? '' }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="confirm-time-div">
                <div class="confirm-time-upper-area">
                    <div class="confirm-time-left">
                        {{-- <h3>Are you Available at this time?</h3> --}}
                        <h3>What time would you need to start by?</h3>
                        <div class="confirm-time-left-label-wrapper">
                            <label>
                                <input type="radio" name="availability" value="yes" />
                                <span class="yes-no-select">Yes</span>
                            </label>
                            <label>
                                <input type="radio" name="availability" value="no" />
                                <span class="yes-no-select">No</span>
                            </label>
                        </div>
                        <p class="negotiate-time-notice">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path
                                    d="M12 16.462C12.1747 16.462 12.321 16.403 12.439 16.285C12.5563 16.167 12.615 16.0207 12.615 15.846C12.615 15.672 12.556 15.526 12.438 15.408C12.32 15.29 12.174 15.2307 12 15.23C11.826 15.2293 11.68 15.2883 11.562 15.407C11.444 15.5257 11.385 15.6717 11.385 15.845C11.385 16.0183 11.444 16.1647 11.562 16.284C11.68 16.4033 11.826 16.4633 12 16.462ZM11.5 13.153H12.5V7.153H11.5V13.153ZM12.003 21C10.759 21 9.589 20.764 8.493 20.292C7.39767 19.8193 6.44467 19.178 5.634 18.368C4.82333 17.558 4.18167 16.606 3.709 15.512C3.23633 14.418 3 13.2483 3 12.003C3 10.7577 3.23633 9.58767 3.709 8.493C4.181 7.39767 4.82133 6.44467 5.63 5.634C6.43867 4.82333 7.391 4.18167 8.487 3.709C9.583 3.23633 10.753 3 11.997 3C13.241 3 14.411 3.23633 15.507 3.709C16.6023 4.181 17.5553 4.82167 18.366 5.631C19.1767 6.44033 19.8183 7.39267 20.291 8.488C20.7637 9.58333 21 10.753 21 11.997C21 13.241 20.764 14.411 20.292 15.507C19.82 16.603 19.1787 17.556 18.368 18.366C17.5573 19.176 16.6053 19.8177 15.512 20.291C14.4187 20.7643 13.249 21.0007 12.003 21ZM12 20C14.2333 20 16.125 19.225 17.675 17.675C19.225 16.125 20 14.2333 20 12C20 9.76667 19.225 7.875 17.675 6.325C16.125 4.775 14.2333 4 12 4C9.76667 4 7.875 4.775 6.325 6.325C4.775 7.875 4 9.76667 4 12C4 14.2333 4.775 16.125 6.325 17.675C7.875 19.225 9.76667 20 12 20Z"
                                    fill="#222222" />
                            </svg>
                            You can Negotiate your Preferable Time and Date
                        </p>
                    </div>

                    <div class="confirm-time-right">
                        {{-- <div class="tm-available-label-input-wrapper"> --}}
                        <div class="tm-available-label-input-wrapper" style="display:none;">
                            <label for="appointment-date">Date:</label>
                            <div class="date-input-wrapper">
                                <input type="text" id="appointment-date-display" class="date-input"
                                    placeholder="09 | Oct | 2024"
                                    value="{{ \Carbon\Carbon::parse($booking->appointment_date)->format('d | M | Y') }}" />
                                <input type="hidden" id="appointment-date-new"
                                    value="{{ $booking->appointment_date->format('Y-m-d') }}" />
                            </div>
                        </div>

                        @php
                            $times = [
                                '08:00 AM',
                                '09:00 AM',
                                '10:00 AM',
                                '11:00 AM',
                                '12:00 PM',
                                '01:00 PM',
                                '02:00 PM',
                                '03:00 PM',
                                '04:00 PM',
                                '05:00 PM',
                                '06:00 PM',
                                '07:00 PM',
                                '08:00 PM',
                                '09:00 PM',
                                '10:00 PM',
                                '11:00 PM',
                                '12:00 AM',
                                '01:00 AM',
                                '02:00 AM',
                                '03:00 AM',
                                '04:00 AM',
                                '05:00 AM',
                                '06:00 AM',
                                '07:00 AM',
                            ];
                            $formattedTime = \Carbon\Carbon::parse($booking->appointment_time)->format('h:i A');
                        @endphp
                        <div class="tm-available-label-input-wrapper">
                            <label for="appointment-time">Time:</label>
                            <select id="appointment-time" class="time-dropdown" disabled>
                                <option value disabled {{ !$booking->appointment_time ? 'selected' : '' }}>Select Time
                                </option>
                                @foreach ($times as $time)
                                    <option value="{{ $time }}" {{ $formattedTime == $time ? 'selected' : '' }}>
                                        {{ $time }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="confirm-time-lower-area">
                    {{-- Cancel always shown --}}
                    <form action="{{ route('booking.respondAvailability') }}" method="POST">
                        @csrf
                        <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                        <input type="hidden" name="action_type" value="cancel">
                        <button type="submit" class="cancel-btn">Cancel</button>
                    </form>

                    {{-- “I’m Available” form (shown if availability=yes) --}}
                    <form action="{{ route('booking.respondAvailability') }}" method="POST" id="yesForm"
                        style="display:none;">
                        @csrf
                        <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                        <input type="hidden" name="action_type" value="yes">
                        <button type="submit" class="submit-btn" id="yesFormBtn" disabled>I’m Available</button>
                    </form>

                    {{-- “Send Offer” form (shown if availability=no) --}}
                    <form action="{{ route('booking.respondAvailability') }}" method="POST" id="noForm"
                        style="display:none;">
                        @csrf
                        <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                        <input type="hidden" name="action_type" value="offer">
                        <input type="hidden" name="new_date" id="hiddenNewDate">
                        <input type="hidden" name="new_time" id="hiddenNewTime">
                        <input type="hidden" name="new_price" value="{{ $booking->price }}">
                        <button type="submit" class="submit-btn">Send Offer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('frontend/custom-downloaded-cdn/jquery-ui.js') }}"></script>
    <script src="{{ asset('frontend/js/joint-client.js') }}"></script>

    <script>
        (function() {
            // Label active state for the availability radio group
            const labels = document.querySelectorAll('.confirm-time-left-label-wrapper label');
            labels.forEach((label) => {
                label.addEventListener('click', () => {
                    labels.forEach((lbl) => lbl.classList.remove('active'));
                    label.classList.add('active');
                });
            });

            // Main DOMContentLoaded logic
            document.addEventListener('DOMContentLoaded', function() {
                const radioButtons = document.querySelectorAll('input[name="availability"]');
                const dateInput = document.getElementById('appointment-date-new');
                const timeDropdown = document.getElementById('appointment-time');
                const negotiateNotice = document.querySelector('.negotiate-time-notice');

                // Forms in lower area
                const yesForm = document.getElementById('yesForm');
                const noForm = document.getElementById('noForm');
                const yesFormBtn = document.getElementById('yesFormBtn');

                // Initialize default state (no radio selected)
                yesForm.style.display = 'none';
                noForm.style.display = 'none';
                negotiateNotice.style.display = 'none';
                yesFormBtn.disabled = true;

                // Toggle function:
                // If isNoSelected is true, switch to "No" state (show noForm, enable date/time fields)
                // Otherwise, switch to "Yes" state (show yesForm and enable its button, disable date/time fields)
                function toggleFieldsAndUI(isNoSelected) {
                    const datePicker = $('#appointment-date-display');
                    const timeDropdown = document.getElementById('appointment-time');

                    if (isNoSelected) {
                        // Enable date and time inputs
                        datePicker.datepicker('enable');
                        timeDropdown.removeAttribute('disabled');
                        // Show relevant form
                        yesForm.style.display = 'none';
                        noForm.style.display = 'inline-block';
                    } else {
                        yesForm.style.display = 'inline-block';
                        noForm.style.display = 'none';
                        negotiateNotice.style.display = 'none';
                        dateInput.setAttribute('disabled', 'disabled');
                        timeDropdown.setAttribute('disabled', 'disabled');
                        yesFormBtn.disabled = false;
                    }
                }

                // Listen for changes on the radio buttons
                radioButtons.forEach((radio) => {
                    radio.addEventListener('change', function() {
                        if (this.value === 'no') {
                            toggleFieldsAndUI(true);
                        } else if (this.value === 'yes') {
                            toggleFieldsAndUI(false);
                        }
                    });
                });

                // Added code: hide yes/no block, default to "no," and trigger its logic
                document.querySelector('.confirm-time-left-label-wrapper').style.display = 'none';
                const noRadio = document.querySelector('input[name="availability"][value="no"]');
                noRadio.checked = true;
                toggleFieldsAndUI(true);
                // End of added code

                // Before Submit of noForm, update hidden fields with current date/time values
                noForm.addEventListener('submit', function(e) {
                    // Always use hidden ISO date value
                    document.getElementById('hiddenNewDate').value =
                        document.getElementById('appointment-date-new').value;

                    // Convert 12h time to 24h format
                    const time12h = document.getElementById('appointment-time').value;
                    const [time, modifier] = time12h.split(' ');
                    let [hours, minutes] = time.split(':');

                    if (modifier === 'PM' && hours !== '12') hours = parseInt(hours) + 12;
                    if (modifier === 'AM' && hours === '12') hours = '00';

                    document.getElementById('hiddenNewTime').value =
                        `${hours.toString().padStart(2, '0')}:${minutes}:00`;
                });
            });

            // jQuery datepicker initialization remains as before
            $(function() {
                // Initialize datepicker with dual format support
                const datePicker = $('#appointment-date-display').datepicker({
                    dateFormat: 'dd | M | yy', // Display format
                    altFormat: 'yy-mm-dd', // Hidden ISO format
                    altField: '#appointment-date-new',
                    changeMonth: true,
                    changeYear: true,
                    showButtonPanel: true,
                    beforeShow: function(input, inst) {
                        // Initialize with current ISO date
                        const isoDate = $('#appointment-date-new').val();
                        $(this).datepicker('setDate', new Date(isoDate));
                    }
                });

                // Initially disable if "No" isn't selected
                if (!document.querySelector('input[name="availability"][value="no"]:checked')) {
                    datePicker.datepicker('disable');
                }
            });
        })();
    </script>
@endpush
