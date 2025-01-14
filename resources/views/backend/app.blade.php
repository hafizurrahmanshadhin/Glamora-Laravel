<!doctype html>
<html lang="en" data-layout="vertical" data-sidebar="dark" data-sidebar-image="img-1" data-sidebar-size="lg"
    data-preloader="disable" data-theme="default" data-topbar="light" data-bs-theme="light" data-theme-color="0">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>@yield('title')</title>
    @include('backend.partials.styles')
</head>

<body>
    <div id="layout-wrapper">
        @include('backend.partials.sidebar')
        @include('backend.partials.header')

        <div class="main-content">
            @yield('content')

            @include('backend.partials.footer')
        </div>
    </div>

    {{-- start back-to-top --}}
    <button class="btn btn-dark btn-icon" id="back-to-top">
        <i class="bi bi-caret-up fs-3xl"></i>
    </button>
    {{-- end back-to-top --}}

    {{-- preloader --}}
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
    {{-- preloader --}}

    @include('backend.partials.theme-settings')
    @include('backend.partials.scripts')
</body>

</html>
