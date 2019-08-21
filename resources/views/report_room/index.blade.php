@extends('layouts.app')

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