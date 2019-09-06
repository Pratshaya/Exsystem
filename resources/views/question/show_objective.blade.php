@extends('layouts.app',['activePage' => 'question', 'titlePage' => __('ข้อสอบแบบตัวเลือก')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">รายการคำถาม
                        <span class="float-right">
                            <a class="fas fa-plus" data-toggle="modal" data-target="#exampleModal"></a>
                        </span>
                    </h4>
                </div>
                <div class="card-body">
                    @foreach($quiz->objectives as $objective)
                        <h3 class="text-center">{{ $objective->name }}</h3>
                        @if($objective->questions->isEmpty())
                            <h4 class="text-center">ยังไม่มีคำถาม</h4>
                        @else
                            <table id="table-question" class="table table-bordered table-striped-column">
                                <thead>
                                <tr>
                                    <th class="text-center" width="60%;">คำถาม</th>
                                    <th class="text-center" width="30%;">ตัวเลือก (คะแนน)</th>
                                    <th class="text-center" width="10%;">การจัดการ</th>
                                </tr>
                                </thead>
                                <tbody id="table-question-tbody">
                                @foreach($objective->questions as $question)
                                    <tr>
                                        <th class="text-center">{{ $question->name }}</th>
                                        <th class="text-center">
                                            <button class="btn btn-primary" onclick="handleOption({{ $question->id }})">
                                                คลิ้กเพื่อดูตัวเลือกทั้งหมด
                                            </button>
                                            <div class="modal fade" id="showOption{{ $question->id }}" tabindex="-1"
                                                 role="dialog"
                                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel">Options</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">
                                                                    <a class="fas fa-close" data-toggle="modal"
                                                                       data-target="#modal-close"></a>
                                                                </span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @foreach($question->options as $option)
                                                                <h5 class="text-cetner">
                                                                    {{$loop->iteration}}) {{$option->name}}
                                                                    มีคะแนนคือ {{$option->score}}
                                                                </h5>
                                                            @endforeach

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">ตกลง
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </th>
                                        <th class="text-center">
                                            <form action="{{route('question.destroy', $question->id)}}" method="POST"
                                                  style="display: inline;">
                                                @csrf
                                                <button class="btn btn-danger btn-link" type="submit">
                                                    <i class="material-icons">delete</i>
                                                </button>
                                            </form>
                                        </th>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    @endforeach
                </div>
            </div>
            <hr>
        </div>
    </div>
    </div>
    <div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">สร้างโจทย์</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('question.store',$quiz->id) }}" method="POST" id="form{{$quiz->id}}">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <h4>คำถาม</h4>
                                <input type="text" name="name" class="form-control" placeholder="กรุณากรอกคำถาม">
                            </div>
                            <div class="card">
                                <div class="card-header"><h4>ตัวเลือก</h4>
                                    <span class="float-right">
                                         <a class="fas fa-plus" onclick="createOption()"></a>
                                    </span>
                                </div>
                                <div class="card-body" id="card-options">
                                    <div class="form-group row justify-content-center">
                                        <input type="text" class="form-control col-5 mx-2" name="options[0][name]"
                                               placeholder="ตัวเลือก">
                                        <input type="text" class="form-control col-5 mx-2" name="options[0][score]"
                                               placeholder="คะแนน">
                                        <span class="float-right">
                                            <a class="fas fa-trash" onclick="deleteOption($(this))"></a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @if($quiz->type == 'O')
                                <div class="form-group">
                                    <select name="objective_id" class="form-control">
                                        <option value="0">โปรดเลือกวิชาของข้อสอบ</option>
                                        @foreach($objectives as $objective)
                                            <option value="{{ $objective->id }}">{{ $objective->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                        </div>

                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                            <button type="button" class="btn btn-primary" onclick="handleSubmit({{ $quiz->id }})">
                                สร้าง
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog" id="modal-dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">แจ้งเตือน</h5>
                </div>
                <div class="modal-body">
                    <p>สร้างโจทย์และตัวแล้วเสร็จแล้ว</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.reload()">
                        ตกลง
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        let count = 3;

        function createOption() {
            if (count <= 7) {
                let input = `<div class="form-group row justify-content-center" >
                            <input type="text" class="form-control col-5 mx-2"  name="options[${count}][name]" placeholder="ตัวเลือก">
                            <input type="text" class="form-control col-5 mx-2"  name="options[${count}][score]" placeholder="คะแนน">
                            <span class="float-right">
                                <a class="fas fa-trash" onclick="deleteOption($(this))"></a>
                            </span>
                          </div>`;
                $("#card-options").append(input);
                count++;
            }
        }

        function deleteOption(id) {
            id.parent().parent().remove();
            //Update Key
            count--;
        }

        function handleOption(id) {
            $('#showOption' + id).modal('show');
        }

        function showDialogue() {
            $('#modal-dialog').modal('show');
        }

        function closeForm() {
            $('#exampleModal').modal('hide');
        }

        function handleSubmit(id) {
            $("#errors").remove();
            const form = $('#form' + id);
            const url = form.attr('action');
            console.log(url);
            $.ajaxSetup({
                header: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type: 'POST',
                data: form.serialize(),
                success: function (data) {
                    closeForm();
                    showDialogue();
                    console.log(data);
                },
                error: function (response) {
                    //  console.log(form.attr('action'));
                    let errors = response.responseJSON.errors;
                    let errorsHtml = '<div class="alert alert-danger" id="errors"><ul>';
                    for (let key in errors) {
                        errorsHtml += '<li>' + errors[key] + '</li>';
                    }
                    errorsHtml += '</ul></div>';
                    $(form).prepend(errorsHtml);
                }
            });
        }

    </script>


@endsection

