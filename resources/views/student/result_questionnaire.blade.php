@extends('layouts.student')
@section('head')
    <style type="text/css"> th {
            background-color: rgb(1, 118, 192);
        !important;
            color: white;
        !important;
        }
    </style>

@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">{{ $result->questionnaire->name }}</h4>
                </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-10">
                                    <table class="table table-bordered">
                                            <tr>
                                                    <td></td>
                                                    @foreach($questionnaire->option_questionnaires as $option_questionnaires)
                                                        <td class="text-center" style="width: 8%;">{{ $option_questionnaires->option }}</td>
                                                    @endforeach
                                                </tr>
                                                @foreach($phase_questionnaire as $answer)
                                                @foreach($answer->result_detail_questionnaires as $phase_questionnaire)
                                                <tr>
{{--
                                                    {{ dd($phase_questionnaire->question_phase_questionnaire->name )}}
--}}
                                                        <td class="text-left">
                                                                {{$loop->iteration}}. {{ $phase_questionnaire->question_phase_questionnaire->name }}
                                                            </td>
                                                            @foreach($questionnaire->option_questionnaires as $option_questionnaires)
                                                            <td class="text-center" style="width: 8%;">
                                                                <input type="radio"
                                                                        name="answers[{{$phase_questionnaire->id}}][{{$answer->id}}]"
                                                                        value="{{ $option_questionnaires->id }}"
                                                                        @if($phase_questionnaire->option_questionnaire_id == $option_questionnaires->id)
                                                                        checked
                                                                        @endif
                                                                        disabled
                                                                />
                                                             </td>
                                                             @endforeach
                                                </tr>
                                                @endforeach
                                                   @endforeach

                                    </table>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <a href="{{ route('student.room') }}" class="btn btn-primary">กลับ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

