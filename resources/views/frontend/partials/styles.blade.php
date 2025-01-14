@php
    $systemSetting = App\Models\SystemSetting::first();
@endphp

{{-- App favicon --}}
<link rel="shortcut icon" type="image/x-icon"
    href="{{ isset($systemSetting->favicon) && !empty($systemSetting->favicon) ? asset($systemSetting->favicon) : asset('backend/images/favicon.ico') }}" />

{{-- Plugins CSS --}}
<link rel="stylesheet" href="{{ asset('frontend/css/plugins/bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('frontend/css/plugins/aos.css') }}" />
<link rel="stylesheet" href="{{ asset('frontend/css/plugins/nice-select.min.css') }}" />
<link rel="stylesheet" href="{{ asset('frontend/css/plugins/owl.carousel.min.css') }}" />

{{-- custom css --}}
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/tarek-common.css') }}" />
<link rel="stylesheet" href="{{ asset('frontend/css/common.css') }}" />
<link rel="stylesheet" href="{{ asset('frontend/css/home.css') }}" />

<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />

@stack('styles')
