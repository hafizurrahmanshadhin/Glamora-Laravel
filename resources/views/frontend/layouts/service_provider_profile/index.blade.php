@extends('frontend.app')

@section('title', 'Service Provider Profile')

@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/css/plugins/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/plugins/fontawesome.min.css') }}">

    {{-- All custom CSS Links --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/helper.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/tarek.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/categories.css') }}" />
@endpush

@section('content')
    <main>
        {{-- categories second section start --}}
        <section class="padding-top-from-header">
            <div class="section-padding-x service-provider-profile-content-wrapper">
                <div class="service-profile-provider-content-left">
                    <div class="profile-info">
                        <div class="tm-profile-info-img-area">
                            <img src="{{ $user->businessInformation && $user->businessInformation->avatar
                                ? asset($user->businessInformation->avatar)
                                : asset('backend/images/users/user-dummy-img.jpg') }}"
                                alt="Profile Picture">
                        </div>

                        <div class="profile-details-wrapper">
                            <div class="profile-name-place-rating-wrapper">
                                <div class="profile-name-place">
                                    <h3>{{ $user->first_name ?? '' }} {{ $user->last_name ?? '' }}</h3>
                                    <p>
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path
                                                    d="M14.5 9C14.5 10.3807 13.3807 11.5 12 11.5C10.6193 11.5 9.5 10.3807 9.5 9C9.5 7.61929 10.6193 6.5 12 6.5C13.3807 6.5 14.5 7.61929 14.5 9Z"
                                                    stroke="#222222" stroke-width="1.5" />
                                                <path
                                                    d="M18.2222 17C19.6167 18.9885 20.2838 20.0475 19.8865 20.8999C19.8466 20.9854 19.7999 21.0679 19.7469 21.1467C19.1724 22 17.6875 22 14.7178 22H9.28223C6.31251 22 4.82765 22 4.25311 21.1467C4.20005 21.0679 4.15339 20.9854 4.11355 20.8999C3.71619 20.0475 4.38326 18.9885 5.77778 17"
                                                    stroke="#222222" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M13.2574 17.4936C12.9201 17.8184 12.4693 18 12.0002 18C11.531 18 11.0802 17.8184 10.7429 17.4936C7.6543 14.5008 3.51519 11.1575 5.53371 6.30373C6.6251 3.67932 9.24494 2 12.0002 2C14.7554 2 17.3752 3.67933 18.4666 6.30373C20.4826 11.1514 16.3536 14.5111 13.2574 17.4936Z"
                                                    stroke="#222222" stroke-width="1.5" />
                                            </svg>
                                        </span>
                                        {{ $user->businessInformation && $user->businessInformation->business_address
                                            ? $user->businessInformation->business_address
                                            : 'No address provided' }}
                                    </p>
                                </div>
                                <div class="service-provider-rating" style="white-space: nowrap">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <path
                                                d="M11.0489 2.92705C11.3483 2.00574 12.6517 2.00574 12.9511 2.92705L14.4697 7.60081C14.6035 8.01284 14.9875 8.2918 15.4207 8.2918L20.335 8.2918C21.3037 8.2918 21.7065 9.53141 20.9228 10.1008L16.947 12.9894C16.5966 13.244 16.4499 13.6954 16.5838 14.1074L18.1024 18.7812C18.4017 19.7025 17.3472 20.4686 16.5635 19.8992L12.5878 17.0106C12.2373 16.756 11.7627 16.756 11.4122 17.0106L7.43648 19.8992C6.65276 20.4686 5.59828 19.7025 5.89763 18.7812L7.41623 14.1074C7.55011 13.6954 7.40345 13.244 7.05296 12.9894L3.07722 10.1008C2.29351 9.53141 2.69628 8.2918 3.66501 8.2918L8.57929 8.2918C9.01252 8.2918 9.39647 8.01284 9.53035 7.60081L11.0489 2.92705Z"
                                                fill="#FBB040" />
                                        </svg>
                                    </span>
                                    {{ $averageRating ?? '' }} ({{ $reviewCount ?? '' }})
                                </div>
                            </div>
                            <p class="profile-details-para">
                                {{ $user->businessInformation && $user->businessInformation->bio
                                    ? $user->businessInformation->bio
                                    : 'No bio provided.' }}
                            </p>
                        </div>
                    </div>

                    <div class="tm-services">
                        <h3>Services By
                            {{ $user->businessInformation ? $user->businessInformation->name : $user->first_name . ' ' . $user->last_name }}
                        </h3>
                        <div class="service-grid">
                            @foreach ($user->userServices as $userService)
                                <a href="#" class="service-item">
                                    <div class="service-area-image-area">
                                        <img src="{{ $userService->image ? asset($userService->image) : asset('frontend/images/service-image.jpg') }}"
                                            alt="{{ $userService->service->services_name ?? 'Service Image' }}">
                                    </div>
                                    <div class="tm-service-name-price-wrapper">
                                        <h4>{{ $userService->service->services_name ?? 'Unknown Service' }}</h4>
                                        <h5 class="tm-price">{{ $userService->offered_price }}$</h5>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="service-profile-provider-content-right">
                    <div class="booking-box">
                        <h3>Want to book {{ $user->first_name ?? '' }} {{ $user->last_name ?? '' }}?</h3>
                        <p>Select the services you need and check availability</p>
                        <a class="armie-check-availability" href="javascript:void(0);"
                            data-service-provider-id="{{ $user->id }}" data-service-id="{{ $serviceId }}">
                            Check Availability
                        </a>
                    </div>

                    <div class="tools-used">
                        <h3>Tools & Brands Used</h3>
                        <div class="tool-list">
                            @forelse($user->userTools as $tool)
                                <span class="tool-item">{{ $tool->tool_name }}</span>
                            @empty
                                <p>No tools added yet.</p>
                            @endforelse
                        </div>
                    </div>

                    <div class="tm-service-gallery">
                        <h3>Gallery of Previous Work</h3>
                        <div class="gallery-grid">
                            @foreach ($user->userGalleries as $gallery)
                                <a href="#" class="gallery-item">
                                    <div class="gallery-item-img-area">
                                        <img src="{{ asset($gallery->image) }}" alt="Gallery Image">
                                    </div>
                                    <div class="tm-overlay"></div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="section-padding-x comment-area-about-service-provider">
                <h3 class="coment-heading-armie">
                    What Customers says about {{ $user->first_name ?? '' }} {{ $user->last_name ?? '' }}
                </h3>
                <div class="armie-div-line"></div>
                <div class="tax-profile-left-comment-area">
                    @forelse($reviews as $review)
                        <div class="tax-profile-single-comment">
                            <div class="tax-profile-single-comment-header">
                                <div class="tax-profile-single-comment-author">
                                    <div class="tax-profile-single-comment-author-img">
                                        <img src="{{ asset($review->user->avatar ?? 'backend/images/default_images/user_1.jpg') }}"
                                            alt="comment_author">
                                    </div>
                                    <div class="tax-profile-single-comment-author-name">
                                        <p>{{ $review->user->first_name ?? '' }} {{ $review->user->last_name ?? '' }}</p>
                                        <span>
                                            @for ($i = 1; $i <= 5; $i++)
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    fill="none">
                                                    <path fill="{{ $i <= $review->rating ? '#FBB040' : '#cccccc' }}"
                                                        d="M12.4497 5.16294C12.4105 5.04741 12.3383 4.94589 12.242 4.87092C12.1457 4.79595 12.0296 4.75081 11.908 4.74108L8.34974 4.45838L6.80999 1.05044C6.76096 0.940672 6.6812 0.847445 6.58034 0.782004C6.47948 0.716563 6.36184 0.681707 6.2416 0.681641C6.12137 0.681575 6.00369 0.716302 5.90276 0.781632C5.80183 0.846962 5.72197 0.940102 5.67281 1.04981L4.13306 4.45838L0.574848 4.74108C0.455298 4.75055 0.341007 4.79426 0.245649 4.86697C0.150291 4.93969 0.0779045 5.03833 0.0371484 5.1511C-0.00360776 5.26387 -0.0110073 5.386 0.0158351 5.50286C0.0426776 5.61973 0.102625 5.72639 0.188506 5.81008L2.818 8.37306L1.88804 12.3994C1.8598 12.5213 1.86885 12.6489 1.91401 12.7655C1.95918 12.8822 2.03837 12.9826 2.14131 13.0537C2.24426 13.1248 2.3662 13.1634 2.49132 13.1643C2.61644 13.1653 2.73895 13.1286 2.84297 13.0591L6.2414 10.7938L9.63984 13.0591C9.74615 13.1297 9.87153 13.166 9.99911 13.1632C10.1267 13.1604 10.2504 13.1186 10.3535 13.0434C10.4566 12.9683 10.5342 12.8633 10.5759 12.7427C10.6176 12.6221 10.6213 12.4917 10.5867 12.3689L9.4451 8.37494L12.2762 5.82756C12.4616 5.66031 12.5296 5.39946 12.4497 5.16294Z" />
                                                </svg>
                                            @endfor
                                        </span>
                                    </div>
                                </div>
                                <p class="tax-profile-single-comment-time">
                                    {{ $review->created_at->diffForHumans() }}
                                </p>
                            </div>
                            <p class="tax-profile-single-comment-content">
                                {{ $review->review ?? '' }}
                            </p>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </section>
        {{-- categories second section end --}}

        @include('frontend.partials.join-us')
    </main>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $("select").niceSelect();
        });
    </script>

    <script>
        document.querySelectorAll('.armie-check-availability').forEach(function(element) {
            element.addEventListener('click', function() {
                const serviceProviderId = this.getAttribute('data-service-provider-id');
                const serviceId = this.getAttribute('data-service-id'); // Get the service_id

                @if (Auth::check())
                    @if (Auth::user()->role === 'client')
                        // User is logged in and role is 'client', directly open the route
                        window.location.href = "{{ route('booking-service') }}" + "?service_provider_id=" +
                            serviceProviderId + "&service_id=" + serviceId;
                    @else
                        // User is logged in but not a 'client', show an alert
                        Swal.fire("Only clients can book services.", "", "info");
                    @endif
                @else
                    // User is not logged in, show the login modal
                    Swal.fire({
                        title: "You need to sign in to check availability",
                        showDenyButton: true,
                        showCancelButton: false,
                        confirmButtonText: "Sign In",
                        denyButtonText: `Sign In Later`
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{ route('login') }}?redirect_to=" +
                                encodeURIComponent(window.location.href);
                        } else if (result.isDenied) {
                            Swal.fire("You can sign in later", "", "info");
                        }
                    });
                @endif
            });
        });
    </script>
@endpush
