<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1 , maximum-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>@yield('title')</title>
    @include('auth.partials.styles')
</head>

<body>
    @include('frontend.partials.explore-more-items')

    @include('frontend.partials.header')

    <main>
        @yield('content')
    </main>

    @include('auth.partials.scripts')
</body>

</html>
