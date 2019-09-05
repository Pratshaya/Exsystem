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
                                @foreach($phase_questionnaires as $phase_questionnaire)
                                    <table class="table table-bordered" style="">
                                        <tr>
                                            <th class="text-center" style=" border: 1px solid #0b0b0b;"
                                                colspan="
                                            @if($phase_questionnaire->option_phase_questionnaires->count() > 1)
                                                {{$phase_questionnaire->option_phase_questionnaires->count() +1}}
                                                @else
                                                {{ 2 }}
                                                @endif">{{ $phase_questionnaire->name }}</th>
                                        </tr>
                                        <tr>
                                            <td class="text-center"
                                                colspan="
                                            @if($phase_questionnaire->option_phase_questionnaires->count() > 1)
                                                {{$phase_questionnaire->option_phase_questionnaires->count() +1}}
                                                @else
                                                {{ 2 }}
                                                @endif">{{ $phase_questionnaire->detail }}</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            @forelse($phase_questionnaire->option_phase_questionnaires as $option)
                                                <td class="text-center" style="width: 8%;">{{ $option->name }}</td>
                                            @empty
                                                <td class="text-center"> Not Options</td>
                                            @endforelse
                                        </tr>
                                        @foreach($phase_questionnaire->question_phase_questionnaires as $question)
                                            <tr>
                                                <td class="">
                                                    {{$loop->iteration}}. {{ $question->name }}
                                                </td>
                                                @forelse($phase_questionnaire->option_phase_questionnaires as $option)
                                                    <td class="text-center"><input type="radio"
                                                                                   name="answers[{{$phase_questionnaire->id}}][{{$question->id}}]"
                                                                                   value="{{ $option->id }}"
                                                                                   required/>
                                                    </td>
                                                @empty
                                                    <td class="text-center">Not Options</td>
                                                @endforelse
                                            </tr>
                                        @endforeach
                                    </table>
                                    <hr>
                                @endforeach
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

