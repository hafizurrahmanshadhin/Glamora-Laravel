@extends('frontend.app')

@section('title', 'Inclusions & Cancellation Policy')

@section('content')
    <main>
        {{-- categories second section start --}}
        <section class="padding-top-from-header">
            <div class="categories-tax-service-section">
                <div class="section-padding-x">
                    <h1 style="padding-top: 25px">{{ $inclusionsCancellation->title ?? 'Inclusions Cancellation' }}</h1>
                    <div class="content" style="padding-bottom: 50px;">
                        {!! $inclusionsCancellation->content ?? '<p>No Inclusions Cancellation Available.</p>' !!}
                    </div>
                </div>
            </div>
        </section>
        {{-- categories second section end --}}

        @include('frontend.partials.join-us')
    </main>

    @include('frontend.partials.footer')
@endsection
