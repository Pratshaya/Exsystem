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
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3 class="text-center">{{ $questionnaire->name }}</h3></div>
                    <form action="{{ route('student.store_questionnaire', $questionnaire->id) }}" method="POST"
                          id="form-submit">
                        @csrf
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-10">
                                    @foreach($phase_questionnaires as $phase_questionnaire)
                                        <table class="table table-bordered">
                                            <tr>
                                                <th class="text-center"
                                                    colspan="
                                            @if($phase_questionnaire->option_phase_questionnaires->count() > 1)
                                                    {{$phase_questionnaire->option_phase_questionnaires->count() +1}}
                                                    @else
                                                    {{ 2 }}
                                                    @endif">{{ $phase_questionnaire->detail }}</th>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                @forelse($phase_questionnaire->option_phase_questionnaires as $option)
                                                    <td class="text-center">{{ $option->name }}</td>
                                                @empty
                                                    <td class="text-center"> Not Options</td>
                                                @endforelse
                                            </tr>
                                            @foreach($phase_questionnaire->question_phase_questionnaires as $question)
                                                <tr>
                                                    <td class="text-center">
                                                        {{$loop->iteration}}. {{ $question->name }}
                                                    </td>
                                                    @forelse($phase_questionnaire->option_phase_questionnaires as $option)
                                                        <td class="text-center"><input type="radio"
                                                                                       name="answers[{{$phase_questionnaire->id}}][{{$question->id}}]"
                                                                                       value="{{ $option->id }}"
                                                                                       required/></td>
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

