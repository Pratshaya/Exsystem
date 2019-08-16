@extends('layouts.student')
@section('content')
    <main class="container">
        <div class="section bg-gray">
            <div class="row">
                <div class="col-md-12 col-xl-12 card ">
                    <div class="row">
                        <table id="example" class="table table-bordered table-striped-column">
                            <thead>
                            <th class="text-center" style="width: 75%;">ข้อสอบ</th>
                            <th class="text-center">Action</th>
                            </thead>
                            @foreach ($room->room_quizzes as $quiz)
                                <tr>
                                    <td class="text-center">{{$quiz->quiz->name}}</td>
                                    @if(!$quiz->quiz->hasTest())
                                        <td class="text-center"><a class="btn btn-primary"
                                                                   href="{{ route('student.show', $quiz->quiz->id) }}">ทำแบบทดสอบ</a>
                                        </td>
                                    @else
                                        <td class="text-center"><a
                                                    class="btn btn-primary"
                                                    href="{{route('student.result_quiz',$quiz->quiz->roomResult())}}">ตรวจคำตอบ</a>
                                        </td>
                                    @endif

                                </tr>
                            @endforeach
                            @foreach ($room->room_questionnaires as $questionnaire)
                                <tr>
                                    <td class="text-center">{{$questionnaire->questionnaire->name}}</td>
                                    @if(!$questionnaire->questionnaire->hasTest())
                                        <td class="text-center"><a
                                                    class="btn btn-primary"
                                                    href="{{ route('student.show_questionnaire', $questionnaire->questionnaire->id) }}">ทำแบบทดสอบ</a>
                                        </td>
                                    @else
                                        <td class="text-center"><a
                                                    class="btn btn-primary"
                                                    href="{{ route('student.result_questionnaire', $questionnaire->questionnaire->roomResult()) }}">ตรวจคำตอบ</a>
                                        </td>
                                    @endif

                                </tr>
                            @endforeach
                        </table>

                    </div>
                </div>
            </div>
        </div>

    </main>

@endsection
@section('script')

@endsection
