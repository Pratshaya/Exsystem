@extends('layouts.app',['activePage' => 'question', 'titlePage' => __('เกณฑ์ข้อสอบแบบตัวเลือก')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">รายการเกณฑ์ของข้อสอบ</h4>
                </div>
                    <div class="card-body">
                        <form action="{{ route('measurement_quiz.update',$measurement->id) }}"
                              method="POST">
                            @method('PUT')
                            @csrf

                            <div class="input-group">

                                <input type=" number" class="form-control text-center"
                                       placeholder="Score Min"
                                       name="score_min"
                                       value="{{ isset($measurement->score_min) ? $measurement->score_min : '' }}" required>
                                <input type="number" class="form-control text-center" placeholder="Score Max"
                                       name="score_max"
                                       value="{{ isset($measurement->score_max) ? $measurement->score_max : '' }}" required>
                                <label for="">&nbsp;&nbsp; = &nbsp;&nbsp;</label>
                                <input type="text" class="form-control text-center" placeholder="What ?"
                                       name="result"
                                       value="{{ isset($measurement->result) ? $measurement->result : '' }}" required>
                            </div>
                            <br>
                            <div class="form-group text-center">
                                <button class="btn btn-primary">บันทึก</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
