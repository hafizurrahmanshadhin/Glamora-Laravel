@php
    $systemSetting = App\Models\SystemSetting::first();
    $social_links = App\Models\SocialMedia::all();
    $dynamicPages = App\Models\DynamicPage::where('status', 'active')->whereNull('deleted_at')->get();
@endphp

<footer class="">
    <div class="footer-container">
        <div class="footer-col footer-first-col">
            <a href="{{ route('index') }}" class="logo">
                <img src="{{ asset($systemSetting->logo ?? 'frontend/logo_black.png') }}" alt=""
                    style="width: 194px; height: 42px;">
            </a>
            <h3>Join our newsletter</h3>
            <p>Stay updated with the latest tax tips and platform updates</p>
            <div class="footer-search-box">
                <input type="email" id="newsletter-email" placeholder="Email address" />
                <button class="footer-btn" id="newsletter-submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="10" viewBox="0 0 20 10"
                        fill="none">
                        <path d="M15 1L19 5M19 5L15 9M19 5H1" stroke="#3F3F46" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
            <div id="newsletter-message"></div>
        </div>

        <div class="footer-col">
            <h4>Quick Links</h4>
            <ul>
                <li><a href="{{ route('index') }}">Home</a></li>
                <li><a href="{{ route('contact') }}">Contact Us</a></li>
                <li><a href="{{ route('faq') }}">FAQs</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h4>Resources</h4>
            <ul>
                <li><a style="white-space: nowrap" href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
                <li><a style="white-space: nowrap" href="{{ route('terms-and-conditions') }}">Terms and Conditions</a>
                </li>
                <li>
                    @foreach ($dynamicPages as $page)
                        <a style="white-space: nowrap"
                            href="{{ route('custom.page', $page->page_slug) }}">{{ $page->page_title ?? '' }}</a>
                    @endforeach
                </li>
            </ul>
        </div>

        <div class="footer-col footer-fourth-col">
            <h4>Contact Information</h4>
            <p>Email: {{ $systemSetting->email ?? '' }}</p>
            <p>Phone: {{ $systemSetting->phone_number ?? '' }}</p>
            <p>Address: {{ $systemSetting->address ?? '' }}</p>

            <div class="footer-social-icon">
                @foreach ($social_links as $index => $item)
                    <a href="{{ $item->profile_link }}" target="_blank">
                        @switch($item->social_media)
                            @case('facebook')
                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17"
                                    fill="none">
                                    <path
                                        d="M8.58699 2.04492C4.88437 2.04492 1.88281 5.04648 1.88281 8.74909C1.88281 12.0953 4.33443 14.8689 7.53947 15.3718V10.687H5.83722V8.74909H7.53947V7.27208C7.53947 5.59185 8.54033 4.66374 10.0717 4.66374C10.8052 4.66374 11.5724 4.79468 11.5724 4.79468V6.44453H10.727C9.89424 6.44453 9.63452 6.96132 9.63452 7.49152V8.74909H11.4939L11.1967 10.687H9.63452V15.3718C12.8395 14.8689 15.2912 12.0953 15.2912 8.74909C15.2912 5.04648 12.2896 2.04492 8.58699 2.04492Z"
                                        fill="#222222" />
                                </svg>
                            @break

                            @case('twitter')
                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17"
                                    fill="none">
                                    <g clip-path="url(#clip0_11965_364)">
                                        <path
                                            d="M5.56792 2.04492H0.875L6.41322 9.42923L1.17665 15.4532H2.95328L7.23612 10.5264L10.9313 15.4533H15.6242L9.85302 7.75842L14.8197 2.04492H13.0431L9.03015 6.66127L5.56792 2.04492ZM11.6017 14.1124L3.55667 3.38576H4.8975L12.9425 14.1124H11.6017Z"
                                            fill="#222222" />
                                    </g>
                                    <defs>
                                        <clippath id="clip0_11965_364">
                                            <rect width="16.09" height="16.09" fill="white"
                                                transform="translate(0.203125 0.704102)" />
                                        </clippath>
                                    </defs>
                                </svg>
                            @break

                            @case('instagram')
                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17"
                                    fill="none">
                                    <path
                                        d="M8.75496 6.73784C7.64381 6.73784 6.7437 7.63828 6.7437 8.74909C6.7437 9.86017 7.64415 10.7603 8.75496 10.7603C9.86605 10.7603 10.7662 9.8599 10.7662 8.74909C10.7662 7.63801 9.86578 6.73784 8.75496 6.73784ZM8.75496 5.39701C10.6056 5.39701 12.107 6.8968 12.107 8.74909C12.107 10.5998 10.6073 12.1012 8.75496 12.1012C6.90428 12.1012 5.40287 10.6014 5.40287 8.74909C5.40287 6.89843 6.90266 5.39701 8.75496 5.39701ZM13.1127 5.22883C13.1127 5.69149 12.7367 6.06687 12.2747 6.06687C11.812 6.06687 11.4366 5.69092 11.4366 5.22883C11.4366 4.76675 11.8125 4.39138 12.2747 4.39138C12.7361 4.3908 13.1127 4.76675 13.1127 5.22883ZM8.75496 3.38576C7.09602 3.38576 6.82562 3.39015 6.05403 3.42451C5.52835 3.44918 5.17596 3.51989 4.84855 3.647C4.55759 3.75984 4.3477 3.89459 4.12407 4.11822C3.89958 4.34271 3.76508 4.55203 3.65269 4.84313C3.52528 5.17129 3.4546 5.52312 3.43037 6.04808C3.39567 6.78826 3.39161 7.04694 3.39161 8.74909C3.39161 10.408 3.39601 10.6784 3.43036 11.4499C3.45505 11.9754 3.52585 12.3283 3.65265 12.6549C3.76579 12.9463 3.90081 13.1567 4.12336 13.3793C4.34874 13.6043 4.55868 13.7393 4.84702 13.8506C5.17842 13.9787 5.53058 14.0495 6.05393 14.0737C6.79411 14.1083 7.0528 14.1124 8.75496 14.1124C10.4139 14.1124 10.6843 14.108 11.4558 14.0737C11.9801 14.0491 12.3333 13.9781 12.6608 13.8514C12.9514 13.7385 13.1624 13.603 13.3851 13.3807C13.6105 13.1549 13.7452 12.9455 13.8566 12.6565C13.9844 12.3263 14.0553 11.9737 14.0795 11.4501C14.1142 10.7099 14.1183 10.4512 14.1183 8.74909C14.1183 7.09016 14.1139 6.81977 14.0795 6.04823C14.0549 5.52376 13.9839 5.17006 13.857 4.84269C13.7445 4.55254 13.6093 4.342 13.3858 4.11822C13.1609 3.89336 12.9522 3.75913 12.6609 3.64683C12.333 3.51953 11.9806 3.44875 11.4559 3.42451C10.7158 3.38981 10.4571 3.38576 8.75496 3.38576ZM8.75496 2.04492C10.5762 2.04492 10.8036 2.05163 11.5188 2.08515C12.2321 2.11811 12.7188 2.23096 13.1462 2.39689C13.5881 2.56729 13.9613 2.79746 14.3339 3.1701C14.706 3.54275 14.9362 3.91706 15.1072 4.35786C15.2725 4.78469 15.3854 5.27186 15.4189 5.9853C15.4508 6.70041 15.4591 6.92779 15.4591 8.74909C15.4591 10.5704 15.4524 10.7978 15.4189 11.5129C15.3859 12.2263 15.2725 12.7129 15.1072 13.1403C14.9367 13.5823 14.706 13.9554 14.3339 14.3281C13.9613 14.7002 13.5864 14.9303 13.1462 15.1013C12.7188 15.2667 12.2321 15.3795 11.5188 15.413C10.8036 15.4449 10.5762 15.4533 8.75496 15.4533C6.93365 15.4533 6.70626 15.4466 5.99116 15.413C5.27772 15.3801 4.79167 15.2667 4.36372 15.1013C3.92236 14.9309 3.5486 14.7002 3.17596 14.3281C2.80332 13.9554 2.57371 13.5806 2.40275 13.1403C2.23682 12.7129 2.12453 12.2263 2.09101 11.5129C2.05916 10.7978 2.05078 10.5704 2.05078 8.74909C2.05078 6.92779 2.05749 6.70041 2.09101 5.9853C2.12396 5.2713 2.23682 4.78525 2.40275 4.35786C2.57314 3.9165 2.80332 3.54275 3.17596 3.1701C3.5486 2.79746 3.92292 2.56785 4.36372 2.39689C4.79111 2.23096 5.27716 2.11867 5.99116 2.08515C6.70626 2.0533 6.93365 2.04492 8.75496 2.04492Z"
                                        fill="#222222" />
                                </svg>
                            @break

                            @case('linkedin')
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22"
                                    fill="none">
                                    <path
                                        d="M8.98453 6.52019C8.98453 7.14672 8.44147 7.65463 7.77156 7.65463C7.10166 7.65463 6.55859 7.14672 6.55859 6.52019C6.55859 5.89365 7.10166 5.38574 7.77156 5.38574C8.44147 5.38574 8.98453 5.89365 8.98453 6.52019Z"
                                        fill="#222222" />
                                    <path d="M6.72447 8.4885H8.79792V14.7716H6.72447V8.4885Z" fill="#222222" />
                                    <path
                                        d="M12.1362 8.4885H10.0627V14.7716H12.1362C12.1362 14.7716 12.1362 12.7936 12.1362 11.5568C12.1362 10.8145 12.3896 10.069 13.401 10.069C14.5439 10.069 14.5371 11.0404 14.5317 11.793C14.5248 12.7767 14.5414 13.7806 14.5414 14.7716H16.6148V11.4555C16.5973 9.3381 16.0455 8.36245 14.2304 8.36245C13.1524 8.36245 12.4842 8.85184 12.1362 9.2946V8.4885Z"
                                        fill="#222222" />
                                </svg>
                            @break

                            @default
                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17"
                                    fill="none">
                                    <path
                                        d="M12.9493 9.08943H3.56349V13.7823H12.9493V9.08943ZM12.9493 7.7486C12.9493 5.15677 10.8482 3.05568 8.25641 3.05568C5.66458 3.05568 3.56349 5.15677 3.56349 7.7486H12.9493ZM4.49021 3.03429C5.52244 2.20859 6.83177 1.71484 8.25641 1.71484C9.68104 1.71484 10.9904 2.20859 12.0226 3.03429L12.997 2.05992L13.9451 3.00803L12.9707 3.9824C13.7964 5.01463 14.2902 6.32395 14.2902 7.7486V14.4528C14.2902 14.823 13.99 15.1232 13.6197 15.1232H2.89307C2.52282 15.1232 2.22266 14.823 2.22266 14.4528V7.7486C2.22266 6.32395 2.7164 5.01463 3.5421 3.9824L2.56773 3.00803L3.51584 2.05992L4.49021 3.03429ZM6.24516 6.40776C5.8749 6.40776 5.57474 6.1076 5.57474 5.73735C5.57474 5.36709 5.8749 5.06693 6.24516 5.06693C6.61542 5.06693 6.91557 5.36709 6.91557 5.73735C6.91557 6.1076 6.61542 6.40776 6.24516 6.40776ZM10.2677 6.40776C9.89739 6.40776 9.59724 6.1076 9.59724 5.73735C9.59724 5.36709 9.89739 5.06693 10.2677 5.06693C10.6379 5.06693 10.9381 5.36709 10.9381 5.73735C10.9381 6.1076 10.6379 6.40776 10.2677 6.40776Z"
                                        fill="#222222" />
                                </svg>
                        @endswitch
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p>{{ $systemSetting->copyright_text ?? '' }}</p>
    </div>
</footer>


<script>
    document.getElementById('newsletter-submit').addEventListener('click', function(e) {
        e.preventDefault();

        let emailInput = document.getElementById('newsletter-email');
        let email = emailInput.value;

        // Post the email using Axios
        axios.post("{{ route('newsletter-subscription.store') }}", {
                email: email
            })
            .then(function(response) {
                // Display success toaster message
                toastr.success(response.data.message);
                emailInput.value = '';
            })
            .catch(function(error) {
                if (error.response && error.response.data.errors) {
                    let errors = error.response.data.errors;
                    let errorMessage = errors.email ? errors.email[0] : 'An error occurred.';
                    // Display error toaster message
                    toastr.error(errorMessage);
                } else {
                    toastr.error('An error occurred.');
                }
            });
    });
</script>
