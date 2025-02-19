<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="assets/libs/swiper/swiper-bundle.min.css" />
	<link rel="stylesheet" href="assets/libs/drift-zoom/dist/drift-basic.min.css" />
	<!-- Favicon icon-->
	<link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/images/favicon/apple-touch-icon.png')}}" />
	<link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/images/favicon/favicon-32x32.png')}}" />
	<link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/favicon/favicon-16x16.png')}}" />
	<link rel="manifest" href="{{asset('assets/images/favicon/site.html')}}" />
	<link rel="shortcut icon" href="{{asset('assets/images/favicon/favicon.ico')}}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">



	<!-- Libs CSS -->
	<link rel="stylesheet" href="{{asset('assets/assets/libs/bootstrap-icons/font/bootstrap-icons.min.css')}}" />
	<link rel="stylesheet" href="{{asset('assets/assets/libs/swiper/swiper-bundle.min.css')}}" />
	<link href="{{asset('assets/libs/simplebar/dist/simplebar.min.css')}}" rel="stylesheet" />
	<!-- Theme CSS -->
	<link rel="stylesheet" href="{{asset('assets/css/theme.min.css')}}">
	<link fetchpriority="high" rel="preload" href="{{asset('assets/images/slider/slider-img-1.png')}}" as="image">

	<title>Homepage eCommerce Intership</title>
</head>
    <body >
      @include('layouts.nav')


        @yield('section')

        <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
        <!-- Swiper JS -->
        <script src="{{ asset('assets/libs/swiper/swiper-bundle.min.js') }}"></script>
        <script src="{{ asset('assets/libs/simplebar/dist/simplebar.min.js') }}"></script>

        <!-- Theme JS -->
        <script src="{{ asset('assets/js/theme.min.js') }}"></script>


        <!-- Swiper JS -->
        <script src="{{ asset('assets/libs/swiper/swiper-bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/vendors/swiper.js') }}"></script>
        <script src="{{ asset('assets/libs/drift-zoom/dist/Drift.min.js') }}"></script>
        <script src="{{ asset('assets/js/vendors/drift.js') }}"></script>
        <script src="{{ asset('assets/js/vendors/slide-hint-img.js') }}"></script>
        <script src="{{ asset('assets/js/vendors/flag.js') }}"></script>
        <script src="{{ asset('assets/js/vendors/color-change.js') }}"></script>
        <script src="{{ asset('assets/js/vendors/add-to-cart.js') }}"></script>
        <script src="{{ asset('assets/js/vendors/qty-input.js') }}"></script>
        <script src="{{ asset('assets/js/vendors/btn-scrolltop.js') }}"></script>




    </body>
</html>
