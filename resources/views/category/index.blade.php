@extends('layouts.app',['activePage' => 'category', 'titlePage' => __('กลุ่มวิชาของข้อสอบ')])

@section('content')
    <div class="content">
        <div class="container-fluid">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">รายการ</h4>
                    </div>
                    <div class="card-body">
                        <table id="example" class="table table-bordered table-striped-column">
                            <thead>
                            <tr>
                                <th class="text-center">ชื่อของกลุ่มข้อสอบ</th>
                                <th class="text-center">การจัดการกลุ่มข้อสอบ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <th class="text-center">{{ $category->name }}</th>
                                    <th class="text-center">
                                        <a class="btn btn-primary th" href="{{ route('category.edit',$category->id) }}">แก้ไข</a>
                                        <button class="btn btn-danger th" onClick="handleDelete({{ $category->id }})">
                                            ลบ
                                        </button>
                                        <div class="modal fade" id="deleteModal{{$category->id}}" tabindex="-1"
                                             role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <form action="{{ route('category.destroy', $category->id) }}" method="POST"
                                                  id="deleteCategoryForm">
                                                @method('delete')
                                                @csrf
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel">Delete
                                                                Category</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p class="text-cetner">
                                                                Are you sure you want to delete {{ $category->name }}
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">No, Go back
                                                            </button>
                                                            <button type="submit" class="btn btn-danger">Yes, Delete
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
                        {{ $categories->links() }}
                    </div>
                </div>
                <hr>
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">สร้างกลุ่มวิชา</h4>
                </div>
                        <div class="card-body">
                            <form action="{{ route('category.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="สร้างกลุ่มข้อสอบ" name="name" value="{{ old('name') }}" required>
                                </div>
                                <div class="form-group text-center">
                                    <button class="btn btn-primary th">สร้าง</button>
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