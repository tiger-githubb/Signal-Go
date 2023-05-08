<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} | @yield('pageTitle')</title>

    <!-- Fonts -->

    <!-- Styles -->
    @yield('style')

</head>

@yield('header')

@yield('content')

@yield('footer')

@yield('script')

</html>