@extends('layouts.app',['activePage' => 'category_q', 'titlePage' => __('แบบสอบถาม')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">สร้างกลุ่มและตัวเลือก
                        <span class="float-right">
                        <a class="fas fa-plus" data-toggle="modal" data-target="#modal-create"></a>
                        </span>
                    </h4>
                </div>
                <div class="card-body">

                        @foreach($questionnaire->group_questionnaires as $group_questionnaire)
                        <table id="example" class="table table-bordered table-striped-column">
                            <thead>
                                <tr>
                                        <th class="text-center" colspan="3"><h4 class="text-center">กลุ่ม - {{ $group_questionnaire->name }}  
                                             </h4></th>
                                </tr>
                            <tr>
                             
                                <th class="text-center">ชื่อตัวเลือก</th>
                                <th class="text-center">คะแนน</th>
                                <th class="text-center">ตัวเลือก</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($group_questionnaire->group_option_questionnaires as $option)
                                <tr>
                                    <th class="text-center">{{ $option->option_questionnaire->option }}</th>
                                    <th class="text-center">{{ $option->score }}</th>
                                    <th></th>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endforeach
                    @if(!$questionnaire->group_questionnaires->isEmpty())
                    <div class="text-center">
                        <a href="{{route('phase_questionnaire.create', $questionnaire->id)}}" class="btn btn-primary">ต่อไป</a>
                    </div>
                    @endif
                </div>
            </div>
            <hr>
            <div class="modal" tabindex="-1" role="dialog" id="modal-create">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title">สร้างกลุ่มแบบสอบถาม<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span  aria-hidden="true"><a class="fas fa-close" data-toggle="modal" data-target="#modal-close"></a></span>
                                        </button></h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('group_questionnaire.store', $questionnaire->id) }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                                <input type="text" class="form-control" placeholder="ชื่อกลุ่มแบบสอบถาม"
                                                       name="name" value="{{ old('name') }}" required>
                                            </div>
                                            @foreach($questionnaire->option_questionnaires as $option)
                                            <div class="input-group">
                                                    <label type="text" class="form-control text-center">{{$option->option}}</label>
                                                    <input type="number" class="form-control text-center"
                                                           placeholder="ระบุคะแนน"
                                                           name="scores[{{$option->id}}]"
                                                           value="" required>
                                                </div>
                                                @endforeach
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