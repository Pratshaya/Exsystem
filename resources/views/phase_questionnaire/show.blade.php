@extends('layouts.app',['activePage' => 'questionnaire_mng', 'titlePage' => __('แบบสอบถาม')])
@section('css')
    <style>
        th {
            background-color: #ffffff;
            color: black;
        }
    </style>
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">รายการ <span class="float-right">
                        <a class="fas fa-plus" data-toggle="modal" data-target="#modal-create"></a>
                        </span></h4>
                </div>
                <div class="card-header"><a
                            href="{{route('phase_questionnaire.index')}}">{{$questionnaire->name }} </a> /
                    create phase option & question
                </div>

                <div class="card-body">
                    @if($phase_questionnaires->isEmpty())
                        <h3 class="text-center">No Found</h3>
                    @else
                        @foreach($phase_questionnaires as $phase_questionnaire)
                            <table class="table table-bordered">
                                <tr>
                                    <th class="text-center"
                                        colspan="
                                            @if($phase_questionnaire->option_phase_questionnaires->count() > 1)
                                        {{$phase_questionnaire->option_phase_questionnaires->count() +1}}
                                        @else
                                        {{ 2 }}
                                        @endif">
                                        {{ $phase_questionnaire->name }}
                                    </th>
                                    <th class="text-center">การจัดการ</th>
                                </tr>
                                <tr>
                                    <td class="text-center"
                                        colspan="
                                            @if($phase_questionnaire->option_phase_questionnaires->count() > 1)
                                        {{$phase_questionnaire->option_phase_questionnaires->count() +1}}
                                        @else
                                        {{ 2 }}
                                        @endif">{{ $phase_questionnaire->detail }}</td>
                                    <td class="text-center" rowspan="2" style="width: 150px;">
                                        <button class="btn btn-success btn-link" data-toggle="modal"
                                                data-target="#modal-edit{{$phase_questionnaire->id}}">
                                            <i class="material-icons">edit</i>
                                        </button>
                                        <form action="{{route('phase_questionnaire.destroy', $phase_questionnaire->id)}}"
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
                                <tr>
                                    <td></td>
                                    @forelse($phase_questionnaire->option_phase_questionnaires as $option)
                                        <td class="text-center">{{ $option->name }}</td>
                                    @empty
                                        <td class="text-center"> Not Options</td>
                                    @endforelse
                                </tr>
                                <!-- Create Question -->
                                @if($phase_questionnaire->question_phase_questionnaires->isEmpty())
                                    <tr>
                                        <td class="text-center"> For Question</td>
                                        @forelse($phase_questionnaire->option_phase_questionnaires as $option)
                                            <td class="text-center"><input type="radio"/></td>
                                        @empty
                                            <td class="text-center"></td>
                                        @endforelse
                                        <td></td>
                                    </tr>
                                @else
                                    @foreach($phase_questionnaire->question_phase_questionnaires as $question)
                                        <tr>
                                            <td class="text-center">
                                                {{$loop->iteration}}. {{ $question->name }}
                                            </td>
                                            @forelse($phase_questionnaire->option_phase_questionnaires as $option)
                                                <td class="text-center"><input type="radio"/></td>
                                            @empty
                                                <td class="text-center">Not Options</td>
                                            @endforelse
                                            <td></td>
                                        </tr>
                                    @endforeach
                                @endif
                            </table>
                        @endforeach
                        <div class="text-center">
                            <a href="{{route('phase_questionnaire.index',$questionnaire)}}"
                               class="btn btn-primary">กลับ</a>
                            <a href="{{route('measurement_phase_questionnaire.show',$questionnaire)}}"
                               class="btn btn-primary">ต่อไป</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>
    <div>

    </div>

    <!--For Create -->
    <div class="modal" tabindex="-1" role="dialog" id="modal-create">
        <form id="create" action="{{ route('phase_questionnaire.store',$questionnaire->id) }}" method="POST">
            @csrf
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="modal-title">สร้างแบบสอบถาม
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><a class="fas fa-close" data-toggle="modal"
                                                                data-target="#modal-close"></a></span>
                                </button></h4>
                            </div>
                            <div class="modal-body">
                                <div class="errorTxt text-center my-2" style="color: red;" id="create-errors">
                                </div>
                                <table class="table table-bordered" id="table-questionnaire">
                                    <tr>
                                        <td class="text-center" colspan="2" id="table-header">
                                            <input type="text" class="form-control text-center"
                                                   placeholder="หัวตารางหรือด้านที่ต้องการประเมิน"
                                                   name="name" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" colspan="2" id="table-detail">
                                            <input type="text" class="form-control text-center" placeholder="รายละเอียด"
                                                   name="detail" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">คำถาม
                                            <span class="float-right">
                                    <a class="fas fa-plus" onclick="crateQuestion()"></a>
                                 </span>
                                        </td>
                                        <td class="text-center" id="td-label-option">ตัวเลือก
                                            <span class="float-right">
                                    <a class="fas fa-plus" onclick="createOption()"></a>
                                 </span>
                                        </td>
                                    </tr>
                                    <tr id="tr-option">
                                        <td id="question-first" class="text-center" style="width: 20%;">

                                        </td>
                                        <td id="option-first" class="text-center" style="width: 10%;">

                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="modal-footer ">
                                <div class="mx-auto">
                                    <button type="submit" class="btn btn-info">
                                        บันทึก
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- End For Create -->

    <!-- For Edit -->
    @foreach($phase_questionnaires as $phase_questionnaire)
        <div class="modal" tabindex="-1" role="dialog" id="modal-edit{{$phase_questionnaire->id}}">
            <form>
                @csrf
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">แก้ไขแบบสอบถาม</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="errorTxt text-center my-2" style="color: red;" id="create-errors">
                            </div>
                            <table class="table table-bordered" id="table-questionnaire">
                                <tr>
                                    <td class="text-center"
                                        colspan="  @if($phase_questionnaire->option_phase_questionnaires->count() > 1)
                                        {{$phase_questionnaire->option_phase_questionnaires->count() +1}}
                                        @else
                                        {{ 2 }}
                                        @endif" id="table-header">
                                        <input type="text" class="form-control text-center" placeholder="หัวตาราง"
                                               name="name" value="{{$phase_questionnaire->name}}" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center"
                                        colspan=" @if($phase_questionnaire->option_phase_questionnaires->count() > 1)
                                        {{$phase_questionnaire->option_phase_questionnaires->count() +1}}
                                        @else
                                        {{ 2 }}
                                        @endif" id="table-detail">
                                        <input type="text" class="form-control text-center" placeholder="รายละเอียด"
                                               name="detail" value="{{$phase_questionnaire->detail}}" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">คำถาม
                                        <span class="float-right">
                                    <a class="fas fa-plus" onclick="crateQuestion()"></a>
                                 </span>
                                    </td>
                                    <td class="text-center" id="td-label-option"
                                        colspan=" @if($phase_questionnaire->option_phase_questionnaires->count() > 1)
                                        {{$phase_questionnaire->option_phase_questionnaires->count() +1}}@endif">
                                        ตัวเลือก
                                        <span class="float-right">
                                    <a class="fas fa-plus" onclick="createOption()"></a>
                                 </span>
                                    </td>
                                </tr>

                                <tr id="tr-option">
                                    <td id="question-first" class="text-center" style="width: 30%;">

                                    </td>
                                    @forelse($phase_questionnaire->option_phase_questionnaires as $option)
                                        @if($loop->iteration === 1)
                                            <td class="text-center" id="option-first">{{ $option->name }}</td>
                                        @else
                                            <td class="text-center">{{ $option->name }}</td>
                                        @endif
                                    @empty
                                        <td class="text-center">Not Options</td>
                                    @endforelse
                                </tr>
                                @foreach($phase_questionnaire->question_phase_questionnaires as $question)
                                    <tr>
                                        <td class="text-center">
                                            {{$loop->iteration}}. {{ $question->name }}
                                        </td>
                                        @forelse($phase_questionnaire->option_phase_questionnaires as $option)
                                            <td class="text-center"><input type="radio"/></td>
                                        @empty
                                            <td class="text-center">Not Options</td>
                                        @endforelse
                                    </tr>
                                @endforeach

                            </table>
                        </div>
                        <div class="modal-footer ">
                            <div class="mx-auto">
                                <button type="button" class="btn btn-info">
                                    แก้ไข
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    @endforeach


    <!-- End Edit -->
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

    <!-- For Ajax -->
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

    <script>
        function showDialogue() {
            $('#modal-dialog').modal('show');
        }

        function closeForm() {
            $('#exampleModal').modal('hide');
        }


        $("#create").validate({
            rules: {
                "name": {
                    required: true,
                },
                "detail": {
                    required: true,
                }
            },
            messages: {
                "name": {
                    required: "Please enter data to Name",
                },
                "detail": {
                    required: "Please enter data to Detail",
                }
            },
            errorElement: 'div',
            errorLabelContainer: '.errorTxt',
            submitHandler: function (form) {
                if ($('.question-create').length === 0 || $('.option-create').length === 0) {
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Please Create Option & Question',
                    });
                    return;
                }
                const error = validate();

                if (error)
                    return;
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
                        Swal.fire({
                            type: 'success',
                            title: 'Oops...',
                            text: 'Create Success',
                        }).then(function () {
                            location.reload();
                        });
                    },
                    error: function (response) {
                        Swal.fire({
                            type: 'error',
                            title: 'Oops...',
                            text: 'Create Not Success, Try Again.',
                        })
                    }
                });
            }
        });

        function validate() {
            let error = false;
            $('.score-create').each(function (index, object) {
                if ($(object).val().length === 0) {
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Please Create Score',
                    });
                    error = true;
                }
            });

            if (error)
                return error;

            $('.option-create').each(function (index, object) {
                if ($(object).val().length === 0) {
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Please Create Option ',
                    });
                    return true;
                }
            });

            if (error)
                return error;

            $('.question-create').each(function (index, object) {
                if ($(object).val().length === 0) {
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Please Create Question',
                    });
                    return true;
                }
            });


            return error;

        }
    </script>
    <!-- DELETE-->
    <script>
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

    <!-- -->
    <!-- For Create Question-->
    <script>
        let count_option = 0;
        let count_question = 0;

        function createOption() {
            if (count_option <= 6) {
                let option_html = ``;
                if (count_option === 0) {
                    const option_first = $('#option-first');
                    option_html = `
                    <div class="input-group">
                        <input type="text" class="form-control option-create" name="options[${count_option}][name]"  placeholder="Title"required>
                        <input type="number" class="form-control score-create" name="options[${count_option}][score]" placeholder="Score" required>
                            <span class="float-right">
                                <a class="fas fa-trash input-group align-middle mx-1"  onclick="deleteOption($(this))"></a>
                            </span>
                    </div>
                    `
                    option_first.html(option_html);
                } else {
                    const option_tr = $('#tr-option');
                    const table_header = $('#table-header');
                    const table_detail = $('#table-detail');
                    const td_label_option = $('#td-label-option');
                    option_html = `
                        <td class="text-center" style="width:10%;">
                            <div class="input-group">
                                <input type="text" class="form-control option-create" name="options[${count_option}][name]" placeholder="Title" required>
                                 <input type="number" class="form-control score-create" name="options[${count_option}][score]" placeholder="Score" required>
                                <span class="float-right">
                                    <a class="fas fa-trash input-group align-middle mx-1"  onclick="deleteOption($(this))"></a>
                                </span>
                            </div>
                        </td>
                    `
                    const col_span = parseInt(table_detail.attr('colspan'));
                    table_detail.attr('colspan', col_span + 1);
                    table_header.attr('colspan', col_span + 1);
                    td_label_option.attr('colspan', col_span);
                    option_tr.append(option_html);
                }
                changeRadio();
                count_option++;
            }
        }

        function crateQuestion() {
            const table_questionnaire = $('#table-questionnaire');
            let question_html = `
                                        <tr id="question_${count_question}" class="tr-question">
                                            <td>
                                            <div class="input-group">
                                                 <input type="text" class="form-control question-create" name="questions[][name]"  placeholder="Question" required>
                                                <span class="float-right">
                                                    <a class="fas fa-trash input-group align-middle mx-1"  onclick="deleteQuestion($(this))"></a>
                                                </span>
                                            </div>
                                            </td>
                                            <td class="text-center">
                                                <input type="radio" disabled/>
                                            </td>
                                        </tr>
                                       `;
            table_questionnaire.append(question_html);
            changeRadio();
            count_question++;
        }

        function deleteOption(id) {
            if (count_option > 1) {
                id.parent().parent().parent().parent().remove();
                const table_header = $('#table-header');
                const table_detail = $('#table-detail');
                const td_label_option = $('#td-label-option');
                const col_span = parseInt(td_label_option.attr('colspan'));
                const col_span_header = parseInt(table_header.attr('colspan'));

                td_label_option.attr('colspan', col_span - 1);
                table_detail.attr('colspan', col_span_header - 1);
                table_header.attr('colspan', col_span_header - 1);
                changeRadio();
                count_option--;
                updateKeyOption();
            }
        }

        function updateKeyOption() {

            $('.score-create').each(function (index, object) {
                $(object).attr('name', `options[${index}][score]`)
            });


            $('.option-create').each(function (index, object) {
                $(object).attr('name', `options[${index}][name]`)
            });
        }

        function deleteQuestion(id) {
            if (count_question > 1) {
                id.parent().parent().parent().parent().parent().remove();
                count_question--;
            }
        }

        function changeRadio() {
            const td_label_option = $('#td-label-option');
            const colspan = parseInt(td_label_option.attr('colspan'));
            const tr_question = $('.tr-question');
            const radio = $('.radio');
            radio.remove();
            tr_question.each(function (index, object) {
                for (let i = 0; i < colspan - 1; i++) {
                    $(object).append(`<td class="radio text-center"><input type="radio" disabled/></td>`);
                }
            });
        }


    </script>
    <!-- End For Create Question -->
@endsection

