@extends('frontend.app')

@section('title', 'Terms and Conditions')

@section('content')
    <main>
        {{-- categories second section start --}}
        <section class="padding-top-from-header">
            <div class="categories-tax-service-section">
                <div class="section-padding-x">
                    <h1 style="padding-top: 150px">{{ $terms_and_conditions->title ?? 'Terms and Conditions' }}</h1>
                    <div class="content" style="padding-bottom: 50px;">
                        {!! $terms_and_conditions->content ?? '<p>No terms and conditions available.</p>' !!}
                    </div>
                </div>
            </div>
        </section>
        {{-- categories second section end --}}

        {{-- Join us card start --}}
        <section class="join-us-section">
            <div class="join-us-section-content">
                <h3>Join Us</h3>
                <h2>Discover Beauty Services</h2>
                <p>
                    Step into a world of top-rated beauty professionals ready
                    to cater to your unique needs. Whether you're looking
                    for a new look or routine care, our platform connects
                    you with the best beauty experts in your area. Explore a
                    variety of services and easily book appointments that
                    fit your schedule.
                </p>
                <a href="{{ route('join') }}" class="common-btn">Sign Up Now</a>
            </div>
        </section>
        {{-- Join us card end --}}
    </main>
@endsection
