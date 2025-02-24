@extends('frontend.app')

@section('title', 'Available Beauty Services')

@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/css/plugins/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/plugins/fontawesome.min.css') }}">

    {{-- All custom CSS Links --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/helper.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/tarek.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/categories.css') }}" />

    <style>
        .services-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .services-list li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }
    </style>
@endpush

@section('content')
    <main>
        {{-- categories second section start --}}
        <section class="padding-top-from-header">
            <div class="categories-tax-service-section">
                <div class="section-padding-x">
                    @php
                        $heading = !empty($selectedServiceNames)
                            ? implode(', ', $selectedServiceNames)
                            : 'All Services';
                    @endphp

                    <h2>Browse “{{ $heading }}”</h2>
                    <p class="categori-heading-para">
                        Showing {{ $approvedServices->count() }} Results for <a href="#">Personal Tax Preparation
                            Preparation</a>
                    </p>

                    <form method="GET" action="{{ route('available-services', ['serviceId' => $serviceId]) }}">
                        <input type="hidden" name="service_ids"
                            value="{{ isset($serviceIds) ? implode(',', (array) $serviceIds) : '' }}">

                        <div class="explore-card-filter-wrapper">
                            <div class="rating-filter">
                                <select name="rating" onchange="this.form.submit()">
                                    <option value="">Select Rating</option>
                                    <option value="1" {{ request('rating') == '1' ? 'selected' : '' }}>5 Star</option>
                                    <option value="2" {{ request('rating') == '2' ? 'selected' : '' }}>4 Star</option>
                                    <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>3 Star</option>
                                    <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>2 Star</option>
                                    <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>1 Star</option>
                                    <option value="6" {{ request('rating') == '6' ? 'selected' : '' }}>0 Star</option>
                                </select>
                            </div>
                            <div class="price-filter">
                                <select name="price_range" onchange="this.form.submit()">
                                    <option value="">Select Price</option>
                                    <option value="10-100" {{ request('price_range') == '10-100' ? 'selected' : '' }}>
                                        10$-100$</option>
                                    <option value="101-200" {{ request('price_range') == '101-200' ? 'selected' : '' }}>
                                        101$-200$</option>
                                    <option value="500-1000" {{ request('price_range') == '500-1000' ? 'selected' : '' }}>
                                        500$-1000$</option>
                                    <option value="1000+" {{ request('price_range') == '1000+' ? 'selected' : '' }}>1000$+
                                    </option>
                                </select>
                            </div>
                        </div>
                    </form>


                    {{-- Loop through active services --}}
                    @php
                        $groupedServices = $approvedServices->groupBy('user_id');
                    @endphp

                    <div class="categories-tax-card-wrapper">
                        @foreach ($groupedServices as $userId => $userServices)
                            @php
                                $user = $userServices->first()->user;
                                $avgRating = $userServices->avg('average_rating');
                                $totalReviews = $userServices->count()
                                    ? $userServices->sum('review_count') / $userServices->count()
                                    : 0;
                            @endphp

                            <div class="explore-tax-single-card">
                                <div class="explore-card-img-are"
                                    style="background-image: url('{{ $userServices->first()->image ? asset($userServices->first()->image) : asset('frontend/images/default.png') }}')">
                                </div>

                                <div class="explore-card-content">
                                    <h4 class="expert-name">
                                        {{ $user->first_name ?? '' }} {{ $user->last_name ?? '' }}
                                    </h4>

                                    <div class="explore-rating-area">
                                        <div class="stars-rating">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= floor($avgRating))
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                        viewBox="0 0 24 24" fill="#FBB040">
                                                        <path
                                                            d="M12 2l2.39 6.85h7.21l-5.69 4.14 2.39 6.85-5.69-4.14-5.69 4.14 2.39-6.85-5.69-4.14h7.21z" />
                                                    </svg>
                                                @elseif($i == ceil($avgRating) && fmod($avgRating, 1) != 0)
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                        viewBox="0 0 24 24">
                                                        <defs>
                                                            <linearGradient id="half-star-{{ $userId }}">
                                                                <stop offset="50%" stop-color="#FBB040" />
                                                                <stop offset="50%" stop-color="#BABABA" />
                                                            </linearGradient>
                                                        </defs>
                                                        <path fill="url(#half-star-{{ $userId }})"
                                                            d="M12 2l2.39 6.85h7.21l-5.69 4.14 2.39 6.85-5.69-4.14-5.69 4.14 2.39-6.85-5.69-4.14h7.21z" />
                                                    </svg>
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                        viewBox="0 0 24 24" fill="#BABABA">
                                                        <path
                                                            d="M12 2l2.39 6.85h7.21l-5.69 4.14 2.39 6.85-5.69-4.14-5.69 4.14 2.39-6.85-5.69-4.14h7.21z" />
                                                    </svg>
                                                @endif
                                            @endfor
                                        </div>
                                        <div class="rating-text">
                                            <span>{{ number_format($avgRating, 1) ?? 0 }}</span>
                                            <span>({{ $totalReviews ?? 0 }})</span>
                                        </div>
                                    </div>

                                    <div class="explore-card-heading-para">
                                        <strong>Services Offered:</strong>
                                    </div>

                                    <div>
                                        <ul class="services-list">
                                            @foreach ($userServices as $service)
                                                <li>
                                                    <span
                                                        class="service-name">{{ $service->service->services_name ?? '' }}</span>
                                                    <span class="service-price">
                                                        {{ $service->total_price ?? 0 }}$</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <div class="explore-card-heading-para">
                                        <div class="check-availability-bookmarks">
                                            <a
                                                href="{{ route('service-provider-profile', ['userId' => $user->id, 'serviceId' => $userServices->first()->service->id ?? $userServices->first()->service_id]) }}?service_ids={{ request('service_ids') }}">
                                                Check Availability
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
@endpush
