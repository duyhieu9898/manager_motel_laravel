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
    {{--
    <link rel="stylesheet" href="{{ asset('css/app.css')}}"> --}}
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
    <nav class="navbar-inverse" id="nav-sticky">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('index') }}">MotelBoking</a>
            </div>
            <div class="collapse navbar-collapse main-menu" id="myNavbar">
                <ul class="nav navbar-nav mr-auto">
                    @foreach ($categories as $category)
                    <li class="text-capitalize"><a href="{{ route('category_rooms',$category['id']) }}">{{ $category['name'] }}</a></li>
                    @endforeach
                    <li class="text-capitalize"><a href="#">About Me</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @if(Auth::guest())
                    <li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in"></span>&nbsp;Login</a></li>
                    <li><a href="{{ route('register') }}"><span class="glyphicon glyphicon-user"></span>&nbsp;Register</a></li>
                    @elseif(Auth::user()->isAdministrator())
                    <li><a href="{{ url('/cart') }}"><i class="glyphicon glyphicon-shopping-cart"></i>&nbsp;Cart&nbsp;<span class="badge">{{ $numRoomInCart }}</span></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <i class="fa fa-user"></i>&nbsp;{{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/admin') }}"><i class="glyphicon glyphicon-th-large"></i>&nbsp;Admin Manager</a></li>
                            <li><a href="{{ url('/oder') }}"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;Order Rooms</a></li>
                            <li><a href="{{ url('/profile') }}"><i class="glyphicon glyphicon-briefcase"></i>&nbsp;Profile</a></li>
                            <li><a href="{{ route('register') }}"><span class="glyphicon glyphicon-user"></span>&nbsp;Register</a></li>
                            <li><a href="{{ url('/logout') }}"><i class="glyphicon glyphicon-log-out"></i>&nbsp;Logout</a></li>
                        </ul>
                    </li>
                    @else
                    <li><a href="{{ url('/cart') }}"><i class="glyphicon glyphicon-shopping-cart"></i>&nbsp;Cart&nbsp;<span class="badge">1</span></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <i class="fa fa-user"></i>&nbsp;{{ Auth::user()->name }} <i class="caret"></i>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/oder') }}"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;Order Rooms</a></li>
                            <li><a href="{{ url('/profile') }}"><i class="glyphicon glyphicon-briefcase"></i>&nbsp;Profile</a></li>
                            <li><a href="{{ route('register') }}"><i class="glyphicon glyphicon-user"></i>&nbsp;Register</a></li>
                            <li><a href="{{ url('/logout') }}"><i class="glyphicon glyphicon-log-out"></i>&nbsp;Logout</a></li>
                        </ul>
                    </li>
                    @endif
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
                            <li><i class="fa fa-map-marker"></i>&nbsp;169 Đường 32,Liên Mạc, Bắc Từ Liêm, TP Hà Nội</li>
                            <li><i class="fa fa-phone"></i>&nbsp;Điện thoại: 0366 025 756</li>
                            <li><i class="fa fa-envelope-o"></i>&nbsp;Gmail: duyhieu9898@gmail.com</li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 block-footer">
                        <h4>Chi nhánh Hà Nội</h4>
                        <ul>
                            <li><i class="fa fa-map-marker"></i>&nbsp;169 Đường 32,Liên Mạc, Bắc Từ Liêm, TP Hà Nội</li>
                            <li><i class="fa fa-phone"></i>&nbsp;Điện thoại: 0366 025 756</li>
                            <li><i class="fa fa-envelope-o"></i>&nbsp;Gmail: duyhieu9898@gmail.com</li>
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
    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/myJs.js') }}" type="text/javascript" charset="utf-8"></script>
    @yield('footer')
</body>

</html>
