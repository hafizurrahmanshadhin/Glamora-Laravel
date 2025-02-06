@extends('frontend.app')

@section('title', 'Available Beauty Services')

@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/css/plugins/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/plugins/fontawesome.min.css') }}">

    {{-- All custom CSS Links --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/helper.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/tarek.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/categories.css') }}" />
@endpush

@section('content')
    <main>
        {{-- categories second section start --}}
        <section class="padding-top-from-header">
            <div class="categories-tax-service-section">
                <div class="section-padding-x">
                    <h2>Browse “{{ $approvedServices[0]->service->services_name ?? '' }}”</h2>
                    <p class="categori-heading-para">
                        Showing {{ $approvedServices->count() }} Results for <a href="#">Personal Tax Preparation
                            Preparation</a>
                    </p>
                    <form method="GET" action="{{ route('available-services', ['serviceId' => $serviceId]) }}">
                        <div class="explore-card-filter-wrapper">
                            <div class="rating-filter">
                                <select name="rating" onchange="this.form.submit()">
                                    <option value="">Select Rating</option>
                                    <option value="1" {{ request('rating') == '1' ? 'selected' : '' }}>5 Star</option>
                                    <option value="2" {{ request('rating') == '2' ? 'selected' : '' }}>4 Star</option>
                                    <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>3 Star</option>
                                    <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>2 Star</option>
                                    <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>1 Star</option>
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
                    <div class="categories-tax-card-wrapper">
                        @foreach ($approvedServices as $userService)
                            <div class="explore-tax-single-card">
                                <div style="background-image: url('{{ $userService->image ? asset($userService->image) : asset('frontend/images/default.png') }}')"
                                    class="explore-card-img-are">
                                </div>
                                <div class="explore-rating-area">
                                    <p class="explore-ratings-star-count">
                                        <span>
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= floor($userService->average_rating))
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                        viewBox="0 0 24 24" fill="#FBB040">
                                                        <path
                                                            d="M12 2l2.39 6.85h7.21l-5.69 4.14 2.39 6.85-5.69-4.14-5.69 4.14 2.39-6.85-5.69-4.14h7.21z" />
                                                    </svg>
                                                @elseif($i == ceil($userService->average_rating) && fmod($userService->average_rating, 1) != 0)
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                        viewBox="0 0 24 24">
                                                        <defs>
                                                            <linearGradient id="half-star">
                                                                <stop offset="50%" stop-color="#FBB040" />
                                                                <stop offset="50%" stop-color="#BABABA" />
                                                            </linearGradient>
                                                        </defs>
                                                        <path fill="url(#half-star)"
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
                                        </span>
                                        <span class="explore-rating-count">
                                            {{ $userService->average_rating ?? 0 }}
                                            <span>({{ $userService->review_count ?? 0 }})</span>
                                        </span>
                                    </p>

                                    <h5 class="tm-price">
                                        {{ $userService->total_price ?? 0 }}$
                                    </h5>
                                </div>
                                <div class="explore-card-heading-para">
                                    <h4>
                                        {{ $userService->user->first_name ?? '' }}
                                        {{ $userService->user->last_name ?? '' }}
                                    </h4>
                                    <div class="check-availability-bookmarks">
                                        <a
                                            href="{{ route('service-provider-profile', ['userId' => $userService->user_id, 'serviceId' => $serviceId]) }}">
                                            Check Availability
                                        </a>
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
