<style>
    /* Beauty Services Section */
    .home-beauty-services {
        padding: 60px 0;
    }

    .home-beauty-services .slider {
        display: flex;
        gap: 20px;
        overflow-x: auto;
        scroll-behavior: smooth;
        padding: 20px 0;
        margin-top: 40px;
    }

    /* Hide scrollbar but keep functionality */
    .home-beauty-services .slider::-webkit-scrollbar {
        display: none;
    }

    .home-beauty-services .slider {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    /* Card Item */
    .home-beauty-services .item {
        min-width: 350px;
        max-width: 350px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        flex-shrink: 0;
    }

    .home-beauty-services .item:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
    }

    /* Image Content */
    .home-beauty-services .img-content {
        width: 100%;
        height: 200px;
        overflow: hidden;
        position: relative;
    }

    .home-beauty-services .img-content img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .home-beauty-services .item:hover .img-content img {
        transform: scale(1.05);
    }

    /* Text Content */
    .home-beauty-services .text-content {
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        min-height: 80px;
        flex: 1;
    }

    .home-beauty-services .text-content .left {
        flex: 1;
        min-width: 0;
        /* Important for text truncation */
    }

    .home-beauty-services .text-content .title {
        font-size: 18px;
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
        line-height: 1.3;
        /* Ensure title doesn't wrap */
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .home-beauty-services .text-content .text {
        font-size: 14px;
        color: #666;
        font-weight: 400;
        white-space: nowrap;
    }

    /* Action Button */
    .home-beauty-services .right.action {
        margin-left: 15px;
        padding: 12px;
        background: #f8f9fa;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        color: #333;
        text-decoration: none;
        flex-shrink: 0;
        width: 44px;
        height: 44px;
    }

    .home-beauty-services .right.action:hover {
        background: #007bff;
        color: #fff;
        transform: translateX(3px);
    }

    .home-beauty-services .right.action svg {
        transition: transform 0.3s ease;
    }

    .home-beauty-services .right.action:hover svg {
        transform: translateX(2px);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .home-beauty-services .item {
            min-width: 280px;
            max-width: 280px;
        }

        .home-beauty-services .text-content {
            padding: 15px;
        }

        .home-beauty-services .text-content .title {
            font-size: 16px;
        }

        .home-beauty-services .text-content .text {
            font-size: 13px;
        }
    }

    @media (max-width: 480px) {
        .home-beauty-services .item {
            min-width: 260px;
            max-width: 260px;
        }

        .home-beauty-services .slider {
            gap: 15px;
            padding: 15px 0;
        }
    }

    /* If you want to add navigation arrows */
    .slider-container {
        position: relative;
    }

    .slider-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255, 255, 255, 0.9);
        border: none;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 10;
    }

    .slider-nav:hover {
        background: #007bff;
        color: white;
    }

    .slider-nav.prev {
        left: -25px;
    }

    .slider-nav.next {
        right: -25px;
    }
</style>

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
