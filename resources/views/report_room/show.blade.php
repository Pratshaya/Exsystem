@extends('layouts.app',['activePage' => 'room', 'titlePage' => __('room')])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Room</div>
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