<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} | @yield('pageTitle')</title>

    <!-- CSS files -->
    <link href="/back/dist/css/tabler.min.css?1674944402" rel="stylesheet" />
    <link href="/back/dist/css/tabler-flags.min.css?1674944402" rel="stylesheet" />
    <link href="/back/dist/css/tabler-payments.min.css?1674944402" rel="stylesheet" />
    <link href="/back/dist/css/tabler-vendors.min.css?1674944402" rel="stylesheet" />
    @yield('styles')

    <link href="/back/dist/css/demo.min.css?1674944402" rel="stylesheet" type="text/css" />
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <style>
        #map {
            height: 400px;
        }
    </style>
</head>

<body>
    <script src="/back/dist/js/demo-theme.min.js?1674944402"></script>

    <div class="page">

        @include('back/inc/navbar')

        <div class="page-wrapper">

            @yield('header')

            @yield('content')

            @include('back/inc/footer')
        </div>
    </div>

    @yield('modals')

    @yield('scripts')


    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>


    <!-- Tabler Core -->
    <script src="/back/dist/js/tabler.min.js?1674944402" defer></script>
    <script src="/back/dist/js/demo.min.js?1674944402" defer></script>

</body>

</html>
