@extends('frontend.app')

@section('title', 'Negotiated Date and Time')

@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/css/dashboard.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/tarek.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/categories.css') }}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
@endpush

@section('content')
    <div class="dashboard-layout section-padding-x">
        <div class="dashboard-left">
            <div class="dashboard-profile-container">
                <div class="top">
                    <div class="img-content">
                        <img src="{{ Auth::user()->businessInformation?->avatar ? asset(Auth::user()->businessInformation->avatar) : asset('backend/images/default_images/user_1.jpg') }}"
                            alt>
                        <div class="active-status"></div>
                    </div>
                    <div class="text-content">
                        <div class="profile-title">
                            {{ ucfirst(Auth::user()->first_name) . ' ' . ucfirst(Auth::user()->last_name) ?? '' }}</div>
                        <div class="profile-text">
                            @if (Auth::user()->role === 'beauty_expert')
                                {{ Auth::user()->businessInformation?->business_address ?? '' }}
                            @else
                                {{ Auth::user()->email ?? '' }}
                            @endif
                        </div>
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
                            <a class="profile-view-btn" href>View</a>
                        </div>
                    </div>
                    <div class="bottom-bottom">
                        <a href class="common-btn">
                            View Bookings
                        </a>
                    </div>
                </div>
            </div>
        </div>

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
                                                <p class="genarel-para-new-bold">Bronx, New York, United States</p>
                                            </div>
                                        </div>

                                        <div class="tm-multi-step-summary-item-component">
                                            <div class="tm-multi-step-summary-item-component-left">
                                                <img src="{{ asset('frontend/images/shopping-bag.svg') }}" alt="location">
                                            </div>
                                            <div class="tm-multi-step-summary-item-component-right">
                                                <p class="genarel-para-new">Stylist comes to you in</p>
                                                <p class="genarel-para-new-bold">Bronx, New York, United States</p>
                                            </div>
                                        </div>

                                        <div class="tm-multi-step-summary-item-component">
                                            <div class="tm-multi-step-summary-item-component-left">
                                                <img src="{{ asset('frontend/images/shopping-bag.svg') }}" alt="location">
                                            </div>
                                            <div class="tm-multi-step-summary-item-component-right">
                                                <p class="genarel-para-new">Services</p>
                                                <p class="genarel-para-new-bold">2x People</p>
                                                <p class="genarel-para-new new-makeup-notice">Bridesmaid makeup only
                                                    Bride Mackup Only</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tm-multi-step-summary-item">
                                    <h3>Pricing & Inclusions</h3>
                                    <div class="tm-new-summary-important-info-wrapper">
                                        <div class="tm-new-summary-important-info">
                                            <p class="genarel-para-new">Book with a deposit of $0 $250 payable on the day
                                            </p>
                                            <a href="#" class="location-p"> View inclusions & cancellation policy</a>
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
                        <h3>Are you Available at this time?</h3>
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
                        <div class="tm-available-label-input-wrapper">
                            <label for="appointment-date">Date:</label>
                            <div class="date-input-wrapper">
                                <input type="text" id="appointment-date-new" class="date-input"
                                    placeholder="09 | Oct | 2024" disabled />
                            </div>
                        </div>

                        <div class="tm-available-label-input-wrapper">
                            <label for="appointment-time">Time:</label>
                            <select id="appointment-time" class="time-dropdown" disabled>
                                <option value disabled selected>Select Time</option>
                                <option value="08:00 AM">08:00 AM</option>
                                <option value="09:00 AM">09:00 AM</option>
                                <option value="10:00 AM">10:00 AM</option>
                                <option value="11:00 AM">11:00 AM</option>
                                <option value="12:00 PM">12:00 PM</option>
                                <option value="01:00 PM">01:00 PM</option>
                                <option value="02:00 PM">02:00 PM</option>
                                <option value="03:00 PM">03:00 PM</option>
                                <option value="04:00 PM">04:00 PM</option>
                                <option value="05:00 PM">05:00 PM</option>
                                <option value="06:00 PM">06:00 PM</option>
                                <option value="07:00 PM">07:00 PM</option>
                                <option value="08:00 PM">08:00 PM</option>
                                <option value="09:00 PM">09:00 PM</option>
                                <option value="10:00 PM">10:00 PM</option>
                                <option value="11:00 PM">11:00 PM</option>
                                <option value="12:00 AM">12:00 AM</option>
                                <option value="01:00 AM">01:00 AM</option>
                                <option value="02:00 AM">02:00 AM</option>
                                <option value="03:00 AM">03:00 AM</option>
                                <option value="04:00 AM">04:00 AM</option>
                                <option value="05:00 AM">05:00 AM</option>
                                <option value="06:00 AM">06:00 AM</option>
                                <option value="07:00 AM">07:00 AM</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="confirm-time-lower-area">
                    <button class="cancel-btn">Cancel</button>
                    <button class="submit-btn">I’m Available </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script src="{{ asset('frontend/js/joint-client.js') }}"></script>

    <script>
        (function() {
            // Alert for submit button
            document.querySelector('.submit-btn').addEventListener('click', () => {
                alert('Booking Request Sent!');
            });

            // Alert for cancel button
            document.querySelector('.cancel-btn').addEventListener('click', () => {
                alert('Booking Canceled!');
            });

            // Handle label active state
            const labels = document.querySelectorAll('.confirm-time-left-label-wrapper label');
            labels.forEach((label) => {
                label.addEventListener('click', () => {
                    labels.forEach((lbl) => lbl.classList.remove('active')); // Remove active from all
                    label.classList.add('active'); // Add active to clicked
                });
            });

            // Handle enabling/disabling of date and time fields and other UI changes
            document.addEventListener('DOMContentLoaded', function() {
                const radioButtons = document.querySelectorAll('input[name="availability"]');
                const dateInput = document.getElementById('appointment-date-new');
                const timeDropdown = document.getElementById('appointment-time');
                const negotiateNotice = document.querySelector('.negotiate-time-notice');
                const submitButton = document.querySelector('.submit-btn');

                // Initially hide the notice and set the submit button text
                negotiateNotice.style.display = 'none';
                submitButton.textContent = 'I’m Available';

                // Enable or disable fields and toggle visibility/text
                function toggleFieldsAndUI(enable) {
                    if (enable) {
                        dateInput.removeAttribute('disabled');
                        timeDropdown.removeAttribute('disabled');
                        negotiateNotice.style.display = 'block';
                        submitButton.textContent = 'Send Offer';

                        // Change background to white
                        dateInput.style.background = '#fff';
                        timeDropdown.style.background = '#fff';
                        dateInput.style.border = '1px solid #222';
                        timeDropdown.style.border = '1px solid #222';
                    } else {
                        dateInput.setAttribute('disabled', 'disabled');
                        timeDropdown.setAttribute('disabled', 'disabled');
                        negotiateNotice.style.display = 'none';
                        submitButton.textContent = 'I’m Available';

                        // Revert background to default
                        dateInput.style.background = '#E9E9E9';
                        timeDropdown.style.background = '#E9E9E9';
                        dateInput.style.border = '1px solid transparent';
                        timeDropdown.style.border = '1px solid transparent';
                    }
                }

                // Initially disable the fields
                toggleFieldsAndUI(false);

                // Add event listeners to radio buttons
                radioButtons.forEach((radio) => {
                    radio.addEventListener('change', function() {
                        if (this.value === 'no') {
                            toggleFieldsAndUI(true);
                        } else {
                            toggleFieldsAndUI(false);
                        }
                    });
                });
            });

            // Initialize jQuery Datepicker with custom format
            $(function() {
                $('#appointment-date-new').datepicker({
                    dateFormat: 'dd M yy', // Internal date format (for consistency)
                    changeMonth: true,
                    changeYear: true,
                    showButtonPanel: true,
                    onSelect: function(dateText) {
                        // Format date as shown in the image: "09 | Oct | 2024"
                        const dateObj = $(this).datepicker('getDate');
                        const formattedDate = $.datepicker.formatDate('dd | M | yy', dateObj);
                        $('#appointment-date-new').val(formattedDate);
                    },
                });
            });
        })();
    </script>
@endpush
