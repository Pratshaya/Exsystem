@extends('layouts.app',['activePage' => 'room', 'titlePage' => __('room')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">แก้ไขชื่อและรายละเอียดห้อง</h4>
                </div>
                    <div class="card-body">
                        <form action="{{ route('room.update',$room->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <h4>ชื่อห้อง</h4>
                                <input type="text" class="form-control" placeholder="Category name" name="name"
                                       value="{{ isset($room->name) ? $room->name : '' }}">
                            </div>
                            <div class="form-group">
                                <h4>รายละเอียด</h4>
                                <input type="text" class="form-control" placeholder="Category name" name="detail"
                                       value="{{ isset($room->detail) ? $room->detail : '' }}">
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-primary">บันทึก</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
