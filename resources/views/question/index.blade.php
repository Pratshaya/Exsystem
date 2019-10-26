@extends('layouts.app',['activePage' => 'question', 'titlePage' => __('ข้อสอบแบบตัวเลือก')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="prostep3">
                    <ul>
                        <li>
                            <img src="{{ asset('images\icons\folder.png') }}" alt="ขั้นตอนแรก"><br>
                            <i class="fa fa-check"></i>
                            <p>กลุ่มวิชา</p>
                        </li>
                        <li>
                            <img src="{{ asset('images\icons\note.png') }}" alt=""><br>
                            <i class="fa fa-check"></i>
                            <p>สร้างข้อสอบ</p>
                        </li>
                        {{--<li>
                            <img src="{{ asset('images\icons\portfolio.png') }}" alt=""><br>
                            <i class="fa fa-refresh"></i>
                            <p>การจัดการ</p>
                        </li>--}}
                        <li>
                            <img src="{{ asset('images\icons\file.png') }}" alt=""><br>
                            <i class="fa fa-times"></i>
                            <p>สร้างคำถาม</p>
                        </li>
                        <li>
                            <img src="{{ asset('images\icons\business-presentation.png') }}" alt=""><br>
                            <i class="fa fa-times"></i>
                            <p>สร้างการแปลผล</p>
                        </li>
                        <li>
                            <img src="{{ asset('images\icons\origami.png') }}" alt=""><br>
                            <i class="fa fa-times"></i>
                            <p>ตรวจสอบและเผยแพร่</p>
                        </li>
                    </ul>
                </div>
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
