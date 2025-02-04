@extends('frontend.app')

@section('title', 'Glamora')

@section('content')
    @include('frontend.layouts.home.banner')
    @include('frontend.layouts.home.counter-and-italic-text')
    @include('frontend.layouts.home.beauty-services')
    @include('frontend.layouts.home.user-type-container')
    @include('frontend.layouts.home.testimonial')
    @include('frontend.layouts.home.top-rated-beauty-experts')
    {{-- @include('frontend.layouts.home.find-experts-near-you') --}}
    @include('frontend.partials.join-us')
@endsection
