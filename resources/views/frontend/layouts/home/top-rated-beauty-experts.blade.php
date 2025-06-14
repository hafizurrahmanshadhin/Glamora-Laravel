<div class="home-beauty-expert-container m-bottom">
    <div class="section-sub-title-italic text-center">Professionals</div>
    <div class="section-sub-title text-center">Top Rated Beauty Experts</div>
    <div class="home-beauty-experts">
        <div class="rk--hero--marquee">
            <div class="slide">
                @foreach ($topBeautyExperts as $index => $expert)
                    <a href="#" class="slider--item">
                        <div class="img--area">
                            <img src="{{ asset($expert->businessInformation->avatar ?? 'backend/images/default_images/user_1.jpg') }}"
                                alt="{{ $expert->businessInformation->name ?? 'Beauty Expert' }}"
                                loading="{{ $index < 3 ? 'eager' : 'lazy' }}" decoding="async" width="200"
                                height="200" style="object-fit: cover; border-radius: 50%;" />
                        </div>

                        <div class="home-expert-text-content">
                            <div style="text-wrap: wrap !important;" class="title">
                                {{ $expert->businessInformation->name ?? '' }}</div>
                            <div class="text">
                                {{ $expert->businessInformation->professional_title ?? '' }}
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
