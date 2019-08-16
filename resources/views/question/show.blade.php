@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Question / {{ $quiz->name }} <span class="float-right">
                            <a class="fas fa-plus" data-toggle="modal" data-target="#exampleModal"></a>
                        </span></div>
                    <div class="card-body">
                        @if($questions->isEmpty())
                            <h3 class="text-center">No Questions</h3>
                        @else
                            <table id="table-question" class="table table-bordered table-striped-column">
                                <thead>
                                <tr>
                                    <th class="text-center">Question</th>
                                    <th class="text-center">Option (score)</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody id="table-question-tbody">
                                @foreach($questions as $question)
                                    <tr>
                                        <th class="text-center">{{ $question->name }}</th>
                                        <th class="text-center">
                                            <button class="btn btn-primary" onclick="handleOption({{ $question->id }})">
                                                Click
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
                                                                <span aria-hidden="true">&times;</span>
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
                                                                    data-dismiss="modal">OK
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
                                                <button class="btn btn-danger" type="submit">Delete</button>
                                            </form>
                                        </th>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
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
                        <h5 class="modal-title" id="exampleModalLabel">Create Question</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('question.store',$quiz->id) }}" method="POST" id="form{{$quiz->id}}">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="Question">
                            </div>
                            <div class="card">
                                <div class="card-header">Options
                                    <span class="float-right">
                                         <a class="fas fa-plus" onclick="createOption()"></a>
                                    </span>
                                </div>
                                <div class="card-body" id="card-options">
                                    <div class="form-group row justify-content-center">
                                        <input type="text" class="form-control col-5 mx-2" name="options[0][name]"
                                               placeholder="Option">
                                        <input type="text" class="form-control col-5 mx-2" name="options[0][score]"
                                               placeholder="Score">
                                        <span class="float-right">
                                            <a class="fas fa-trash" onclick="deleteOption($(this))"></a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="handleSubmit({{ $quiz->id }})">
                                Create
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
                    <h5 class="modal-title">Alert</h5>
                </div>
                <div class="modal-body">
                    <p>Question & Option created success.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.reload()">OK</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        let count = 2;

        function createOption() {
            if (count <= 4) {
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

