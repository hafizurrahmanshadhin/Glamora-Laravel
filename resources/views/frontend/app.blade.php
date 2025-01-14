<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title')</title>
    @include('frontend.partials.styles')
</head>

<body>
    @yield('content')

    @include('frontend.partials.scripts')
</body>

</html>
