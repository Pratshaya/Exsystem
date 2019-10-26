@extends('layouts.app',['activePage' => 'question', 'titlePage' => __('ข้อสอบแบบตัวเลือก')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header"><a
                            href="{{route('phase_questionnaire.index')}}">{{$quiz->name }} </a> /
                    สร้างเกณฑ์การให้คะแนนและการแปลผล <span class="float-right"> </span>
                </div>
                @if($quiz->type=='O')
                <div class="prostep6">
                    @else
                        <div class="prostep5">
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
                    <h4 class="card-title">รายการเกณฑ์ของข้อสอบ {{ $quiz->name }}
                        <span class="float-right">
                        <a class="fas fa-plus" data-toggle="modal" data-target="#modal-create"></a>
                        </span></h4>
                </div>

                <div class="card-body">

                    @if($quiz->questions->isEmpty())
                        <table id="example" class="table table-bordered table-striped-column">
                            <tr>
                                <td colspan="4" class="text-center">
                                    ไม่พบข้อมูล
                                    <br>
                                    กรุณาสร้างด้าน คำถามและตัวเลือกของข้อสอบก่อน
                                    <hr>
                                    @if($quiz->type=='N')
                                    <a class="buttons btn btn-info"
                                       href="{{route('question.show',$quiz->id)}}">กลับไปสร้างคำถาม
                                    </a>
                                        @else
                                        <a class="buttons btn btn-info"
                                           href="{{route('question.show_objective',$quiz->id)}}">กลับไปสร้างวัตถุประสงค์
                                        </a>
                                        @endif
                                </td>
                            </tr>
                        </table>
                    @else
                        <table id="example" class="table table-bordered table-striped-column">
                            <thead>
                            <tr>
                                <th colspan="4" class="text-center">คะแนนรวม</th>
                            </tr>
                            <tr>
                                <th class="text-center">คะแนนต่ำสุดในช่วง</th>
                                <th class="text-center">คะแนนสูงสุดในช่วง</th>
                                <th class="text-center">ผลแปรผล</th>
                                <th class="text-center">การจัดการ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($quiz->measurement_quizzes as $measurement)
                                <tr>
                                    <td class="text-center">{{ $measurement->score_min }}</td>
                                    <td class="text-center">{{ $measurement->score_max }}</td>
                                    <td class="text-center">{{ $measurement->result }}</td>
                                    <td class="text-center" style="width: 150px;">
                                        <a class="btn btn-success btn-link"
                                           href="{{route('measurement_quiz.edit',$measurement->id)}}">
                                            <i class="material-icons">edit</i>
                                        </a>

                                        <form action="{{route('measurement_quiz.destroy', $measurement->id)}}"
                                              method="POST"
                                              style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-link">
                                                <i class="material-icons">delete</i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <hr>
                    @endif

                        <div class="text-center">
                            @if(!$quiz->questions->isEmpty())
                            <a href="{{route('publish_quiz.show',$quiz->id)}}" class="btn btn-primary">ต่อไป</a>
                            @endif
                        </div>

                </div>

            </div>
            <hr>
            <div class="modal" tabindex="-1" role="dialog" id="modal-create">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title">สร้างกลุ่มวิชา <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span  aria-hidden="true"><a class="fas fa-close" data-toggle="modal" data-target="#modal-close"></a></span>
                                        </button></h4>
                                </div>
                        <div class="card-body">
                            <form action="{{ route('measurement_quiz.store',$quiz->id) }}"
                                  method="POST">
                                @csrf
                                <div class="input-group">

                                    <input type="number" class="form-control text-center"
                                           placeholder="ระบุคะแนนที่น้อยที่สุดในช่วง"
                                           name="score_min"
                                           value="{{ old('score_min') }}" required>
                                    <input type="number" class="form-control text-center"
                                           placeholder="ระบุคะแนนที่มากที่สุดในช่วง"
                                           name="score_max"
                                           value="{{ old('score_max') }}" required>
                                    <label for="">&nbsp;&nbsp; = &nbsp;&nbsp;</label>
                                    <input type="text" class="form-control text-center"
                                           placeholder="ระบุการแปรผลของช่วงคะแนนดังกล่าว"
                                           name="result"
                                           value="{{ old('result') }}" required>
                                </div>
                                <br>
                                <div class="form-group text-center">
                                    <button class="btn btn-primary">สร้างเกณฑ์</button>
                                </div>
                            </form>
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