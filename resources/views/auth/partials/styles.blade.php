@php
    $systemSetting = App\Models\SystemSetting::first();
@endphp

{{-- App favicon --}}
<link rel="shortcut icon" type="image/x-icon"
    href="{{ isset($systemSetting->favicon) && !empty($systemSetting->favicon) ? asset($systemSetting->favicon) : asset('backend/images/favicon.ico') }}" />

{{-- Fonts css load --}}
<link rel="preconnect" href="https://fonts.googleapis.com/">
<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
<link id="fontsLink" href="{{ asset('backend/custom_downloaded_file/css2AdminDashboard.css') }}" rel="stylesheet">

{{-- Layout config Js --}}
<script src="{{ asset('backend/js/layout.js') }}"></script>

{{-- Bootstrap Css --}}
<link href="{{ asset('backend/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">

{{-- Icons Css --}}
<link href="{{ asset('backend/css/icons.min.css') }}" rel="stylesheet" type="text/css">

{{-- App Css --}}
<link href="{{ asset('backend/css/app.min.css') }}" rel="stylesheet" type="text/css">

{{-- custom Css --}}
<link href="{{ asset('backend/css/custom.min.css') }}" rel="stylesheet" type="text/css">

@stack('styles')
