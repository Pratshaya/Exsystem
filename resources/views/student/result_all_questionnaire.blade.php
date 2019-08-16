@extends('layouts.student')
@section('head')


@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Your score</div>
                    <div class="card-body">
                        @foreach($results as $result)
                            <h4 class="text-center">ประเภท {{ $result[0]->questionnaire->category->name  }}</h4>
                            @foreach($result as $questionnaire)
                                <table class="table table-bordered table-sm text-center">
                                    <tr>
                                        <th colspan="5">Questionnaire ครั้งที่ {{ $loop->iteration }}</th>
                                    </tr>
                                    <tr>
                                        <th>Phase</th>
                                        <th>Score</th>
                                        <th>Result</th>
                                        <th>Date</th>
                                        <th>Answer</th>
                                    </tr>
                                    @foreach($questionnaire->result_phase_questionnaire as $phase)
                                        <tr>
                                            <td>{{ $phase->phase_questionnaire->name }}</td>
                                            <td>{{ $phase->score }}</td>
                                            <td>{{ !empty($phase->result_measurement())?  $phase->result_measurement() : 'ไม่ตรงกับการประเมิน' }}</td>
                                            <td>{{ $questionnaire->created_date }}</td>
                                            @if($loop->iteration == 1)
                                                <td rowspan="{{ $questionnaire->result_phase_questionnaire->count() }}"
                                                    class="align-middle"><a
                                                            href="{{route('student.result_questionnaire', $questionnaire)}}">Result</a>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </table>
                            @endforeach
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection