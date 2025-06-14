<div class="section-padding-x home-user-type m-bottom ">
    @foreach ($serviceTypes as $index => $serviceType)
        {{-- Preload critical images --}}
        @if ($index < 2)
            <link rel="preload" as="image" href="{{ asset($serviceType->image ?? 'frontend/images/default.png') }}">
        @endif

        <div style="
              background: linear-gradient(
                  180deg,
                  rgba(255, 255, 255, 0) 16%,
                  rgba(255, 255, 255, 0.6) 100%
                ),
                url('{{ asset($serviceType->image ?? 'frontend/images/default.png') }}');
              background-size: cover;
              background-position: center;
              background-repeat: no-repeat;
            "
            class="item" role="article" aria-label="{{ $serviceType->title ?? 'Service Type' }}">

            {{-- Hidden image for SEO and accessibility --}}
            <img src="{{ asset($serviceType->image ?? 'frontend/images/default.png') }}"
                alt="{{ $serviceType->title ?? 'Service Type' }}" loading="{{ $index < 2 ? 'eager' : 'lazy' }}"
                decoding="async" width="600" height="400"
                style="position: absolute; opacity: 0; pointer-events: none;" />

            <div class="text-content">
                <div class="title">{{ $serviceType->title ?? 'Service Title' }}</div>
                <div class="text mt-3">
                    {!! $serviceType->description ?? '' !!}
                </div>
                <div class="mt-4">
                    @if ($index === 0)
                        <a href="{{ route('register', ['role' => 'beauty_expert']) }}" class="common-btn"
                            aria-label="Join as Beauty Expert">
                            Join
                        </a>
                    @else
                        <a href="{{ route('service-category') }}" class="common-btn" aria-label="Search Services">
                            Search
                        </a>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
