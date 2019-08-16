@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"> Phase / {{ $phase_questionnaire->name }} </div>
                    <div class="card-body">
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
                                <th class="text-center">Action</th>
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
                                    <button class="btn btn-info">Edit</button>
                                    <button class="btn btn-info">Delete</button>
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
                                        <td>
                                            <button class="btn btn-info">Edit</button>
                                            <button class="btn btn-info">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Create Question</div>
                <div class="card-body">
                    <form action="{{ route('question_phase_questionnaire.store',$phase_questionnaire) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Question Name" name="name"
                                   value="{{ old('name') }}" required>
                        </div>
                        <div class="form-group">
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-primary">Create</button>
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            onclick="location.reload()">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection


