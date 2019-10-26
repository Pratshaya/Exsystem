@extends('layouts.app',['activePage' => 'quiz', 'titlePage' => __('ข้อสอบแบบตัวเลือก')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="prostep2">
                    <ul>
                        <li>
                            <img src="{{ asset('images\icons\folder.png') }}" alt="ขั้นตอนแรก"><br>
                            <i class="fa"></i>
                            <p>กลุ่มวิชา</p>
                        </li>
                        <li>
                            <img src="{{ asset('images\icons\note.png') }}" alt=""><br>
                            <i class="fa"></i>
                            <p>สร้างข้อสอบ</p>
                        </li>
                        {{--<li>
                            <img src="{{ asset('images\icons\portfolio.png') }}" alt=""><br>
                            <i class="fa fa-times"></i>
                            <p>การจัดการ</p>
                        </li>--}}
                        <li>
                            <img src="{{ asset('images\icons\file.png') }}" alt=""><br>
                            <i class="fa"></i>
                            <p>สร้างคำถาม</p>
                        </li>
                        <li>
                            <img src="{{ asset('images\icons\business-presentation.png') }}" alt=""><br>
                            <i class="fa"></i>
                            <p>สร้างการแปลผล</p>
                        </li>
                        <li>
                            <img src="{{ asset('images\icons\origami.png') }}" alt=""><br>
                            <i class="fa"></i>
                            <p>ตรวจสอบและเผยแพร่</p>
                        </li>
                    </ul>
                </div>
                <div class="card-header card-header-primary">
                    <h4 class="card-title">รายการข้อสอบที่มี
                        <span class="float-right">
                        <a class="fas fa-plus" data-toggle="modal" data-target="#modal-create"></a>
                        </span>
                    </h4>
                </div>

                <div class="card-body">
                    <table id="example" class="table table-bordered table-striped-column display dataTable">
                        <thead>
                        <tr>
                            <th class="text-center">ชื่อข้อสอบ</th>
                            <th class="text-center">ชื่อวิชา</th>
                            <th class="text-center">รายละเอียดข้อสอบ</th>
                            <th class="text-center">จำนวนข้อ</th>
                            <th class="text-center">จัดการข้อสอบ</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($quizzes as $quiz)
                            <tr>
                                <th class="text-center">{{ $quiz->name }}</th>
                                <th class="text-center">{{ $quiz->category->name }}</th>
                                <th class="text-center">{{ $quiz->detail }}</th>
                                <th class="text-center"> {{ $quiz->questions()->count() }} ข้อ</th>
                                <th class="text-center">
                                    @if($quiz->type == 'O')
                                        <a href="{{ route('objective.create', $quiz->id) }}" class="btn btn-primary">เพิ่มวัตถุประสงค์</a>
                                    @endif
                                    <a href="{{ route('question.show', $quiz->id) }}"
                                       class="btn btn-primary">สร้างคำถาม</a>
                                    @if($quiz->questions()->count()>=1)
                                        <a href="{{ route('measurement_quiz.show', $quiz->id) }}"
                                           class="btn btn-primary">สร้างเกณฑ์การให้คะแนน</a>
                                        @if(!$quiz->measurement_quizzes->isEmpty())
                                            <a href="{{ route('publish_quiz.show', $quiz->id) }}"
                                               class="btn btn-primary">การเผยแพร่</a>
                                        @endif
                                    @endif

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
                </div>
            </div>
            <hr>
            <div class="modal" tabindex="-1" role="dialog" id="modal-create">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title">สร้างชื่อของข้อสอบ
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true"><a class="fas fa-close" data-toggle="modal"
                                                                        data-target="#modal-close"></a></span>
                                        </button>
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('quiz.store') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="ชื่อข้อสอบ" name="name"
                                                   value="{{ old('name') }}" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="รายละเอียดข้อสอบ"
                                                   name="detail"
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
                                        <div class="form-group">
                                            <select name="type" class="form-control">
                                                <option value="O">มีวัตถุประสงค์</option>
                                                <option value="N">ไม่มีวัติถุประสงค์</option>
                                            </select>
                                        </div>

                                        @if(Auth::user()->hasRole('administrator'))
                                            <div class="form-group">
                                                <select name="department_id" class="form-control">
                                                    @foreach($departments as $department)
                                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endif

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
        </div>
    </div>
@endsection
@section('script')
    <script>
        function handleDelete(id) {
            $('#deleteModal' + id).modal('show');
        }
    </script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>

        $(document).ready(function () {
            $('.dataTable').DataTable();
        });
    </script>
@endsection