<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Exsystem</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Free HTML5 Website Template by freehtml5.co"/>
    <meta name="keywords"
          content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive"/>
    <meta name="author" content="freehtml5.co"/>

    <!--
    //////////////////////////////////////////////////////

    FREE HTML5 TEMPLATE
    DESIGNED & DEVELOPED by FreeHTML5.co

    Website: 		http://freehtml5.co/
    Email: 			info@freehtml5.co
    Twitter: 		http://twitter.com/fh5co
    Facebook: 		https://www.facebook.com/fh5co

    //////////////////////////////////////////////////////
     -->

    <!-- Facebook and Twitter integration -->
    <meta property="og:title" content=""/>
    <meta property="og:image" content=""/>
    <meta property="og:url" content=""/>
    <meta property="og:site_name" content=""/>
    <meta property="og:description" content=""/>
    <meta name="twitter:title" content=""/>
    <meta name="twitter:image" content=""/>
    <meta name="twitter:url" content=""/>
    <meta name="twitter:card" content=""/>

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400" rel="stylesheet">

    <!-- Animate.css -->
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="{{ asset('css/icomoon.css') }}">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">

    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">

    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">

    <!-- Flexslider  -->
    <link rel="stylesheet" href="{{ asset('css/flexslider.css') }}">

    <!-- Pricing -->
    <link rel="stylesheet" href="{{ asset('css/pricing.css') }}">

    <!-- Theme style  -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Modernizr JS -->
    <script src="{{ asset('js/modernizr-2.6.2.min.js') }}"></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
    <script src="{{ asset('js/respond.min.js') }}"></script>
    <![endif]-->
    @yield('css')
</head>
<body>
{{--<div id="app">
    <nav class="navbar navbar-expand-md navbar-dark sticky-top" style="background: rgb(1, 67, 128)">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <h5 class="p-1"> Quiz-Admin</h5>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        @if(Auth::user()->hasRole(['administrator|superadministrator']))

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('student.index') }}">Home Student</a>
                            </li>
                        @endif
                        <li class="nav-item dropdown">

                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>


                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>--}}
<nav class="fh5co-nav" role="navigation">
    <div class="top-menu">
        <div class="container">
            <div class="row">
                <div class="col-xs-2">
                    <div id="fh5co-logo"><a href="index.html"><i class="icon-study"></i>Educ<span>.</span></a></div>
                </div>
                <div class="col-xs-10 text-right menu-1">
                    <ul>
                        <li class="active"><a href="index.html">Home</a></li>
                        <li><a href="courses.html">Courses</a></li>
                        <li><a href="teacher.html">Teacher</a></li>
                        <li><a href="about.html">About</a></li>
                        <li><a href="pricing.html">Pricing</a></li>
                        <li class="has-dropdown">
                            <a href="blog.html">Blog</a>
                            <ul class="dropdown">
                                <li><a href="#">Web Design</a></li>
                                <li><a href="#">eCommerce</a></li>
                                <li><a href="#">Branding</a></li>
                                <li><a href="#">API</a></li>
                            </ul>
                        </li>
                        <li><a href="contact.html">Contact</a></li>
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            @if(Auth::user()->hasRole(['administrator|superadministrator']))

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('student.index') }}">Home Student</a>
                                </li>
                            @endif
                            <li class="nav-item dropdown">

                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>


                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            {{--</li>
                                <li class="btn-cta"><a href="#"><span>Login</span></a></li>
                                <li class="btn-cta"><a href="#"><span>Create a Course</span></a></li>--}}
                        @endguest
                    </ul>
                </div>
            </div>

        </div>
    </div>
</nav>
<main class="py-4">

    @auth
        <div class="container">
            @include('partials.errors')

            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-4">
                    {{--<ul class="list-group">
                    <li class="list-group-item">
                        <a style="cursor: default;" data-toggle="collapse" href="#website" role="button"
                           aria-expanded="false" aria-controls="website">1) Website</a>
                    </li>
                    <div class="collapse multi-collapse" id="website">

                        <li class="list-group-item">
                            <a href="{{route('slider.index')}}">1.1) Slider</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{route('tag.index')}}">1.2) Tag</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{route('post.index')}}">1.3) Post</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{route('user.index')}}">1.4) User</a>
                        </li>
                    </div>

                    </ul>--}}
                    <ul class="list-group  mt-3">
                        <li class="list-group-item">
                            <a class="cursor: default;" data-toggle="collapse" href="#quiz" role="button"
                               aria-expanded="false" aria-controls="quiz">ข้อสอบแบบตัวเลือก</a>
                        </li>
                        <div class="collapse multi-collapse" id="quiz">
                            <li class="list-group-item">
                                <a href="{{ route('category.index') }}">กลุ่มข้อสอบ</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('quiz.index') }}">ข้อสอบแบบตัวเลือก</a>
                            </li>

                            <li class="list-group-item">
                                <a href="{{ route('question.index') }}">คำถามและตัวเลือก</a>
                            </li>
                            {{--<li class="list-group-item">
                                <a href="{{ route('question.index_match') }}">2.3) Question & Matching Options</a>
                            </li>--}}
                            <li class="list-group-item">
                                <a href="{{ route('result.index') }}">ผลสอบ</a>
                            </li>
                        </div>
                    </ul>
                    <ul class="list-group  mt-3">
                        <li class="list-group-item">
                            <a class="cursor: default;" data-toggle="collapse" href="#questionnaire" role="button"
                               aria-expanded="false" aria-controls="questionnaire">แบบสอบถาม</a>
                        </li>
                        <div class="collapse multi-collapse" id="questionnaire">
                            <li class="list-group-item">
                                <a href="{{ route('category_questionnaire.index') }}">กลุ่มของแบบสอบถาม</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('questionnaire.index') }}">รายการแบบสอบถาม</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('phase_questionnaire.index') }}">จัดการแบบสอบถาม</a>
                            </li>
                        <!--
                            <li class="list-group-item">
                                <a href="{{ route('question_phase_questionnaire.index') }}">3.4) Question </a>
                            </li>
                            -->
                            <li class="list-group-item">
                                <a href="{{ route('result.index') }}">ผลสำรวจ</a>
                            </li>
                        </div>
                    </ul>


                </div>
                <div class="col-md-8">
                    @yield('content')
                </div>
            </div>

        </div>

    @else
        @yield('content')
    @endauth
</main>
</div>
<!-- jQuery -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<!-- jQuery Easing -->
<script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<!-- Waypoints -->
<script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
<!-- Stellar Parallax -->
<script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
<!-- Carousel -->
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<!-- Flexslider -->
<script src="{{ asset('js/jquery.flexslider-min.js') }}"></script>
<!-- countTo -->
<script src="{{ asset('js/jquery.countTo.js') }}"></script>
<!-- Magnific Popup -->
<script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('js/magnific-popup-options.js') }}"></script>
<!-- Count Down -->
<script src="{{ asset('js/simplyCountdown.js') }}"></script>
<!-- Main -->
<script src="{{ asset('js/main.js') }}"></script>
<script>
    var d = new Date(new Date().getTime() + 1000 * 120 * 120 * 2000);

    // default example
    simplyCountdown('.simply-countdown-one', {
        year: d.getFullYear(),
        month: d.getMonth() + 1,
        day: d.getDate()
    });

    //jQuery example
    $('#simply-countdown-losange').simplyCountdown({
        year: d.getFullYear(),
        month: d.getMonth() + 1,
        day: d.getDate(),
        enableUtc: false
    });
</script>
<script>

</script>
@yield('script')

</body>
</html>
