@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"> Phase / {{ $questionnaire->name }} </div>
                    <div class="card-body">
                        <table id="example" class="table table-bordered table-striped-column">
                            <thead>
                            <tr>
                                <th class="text-center">Phase</th>
                                <th class="text-center">Options</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($phase_questionnaires as $phase_questionnaire)
                                <tr>
                                    <th class="text-center">{{ $phase_questionnaire->name }}</th>
                                    <td>
                                        <ul>
                                            @forelse($phase_questionnaire->option_phase_questionnaires as $option)
                                                <li>
                                                    {{ $option->name }}
                                                </li>
                                            @empty
                                                Not Option
                                            @endforelse
                                        </ul>
                                    </td>
                                    <th class="text-center" style="width: 150px;">
                                        <a class="btn btn-info" href="{{route('question_phase_questionnaire.create',$phase_questionnaire->id)}}" @if($phase_questionnaire->option_phase_questionnaires->isEmpty()) disabled @endif>Add Question</a>
                                    </th>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div>

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


