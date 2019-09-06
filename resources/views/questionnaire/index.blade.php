@extends('layouts.app',['activePage' => 'questionnaire', 'titlePage' => __('แบบสอบถาม')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">รายการ
                        <span class="float-right">
                        <a class="fas fa-plus" data-toggle="modal" data-target="#modal-create"></a>
                        </span>
                    </h4>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-bordered table-striped-column">
                        <thead>
                        <tr>
                            <th class="text-center">ชื่อ</th>
                            <th class="text-center">จัดการแบบสอบถาม</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($questionnaires as $questionnaire)
                            <tr>
                                <th class="text-center">{{ $questionnaire->name }}</th>
                                <th class="text-center">
                                    <a class="btn btn-success btn-link"
                                       href="{{ route('questionnaire.edit',$questionnaire->id) }}">
                                        <i class="material-icons">edit</i>
                                    </a>
                                    <button class="btn btn-danger btn-link"
                                            onClick="handleDelete({{ $questionnaire->id }})">
                                        <i class="material-icons">delete</i>
                                    </button>

                                    <div class="modal fade" id="deleteModal{{$questionnaire->id}}" tabindex="-1"
                                         role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <form action="{{ route('questionnaire.destroy', $questionnaire->id) }}"
                                              method="POST"
                                              id="deleteQuizForm">
                                            @method('delete')
                                            @csrf
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">ลบแบบสอบถาม</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="text-cetner">
                                                            คุณต้องการลบแบบสอบถาม {{ $questionnaire->name }} ใช่หรือไม่
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">ไม่ต้องการ
                                                        </button>
                                                        <button type="submit" class="btn btn-danger">ใช่
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
                    {{ $questionnaires->links() }}
                    <div class="text-center">
                        <a href="{{route('phase_questionnaire.index')}}" class="btn btn-primary">ต่อไป</a>
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
                                    <h4 class="card-title">สร้างแบบสอบถาม
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span  aria-hidden="true"><a class="fas fa-close" data-toggle="modal" data-target="#modal-close"></a></span>
                                        </button></h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('questionnaire.store') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="ชื่อแบบสอบถาม"
                                                   name="name"
                                                   value="{{ old('name') }}" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="รายละเอียดของแบบสอบถาม"
                                                   name="detail" value="{{ old('detail') }}" required>
                                        </div>
                                        <div class="form-group">
                                            <select name="category_id" class="form-control">
                                                <option value="0">กรุณาเลือกกลุ่มของแบบสอบถาม</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select name="type" class="form-control">
                                                <option value="0">กรุณาเลือกชนิดของแบบสอบถาม</option>
                                                <option value="S">วัดผลเฉพาะคะแนนรวม</option>
                                                <option value="P">วัดผลเฉพาะคะแนนแต่ละด้าน</option>
                                                <option value="SP">วัดผลคะแนนรวมและคะแนนแต่ละด้าน</option>
                                            </select>
                                        </div>
                                        <div class="form-group text-center">
                                            <button class="btn btn-primary">สร้างแบบสอบถาม</button>
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