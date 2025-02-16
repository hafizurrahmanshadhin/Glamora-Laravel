@extends('frontend.app')

@section('title', $pageData ? $pageData->page_title : '')

@section('content')
    <main>
        {{-- categories second section start --}}
        <section class="padding-top-from-header">
            <div class="categories-tax-service-section">
                <div class="section-padding-x">
                    <h1 style="padding-top: 125px">{{ $pageData ? $pageData->page_title : '' }}</h1>
                    <div class="content" style="padding-bottom: 50px;">
                        {!! $pageData ? $pageData->page_content : '' !!}
                    </div>
                </div>
            </div>
        </section>
        {{-- categories second section end --}}

        @include('frontend.partials.join-us')
    </main>

    @include('frontend.partials.footer')
@endsection
