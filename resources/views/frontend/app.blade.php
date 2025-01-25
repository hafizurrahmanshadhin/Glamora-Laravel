<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title')</title>
    @include('frontend.partials.styles')
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
</body>

</html>
