@extends('layouts.student')
@section('head')
    <style type="text/css">
        .question:nth-child(odd) {
            background-color:#e8e8e8;;
        }

        .question:nth-child(even) {
            background-color:#f5f4f4;;
        }
    </style>
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">{{ $quiz->name }}</h4>
                </div>
                    <form action="{{ route('student.store', $quiz->id) }}" method="POST" id="form-submit">
                        @csrf
                        <input type="hidden" id="numberTime" value="{{$quiz->count}}">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-10">
                                    @foreach($questions as $key => $question)
                                        <div class="question card mt-2">
                                            <div class="card-body">
                                                <h6>{{ $key+1 }}. {{$question->name}}</h6>
                                                <hr>
                                                <ul>
                                                    @foreach($question->options as $option)
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="{{ $option->id }}"
                                                                   name="ch[{{$question->id}}]"
                                                                   value="{{ $option->id }}"
                                                                   class="custom-control-input" required>
                                                            <label class="custom-control-label"
                                                                   for="{{$option->id}}">{{ $option->name }}</label>
                                                        </div>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

@endsection

