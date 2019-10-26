@extends('layouts.app',['activePage' => 'quiz_q', 'titlePage' => __('ผลสอบนักเรียน')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">รายการการสอบของ {{ $user->name }}</h4>
                </div>
                    <div class="card-body">
                    @forelse($results as $result)
                            <h4 class="text-center">ประเภท {{ $result[0]->questionnaire->category->name  }}</h4>
                            @foreach($result as $questionnaire)
                                <table class="table table-bordered table-sm text-center">
                                    <tr>
                                        <th colspan="5">{{$questionnaire->questionnaire->name}} ครั้งที่ {{ $questionnaire->num }}</th>
                                    </tr>
                                    <tr>
                                        <th>Phase</th>
                                        <th>Score</th>
                                        <th>Result</th>
                                        <th>Date</th>
                                    </tr>
                                    @foreach($questionnaire->result_phase_questionnaire as $phase)
                                        <tr>
                                            <td>{{ $phase->phase_questionnaire->name }}</td>
                                            <td>{{ $phase->score }}</td>
                                            <td>{{ !empty($phase->result_measurement())?  $phase->result_measurement() : 'ไม่ตรงกับการประเมิน' }}</td>
                                            <td>{{ $questionnaire->created_date }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td class="text-center">รวม</td>
                                        <td class="text-center">{{$questionnaire->score}}</td>
                                        <td class="text-center">{{$questionnaire->result_measurement()}}</td>
                                    </tr>
                                </table>
                            @endforeach
                            <hr>
                        @empty
                            <h4 class="text-center">ยังไม่มีการสอบ</h4>
                        @endforelse
                    </div>
                </div>
@endsection