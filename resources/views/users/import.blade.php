@extends('layouts.app',['activePage' => 'category', 'titlePage' => __('กลุ่มวิชาของข้อสอบ')])

@section('content')
    <div class="content">
        @include('partials.errors_import')
        <div class="container-fluid">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">สร้างกลุ่มวิชา</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.import_file') }}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="role" class="">{{ __('Room') }}</label>
                            <select class="custom-select {{ $errors->has('room_id') ? 'is-invalid' : '' }}"
                                    id="input-role" name="room_id">
                                <option selected value="0">เลือกไฟล์นามสกุล xlsx...</option>
                                @foreach($rooms as $room)
                                    <option value="{{$room->id}}">{{$room->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('room_id'))
                                <div class="invalid-feedback">
                                    <strong>{{$errors->first('room_id')}}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="col-lg-12">
                            <input type="file" name="file" class="form-control">
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-primary th">สร้าง</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function handleDelete(id) {
            $('#deleteModal' + id).modal('show');
        }
    </script>
@endsection