@extends('layouts.app',['activePage' => 'room', 'titlePage' => __('ห้องสอบ')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            @if (session('status'))
                <div class="row">
                    <div class="col-sm-12">
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="material-icons">close</i>
                            </button>
                            <span>{{ session('status') }}</span>
                        </div>
                    </div>
                </div>
            @endif
            @if (session('error'))
                <div class="row">
                    <div class="col-sm-12">
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="material-icons">close</i>
                            </button>
                            <span>{{ session('error') }}</span>
                        </div>
                    </div>
                </div>
            @endif
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">รายการห้องสอบ</h4>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-bordered table-striped-column">
                        <thead>
                        <tr>
                            <th class="text-center">ชื่อห้อง</th>
                            <th class="text-center">รายละเอียด</th>
                            <th class="text-center">ตัวเลือก</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rooms as $room)
                            <tr>
                                <th class="text-center">{{ $room->name }}</th>
                                <th class="text-center">{{ $room->detail }}</th>
                                <th class="text-center">
                                    <a class="btn btn-success btn-link" href="{{ route('room.edit',$room->id) }}">
                                        <i class="material-icons">edit</i>
                                    </a>
                                    <button class="btn btn-danger btn-link" onClick="handleDelete({{ $room->id }})">
                                        <i class="material-icons">delete</i>
                                    </button>
                                    <div class="modal fade" id="deleteModal{{$room->id}}" tabindex="-1"
                                         role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <form action="{{ route('room.destroy', $room->id) }}" method="POST"
                                              id="deleteCategoryForm">
                                            @method('delete')
                                            @csrf
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">ลบห้องสอบ</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="text-cetner">
                                                            คุณต้องการลบห้อง {{ $room->name }} หรือไม่
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">ไม่ต้องการ
                                                        </button>
                                                        <button type="submit" class="btn btn-danger">ต้องการลบ
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $rooms->links() }}
                </div>
            </div>
            <hr>
            <div class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">สร้างห้อง</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('room.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="ชื่อห้อง" name="name"
                                           value="{{ old('name') }}" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="รายละเอียดห้อง" name="detail"
                                           value="{{ old('detail') }}" required>
                                </div>
                                <div class="form-group text-center">
                                    <button class="btn btn-primary">สร้าง</button>
                                </div>
                            </form>
                        </div>
                    </div>
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