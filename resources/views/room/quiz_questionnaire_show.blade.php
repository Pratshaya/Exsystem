@extends('layouts.app',['activePage' => 'room', 'titlePage' => __('รายการข้อสอบที่มีภายในห้อง')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">รายการข้อสอบในห้อง {{ $room->detail }}
                        <span class="float-right">
                        <a class="fas fa-plus" data-toggle="modal" data-target="#modal-create"></a>
                        </span></h4>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-bordered table-striped-column">
                        <thead>
                        <tr>
                            <th colspan="2" class="text-center">แบบสอบถาม</th>
                        </tr>
                        <tr>
                            <th class="text-center" style="width: 80%;">ชื่อแบบสอบถาม</th>
                            <th class="text-center">การจัดการข้อสอบ</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($room->room_questionnaires as $questionnaire)
                            <tr>
                                <td class="text-center">{{ $questionnaire->questionnaire->name }}</td>
                                <td class="text-center"><a class="btn btn-danger">นำออก</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <table id="example" class="table table-bordered table-striped-column">
                        <thead>
                        <tr>
                            <th colspan="2" class="text-center">ข้อสอบ</th>
                        </tr>
                        <tr>
                            <th class="text-center" style="width: 80%;">ชื่อของข้อสอบ</th>
                            <th class="text-center">การจัดการข้อสอบ</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($room->room_quizzes as $quiz)
                            <tr>
                                <td class="text-center">{{ $quiz->quiz->name }}</td>
                                <td class="text-center"><a class="btn btn-danger">นำออก</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12">
                <div class="modal" tabindex="-1" role="dialog" id="modal-create">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="card">
                                    <div class="card-header">เพิ่มข้อสอบ/แบบสอบถาม</div>
                                    <div class="card-body">
                                        <form action="{{ route('quiz_questionnaire.store',$room->id) }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="questionnaires">กรุณาเลือก<u>ข้อสอบ</u>เพื่อเพิ่ม</label><br>
                                                <select name="quizzes[]" id="quizzes" class="form-control" style="width: 250px;" multiple>
                                                    @foreach ($quizzes as $quiz)
                                                        @if(!$quiz->hasRoom($room))
                                                            <option value="{{ $quiz->id }}">{{ $quiz->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="questionnaires">กรุณาเลือก<u>แบบสอบถาม</u>เพื่อเพิ่ม</label><br>
                                                <select name="questionnaires[]" id="questionnaires" class="form-control" style="width: 250px;"
                                                        multiple>
                                                    @foreach ($questionnaires as $questionnaire)
                                                        @if(!$questionnaire->hasRoom($room))
                                                            <option value="{{ $questionnaire->id }}">{{ $questionnaire->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">

                                            </div>
                                            <div class="form-group text-center">
                                                <button class="btn btn-primary">เพิ่ม</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                @endsection
                @section('script')
                    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
                            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
                            crossorigin="anonymous"></script>

                    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
                    <script>
                        $(document).ready(function () {
                            $('#questionnaires').select2();
                        });
                        $(document).ready(function () {
                            $('#quizzes').select2();
                        });
                    </script>

                @endsection

                @section('css')
                    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css"
                          rel="stylesheet"/>
@endsection