<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta name="description" content="Responsive Admin Template">
    <meta name="author" content="HotelAdmin">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Spice Hotel | Bootstrap 4 Admin Dashboard Template + UI Kit</title>
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" type="text/css">
    <!-- icons -->
    <link href="{{ asset('admin_rooms/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin_rooms/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <!--bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    {{-- <link href="{{ asset('admin_rooms/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin_rooms/plugins/summernote/summernote.css" rel="stylesheet')}}"> --}}
    <!-- Material Design Lite CSS -->
    <link rel="stylesheet" href="{{ asset('admin_rooms/plugins/material/material.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_rooms/css/material_style.css')}}">
    <!-- animation -->
    <link href="{{ asset('admin_rooms/css/pages/animate_page.css')}}" rel="stylesheet">
    <!-- Template Styles -->
    <link href="{{ asset('admin_rooms/css/style.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin_rooms/css/plugins.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin_rooms/css/responsive.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin_rooms/css/theme-color.css')}}" rel="stylesheet" type="text/css">
    <!-- data table -->
    <link href="{{ asset('admin_rooms/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Sweet Alert -->
    <link rel="stylesheet" href="{{ asset('admin_rooms/plugins/sweet-alert/sweetalert.min.css') }}">
    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('admin_rooms/img/favicon.ico') }}">
    <!-- icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/open-iconic-bootstrap.min.css') }}">
    {{-- option --}}
    @yield('css')
</head>

<body class='page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark'>
    <div id="app" class="page-wrapper">
            @yield('admin-app')
    </div>
    <!-- start js include path -->

    <script src="{{ asset('admin_rooms/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin_rooms/plugins/popper/popper.min.js') }}"></script>
    <script src="{{ asset('admin_rooms/plugins/jquery-blockui/jquery.blockui.min.js') }}"></script>
    <script src="{{ asset('admin_rooms/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{ asset('admin_rooms/plugins/dropzone/dropzone.js')}}"></script>
    <!-- bootstrap -->
    <script src="{{ asset('admin_rooms/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- Common js-->
    <script src="{{ asset('admin_rooms/js/app.js') }}"></script>
    <script src="{{ asset('admin_rooms/js/layout.js') }}"></script>
    <script src="{{ asset('admin_rooms/js/theme-color.js') }}"></script>
    <!-- material -->
    <script src="{{ asset('admin_rooms/plugins/material/material.min.js')}}"></script>
    <!-- animation -->
    <script src="{{ asset('admin_rooms/js/pages/ui/animations.js') }}"></script>
    <!-- data table -->
    <script src="{{ asset('admin_rooms/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin_rooms/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin_rooms/js/pages/table/table_data.js') }}"></script>
    <!-- Sweet Alert -->
    <script src="{{ asset('admin_rooms/plugins/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('admin_rooms/js/pages/sweet-alert/sweet-alert-data.js') }}"></script>
    <!-- end js include path -->
    <!-- app -->
    <script src="{!! asset('/js/app.js') !!}"></script>
</body>

</html>
