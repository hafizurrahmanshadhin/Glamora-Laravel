@extends('frontend.app')

@section('title', 'Client Dashboard')

@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/css/dashboard.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/categories.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/tarek.css') }}">
@endpush

@section('content')
    <!-- dashboard content start -->
    <div class="dashboard-layout section-padding-x">
        <div class="dashboard-left">
            <div class="dashboard-profile-container">
                <div class="top">
                    <div class="img-content">
                        <img src="{{ asset('frontend/images/dashboard-profile.png') }}" alt="">
                        <div class="active-status"></div>
                    </div>
                    <div class="text-content">
                        <div class="profile-title">John Doe, CPA</div>
                        <div class="profile-text">New York, NY</div>
                    </div>
                </div>
                <div class="bottom">
                    <div class="bottom-top">
                        <div class="item">
                            <div class="title">Rating as buyer</div>
                            <div class="ratings">
                                ★★★★☆ <span>(4.5)</span>
                            </div>
                        </div>
                        <div class="item">
                            <div class="title">Upcoming Bookings (4)</div>
                            <a class="profile-view-btn" href="">View</a>
                        </div>
                    </div>
                    <div class="bottom-bottom">
                        <a href="" class="common-btn">
                            View Bookings
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="dashboard-main-content">
            <div class="dashboard-banner">
                <div class="text-content">
                    <div class="title-italic">Welcome back,</div>
                    <div class="banner-title">Marzia Begum</div>
                    <div class="text">
                        Start now to connect with trusted tax professionals, book appointments, and manage your
                        documents—all in one
                        place for a smooth tax preparation experience.
                    </div>
                    <!-- search container start -->
                    <div class="search-container">
                        <div class="item service">
                            <div class="title">Service</div>
                            <select class="nice-select" name="beauty-services" id="">
                                <option value="">Select</option>
                                <option value="makeup">Makeup</option>
                                <option value="hair-styling">Hair Styling</option>
                                <option value="facial">Facial</option>
                                <option value="manicure">Manicure</option>
                                <option value="pedicure">Pedicure</option>
                                <option value="waxing">Waxing</option>
                                <option value="massage">Massage</option>
                            </select>
                        </div>
                        <div class="item location">
                            <div class="title">Location</div>
                            <input placeholder="Search" type="text">
                        </div>
                        <div class="item date">
                            <div class="title">Date</div>
                            <div class="date-picker-container">
                                <input id="date-input" placeholder="DD/MM/YY" type="text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="20" viewBox="0 0 19 20"
                                    fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M13.9109 0.768617L13.9119 1.51824C16.6665 1.73413 18.4862 3.61119 18.4891 6.48975L18.5 14.9155C18.5039 18.054 16.5322 19.985 13.3718 19.99L5.65188 20C2.51119 20.004 0.514817 18.027 0.510867 14.8795L0.500007 6.55272C0.496057 3.65517 2.25153 1.78311 5.00617 1.53024L5.00518 0.780611C5.0042 0.340832 5.33001 0.00999726 5.76444 0.00999726C6.19886 0.00899776 6.52468 0.338833 6.52567 0.778612L6.52666 1.47826L12.3914 1.47027L12.3904 0.770616C12.3894 0.330837 12.7152 0.00100177 13.1497 2.26549e-06C13.5742 -0.000997234 13.9099 0.328838 13.9109 0.768617ZM2.02148 6.86157L16.9696 6.84158V6.49175C16.9272 4.34283 15.849 3.21539 13.9138 3.04748L13.9148 3.81709C13.9148 4.24688 13.5801 4.5877 13.1556 4.5877C12.7212 4.5887 12.3943 4.24887 12.3943 3.81909L12.3934 3.0095L6.52863 3.01749L6.52962 3.82609C6.52962 4.25687 6.20479 4.5967 5.77036 4.5967C5.33594 4.5977 5.00913 4.25887 5.00913 3.82809L5.00815 3.05847C3.08286 3.25137 2.01753 4.38281 2.02049 6.55072L2.02148 6.86157ZM12.7399 11.4043V11.4153C12.7498 11.8751 13.125 12.2239 13.5801 12.2139C14.0244 12.2029 14.3789 11.8221 14.369 11.3623C14.3483 10.9225 13.9918 10.5637 13.5485 10.5647C13.0944 10.5747 12.7389 10.9445 12.7399 11.4043ZM13.5554 15.892C13.1013 15.882 12.735 15.5032 12.734 15.0435C12.7241 14.5837 13.0884 14.2029 13.5426 14.1919H13.5525C14.0165 14.1919 14.3927 14.5707 14.3927 15.0405C14.3937 15.5102 14.0185 15.891 13.5554 15.892ZM8.67212 11.4203C8.69187 11.8801 9.06804 12.2389 9.52221 12.2189C9.96651 12.1979 10.321 11.8181 10.3012 11.3583C10.2903 10.9085 9.92504 10.5587 9.48074 10.5597C9.02657 10.5797 8.67113 10.9605 8.67212 11.4203ZM9.52616 15.8471C9.07199 15.8671 8.6968 15.5082 8.67607 15.0485C8.67607 14.5887 9.03052 14.2089 9.48469 14.1879C9.92899 14.1869 10.2953 14.5367 10.3052 14.9855C10.3259 15.4463 9.97046 15.8261 9.52616 15.8471ZM4.60433 11.4553C4.62408 11.915 5.00025 12.2749 5.45442 12.2539C5.89872 12.2339 6.25317 11.8531 6.23243 11.3933C6.22256 10.9435 5.85725 10.5937 5.41196 10.5947C4.95779 10.6147 4.60334 10.9955 4.60433 11.4553ZM5.45837 15.8521C5.0042 15.8731 4.62901 15.5132 4.60828 15.0535C4.60729 14.5937 4.96273 14.2129 5.4169 14.1929C5.8612 14.1919 6.2275 14.5417 6.23737 14.9915C6.2581 15.4513 5.90365 15.8321 5.45837 15.8521Z"
                                        fill="#767676" />
                                </svg>
                            </div>
                        </div>
                        <div class="search-btn-container">
                            <div class="title"></div>
                            <a href="" class="search-btn mt-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="31" height="30" viewBox="0 0 31 30"
                                    fill="none">
                                    <path
                                        d="M14.0938 23.4375C19.5303 23.4375 23.9375 19.0303 23.9375 13.5938C23.9375 8.1572 19.5303 3.75 14.0938 3.75C8.6572 3.75 4.25 8.1572 4.25 13.5938C4.25 19.0303 8.6572 23.4375 14.0938 23.4375Z"
                                        stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M21.0547 20.5547L26.7501 26.2501" stroke="white" stroke-width="3"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <!-- search container end -->
                </div>
                <div class="img-content">
                    <img src="{{ asset('frontend/images/dashboard-banner-right.png') }}" alt="">
                </div>
            </div>

            <div class="appointment-done-area">
                <button type="button" data-bs-toggle="modal" class="tm-dashboard-booking-landing-btn-1 tm-test-click-here"
                    data-bs-target="#appointmentDone">Click Here</button>
            </div>
        </div>
    </div>
    <!-- dashboard content end -->


    <!-- Modal -->
    <div class="modal fade" id="appointmentDone" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body tm-modal-body">
                    <h2>Your Appointment With John Doe is Completed ?</h2>
                    <p class="modal-para">
                        Help Us to Let Know your experience With John Doe
                    </p>
                    <div class="tm-multistep-btn-wrapper">
                        <a href="./appointment-not-done.html" class="tm-appointment-done-btn">No</a>
                        <button class="tm-multi-step-submit-form" type="button" data-bs-toggle="modal"
                            class="tm-dashboard-booking-landing-btn-1" data-bs-target="#appointmentReview">Yes,
                            Done</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- second modal start -->
    <div class="modal fade" id="appointmentReview" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body tm-modal-body tm-modal-body-armie-review">
                    <div class="tm-modal-review-div">
                        <h2>Share your experience of Appointment session with (name)</h2>
                        <div class="tm-modal-review-star-wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40"
                                fill="none">
                                <path
                                    d="M22.8842 5.85002L25.8175 11.7167C26.2175 12.5334 27.2842 13.3167 28.1842 13.4667L33.5008 14.35C36.9008 14.9167 37.7008 17.3834 35.2508 19.8167L31.1175 23.95C30.4175 24.65 30.0342 26 30.2508 26.9667L31.4342 32.0834C32.3675 36.1334 30.2175 37.7 26.6342 35.5834L21.6508 32.6334C20.7508 32.1 19.2675 32.1 18.3508 32.6334L13.3675 35.5834C9.80083 37.7 7.63416 36.1167 8.56749 32.0834L9.75082 26.9667C9.96749 26 9.58416 24.65 8.88416 23.95L4.75082 19.8167C2.31749 17.3834 3.10083 14.9167 6.50083 14.35L11.8175 13.4667C12.7008 13.3167 13.7675 12.5334 14.1675 11.7167L17.1008 5.85002C18.7008 2.66669 21.3008 2.66669 22.8842 5.85002Z"
                                    fill="#FFCC47" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40"
                                fill="none">
                                <path
                                    d="M22.8842 5.85002L25.8175 11.7167C26.2175 12.5334 27.2842 13.3167 28.1842 13.4667L33.5008 14.35C36.9008 14.9167 37.7008 17.3834 35.2508 19.8167L31.1175 23.95C30.4175 24.65 30.0342 26 30.2508 26.9667L31.4342 32.0834C32.3675 36.1334 30.2175 37.7 26.6342 35.5834L21.6508 32.6334C20.7508 32.1 19.2675 32.1 18.3508 32.6334L13.3675 35.5834C9.80083 37.7 7.63416 36.1167 8.56749 32.0834L9.75082 26.9667C9.96749 26 9.58416 24.65 8.88416 23.95L4.75082 19.8167C2.31749 17.3834 3.10083 14.9167 6.50083 14.35L11.8175 13.4667C12.7008 13.3167 13.7675 12.5334 14.1675 11.7167L17.1008 5.85002C18.7008 2.66669 21.3008 2.66669 22.8842 5.85002Z"
                                    fill="#FFCC47" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40"
                                fill="none">
                                <path
                                    d="M22.8842 5.85002L25.8175 11.7167C26.2175 12.5334 27.2842 13.3167 28.1842 13.4667L33.5008 14.35C36.9008 14.9167 37.7008 17.3834 35.2508 19.8167L31.1175 23.95C30.4175 24.65 30.0342 26 30.2508 26.9667L31.4342 32.0834C32.3675 36.1334 30.2175 37.7 26.6342 35.5834L21.6508 32.6334C20.7508 32.1 19.2675 32.1 18.3508 32.6334L13.3675 35.5834C9.80083 37.7 7.63416 36.1167 8.56749 32.0834L9.75082 26.9667C9.96749 26 9.58416 24.65 8.88416 23.95L4.75082 19.8167C2.31749 17.3834 3.10083 14.9167 6.50083 14.35L11.8175 13.4667C12.7008 13.3167 13.7675 12.5334 14.1675 11.7167L17.1008 5.85002C18.7008 2.66669 21.3008 2.66669 22.8842 5.85002Z"
                                    fill="#FFCC47" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40"
                                fill="none">
                                <path
                                    d="M22.8842 5.85002L25.8175 11.7167C26.2175 12.5334 27.2842 13.3167 28.1842 13.4667L33.5008 14.35C36.9008 14.9167 37.7008 17.3834 35.2508 19.8167L31.1175 23.95C30.4175 24.65 30.0342 26 30.2508 26.9667L31.4342 32.0834C32.3675 36.1334 30.2175 37.7 26.6342 35.5834L21.6508 32.6334C20.7508 32.1 19.2675 32.1 18.3508 32.6334L13.3675 35.5834C9.80083 37.7 7.63416 36.1167 8.56749 32.0834L9.75082 26.9667C9.96749 26 9.58416 24.65 8.88416 23.95L4.75082 19.8167C2.31749 17.3834 3.10083 14.9167 6.50083 14.35L11.8175 13.4667C12.7008 13.3167 13.7675 12.5334 14.1675 11.7167L17.1008 5.85002C18.7008 2.66669 21.3008 2.66669 22.8842 5.85002Z"
                                    fill="#FFCC47" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40"
                                fill="none">
                                <path
                                    d="M22.8842 5.85002L25.8175 11.7167C26.2175 12.5334 27.2842 13.3167 28.1842 13.4667L33.5008 14.35C36.9008 14.9167 37.7008 17.3834 35.2508 19.8167L31.1175 23.95C30.4175 24.65 30.0342 26 30.2508 26.9667L31.4342 32.0834C32.3675 36.1334 30.2175 37.7 26.6342 35.5834L21.6508 32.6334C20.7508 32.1 19.2675 32.1 18.3508 32.6334L13.3675 35.5834C9.80083 37.7 7.63416 36.1167 8.56749 32.0834L9.75082 26.9667C9.96749 26 9.58416 24.65 8.88416 23.95L4.75082 19.8167C2.31749 17.3834 3.10083 14.9167 6.50083 14.35L11.8175 13.4667C12.7008 13.3167 13.7675 12.5334 14.1675 11.7167L17.1008 5.85002C18.7008 2.66669 21.3008 2.66669 22.8842 5.85002Z"
                                    fill="#B8C3C4" />
                            </svg>
                        </div>
                        <p class="modal-para modal-para-armie">
                            Tell others about the appointment
                        </p>
                        <textarea class="tm-modal-textarea" name="review" rows="3" placeholder="Write message here...."></textarea>
                    </div>

                    <div class="tm-multistep-btn-wrapper w-100">
                        <button class="tm-multi-step-submit-form"
                            class="tm-dashboard-booking-landing-btn-1 ">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal end -->
@endsection
