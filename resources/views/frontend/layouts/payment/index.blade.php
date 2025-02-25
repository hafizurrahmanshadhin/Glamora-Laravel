@extends('frontend.app')

@section('title', 'Booking Summary')

@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/css/tarek.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/categories.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/custom-downloaded-cdn/jquery-ui.css') }}">
@endpush

@section('content')
    <section class="multistepform-section section-padding-x">
        <div class="container">
            <form id="payment-form" class="tm-multi-step-form-container">
                @csrf
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
                            <div class="d-flex flex-column gap-3">
                                @foreach ($selectedServices as $srv)
                                    <div class="tm-multi-step-summary-item-component d-flex align-items-center gap-3">
                                        <div class="tm-multi-step-summary-item-component-left">
                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g id="vuesax/linear/shopping-bag">
                                                    <g id="shopping-bag">
                                                        <path id="Vector"
                                                            d="M11.2 8.66699H20.8C25.3334 8.66699 25.7867 10.787 26.0934 13.3737L27.2934 23.3737C27.68 26.6537 26.6667 29.3337 22 29.3337H10.0134C5.33337 29.3337 4.32003 26.6537 4.72003 23.3737L5.92004 13.3737C6.21338 10.787 6.6667 8.66699 11.2 8.66699Z"
                                                            stroke="#FFB6C1" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path id="Vector_2"
                                                            d="M10.6719 10.667V6.00033C10.6719 4.00033 12.0052 2.66699 14.0052 2.66699H18.0052C20.0052 2.66699 21.3385 4.00033 21.3385 6.00033V10.667"
                                                            stroke="#FFB6C1" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path id="Vector_3" d="M27.2185 22.707H10.6719" stroke="#FFB6C1"
                                                            stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </g>
                                                </g>
                                            </svg>
                                        </div>

                                        <div class="tm-multi-step-summary-item-component-right">
                                            <p class="genarel-para-new-bold">
                                                {{ $srv->service->services_name ?? 'Service' }}
                                            </p>
                                        </div>

                                        <div class="ms-auto text-end">
                                            <p class="selected-services-value">
                                                ${{ number_format($srv->total_price, 2) }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="tm-multi-step-summary-item">
                            <hr>
                            <p class="tm-multi-step-summary-total">
                                Total:
                                <span class="tm-multistep-total-value">
                                    ${{ number_format($servicesTotal, 2) }}
                                </span>
                            </p>

                            <p class="tm-multi-step-summary-total">
                                Discount:
                                <span class="tm-multistep-total-value">
                                    {{ $discountPercentage }}%
                                </span>
                            </p>
                        </div>

                        <div class="tm-multi-step-summary-item">
                            <hr>
                            <p class="tm-multi-step-summary-total">Total:
                                <span class="tm-multistep-total-value">
                                    ${{ number_format($booking->price, 2) }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="tm-multistep-btn-wrapper">
                        <button type="button" class="tm-multi-step-prev-step">Back</button>
                        <button class="tm-multi-step-submit-form" type="button" id="makePaymentBtn">
                            Make Payment
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('frontend/custom-downloaded-cdn/jquery-ui.js') }}"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{ asset('frontend/js/joint-client.js') }}"></script>
    <script>
        const stripe = Stripe('{{ config('services.stripe.key') }}');

        document.getElementById('makePaymentBtn').addEventListener('click', async () => {
            const response = await fetch("{{ route('checkout', $booking->id) }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            });

            const session = await response.json();

            if (session.id) {
                stripe.redirectToCheckout({
                    sessionId: session.id
                });
            } else {
                alert('Payment failed');
            }
        });
    </script>
@endpush
