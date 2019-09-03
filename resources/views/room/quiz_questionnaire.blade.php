@extends('layouts.app',['activePage' => 'quiz_q', 'titlePage' => __('รายละเอียด')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">รายการห้องสอบ</h4>
                </div>
                    <div class="card-body">
                        <table id="example" class="table table-bordered table-striped-column">
                            <thead>
                            <tr>
                                <th class="text-center">Name</th>
                                <th class="text-center">Detail</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rooms as $room)
                                <tr>
                                    <th class="text-center">{{ $room->name }}</th>
                                    <th class="text-center">{{ $room->detail }}</th>
                                    <th class="text-center">
                                        <a class="btn btn-primary"
                                           href="{{ route('room.student',$room->id) }}">รายชื่อนักเรียนในห้อง</a>
                                        <a class="btn btn-secondary"
                                           href="{{ route('quiz_questionnaire.show',$room->id) }}">เพิ่มข้อสอบ/แบบสอบถาม</a>
                                    </th>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $rooms->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection