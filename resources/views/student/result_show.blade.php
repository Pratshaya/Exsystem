@extends('layouts.student')
@section('header')
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Your score</div>
                    <div class="card-body">
                        @forelse($results as $result)
                            <h4 class="text-center">{{ $result[0]->quiz->category->name }}</h4>

                            <table class="table table-bordered table-sm text-center">
                                <tr>
                                    <th>Index</th>
                                    <th>Name</th>
                                    <th>Score</th>
                                    <th>Number</th>
                                    <th>Date</th>
                                    <th>Answer</th>
                                </tr>
                                @foreach($result as $quiz)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <th>{{ $quiz->quiz->name }}</th>
                                        <th>{{ $quiz->score }}</th>
                                        <th>{{ $quiz->num }}</th>
                                        <th>{{ $quiz->created_date }}</th>
                                        <th><a href="{{route('student.result_quiz',$quiz)}}">Result</a></th>
                                    </tr>
                                @endforeach
                            </table>
                        @empty
                            <h4 class="text-center">ยังไม่มีการสอบ</h4>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection