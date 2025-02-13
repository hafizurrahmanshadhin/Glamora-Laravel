<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    @vite('resources/css/app.css')
    @vite(['resources/js/app.js'])
    @include('frontend.partials.styles')
    @livewireStyles
</head>

<body>
    @include('frontend.partials.explore-more-items')

    @if (Auth::check())
        @include('frontend.partials.auth-header')
    @else
        @include('frontend.partials.header')
    @endif

    @yield('content')

    @if (!Auth::check() || \App\Helpers\Helper::shouldShowFooter())
        @include('frontend.partials.footer')
    @endif

    @include('frontend.partials.scripts')
    @livewireScripts
</body>

</html>
