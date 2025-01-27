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
                                <div class="service-provider-rating">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <path
                                                d="M11.0489 2.92705C11.3483 2.00574 12.6517 2.00574 12.9511 2.92705L14.4697 7.60081C14.6035 8.01284 14.9875 8.2918 15.4207 8.2918L20.335 8.2918C21.3037 8.2918 21.7065 9.53141 20.9228 10.1008L16.947 12.9894C16.5966 13.244 16.4499 13.6954 16.5838 14.1074L18.1024 18.7812C18.4017 19.7025 17.3472 20.4686 16.5635 19.8992L12.5878 17.0106C12.2373 16.756 11.7627 16.756 11.4122 17.0106L7.43648 19.8992C6.65276 20.4686 5.59828 19.7025 5.89763 18.7812L7.41623 14.1074C7.55011 13.6954 7.40345 13.244 7.05296 12.9894L3.07722 10.1008C2.29351 9.53141 2.69628 8.2918 3.66501 8.2918L8.57929 8.2918C9.01252 8.2918 9.39647 8.01284 9.53035 7.60081L11.0489 2.92705Z"
                                                fill="#FBB040" />
                                        </svg>
                                    </span>
                                    4.5(210)
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
                            @forelse($user->userServices as $userService)
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
                            @empty
                                <p>No services found.</p>
                            @endforelse
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
                            <span class="tool-item">MAC</span>
                            <span class="tool-item">MCharlotte Tilbury</span>
                            <span class="tool-item">Estée Lauder</span>
                            <span class="tool-item">Bobbi Brown</span>
                            <span class="tool-item">Huda Beauty</span>
                        </div>
                    </div>

                    <div class="tm-service-gallery">
                        <h3>Gallery of Previous Work</h3>
                        <div class="gallery-grid">
                            @forelse($user->userServices as $userService)
                                <a href="#" class="gallery-item">
                                    <div class="gallery-item-img-area">
                                        <img src="{{ $userService->image ? asset($userService->image) : asset('frontend/images/service-image-2.jpg') }}"
                                            alt="{{ $userService->service->services_name ?? 'Bridal Makeup' }}">
                                    </div>
                                    <div class="tm-overlay"></div>
                                    <div class="tm-text-overlay">
                                        <p>{{ $userService->service->services_name ?? 'Bridal Makeup' }}</p>
                                    </div>
                                </a>
                            @empty
                                <p>No gallery items found.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <div class="section-padding-x comment-area-about-service-provider">
                <h3 class="coment-heading-armie">What Customers says about Sophia Grace</h3>
                <div class="armie-div-line"></div>
                <div class="tax-profile-left-comment-area">
                    <div class="tax-profile-single-comment">
                        <div class="tax-profile-single-comment-header">
                            <div class="tax-profile-single-comment-author">
                                <div class="tax-profile-single-comment-author-img">
                                    <img src="{{ asset('frontend/images/comment-author.jpg') }}" alt="comment_author">
                                </div>
                                <div class="tax-profile-single-comment-author-name">
                                    <p>Sakib Mo</p>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="78" height="14"
                                            viewBox="0 0 78 14" fill="none">
                                            <path
                                                d="M12.4497 5.16294C12.4105 5.04741 12.3383 4.94589 12.242 4.87092C12.1457 4.79595 12.0296 4.75081 11.908 4.74108L8.34974 4.45838L6.80999 1.05044C6.76096 0.940672 6.6812 0.847445 6.58034 0.782004C6.47948 0.716563 6.36184 0.681707 6.2416 0.681641C6.12137 0.681575 6.00369 0.716302 5.90276 0.781632C5.80183 0.846962 5.72197 0.940102 5.67281 1.04981L4.13306 4.45838L0.574848 4.74108C0.455298 4.75055 0.341007 4.79426 0.245649 4.86697C0.150291 4.93969 0.0779045 5.03833 0.0371484 5.1511C-0.00360776 5.26387 -0.0110073 5.386 0.0158351 5.50286C0.0426776 5.61973 0.102625 5.72639 0.188506 5.81008L2.818 8.37306L1.88804 12.3994C1.8598 12.5213 1.86885 12.6489 1.91401 12.7655C1.95918 12.8822 2.03837 12.9826 2.14131 13.0537C2.24426 13.1248 2.3662 13.1634 2.49132 13.1643C2.61644 13.1653 2.73895 13.1286 2.84297 13.0591L6.2414 10.7938L9.63984 13.0591C9.74615 13.1297 9.87153 13.166 9.99911 13.1632C10.1267 13.1604 10.2504 13.1186 10.3535 13.0434C10.4566 12.9683 10.5342 12.8633 10.5759 12.7427C10.6176 12.6221 10.6213 12.4917 10.5867 12.3689L9.4451 8.37494L12.2762 5.82756C12.4616 5.66031 12.5296 5.39946 12.4497 5.16294Z"
                                                fill="#FBB040" />
                                            <path
                                                d="M28.7732 5.16294C28.734 5.04741 28.6618 4.94589 28.5655 4.87092C28.4692 4.79595 28.3531 4.75081 28.2314 4.74108L24.6732 4.45838L23.1335 1.05044C23.0844 0.940672 23.0047 0.847445 22.9038 0.782004C22.803 0.716563 22.6853 0.681707 22.5651 0.681641C22.4449 0.681575 22.3272 0.716302 22.2262 0.781632C22.1253 0.846962 22.0455 0.940102 21.9963 1.04981L20.4565 4.45838L16.8983 4.74108C16.7788 4.75055 16.6645 4.79426 16.5691 4.86697C16.4738 4.93969 16.4014 5.03833 16.3606 5.1511C16.3199 5.26387 16.3125 5.386 16.3393 5.50286C16.3662 5.61973 16.4261 5.72639 16.512 5.81008L19.1415 8.37306L18.2115 12.3994C18.1833 12.5213 18.1923 12.6489 18.2375 12.7655C18.2827 12.8822 18.3619 12.9826 18.4648 13.0537C18.5677 13.1248 18.6897 13.1634 18.8148 13.1643C18.9399 13.1653 19.0624 13.1286 19.1665 13.0591L22.5649 10.7938L25.9633 13.0591C26.0696 13.1297 26.195 13.166 26.3226 13.1632C26.4502 13.1604 26.5738 13.1186 26.677 13.0434C26.7801 12.9683 26.8577 12.8633 26.8994 12.7427C26.9411 12.6221 26.9448 12.4917 26.9101 12.3689L25.7686 8.37494L28.5997 5.82756C28.7851 5.66031 28.8531 5.39946 28.7732 5.16294Z"
                                                fill="#FBB040" />
                                            <path
                                                d="M45.0967 5.16294C45.0575 5.04741 44.9852 4.94589 44.889 4.87092C44.7927 4.79595 44.6766 4.75081 44.5549 4.74108L40.9967 4.45838L39.457 1.05044C39.4079 0.940672 39.3282 0.847445 39.2273 0.782004C39.1265 0.716563 39.0088 0.681707 38.8886 0.681641C38.7683 0.681575 38.6507 0.716302 38.5497 0.781632C38.4488 0.846962 38.3689 0.940102 38.3198 1.04981L36.78 4.45838L33.2218 4.74108C33.1023 4.75055 32.988 4.79426 32.8926 4.86697C32.7973 4.93969 32.7249 5.03833 32.6841 5.1511C32.6434 5.26387 32.636 5.386 32.6628 5.50286C32.6897 5.61973 32.7496 5.72639 32.8355 5.81008L35.465 8.37306L34.535 12.3994C34.5068 12.5213 34.5158 12.6489 34.561 12.7655C34.6061 12.8822 34.6853 12.9826 34.7883 13.0537C34.8912 13.1248 35.0132 13.1634 35.1383 13.1643C35.2634 13.1653 35.3859 13.1286 35.4899 13.0591L38.8884 10.7938L42.2868 13.0591C42.3931 13.1297 42.5185 13.166 42.6461 13.1632C42.7737 13.1604 42.8973 13.1186 43.0004 13.0434C43.1036 12.9683 43.1812 12.8633 43.2229 12.7427C43.2646 12.6221 43.2683 12.4917 43.2336 12.3689L42.0921 8.37494L44.9232 5.82756C45.1085 5.66031 45.1766 5.39946 45.0967 5.16294Z"
                                                fill="#FBB040" />
                                            <path
                                                d="M61.4204 5.16294C61.3812 5.04741 61.309 4.94589 61.2127 4.87092C61.1164 4.79595 61.0003 4.75081 60.8787 4.74108L57.3204 4.45838L55.7807 1.05044C55.7317 0.940672 55.6519 0.847445 55.551 0.782004C55.4502 0.716563 55.3325 0.681707 55.2123 0.681641C55.0921 0.681575 54.9744 0.716302 54.8735 0.781632C54.7725 0.846962 54.6927 0.940102 54.6435 1.04981L53.1038 4.45838L49.5456 4.74108C49.426 4.75055 49.3117 4.79426 49.2164 4.86697C49.121 4.93969 49.0486 5.03833 49.0079 5.1511C48.9671 5.26387 48.9597 5.386 48.9865 5.50286C49.0134 5.61973 49.0733 5.72639 49.1592 5.81008L51.7887 8.37306L50.8587 12.3994C50.8305 12.5213 50.8396 12.6489 50.8847 12.7655C50.9299 12.8822 51.0091 12.9826 51.112 13.0537C51.215 13.1248 51.3369 13.1634 51.462 13.1643C51.5871 13.1653 51.7097 13.1286 51.8137 13.0591L55.2121 10.7938L58.6105 13.0591C58.7169 13.1297 58.8422 13.166 58.9698 13.1632C59.0974 13.1604 59.2211 13.1186 59.3242 13.0434C59.4273 12.9683 59.5049 12.8633 59.5466 12.7427C59.5883 12.6221 59.592 12.4917 59.5574 12.3689L58.4158 8.37494L61.2469 5.82756C61.4323 5.66031 61.5003 5.39946 61.4204 5.16294Z"
                                                fill="#FBB040" />
                                            <path
                                                d="M77.7439 5.16294C77.7047 5.04741 77.6325 4.94589 77.5362 4.87092C77.4399 4.79595 77.3238 4.75081 77.2021 4.74108L73.6439 4.45838L72.1042 1.05044C72.0551 0.940672 71.9754 0.847445 71.8745 0.782004C71.7737 0.716563 71.656 0.681707 71.5358 0.681641C71.4156 0.681575 71.2979 0.716302 71.1969 0.781632C71.096 0.846962 71.0162 0.940102 70.967 1.04981L69.4273 4.45838L65.869 4.74108C65.7495 4.75055 65.6352 4.79426 65.5398 4.86697C65.4445 4.93969 65.3721 5.03833 65.3313 5.1511C65.2906 5.26387 65.2832 5.386 65.31 5.50286C65.3369 5.61973 65.3968 5.72639 65.4827 5.81008L68.1122 8.37306L67.1822 12.3994C67.154 12.5213 67.163 12.6489 67.2082 12.7655C67.2534 12.8822 67.3326 12.9826 67.4355 13.0537C67.5384 13.1248 67.6604 13.1634 67.7855 13.1643C67.9106 13.1653 68.0331 13.1286 68.1372 13.0591L71.5356 10.7938L74.934 13.0591C75.0403 13.1297 75.1657 13.166 75.2933 13.1632C75.4209 13.1604 75.5445 13.1186 75.6477 13.0434C75.7508 12.9683 75.8284 12.8633 75.8701 12.7427C75.9118 12.6221 75.9155 12.4917 75.8808 12.3689L74.7393 8.37494L77.5704 5.82756C77.7558 5.66031 77.8238 5.39946 77.7439 5.16294Z"
                                                fill="#FBB040" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <p class="tax-profile-single-comment-time">1 Month ego</p>
                        </div>
                        <p class="tax-profile-single-comment-content">
                            Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia
                            consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.Amet minim
                            mollit
                        </p>
                    </div>

                    <div class="tax-profile-single-comment">
                        <div class="tax-profile-single-comment-header">
                            <div class="tax-profile-single-comment-author">
                                <div class="tax-profile-single-comment-author-img">
                                    <img src="{{ asset('frontend/images/comment-author.jpg') }}" alt="comment_author">
                                </div>
                                <div class="tax-profile-single-comment-author-name">
                                    <p>Sakib Mo</p>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="78" height="14"
                                            viewBox="0 0 78 14" fill="none">
                                            <path
                                                d="M12.4497 5.16294C12.4105 5.04741 12.3383 4.94589 12.242 4.87092C12.1457 4.79595 12.0296 4.75081 11.908 4.74108L8.34974 4.45838L6.80999 1.05044C6.76096 0.940672 6.6812 0.847445 6.58034 0.782004C6.47948 0.716563 6.36184 0.681707 6.2416 0.681641C6.12137 0.681575 6.00369 0.716302 5.90276 0.781632C5.80183 0.846962 5.72197 0.940102 5.67281 1.04981L4.13306 4.45838L0.574848 4.74108C0.455298 4.75055 0.341007 4.79426 0.245649 4.86697C0.150291 4.93969 0.0779045 5.03833 0.0371484 5.1511C-0.00360776 5.26387 -0.0110073 5.386 0.0158351 5.50286C0.0426776 5.61973 0.102625 5.72639 0.188506 5.81008L2.818 8.37306L1.88804 12.3994C1.8598 12.5213 1.86885 12.6489 1.91401 12.7655C1.95918 12.8822 2.03837 12.9826 2.14131 13.0537C2.24426 13.1248 2.3662 13.1634 2.49132 13.1643C2.61644 13.1653 2.73895 13.1286 2.84297 13.0591L6.2414 10.7938L9.63984 13.0591C9.74615 13.1297 9.87153 13.166 9.99911 13.1632C10.1267 13.1604 10.2504 13.1186 10.3535 13.0434C10.4566 12.9683 10.5342 12.8633 10.5759 12.7427C10.6176 12.6221 10.6213 12.4917 10.5867 12.3689L9.4451 8.37494L12.2762 5.82756C12.4616 5.66031 12.5296 5.39946 12.4497 5.16294Z"
                                                fill="#FBB040" />
                                            <path
                                                d="M28.7732 5.16294C28.734 5.04741 28.6618 4.94589 28.5655 4.87092C28.4692 4.79595 28.3531 4.75081 28.2314 4.74108L24.6732 4.45838L23.1335 1.05044C23.0844 0.940672 23.0047 0.847445 22.9038 0.782004C22.803 0.716563 22.6853 0.681707 22.5651 0.681641C22.4449 0.681575 22.3272 0.716302 22.2262 0.781632C22.1253 0.846962 22.0455 0.940102 21.9963 1.04981L20.4565 4.45838L16.8983 4.74108C16.7788 4.75055 16.6645 4.79426 16.5691 4.86697C16.4738 4.93969 16.4014 5.03833 16.3606 5.1511C16.3199 5.26387 16.3125 5.386 16.3393 5.50286C16.3662 5.61973 16.4261 5.72639 16.512 5.81008L19.1415 8.37306L18.2115 12.3994C18.1833 12.5213 18.1923 12.6489 18.2375 12.7655C18.2827 12.8822 18.3619 12.9826 18.4648 13.0537C18.5677 13.1248 18.6897 13.1634 18.8148 13.1643C18.9399 13.1653 19.0624 13.1286 19.1665 13.0591L22.5649 10.7938L25.9633 13.0591C26.0696 13.1297 26.195 13.166 26.3226 13.1632C26.4502 13.1604 26.5738 13.1186 26.677 13.0434C26.7801 12.9683 26.8577 12.8633 26.8994 12.7427C26.9411 12.6221 26.9448 12.4917 26.9101 12.3689L25.7686 8.37494L28.5997 5.82756C28.7851 5.66031 28.8531 5.39946 28.7732 5.16294Z"
                                                fill="#FBB040" />
                                            <path
                                                d="M45.0967 5.16294C45.0575 5.04741 44.9852 4.94589 44.889 4.87092C44.7927 4.79595 44.6766 4.75081 44.5549 4.74108L40.9967 4.45838L39.457 1.05044C39.4079 0.940672 39.3282 0.847445 39.2273 0.782004C39.1265 0.716563 39.0088 0.681707 38.8886 0.681641C38.7683 0.681575 38.6507 0.716302 38.5497 0.781632C38.4488 0.846962 38.3689 0.940102 38.3198 1.04981L36.78 4.45838L33.2218 4.74108C33.1023 4.75055 32.988 4.79426 32.8926 4.86697C32.7973 4.93969 32.7249 5.03833 32.6841 5.1511C32.6434 5.26387 32.636 5.386 32.6628 5.50286C32.6897 5.61973 32.7496 5.72639 32.8355 5.81008L35.465 8.37306L34.535 12.3994C34.5068 12.5213 34.5158 12.6489 34.561 12.7655C34.6061 12.8822 34.6853 12.9826 34.7883 13.0537C34.8912 13.1248 35.0132 13.1634 35.1383 13.1643C35.2634 13.1653 35.3859 13.1286 35.4899 13.0591L38.8884 10.7938L42.2868 13.0591C42.3931 13.1297 42.5185 13.166 42.6461 13.1632C42.7737 13.1604 42.8973 13.1186 43.0004 13.0434C43.1036 12.9683 43.1812 12.8633 43.2229 12.7427C43.2646 12.6221 43.2683 12.4917 43.2336 12.3689L42.0921 8.37494L44.9232 5.82756C45.1085 5.66031 45.1766 5.39946 45.0967 5.16294Z"
                                                fill="#FBB040" />
                                            <path
                                                d="M61.4204 5.16294C61.3812 5.04741 61.309 4.94589 61.2127 4.87092C61.1164 4.79595 61.0003 4.75081 60.8787 4.74108L57.3204 4.45838L55.7807 1.05044C55.7317 0.940672 55.6519 0.847445 55.551 0.782004C55.4502 0.716563 55.3325 0.681707 55.2123 0.681641C55.0921 0.681575 54.9744 0.716302 54.8735 0.781632C54.7725 0.846962 54.6927 0.940102 54.6435 1.04981L53.1038 4.45838L49.5456 4.74108C49.426 4.75055 49.3117 4.79426 49.2164 4.86697C49.121 4.93969 49.0486 5.03833 49.0079 5.1511C48.9671 5.26387 48.9597 5.386 48.9865 5.50286C49.0134 5.61973 49.0733 5.72639 49.1592 5.81008L51.7887 8.37306L50.8587 12.3994C50.8305 12.5213 50.8396 12.6489 50.8847 12.7655C50.9299 12.8822 51.0091 12.9826 51.112 13.0537C51.215 13.1248 51.3369 13.1634 51.462 13.1643C51.5871 13.1653 51.7097 13.1286 51.8137 13.0591L55.2121 10.7938L58.6105 13.0591C58.7169 13.1297 58.8422 13.166 58.9698 13.1632C59.0974 13.1604 59.2211 13.1186 59.3242 13.0434C59.4273 12.9683 59.5049 12.8633 59.5466 12.7427C59.5883 12.6221 59.592 12.4917 59.5574 12.3689L58.4158 8.37494L61.2469 5.82756C61.4323 5.66031 61.5003 5.39946 61.4204 5.16294Z"
                                                fill="#FBB040" />
                                            <path
                                                d="M77.7439 5.16294C77.7047 5.04741 77.6325 4.94589 77.5362 4.87092C77.4399 4.79595 77.3238 4.75081 77.2021 4.74108L73.6439 4.45838L72.1042 1.05044C72.0551 0.940672 71.9754 0.847445 71.8745 0.782004C71.7737 0.716563 71.656 0.681707 71.5358 0.681641C71.4156 0.681575 71.2979 0.716302 71.1969 0.781632C71.096 0.846962 71.0162 0.940102 70.967 1.04981L69.4273 4.45838L65.869 4.74108C65.7495 4.75055 65.6352 4.79426 65.5398 4.86697C65.4445 4.93969 65.3721 5.03833 65.3313 5.1511C65.2906 5.26387 65.2832 5.386 65.31 5.50286C65.3369 5.61973 65.3968 5.72639 65.4827 5.81008L68.1122 8.37306L67.1822 12.3994C67.154 12.5213 67.163 12.6489 67.2082 12.7655C67.2534 12.8822 67.3326 12.9826 67.4355 13.0537C67.5384 13.1248 67.6604 13.1634 67.7855 13.1643C67.9106 13.1653 68.0331 13.1286 68.1372 13.0591L71.5356 10.7938L74.934 13.0591C75.0403 13.1297 75.1657 13.166 75.2933 13.1632C75.4209 13.1604 75.5445 13.1186 75.6477 13.0434C75.7508 12.9683 75.8284 12.8633 75.8701 12.7427C75.9118 12.6221 75.9155 12.4917 75.8808 12.3689L74.7393 8.37494L77.5704 5.82756C77.7558 5.66031 77.8238 5.39946 77.7439 5.16294Z"
                                                fill="#FBB040" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <p class="tax-profile-single-comment-time">1 Month ego</p>
                        </div>
                        <p class="tax-profile-single-comment-content">
                            Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia
                            consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.Amet minim
                            mollit
                        </p>
                    </div>
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
                            window.location.href = "{{ route('login') }}";
                        } else if (result.isDenied) {
                            Swal.fire("You can sign in later", "", "info");
                        }
                    });
                @endif
            });
        });
    </script>
@endpush
