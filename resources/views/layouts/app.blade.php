<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <!-- Styles -->
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css')}}"> --}}

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{ asset('css/animate.css')}}">
    @yield('head')
</head>

<body>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.0';
      fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
    </script>
    <div >
        <nav class="navbar-inverse" id="nav-sticky">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ route('index') }}">WebSiteName</a>
                </div>
                <div class="collapse navbar-collapse main-menu" id="myNavbar">
                    <ul class="nav navbar-nav mr-auto">
                        <li><a href="#">Trang chủ</a></li>
                        <li><a href="#cho-thue-phong-tro" data-toggle="tab">Thuê phòng trọ</a></li>
                        <li><a href="#nha-cho-thue" data-toggle="tab">Thuê nhà</a></li>
                        <li><a href="#cho-thue-can-ho" data-toggle="tab">Thuê căn hộ</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ route('register') }}"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                        <li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <main id="main">
            @yield('content')
        </main>
        <footer>
            <div class="top-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 block-footer">
                            <h4>Trụ sở chính:</h4>
                            <ul>
                                <li><i class="fa fa-map-marker"></i> 169 Đường 32,Liên Mạc, Bắc Từ Liêm, TP Hà Nội</li>
                                <li><i class="fa fa-phone"></i> Điện thoại: 0366 025 756</li>
                                <li><i class="fa fa-envelope-o"></i> Gmail: duyhieu9898@gmail.com</li>
                            </ul>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 block-footer">
                            <h4>Chi nhánh Hà Nội</h4>
                            <ul>
                                <li><i class="fa fa-map-marker"></i> 169 Đường 32,Liên Mạc, Bắc Từ Liêm, TP Hà Nội</li>
                                <li><i class="fa fa-phone"></i> Điện thoại: 0366 025 756</li>
                                <li><i class="fa fa-envelope-o"></i> Gmail: duyhieu9898@gmail.com</li>
                            </ul>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 block-footer">
                            <h4>Fanpages của chúng tôi</h4>
                            <div class="fb-page" data-href="https://www.facebook.com/thuephongtro.vn//" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                                <blockquote cite="https://www.facebook.com/duyhieu9889/" class="fb-xfbml-parse-ignore">
                                    <a href="https://www.facebook.com/duyhieu9889/">Thuê Phòng Trọ</a>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copy-right text-center">Copyright @2019 - All rights reserved</div>
        </footer>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/myJs.js') }}" type="text/javascript" charset="utf-8"></script>

    @yield('option-js')
</body>
</html>
