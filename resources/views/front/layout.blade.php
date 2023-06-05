<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">

  <!-- Bootstrap core CSS -->
  <link href="{{ asset('/front/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

  <!-- Additional CSS Files -->

  <link rel="stylesheet" href="{{ asset('/front/assets/css/fontawesome.css') }}">
  <link rel="stylesheet" href="{{ asset('/front/assets/css/templatemo-woox-travel.css') }}">
  <link rel="stylesheet" href="{{ asset('/front/assets/css/owl.css') }}">
  <link rel="stylesheet" href="{{ asset('/front/assets/css/animate.css') }}">
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
  integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
  <style>
    #map {
        height: 400px;
    }
  </style>

    <!-- Styles -->
    @yield('style')

</head>

<body>

  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
        <span class="dot"></span>
        <div class="dots">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->
    
@yield('header')

@include('front/inc/navbar')

@yield('content')

@yield('cta')

@include('front/inc/footer')


  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset('/front/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('/front/vendor/bootstrap/js/bootstrap.min.js') }}"></script>

  <script src="{{ asset('/front/assets/js/isotope.min.js') }}"></script>
  <script src="{{ asset('/front/assets/js/owl-carousel.js') }}"></script>
  <script src="{{ asset('/front/assets/js/tabs.js') }}"></script>
  <script src="{{ asset('/front/assets/js/popup.js') }}"></script>
  <script src="{{ asset('/front/assets/js/custom.js') }}"></script>

  <script>
    function bannerSwitcher() {
      next = $('.sec-1-input').filter(':checked').next('.sec-1-input');
      if (next.length) next.prop('checked', true);
      else $('.sec-1-input').first().prop('checked', true);
    }

    var bannerTimer = setInterval(bannerSwitcher, 5000);

    $('nav .controls label').click(function () {
      clearInterval(bannerTimer);
      bannerTimer = setInterval(bannerSwitcher, 5000)
    });
  </script>

  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
  integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin="">
  </script>

@yield('script')
</body>
</html>