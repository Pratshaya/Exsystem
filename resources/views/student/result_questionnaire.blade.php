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
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3 class="text-center">{{ $result->questionnaire->name }}</h3></div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-10">
                                @foreach($phase_questionnaires as $phase_questionnaire)
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="text-center"
                                                colspan="
                                            @if($phase_questionnaire->phase_questionnaire->option_phase_questionnaires->count() > 1)
                                                {{$phase_questionnaire->phase_questionnaire->option_phase_questionnaires->count() +1}}
                                                @else
                                                {{ 2 }}
                                                @endif">{{ $phase_questionnaire->phase_questionnaire->detail }}</th>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            @forelse($phase_questionnaire->phase_questionnaire->option_phase_questionnaires as $option)
                                                <td class="text-center">{{ $option->name }}</td>
                                            @empty
                                                <td class="text-center"> Not Options</td>
                                            @endforelse
                                        </tr>
                                        @foreach($phase_questionnaire->result_detail_questionnaires as $answer)
                                            <tr>
                                                <td class="text-center">
                                                    {{$loop->iteration}}
                                                    . {{ $answer->question_phase_questionnaire->name }}
                                                </td>
                                                @foreach($phase_questionnaire->phase_questionnaire->option_phase_questionnaires as $option)
                                                    <td class="text-center">
                                                        <input type="radio"
                                                               name="answers[{{$phase_questionnaire->id}}][{{$answer->id}}]"
                                                               value="{{ $option->id }}"
                                                               @if($answer->option_phase_questionnaire_id == $option->id)
                                                               checked
                                                               @endif
                                                               disabled
                                                        />
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </table>
                                    <hr>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <a href="{{ route('student.result_all_questionnaire') }}" class="btn btn-primary">กลับ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

