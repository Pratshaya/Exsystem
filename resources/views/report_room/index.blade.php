@extends('layouts.app',['activePage' => 'report_room', 'titlePage' => __('ผลการทดสอบ')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{ __('รายการห้องสอบทั้งหมด') }}</h4>
                            <p class="card-category"> {{ __('เลือกห้องสอบที่ต้องการดูผลการทดสอบ') }}</p>
                        </div>
                    <div class="card-body">
                        <table id="example" class="table table-bordered table-striped-column">
                            <thead>
                            <tr>
                                <th class="text-center">ชื่อ</th>
                                <th class="text-center">จัดการ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rooms as $room)
                                <tr>
                                    <th class="text-center">{{ $room->name }}</th>
                                    <td class="text-center">
                                        <a class="btn btn-secondary"
                                           href="{{ route('report_room.show',$room->id) }}">แบบทดสอบทั้งหมด</a>
                                    </td>
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