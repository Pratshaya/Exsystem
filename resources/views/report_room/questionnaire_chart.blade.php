@extends('layouts.app',['activePage' => 'report_room', 'titlePage' => __('ผลการทำแบบสอบถาม')])
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
                            <h4 class="card-title ">{{ __('ผลการทำแบบสอบถามของนักเรียน') }}</h4>
                            <p class="card-category"> {{ __('') }}</p>
                        </div>
                        <div class="card-body">
                            @if(!empty($chart))
                                {!! $chart->render() !!}
                            @else
                                <h4 class="text-center">Not Test</h4>
                            @endif
                        </div>

                        <div class="text-right">
                            <p>นักเรียนทั้งหมด คน</p>
                            <p>นักเรียนที่ทำข้อสอบแล้ว คน</p>
                            <p>นักเรียนที่ยังไม่ได้ทำข้อสอบ คน</p>
                            <p>ผลลัพธ์เฉลี่ย คน</p>
                        </div>
                    </div>
                    <div class="content">
                        <div class="container-fluid">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title ">{{ __('ตารางแสดงคะแนนสอบของนักเรียน') }}</h4>
                                </div>

                                @if($questionnaire->type=='S')
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
                                                            href="">Click</a></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @endif

                                @if($questionnaire->type=='P')
                                    <table id="example" class="table table-bordered table-striped-column">
                                        <thead>
                                        <tr>
                                            <th class="text-center" rowspan="2">ลำดับ</th>
                                            <th class="text-center" rowspan="2">ชื่อ</th>
                                        @foreach($title as $phase_report)

                                            <th class="text-center" colspan="2">{{ $phase_report }}</th>
                                            @endforeach
                                            <th class="text-center" rowspan="2">ดูคำตอบ</th>
                                            <th class="text-center" rowspan="2">ดูโปรไฟล์</th>
                                        </tr>

                                        <tr>
                                            @foreach($title as $phase_report)
                                            <th class="text-center">คะแนน</th>
                                            <th class="text-center">ผลลัพธ์</th>
                                            @endforeach

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($array_report as $key => $report)
                                            <tr>
                                                <th class="text-center">{{ $loop->iteration }}</th>
                                                @foreach($report as $data)
                                                    <th class="text-center">{{ $data }}</th>
                                                @endforeach
                                                    <td></td>
                                                    <td></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @endif

                                @if($questionnaire->type=='SP')
                                    <table id="example" class="table table-bordered table-striped-column">
                                        <thead>
                                        <tr>
                                            <th class="text-center" rowspan="2">ลำดับ</th>
                                            <th class="text-center" rowspan="2">ชื่อ</th>
                                            @foreach($title as $phase_report)

                                                <th class="text-center" colspan="2">{{ $phase_report }}</th>
                                            @endforeach
                                            <th class="text-center" rowspan="2">คะแนนรวม</th>
                                            <th class="text-center" rowspan="2">แปรผลรวม</th>
                                            <th class="text-center" rowspan="2">ดูคำตอบ</th>
                                            <th class="text-center" rowspan="2">ดูโปรไฟล์</th>
                                        </tr>

                                        <tr>
                                            @foreach($title as $phase_report)
                                                <th class="text-center">คะแนน</th>
                                                <th class="text-center">ผลลัพธ์</th>
                                            @endforeach

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($array_report as $key => $report)
                                            <tr>
                                                <th class="text-center">{{ $loop->iteration }}</th>
                                                @foreach($report as $data)
                                                    <th class="text-center">{{ $data }}</th>
                                                @endforeach
                                                @foreach($results as $result)
                                                <td class="text-center">{{ $result->score}}</td>
                                                <td class="text-center">{{ $result->result_measurement()}}</td>
                                                @endforeach
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @endif

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        @endsection

        @section('script')
            <script>

            </script>
@endsection