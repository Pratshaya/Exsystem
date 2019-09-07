@extends('layouts.app',['activePage' => 'question', 'titlePage' => __('ข้อสอบแบบตัวเลือก')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">รายการข้อสอบที่มี</h4>
                </div>
                <div class="card-header"><a
                            href="{{route('phase_questionnaire.index')}}">{{$quiz->name }} </a> /
                    create measurement <span class="float-right"> </span>
                </div>
                <div class="card-body">

                    @if($quiz->questions->isEmpty())
                        <table id="example" class="table table-bordered table-striped-column">
                            <tr>
                                <td colspan="4" class="text-center">
                                    Not Found
                                    <br>
                                    You must to Create Phase & Option & Question
                                    <hr>
                                    <a class="buttons btn btn-info"
                                       href="{{route('measurement_quiz.show',$quiz->id)}}">Create</a>
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
                                <th class="text-center">Score Min</th>
                                <th class="text-center">Score Max</th>
                                <th class="text-center">WHAT</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($quiz->measurement_quizzes as $measurement)
                                <tr>
                                    <td class="text-center">{{ $measurement->score_min }}</td>
                                    <td class="text-center">{{ $measurement->score_max }}</td>
                                    <td class="text-center">{{ $measurement->result }}</td>
                                    <td class="text-center" style="width: 150px;">
                                        <a class="btn btn-info"
                                           href="{{route('measurement_questionnaire.edit',$measurement->id)}}">Edit
                                        </a>
                                        <form action="{{route('measurement_questionnaire.destroy', $measurement->id)}}"
                                              method="POST"
                                              style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-info btn-delete">Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <hr>
                    @endif
                </div>
            </div>
            <hr>
            <div class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">เกณฑ์การให้คะแนน</h4>
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
                                           placeholder="ระบุเกณฑ์ที่ได้ในช่วงคะแนนนี้"
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