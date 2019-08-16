@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Result</div>
                    <div class="card-body">

                        @forelse($results as $result)
                            <h4 class="text-center">{{ $result[0]->quiz->category->name }}</h4>

                            <table class="table table-bordered table-sm text-center">
                                <tr>
                                    <th>Number</th>
                                    <th>Name Quiz</th>
                                    <th>Score</th>
                                    <th>Date</th>
                                </tr>
                                @foreach($result as $res)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <th>{{ $res->quiz->name }}</th>
                                        <th>{{ $res->score }}</th>
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