<section class="join-us-section">
    <div class="join-us-section-content">
        <h3>Join Us</h3>
        <h2>{{ $joinUs->title ?? '' }}</h2>
        <p style="margin-top: -30px;">{!! $joinUs->description ?? '' !!}</p>
        <a href="{{ route('join') }}" class="common-btn">Sign Up Now</a>
    </div>
</section>
