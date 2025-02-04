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
