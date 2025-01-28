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
                            <h3>Date: <span
                                    id="summary-date">{{ \Carbon\Carbon::parse($booking->appointment_date)->format('l, F jS, Y') }}</span>
                            </h3>
                            <h3>Time: <span
                                    id="summary-time">{{ \Carbon\Carbon::parse($booking->appointment_time)->format('h:i A') }}</span>
                            </h3>
                        </div>

                        <div class="tm-multi-step-summary-item">
                            <h3>Selected Services</h3>
                            <div class="multi-step-selected-services">
                                <div class="multi-step-single-item-left">
                                    <h4>{{ $booking->userService->service->services_name ?? '' }}</h4>
                                </div>
                                <p class="selected-services-value">${{ number_format($booking->price, 2) }}</p>
                            </div>
                        </div>

                        <div class="tm-multi-step-summary-item">
                            <hr>
                            <p class="tm-multi-step-summary-total">Total:
                                <span class="tm-multistep-total-value">${{ number_format($booking->price, 2) }}</span>
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



    {{-- Modal 3: Booking Successful Start --}}
    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggle" tabindex="-1">
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
