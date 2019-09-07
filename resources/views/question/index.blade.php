@extends('layouts.app',['activePage' => 'question', 'titlePage' => __('ข้อสอบแบบตัวเลือก')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">รายการข้อสอบที่มี</h4>
                </div>
                <div class="card-body row">
                    @foreach($quizzes as $quiz)
                        <div class="card my-1 col-md-6">
                            <h5 class="card-header">{{ $quiz->name }}</h5>
                            <div class="card-body">
                                <h5 class="card-title">วิชา : {{ $quiz->category->name }}</h5>
                                <p>{{ $quiz->detail }}</p>
                                <ul>
                                    <li class="">จำนวน : {{ $quiz->questions()->count() }} ข้อ</li>
                                </ul>
                                @if($quiz->type == 'O')
                                    <a href="{{ route('objective.create', $quiz->id) }}" class="btn btn-primary">เพิ่มวัตถุประสงค์</a>
                                @endif
                                <a href="{{ route('question.show', $quiz->id) }}" class="btn btn-primary">สร้างคำถาม</a>
                                <a href="{{ route('measurement_quiz.show', $quiz->id) }}" class="btn btn-primary">สร้างเกณฑ์การให้คะแนน</a>
                                <a href="{{ route('publish_quiz.show', $quiz->id) }}" class="btn btn-primary">การเผยแพร่</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{ $quizzes->links() }}

            </div>
        </div>
    </div>
@endsection
