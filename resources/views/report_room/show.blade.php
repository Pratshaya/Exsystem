@extends('layouts.app',['activePage' => 'report_room', 'titlePage' => __('room')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{ __('รายการข้อสอบทั้งหมดในห้อง') }}</h4>
                            <p class="card-category"> {{ __('เลือกข้อสอบที่ต้องการดูผลการทดสอบ') }}</p>
                        </div>
                    <div class="card-body">
                        <table id="example" class="table table-bordered table-striped-column">
                            <thead>
                            <tr>
                                <th class="text-center">Name</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($room->room_quizzes as $room_quiz)
                                <tr>
                                    <th class="text-center">{{ $room_quiz->quiz->name }}</th>
                                    <td class="text-center">
                                        <a class="btn btn-secondary"
                                           href="{{ route('report_room.chart_quiz',[$room->id,$room_quiz->quiz->id]) }}">Chart</a>
                                    </td>
                                </tr>
                            @endforeach
                            @foreach($room->room_questionnaires as $room_questionnaire)
                                <tr>
                                    <th class="text-center">{{ $room_questionnaire->questionnaire->name }}</th>
                                    <td class="text-center">
                                        <a class="btn btn-secondary"
                                           href="{{ route('report_room.chart_questionnaire',[$room->id,$room_questionnaire->questionnaire->id]) }}">Chart</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection