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
                        Showing 12 Results for <a href="#">Personal Tax Preparation Preparation</a>
                    </p>
                    <div class="explore-card-filter-wrapper">
                        <div class="rating-filter">
                            <select>
                                <option data-display="Select">Select
                                    Rating</option>
                                <option value="1">5 Star</option>
                                <option value="2">4 Star</option>
                                <option value="3">3 Star</option>
                                <option value="4">2 Star</option>
                                <option value="5">1 Star</option>
                            </select>
                        </div>
                        <div class="price-filter">
                            <select>
                                <option data-display="Select">Select
                                    Price</option>
                                <option value>10$-100$</option>
                                <option value>101$-200$</option>
                                <option value>500$-100$</option>
                                <option value>1000$+</option>
                            </select>
                        </div>
                    </div>

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
                                            <svg xmlns="http://www.w3.org/2000/svg" width="68" height="12"
                                                viewBox="0 0 68 12" fill="none">
                                                <path
                                                    d="M6 3.11392e-08L7.34708 4.1459L11.7063 4.1459L8.17963 6.7082L9.52671 10.8541L6 8.2918L2.47329 10.8541L3.82037 6.7082L0.293661 4.1459L4.65292 4.1459L6 3.11392e-08Z"
                                                    fill="#FBB040" />
                                                <path
                                                    d="M20 3.11392e-08L21.3471 4.1459L25.7063 4.1459L22.1796 6.7082L23.5267 10.8541L20 8.2918L16.4733 10.8541L17.8204 6.7082L14.2937 4.1459L18.6529 4.1459L20 3.11392e-08Z"
                                                    fill="#FBB040" />
                                                <path
                                                    d="M34 3.11392e-08L35.3471 4.1459L39.7063 4.1459L36.1796 6.7082L37.5267 10.8541L34 8.2918L30.4733 10.8541L31.8204 6.7082L28.2937 4.1459L32.6529 4.1459L34 3.11392e-08Z"
                                                    fill="#FBB040" />
                                                <path
                                                    d="M48 3.11392e-08L49.3471 4.1459L53.7063 4.1459L50.1796 6.7082L51.5267 10.8541L48 8.2918L44.4733 10.8541L45.8204 6.7082L42.2937 4.1459L46.6529 4.1459L48 3.11392e-08Z"
                                                    fill="#FBB040" />
                                                <path
                                                    d="M62 3.11392e-08L63.3471 4.1459L67.7063 4.1459L64.1796 6.7082L65.5267 10.8541L62 8.2918L58.4733 10.8541L59.8204 6.7082L56.2937 4.1459L60.6529 4.1459L62 3.11392e-08Z"
                                                    fill="#BABABA" />
                                            </svg>
                                        </span>
                                        <span class="explore-rating-count">
                                            4.5 <span>(210)</span>
                                        </span>
                                    </p>
                                    <h5 class="tm-price">
                                        {{ $userService->total_price ?? 0 }}$
                                    </h5>
                                </div>
                                <div class="explore-card-heading-para">
                                    <h4>
                                        {{ $userService->user->first_name ?? '' }} {{ $userService->user->last_name ?? '' }}
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
