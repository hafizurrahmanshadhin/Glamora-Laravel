@php
    use App\Models\Service;
    $services = Service::where('status', 'active')->orderBy('created_at', 'desc')->take(5)->get();
@endphp

<div class="explore-items-container">
    <div class="text-content">
        <div class="title">Explore Our Personalized Beauty Services</div>
        <div class="line"></div>
        <div class="text">
            Explore Glamora and <br />
            <a href="{{ route('service-category') }}">Beauty Experts
                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="16" viewBox="0 0 19 16" fill="none">
                    <path
                        d="M18.7071 8.70711C19.0976 8.31658 19.0976 7.68342 18.7071 7.29289L12.3431 0.928932C11.9526 0.538408 11.3195 0.538408 10.9289 0.928932C10.5384 1.31946 10.5384 1.95262 10.9289 2.34315L16.5858 8L10.9289 13.6569C10.5384 14.0474 10.5384 14.6805 10.9289 15.0711C11.3195 15.4616 11.9526 15.4616 12.3431 15.0711L18.7071 8.70711ZM0 9H18V7H0V9Z"
                        fill="#FFB6C1" />
                </svg>
            </a>
        </div>
    </div>
    <div class="explore-items">
        @foreach ($services as $service)
            <a href="" class="explore-item">{{ $service->services_name }}</a>
        @endforeach
        <a href="{{ route('service-category') }}" class="explore-item">Explore More
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="9" viewBox="0 0 16 9" fill="none">
                <path
                    d="M15.3536 4.85355C15.5488 4.65829 15.5488 4.34171 15.3536 4.14645L12.1716 0.964466C11.9763 0.769204 11.6597 0.769204 11.4645 0.964466C11.2692 1.15973 11.2692 1.47631 11.4645 1.67157L14.2929 4.5L11.4645 7.32843C11.2692 7.52369 11.2692 7.84027 11.4645 8.03553C11.6597 8.2308 11.9763 8.2308 12.1716 8.03553L15.3536 4.85355ZM0 5H15V4H0V5Z"
                    fill="#6B6B6B" />
            </svg>
        </a>
    </div>
</div>
