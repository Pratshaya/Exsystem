@extends('layouts.app',['activePage' => 'category', 'titlePage' => __('ข้อสอบแบบตัวเลือก')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">รายการวิชาที่มี
                        <span class="float-right">
                        <a class="fas fa-plus" data-toggle="modal" data-target="#modal-create"></a>
                        </span></h4>
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
                                    <a class="btn btn-success btn-link"
                                       href="{{ route('category.edit',$category->id) }}">
                                        <i class="material-icons">edit</i>
                                    </a>
                                    <button class="btn btn-danger btn-link" onClick="handleDelete({{ $category->id }})">
                                        <i class="material-icons">delete</i>
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
                                                        <h5 class="modal-title" id="deleteModalLabel">
                                                            หน้าต่างลบกลุ่มวิชา</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="text-cetner">
                                                            คุณต้องการลบวิชา {{ $category->name }} หรือไม่ ?
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">ไม่ต้องการลบ
                                                        </button>
                                                        <button type="submit" class="btn btn-danger">ใช่ ฉันต้องการลบ
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
                    <div class="text-center">
                        <a href="{{route('quiz.index')}}" class="btn btn-primary">ต่อไป</a>
                    </div>

                </div>
            </div>
            <hr>
            <div class="modal" tabindex="-1" role="dialog" id="modal-create">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title">สร้างกลุ่มวิชา <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span  aria-hidden="true"><a class="fas fa-close" data-toggle="modal" data-target="#modal-close"></a></span>
                                        </button></h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('category.store') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="สร้างกลุ่มข้อสอบ"
                                                   name="name"
                                                   value="{{ old('name') }}" required>
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