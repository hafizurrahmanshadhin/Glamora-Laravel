@extends('frontend.app')

@section('title', 'Glamora')

@section('content')
    <!-- home banner start -->
    <div class="home-banner">
        <div class="text-content">
            <div data-aos="fade-right" data-aos-delay="100" class="italic-text">
                Find The
            </div>
            <div data-aos="fade-right" data-aos-delay="200" class="section-title">
                BEST Beauty <br />
                Professionals
            </div>
            <div data-aos="fade-right" data-aos-delay="300" class="section-text mt-4">
                we connect you with the best beauty professionals in your area.
                Whether you're getting ready for a special occasion or just treating
                yourself, our expert providers ensure a top-tier experience every
                time.
            </div>

            <div class="text-circle-box">
                <a href="" class="home-circle">
                    <span class="home-circle-arrow"> → </span>
                </a>
                <svg class="text-svg" xmlns="http://www.w3.org/2000/svg" xml:lang="en"
                    xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 500 500">
                    <defs>
                        <path id="textcircle"
                            d="M250,400
                                                                                                                             a150,150 0 0,1 0,-300a150,150 0 0,1 0,300Z"
                            transform="rotate(12,250,250)" />
                    </defs>
                    <g class="textcircle">
                        <text textLength="940">
                            <textPath xlink:href="#textcircle" aria-label="CSS & SVG are awesome" textLength="940">
                                Learn More Learn More Learn More Learn More
                            </textPath>
                        </text>
                    </g>
                </svg>
            </div>

            <!-- search container start -->
            <div data-aos="fade-right" data-aos-delay="400" class="search-container ">

                <div class="item location">
                    <div class="title">Location</div>
                    <input placeholder="Search" type="text" />
                </div>
                <div class="item date">
                    <div class="title">Date</div>
                    <div class="date-picker-container">
                        <input id="date-input" placeholder="DD/MM/YY" type="text" />
                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="20" viewBox="0 0 19 20"
                            fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M13.9109 0.768617L13.9119 1.51824C16.6665 1.73413 18.4862 3.61119 18.4891 6.48975L18.5 14.9155C18.5039 18.054 16.5322 19.985 13.3718 19.99L5.65188 20C2.51119 20.004 0.514817 18.027 0.510867 14.8795L0.500007 6.55272C0.496057 3.65517 2.25153 1.78311 5.00617 1.53024L5.00518 0.780611C5.0042 0.340832 5.33001 0.00999726 5.76444 0.00999726C6.19886 0.00899776 6.52468 0.338833 6.52567 0.778612L6.52666 1.47826L12.3914 1.47027L12.3904 0.770616C12.3894 0.330837 12.7152 0.00100177 13.1497 2.26549e-06C13.5742 -0.000997234 13.9099 0.328838 13.9109 0.768617ZM2.02148 6.86157L16.9696 6.84158V6.49175C16.9272 4.34283 15.849 3.21539 13.9138 3.04748L13.9148 3.81709C13.9148 4.24688 13.5801 4.5877 13.1556 4.5877C12.7212 4.5887 12.3943 4.24887 12.3943 3.81909L12.3934 3.0095L6.52863 3.01749L6.52962 3.82609C6.52962 4.25687 6.20479 4.5967 5.77036 4.5967C5.33594 4.5977 5.00913 4.25887 5.00913 3.82809L5.00815 3.05847C3.08286 3.25137 2.01753 4.38281 2.02049 6.55072L2.02148 6.86157ZM12.7399 11.4043V11.4153C12.7498 11.8751 13.125 12.2239 13.5801 12.2139C14.0244 12.2029 14.3789 11.8221 14.369 11.3623C14.3483 10.9225 13.9918 10.5637 13.5485 10.5647C13.0944 10.5747 12.7389 10.9445 12.7399 11.4043ZM13.5554 15.892C13.1013 15.882 12.735 15.5032 12.734 15.0435C12.7241 14.5837 13.0884 14.2029 13.5426 14.1919H13.5525C14.0165 14.1919 14.3927 14.5707 14.3927 15.0405C14.3937 15.5102 14.0185 15.891 13.5554 15.892ZM8.67212 11.4203C8.69187 11.8801 9.06804 12.2389 9.52221 12.2189C9.96651 12.1979 10.321 11.8181 10.3012 11.3583C10.2903 10.9085 9.92504 10.5587 9.48074 10.5597C9.02657 10.5797 8.67113 10.9605 8.67212 11.4203ZM9.52616 15.8471C9.07199 15.8671 8.6968 15.5082 8.67607 15.0485C8.67607 14.5887 9.03052 14.2089 9.48469 14.1879C9.92899 14.1869 10.2953 14.5367 10.3052 14.9855C10.3259 15.4463 9.97046 15.8261 9.52616 15.8471ZM4.60433 11.4553C4.62408 11.915 5.00025 12.2749 5.45442 12.2539C5.89872 12.2339 6.25317 11.8531 6.23243 11.3933C6.22256 10.9435 5.85725 10.5937 5.41196 10.5947C4.95779 10.6147 4.60334 10.9955 4.60433 11.4553ZM5.45837 15.8521C5.0042 15.8731 4.62901 15.5132 4.60828 15.0535C4.60729 14.5937 4.96273 14.2129 5.4169 14.1929C5.8612 14.1919 6.2275 14.5417 6.23737 14.9915C6.2581 15.4513 5.90365 15.8321 5.45837 15.8521Z"
                                fill="#767676" />
                        </svg>
                    </div>
                </div>
                <div class="item service">
                    <div class="title">Service</div>
                    <div class="select-service-container">
                        <div class="select-service-btn">
                            <span class="selected-person-count">Select</span>
                            <svg fill="#767676" width="22px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                <path
                                    d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304l91.4 0C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7L29.7 512C13.3 512 0 498.7 0 482.3zM504 312l0-64-64 0c-13.3 0-24-10.7-24-24s10.7-24 24-24l64 0 0-64c0-13.3 10.7-24 24-24s24 10.7 24 24l0 64 64 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-64 0 0 64c0 13.3-10.7 24-24 24s-24-10.7-24-24z" />
                            </svg>
                        </div>
                        <div class="selected-service-container">
                            <div class="selected-service-container-list">

                            </div>
                            <div class="selected-service-container-top mt-4">
                                <div class="selected-service-container-count">
                                    <div class="service-count"><span id="service-count">0</span> Person</div>
                                    <div class="add-service-btn">Add Service</div>
                                </div>
                            </div>
                            <div class="done-btn">Done</div>
                        </div>
                        <div class="select-service-dropdown">
                            <div class="select-service-dropdown-options d-flex flex-column gap-3 ">
                                <div class="item d-flex flex-column gap-2">
                                    <div class="title">Select who would like the service</div>
                                    <select id="service-selector" class="form-select" aria-label="Default select example">
                                        <option selected>Select</option>
                                        <option value="Non Bridal">Non Bridal (Party, Specials Occasions)</option>
                                        <option value="Bride">Bride</option>
                                        <option value="Flower Girl">Flower Girl</option>
                                    </select>
                                </div>
                                <div class="item d-flex flex-column gap-2">
                                    <div class="title">What service would you like?</div>
                                    <select id="sub-service-selector" class="form-select"
                                        aria-label="Default select example">
                                        <option selected>Select</option>
                                        <option value="Mackup Only">Mackup Only</option>
                                        <option value="Hair Down">Hair Down</option>
                                        <option value="Hair Up">Hair Up</option>
                                        <option value="Makeup and Hair Down">Makeup and Hair Down</option>
                                        <option value="Makeup and Hair Up">Makeup and Hair Up</option>
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex gap-4 align-items-center ">
                                <div style="display: none;" class="select-service-dropdown-add-btn mt-4">Add</div>
                                <div class="select-service-dropdown-cancel-btn mt-4">Cancel</div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="search-btn-container">
                    <div class="title"></div>
                    <a href="./service-category.html" class="search-btn mt-4">
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
        <div data-aos="fade-left" class="img-slider">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                        class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('frontend/images/home-banner.png') }}" alt="" />
                        <div class="carousel-caption">
                            <h5>First slide label</h5>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('frontend/images/home-banner.png') }}" alt="" />
                        <div class="carousel-caption">
                            <h5>First slide label</h5>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('frontend/images/home-banner.png') }}" alt="" />
                        <div class="carousel-caption">
                            <h5>First slide label</h5>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
    <!-- home banner end -->

    <!-- home counter start -->
    <div class="home-counter m-top m-bottom">
        <div class="home-counter-border">
            <svg width="2" viewBox="0 0 2 250" fill="none" xmlns="http://www.w3.org/2000/svg">
                <line x1="1" y1="2.18557e-08" x2="0.999989" y2="250"
                    stroke="url(#paint0_linear_11537_2016)" />
                <defs>
                    <linearGradient id="paint0_linear_11537_2016" x1="0" y1="-2.18557e-08" x2="-1.09278e-05"
                        y2="250" gradientUnits="userSpaceOnUse">
                        <stop />
                        <stop offset="1" stop-color="white" />
                    </linearGradient>
                </defs>
            </svg>
        </div>

        <div class="item">
            <div class="text">
                We’ve facilitated over 20,000 beauty appointments to date.
            </div>
            <div data-target="20" class="title">20k+</div>
        </div>
        <div class="home-counter-border">
            <svg width="2" height="250" viewBox="0 0 2 250" fill="none" xmlns="http://www.w3.org/2000/svg">
                <line x1="1" y1="2.18557e-08" x2="0.999989" y2="250"
                    stroke="url(#paint0_linear_11537_2016)" />
                <defs>
                    <linearGradient id="paint0_linear_11537_2016" x1="0" y1="-2.18557e-08" x2="-1.09278e-05"
                        y2="250" gradientUnits="userSpaceOnUse">
                        <stop />
                        <stop offset="1" stop-color="white" />
                    </linearGradient>
                </defs>
            </svg>
        </div>

        <div class="item">
            <div class="text">
                Our professionals have collectively earned over $5 million through our
                platform
            </div>
            <div data-target="5" class="title">$5m+</div>
        </div>
        <div class="home-counter-border">
            <svg width="2" height="250" viewBox="0 0 2 250" fill="none" xmlns="http://www.w3.org/2000/svg">
                <line x1="1" y1="2.18557e-08" x2="0.999989" y2="250"
                    stroke="url(#paint0_linear_11537_2016)" />
                <defs>
                    <linearGradient id="paint0_linear_11537_2016" x1="0" y1="-2.18557e-08" x2="-1.09278e-05"
                        y2="250" gradientUnits="userSpaceOnUse">
                        <stop />
                        <stop offset="1" stop-color="white" />
                    </linearGradient>
                </defs>
            </svg>
        </div>

        <div class="item">
            <div class="text">
                Over 1,500 certified beauty professionals available across the
                country.
            </div>
            <div data-target="1500" class="title">1,500+</div>
        </div>
        <div class="home-counter-border">
            <svg width="2" height="250" viewBox="0 0 2 250" fill="none" xmlns="http://www.w3.org/2000/svg">
                <line x1="1" y1="2.18557e-08" x2="0.999989" y2="250"
                    stroke="url(#paint0_linear_11537_2016)" />
                <defs>
                    <linearGradient id="paint0_linear_11537_2016" x1="0" y1="-2.18557e-08" x2="-1.09278e-05"
                        y2="250" gradientUnits="userSpaceOnUse">
                        <stop />
                        <stop offset="1" stop-color="white" />
                    </linearGradient>
                </defs>
            </svg>
        </div>
        <div class="item">
            <div class="text">
                98% of our clients are satisfied with the services they receive.
            </div>
            <div data-target="98" class="title">98%</div>
        </div>
        <div class="home-counter-border">
            <svg width="2" height="250" viewBox="0 0 2 250" fill="none" xmlns="http://www.w3.org/2000/svg">
                <line x1="1" y1="2.18557e-08" x2="0.999989" y2="250"
                    stroke="url(#paint0_linear_11537_2016)" />
                <defs>
                    <linearGradient id="paint0_linear_11537_2016" x1="0" y1="-2.18557e-08" x2="-1.09278e-05"
                        y2="250" gradientUnits="userSpaceOnUse">
                        <stop />
                        <stop offset="1" stop-color="white" />
                    </linearGradient>
                </defs>
            </svg>
        </div>
    </div>
    <!-- home counter end -->

    <!-- home italic text container start -->
    <div class="home-italic-text-container m-bottom">
        <div data-aos="fade-up" data-aos-delay="100" class="text">
            At Glamora we make finding top beauty professionals easy and
            stress-free. Explore and book trusted experts for all your beauty needs
            in one place !
        </div>
    </div>
    <!-- home italic text container end -->

    {{-- home beauty services start --}}
    <div class="home-beauty-services m-bottom">
        <div data-aos="fade-right" data-aos-delay="100" class="section-sub-title-italic text-center">
            Services
        </div>
        <div data-aos="fade-left" data-aos-delay="200" class="section-sub-title text-center">
            Available Beauty Services
        </div>

        <div class="slider">
            @foreach ($approvedServices as $userService)
                <div class="item">
                    <div class="img-content">
                        <img src="{{ $userService->image ? asset($userService->image) : asset('frontend/images/default.png') }}"
                            alt="Service Image" />
                    </div>
                    <div class="text-content">
                        <div class="left">
                            <div class="title">{{ $userService->service->services_name }}</div>
                            <div class="text">{{ $userService->styler_count }}+ Stylers Available</div>
                        </div>

                        <a href="{{ route('available-services', ['serviceId' => $userService->service_id]) }}"
                            class="right action">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="14" viewBox="0 0 18 14"
                                fill="none">
                                <path d="M16.5 7L1.5 7" stroke="" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M10.4492 0.975414L16.4992 6.99941L10.4492 13.0244" stroke=""
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{-- home beauty services end --}}

    {{-- home user type container start --}}
    <div class="section-padding-x home-user-type m-bottom ">
        <div style="
          background: linear-gradient(
              180deg,
              rgba(255, 255, 255, 0) 16%,
              rgba(255, 255, 255, 0.6) 100%
            ),
            url('{{ asset('frontend/images/home-user-type-1.png') }}')
        "
            class="item">
            <div class="text-content">
                <div class="title">I'm a Beauty Professional</div>
                <div class="text mt-3">
                    Join our platform to showcase your skills, connect with clients, and
                    grow your beauty business. Benefit from secure payments and flexible
                    scheduling.
                </div>
                <div class="mt-4">
                    <a href="{{ route('register', ['role' => 'beauty_expert']) }}" class="common-btn">Join</a>
                </div>
            </div>
        </div>

        <div style="
          background: linear-gradient(
              180deg,
              rgba(255, 255, 255, 0) 16%,
              rgba(255, 255, 255, 0.6) 100%
            ),
            url('{{ asset('frontend/images/home-user-type-2.png') }}')
        "
            class="item">
            <div class="text-content">
                <div class="title">I'm Looking for a Beauty Service</div>
                <div class="text mt-3">
                    Find trusted beauty professionals near you, book an appointment for
                    your next glam session, and experience top-tier service right at
                    your convenience.
                </div>
                <div class="mt-4">
                    <a href="{{ route('service-category') }}" class="common-btn">Search</a>
                </div>
            </div>
        </div>
    </div>
    {{-- home user type container end --}}

    <!-- home testimonial section start -->
    <div class="home-testimonial section-padding-x m-bottom ">
        <img class="home-testimonial-shape" src="{{ asset('frontend/images/home-testimonial-shape.png') }}"
            alt="" />
        <div class="img-content">
            <div class="total-reviews">
                <div class="total-reviews-count">4.8</div>
                <div class="total-reviews-stars">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24"
                        fill="none">
                        <path
                            d="M22.4852 10.7229L18.2571 14.4129L19.5236 19.9067C19.5906 20.1939 19.5715 20.4945 19.4686 20.7709C19.3658 21.0472 19.1837 21.2872 18.9452 21.4606C18.7067 21.6341 18.4223 21.7334 18.1277 21.7462C17.8331 21.7589 17.5412 21.6845 17.2886 21.5323L12.4971 18.6261L7.7158 21.5323C7.46321 21.6845 7.17135 21.7589 6.87672 21.7462C6.58208 21.7334 6.29773 21.6341 6.05923 21.4606C5.82074 21.2872 5.63866 21.0472 5.53578 20.7709C5.4329 20.4945 5.41378 20.1939 5.4808 19.9067L6.74549 14.4186L2.51643 10.7229C2.29275 10.53 2.131 10.2754 2.05148 9.99089C1.97195 9.70642 1.97819 9.4048 2.0694 9.12385C2.16061 8.84291 2.33274 8.59515 2.5642 8.41164C2.79566 8.22813 3.07615 8.11705 3.37049 8.09231L8.94487 7.6095L11.1208 2.4195C11.2344 2.14717 11.4261 1.91455 11.6717 1.75093C11.9172 1.58731 12.2057 1.5 12.5008 1.5C12.7959 1.5 13.0844 1.58731 13.3299 1.75093C13.5755 1.91455 13.7672 2.14717 13.8808 2.4195L16.0633 7.6095L21.6358 8.09231C21.9301 8.11705 22.2106 8.22813 22.4421 8.41164C22.6736 8.59515 22.8457 8.84291 22.9369 9.12385C23.0281 9.4048 23.0343 9.70642 22.9548 9.99089C22.8753 10.2754 22.7135 10.53 22.4899 10.7229H22.4852Z"
                            fill="#FFA01E" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24"
                        fill="none">
                        <path
                            d="M22.4852 10.7229L18.2571 14.4129L19.5236 19.9067C19.5906 20.1939 19.5715 20.4945 19.4686 20.7709C19.3658 21.0472 19.1837 21.2872 18.9452 21.4606C18.7067 21.6341 18.4223 21.7334 18.1277 21.7462C17.8331 21.7589 17.5412 21.6845 17.2886 21.5323L12.4971 18.6261L7.7158 21.5323C7.46321 21.6845 7.17135 21.7589 6.87672 21.7462C6.58208 21.7334 6.29773 21.6341 6.05923 21.4606C5.82074 21.2872 5.63866 21.0472 5.53578 20.7709C5.4329 20.4945 5.41378 20.1939 5.4808 19.9067L6.74549 14.4186L2.51643 10.7229C2.29275 10.53 2.131 10.2754 2.05148 9.99089C1.97195 9.70642 1.97819 9.4048 2.0694 9.12385C2.16061 8.84291 2.33274 8.59515 2.5642 8.41164C2.79566 8.22813 3.07615 8.11705 3.37049 8.09231L8.94487 7.6095L11.1208 2.4195C11.2344 2.14717 11.4261 1.91455 11.6717 1.75093C11.9172 1.58731 12.2057 1.5 12.5008 1.5C12.7959 1.5 13.0844 1.58731 13.3299 1.75093C13.5755 1.91455 13.7672 2.14717 13.8808 2.4195L16.0633 7.6095L21.6358 8.09231C21.9301 8.11705 22.2106 8.22813 22.4421 8.41164C22.6736 8.59515 22.8457 8.84291 22.9369 9.12385C23.0281 9.4048 23.0343 9.70642 22.9548 9.99089C22.8753 10.2754 22.7135 10.53 22.4899 10.7229H22.4852Z"
                            fill="#FFA01E" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24"
                        fill="none">
                        <path
                            d="M22.4852 10.7229L18.2571 14.4129L19.5236 19.9067C19.5906 20.1939 19.5715 20.4945 19.4686 20.7709C19.3658 21.0472 19.1837 21.2872 18.9452 21.4606C18.7067 21.6341 18.4223 21.7334 18.1277 21.7462C17.8331 21.7589 17.5412 21.6845 17.2886 21.5323L12.4971 18.6261L7.7158 21.5323C7.46321 21.6845 7.17135 21.7589 6.87672 21.7462C6.58208 21.7334 6.29773 21.6341 6.05923 21.4606C5.82074 21.2872 5.63866 21.0472 5.53578 20.7709C5.4329 20.4945 5.41378 20.1939 5.4808 19.9067L6.74549 14.4186L2.51643 10.7229C2.29275 10.53 2.131 10.2754 2.05148 9.99089C1.97195 9.70642 1.97819 9.4048 2.0694 9.12385C2.16061 8.84291 2.33274 8.59515 2.5642 8.41164C2.79566 8.22813 3.07615 8.11705 3.37049 8.09231L8.94487 7.6095L11.1208 2.4195C11.2344 2.14717 11.4261 1.91455 11.6717 1.75093C11.9172 1.58731 12.2057 1.5 12.5008 1.5C12.7959 1.5 13.0844 1.58731 13.3299 1.75093C13.5755 1.91455 13.7672 2.14717 13.8808 2.4195L16.0633 7.6095L21.6358 8.09231C21.9301 8.11705 22.2106 8.22813 22.4421 8.41164C22.6736 8.59515 22.8457 8.84291 22.9369 9.12385C23.0281 9.4048 23.0343 9.70642 22.9548 9.99089C22.8753 10.2754 22.7135 10.53 22.4899 10.7229H22.4852Z"
                            fill="#FFA01E" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24"
                        fill="none">
                        <path
                            d="M22.4852 10.7229L18.2571 14.4129L19.5236 19.9067C19.5906 20.1939 19.5715 20.4945 19.4686 20.7709C19.3658 21.0472 19.1837 21.2872 18.9452 21.4606C18.7067 21.6341 18.4223 21.7334 18.1277 21.7462C17.8331 21.7589 17.5412 21.6845 17.2886 21.5323L12.4971 18.6261L7.7158 21.5323C7.46321 21.6845 7.17135 21.7589 6.87672 21.7462C6.58208 21.7334 6.29773 21.6341 6.05923 21.4606C5.82074 21.2872 5.63866 21.0472 5.53578 20.7709C5.4329 20.4945 5.41378 20.1939 5.4808 19.9067L6.74549 14.4186L2.51643 10.7229C2.29275 10.53 2.131 10.2754 2.05148 9.99089C1.97195 9.70642 1.97819 9.4048 2.0694 9.12385C2.16061 8.84291 2.33274 8.59515 2.5642 8.41164C2.79566 8.22813 3.07615 8.11705 3.37049 8.09231L8.94487 7.6095L11.1208 2.4195C11.2344 2.14717 11.4261 1.91455 11.6717 1.75093C11.9172 1.58731 12.2057 1.5 12.5008 1.5C12.7959 1.5 13.0844 1.58731 13.3299 1.75093C13.5755 1.91455 13.7672 2.14717 13.8808 2.4195L16.0633 7.6095L21.6358 8.09231C21.9301 8.11705 22.2106 8.22813 22.4421 8.41164C22.6736 8.59515 22.8457 8.84291 22.9369 9.12385C23.0281 9.4048 23.0343 9.70642 22.9548 9.99089C22.8753 10.2754 22.7135 10.53 22.4899 10.7229H22.4852Z"
                            fill="#FFA01E" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24"
                        fill="none">
                        <path
                            d="M22.4852 10.7229L18.2571 14.4129L19.5236 19.9067C19.5906 20.1939 19.5715 20.4945 19.4686 20.7709C19.3658 21.0472 19.1837 21.2872 18.9452 21.4606C18.7067 21.6341 18.4223 21.7334 18.1277 21.7462C17.8331 21.7589 17.5412 21.6845 17.2886 21.5323L12.4971 18.6261L7.7158 21.5323C7.46321 21.6845 7.17135 21.7589 6.87672 21.7462C6.58208 21.7334 6.29773 21.6341 6.05923 21.4606C5.82074 21.2872 5.63866 21.0472 5.53578 20.7709C5.4329 20.4945 5.41378 20.1939 5.4808 19.9067L6.74549 14.4186L2.51643 10.7229C2.29275 10.53 2.131 10.2754 2.05148 9.99089C1.97195 9.70642 1.97819 9.4048 2.0694 9.12385C2.16061 8.84291 2.33274 8.59515 2.5642 8.41164C2.79566 8.22813 3.07615 8.11705 3.37049 8.09231L8.94487 7.6095L11.1208 2.4195C11.2344 2.14717 11.4261 1.91455 11.6717 1.75093C11.9172 1.58731 12.2057 1.5 12.5008 1.5C12.7959 1.5 13.0844 1.58731 13.3299 1.75093C13.5755 1.91455 13.7672 2.14717 13.8808 2.4195L16.0633 7.6095L21.6358 8.09231C21.9301 8.11705 22.2106 8.22813 22.4421 8.41164C22.6736 8.59515 22.8457 8.84291 22.9369 9.12385C23.0281 9.4048 23.0343 9.70642 22.9548 9.99089C22.8753 10.2754 22.7135 10.53 22.4899 10.7229H22.4852Z"
                            fill="#FFA01E" />
                    </svg>
                </div>
                <div class="total-reviews-number">2488 Reviews</div>
            </div>
            <img class="home-testimonial-img" src="{{ asset('frontend/images/home-testimonial-img.png') }}"
                alt="" />
        </div>
        <div class="home-testimonial-slider">
            <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="home-testimonial-content">
                            <div class="section-sub-title-italic">Testimonial</div>
                            <div class="section-sub-title">
                                Here's What Our Clients Says about This Platform
                            </div>
                            <div class="section-text mt-3">
                                I found the perfect makeup artist for my wedding through this
                                platform! The entire process was smooth, and the artist was
                                professional and talented. I couldn't have asked for a better
                                experience!
                            </div>
                            <div class="home-testimonial-author">
                                <div class="author-img">
                                    <img src="{{ asset('frontend/images/home-testimonial-user.png') }}" alt="" />
                                </div>
                                <div>
                                    <div class="author-title">Leonel Mooney</div>
                                    <div class="author-stars">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24"
                                            viewBox="0 0 25 24" fill="none">
                                            <path
                                                d="M22.4852 10.7229L18.2571 14.4129L19.5236 19.9067C19.5906 20.1939 19.5715 20.4945 19.4686 20.7709C19.3658 21.0472 19.1837 21.2872 18.9452 21.4606C18.7067 21.6341 18.4223 21.7334 18.1277 21.7462C17.8331 21.7589 17.5412 21.6845 17.2886 21.5323L12.4971 18.6261L7.7158 21.5323C7.46321 21.6845 7.17135 21.7589 6.87672 21.7462C6.58208 21.7334 6.29773 21.6341 6.05923 21.4606C5.82074 21.2872 5.63866 21.0472 5.53578 20.7709C5.4329 20.4945 5.41378 20.1939 5.4808 19.9067L6.74549 14.4186L2.51643 10.7229C2.29275 10.53 2.131 10.2754 2.05148 9.99089C1.97195 9.70642 1.97819 9.4048 2.0694 9.12385C2.16061 8.84291 2.33274 8.59515 2.5642 8.41164C2.79566 8.22813 3.07615 8.11705 3.37049 8.09231L8.94487 7.6095L11.1208 2.4195C11.2344 2.14717 11.4261 1.91455 11.6717 1.75093C11.9172 1.58731 12.2057 1.5 12.5008 1.5C12.7959 1.5 13.0844 1.58731 13.3299 1.75093C13.5755 1.91455 13.7672 2.14717 13.8808 2.4195L16.0633 7.6095L21.6358 8.09231C21.9301 8.11705 22.2106 8.22813 22.4421 8.41164C22.6736 8.59515 22.8457 8.84291 22.9369 9.12385C23.0281 9.4048 23.0343 9.70642 22.9548 9.99089C22.8753 10.2754 22.7135 10.53 22.4899 10.7229H22.4852Z"
                                                fill="#FFA01E" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24"
                                            viewBox="0 0 25 24" fill="none">
                                            <path
                                                d="M22.4852 10.7229L18.2571 14.4129L19.5236 19.9067C19.5906 20.1939 19.5715 20.4945 19.4686 20.7709C19.3658 21.0472 19.1837 21.2872 18.9452 21.4606C18.7067 21.6341 18.4223 21.7334 18.1277 21.7462C17.8331 21.7589 17.5412 21.6845 17.2886 21.5323L12.4971 18.6261L7.7158 21.5323C7.46321 21.6845 7.17135 21.7589 6.87672 21.7462C6.58208 21.7334 6.29773 21.6341 6.05923 21.4606C5.82074 21.2872 5.63866 21.0472 5.53578 20.7709C5.4329 20.4945 5.41378 20.1939 5.4808 19.9067L6.74549 14.4186L2.51643 10.7229C2.29275 10.53 2.131 10.2754 2.05148 9.99089C1.97195 9.70642 1.97819 9.4048 2.0694 9.12385C2.16061 8.84291 2.33274 8.59515 2.5642 8.41164C2.79566 8.22813 3.07615 8.11705 3.37049 8.09231L8.94487 7.6095L11.1208 2.4195C11.2344 2.14717 11.4261 1.91455 11.6717 1.75093C11.9172 1.58731 12.2057 1.5 12.5008 1.5C12.7959 1.5 13.0844 1.58731 13.3299 1.75093C13.5755 1.91455 13.7672 2.14717 13.8808 2.4195L16.0633 7.6095L21.6358 8.09231C21.9301 8.11705 22.2106 8.22813 22.4421 8.41164C22.6736 8.59515 22.8457 8.84291 22.9369 9.12385C23.0281 9.4048 23.0343 9.70642 22.9548 9.99089C22.8753 10.2754 22.7135 10.53 22.4899 10.7229H22.4852Z"
                                                fill="#FFA01E" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24"
                                            viewBox="0 0 25 24" fill="none">
                                            <path
                                                d="M22.4852 10.7229L18.2571 14.4129L19.5236 19.9067C19.5906 20.1939 19.5715 20.4945 19.4686 20.7709C19.3658 21.0472 19.1837 21.2872 18.9452 21.4606C18.7067 21.6341 18.4223 21.7334 18.1277 21.7462C17.8331 21.7589 17.5412 21.6845 17.2886 21.5323L12.4971 18.6261L7.7158 21.5323C7.46321 21.6845 7.17135 21.7589 6.87672 21.7462C6.58208 21.7334 6.29773 21.6341 6.05923 21.4606C5.82074 21.2872 5.63866 21.0472 5.53578 20.7709C5.4329 20.4945 5.41378 20.1939 5.4808 19.9067L6.74549 14.4186L2.51643 10.7229C2.29275 10.53 2.131 10.2754 2.05148 9.99089C1.97195 9.70642 1.97819 9.4048 2.0694 9.12385C2.16061 8.84291 2.33274 8.59515 2.5642 8.41164C2.79566 8.22813 3.07615 8.11705 3.37049 8.09231L8.94487 7.6095L11.1208 2.4195C11.2344 2.14717 11.4261 1.91455 11.6717 1.75093C11.9172 1.58731 12.2057 1.5 12.5008 1.5C12.7959 1.5 13.0844 1.58731 13.3299 1.75093C13.5755 1.91455 13.7672 2.14717 13.8808 2.4195L16.0633 7.6095L21.6358 8.09231C21.9301 8.11705 22.2106 8.22813 22.4421 8.41164C22.6736 8.59515 22.8457 8.84291 22.9369 9.12385C23.0281 9.4048 23.0343 9.70642 22.9548 9.99089C22.8753 10.2754 22.7135 10.53 22.4899 10.7229H22.4852Z"
                                                fill="#FFA01E" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24"
                                            viewBox="0 0 25 24" fill="none">
                                            <path
                                                d="M22.4852 10.7229L18.2571 14.4129L19.5236 19.9067C19.5906 20.1939 19.5715 20.4945 19.4686 20.7709C19.3658 21.0472 19.1837 21.2872 18.9452 21.4606C18.7067 21.6341 18.4223 21.7334 18.1277 21.7462C17.8331 21.7589 17.5412 21.6845 17.2886 21.5323L12.4971 18.6261L7.7158 21.5323C7.46321 21.6845 7.17135 21.7589 6.87672 21.7462C6.58208 21.7334 6.29773 21.6341 6.05923 21.4606C5.82074 21.2872 5.63866 21.0472 5.53578 20.7709C5.4329 20.4945 5.41378 20.1939 5.4808 19.9067L6.74549 14.4186L2.51643 10.7229C2.29275 10.53 2.131 10.2754 2.05148 9.99089C1.97195 9.70642 1.97819 9.4048 2.0694 9.12385C2.16061 8.84291 2.33274 8.59515 2.5642 8.41164C2.79566 8.22813 3.07615 8.11705 3.37049 8.09231L8.94487 7.6095L11.1208 2.4195C11.2344 2.14717 11.4261 1.91455 11.6717 1.75093C11.9172 1.58731 12.2057 1.5 12.5008 1.5C12.7959 1.5 13.0844 1.58731 13.3299 1.75093C13.5755 1.91455 13.7672 2.14717 13.8808 2.4195L16.0633 7.6095L21.6358 8.09231C21.9301 8.11705 22.2106 8.22813 22.4421 8.41164C22.6736 8.59515 22.8457 8.84291 22.9369 9.12385C23.0281 9.4048 23.0343 9.70642 22.9548 9.99089C22.8753 10.2754 22.7135 10.53 22.4899 10.7229H22.4852Z"
                                                fill="#FFA01E" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24"
                                            viewBox="0 0 25 24" fill="none">
                                            <path
                                                d="M22.4852 10.7229L18.2571 14.4129L19.5236 19.9067C19.5906 20.1939 19.5715 20.4945 19.4686 20.7709C19.3658 21.0472 19.1837 21.2872 18.9452 21.4606C18.7067 21.6341 18.4223 21.7334 18.1277 21.7462C17.8331 21.7589 17.5412 21.6845 17.2886 21.5323L12.4971 18.6261L7.7158 21.5323C7.46321 21.6845 7.17135 21.7589 6.87672 21.7462C6.58208 21.7334 6.29773 21.6341 6.05923 21.4606C5.82074 21.2872 5.63866 21.0472 5.53578 20.7709C5.4329 20.4945 5.41378 20.1939 5.4808 19.9067L6.74549 14.4186L2.51643 10.7229C2.29275 10.53 2.131 10.2754 2.05148 9.99089C1.97195 9.70642 1.97819 9.4048 2.0694 9.12385C2.16061 8.84291 2.33274 8.59515 2.5642 8.41164C2.79566 8.22813 3.07615 8.11705 3.37049 8.09231L8.94487 7.6095L11.1208 2.4195C11.2344 2.14717 11.4261 1.91455 11.6717 1.75093C11.9172 1.58731 12.2057 1.5 12.5008 1.5C12.7959 1.5 13.0844 1.58731 13.3299 1.75093C13.5755 1.91455 13.7672 2.14717 13.8808 2.4195L16.0633 7.6095L21.6358 8.09231C21.9301 8.11705 22.2106 8.22813 22.4421 8.41164C22.6736 8.59515 22.8457 8.84291 22.9369 9.12385C23.0281 9.4048 23.0343 9.70642 22.9548 9.99089C22.8753 10.2754 22.7135 10.53 22.4899 10.7229H22.4852Z"
                                                fill="#FFA01E" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="home-testimonial-content">
                            <div class="section-sub-title-italic">Testimonial</div>
                            <div class="section-sub-title">
                                Here's What Our Clients Says about This Platform
                            </div>
                            <div class="section-text mt-3">
                                I found the perfect makeup artist for my wedding through this
                                platform! The entire process was smooth, and the artist was
                                professional and talented. I couldn't have asked for a better
                                experience!
                            </div>
                            <div class="home-testimonial-author">
                                <div class="author-img">
                                    <img src="{{ asset('frontend/images/home-testimonial-user.png') }}" alt="" />
                                </div>
                                <div>
                                    <div class="author-title">Leonel Mooney</div>
                                    <div class="author-stars">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24"
                                            viewBox="0 0 25 24" fill="none">
                                            <path
                                                d="M22.4852 10.7229L18.2571 14.4129L19.5236 19.9067C19.5906 20.1939 19.5715 20.4945 19.4686 20.7709C19.3658 21.0472 19.1837 21.2872 18.9452 21.4606C18.7067 21.6341 18.4223 21.7334 18.1277 21.7462C17.8331 21.7589 17.5412 21.6845 17.2886 21.5323L12.4971 18.6261L7.7158 21.5323C7.46321 21.6845 7.17135 21.7589 6.87672 21.7462C6.58208 21.7334 6.29773 21.6341 6.05923 21.4606C5.82074 21.2872 5.63866 21.0472 5.53578 20.7709C5.4329 20.4945 5.41378 20.1939 5.4808 19.9067L6.74549 14.4186L2.51643 10.7229C2.29275 10.53 2.131 10.2754 2.05148 9.99089C1.97195 9.70642 1.97819 9.4048 2.0694 9.12385C2.16061 8.84291 2.33274 8.59515 2.5642 8.41164C2.79566 8.22813 3.07615 8.11705 3.37049 8.09231L8.94487 7.6095L11.1208 2.4195C11.2344 2.14717 11.4261 1.91455 11.6717 1.75093C11.9172 1.58731 12.2057 1.5 12.5008 1.5C12.7959 1.5 13.0844 1.58731 13.3299 1.75093C13.5755 1.91455 13.7672 2.14717 13.8808 2.4195L16.0633 7.6095L21.6358 8.09231C21.9301 8.11705 22.2106 8.22813 22.4421 8.41164C22.6736 8.59515 22.8457 8.84291 22.9369 9.12385C23.0281 9.4048 23.0343 9.70642 22.9548 9.99089C22.8753 10.2754 22.7135 10.53 22.4899 10.7229H22.4852Z"
                                                fill="#FFA01E" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24"
                                            viewBox="0 0 25 24" fill="none">
                                            <path
                                                d="M22.4852 10.7229L18.2571 14.4129L19.5236 19.9067C19.5906 20.1939 19.5715 20.4945 19.4686 20.7709C19.3658 21.0472 19.1837 21.2872 18.9452 21.4606C18.7067 21.6341 18.4223 21.7334 18.1277 21.7462C17.8331 21.7589 17.5412 21.6845 17.2886 21.5323L12.4971 18.6261L7.7158 21.5323C7.46321 21.6845 7.17135 21.7589 6.87672 21.7462C6.58208 21.7334 6.29773 21.6341 6.05923 21.4606C5.82074 21.2872 5.63866 21.0472 5.53578 20.7709C5.4329 20.4945 5.41378 20.1939 5.4808 19.9067L6.74549 14.4186L2.51643 10.7229C2.29275 10.53 2.131 10.2754 2.05148 9.99089C1.97195 9.70642 1.97819 9.4048 2.0694 9.12385C2.16061 8.84291 2.33274 8.59515 2.5642 8.41164C2.79566 8.22813 3.07615 8.11705 3.37049 8.09231L8.94487 7.6095L11.1208 2.4195C11.2344 2.14717 11.4261 1.91455 11.6717 1.75093C11.9172 1.58731 12.2057 1.5 12.5008 1.5C12.7959 1.5 13.0844 1.58731 13.3299 1.75093C13.5755 1.91455 13.7672 2.14717 13.8808 2.4195L16.0633 7.6095L21.6358 8.09231C21.9301 8.11705 22.2106 8.22813 22.4421 8.41164C22.6736 8.59515 22.8457 8.84291 22.9369 9.12385C23.0281 9.4048 23.0343 9.70642 22.9548 9.99089C22.8753 10.2754 22.7135 10.53 22.4899 10.7229H22.4852Z"
                                                fill="#FFA01E" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24"
                                            viewBox="0 0 25 24" fill="none">
                                            <path
                                                d="M22.4852 10.7229L18.2571 14.4129L19.5236 19.9067C19.5906 20.1939 19.5715 20.4945 19.4686 20.7709C19.3658 21.0472 19.1837 21.2872 18.9452 21.4606C18.7067 21.6341 18.4223 21.7334 18.1277 21.7462C17.8331 21.7589 17.5412 21.6845 17.2886 21.5323L12.4971 18.6261L7.7158 21.5323C7.46321 21.6845 7.17135 21.7589 6.87672 21.7462C6.58208 21.7334 6.29773 21.6341 6.05923 21.4606C5.82074 21.2872 5.63866 21.0472 5.53578 20.7709C5.4329 20.4945 5.41378 20.1939 5.4808 19.9067L6.74549 14.4186L2.51643 10.7229C2.29275 10.53 2.131 10.2754 2.05148 9.99089C1.97195 9.70642 1.97819 9.4048 2.0694 9.12385C2.16061 8.84291 2.33274 8.59515 2.5642 8.41164C2.79566 8.22813 3.07615 8.11705 3.37049 8.09231L8.94487 7.6095L11.1208 2.4195C11.2344 2.14717 11.4261 1.91455 11.6717 1.75093C11.9172 1.58731 12.2057 1.5 12.5008 1.5C12.7959 1.5 13.0844 1.58731 13.3299 1.75093C13.5755 1.91455 13.7672 2.14717 13.8808 2.4195L16.0633 7.6095L21.6358 8.09231C21.9301 8.11705 22.2106 8.22813 22.4421 8.41164C22.6736 8.59515 22.8457 8.84291 22.9369 9.12385C23.0281 9.4048 23.0343 9.70642 22.9548 9.99089C22.8753 10.2754 22.7135 10.53 22.4899 10.7229H22.4852Z"
                                                fill="#FFA01E" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24"
                                            viewBox="0 0 25 24" fill="none">
                                            <path
                                                d="M22.4852 10.7229L18.2571 14.4129L19.5236 19.9067C19.5906 20.1939 19.5715 20.4945 19.4686 20.7709C19.3658 21.0472 19.1837 21.2872 18.9452 21.4606C18.7067 21.6341 18.4223 21.7334 18.1277 21.7462C17.8331 21.7589 17.5412 21.6845 17.2886 21.5323L12.4971 18.6261L7.7158 21.5323C7.46321 21.6845 7.17135 21.7589 6.87672 21.7462C6.58208 21.7334 6.29773 21.6341 6.05923 21.4606C5.82074 21.2872 5.63866 21.0472 5.53578 20.7709C5.4329 20.4945 5.41378 20.1939 5.4808 19.9067L6.74549 14.4186L2.51643 10.7229C2.29275 10.53 2.131 10.2754 2.05148 9.99089C1.97195 9.70642 1.97819 9.4048 2.0694 9.12385C2.16061 8.84291 2.33274 8.59515 2.5642 8.41164C2.79566 8.22813 3.07615 8.11705 3.37049 8.09231L8.94487 7.6095L11.1208 2.4195C11.2344 2.14717 11.4261 1.91455 11.6717 1.75093C11.9172 1.58731 12.2057 1.5 12.5008 1.5C12.7959 1.5 13.0844 1.58731 13.3299 1.75093C13.5755 1.91455 13.7672 2.14717 13.8808 2.4195L16.0633 7.6095L21.6358 8.09231C21.9301 8.11705 22.2106 8.22813 22.4421 8.41164C22.6736 8.59515 22.8457 8.84291 22.9369 9.12385C23.0281 9.4048 23.0343 9.70642 22.9548 9.99089C22.8753 10.2754 22.7135 10.53 22.4899 10.7229H22.4852Z"
                                                fill="#FFA01E" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24"
                                            viewBox="0 0 25 24" fill="none">
                                            <path
                                                d="M22.4852 10.7229L18.2571 14.4129L19.5236 19.9067C19.5906 20.1939 19.5715 20.4945 19.4686 20.7709C19.3658 21.0472 19.1837 21.2872 18.9452 21.4606C18.7067 21.6341 18.4223 21.7334 18.1277 21.7462C17.8331 21.7589 17.5412 21.6845 17.2886 21.5323L12.4971 18.6261L7.7158 21.5323C7.46321 21.6845 7.17135 21.7589 6.87672 21.7462C6.58208 21.7334 6.29773 21.6341 6.05923 21.4606C5.82074 21.2872 5.63866 21.0472 5.53578 20.7709C5.4329 20.4945 5.41378 20.1939 5.4808 19.9067L6.74549 14.4186L2.51643 10.7229C2.29275 10.53 2.131 10.2754 2.05148 9.99089C1.97195 9.70642 1.97819 9.4048 2.0694 9.12385C2.16061 8.84291 2.33274 8.59515 2.5642 8.41164C2.79566 8.22813 3.07615 8.11705 3.37049 8.09231L8.94487 7.6095L11.1208 2.4195C11.2344 2.14717 11.4261 1.91455 11.6717 1.75093C11.9172 1.58731 12.2057 1.5 12.5008 1.5C12.7959 1.5 13.0844 1.58731 13.3299 1.75093C13.5755 1.91455 13.7672 2.14717 13.8808 2.4195L16.0633 7.6095L21.6358 8.09231C21.9301 8.11705 22.2106 8.22813 22.4421 8.41164C22.6736 8.59515 22.8457 8.84291 22.9369 9.12385C23.0281 9.4048 23.0343 9.70642 22.9548 9.99089C22.8753 10.2754 22.7135 10.53 22.4899 10.7229H22.4852Z"
                                                fill="#FFA01E" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="home-testimonial-content">
                            <div class="section-sub-title-italic">Testimonial</div>
                            <div class="section-sub-title">
                                Here's What Our Clients Says about This Platform
                            </div>
                            <div class="section-text mt-3">
                                I found the perfect makeup artist for my wedding through this
                                platform! The entire process was smooth, and the artist was
                                professional and talented. I couldn't have asked for a better
                                experience!
                            </div>
                            <div class="home-testimonial-author">
                                <div class="author-img">
                                    <img src="{{ asset('frontend/images/home-testimonial-user.png') }}" alt="" />
                                </div>
                                <div>
                                    <div class="author-title">Leonel Mooney</div>
                                    <div class="author-stars">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24"
                                            viewBox="0 0 25 24" fill="none">
                                            <path
                                                d="M22.4852 10.7229L18.2571 14.4129L19.5236 19.9067C19.5906 20.1939 19.5715 20.4945 19.4686 20.7709C19.3658 21.0472 19.1837 21.2872 18.9452 21.4606C18.7067 21.6341 18.4223 21.7334 18.1277 21.7462C17.8331 21.7589 17.5412 21.6845 17.2886 21.5323L12.4971 18.6261L7.7158 21.5323C7.46321 21.6845 7.17135 21.7589 6.87672 21.7462C6.58208 21.7334 6.29773 21.6341 6.05923 21.4606C5.82074 21.2872 5.63866 21.0472 5.53578 20.7709C5.4329 20.4945 5.41378 20.1939 5.4808 19.9067L6.74549 14.4186L2.51643 10.7229C2.29275 10.53 2.131 10.2754 2.05148 9.99089C1.97195 9.70642 1.97819 9.4048 2.0694 9.12385C2.16061 8.84291 2.33274 8.59515 2.5642 8.41164C2.79566 8.22813 3.07615 8.11705 3.37049 8.09231L8.94487 7.6095L11.1208 2.4195C11.2344 2.14717 11.4261 1.91455 11.6717 1.75093C11.9172 1.58731 12.2057 1.5 12.5008 1.5C12.7959 1.5 13.0844 1.58731 13.3299 1.75093C13.5755 1.91455 13.7672 2.14717 13.8808 2.4195L16.0633 7.6095L21.6358 8.09231C21.9301 8.11705 22.2106 8.22813 22.4421 8.41164C22.6736 8.59515 22.8457 8.84291 22.9369 9.12385C23.0281 9.4048 23.0343 9.70642 22.9548 9.99089C22.8753 10.2754 22.7135 10.53 22.4899 10.7229H22.4852Z"
                                                fill="#FFA01E" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24"
                                            viewBox="0 0 25 24" fill="none">
                                            <path
                                                d="M22.4852 10.7229L18.2571 14.4129L19.5236 19.9067C19.5906 20.1939 19.5715 20.4945 19.4686 20.7709C19.3658 21.0472 19.1837 21.2872 18.9452 21.4606C18.7067 21.6341 18.4223 21.7334 18.1277 21.7462C17.8331 21.7589 17.5412 21.6845 17.2886 21.5323L12.4971 18.6261L7.7158 21.5323C7.46321 21.6845 7.17135 21.7589 6.87672 21.7462C6.58208 21.7334 6.29773 21.6341 6.05923 21.4606C5.82074 21.2872 5.63866 21.0472 5.53578 20.7709C5.4329 20.4945 5.41378 20.1939 5.4808 19.9067L6.74549 14.4186L2.51643 10.7229C2.29275 10.53 2.131 10.2754 2.05148 9.99089C1.97195 9.70642 1.97819 9.4048 2.0694 9.12385C2.16061 8.84291 2.33274 8.59515 2.5642 8.41164C2.79566 8.22813 3.07615 8.11705 3.37049 8.09231L8.94487 7.6095L11.1208 2.4195C11.2344 2.14717 11.4261 1.91455 11.6717 1.75093C11.9172 1.58731 12.2057 1.5 12.5008 1.5C12.7959 1.5 13.0844 1.58731 13.3299 1.75093C13.5755 1.91455 13.7672 2.14717 13.8808 2.4195L16.0633 7.6095L21.6358 8.09231C21.9301 8.11705 22.2106 8.22813 22.4421 8.41164C22.6736 8.59515 22.8457 8.84291 22.9369 9.12385C23.0281 9.4048 23.0343 9.70642 22.9548 9.99089C22.8753 10.2754 22.7135 10.53 22.4899 10.7229H22.4852Z"
                                                fill="#FFA01E" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24"
                                            viewBox="0 0 25 24" fill="none">
                                            <path
                                                d="M22.4852 10.7229L18.2571 14.4129L19.5236 19.9067C19.5906 20.1939 19.5715 20.4945 19.4686 20.7709C19.3658 21.0472 19.1837 21.2872 18.9452 21.4606C18.7067 21.6341 18.4223 21.7334 18.1277 21.7462C17.8331 21.7589 17.5412 21.6845 17.2886 21.5323L12.4971 18.6261L7.7158 21.5323C7.46321 21.6845 7.17135 21.7589 6.87672 21.7462C6.58208 21.7334 6.29773 21.6341 6.05923 21.4606C5.82074 21.2872 5.63866 21.0472 5.53578 20.7709C5.4329 20.4945 5.41378 20.1939 5.4808 19.9067L6.74549 14.4186L2.51643 10.7229C2.29275 10.53 2.131 10.2754 2.05148 9.99089C1.97195 9.70642 1.97819 9.4048 2.0694 9.12385C2.16061 8.84291 2.33274 8.59515 2.5642 8.41164C2.79566 8.22813 3.07615 8.11705 3.37049 8.09231L8.94487 7.6095L11.1208 2.4195C11.2344 2.14717 11.4261 1.91455 11.6717 1.75093C11.9172 1.58731 12.2057 1.5 12.5008 1.5C12.7959 1.5 13.0844 1.58731 13.3299 1.75093C13.5755 1.91455 13.7672 2.14717 13.8808 2.4195L16.0633 7.6095L21.6358 8.09231C21.9301 8.11705 22.2106 8.22813 22.4421 8.41164C22.6736 8.59515 22.8457 8.84291 22.9369 9.12385C23.0281 9.4048 23.0343 9.70642 22.9548 9.99089C22.8753 10.2754 22.7135 10.53 22.4899 10.7229H22.4852Z"
                                                fill="#FFA01E" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24"
                                            viewBox="0 0 25 24" fill="none">
                                            <path
                                                d="M22.4852 10.7229L18.2571 14.4129L19.5236 19.9067C19.5906 20.1939 19.5715 20.4945 19.4686 20.7709C19.3658 21.0472 19.1837 21.2872 18.9452 21.4606C18.7067 21.6341 18.4223 21.7334 18.1277 21.7462C17.8331 21.7589 17.5412 21.6845 17.2886 21.5323L12.4971 18.6261L7.7158 21.5323C7.46321 21.6845 7.17135 21.7589 6.87672 21.7462C6.58208 21.7334 6.29773 21.6341 6.05923 21.4606C5.82074 21.2872 5.63866 21.0472 5.53578 20.7709C5.4329 20.4945 5.41378 20.1939 5.4808 19.9067L6.74549 14.4186L2.51643 10.7229C2.29275 10.53 2.131 10.2754 2.05148 9.99089C1.97195 9.70642 1.97819 9.4048 2.0694 9.12385C2.16061 8.84291 2.33274 8.59515 2.5642 8.41164C2.79566 8.22813 3.07615 8.11705 3.37049 8.09231L8.94487 7.6095L11.1208 2.4195C11.2344 2.14717 11.4261 1.91455 11.6717 1.75093C11.9172 1.58731 12.2057 1.5 12.5008 1.5C12.7959 1.5 13.0844 1.58731 13.3299 1.75093C13.5755 1.91455 13.7672 2.14717 13.8808 2.4195L16.0633 7.6095L21.6358 8.09231C21.9301 8.11705 22.2106 8.22813 22.4421 8.41164C22.6736 8.59515 22.8457 8.84291 22.9369 9.12385C23.0281 9.4048 23.0343 9.70642 22.9548 9.99089C22.8753 10.2754 22.7135 10.53 22.4899 10.7229H22.4852Z"
                                                fill="#FFA01E" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24"
                                            viewBox="0 0 25 24" fill="none">
                                            <path
                                                d="M22.4852 10.7229L18.2571 14.4129L19.5236 19.9067C19.5906 20.1939 19.5715 20.4945 19.4686 20.7709C19.3658 21.0472 19.1837 21.2872 18.9452 21.4606C18.7067 21.6341 18.4223 21.7334 18.1277 21.7462C17.8331 21.7589 17.5412 21.6845 17.2886 21.5323L12.4971 18.6261L7.7158 21.5323C7.46321 21.6845 7.17135 21.7589 6.87672 21.7462C6.58208 21.7334 6.29773 21.6341 6.05923 21.4606C5.82074 21.2872 5.63866 21.0472 5.53578 20.7709C5.4329 20.4945 5.41378 20.1939 5.4808 19.9067L6.74549 14.4186L2.51643 10.7229C2.29275 10.53 2.131 10.2754 2.05148 9.99089C1.97195 9.70642 1.97819 9.4048 2.0694 9.12385C2.16061 8.84291 2.33274 8.59515 2.5642 8.41164C2.79566 8.22813 3.07615 8.11705 3.37049 8.09231L8.94487 7.6095L11.1208 2.4195C11.2344 2.14717 11.4261 1.91455 11.6717 1.75093C11.9172 1.58731 12.2057 1.5 12.5008 1.5C12.7959 1.5 13.0844 1.58731 13.3299 1.75093C13.5755 1.91455 13.7672 2.14717 13.8808 2.4195L16.0633 7.6095L21.6358 8.09231C21.9301 8.11705 22.2106 8.22813 22.4421 8.41164C22.6736 8.59515 22.8457 8.84291 22.9369 9.12385C23.0281 9.4048 23.0343 9.70642 22.9548 9.99089C22.8753 10.2754 22.7135 10.53 22.4899 10.7229H22.4852Z"
                                                fill="#FFA01E" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
    <!-- home testimonial section end -->

    <!-- home beauty experts start -->
    <div class="home-beauty-expert-container m-bottom">
        <div class="section-sub-title-italic text-center">Professionals</div>
        <div class="section-sub-title text-center">Top Rated Beauty Experts</div>
        <div class="home-beauty-experts">
            <div class="rk--hero--marquee">
                <div class="slide">
                    <!-- slider item  -->
                    <a href="./Service-provider-profile.html" class="slider--item">
                        <div class="img--area">
                            <img src="{{ asset('frontend/images/home-expert-1.png') }}" alt="maquee--img" />
                        </div>
                        <div class="home-expert-text-content">
                            <div class="title">Sofia Beauty Studio</div>
                            <div class="text">Bridal Makeup, Hairstyling</div>
                            <div class="home-expert-ratings-container">
                                <span class="home-expert-ratings">★★★★☆</span>
                                <span>(4.9)</span>
                            </div>
                        </div>
                    </a>
                    <a href="./Service-provider-profile.html" class="slider--item">
                        <div class="img--area">
                            <img src="{{ asset('frontend/images/home-expert-2.png') }}" alt="maquee--img" />
                        </div>
                        <div class="home-expert-text-content">
                            <div class="title">Sofia Beauty Studio</div>
                            <div class="text">Bridal Makeup, Hairstyling</div>
                            <div class="home-expert-ratings-container">
                                <span class="home-expert-ratings">★★★★☆</span>
                                <span>(4.9)</span>
                            </div>
                        </div>
                    </a>
                    <a href="./Service-provider-profile.html" class="slider--item">
                        <div class="img--area">
                            <img src="{{ asset('frontend/images/home-expert-3.png') }}" alt="maquee--img" />
                        </div>
                        <div class="home-expert-text-content">
                            <div class="title">Sofia Beauty Studio</div>
                            <div class="text">Bridal Makeup, Hairstyling</div>
                            <div class="home-expert-ratings-container">
                                <span class="home-expert-ratings">★★★★☆</span>
                                <span>(4.9)</span>
                            </div>
                        </div>
                    </a>
                    <a href="./Service-provider-profile.html" class="slider--item">
                        <div class="img--area">
                            <img src="{{ asset('frontend/images/home-expert-4.png') }}" alt="maquee--img" />
                        </div>
                        <div class="home-expert-text-content">
                            <div class="title">Sofia Beauty Studio</div>
                            <div class="text">Bridal Makeup, Hairstyling</div>
                            <div class="home-expert-ratings-container">
                                <span class="home-expert-ratings">★★★★☆</span>
                                <span>(4.9)</span>
                            </div>
                        </div>
                    </a>
                    <a href="./Service-provider-profile.html" class="slider--item">
                        <div class="img--area">
                            <img src="{{ asset('frontend/images/home-expert-5.png') }}" alt="maquee--img" />
                        </div>
                        <div class="home-expert-text-content">
                            <div class="title">Sofia Beauty Studio</div>
                            <div class="text">Bridal Makeup, Hairstyling</div>
                            <div class="home-expert-ratings-container">
                                <span class="home-expert-ratings">★★★★☆</span>
                                <span>(4.9)</span>
                            </div>
                        </div>
                    </a>
                    <a href="./Service-provider-profile.html" class="slider--item">
                        <div class="img--area">
                            <img src="{{ asset('frontend/images/home-expert-6.png') }}" alt="maquee--img" />
                        </div>
                        <div class="home-expert-text-content">
                            <div class="title">Sofia Beauty Studio</div>
                            <div class="text">Bridal Makeup, Hairstyling</div>
                            <div class="home-expert-ratings-container">
                                <span class="home-expert-ratings">★★★★☆</span>
                                <span class="text-end">(4.9)</span>
                            </div>
                        </div>
                    </a>
                    <a href="./Service-provider-profile.html" class="slider--item">
                        <div class="img--area">
                            <img src="{{ asset('frontend/images/home-expert-1.png') }}" alt="maquee--img" />
                        </div>
                        <div class="home-expert-text-content">
                            <div class="title">Sofia Beauty Studio</div>
                            <div class="text">Bridal Makeup, Hairstyling</div>
                            <div class="home-expert-ratings-container">
                                <span class="home-expert-ratings">★★★★☆</span>
                                <span>(4.9)</span>
                            </div>
                        </div>
                    </a>
                    <a href="./Service-provider-profile.html" class="slider--item">
                        <div class="img--area">
                            <img src="{{ asset('frontend/images/home-expert-2.png') }}" alt="maquee--img" />
                        </div>
                        <div class="home-expert-text-content">
                            <div class="title">Sofia Beauty Studio</div>
                            <div class="text">Bridal Makeup, Hairstyling</div>
                            <div class="home-expert-ratings-container">
                                <span class="home-expert-ratings">★★★★☆</span>
                                <span>(4.9)</span>
                            </div>
                        </div>
                    </a>
                    <a href="./Service-provider-profile.html" class="slider--item">
                        <div class="img--area">
                            <img src="{{ asset('frontend/images/home-expert-3.png') }}" alt="maquee--img" />
                        </div>
                        <div class="home-expert-text-content">
                            <div class="title">Sofia Beauty Studio</div>
                            <div class="text">Bridal Makeup, Hairstyling</div>
                            <div class="home-expert-ratings-container">
                                <span class="home-expert-ratings">★★★★☆</span>
                                <span>(4.9)</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- home beauty experts end -->

    <!-- home find experts near you start -->
    <div class="section-padding-x m-bottom ">
        <div class="section-sub-title-italic text-center">Covered Areas</div>
        <div class="section-sub-title text-center">
            Find Beauty Experts Near You
        </div>
        <div class="home-find-experts">
            <div class="left">
                <div class="dual-y-grid">
                    <div style="
                background-image: url('{{ asset('frontend/images/find-beauty-expert-1.png') }}');
              "
                        class="item">
                        <div class="badge">25+ Experts</div>
                        <div class="overlay">
                            <div class="city-name">Sydney</div>
                            <div class="subtext">Suburb Coverage: 50+ Locations</div>
                        </div>
                    </div>
                    <div style="
                background-image: url('{{ asset('frontend/images/find-beauty-expert-4.png') }}');
              "
                        class="item">
                        <div class="badge">300+ Experts</div>
                        <div class="overlay">
                            <div class="city-name">Melbourne</div>
                            <div class="subtext">Suburb Coverage: 50+ Locations</div>
                        </div>
                    </div>
                </div>
                <div class="single-y-grid">
                    <div style="
                background-image: url('{{ asset('frontend/images/find-beauty-expert-2.png') }}');
              "
                        class="item">
                        <div class="badge">400+ Experts</div>
                        <div class="overlay">
                            <div class="city-name">Brisbane</div>
                            <div class="subtext">Suburb Coverage: 50+ Locations</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right">
                <div class="single-x-grid">
                    <div style="
                background-image: url('{{ asset('frontend/images/find-beauty-expert-3.png') }}');
              "
                        class="item">
                        <div class="badge">200+ Experts</div>
                        <div class="overlay">
                            <div class="city-name">Brisbane</div>
                            <div class="subtext">Suburb Coverage: 50+ Locations</div>
                        </div>
                    </div>
                </div>
                <div class="dual-x-grid">
                    <div style="
                background-image: url('{{ asset('frontend/images/find-beauty-expert-5.png') }}');
              "
                        class="item">
                        <div class="badge">25+ Experts</div>
                        <div class="overlay">
                            <div class="city-name">Sydney</div>
                            <div class="subtext">Suburb Coverage: 50+ Locations</div>
                        </div>
                    </div>
                    <div style="
                background-image: url('{{ asset('frontend/images/find-beauty-expert-6.png') }}');
              "
                        class="item">
                        <div class="badge">250+ Experts</div>
                        <div class="overlay">
                            <div class="city-name">Perth</div>
                            <div class="subtext">Suburb Coverage: 50+ Locations</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- home find experts near you end -->

    {{-- Join us card start --}}
    <section class="join-us-section">
        <div class="join-us-section-content">
            <h3>Join Us</h3>
            <h2>Discover Beauty Services</h2>
            <p>
                Step into a world of top-rated beauty professionals ready to cater to
                your unique needs. Whether you're looking for a new look or routine
                care, our platform connects you with the best beauty experts in your
                area. Explore a variety of services and easily book appointments that
                fit your schedule.
            </p>
            <a href="{{ route('join') }}" class="common-btn">Sign Up Now</a>
        </div>
    </section>
    {{-- Join us card end --}}
@endsection
