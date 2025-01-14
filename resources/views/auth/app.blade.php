<!doctype html>
<html lang="en" data-layout="vertical" data-sidebar="dark" data-sidebar-image="img-1" data-sidebar-size="lg"
    data-preloader="disable" data-theme="default" data-topbar="light" data-bs-theme="light" data-theme-color="0">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>@yield('title')</title>
    @include('auth.partials.styles')
</head>

<body>
    <section
        class="auth-page-wrapper p-2 p-lg-4 position-relative d-flex align-items-center justify-content-center min-vh-100">
        @yield('content')
    </section>

    @include('auth.partials.scripts')
</body>

</html>
