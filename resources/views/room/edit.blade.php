@extends('layouts.app',['activePage' => 'room', 'titlePage' => __('room')])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit Category</div>
                    <div class="card-body">
                        <form action="{{ route('room.update',$room->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Category name" name="name"
                                       value="{{ isset($room->name) ? $room->name : '' }}">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Category name" name="detail"
                                       value="{{ isset($room->detail) ? $room->detail : '' }}">
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
