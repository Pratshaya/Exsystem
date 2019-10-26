@extends('layouts.app',['activePage' => 'room', 'titlePage' => __('room')])

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
                                <th class="text">ชื่อนักเรียน</th>
                                <th>ข้อมูล</th>
                                <th>{{ __('อีเมลล์') }}</th>
                                <th>{{ __('วิทยาเขต') }}</th>
                                <th>{{ __('คณะ') }}</th>
                                <th>{{ __('ภาควิชา') }}</th>
                                <th>{{ __('สาขาวิชา') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td class="text">{{ $user->name }}</td>
                                    <td>
                                        @if($user->hasRole('user'))
                                        <a class="btn btn-primary" href=" {{ route('result.result_show', $user->id)}} ">สถานะการสอบ</a>
                                        <a class="btn btn-primary" href="{{ route('result.chart', $user->id) }}">ดูแผนภูมิ</a>
                                            @endif
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->departments->faculties->campuses->name }}</td>
                                    <td>{{ $user->departments->faculties->name }}</td>
                                    <td>{{ $user->departments->name  }}</td>
                                    <td>{{ $user->branches->name  }}</td>
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