@extends('layouts.app',['activePage' => 'category_q', 'titlePage' => __('กลุ่มของแบบสอบถาม')])
@section('css')
    <style>

        #form-create .msform:not(:first-of-type) {
            display: none;
        }

        /*progressbar*/
        #progressbar {
            margin-bottom: 30px;
            overflow: hidden;
            /*CSS counters to number the steps*/
            counter-reset: step;
        }

        #progressbar li {
            text-align: center;
            list-style-type: none;
            color: black;
            text-transform: uppercase;
            font-size: 9px;
            width: 25%;
            float: left;
            position: relative;
        }

        #progressbar li:before {
            content: counter(step);
            counter-increment: step;
            width: 20px;
            line-height: 20px;
            display: block;
            font-size: 10px;
            color: #333;
            background: gray;
            border-radius: 3px;
            margin: 0 auto 5px auto;
        }

        /*progressbar connectors*/
        #progressbar li:after {
            content: '';
            width: 100%;
            height: 2px;
            background: gray;
            position: absolute;
            left: -50%;
            top: 9px;
            z-index: -1; /*put it behind the numbers*/
        }

        #progressbar li:first-child:after {
            /*connector not needed before the first step*/
            content: none;
        }

        /*marking active/completed steps green*/
        /*The number of the step and the connector before it = green*/
        #progressbar li.active:before, #progressbar li.active:after {
            background: #27AE60;
            color: white;
        }
    </style>
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <ul id="progressbar">
                <li class="active">Category & Questionnaire</li>
                <li class="active">Phase Questionnaire</li>
                <li>Measurement</li>
                <li>Public</li>
            </ul>
            <div class="card">
                <div class="card-header card-header-primary">

                    <a  class="card-title"
                                href="{{route('phase_questionnaire.index')}}">{{$questionnaire->name }} </a> /
                        create phase option & question <span class="float-right">
                        <a class="fas fa-plus" data-toggle="modal" data-target="#modal-create"></a>
                        </span>
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
                                    </tr>
                                    <tr>
                                        <td class="text-center"
                                            colspan="
                                            @if($phase_questionnaire->option_phase_questionnaires->count() > 1)
                                            {{$phase_questionnaire->option_phase_questionnaires->count() +1}}
                                            @else
                                            {{ 2 }}
                                            @endif">{{ $phase_questionnaire->detail }}</td>
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
                                            </tr>
                                        @endforeach
                                    @endif

                                </table>
                            @endforeach
                            <div class="form-group text-center">
                                <a class="btn btn-primary"
                                   href="{{route('step_questionnaire.step_three', $questionnaire->id)}}">Next</a>
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
        <form id="create" action="{{ route('step_questionnaire.store_two',$questionnaire->id) }}" method="POST">
            @csrf
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create Questionnaire</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="errorTxt text-center my-2" style="color: red;" id="create-errors">
                        </div>
                        <table class="table table-bordered" id="table-questionnaire">
                            <tr>
                                <td class="text-center" colspan="2" id="table-header">
                                    <input type="text" class="form-control text-center" placeholder="หัวตาราง"
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
                                <td id="question-first" class="text-center" style="width: 30%;">

                                </td>
                                <td id="option-first" class="text-center" style="width: 10%;">

                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer ">
                        <div class="mx-auto">
                            <button type="submit" class="btn btn-info">
                                OK
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- End For Create -->

    <!-- End For Edit Ajax Form -->

    <!-- For Edit -->
    @foreach($phase_questionnaires as $phase_questionnaire)
        <div class="modal" tabindex="-1" role="dialog" id="modal-edit{{$phase_questionnaire->id}}">
            <form id="create" action="{{ route('phase_questionnaire.update',$phase_questionnaire->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Create Questionnaire</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-edit"
                                    onclick="closeEdit({{$phase_questionnaire->id}})">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="error edit text-center my-2" style="color: red;" id="create-errors">
                            </div>
                            <table class="table table-bordered" id="table-questionnaire-{{$phase_questionnaire->id}}">
                                <tr>
                                    <td class="text-center"
                                        colspan="  @if($phase_questionnaire->option_phase_questionnaires->count() > 1)
                                        {{$phase_questionnaire->option_phase_questionnaires->count() +1}}
                                        @else
                                        {{ 2 }}
                                        @endif" id="table-header-{{$phase_questionnaire->id}}">
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
                                        @endif" id="table-detail-{{$phase_questionnaire->id}}">
                                        <input type="text" class="form-control text-center" placeholder="รายละเอียด"
                                               name="detail" value="{{$phase_questionnaire->detail}}" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">คำถาม
                                        <span class="float-right">
                                    <a class="fas fa-plus"
                                       onclick="createQuestionEdit({{$phase_questionnaire->id}})"></a>
                                 </span>
                                    </td>
                                    <td class="text-center" id="td-label-option-{{$phase_questionnaire->id}}"
                                        colspan=" @if($phase_questionnaire->option_phase_questionnaires->count() >= 1)
                                        {{$phase_questionnaire->option_phase_questionnaires->count()}}@endif">
                                        ตัวเลือก
                                        <span class="float-right">
                                    <a class="fas fa-plus" onclick="createOptionEdit({{$phase_questionnaire->id}})"></a>
                                 </span>
                                    </td>
                                </tr>

                                <tr id="tr-option-{{$phase_questionnaire->id}}">
                                    <td id="question-first" class="text-center" style="width: 30%;">

                                    </td>
                                    @forelse($phase_questionnaire->option_phase_questionnaires as $option)
                                        @if($loop->iteration === 1)
                                            <td class="text-center"
                                                id="option-first-{{$phase_questionnaire->id}}">

                                                <div class="input-group">
                                                    <input type="text" class="form-control option-create"
                                                           name="options_edit[{{$option->id}}][name]"
                                                           placeholder="Title"
                                                           value="{{$option->name}}"
                                                           required>
                                                    <input type="number" class="form-control score-create"
                                                           name="options_edit[{{$option->id}}][score]"
                                                           placeholder="Score"
                                                           value="{{$option->score}}"
                                                           required>
                                                    <span class="float-right">
                                    <a class="fas fa-trash input-group align-middle mx-1"
                                       onclick="deleteOptionEdit($(this),{{$phase_questionnaire->id}})"></a>
                                </span>
                                                </div>
                                            </td>
                                        @else
                                            <td class="text-center">
                                                <div class="input-group">
                                                    <input type="text" class="form-control option-create"
                                                           name="options_edit[{{$option->id}}][name]"
                                                           placeholder="Title"
                                                           value="{{$option->name}}"
                                                           required>
                                                    <input type="number" class="form-control score-create"
                                                           name="options_edit[{{$option->id}}][score]"
                                                           placeholder="Score"
                                                           value="{{$option->score}}"
                                                           required>
                                                    <span class="float-right">
                                    <a class="fas fa-trash input-group align-middle mx-1"
                                       onclick="deleteOptionEdit($(this),{{$phase_questionnaire->id}})"></a>
                                </span>
                                                </div>
                                            </td>
                                        @endif
                                    @empty
                                        <td class="text-center">Not Options</td>
                                    @endforelse
                                </tr>
                                @foreach($phase_questionnaire->question_phase_questionnaires as $question)
                                    <tr class="tr-question-edit-{{$phase_questionnaire->id}}">
                                        <td class="text-center">
                                            <div class="input-group">
                                                <input type="text"
                                                       class="form-control question-edit-{{$phase_questionnaire->id}}"
                                                       value="{{ $question->name }}"
                                                       name="questions_edit[{{$question->id}}][name]"
                                                       placeholder="Question" required>
                                                <span class="float-right">
                                                    <a class="fas fa-trash input-group align-middle mx-1"
                                                       onclick="deleteQuestionEdit($(this),{{$phase_questionnaire->id}})"></a>
                                                </span>
                                            </div>

                                        </td>
                                        @forelse($phase_questionnaire->option_phase_questionnaires as $option)
                                            <td class="radio-edit-{{$phase_questionnaire->id}} text-center"
                                                style="width: 10%;"><input type="radio" disabled/></td>
                                        @empty
                                            <td class="text-center">Not Options</td>
                                        @endforelse
                                    </tr>
                                @endforeach

                            </table>
                        </div>
                        <div class="modal-footer ">
                            <div class="mx-auto">
                                <button type="submit" class="btn btn-info">
                                    Update
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
                        <td class="text-center" style="width: 10%;">
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
                id.parent().parent().parent().parent().remove();
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


        //For Edit

        function createQuestionEdit(id) {
            const table_questionnaire = $('#table-questionnaire-' + id);
            let question_html = `
                                        <tr id="question_${count_question}" class="tr-question-edit-${id}">
                                            <td>
                                            <div class="input-group">
                                                 <input type="text" class="form-control question-create" name="questions[][name]"  placeholder="Question" required>
                                                <span class="float-right">
                                                    <a class="fas fa-trash input-group align-middle mx-1"  onclick="deleteQuestionEdit($(this),${id})"></a>
                                                </span>
                                            </div>
                                            </td>
                                            <td class="text-center radio-edit-${id}">
                                                <input type="radio" disabled/>
                                            </td>
                                        </tr>
                                       `;
            table_questionnaire.append(question_html);
            changeRadioEdit(id);
            count_question_edit++;
        }

        let count_question_edit = 0;
        let count_option_edit = 0;

        function changeRadioEdit(id) {
            const td_label_option = $('#td-label-option-' + id);
            const colspan = parseInt(td_label_option.attr('colspan'));
            const tr_question = $('.tr-question-edit-' + id);
            const radio = $('.radio-edit-' + id);
            radio.remove();
            tr_question.each(function (index, object) {
                for (let i = 0; i < colspan; i++) {
                    $(object).append(`<td class="radio-edit-${id} text-center" style="width: 10%;"><input type="radio" disabled/></td>`);
                }
            });
        }

        function deleteQuestionEdit(object, id) {
            count_question_edit = $('.tr-question-edit-' + id).length;
            console.log(count_question_edit);
            if (count_question_edit > 1) {
                object.parent().parent().parent().parent().remove();
                count_question_edit--;
            }
        }

        function createOptionEdit(id) {
            const count_radio = $('#td-label-option-' + id).attr('colspan');

            const option_tr = $('#tr-option-' + id);
            const table_header = $('#table-header-' + id);
            const table_detail = $('#table-detail-' + id);
            const td_label_option = $('#td-label-option-' + id);
            const option_html = `
                        <td class="text-center create-new-${id}">
                            <div class="input-group">
                                <input type="text" class="form-control option-create" name="options[${count_radio}][name]" placeholder="Title" required>
                                 <input type="number" class="form-control score-create" name="options[${count_radio}][score]" placeholder="Score" required>
                                <span class="float-right">
                                    <a class="fas fa-trash input-group align-middle mx-1"  onclick="deleteOptionEdit($(this),${id})"></a>
                                </span>
                            </div>
                        </td>
                    `
            const col_span = parseInt(table_detail.attr('colspan'));
            table_detail.attr('colspan', col_span + 1);
            table_header.attr('colspan', col_span + 1);
            td_label_option.attr('colspan', col_span);
            option_tr.append(option_html);
            changeRadioEdit(id);

        }


        function deleteOptionEdit(object, id) {
            const count_radio = $('#td-label-option-' + id).attr('colspan');
            if (count_radio > 1) {
                object.parent().parent().parent().remove();
                const table_header = $('#table-header-' + id);
                const table_detail = $('#table-detail-' + id);
                const td_label_option = $('#td-label-option-' + id);
                const col_span = parseInt(td_label_option.attr('colspan'));
                const col_span_header = parseInt(table_header.attr('colspan'));
                td_label_option.attr('colspan', col_span - 1);
                table_detail.attr('colspan', col_span_header - 1);
                table_header.attr('colspan', col_span_header - 1);
                changeRadioEdit(id);
                updateKeyOption();
            }

        }

        function closeEdit(id) {
            let count = 0;
            $('.create-new-' + id).each(function (index, object) {
                $(object).remove();
                count++;
            });
            const table_header = $('#table-header-' + id);
            const table_detail = $('#table-detail-' + id);
            const td_label_option = $('#td-label-option-' + id);
            const col_span = parseInt(td_label_option.attr('colspan'));
            const col_span_header = parseInt(table_header.attr('colspan'));
            td_label_option.attr('colspan', col_span - count);
            table_detail.attr('colspan', col_span_header - count);
            table_header.attr('colspan', col_span_header - count);
            changeRadioEdit(id);
        }

        //End Edit
    </script>


    <!-- End For Create Question -->
@endsection

