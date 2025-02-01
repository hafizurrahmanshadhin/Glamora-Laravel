@extends('frontend.app')

@section('title', 'Terms and Conditions')

@section('content')
    <main>
        {{-- categories second section start --}}
        <section class="padding-top-from-header">
            <div class="categories-tax-service-section">
                <div class="section-padding-x">
                    <h1 style="padding-top: 25px">{{ $terms_and_conditions->title ?? 'Terms and Conditions' }}</h1>
                    <div class="content" style="padding-bottom: 50px;">
                        {!! $terms_and_conditions->content ?? '<p>No terms and conditions available.</p>' !!}
                    </div>
                </div>
            </div>
        </section>
        {{-- categories second section end --}}

        @include('frontend.partials.join-us')
    </main>

    @include('frontend.partials.footer')
@endsection
