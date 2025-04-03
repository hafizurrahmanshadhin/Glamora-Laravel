@extends('frontend.app')

@section('title', 'FAQ')

@push('styles')
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

        <div class="header-profile-container" style="display:none;"></div>
        <div class="tm-profiledropdown" style="display:none;"></div>

        @include('frontend.partials.join-us')
    </main>
@endsection

@push('scripts')
    <script>
        // Convert the Blade $faqs collection to JSON
        let bladeFaqs = @json($faqs);

        // If your FAQ model has an 'updated_at' column, get the max updated time
        // Otherwise, you can use something like Date.now() to track local changes
        let lastUpdatedBlade = "{{ $faqs->max('updated_at') }}"; // or just Date.now()

        document.addEventListener('DOMContentLoaded', () => {
            // 1) Check existing local storage
            let storedFaqData = localStorage.getItem('faqData');
            let storedTimestamp = localStorage.getItem('faqLastUpdated');

            // 2) Decide whether to use local storage data or Blade data
            if (!storedFaqData || storedTimestamp !== lastUpdatedBlade) {
                // Store fresh data in local storage
                localStorage.setItem('faqData', JSON.stringify(bladeFaqs));
                localStorage.setItem('faqLastUpdated', lastUpdatedBlade);
            } else {
                // If stored data matches the server’s last updated, use local storage
                bladeFaqs = JSON.parse(storedFaqData);

                // Re-render the FAQ HTML from local storage
                const accordionContainer = document.getElementById('faqAccordion');
                if (accordionContainer && bladeFaqs.length) {
                    accordionContainer.innerHTML = '';
                    bladeFaqs.forEach((faq, index) => {
                        accordionContainer.innerHTML += `
                        <div class="accordion__item">
                            <div class="accordion__header" data-toggle="#or-faq${index}">
                                <div class="square"></div>
                                <h2 class="accordion-header-title">${faq.question ?? ''}</h2>
                            </div>
                            <div class="accordion__content" id="or-faq${index}">
                                <p>${faq.answer ?? ''}</p>
                            </div>
                        </div>
                    `;
                    });
                }
            }

            // Handle the existing accordion toggling logic
            const togglers = document.querySelectorAll('[data-toggle]');
            togglers.forEach((btn) => {
                btn.addEventListener('click', (e) => {
                    e.stopImmediatePropagation();

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
                }, true);
            });
        });
    </script>
@endpush
