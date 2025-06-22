<div class="home-counter m-top m-bottom">
    <div class="home-counter-border">
        <svg width="2" viewBox="0 0 2 250" fill="none" xmlns="http://www.w3.org/2000/svg">
            <line x1="1" y1="2.18557e-08" x2="0.999989" y2="250" stroke="url(#paint0_linear_11537_2016)" />
            <defs>
                <linearGradient id="paint0_linear_11537_2016" x1="0" y1="-2.18557e-08" x2="-1.09278e-05"
                    y2="250" gradientUnits="userSpaceOnUse">
                    <stop />
                    <stop offset="1" stop-color="white" />
                </linearGradient>
            </defs>
        </svg>
    </div>
    @foreach ($homeCounters as $counter)
        <div class="item">
            <div class="text">
                {{ $counter->title }}
            </div>
            {{-- <div data-target="20" class="title">20k+</div> --}}
            <div data-target="{{ preg_replace('/\D/', '', $counter->sub_title) }}" class="title">
                {{ $counter->sub_title }}
            </div>
        </div>

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
    @endforeach
</div>


<div class="home-italic-text-container m-bottom">
    <div data-aos="fade-up" data-aos-delay="100" class="text">
        {!! $homePageBanner->description ?? '' !!}
    </div>
</div>
