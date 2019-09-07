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
                                            @if($options_question->count() > 1)
                                        {{$options_question->count() +1}}
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
                                            @if($options_question->count() > 1)
                                        {{$options_question->count() +1}}
                                        @else
                                        {{ 2 }}
                                        @endif"></td>
                                    <td class="text-center" rowspan="2" style="width: 150px;">
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
                                    @forelse($options_question as $option)
                                        <td class="text-center" width="10%;">{{ $option->option }}</td>
                                    @empty
                                        <td class="text-center"> Not Options</td>
                                    @endforelse
                                </tr>
                                <!-- Create Question -->
                                @if($phase_questionnaire->question_phase_questionnaires->isEmpty())
                                    <tr>
                                        <td class="text-center"> For Question</td>
                                        @forelse($options_question as $option)
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
                                                {{$loop->iteration}}. {{ $question->name }} ( {{ $question->group_questionnaire->name }} )
                                            </td>
                                            @forelse($options_question as $option)
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
                                        <td class="text-center" colspan="{{ $questionnaire->option_questionnaires()->count()+1  }}" id="table-header">
                                                        <select name="phase_questionnaire_id" class="form-control" id="phase_questionnaire_id">
                                                            <option value="0">โปรเลือก ด้าน</option>
                                                            @foreach($questionnaire->phase_questionnaires as $phase)
                                                                <option value="{{ $phase->id }}">{{ $phase->name }}</option>
                                                            @endforeach
                                                        </select>
                                        </td>
                                    </tr>
                       
                                    <tr>
                                    <td class="text-center" colspan="{{ $questionnaire->option_questionnaires()->count()+1  }}" id="table-detail">
                                                        <select name="group_questionnaire_id" class="form-control" id="group_questionnaire_id">
                                                            <option value="0">โปรเลือกกลุ่ม</option>
                                                            @foreach($questionnaire->group_questionnaires as $group)
                                                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                                                            @endforeach
                                                        </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">คำถาม
                                            <span class="float-right">
                                    <a class="fas fa-plus" onclick="crateQuestion()"></a>
                                 </span>
                                        </td>
                                        <td class="text-center" id="td-label-option" colspan="{{ $questionnaire->option_questionnaires()->count()  }}">ตัวเลือก 
                                            <span class="float-right">
                                 </span>
                                        </td>
                                    </tr>
                                    <tr id="tr-option">
                                        <td id="question-first" class="text-center" style="width: 20%;">

                                        </td>
                                        @foreach($questionnaire->option_questionnaires as $option)
                                            <td id="option-first" class="text-center" style="width: 10%;">
                                                {{$option->option}}
                                            </td>
                                        @endforeach
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
            errorElement: 'div',
            errorLabelContainer: '.errorTxt',
            submitHandler: function (form) {
                if ($('#group_questionnaire_id').val() == 0) {
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Please Choose Group',
                    });
                    return;
                }
                if ($('#phase_questionnaire_id').val() == 0) {
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Please Choose Phase',
                    });
                    return;
                }
                if ($('.question-create').length === 0) {
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Please Create Question',
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
            let error = fasle;

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
        let count_question = 0;
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

