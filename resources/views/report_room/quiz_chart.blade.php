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
                                <h4 class="text-center">ยังไม่มีการทำข้อสอบ</h4>
                            @endif
                        </div>
                        <div class="text-right mr-3">
                            <p>นักเรียนทั้งหมด {{ $student_count['all'] }} คน</p>
                            <p>นักเรียนที่ทำข้อสอบแล้ว {{ $student_count['test'] }} คน</p>
                            <p>นักเรียนที่ยังไม่ได้ทำข้อสอบ{{ $student_count['not_test'] }} คน</p>
                            <p>ผลลัพธ์เฉลี่ย {{  $student_count['avg']  }} คะแนน</p>
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
                                            <td class="text-center">
                                                <span>
                        <a data-toggle="modal" data-target="#modal-answer">
                            <button class="btn btn-info btn-link">
                                <i class="material-icons">search</i>
                                คลิ้กเพื่อดู
                            </button>
                        </a>
                        </span>
                                            </td>
                                            <td class="text-center">
                        <span>
                        <a data-toggle="modal" data-target="#modal-profile">
                            <button class="btn btn-info btn-link">
                                <i class="material-icons">accessibility</i>
                                คลิ้กเพื่อดู
                            </button>
                        </a>
                        </span>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal" tabindex="-1" role="dialog" id="modal-answer">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                @foreach($result_detail as $key => $result)
                                    <div class="card mt-2">
                                        <div class="card-body">
                                            <h6>{{ $key+1 }}. {{$result->question->name}}</h6>
                                            <hr>
                                            <ul>
                                                @foreach($result->question->options as $option)
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="{{ $option->id }}"
                                                               name="ch[{{$result->question->id}}]"
                                                               value="{{ $option->id }}"
                                                               class="custom-control-input"
                                                               @if($option->id == $result->option->id)
                                                               checked
                                                               @endif
                                                               disabled>
                                                        <label class="custom-control-label"
                                                               for="{{$option->id}}">{{ $option->name }}</label>
                                                    </div>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal" tabindex="-1" role="dialog" id="modal-profile">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">

                                <table id="example" class="table table-bordered table-striped-column">
                                    <thead>
                                    <tr>
                                        <th class="text-center">ข้อมูลส่วนตัว</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr>
                                        <td class="text-left">ชื่อ</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left"> อีเมลล์</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left"> เลขบัตรประจำตัวประชาชน</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left"> รหัสนักศึกษา</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <a class="btn btn-primary">Result</a>
                                            <a class="btn btn-primary">Chart</a>
                                        </td>
                                    </tr>

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