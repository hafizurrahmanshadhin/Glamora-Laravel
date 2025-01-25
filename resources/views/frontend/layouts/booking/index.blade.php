@extends('frontend.app')

@section('title', 'Booking')

@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/css/tarek.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/categories.css') }}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
@endpush

@section('content')
    <section class="multistepform-section section-padding-x">
        <div class="container">
            <form class="tm-multi-step-form-container">
                <!-- Step 2: Choose Service Type -->
                <div class="tm-multi-step-form-step active">
                    <h2 class="tm-multistep-form-heading">How you want to
                        take this service?</h2>
                    <div class="tm-multi-step-option-container">
                        <div class="client-tax-preparer-option">
                            <input id="user-type" value type="hidden" name="user-type" />
                            <div id="client" class="user-box client-tax-preparer-option-single">
                                <h3 class="armie-multistep-select-heading">
                                    Mobile services
                                </h3>
                                <h4 class="armie-multistep-select-para">Select
                                    this
                                    option if you prefer the convenience of
                                    an
                                    at-home service.</h4>
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

                            <!-- second option -->

                            <div id="tax-preparer" class="user-box client-tax-preparer-option-single">
                                <h3 class="armie-multistep-select-heading">
                                    Salon services
                                </h3>
                                <h4 class="armie-multistep-select-para">
                                    Enjoy a professional experience at our
                                    salon and get 20% off on your
                                    booking!</h4>
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
                        <a href="./Service-provider-profile.html" type="button" class="tm-multi-step-prev-step-2">Back</a>
                        <button type="button" class="tm-multi-step-next-step">Continue</button>
                    </div>
                </div>

                <!-- Step 3: Select Date & Time -->
                <div class="tm-multi-step-form-step">
                    <h2 class="tm-multistep-form-heading">What time do you
                        need to be ready by?</h2>
                    <div class="second-step-wrapper">
                        <div class="multistep-date-label">
                            <label>Select Date</label>
                            <div class="date-input-wrapper">
                                <input type="text" id="appointment-date" class="date-input">
                                <img src="./assets/images/Calendar.svg" alt="Calendar Icon" class="custom-calendar-icon">
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
                            </div>
                        </div>
                    </div>
                    <div class="tm-multistep-btn-wrapper">
                        <button type="button" class="tm-multi-step-prev-step">Back</button>
                        <button type="button" class="tm-multi-step-next-step">Continue</button>
                    </div>
                </div>

                <!-- Step 4: Booking Summary -->
                <div class="tm-multi-step-form-step tm-multi-step-form-step-4">
                    <h2 class="tm-multistep-form-heading tm-multistep-form-heading-2">Booking
                        Summary</h2>
                    <div class="tm-multi-step-summary">
                        <div class="tm-multi-step-summary-item">
                            <h3>Date: <span id="summary-date">Monday, April
                                    10th,
                                    2024</span></h3>
                            <h3>Time: <span id="summary-time">08:00
                                    PM</span></h3>
                        </div>
                        <div class="tm-booking-summary-new-design">
                            <div class="tm-multi-step-summary-item">
                                <h3>Pricing & Inclusions</h3>
                                <div class="tm-multi-step-summary-item-component-wrapper">
                                    <div class="tm-multi-step-summary-item-component">
                                        <div class="tm-multi-step-summary-item-component-left">
                                            <img src="./assets/images/location.svg" alt="location" srcset="">
                                        </div>
                                        <div class="tm-multi-step-summary-item-component-right">
                                            <p class="genarel-para-new">Stylist comes to you in</p>
                                            <p class="genarel-para-new-bold">Bronx, New York, United States</p>
                                        </div>
                                    </div>
                                    <div class="tm-multi-step-summary-item-component">
                                        <div class="tm-multi-step-summary-item-component-left">
                                            <img src="./assets/images/location.svg" alt="location" srcset="">
                                        </div>
                                        <div class="tm-multi-step-summary-item-component-right">
                                            <p class="genarel-para-new">Stylist comes to you in</p>
                                            <p class="genarel-para-new-bold">Bronx, New York, United States</p>
                                        </div>
                                    </div>
                                    <div class="tm-multi-step-summary-item-component">
                                        <div class="tm-multi-step-summary-item-component-left">
                                            <img src="./assets/images/location.svg" alt="location" srcset="">
                                        </div>
                                        <div class="tm-multi-step-summary-item-component-right">
                                            <p class="genarel-para-new">Services</p>
                                            <p class="genarel-para-new-bold">2x People</p>
                                            <p class="new-makeup-notice">Bridesmaid makeup only Bride Mackup Only</p>
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
                                        <a href="#" class="location-p"> View inclusions & cancellation
                                            policy</a>
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
                                        <span class="tm-multistep-total-value">$990</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tm-multistep-btn-wrapper">
                        <button type="button" class="tm-multi-step-prev-step">Back</button>
                        <button class="tm-multi-step-submit-form" type="button" data-bs-toggle="modal"
                            class="tm-dashboard-booking-landing-btn-1" data-bs-target="#exampleModal">Confirm
                            and Check Availability</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

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
                        <a href="index.html" class="tm-dashboard-booking-landing-btn-1 w-100 text-center">Go Back to
                            Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script src="{{ asset('frontend/js/joint-client.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Initialize Nice Select
            $('.tm-multi-step-select').niceSelect();

            // Navigation between steps
            let currentStep = 0;
            const steps = $(".tm-multi-step-form-step");

            function showStep(step) {
                steps.removeClass("active").eq(step).addClass("active");
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

            $(".tm-multi-step-submit-form").click(function(event) {
                event.preventDefault(); // Prevent form submission via default behavior
                // Add your custom submission logic here
                console.log("Form submitted!");
            });

            // Time option selection
            $(".tm-multi-step-time-options button").click(function() {
                $(".tm-multi-step-time-options button").removeClass("active");
                $(this).addClass("active");
            });
        });
    </script>

    <script>
        document.querySelector('.add-more-row-btn').addEventListener('click', function() {
            // Select the parent container
            const container = document.querySelector('.tm-multistep-first-row-content-wrapper');

            // Get the template for the new row (clone the last row)
            const template = document.querySelector('.tm-multi-step-form-row-content').cloneNode(true);

            // Reset input values in the new row
            template.querySelectorAll('input').forEach(input => input.value = '');
            template.querySelector('select').value = 'makeup'; // Reset select to default value if needed

            // Append the new row to the container
            container.insertBefore(template, document.querySelector('.add-more-row-btn'));

            // Add click event listener to the new remove button
            template.querySelector('.tm-multi-step-remove-button').addEventListener('click', function() {
                removeRow(this);
            });

            // Update the visibility of remove buttons
            updateRemoveButtonVisibility();
        });

        // Add functionality to remove rows
        function removeRow(button) {
            button.closest('.tm-multi-step-form-row-content').remove();

            // Update the visibility of remove buttons
            updateRemoveButtonVisibility();
        }

        // Function to update visibility of remove buttons
        function updateRemoveButtonVisibility() {
            const rows = document.querySelectorAll('.tm-multi-step-form-row-content');
            const removeButtons = document.querySelectorAll('.tm-multi-step-remove-button');

            // Show or hide remove buttons based on row count
            if (rows.length === 1) {
                removeButtons.forEach(button => button.style.display = 'none');
            } else {
                removeButtons.forEach(button => button.style.display = '');
            }
        }

        // Attach click event to the initial remove button
        document.querySelectorAll('.tm-multi-step-remove-button').forEach(button => {
            button.addEventListener('click', function() {
                removeRow(this);
            });
        });

        // Initialize the visibility of remove buttons
        updateRemoveButtonVisibility();
    </script>

    <script>
        $(function() {
            $("#appointment-date").datepicker({
                dateFormat: "dd-mm-yy",
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,

            });
        });
    </script>
@endpush
