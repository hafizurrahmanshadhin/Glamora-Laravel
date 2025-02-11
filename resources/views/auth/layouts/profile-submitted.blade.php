@extends('auth.app')

@section('title', 'Profile Submitted')

@section('content')
    <section class="submit-review-section">
        <div class="section-padding-x">
            <div class="submit-review-section-content-wrapper">
                <div class="submit-review-img-area">
                    <img src="{{ asset('frontend/images/submit-review.png') }}" alt="">
                </div>
                <div class="submit-review-text-area">
                    <h1>Profile Submitted for Review!</h1>
                    <p class="submit-review-text-one">
                        Thank you for providing your information! Our team is reviewing your details to ensure everything is
                        in order.
                        You will receive an <span>email</span> notification once your profile has been approved.
                    </p>
                    <div class="submit-review-text-two-wrapper">
                        <p class="submit-review-text-two">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25"
                                fill="none">
                                <path
                                    d="M12.3203 16.9621C12.495 16.9621 12.6413 16.9031 12.7593 16.7851C12.8766 16.6671 12.9353 16.5208 12.9353 16.3461C12.9353 16.1721 12.8763 16.0261 12.7583 15.9081C12.6403 15.7901 12.4943 15.7308 12.3203 15.7301C12.1463 15.7294 12.0003 15.7884 11.8823 15.9071C11.7643 16.0258 11.7053 16.1718 11.7053 16.3451C11.7053 16.5184 11.7643 16.6648 11.8823 16.7841C12.0003 16.9034 12.1463 16.9634 12.3203 16.9621ZM11.8203 13.6531H12.8203V7.65309H11.8203V13.6531ZM12.3233 21.5001C11.0793 21.5001 9.90931 21.2641 8.81331 20.7921C7.71798 20.3194 6.76498 19.6781 5.95431 18.8681C5.14365 18.0581 4.50198 17.1061 4.02931 16.0121C3.55665 14.9181 3.32031 13.7484 3.32031 12.5031C3.32031 11.2578 3.55665 10.0878 4.02931 8.99309C4.50131 7.89776 5.14165 6.94476 5.95031 6.13409C6.75898 5.32342 7.71131 4.68176 8.80731 4.20909C9.90331 3.73642 11.0733 3.50009 12.3173 3.50009C13.5613 3.50009 14.7313 3.73642 15.8273 4.20909C16.9226 4.68109 17.8756 5.32176 18.6863 6.13109C19.497 6.94042 20.1386 7.89276 20.6113 8.98809C21.084 10.0834 21.3203 11.2531 21.3203 12.4971C21.3203 13.7411 21.0843 14.9111 20.6123 16.0071C20.1403 17.1031 19.499 18.0561 18.6883 18.8661C17.8776 19.6761 16.9256 20.3178 15.8323 20.7911C14.739 21.2644 13.5693 21.5008 12.3233 21.5001ZM12.3203 20.5001C14.5536 20.5001 16.4453 19.7251 17.9953 18.1751C19.5453 16.6251 20.3203 14.7334 20.3203 12.5001C20.3203 10.2668 19.5453 8.37509 17.9953 6.82509C16.4453 5.27509 14.5536 4.50009 12.3203 4.50009C10.087 4.50009 8.19531 5.27509 6.64531 6.82509C5.09531 8.37509 4.32031 10.2668 4.32031 12.5001C4.32031 14.7334 5.09531 16.6251 6.64531 18.1751C8.19531 19.7251 10.087 20.5001 12.3203 20.5001Z"
                                    fill="#222222" />
                            </svg>
                            This process typically takes 1-2 business days. We appreciate your patience and look
                            forward to having you on board!
                        </p>
                    </div>
                    <a href="{{ route('index') }}" class="goto-home-btn">Go to Home</a>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Select all anchor links on this page
            document.querySelectorAll("a").forEach(function(anchor) {
                anchor.addEventListener("click", function(e) {
                    e.preventDefault(); // Prevent the default navigation
                    var destination = this.href; // Get the intended destination

                    // Use the Fetch API to send a POST request to the logout route.
                    // Make sure you have the CSRF token available.
                    fetch("{{ route('logout') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            }
                        })
                        .then(function(response) {
                            // Once logout is complete, navigate to the destination.
                            window.location.href = destination;
                        })
                        .catch(function(error) {
                            console.error("Logout failed:", error);
                            // In case of error, still navigate to the destination.
                            window.location.href = destination;
                        });
                });
            });
        });
    </script>
@endpush
