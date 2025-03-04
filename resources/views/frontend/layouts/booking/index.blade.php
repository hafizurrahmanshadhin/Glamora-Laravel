@extends('frontend.app')

@section('title', 'Booking')

@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/css/tarek.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/categories.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/custom-downloaded-cdn/jquery-ui.css') }}">
@endpush

@section('content')
    <section class="multistepform-section section-padding-x">
        <div class="container">
            <form class="tm-multi-step-form-container" id="bookingForm">
                @csrf
                {{-- Hidden fields for Step 1/2 data --}}
                <input type="hidden" name="service_type" id="serviceType">
                <input type="hidden" name="appointment_date" id="appointmentDate">
                <input type="hidden" name="appointment_time" id="appointmentTime">
                <input type="hidden" name="service_provider_id" id="serviceProviderId" value="{{ $serviceProviderId }}">
                <input type="hidden" name="service_id" id="serviceId" value="{{ $serviceId }}">
                <input type="hidden" name="service_ids" id="service_ids"
                    value="{{ !empty($serviceIds) ? implode(',', $serviceIds) : '' }}">
                <input type="hidden" name="total_price" id="totalPrice" value="{{ $totalPrice }}">

                {{-- Step - 1: How you want to take this service? START --}}
                <div class="tm-multi-step-form-step active">
                    <h2 class="tm-multistep-form-heading">How do you want to take this service?</h2>
                    <div class="tm-multi-step-option-container">
                        <div class="client-tax-preparer-option">
                            <input id="role" value type="hidden" name="user-type" />
                            <div id="client" class="user-box client-tax-preparer-option-single">
                                <h3 class="armie-multistep-select-heading">Mobile services</h3>
                                <h4 class="armie-multistep-select-para">Select this option if you prefer the convenience of
                                    an at-home service.</h4>
                                <h5 class="armie-multistep-select-discount">
                                    Discount <span>0%</span>
                                </h5>
                                <span class="activeSvg">
                                    <svg class="svg1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <circle cx="12" cy="12" r="11.5" stroke="#6B6B6B" />
                                    </svg>
                                    <svg class="svg2" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <circle cx="12" cy="12" r="11.5" fill="#FFB6C1" stroke="#222222" />
                                        <defs>
                                            <lineargradient id="paint0_linear_9025_4007" x1="0" y1="0"
                                                x2="24" y2="24" gradientUnits="userSpaceOnUse">
                                                <stop stop-color="#09BD3F" />
                                                <stop offset="1" stop-color="#09812D" />
                                            </lineargradient>
                                        </defs>
                                    </svg>
                                </span>
                            </div>

                            <div id="tax-preparer" class="user-box client-tax-preparer-option-single">
                                <h3 class="armie-multistep-select-heading">Salon services</h3>
                                <h4 class="armie-multistep-select-para">Enjoy a professional experience at our salon and get
                                    10% off on your booking!</h4>
                                <h5 class="armie-multistep-select-discount">
                                    Discount <span>10%</span>
                                </h5>
                                <span class="activeSvg">
                                    <svg class="svg1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <circle cx="12" cy="12" r="11.5" stroke="#6B6B6B" />
                                    </svg>
                                    <svg class="svg2" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <circle cx="12" cy="12" r="11.5" fill="#FFB6C1" stroke="#222222" />
                                        <defs>
                                            <lineargradient id="paint0_linear_9025_40078" x1="0" y1="0"
                                                x2="24" y2="24" gradientUnits="userSpaceOnUse">
                                                <stop stop-color="#09BD3F" />
                                                <stop offset="1" stop-color="#09812D" />
                                            </lineargradient>
                                        </defs>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="tm-multistep-btn-wrapper ">
                        <a href="{{ url()->previous() }}" type="button" class="tm-multi-step-prev-step-2">Back</a>
                        <button type="button" class="tm-multi-step-next-step">Continue</button>
                    </div>
                </div>
                {{-- Step - 1: How you want to take this service? END --}}


                {{-- Step - 2: What time do you need to be ready by? START --}}
                <div class="tm-multi-step-form-step">
                    <h2 class="tm-multistep-form-heading">What time do you need to be ready by?</h2>
                    <div class="second-step-wrapper">
                        <div class="multistep-date-label">
                            <label>Select Date</label>
                            <div class="date-input-wrapper">
                                <input type="text" id="appointment-date" class="date-input">
                                <img src="{{ asset('frontend/images/Calendar.svg') }}" alt="Calendar Icon"
                                    class="custom-calendar-icon">
                            </div>
                        </div>

                        <div class="time-option-wrapper">
                            <label>Time</label>
                            <div class="tm-multi-step-time-options">
                                <button type="button">6:00 AM</button>
                                <button type="button">7:00 AM</button>
                                <button type="button">8:00 AM</button>
                                <button type="button">9:00 AM</button>
                                <button type="button">10:00 AM</button>
                                <button type="button">11:00 AM</button>
                                <button type="button">12:00 PM</button>
                                <button type="button">1:00 PM</button>
                                <button type="button">2:00 PM</button>
                                <button type="button">3:00 PM</button>
                                <button type="button">4:00 PM</button>
                                <button type="button">5:00 PM</button>
                                <button type="button">6:00 PM</button>
                                <button type="button">7:00 PM</button>
                                <button type="button">8:00 PM</button>
                                <button type="button">9:00 PM</button>
                                <button type="button">10:00 PM</button>
                                <button type="button">11:00 PM</button>
                                <button type="button">12:00 AM</button>
                                <button type="button">1:00 AM</button>
                                <button type="button">2:00 AM</button>
                                <button type="button">3:00 AM</button>
                                <button type="button">4:00 AM</button>
                                <button type="button">5:00 AM</button>
                            </div>
                        </div>
                    </div>

                    <div class="tm-multistep-btn-wrapper">
                        <button type="button" class="tm-multi-step-prev-step">Back</button>
                        <button type="button" class="tm-multi-step-next-step">Continue</button>
                    </div>
                </div>
                {{-- Step - 2: What time do you need to be ready by? END --}}


                {{-- Step - 3: Booking Summary START --}}
                <div class="tm-multi-step-form-step tm-multi-step-form-step-4">
                    <h2 class="tm-multistep-form-heading tm-multistep-form-heading-2">Booking Summary</h2>
                    <div class="tm-multi-step-summary">
                        <div class="tm-multi-step-summary-item">
                            <h3>Date: <span id="summary-date"></span></h3>
                            <h3>Time: <span id="summary-time"></span></h3>
                        </div>

                        <div class="tm-booking-summary-new-design">
                            <div class="tm-multi-step-summary-item">
                                <h3>Pricing & Inclusions</h3>
                                <div class="tm-multi-step-summary-item-component-wrapper">
                                    @foreach ($selectedServices as $service)
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
                                                    {{ $service->service->services_name }}<br>
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="tm-multi-step-summary-item">
                                <h3>Pricing & Inclusions</h3>
                                <div class="tm-new-summary-important-info-wrapper">
                                    <div class="tm-new-summary-important-info">
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
                                        <span class="tm-multistep-total-value"></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tm-multistep-btn-wrapper">
                        <button type="button" class="tm-multi-step-prev-step">Back</button>

                        <button class="tm-multi-step-submit-form" type="button" id="submitBooking">
                            Confirm and Check Availability
                        </button>
                    </div>
                </div>
                {{-- Step - 3: Booking Summary END --}}
            </form>
        </div>
    </section>

    {{-- Approval Modal Start --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body tm-modal-body">
                    <h2>You have to <span>Wait for approval</span> to Connect with Service provider</h2>
                    <p class="modal-para">
                        Await Approval to Access Our Exclusive Network and Build Meaningful Connections
                    </p>

                    <div class="tm-dashboard-booking-landing-btn-wrapper tm-dashboard-booking-landing-btn-wrapper-modal">
                        <button class="tm-dashboard-booking-landing-btn-1 d-none">Sign In later</button>
                        <a href="{{ route('client-dashboard') }}"
                            class="tm-dashboard-booking-landing-btn-1 w-100 text-center">Go Back to Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Approval Modal End --}}

    <div id="loader"
        style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 9999;">
        <img src="{{ asset('frontend/custom-downloaded-cdn/loader.gif') }}" alt="Loading...">
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('frontend/custom-downloaded-cdn/jquery-ui.js') }}"></script>
    <script src="{{ asset('frontend/js/joint-client.js') }}"></script>
    <script src="{{ asset('frontend/custom-downloaded-cdn/moment.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Navigation between steps
            let currentStep = 0;
            const steps = $(".tm-multi-step-form-step");

            function showStep(step) {
                steps.removeClass("active").eq(step).addClass("active");
                if (step === 2) {
                    updateSummary();
                }
            }

            $(".tm-multi-step-next-step").click(function() {
                if (currentStep < steps.length - 1) {
                    currentStep++;
                    showStep(currentStep);
                }
            });

            $(".tm-multi-step-prev-step").click(function() {
                if (currentStep > 0) {
                    currentStep--;
                    showStep(currentStep);
                }
            });

            // Service type selection
            $('#client, #tax-preparer').click(function() {
                let type = $(this).attr('id') === 'client' ? 'mobile_services' : 'salon_services';
                $('#serviceType').val(type);
            });

            // Datepicker
            $("#appointment-date").datepicker({
                dateFormat: "yy-mm-dd",
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                onSelect: function(dateText) {
                    $('#appointmentDate').val(dateText);
                }
            });

            // Time option
            $(".tm-multi-step-time-options button").click(function() {
                $(".tm-multi-step-time-options button").removeClass("active");
                $(this).addClass("active");
                $('#appointmentTime').val($(this).text());
            });

            // Update summary
            function updateSummary() {
                const date = $('#appointmentDate').val();
                const time = $('#appointmentTime').val();
                const serviceType = $('#serviceType').val();
                let totalPrice = {{ $totalPrice }};

                // Apply discount if service type is salon_services
                if (serviceType === 'salon_services') {
                    totalPrice = totalPrice - (totalPrice * 0.10);
                }

                const formattedDate = moment(date).format('dddd, MMMM Do, YYYY');

                $('#summary-date').text(formattedDate);
                $('#summary-time').text(time);
                $('.tm-multistep-total-value').text(`$${totalPrice.toFixed(2)}`);
                $('#totalPrice').val(totalPrice.toFixed(2)); // Set the total price in the hidden input field
            }

            // Submit with Axios
            $("#submitBooking").click(function() {
                const $btn = $(this);
                if ($btn.data('submitted')) return;
                $btn.data('submitted', true); // Mark as submitted

                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const loader = document.getElementById('loader');
                loader.style.display = 'block'; // Show loader

                axios.post("{{ route('booking.store') }}", {
                        service_type: $('#serviceType').val(),
                        appointment_date: $('#appointmentDate').val(),
                        appointment_time: $('#appointmentTime').val(),
                        service_provider_id: $('#serviceProviderId').val(),
                        service_id: $('#serviceId').val(),
                        service_ids: $('#service_ids').val(),
                        total_price: $('#totalPrice').val() // Include the total price
                    }, {
                        headers: {
                            'X-CSRF-TOKEN': token
                        }
                    })
                    .then(response => {
                        console.log('Success:', response.data);
                        loader.style.display = 'none'; // Hide loader
                        // Manually trigger modal
                        $('#exampleModal').modal('show');
                    })
                    .catch(error => {
                        console.error('Error:', error.response ? error.response.data : error);
                        loader.style.display = 'none'; // Hide loader
                        $btn.data('submitted', false); // Reset if needed
                    });
            });
        });
    </script>
@endpush
