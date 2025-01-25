@extends('frontend.app')

@section('title', 'FAQ')

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/plugins/owl.theme.default.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/plugins/magnific-popup.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('frontend/css/plugins/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/plugins/fontawesome.min.css') }}">

    {{-- All custom CSS Links --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/helper.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/tarek.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/categories.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/faq.css') }}">
@endpush

@section('content')
    <main>
        {{-- faq section start --}}
        <section class="or-faq-container padding-top-from-header">
            <div class="or-faq-title">
                <h1 class="faq-header">Frequently Asked Questions</h1>
                <p class="para">
                    Grow your practice, reach new clients, and manage your business efficiently with our
                    flexible subscription plans.
                </p>
            </div>

            <div class="or-faq-accordion">
                <div class="accordion">
                    @foreach ($faqs as $index => $faq)
                        <div class="accordion__item">
                            <div class="accordion__header" data-toggle="#or-faq{{ $index }}">
                                <div class="square"></div>
                                <h2 class="accordion-header-title">{{ $faq->question ?? '' }}</h2>
                            </div>
                            <div class="accordion__content" id="or-faq{{ $index }}">
                                <p>{{ $faq->answer ?? '' }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        {{-- faq section end --}}

        @include('frontend.partials.join-us')
    </main>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const togglers = document.querySelectorAll('[data-toggle]');

            togglers.forEach((btn) => {
                btn.addEventListener('click', (e) => {
                    // Close all other accordions first
                    togglers.forEach((otherBtn) => {
                        if (otherBtn !== e.currentTarget && otherBtn.classList.contains(
                                'active')) {
                            const block = document.querySelector(
                                `${otherBtn.dataset.toggle}`);
                            block.style.maxHeight = '';
                            otherBtn.classList.remove('active');
                        }
                    });

                    // Now, toggle the current clicked accordion
                    const selector = e.currentTarget.dataset.toggle;
                    const block = document.querySelector(`${selector}`);

                    if (e.currentTarget.classList.contains('active')) {
                        block.style.maxHeight = '';
                    } else {
                        block.style.maxHeight = block.scrollHeight + 'px';
                    }

                    e.currentTarget.classList.toggle('active');
                });
            });
        });
    </script>
@endpush
