@extends('layouts.app',['activePage' => 'quiz', 'titlePage' => __('ข้อสอบแบบตัวเลือก')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">รายการข้อสอบที่มี</h4>
                </div>
                    <div class="card-body">
                        <table id="example" class="table table-bordered table-striped-column">
                            <thead>
                            <tr>
                                <th class="text-center">ชื่อข้อสอบ</th>
                                <th class="text-center">จัดการข้อสอบ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($quizzes as $quiz)
                                <tr>
                                    <th class="text-center">{{ $quiz->name }}</th>
                                    <th class="text-center">
                                        <a class="btn btn-success btn-link" href="{{ route('quiz.edit',$quiz->id) }}">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <button class="btn btn-danger btn-link" onClick="handleDelete({{ $quiz->id }})">
                                            <i class="material-icons">delete</i>
                                        </button>

                                        <div class="modal fade" id="deleteModal{{$quiz->id}}" tabindex="-1"
                                             role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <form action="{{ route('quiz.destroy', $quiz->id) }}" method="POST"
                                                  id="deleteQuizForm">
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
                                                               คุณต้องการลบ {{ $quiz->name }} หรือไม่
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
                        {{ $quizzes->links() }}
                        <div class="text-center" >
                            <a href="{{route('question.index')}}" class="btn btn-primary">ต่อไป</a>
                        </div>
                    </div>
                </div>
                <hr>
            <div class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">สร้างชื่อของข้อสอบ</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('quiz.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="ชื่อข้อสอบ" name="name"
                                           value="{{ old('name') }}" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="รายละเอียดข้อสอบ" name="detail"
                                           value="{{ old('detail') }}" required>
                                </div>
                                <div class="form-group">
                                    <select name="category_id" class="form-control">
                                        <option value="0">โปรดเลือกวิชาของข้อสอบ</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
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