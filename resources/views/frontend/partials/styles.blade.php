@php
    $systemSetting = App\Models\SystemSetting::first();
@endphp

{{-- App favicon --}}
<link rel="shortcut icon" type="image/x-icon"
    href="{{ isset($systemSetting->favicon) && !empty($systemSetting->favicon) ? asset($systemSetting->favicon) : asset('backend/images/favicon.ico') }}" />

@stack('styles')
