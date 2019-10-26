<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('ระบบจัดการข้อสอบแบบตัวเลือก') }}</title>
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('material') }}/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('material') }}/img/favicon.png">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="{{ asset('material') }}/css/material-dashboard.css?v=2.1.1" rel="stylesheet"/>
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{ asset('material') }}/demo/demo.css" rel="stylesheet"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Athiti&display=swap" rel="stylesheet">

    <!-- data table -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/jquery-3.3.1.js" rel="stylesheet">

    <style>
        body {
            font-family: 'Athiti', sans-serif;
        }
        h4,h6 {
            font-family: 'Athiti', sans-serif;
        }
        .form-control {
            background: no-repeat center bottom, center calc(100% - 1px);
            background-size: 0 100%, 100% 100%;
            border: 0;
            height: 36px;
            transition: background 0s ease-out;
            padding-left: 0;
            padding-right: 0;
            border-radius: 0;
            font-size: 14px;
        }
        .prostep1,.prostep2,.prostep3,.prostep4,.prostep5,.prostep6 {
            margin: 20px auto;
        }
        .prostep1 img,
        .prostep2 img,
        .prostep3 img,
        .prostep4 img,
        .prostep5 img,
        .prostep6 img,
        .prostep7 img
        {
             width: 60px;
             margin-bottom: 20px;
         }
        .prostep1 ul,
        .prostep2 ul,
        .prostep3 ul,
        .prostep4 ul,
        .prostep5 ul,
        .prostep6 ul,
        .prostep7 ul
        {
            text-align: center;
        }
        .prostep1 li,
        .prostep2 li,
        .prostep3 li,
        .prostep4 li,
        .prostep5 li,
        .prostep6 li,
        .prostep7 li{
            display: inline-block;
            width: 150px;
            position: relative;
        }
        .prostep1 li .fa,
        .prostep2 li .fa,
        .prostep3 li .fa,
        .prostep4 li .fa,
        .prostep5 li .fa,
        .prostep6 li .fa,
        .prostep7 li .fa
        {
            background: #CCC;
            width: 20px;
            height: 20px;
            color: #fff;
            border-radius: 50%;
            padding: 5px;
        }
        .prostep1 li .fa::after,
        .prostep2 li .fa::after,
        .prostep3 li .fa::after,
        .prostep4 li .fa::after,
        .prostep5 li .fa::after,
        .prostep6 li .fa::after,
        .prostep7 li .fa::after
        {
            content: '';
            background: #ccc;
            height: 5px;
            width: 155px;
            display: block;
            position: absolute;
            left: 0;
            top: 85px;
        }
        .prostep1 li:nth-child(1) .fa,
        .prostep2 li:nth-child(2) .fa,
        .prostep3 li:nth-child(3) .fa,
        .prostep4 li:nth-child(3) .fa,
        .prostep5 li:nth-child(4) .fa,
        .prostep6 li:nth-child(5) .fa,
        .prostep7 li:nth-child(6) .fa
        {
            background: #148e14;
        }
        .prostep1 li:nth-child(1) .fa::after,
        .prostep2 li:nth-child(2) .fa::after,
        .prostep3 li:nth-child(3) .fa::after,
        .prostep4 li:nth-child(3) .fa::after,
        .prostep5 li:nth-child(4) .fa::after,
        .prostep6 li:nth-child(5) .fa::after,
        .prostep7 li:nth-child(6) .fa::after
        {
            background: #148e14;
        }
        .prostep1 li:first-child .fa::after,
        .prostep2 li:first-child .fa::after,
        .prostep3 li:first-child .fa::after,
        .prostep4 li:first-child .fa::after,
        .prostep5 li:first-child .fa::after,
        .prostep6 li:first-child .fa::after,
        .prostep7 li:first-child .fa::after{
            width: 85px;
            left: 80px;
        }
        .prostep1 li:last-child .fa::after,
        .prostep2 li:last-child .fa::after,
        .prostep3 li:last-child .fa::after,
        .prostep4 li:last-child .fa::after,
        .prostep5 li:last-child .fa::after,
        .prostep6 li:last-child .fa::after,
        .prostep7 li:last-child .fa::after{
            width: 80px;
        }
        .prostep2 li:nth-child(1) .fa,

        .prostep3 li:nth-child(1) .fa,
        .prostep3 li:nth-child(2) .fa,

        .prostep4 li:nth-child(1) .fa,
        .prostep4 li:nth-child(2) .fa,

        .prostep5 li:nth-child(1) .fa,
        .prostep5 li:nth-child(2) .fa,
        .prostep5 li:nth-child(3) .fa,

        .prostep6 li:nth-child(1) .fa,
        .prostep6 li:nth-child(2) .fa,
        .prostep6 li:nth-child(3) .fa,
        .prostep6 li:nth-child(4) .fa,

        .prostep7 li:nth-child(1) .fa,
        .prostep7 li:nth-child(2) .fa,
        .prostep7 li:nth-child(3) .fa,
        .prostep7 li:nth-child(4) .fa,
        .prostep7 li:nth-child(5) .fa
        {
            background: #60aa97;
        }
        .prostep2 li:nth-child(1) .fa::after,

        .prostep3 li:nth-child(1) .fa::after,
        .prostep3 li:nth-child(2) .fa::after,

        .prostep4 li:nth-child(1) .fa::after,
        .prostep4 li:nth-child(2) .fa::after,

        .prostep5 li:nth-child(1) .fa::after,
        .prostep5 li:nth-child(2) .fa::after,
        .prostep5 li:nth-child(3) .fa::after,

        .prostep6 li:nth-child(1) .fa::after,
        .prostep6 li:nth-child(2) .fa::after,
        .prostep6 li:nth-child(3) .fa::after,
        .prostep6 li:nth-child(4) .fa::after,

        .prostep7 li:nth-child(1) .fa::after,
        .prostep7 li:nth-child(2) .fa::after,
        .prostep7 li:nth-child(3) .fa::after,
        .prostep7 li:nth-child(4) .fa::after,
        .prostep7 li:nth-child(5) .fa::after
        {
            background: #60aa97;
        }
    </style>
    @yield('css')
