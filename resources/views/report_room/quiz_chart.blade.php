@extends('layouts.app',['activePage' => 'report_room', 'titlePage' => __('ผลการทำแบบทดสอบ')])
@section('css')
    {!! Charts::assets() !!}
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{ __('คะแนนสอบของนักเรียน') }}</h4>
                            <p class="card-category"> {{ __('เลือกข้อสอบที่ต้องการดูผลการทดสอบ') }}</p>
                        </div>
                        <div class="card-body">
                            @if(!empty($chart))
                                {!! $chart->render() !!}
                            @else
                                <h4 class="text-center">Not Test</h4>
                            @endif
                        </div>
                        <div class="text-right">
                            <p>นักเรียนทั้งหมด {{ $student_count['all'] }}</p>
                            <p>นักเรียนที่ทำข้อสอบแล้ว {{ $student_count['test'] }}</p>
                            <p>นักเรียนที่ยังไม่ได้ทำข้อสอบ{{ $student_count['not_test'] }}</p>
                            <p>ผลลัพธ์เฉลี่ย {{  $student_count['avg']  }}</p>
                        </div>


                    </div>
                    <div class="content">
                        <div class="container-fluid">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title ">{{ __('ตารางแสดงคะแนนสอบของนักเรียน') }}</h4>
                                </div>
                                <table id="example" class="table table-bordered table-striped-column">
                                    <thead>
                                    <tr>
                                        <th class="text-center">ลำดับ</th>
                                        <th class="text-center">ชื่อ</th>
                                        <th class="text-center">คะแนน</th>
                                        <th class="text-center">ผลลัพธ์</th>
                                        <th class="text-center">ดูคำตอบ</th>
                                        <th class="text-center">ดูโปรไฟล์</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($results as $result)

                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $result->user->name }}</td>
                                            <td class="text-center">{{ $result->score}}</td>
                                            <td class="text-center">{{ $result->result_measurement()}}</td>
                                            <td class="text-center"><a
                                                        href="{{route('student.result_quiz',$result)}}">Click</a></td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection

@section('script')

@endsection