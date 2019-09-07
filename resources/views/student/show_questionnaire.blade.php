@extends('layouts.student')
@section('head')
    <style>
        th {
            background-color: rgb(1, 118, 192);
            color: white;
        }
    </style>
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">{{ $questionnaire->name }}</h4>
                </div>
                <form action="{{ route('student.store_questionnaire', $questionnaire->id) }}" method="POST"
                      id="form-submitp">
                    @csrf
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-10">
                                    <table class="table table-bordered" style="">
                                        <tr>
                                            <td></td>
                                            @forelse($questionnaire->option_questionnaires as $option_questionnaires)
                                                <td class="text-center" style="width: 8%;">{{ $option_questionnaires->option }}</td>
                                            @empty
                                                <td class="text-center"> Not Options</td>
                                            @endforelse
                                        </tr>
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach($phase_questionnaires as $phase_questionnaire)

                                        @foreach($phase_questionnaire->question_phase_questionnaires as $question)
                                            <tr>
                                                <td class="">
                                                    {{++$i}}. {{ $question->name }}
                                                </td>
                                                @forelse($questionnaire->option_questionnaires as $option)
                                                    <td class="text-center">
                                                        <input type="radio"
                                                            name="answers[{{$phase_questionnaire->id}}][{{$question->group_questionnaire_id}}][{{$question->id}}]"
                                                                                   value="{{ $option->id }}"
                                                                                   required/>
                                                    </td>
                                                @empty
                                                    <td class="text-center">Not Options</td>
                                                @endforelse
                                            </tr>
                                        @endforeach
                                        @endforeach
                                    </table>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('script')

@endsection

