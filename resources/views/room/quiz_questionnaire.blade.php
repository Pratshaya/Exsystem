@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Category</div>
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
                                    <th class="text-center">
                                        <a class="btn btn-secondary" href="{{ route('quiz_questionnaire.show',$room->id) }}">เพิ่มข้อสอบ/แบบสอบถาม</a>
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