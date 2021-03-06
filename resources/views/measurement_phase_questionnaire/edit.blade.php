@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit Quiz</div>
                    <div class="card-body">
                        <form action="{{ route('measurement_phase_questionnaire.update',$measurement->id) }}"
                              method="POST">
                            @method('PUT')
                            @csrf

                            <div class="input-group">
                                <select name="phase_questionnaire_id" class="form-control">
                                    <option value="0">Select Category</option>
                                    @foreach($phase_questionnaires as $phase_questionnaires)
                                        <option value="{{ $phase_questionnaires->id }}"
                                                @if($phase_questionnaires->id === $measurement->phase_questionnaire_id)
                                                selected
                                                @endif>{{ $phase_questionnaires->name }}</option>
                                    @endforeach
                                </select>

                                <input type=" number" class="form-control text-center"
                                       placeholder="Score Min"
                                       name="score_min"
                                       value="{{ isset($measurement->score_min) ? $measurement->score_min : '' }}"  required>
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
