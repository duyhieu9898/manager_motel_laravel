<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @auth
    <meta name="userID" content="{{ auth()->user()->id }}">
    @endauth
    <title>{{ config('app.name', 'Laravel') }} is the best framework</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="/favicon.ico" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('./plugins/bootstrap/bootstrap.min.css') }}">
    <!-- Font-awesome CSS -->
    <link rel="stylesheet" href="{{ asset('./css/font-awesome.min.css')}}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('./css/style.css')}}">
    <!-- alertify CSS -->
    <link rel="stylesheet" href="{{ asset('./plugins/AlertifyJS/build/css/alertify.css') }}">
    <!-- Jquery JS -->
    <script src="{{ asset('./plugins/jquery/jquery.min.js')}}"></script>
    <!-- Alertify JS -->
    <script src="{{ asset('./plugins/AlertifyJS/build/alertify.js') }}"></script>
    <!-- Carousel -->
    <link rel="stylesheet" href="{{ asset('./plugins/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('./plugins/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css') }}">
    <!-- Optional head -->
    @yield('head')
</head>

<body>
    @if (\Session::has('booking-success'))
    <script>
        $(document).ready(function () {
            alertify.notify("{!! \Session::get('booking-success') !!}", "success", 7);
        })
    </script>
    @endif

    @if (\Session::has('login-success'))
    <script>
        $(document).ready(function () {
            alertify.notify("{!! \Session::get('login-success') !!}", "success", 7);
        })
    </script>
    @endif

    @include('../sections/header')
    @include('../sections/main')
    @include('../sections/footer')

    <!-- Bootstrap -->
    <script src="{{ asset('./plugins/popper/popper.min.js') }}"></script>
    <script src="{{ asset('./plugins/bootstrap/bootstrap.min.js') }}"></script>
    <!-- OWL Carousel -->
    <script src=" {{ asset('./plugins/OwlCarousel2-2.3.4/dist/owl.carousel.min.js')}}"></script>
    <!-- Data Picker -->
    <script src="{{ asset('./plugins/DataPicker/bootstrap-datepicker.min.js') }}" charset="utf-8">
    </script>
    <!-- myJS -->
    <script src="{{ asset('./js/myJs.js') }}" charset="utf-8"></script>
    <!-- Optional JavaScript -->
    @yield('footer')
</body>

</html>
