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
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
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
