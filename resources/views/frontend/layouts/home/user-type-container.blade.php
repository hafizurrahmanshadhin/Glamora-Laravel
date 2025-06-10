<div class="section-padding-x home-user-type m-bottom ">
    @foreach ($serviceTypes as $index => $serviceType)
        <div style="
              background: linear-gradient(
                  180deg,
                  rgba(255, 255, 255, 0) 16%,
                  rgba(255, 255, 255, 0.6) 100%
                ),
                url('{{ asset($serviceType->image ?? 'frontend/images/default.png') }}')
            "
            class="item">
            <div class="text-content">
                <div class="title">{{ $serviceType->title ?? '' }}</div>
                <div class="text mt-3">
                    {!! $serviceType->description ?? '' !!}
                </div>
                <div class="mt-4">
                    @if ($index === 0)
                        <a href="{{ route('register', ['role' => 'beauty_expert']) }}" class="common-btn">
                            Join
                        </a>
                    @else
                        <a href="{{ route('service-category') }}" class="common-btn">
                            Search
                        </a>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
