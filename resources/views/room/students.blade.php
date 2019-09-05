@extends('layouts.app',['activePage' => 'quiz_q', 'titlePage' => __('room')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">รายการห้องสอบ</h4>
                </div>
                    <div class="card-body">
                        <table id="example" class="table table-bordered table-striped-column">
                            <thead>
                            <tr>
                                <th class="text">ชื่อ</th>
                                <th>การจัดการนักเรียน</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td class="text">{{ $user->name }}</td>
                                    <td>
                                        <a class="btn btn-primary" href=" {{ route('result.result_show', $user->id)}} ">สถานะการสอบ</a>
                                        <a class="btn btn-primary" href="{{ route('result.chart', $user->id) }}">ดูแผนภูมิ</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>

    </script>
@endsection