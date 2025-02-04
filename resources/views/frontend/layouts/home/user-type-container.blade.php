<div class="section-padding-x home-user-type m-bottom ">
    <div style="
      background: linear-gradient(
          180deg,
          rgba(255, 255, 255, 0) 16%,
          rgba(255, 255, 255, 0.6) 100%
        ),
        url('{{ asset('frontend/images/home-user-type-1.png') }}')
    "
        class="item">
        <div class="text-content">
            <div class="title">I'm a Beauty Professional</div>
            <div class="text mt-3">
                Join our platform to showcase your skills, connect with clients, and
                grow your beauty business. Benefit from secure payments and flexible
                scheduling.
            </div>
            <div class="mt-4">
                <a href="{{ route('register', ['role' => 'beauty_expert']) }}" class="common-btn">Join</a>
            </div>
        </div>
    </div>

    <div style="
      background: linear-gradient(
          180deg,
          rgba(255, 255, 255, 0) 16%,
          rgba(255, 255, 255, 0.6) 100%
        ),
        url('{{ asset('frontend/images/home-user-type-2.png') }}')
    "
        class="item">
        <div class="text-content">
            <div class="title">I'm Looking for a Beauty Service</div>
            <div class="text mt-3">
                Find trusted beauty professionals near you, book an appointment for
                your next glam session, and experience top-tier service right at
                your convenience.
            </div>
            <div class="mt-4">
                <a href="{{ route('service-category') }}" class="common-btn">Search</a>
            </div>
        </div>
    </div>
</div>
