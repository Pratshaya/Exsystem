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
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Question</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <br>
                    <form action="{{ route('question.store',$quiz->id) }}" method="POST" id="form{{$quiz->id}}">
                        @csrf
                        <div>
                            <table class="table table-bordered" id="table-create">
                                <tr>
                                    <td colspan="3" class="text-right">
                                        <button type="button" class="btn btn-info" onclick="create()">Create Question &
                                            Option
                                        </button>
                                        <button type="button" class="btn btn-warning" onclick="createFake()">Create Fake
                                            Option
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center" style="width: 40%;">Question</td>
                                    <td class="text-center" style="width: 20%;">Matching With</td>
                                    <td class="text-center" style="width: 40%;">Option</td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" class="form-control option-create"
                                               name="options[${count_option}][name]" placeholder="Question" required>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control text-center" value="Match" disabled>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <input type="text" class="form-control score-create"
                                                   name="options[${count_option}][score]" placeholder="Score" required>
                                            <span class="float-right">
                                <a class="fas fa-trash input-group align-middle mx-1"
                                   onclick="deleteOption($(this))"></a>
                            </span>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <table class="table table-bordered" id="table-fake">

                            </table>
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.reload()">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        let count = 1;

        function create() {
            const last_tr = $('#table-create tr:last')
            let html = `
                 <tr>
                     <td>
                         <input type="text" class="form-control option-create"
                                               name="options[${count}][name]" placeholder="Question" required>
                         </td>
                          <td>
                           <input type="text" class="form-control text-center" value="Match" disabled>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <input type="text" class="form-control score-create"
                                                   name="options[${count}][score]" placeholder="Score" required>
                                            <span class="float-right">
                                <a class="fas fa-trash input-group align-middle mx-1"
                                   onclick="deleteOption($(this))"></a>
                            </span>
                                        </div>
                                    </td>
                 </tr>

            `;
            last_tr.after(html);
            count++;
        }

        function createFake() {
            const table_fake = $('#table-fake tr:last');
            let html = `
                 <tr>
                     <td style="width: 60%;" class="text-center">Fake 0 Score</td>
                      <td style="width: 40%;">
                        <div class="input-group">
                              <input type="text" class="form-control score-create"
                                                   name="options[${count}][score]" placeholder="Score" required>
                                            <span class="float-right">
                                <a class="fas fa-trash input-group align-middle mx-1"
                                   onclick="deleteOption($(this))"></a>
                            </span>
                                        </div>
                                    </td>
                 </tr>

            `;
            if (table_fake.length === 0) {
                const table_fake = $('#table-fake');
                table_fake.append(html);
            } else {
                table_fake.after(html);
            }
        }
    </script>

@endsection

