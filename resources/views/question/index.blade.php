@extends('layouts.app',['activePage' => 'question', 'titlePage' => __('ข้อสอบแบบตัวเลือก')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">รายการคำถามและตัวเลือกที่มี</h4>
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
                                        <a href="{{ route('question.show', $quiz->id) }}" class="btn btn-primary">สร้างคำถาม</a>
                                    </div>
                                </div>
                            @endforeach
                    </div>
                    {{ $quizzes->links() }}

                </div>
            </div>
        </div>
@endsection
