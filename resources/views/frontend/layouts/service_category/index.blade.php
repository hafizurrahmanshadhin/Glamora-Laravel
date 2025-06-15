@extends('frontend.app')

@section('title', 'Service Category')

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/helper.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/tarek.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/categories.css') }}" />
@endpush

@section('content')
    <main>
        {{-- service category banner section start --}}
        <section class="service-category-banner-section">
            <div class="service-banner-content-wrapper">
                <h1>Explore Our Categories of Expert <span>Beauty Services</span> </h1>
                <p>
                    {!! $systemSetting->description ??
                        "Find the perfect beauty professional for your unique needs. Whether you're looking for a stunning new hairstyle, flawless makeup for a special event, or a refreshing spa experience, we have an expert ready to help you shine." !!}
                </p>

                {{-- search container start --}}
                @include('frontend.layouts.home.search-container')
                {{-- search container end --}}
            </div>
        </section>
        {{-- service category banner section end --}}

        {{-- service category start --}}
        <div class="categories-tax-service-section">
            <div class="section-padding-x">
                <div class="categories-tax-card-wrapper">
                    @foreach ($services as $service)
                        <div class="categories-tax-single-card">
                            <div class="catagories-tax-card-hover d-none"></div>
                            <h3>{{ $service->services_name ?? '' }}</h3>
                            <a href="{{ route('available-services', ['serviceId' => $service->id]) }}">Explore
                                <img src="{{ asset('frontend/images/arrow-right.svg') }}" alt>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        {{-- service category end --}}

        @include('frontend.partials.join-us')
    </main>
@endsection
