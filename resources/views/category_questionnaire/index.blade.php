@extends('layouts.app',['activePage' => 'category_q', 'titlePage' => __('แบบสอบถาม')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">กลุ่มของแบบสอบถามที่มี</h4>
                </div>
                    <div class="card-body">
                        <table id="example" class="table table-bordered table-striped-column">
                            <thead>
                            <tr>
                                <th class="text-center">ชื่อกลุ่มแบบสอบถาม</th>
                                <th class="text-center">จัดการแบบสอบถาม</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <th class="text-center">{{ $category->name }}</th>
                                    <th class="text-center">
                                        <a class="btn btn-success btn-link" href="{{ route('category_questionnaire.edit',$category->id) }}">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <button class="btn btn-danger btn-link" onClick="handleDelete({{ $category->id }})">
                                            <i class="material-icons">delete</i>
                                        </button>
                                        <div class="modal fade" id="deleteModal{{$category->id}}" tabindex="-1"
                                             role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <form action="{{ route('category_questionnaire.destroy', $category->id) }}" method="POST"
                                                  id="deleteCategoryForm">
                                                @method('delete')
                                                @csrf
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel">ลบกลุ่มแบบสอบถาม</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p class="text-cetner">
                                                                คุณต้องการลบ {{ $category->name }} ใช่หรือไม่
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">ไม่ลบ
                                                            </button>
                                                            <button type="submit" class="btn btn-danger">ใช่ ต้องการลบ
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
                        <div class="text-center" >
                            <a href="{{route('questionnaire.index')}}" class="btn btn-primary">ต่อไป</a>
                        </div>
                    </div>
                </div>
                <hr>
            <div class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">สร้างกลุ่มแบบสอบถาม</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('category_questionnaire.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="ชื่อกลุ่มแบบสอบถาม" name="name" value="{{ old('name') }}" required>
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