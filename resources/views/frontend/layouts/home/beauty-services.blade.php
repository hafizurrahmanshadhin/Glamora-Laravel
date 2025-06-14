<div class="home-beauty-services m-bottom">
    <div data-aos="fade-right" data-aos-delay="100" class="section-sub-title-italic text-center">
        Services
    </div>
    <div data-aos="fade-left" data-aos-delay="200" class="section-sub-title text-center">
        Available Beauty Services
    </div>

    <div class="slider">
        @foreach ($approvedServices as $index => $userService)
            <div class="item">
                <div class="img-content">
                    <img src="{{ $userService->image ? asset($userService->image) : asset('frontend/images/default.png') }}"
                        alt="{{ $userService->service->services_name ?? 'Beauty Service' }}"
                        loading="{{ $index < 4 ? 'eager' : 'lazy' }}" decoding="async" width="300" height="200"
                        style="object-fit: cover; border-radius: 8px;" />
                </div>
                <div class="text-content">
                    <div class="left">
                        <div class="title">{{ $userService->service->services_name ?? 'Service' }}</div>
                        <div class="text">{{ $userService->styler_count ?? 0 }}+ Stylers Available</div>
                    </div>

                    <a href="{{ route('available-services', ['serviceId' => $userService->service_id]) }}"
                        class="right action"
                        aria-label="View {{ $userService->service->services_name ?? 'service' }} details"
                        title="Browse available stylers for {{ $userService->service->services_name ?? 'this service' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="14" viewBox="0 0 18 14"
                            fill="none" aria-hidden="true">
                            <path d="M16.5 7L1.5 7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M10.4492 0.975414L16.4992 6.99941L10.4492 13.0244" stroke="currentColor"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
