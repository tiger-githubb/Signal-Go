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
    @stack('styles')

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
</head>

<body class=" d-flex flex-column">
    <script src="/back/dist/js/demo-theme.min.js?1674944402"></script>
    @yield('content')

    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="/back/dist/js/tabler.min.js?1674944402" defer></script>
    <script src="/back/dist/js/demo.min.js?1674944402" defer></script>
</body>

</html>