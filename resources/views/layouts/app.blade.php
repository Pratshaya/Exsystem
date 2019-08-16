<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Quiz-Admin</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>


    @yield('css')
</head>
<body>
<div id="app">
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
                        <ul class="list-group">
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

                        </ul>
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
                    <div class="col-md-12">
                        @yield('content')
                    </div>
                </div>

            </div>

        @else
            @yield('content')
        @endauth
    </main>
</div>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script>

</script>
@yield('script')

</body>
</html>
