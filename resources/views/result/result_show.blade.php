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
                            <h4 class="text-center">{{ $result[0]->quiz->category->name }}</h4>

                            <table class="table table-bordered table-sm text-center">
                                <tr>
                                    <th>ครั้งที่</th>
                                    <th>ชื่อข้อสอบ</th>
                                    <th>คะแนน</th>
                                    <th>การแปรผล</th>
                                    <th>วันที่สอบ</th>
                                </tr>
                                @foreach($result as $res)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <th>{{ $res->quiz->name }}</th>
                                        <th>{{ $res->score }}</th>
                                        <th>{{ $res->result_measurement()}}</th>
                                        <th>{{ $res->created_date }}</th>
                                    </tr>
                                @endforeach
                            </table>
                        @empty
                            <h4 class="text-center">ยังไม่มีการสอบ</h4>
                        @endforelse
                    </div>
                </div>
@endsection