</head>
<body class="{{ $class ?? '' }}">

@auth()
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    @include('layouts.page_templates.auth')
@endauth
@guest()
    @include('layouts.page_templates.guest')
@endguest

{{--<div class="fixed-plugin">
  <div class="dropdown show-dropdown">
    <a href="#" data-toggle="dropdown">
      <i class="fa fa-cog fa-2x"> </i>
    </a>
    <ul class="dropdown-menu">
      <li class="header-title"> Sidebar Filters</li>
      <li class="adjustments-line">
        <a href="javascript:void(0)" class="switch-trigger active-color">
          <div class="badge-colors ml-auto mr-auto">
            <span class="badge filter badge-purple " data-color="purple"></span>
            <span class="badge filter badge-azure" data-color="azure"></span>
            <span class="badge filter badge-green" data-color="green"></span>
            <span class="badge filter badge-warning active" data-color="orange"></span>
            <span class="badge filter badge-danger" data-color="danger"></span>
            <span class="badge filter badge-rose" data-color="rose"></span>
          </div>
          <div class="clearfix"></div>
        </a>
      </li>
      <li class="header-title">Images</li>
      <li class="active">
        <a class="img-holder switch-trigger" href="javascript:void(0)">
          <img src="{{ asset('material') }}/img/sidebar-1.jpg" alt="">
        </a>
      </li>
      <li>
        <a class="img-holder switch-trigger" href="javascript:void(0)">
          <img src="{{ asset('material') }}/img/sidebar-2.jpg" alt="">
        </a>
      </li>
      <li>
        <a class="img-holder switch-trigger" href="javascript:void(0)">
          <img src="{{ asset('material') }}/img/sidebar-3.jpg" alt="">
        </a>
      </li>
      <li>
        <a class="img-holder switch-trigger" href="javascript:void(0)">
          <img src="{{ asset('material') }}/img/sidebar-4.jpg" alt="">
        </a>
      </li>
      <li class="button-container">
        <a href="https://www.creative-tim.com/product/material-dashboard-laravel" target="_blank" class="btn btn-primary btn-block">Free Download</a>
      </li>
      <!-- <li class="header-title">Want more components?</li>
          <li class="button-container">
              <a href="https://www.creative-tim.com/product/material-dashboard-pro" target="_blank" class="btn btn-warning btn-block">
                Get the pro version
              </a>
          </li> -->
      <li class="button-container">
        <a href="https://material-dashboard-laravel.creative-tim.com/docs/getting-started/laravel-setup.html" target="_blank" class="btn btn-default btn-block">
          View Documentation
        </a>
      </li>
      <li class="button-container github-star">
        <a class="github-button" href="https://github.com/creativetimofficial/material-dashboard-laravel" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star ntkme/github-buttons on GitHub">Star</a>
      </li>
      <li class="header-title">Thank you for 95 shares!</li>
      <li class="button-container text-center">
        <button id="twitter" class="btn btn-round btn-twitter"><i class="fa fa-twitter"></i> &middot; 45</button>
        <button id="facebook" class="btn btn-round btn-facebook"><i class="fa fa-facebook-f"></i> &middot; 50</button>
        <br>
        <br>
      </li>
    </ul>
  </div>
</div>--}}
<!--   Core JS Files   -->
<script src="{{ asset('material') }}/js/core/jquery.min.js"></script>
<script src="{{ asset('material') }}/js/core/popper.min.js"></script>
<script src="{{ asset('material') }}/js/core/bootstrap-material-design.min.js"></script>
<script src="{{ asset('material') }}/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<!-- Plugin for the momentJs  -->
<script src="{{ asset('material') }}/js/plugins/moment.min.js"></script>
<!--  Plugin for Sweet Alert -->
<script src="{{ asset('material') }}/js/plugins/sweetalert2.js"></script>
<!-- Forms Validations Plugin -->
<script src="{{ asset('material') }}/js/plugins/jquery.validate.min.js"></script>
<!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
<script src="{{ asset('material') }}/js/plugins/jquery.bootstrap-wizard.js"></script>
<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="{{ asset('material') }}/js/plugins/bootstrap-selectpicker.js"></script>
<!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
<script src="{{ asset('material') }}/js/plugins/bootstrap-datetimepicker.min.js"></script>
<!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
<script src="{{ asset('material') }}/js/plugins/jquery.dataTables.min.js"></script>
<!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src="{{ asset('material') }}/js/plugins/bootstrap-tagsinput.js"></script>
<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="{{ asset('material') }}/js/plugins/jasny-bootstrap.min.js"></script>
<!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
<script src="{{ asset('material') }}/js/plugins/fullcalendar.min.js"></script>
<!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
<script src="{{ asset('material') }}/js/plugins/jquery-jvectormap.js"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="{{ asset('material') }}/js/plugins/nouislider.min.js"></script>
<!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
<!-- Library for adding dinamically elements -->
<script src="{{ asset('material') }}/js/plugins/arrive.min.js"></script>
<!--  Google Maps Plugin    -->
<!-- Chartist JS -->
<script src="{{ asset('material') }}/js/plugins/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="{{ asset('material') }}/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('material') }}/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="{{ asset('material') }}/demo/demo.js"></script>
<script src="{{ asset('material') }}/js/settings.js"></script>
@stack('js')
@yield('script')

</body>
</html>