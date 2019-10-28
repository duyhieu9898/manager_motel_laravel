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
    <!-- App -->
    <script src="{!! asset('/js/app.js') !!}"></script>
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
    <script src="https://js.pusher.com/4.3/pusher.min.js"></script>
    @yield('footer')
    <script type="text/javascript">
        var notificationsWrapper   = $('.notifications');
        var notificationsToggle    = notificationsWrapper.find('a[data-toggle]');
        var notificationsCountElem = notificationsToggle.find('i[data-count]');
        var notificationsCount     = parseInt(notificationsCountElem.data('count'));
        var notifications          = notificationsWrapper.find('.list-notifications');


        // Enable pusher logging - don't include this in production
         Pusher.logToConsole = true;

        var pusher = new Pusher('{{env('PUSHER_APP_KEY')}}', {
            cluster: 'ap1',
            encrypted: true
        });

        // Subscribe to the channel we specified in our Laravel Event
        var channel = pusher.subscribe('Notify');

        // Bind a function to a Event (the full Laravel class)
        channel.bind('send-message', function(data) {
            var existingNotifications = notifications.html();
            var avatar = Math.floor(Math.random() * (71 - 20 + 1)) + 20;
            var newNotificationHtml = `
              <li class="notification active">
                  <div class="media">
                    <div class="media-left">
                      <div class="media-object">
                        <img class="_s0 _4ooo _44ma img"
                            src="https://scontent.fdad1-1.fna.fbcdn.net/v/t1.0-1/p100x100/48411989_1019080898294137_4484730551843946496_n.jpg?_nc_cat=103&amp;_nc_oc=AQmxccIvPqM3MQOqQQTAqs0e1qbNPeTkAADqmSecZic-5mN8C4SCg6KDCTG2lCQhVuz9h3o2Z-Vpqt_trK4OBGpf&amp;_nc_ht=scontent.fdad1-1.fna&amp;oh=84a7b2be2b476ba3e7220775e937835f&amp;oe=5E0D6799"
                            alt="" aria-label="Nguyễn Duy Hiếu" role="img" style="width:40px;height:40px">
                      </div>
                    </div>
                    <div class="media-body">
                      <strong class="notification-title">`+data.title+`</strong>
                      <p class="notification-desc">`+data.content+`</p>
                      <div class="notification-meta">
                        <small class="timestamp">about a minute ago</small>
                      </div>
                    </div>
                  </div>
              </li>
            `;
            notifications.html(newNotificationHtml + existingNotifications);

            notificationsCount += 1;
            notificationsCountElem.attr('data-count', notificationsCount);
            notificationsWrapper.find('.notif-count').text(notificationsCount);
            notificationsWrapper.show();
        });
    </script>
</body>

</html>
