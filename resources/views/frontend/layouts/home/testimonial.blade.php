<div class="home-testimonial section-padding-x m-bottom ">
    <img class="home-testimonial-shape" src="{{ asset('frontend/images/home-testimonial-shape.png') }}"
        alt="Testimonial background shape" loading="lazy" decoding="async" width="300" height="200" />

    <div class="img-content">
        <div class="total-reviews">
            <div class="total-reviews-count">{{ number_format($averageRating, 1) }}</div>
            <div class="total-reviews-stars">
                @php
                    $roundedRating = round($averageRating);
                @endphp
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $roundedRating)
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24"
                            fill="none">
                            <path
                                d="M22.4852 10.7229L18.2571 14.4129L19.5236 19.9067C19.5906 20.1939 19.5715 20.4945 19.4686 20.7709C19.3658 21.0472 19.1837 21.2872 18.9452 21.4606C18.7067 21.6341 18.4223 21.7334 18.1277 21.7462C17.8331 21.7589 17.5412 21.6845 17.2886 21.5323L12.4971 18.6261L7.7158 21.5323C7.46321 21.6845 7.17135 21.7589 6.87672 21.7462C6.58208 21.7334 6.29773 21.6341 6.05923 21.4606C5.82074 21.2872 5.63866 21.0472 5.53578 20.7709C5.4329 20.4945 5.41378 20.1939 5.4808 19.9067L6.74549 14.4186L2.51643 10.7229C2.29275 10.53 2.131 10.2754 2.05148 9.99089C1.97195 9.70642 1.97819 9.4048 2.0694 9.12385C2.16061 8.84291 2.33274 8.59515 2.5642 8.41164C2.79566 8.22813 3.07615 8.11705 3.37049 8.09231L8.94487 7.6095L11.1208 2.4195C11.2344 2.14717 11.4261 1.91455 11.6717 1.75093C11.9172 1.58731 12.2057 1.5 12.5008 1.5C12.7959 1.5 13.0844 1.58731 13.3299 1.75093C13.5755 1.91455 13.7672 2.14717 13.8808 2.4195L16.0633 7.6095L21.6358 8.09231C21.9301 8.11705 22.2106 8.22813 22.4421 8.41164C22.6736 8.59515 22.8457 8.84291 22.9369 9.12385C23.0281 9.4048 23.0343 9.70642 22.9548 9.99089C22.8753 10.2754 22.7135 10.53 22.4899 10.7229H22.4852Z"
                                fill="#FFA01E" />
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24"
                            fill="none">
                            <defs>
                                <linearGradient id="halfStarGradient" x1="0" x2="1" y1="0"
                                    y2="0">
                                    <stop offset="50%" stop-color="#FFA01E" />
                                    <stop offset="50%" stop-color="transparent" />
                                </linearGradient>
                            </defs>
                            <path fill="url(#halfStarGradient)"
                                d="M22.4852 10.7229L18.2571 14.4129L19.5236 19.9067C19.5906 20.1939 19.5715 20.4945 19.4686 20.7709C19.3658 21.0472 19.1837 21.2872 18.9452 21.4606C18.7067 21.6341 18.4223 21.7334 18.1277 21.7462C17.8331 21.7589 17.5412 21.6845 17.2886 21.5323L12.4971 18.6261L7.7158 21.5323C7.46321 21.6845 7.17135 21.7589 6.87672 21.7462C6.58208 21.7334 6.29773 21.6341 6.05923 21.4606C5.82074 21.2872 5.63866 21.0472 5.53578 20.7709C5.4329 20.4945 5.41378 20.1939 5.4808 19.9067L6.74549 14.4186L2.51643 10.7229C2.29275 10.53 2.131 10.2754 2.05148 9.99089C1.97195 9.70642 1.97819 9.4048 2.0694 9.12385C2.16061 8.84291 2.33274 8.59515 2.5642 8.41164C2.79566 8.22813 3.07615 8.11705 3.37049 8.09231L8.94487 7.6095L11.1208 2.4195C11.2344 2.14717 11.4261 1.91455 11.6717 1.75093C11.9172 1.58731 12.2057 1.5 12.5008 1.5C12.7959 1.5 13.0844 1.58731 13.3299 1.75093C13.5755 1.91455 13.7672 2.14717 13.8808 2.4195L16.0633 7.6095L21.6358 8.09231C21.9301 8.11705 22.2106 8.22813 22.4421 8.41164C22.6736 8.59515 22.8457 8.84291 22.9369 9.12385C23.0281 9.4048 23.0343 9.70642 22.9548 9.99089C22.8753 10.2754 22.7135 10.53 22.4899 10.7229H22.4852Z" />
                        </svg>
                    @endif
                @endfor
            </div>
            <div class="total-reviews-number">{{ $totalReviews }} Reviews</div>
        </div>

        {{-- Main testimonial image with optimization --}}
        <img class="home-testimonial-img"
            src="{{ asset($testimonialImage->image ?? 'frontend/images/home-testimonial-img.png') }}"
            alt="Customer testimonials showcase" loading="eager" decoding="async" width="400" height="300"
            style="object-fit: cover;" />
    </div>

    <div class="home-testimonial-slider">
        <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($reviews as $key => $review)
                    <div class="carousel-item @if ($key === 0) active @endif">
                        <div class="home-testimonial-content">
                            <div class="section-sub-title-italic">Testimonial</div>
                            <div class="section-sub-title">Here's What Our Clients Says about This Platform</div>
                            <div class="section-text mt-3">
                                {{ $review->review ?? '' }}
                            </div>
                            <div class="home-testimonial-author">
                                <div class="author-img">
                                    {{-- User avatar with optimization --}}
                                    <img src="{{ asset($review->user->avatar ?? 'backend/images/default_images/user_1.jpg') }}"
                                        alt="{{ ($review->user->first_name ?? '') . ' ' . ($review->user->last_name ?? '') ?: 'Customer' }}"
                                        loading="{{ $key === 0 ? 'eager' : 'lazy' }}" decoding="async" width="60"
                                        height="60" style="object-fit: cover; border-radius: 50%;" />
                                </div>
                                <div>
                                    <div class="author-title">
                                        {{ ($review->user->first_name ?? '') . ' ' . ($review->user->last_name ?? '') ?: 'Anonymous Customer' }}
                                    </div>
                                    <div class="author-stars">
                                        @for ($i = 0; $i < min($review->rating, 5); $i++)
                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24"
                                                viewBox="0 0 25 24" fill="none">
                                                <path
                                                    d="M22.4852 10.7229L18.2571 14.4129L19.5236 19.9067C19.5906 20.1939 19.5715 20.4945 19.4686 20.7709C19.3658 21.0472 19.1837 21.2872 18.9452 21.4606C18.7067 21.6341 18.4223 21.7334 18.1277 21.7462C17.8331 21.7589 17.5412 21.6845 17.2886 21.5323L12.4971 18.6261L7.7158 21.5323C7.46321 21.6845 7.17135 21.7589 6.87672 21.7462C6.58208 21.7334 6.29773 21.6341 6.05923 21.4606C5.82074 21.2872 5.63866 21.0472 5.53578 20.7709C5.4329 20.4945 5.41378 20.1939 5.4808 19.9067L6.74549 14.4186L2.51643 10.7229C2.29275 10.53 2.131 10.2754 2.05148 9.99089C1.97195 9.70642 1.97819 9.4048 2.0694 9.12385C2.16061 8.84291 2.33274 8.59515 2.5642 8.41164C2.79566 8.22813 3.07615 8.11705 3.37049 8.09231L8.94487 7.6095L11.1208 2.4195C11.2344 2.14717 11.4261 1.91455 11.6717 1.75093C11.9172 1.58731 12.2057 1.5 12.5008 1.5C12.7959 1.5 13.0844 1.58731 13.3299 1.75093C13.5755 1.91455 13.7672 2.14717 13.8808 2.4195L16.0633 7.6095L21.6358 8.09231C21.9301 8.11705 22.2106 8.22813 22.4421 8.41164C22.6736 8.59515 22.8457 8.84291 22.9369 9.12385C23.0281 9.4048 23.0343 9.70642 22.9548 9.99089C22.8753 10.2754 22.7135 10.53 22.4899 10.7229H22.4852Z"
                                                    fill="#FFA01E" />
                                            </svg>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</div>
