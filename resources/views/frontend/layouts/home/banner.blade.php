<div class="home-banner">
    <div class="text-content">
        <div data-aos="fade-right" data-aos-delay="100" class="italic-text">Find The</div>
        <div data-aos="fade-right" data-aos-delay="200" class="section-title">
            BEST Beauty <br />
            Professionals
        </div>
        <div data-aos="fade-right" data-aos-delay="300" class="section-text mt-4">
            {!! $systemSetting->description ??
                "we connect you with the best beauty professionals in your area. Whether you're getting ready for a special occasion or just treating yourself, our expert providers ensure a top-tier experience every time." !!}
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

        {{-- search container start --}}
        @include('frontend.layouts.home.search-container')
        {{-- search container end --}}
    </div>

    <div data-aos="fade-left" class="img-slider">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                @foreach ($homeBanners as $index => $banner)
                    <button type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}"
                        aria-current="{{ $index === 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}">
                    </button>
                @endforeach
            </div>

            <div class="carousel-inner">
                @if ($homeBanners->isNotEmpty())
                    @foreach ($homeBanners as $index => $homeBanner)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <img src="{{ asset($homeBanner->image ?? 'frontend/images/home-banner.png') }}"
                                alt="Beauty services banner {{ $index + 1 }}"
                                loading="{{ $index === 0 ? 'eager' : 'lazy' }}" decoding="async" width="1200"
                                height="600" class="d-block w-100" style="object-fit: cover;" />
                        </div>
                    @endforeach
                @else
                    <div class="carousel-item active">
                        <img src="{{ asset('frontend/images/home-banner.png') }}"
                            alt="Find the best beauty professionals" loading="eager" decoding="async" width="1200"
                            height="600" class="d-block w-100" style="object-fit: cover;" />
                    </div>
                @endif
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
