@extends('layouts.app',['activePage' => 'category_q', 'titlePage' => __('กลุ่มของแบบสอบถาม')])
@section('css')
    <style>
        #progressbar {
            margin-bottom: 30px;
            overflow: hidden;
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
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <ul id="progressbar">
                    <li class="active">Category & Questionnaire</li>
                    <li class="active">Phase Questionnaire</li>
                    <li class="active">Measurement</li>
                    <li>Public</li>
                </ul>
                <div class="card">
                    <div class="card-header"><a
                                href="{{route('phase_questionnaire.index')}}">{{$questionnaire->name }} </a> /
                        create measurement<span class="float-right">
                        <a class="fas fa-plus" data-toggle="modal" data-target="#modal-create"></a>
                        </span></div>
                    <div class="card-body">
                        @if($questionnaire->phase_questionnaires->isEmpty())
                            <table id="example" class="table table-bordered table-striped-column">
                                <tr>
                                    <td colspan="4" class="text-center">
                                        Not Found
                                        <br>
                                        You must to Create Phase & Option & Question
                                        <hr>
                                        <a class="buttons btn btn-info"
                                           href="{{route('phase_questionnaire.show',$questionnaire->id)}}">Create</a>
                                    </td>
                                </tr>
                            </table>
                        @else
                            @if($questionnaire->type =='SP' || $questionnaire->type == "S")
                                <table id="example" class="table table-bordered table-striped-column">
                                    <thead>
                                    <tr>
                                        <th colspan="4" class="text-center">คะแนนรวม</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">Score Min</th>
                                        <th class="text-center">Score Max</th>
                                        <th class="text-center">WHAT</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($questionnaire->measurements_questionnaire as $measurement)
                                        <tr>
                                            <td class="text-center">{{ $measurement->score_min }}</td>
                                            <td class="text-center">{{ $measurement->score_max }}</td>
                                            <td class="text-center">{{ $measurement->result }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Not Found</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            @endif
                            @if($questionnaire->type =='SP' || $questionnaire->type == 'P')
                                @foreach($questionnaire->phase_questionnaires as $phase_questionnaires)
                                    <table id="example" class="table table-bordered table-striped-column">
                                        <thead>
                                        <tr>
                                            <th colspan="4" class="text-center">{{$phase_questionnaires->name}}</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">Score Min</th>
                                            <th class="text-center">Score Max</th>
                                            <th class="text-center">WHAT</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @forelse($phase_questionnaires->measurements_phase_questionnaire as $measurement)
                                            <tr>
                                                <td class="text-center">{{ $measurement->score_min }}</td>
                                                <td class="text-center">{{ $measurement->score_max }}</td>
                                                <td class="text-center">{{ $measurement->result }}</td>
                                                <td class="text-center" style="width: 150px;">
                                                    <a class="btn btn-info"
                                                       href="{{route('measurement_phase_questionnaire.edit',$measurement->id)}}">Edit
                                                    </a>
                                                    <form action="{{route('measurement_phase_questionnaire.destroy', $measurement->id)}}"
                                                          method="POST"
                                                          style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-info btn-delete">Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">Not Found</td>
                                            </tr>
                                        @endforelse
                                        </tbody>

                                    </table>
                                @endforeach
                            @endif
                        @endif
                        <div class="text-center">
                            @if($questionnaire->type =='P')
                                @if(!$phase_questionnaires->measurements_phase_questionnaire->isEmpty())
                                    <a class="btn btn-primary">NEXT</a>
                                @endif
                            @endif
                            @if($questionnaire->type =='S')
                                @if(!$questionnaire->measurements_questionnaire->isEmpty())
                                        <a class="btn btn-primary"
                                           href="{{route('step_questionnaire.step_four',$questionnaire->id)}}">NEXT</a>                                @endif
                            @endif
                            @if($questionnaire->type =='SP')
                                @if(!$questionnaire->measurements_questionnaire->isEmpty() && !$phase_questionnaires->measurements_phase_questionnaire->isEmpty())
                                    <a class="btn btn-primary"
                                       href="{{route('step_questionnaire.step_four',$questionnaire->id)}}">NEXT</a>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal" tabindex="-1" role="dialog" id="modal-create">
                    @if(!$questionnaire->phase_questionnaires->isEmpty())
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">

                                <div class="card">
                                    <div class="card-header">Create Measurement</div>
                                    <div class="card-body">
                                        <form action="{{ route('step_questionnaire.store_three',$questionnaire->id) }}"
                                              method="POST">
                                            @csrf
                                            <div class="input-group">
                                                @if($questionnaire->type=='P')
                                                    <select name="phase_questionnaire_id" class="form-control">
                                                        <option value="0">Select Category</option>
                                                        @foreach($questionnaire->phase_questionnaires as $phase_questionnaires)
                                                            <option value="{{ $phase_questionnaires->id }}">{{ $phase_questionnaires->name }}</option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                                @if($questionnaire->type=='SP')
                                                    <select name="phase_questionnaire_id" class="form-control">
                                                        <option value="-1">Select Category</option>
                                                        <option value="0">ผลรวม</option>
                                                        @foreach($questionnaire->phase_questionnaires as $phase_questionnaires)
                                                            <option value="{{ $phase_questionnaires->id }}">{{ $phase_questionnaires->name }}</option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                                <input type="number" class="form-control text-center"
                                                       placeholder="Score Min"
                                                       name="score_min"
                                                       value="{{ old('score_min') }}" required>
                                                <input type="number" class="form-control text-center"
                                                       placeholder="Score Max"
                                                       name="score_max"
                                                       value="{{ old('score_max') }}" required>
                                                <label for="">&nbsp;&nbsp; = &nbsp;&nbsp;</label>
                                                <input type="text" class="form-control text-center" placeholder="What ?"
                                                       name="result"
                                                       value="{{ old('result') }}" required>
                                            </div>
                                            <br>
                                            <div class="form-group text-center">
                                                <button class="btn btn-primary">Create</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('script')

@endsection