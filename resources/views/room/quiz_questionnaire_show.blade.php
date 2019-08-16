@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Category</div>
                    <div class="card-body">
                        <table id="example" class="table table-bordered table-striped-column">
                            <thead>
                            <tr>
                                <th colspan="2" class="text-center">แบบสอบถาม</th>
                            </tr>
                            <tr>
                                <th class="text-center" style="width: 80%;">Name</th>
                                <th class="text-center">Action</th>
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
                                <th colspan="2" class="text-center">คำถาม</th>
                            </tr>
                            <tr>
                                <th class="text-center" style="width: 80%;">Name</th>
                                <th class="text-center">Action</th>
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
            </div>
        </div>
        <hr>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">เพิ่มข้อสอบแบบ/สอบถาม</div>
                <div class="card-body">
                    <form action="{{ route('quiz_questionnaire.store',$room->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="questionnaires">Quiz</label>
                            <select name="quizzes[]" id="quizzes" class="form-control" multiple>
                                @foreach ($quizzes as $quiz)
                                    @if(!$quiz->hasRoom($room))
                                        <option value="{{ $quiz->id }}">{{ $quiz->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="questionnaires">Questionnaire</label>
                            <select name="questionnaires[]" id="questionnaires" class="form-control" multiple>
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet"/>
@endsection