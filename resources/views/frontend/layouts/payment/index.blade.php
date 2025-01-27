@extends('frontend.app')

@section('title', 'Booking Summary')

@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/css/tarek.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/categories.css') }}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
@endpush

@section('content')
    <section class="multistepform-section section-padding-x">
        <div class="container">
            <form class="tm-multi-step-form-container">
                {{-- Booking Summary --}}
                <div class="tm-multi-step-form-step-booking-details">
                    <h2 class="tm-multistep-form-heading tm-multistep-form-heading-2">Booking Summary</h2>
                    <div class="tm-multi-step-summary">
                        <div class="tm-multi-step-summary-item">
                            <h3>Date: <span id="summary-date">Monday, April 10th, 2024</span></h3>
                            <h3>Time: <span id="summary-time">08:00 PM</span></h3>
                        </div>

                        <div class="tm-multi-step-summary-item">
                            <h3>Selected Services</h3>
                            <div class="multi-step-selected-services">
                                <div class="multi-step-single-item-left">
                                    <h4>Makeup Bridal Makeup</h4>
                                    <h5>For: 2 People </h5>
                                </div>
                                <p class="selected-services-value">$200</p>
                            </div>

                            <div class="multi-step-selected-services">
                                <div class="multi-step-single-item-left">
                                    <h4>Makeup Bridal Makeup</h4>
                                    <h5>For: 2 People </h5>
                                </div>
                                <p class="selected-services-value">$200</p>
                            </div>

                            <div class="multi-step-selected-services">
                                <div class="multi-step-single-item-left">
                                    <h4>Makeup Bridal Makeup</h4>
                                    <h5>For: 2 People </h5>
                                </div>
                                <p class="selected-services-value">$200</p>
                            </div>
                        </div>

                        <div class="tm-multi-step-summary-item">
                            <h3>Location</h3>
                            <div class="location-service-wrapper">
                                <p class="tm-multistep-discount">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M1.92188 12C1.92188 6.43401 6.43401 1.92188 12 1.92188C17.566 1.92188 22.0781 6.43401 22.0781 12C22.0781 17.566 17.566 22.0781 12 22.0781C6.43401 22.0781 1.92188 17.566 1.92188 12ZM12 10.8281C12.3883 10.8281 12.7031 11.1429 12.7031 11.5312V16.2188C12.7031 16.6071 12.3883 16.9219 12 16.9219C11.6117 16.9219 11.2969 16.6071 11.2969 16.2188V11.5312C11.2969 11.1429 11.6117 10.8281 12 10.8281ZM12.532 8.2507C12.7918 7.96207 12.7684 7.51748 12.4797 7.25771C12.1911 6.99793 11.7465 7.02133 11.4867 7.30998L11.4773 7.32039C11.2176 7.60903 11.241 8.05361 11.5297 8.31338C11.8183 8.57317 12.2629 8.54977 12.5227 8.26112L12.532 8.2507Z"
                                            fill="#222222" />
                                    </svg> 10% Discount
                                </p>
                                <p class="tm-salon-services">Salon Service</p>
                            </div>
                            <div class="multi-step-selected-services">
                                <div class="multi-step-single-item-left">
                                    <p class="location-p">Location</p>
                                </div>
                                <p class="selected-services-value">(10)</p>
                            </div>
                        </div>

                        <div class="tm-multi-step-summary-item">
                            <hr>
                            <p class="tm-multi-step-summary-total">Total:
                                <span class="tm-multistep-total-value">$990</span>
                            </p>
                        </div>
                    </div>

                    <div class="tm-multistep-btn-wrapper">
                        <button type="button" class="tm-multi-step-prev-step">Back</button>
                        <button class="tm-multi-step-submit-form" type="button" data-bs-toggle="modal"
                            class="tm-dashboard-booking-landing-btn-1" data-bs-target="#exampleModalToggle">
                            Make Payment
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    {{-- Modal - 1: Choose Payment Method Start --}}
    <div class="modal fade modal-step" id="exampleModalToggle" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header tm-modal-header">
                    <h3>Choose Payment Method</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action class="modal-body tm-modal-body tm-modal-body-2">
                    <div class="tm-fee-wrapper">
                        <div class="tm-fee-price">
                            <h5>Service Fee</h5>
                            <p>Price: $100</p>
                        </div>
                    </div>

                    <div class="tm-fee-wrapper">
                        <div class="tm-fee-price">
                            <h5>Discount (10%)</h5>
                            <p class="first-fixed-price">Price: ($10)</p>
                        </div>
                    </div>

                    <div class="tm-booking-divider"></div>
                    <div class="tm-fee-wrapper">
                        <div class="tm-fee-price tm-fee-price-2nd">
                            <h5>Total Payable Amount</h5>
                            <p>$90</p>
                        </div>
                    </div>

                    <div class="payment-method">
                        <h5>Choose Payment Method</h5>
                        <div class="payment-card-wrapper">
                            {{-- Stripe Payment --}}
                            <span class="card-name">
                                <img src="{{ asset('frontend/images/stripe.svg') }}" alt>
                                <img class="cardSelectSvg d-none" src="{{ asset('frontend/images/card-select-svg.svg') }}"
                                    alt>
                            </span>
                        </div>
                    </div>

                    <div class="confirm-payment-checkbox">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                By checking this box, you acknowledge that
                                you have read and accepted our <a href="#">Terms and Conditions</a> and <a
                                    href="#">Privacy Policy</a>. This
                                includes understanding our platform fee,
                                cancellation policy, and the terms governing
                                the use of Glamora services. Agreeing to
                                these terms is mandatory to complete your
                                booking.
                            </label>
                        </div>
                    </div>

                    <div class="tm-dashboard-booking-landing-btn-wrapper tm-dashboard-booking-landing-btn-wrapper-modal">
                        <button type="reset" class="tm-dashboard-booking-landing-btn-1">Cancel</button>
                        <button type="button" class="tm-dashboard-booking-landing-btn-1 w-100 text-center"
                            data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">
                            Confirm and Pay $90
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Modal - 1: Choose Payment Method End --}}

    <!-- Modal  2-->
    <div class="modal fade modal-step" id="exampleModalToggle2" aria-hidden="true"
        aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header tm-modal-header">
                    <h3>Confirm Payment</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action class="modal-body tm-modal-body tm-modal-body-2">
                    <div class="tm-card-input-wrapper">
                        <div class="tm-input-item">
                            <label for="cardNumber">Card Number</label>
                            <input type="number" id="cardNumber" placeholder="xxxx-xxxx-xxxx-xxxx" required>
                        </div>
                        <div class="tm-input-item">
                            <label for="cardNumber">Card Holder Name</label>
                            <input type="text" id="cardName" placeholder="Enter card holder name" required>
                        </div>

                        <div class="tm-inner-input-wrapper">
                            <div class="tm-input-item">
                                <label for="cvv">CCV</label>
                                <input type="number" id="cvv" placeholder="XXX" required>
                            </div>
                            <div class="tm-input-item">
                                <label for="expiryDate">Expiry Date
                                    *</label>
                                <input type="text" id="expiryDate" placeholder="MM/YY" required>
                            </div>
                        </div>
                    </div>
                    <div class="tm-dashboard-booking-landing-btn-wrapper tm-dashboard-booking-landing-btn-wrapper-modal">
                        <button type="reset" class="tm-dashboard-booking-landing-btn-1 d-none">Cancel</button>

                        <button data-bs-target="#exampleModalToggle3" data-bs-toggle="modal" data-bs-dismiss="modal"
                            type="submit" class="tm-dashboard-booking-landing-btn-1 w-100 text-center mt-3">Procceed
                            to payment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- modal 2 end -->

    {{-- Modal 3: Booking Successful Start --}}
    <div class="modal fade" id="exampleModalToggle3" aria-hidden="true" aria-labelledby="exampleModalToggleLabel3"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body tm-modal-body">
                    <div class="booking-success-img-area">
                        <img src="{{ asset('frontend/images/booking_Succesfull.png') }}" alt>
                    </div>

                    <h2 class="text-center">Booking Successful!</h2>
                    <p class="modal-para text-center">
                        We have successfully received your payment of $90
                        as a security deposit. Your appointment with [Name] is scheduled for [Date and Time].
                    </p>

                    <div class="tm-dashboard-booking-landing-btn-wrapper tm-dashboard-booking-landing-btn-wrapper-modal">
                        <a href="./dashboard-service-profile-details.html"
                            class="tm-dashboard-booking-landing-btn-1 tm-dashboard-booking-landing-btn-4">
                            Go Back to Dashboard
                        </a>

                        <button class="tm-dashboard-booking-landing-btn-1">View Booking Details</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal 3: Booking Successful End --}}
@endsection

@push('scripts')
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script src="{{ asset('frontend/js/joint-client.js') }}"></script>
@endpush
