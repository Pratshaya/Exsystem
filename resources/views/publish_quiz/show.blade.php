@extends('layouts.app',['activePage' => 'question', 'titlePage' => __('กลุ่มของแบบสอบถาม')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header"><a href="{{route('question.index')}}">Management</a> / Publish
                </div>
                @if($quiz->type=='O')
                    <div class="prostep7">
                        @else
                            <div class="prostep6">
                                @endif
                                <ul>
                                    <li>
                                        <img src="{{ asset('images\icons\folder.png') }}" alt="ขั้นตอนแรก"><br>
                                        <i class="fa"></i>
                                        <p>กลุ่มวิชา</p>
                                    </li>
                                    <li>
                                        <img src="{{ asset('images\icons\note.png') }}" alt=""><br>
                                        <i class="fa"></i>
                                        <p>สร้างข้อสอบ</p>
                                    </li>
                                    @if($quiz->type=='O')
                                        <li>
                                            <img src="{{ asset('images\icons\portfolio.png') }}" alt=""><br>
                                            <i class="fa"></i>
                                            <p>การจัดการ</p>
                                        </li>
                                    @endif
                                    <li>
                                        <img src="{{ asset('images\icons\file.png') }}" alt=""><br>
                                        <i class="fa"></i>
                                        <p>สร้างคำถาม</p>
                                    </li>
                                    <li>
                                        <img src="{{ asset('images\icons\business-presentation.png') }}" alt=""><br>
                                        <i class="fa"></i>
                                        <p>สร้างการแปลผล</p>
                                    </li>
                                    <li>
                                        <img src="{{ asset('images\icons\origami.png') }}" alt=""><br>
                                        <i class="fa"></i>
                                        <p>ตรวจสอบและเผยแพร่</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">รายการข้อสอบที่มี
                                </h4>
                            </div>
                            <div class="card">

                                <div class="card-body">
                                    <table id="example" class="table table-bordered table-striped-column">
                                        <thead>
                                        <tr>
                                            @if($quiz->publish)
                                                <th colspan="4" class="text-center"><a
                                                            href="{{route('student.show',$quiz)}}"
                                                            target="_blank">{{ $quiz->name }} (เผยแพร่แล้ว) </a>
                                                </th>
                                            @else
                                                <th colspan="4" class="text-center">{{ $quiz->name }} </th>
                                            @endif
                                        </tr>
                                        <tr>
                                            <th class="text-center">Type</th>
                                            <th class="text-center">สถานะการเผยแพร่</th>
                                            <th class="text-center">การกระทำ</th>
                                        </tr>
                                        <tr>
                                            <td class="text-center">{{ $quiz->type_quiz }}</td>

                                            <td class="text-center">
                                                @if(!$quiz->questions->isEmpty() && !$quiz->measurement_quizzes->isEmpty())
                                                    สามารถเผยแพร่ได้
                                                @else
                                                    ยังไม่สามารถเผยแพร่ได้
                                                    <ul>
                                                        <li>ไม่พบข้อสอบ</li>
                                                    </ul>
                                                @endif
                                            </td>

                                            <td class="text-center">
                                                @if(!$quiz->questions->isEmpty()&&!$quiz->measurement_quizzes->isEmpty())
                                                    <form action="{{route('publish_quiz.publish',$quiz)}}"
                                                          method="POST">
                                                        @method('PUT')
                                                        @csrf
                                                        @if(!$quiz->public)
                                                            <button type="submit"
                                                                    class="btn btn-primary">
                                                                สามารถเผยแพร่(คลิ้กเพื่อเผยแพร่)
                                                            </button>
                                                        @else
                                                            <button type="submit"
                                                                    class="btn btn-danger">ยกเลิกการเผยแพร่
                                                            </button>
                                                        @endif
                                                    </form>
                                                @else

                                                    @if($quiz->objectives->isEmpty())
                                                        <a href="{{route('question.show',$quiz)}}"
                                                           class="btn btn-danger">
                                                            กลับไปสร้างวัตถุประสงค์</a>
                                                    @elseif($quiz->questions->isEmpty())
                                                        <a href="{{route('question.show',$quiz)}}"
                                                           class="btn btn-danger">
                                                            กลับไปสร้างคำถาม</a>
                                                    @elseif($quiz->measurement_quizzes->isEmpty())
                                                        <a href="{{route('measurement_quiz.show',$quiz->id)}}"
                                                           class="btn btn-danger">
                                                            กลับไปสร้างเกณฑ์
                                                        </a>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                    <div class="form-group text-center">
                                        <a href="{{route('quiz.index')}}" type="button"
                                           class="btn btn-secondary px-5">กลับไปหน้าจัดการ</a>
                                    </div>
                                </div>
                            </div>
                    </div>
            </div>
        </div>

        @endsection
        @section('script')
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
            <script>
                <!-- DELETE-->
                $('.btn-delete').on('click', function (e) {
                    e.preventDefault();
                    const form = $(this).parents('form');
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.value) {
                            form.submit();
                        }
                    });
                });
            </script>

@endsection