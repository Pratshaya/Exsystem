@extends('layouts.student', ['activePage' => 'qq', 'titlePage' => __('S')])
@section('header')
    @if(empty($category))
        <div class="container">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach($sliders as $slider)
                        <div class="carousel-item @if($loop->iteration==1) active @endif">
                            <img class="d-block w-100 img-fluid" src="{{asset('/storage/'.$slider->image)}}"
                                 style="height: 350px;" alt="First slide">
                            <div class="carousel-caption d-none d-md-block">
                                <h2 class="display-4 font-weight-bold" style="color:white;">{{ $slider->title }}</h2>
                                <p class="lead" style="color:white;">{{ $slider->detail }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

        </div>


    @endif
@endsection
@section('content')

    <main class="container">
        <div class="section bg-gray">
            <div class="row">
                <div class="col-md-8 col-xl-9 card pb-2">
                    <h2 class="text-center mt-3"
                        style="padding: 10px;margin-left: -15px;margin-right: -15px;background: rgb(1, 67, 128); color:white;">
                        Article</h2>
                    <div class="row">
                        @forelse ($posts as $post)
                            <div class="col-md-12 mt-1">
                                <div class="alert-info">
                                    <div class="card-body">
                                        <h3 class="card-title"><a style="color:black;"
                                                                  href="{{route('student.post', $post->id)}}">{{ $post->title }}</a>
                                        </h3>
                                        <div class="card-text text-right">
                                            <strong>Tagged</strong>
                                            @if($post->tags->count() > 0)
                                                @foreach($post->tags as  $tag)
                                                    {{$tag->name}}
                                                    @if($loop->iteration != $post->tags->count())
                                                        ,
                                                    @endif
                                                @endforeach |
                                            @endif
                                            <span class="fas fa-user"></span> {{ $post->source }} <span
                                                    class="fas fa-calendar"></span> {{ $post->created_date }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center">
                                <h4> No result found for query  </h4>
                            </div>
                        @endforelse
                        <div class="col-md-12">
                            <div class="float-right mt-3">
                                <a class="btn btn-primary" href="{{ route('student.posts') }}">ทั้งหมด</a>
                            </div>
                        </div>
                    </div>
                    <h2 class="text-center mt-3"
                        style="padding: 10px;margin-left: -15px;margin-right: -15px;background: rgb(1, 67, 128); color:white;">

                        Quiz</h2>
                    <div class="row">
                        @forelse ($quizzes as $quiz)
                            <div class="col-md-6">
                                <div class="card mx-1 mt-2  bg-light">
                                    <h5 class="card-header">{{ $quiz->name }}</h5>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $quiz->category->name }}</h5>
                                        <h6>{{ $quiz->detail }}</h6>
                                        <ul>
                                            <li class="">Amount : {{ $quiz->questions()->count() }}</li>
                                        </ul>
                                        <div class="text-center">
                                            <a href="{{ route('student.show', $quiz->id) }}"
                                               class="btn btn-primary">START</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center">
                                No result found for query <strong> </strong>
                            </p>
                        @endforelse
                        <div class="col-md-12">
                            <div class="float-right mt-3">
                                <a class="btn btn-primary" href="{{ route('student.quizzes') }}">ทั้งหมด</a>
                            </div>
                        </div>
                    </div>
                    <h2 class="text-center mt-3"
                        style="padding: 10px;margin-left: -15px;margin-right: -15px;background: rgb(1, 67, 128); color:white;">

                        Questionnaire</h2>
                    <div class="row">
                        @forelse ($questionnaires as $questionnaire)
                            <div class="col-md-6">
                                <div class="card mx-1 mt-2  bg-light">
                                    <h5 class="card-header">{{ $questionnaire->name }}</h5>
                                    <div class="card-body">
                                        <h6>{{ $questionnaire->detail }}</h6>
                                        <ul>
                                            <li class="">Phase : {{ $questionnaire->count_public() }} </li>
                                            <li class="">Amount : {{ $questionnaire->question_count() }} </li>
                                        </ul>
                                        <div class="text-center">
                                            <a href="{{ route('student.show_questionnaire', $questionnaire->id) }}"
                                               class="btn btn-primary">START</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center">
                                No result found for query <strong> </strong>
                            </p>
                        @endforelse
                        <div class="col-md-12">
                            <div class="float-right mt-3">
                                <a class="btn btn-primary" href="{{ route('student.quizzes') }}">ทั้งหมด</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

@endsection
@section('script')

@endsection
