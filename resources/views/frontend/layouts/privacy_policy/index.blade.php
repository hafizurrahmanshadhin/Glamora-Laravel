@extends('frontend.app')

@section('title', 'Privacy Policy')

@section('content')
    <main>
        {{-- categories second section start --}}
        <section class="padding-top-from-header">
            <div class="categories-tax-service-section">
                <div class="section-padding-x">
                    <h1 style="padding-top: 150px">{{ $privacyPolicy->title ?? 'Privacy Policy' }}</h1>
                    <div class="content" style="padding-bottom: 50px;">
                        {!! $privacyPolicy->content ?? '<p>No Privacy Policy Available.</p>' !!}
                    </div>
                </div>
            </div>
        </section>
        {{-- categories second section end --}}

        @include('frontend.partials.join-us')
    </main>
@endsection
