@extends('frontend.app')

@section('title', 'Booking Successful')

@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/css/tarek.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/categories.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/custom-downloaded-cdn/jquery-ui.css') }}">
@endpush

@section('content')
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
                    We have successfully received your payment. Your appointment is scheduled successfully.
                </p>

                <div class="tm-dashboard-booking-landing-btn-wrapper tm-dashboard-booking-landing-btn-wrapper-modal">
                    <a href="{{ route('beauty-expert-dashboard') }}" class="tm-dashboard-booking-landing-btn-1">
                        Go Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('frontend/custom-downloaded-cdn/jquery-ui.js') }}"></script>
    <script src="{{ asset('frontend/custom-downloaded-cdn/js.stripe.com') }}"></script>
    <script src="{{ asset('frontend/js/joint-client.js') }}"></script>
@endpush
