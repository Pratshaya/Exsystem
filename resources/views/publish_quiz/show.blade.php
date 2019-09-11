@extends('layouts.app',['activePage' => 'questionnaire_mng', 'titlePage' => __('กลุ่มของแบบสอบถาม')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">รายการข้อสอบที่มี
                    </h4>
                </div>
                <div class="card">
                    <div class="card-header"><a href="{{route('question.index')}}">Management</a> / Publish</div>
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
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                            <tr>
                                <td class="text-center">{{ $quiz->type_quiz }}</td>

                                <td class="text-center">
                                    @if(!$quiz->questions->isEmpty() && !$quiz->measurement_quizzes->isEmpty())
                                        You can public
                                    @else
                                        You can't public
                                        <ul>
                                            <li>Question & Options Not Found</li>
                                        </ul>
                                    @endif</td>

                                <td class="text-center">
                                    @if(!$quiz->questions->isEmpty()&&!$quiz->measurement_quizzes->isEmpty())
                                        <form action="{{route('publish_quiz.publish',$quiz)}}"
                                              method="POST">
                                            @method('PUT')
                                            @csrf
                                            @if(!$quiz->publish)
                                                <button type="submit"
                                                        class="btn btn-primary">คลิ้กเพื่อเผยแพร่
                                                </button>
                                            @else
                                                <button type="submit"
                                                        class="btn btn-danger">ยกเลิกการเผยแพร่
                                                </button>
                                            @endif
                                        </form>
                                    @else

                                        @if($quiz->objectives->isEmpty())
                                            <a href="{{route('question.show',$quiz)}}" class="btn btn-danger">
                                                กลับไปสร้างวัตถุประสงค์</a>
                                        @elseif($quiz->questions->isEmpty())
                                            <a href="{{route('question.show',$quiz)}}" class="btn btn-danger">
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
                            <a href="{{route('question.show',$quiz)}}" type="button"
                               class="btn btn-secondary px-5">BACK</a>
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