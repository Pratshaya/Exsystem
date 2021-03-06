@extends('layouts.student')
@section('header')
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">{{ $quiz->name }}</h4>
                </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-10">
                                    @foreach($result_detail as $key => $result)
                                        <div class="card mt-2">
                                            <div class="card-body">
                                                <h6>{{ $key+1 }}. {{$result->question->name}}</h6>
                                                <hr>
                                                <ul>
                                                    @foreach($result->question->options as $option)
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="{{ $option->id }}"
                                                                   name="ch[{{$result->question->id}}]"
                                                                   value="{{ $option->id }}"
                                                                   class="custom-control-input"
                                                                   @if($option->id == $result->option->id)
                                                                   checked
                                                                   @endif
                                                                   disabled>
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
                            <a  href="{{ route('student.room') }}" class="btn btn-primary" >กลับ</a>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection

