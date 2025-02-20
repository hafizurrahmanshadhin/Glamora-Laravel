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
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/faq.css') }}" />
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

        {{-- Dummy elements to satisfy main.js (if needed) --}}
        <div class="header-profile-container" style="display:none;"></div>
        <div class="tm-profiledropdown" style="display:none;"></div>

        @include('frontend.partials.join-us')
    </main>
@endsection

@push('scripts')
    <script>
        // Override FAQ accordion click handling by using a capturing listener
        document.addEventListener('DOMContentLoaded', () => {
            const togglers = document.querySelectorAll('[data-toggle]');
            togglers.forEach((btn) => {
                btn.addEventListener('click', (e) => {
                    // Stop other click handlers (like those in main.js) from executing
                    e.stopImmediatePropagation();

                    // Close all other accordions first (optional behavior)
                    togglers.forEach((otherBtn) => {
                        if (otherBtn !== e.currentTarget && otherBtn.classList.contains(
                                'active')) {
                            const block = document.querySelector(otherBtn.dataset.toggle);
                            if (block) {
                                block.style.maxHeight = '0px';
                            }
                            otherBtn.classList.remove('active');
                        }
                    });

                    // Toggle the clicked accordion item
                    const selector = e.currentTarget.dataset.toggle;
                    const block = document.querySelector(selector);
                    if (block) {
                        if (block.style.maxHeight && block.style.maxHeight !== '0px') {
                            block.style.maxHeight = '0px';
                        } else {
                            block.style.maxHeight = block.scrollHeight + 'px';
                        }
                    }
                    e.currentTarget.classList.toggle('active');
                }, true); // Use capture phase to override main.js
            });
        });
    </script>
@endpush
