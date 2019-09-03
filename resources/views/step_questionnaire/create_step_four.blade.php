@extends('layouts.app',['activePage' => 'category_q', 'titlePage' => __('กลุ่มของแบบสอบถาม')])
@section('css')
    <style>
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
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <ul id="progressbar">
                    <li class="active">Category & Questionnaire</li>
                    <li class="active">Phase Questionnaire</li>
                    <li class="active">Measurement</li>
                    <li class="active">Public</li>
                </ul>
                <div class="card">
                    <div class="card-header">
                        <a href="{{route('phase_questionnaire.index')}}">{{$questionnaire->name }} </a>/
                        Public
                        <a href="{{route('phase_questionnaire.index')}}" class="btn btn-sm btn-secondary float-right">Back</a>
                    </div>
                    <div class="card-body">
                        <table id="example" class="table table-bordered table-striped-column">
                            <thead>
                            <tr>
                                @if($questionnaire->count_public() > 0)
                                    <th colspan="4" class="text-center"><a href=""
                                                                           target="_blank">{{ $questionnaire->name }} </a>
                                    </th>
                                @else
                                    <th colspan="4" class="text-center">{{ $questionnaire->name }} </th>
                                @endif
                            </tr>
                            <tr>
                                <th class="text-center">Phase</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Public</th>
                                <th class="text-center">Action</th>
                            </tr>
                            @if($questionnaire->phase_questionnaires->isEmpty())
                                <tr>
                                    <td colspan="4" class="text-center">
                                        Not Found
                                        <br>
                                        You must to Create Option & Question & Measurements
                                        <hr>
                                        <a class="buttons btn btn-info"
                                           href="{{route('phase_questionnaire.show',$questionnaire->id)}}">Create</a>
                                    </td>
                                </tr>
                            @else
                                @if($questionnaire->type == 'S')
                                    @foreach($questionnaire->phase_questionnaires as $phase)
                                        <tr>
                                            <td class="text-center">{{$phase->name}}</td>
                                            <td class="text-center">
                                                @if($phase->option_phase_questionnaires->isEmpty() || $phase->question_phase_questionnaires->isEmpty() ||$questionnaire->measurements_questionnaire->isEmpty() )
                                                    <ul>
                                                        <li>Can't Public</li>
                                                        @if($phase->option_phase_questionnaires->isEmpty())
                                                            <li>Options Not Found</li>
                                                        @endif
                                                        @if($phase->question_phase_questionnaires->isEmpty())
                                                            <li>Phase Not Found</li>
                                                        @endif
                                                        @if($phase->question_phase_questionnaires->isEmpty())
                                                            <li>Question Not Found</li>
                                                        @endif
                                                        @if($questionnaire->measurements_questionnaire->isEmpty())
                                                            <li>Measurements Not Found</li>
                                                        @endif
                                                    </ul>
                                                @else
                                                    @if(!$phase->public)
                                                        You can public!
                                                    @else
                                                        Published!
                                                    @endif
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($phase->public)
                                                    Yes
                                                @else
                                                    No
                                                @endif</td>
                                            <td class="text-center">
                                                @if($phase->option_phase_questionnaires->isEmpty() || $phase->question_phase_questionnaires->isEmpty())
                                                    <a href="{{route('phase_questionnaire.show',$phase->questionnaire)}}"
                                                       class="btn btn-info">Create Phase</a>
                                                @elseif($questionnaire->measurements_questionnaire->isEmpty() )
                                                    <a href="{{route('measurement_phase_questionnaire.show',$questionnaire)}}"
                                                       class="btn btn-info">Create Measurements</a>
                                                @else
                                                    <form action="{{route('publish_questionnaire.public',$phase)}}"
                                                          method="POST">
                                                        @method('PUT')
                                                        @csrf
                                                        @if(!$phase->public)
                                                            <button class="btn btn-info"
                                                                    type="submit">Public
                                                            </button>
                                                        @else
                                                            <button class="btn btn-danger"
                                                                    type="submit">Cancel
                                                            </button>
                                                        @endif
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                @if( $questionnaire->type == 'P')
                                    @foreach($questionnaire->phase_questionnaires as $phase)
                                        <tr>
                                            <td class="text-center">{{$phase->name}}</td>
                                            <td class="text-center">
                                                @if($phase->option_phase_questionnaires->isEmpty() || $phase->question_phase_questionnaires->isEmpty() ||$phase->measurements_phase_questionnaire->isEmpty() )
                                                    <ul>
                                                        <li>Can't Public</li>
                                                        @if($phase->option_phase_questionnaires->isEmpty())
                                                            <li>Options Not Found</li>
                                                        @endif
                                                        @if($phase->question_phase_questionnaires->isEmpty())
                                                            <li>Phase Not Found</li>
                                                        @endif
                                                        @if($phase->question_phase_questionnaires->isEmpty())
                                                            <li>Question Not Found</li>
                                                        @endif
                                                        @if($phase->measurements_phase_questionnaire->isEmpty())
                                                            <li>Measurements Not Found</li>
                                                        @endif
                                                    </ul>
                                                @else
                                                    @if(!$phase->public)
                                                        You can public!
                                                    @else
                                                        Published!
                                                    @endif
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($phase->public)
                                                    Yes
                                                @else
                                                    No
                                                @endif</td>
                                            <td class="text-center">
                                                @if($phase->option_phase_questionnaires->isEmpty() || $phase->question_phase_questionnaires->isEmpty())
                                                    <a href="{{route('phase_questionnaire.show',$phase->questionnaire)}}"
                                                       class="btn btn-info">Create Phase</a>
                                                @elseif($phase->measurements_phase_questionnaire->isEmpty() )
                                                    <a href="{{route('measurement_phase_questionnaire.show',$phase->questionnaire)}}"
                                                       class="btn btn-info">Create Measurements</a>
                                                @else
                                                    <form action="{{route('publish_questionnaire.public',$phase)}}"
                                                          method="POST">
                                                        @method('PUT')
                                                        @csrf
                                                        @if(!$phase->public)
                                                            <button class="btn btn-info"
                                                                    type="submit">Public
                                                            </button>
                                                        @else
                                                            <button class="btn btn-danger"
                                                                    type="submit">Cancel
                                                            </button>
                                                        @endif
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                @if( $questionnaire->type == 'SP')
                                    @foreach($questionnaire->phase_questionnaires as $phase)
                                        <tr>
                                            <td class="text-center">{{$phase->name}}</td>
                                            <td class="text-center">
                                                @if($phase->option_phase_questionnaires->isEmpty() || $phase->question_phase_questionnaires->isEmpty() ||$phase->measurements_phase_questionnaire->isEmpty() ||$questionnaire->measurements_questionnaire->isEmpty() )
                                                    <ul>
                                                        <li>Can't Public</li>
                                                        @if($phase->option_phase_questionnaires->isEmpty())
                                                            <li>Options Not Found</li>
                                                        @endif
                                                        @if($phase->question_phase_questionnaires->isEmpty())
                                                            <li>Phase Not Found</li>
                                                        @endif
                                                        @if($phase->question_phase_questionnaires->isEmpty())
                                                            <li>Question Not Found</li>
                                                        @endif
                                                        @if($phase->measurements_phase_questionnaire->isEmpty() || $questionnaire->measurements_questionnaire->isEmpty())
                                                            <li>Measurements Not Found</li>
                                                        @endif
                                                    </ul>
                                                @else
                                                    @if(!$phase->public)
                                                        You can public!
                                                    @else
                                                        Published!
                                                    @endif
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($phase->public)
                                                    Yes
                                                @else
                                                    No
                                                @endif</td>
                                            <td class="text-center">
                                                @if($phase->option_phase_questionnaires->isEmpty() || $phase->question_phase_questionnaires->isEmpty())
                                                    <a href="{{route('phase_questionnaire.show',$phase->questionnaire)}}"
                                                       class="btn btn-info">Create Phase</a>
                                                @elseif($phase->measurements_phase_questionnaire->isEmpty() )
                                                    <a href="{{route('measurement_phase_questionnaire.show',$phase->questionnaire)}}"
                                                       class="btn btn-info">Create Measurements</a>
                                                @else
                                                    @if($questionnaire->measurements_questionnaire->isEmpty())
                                                        <a href="{{route('measurement_phase_questionnaire.show',$phase->questionnaire)}}"
                                                           class="btn btn-info">Create Measurements SUM</a>
                                                    @else
                                                        <form action="{{route('publish_questionnaire.public',$phase)}}"
                                                              method="POST">
                                                            @method('PUT')
                                                            @csrf
                                                            @if(!$phase->public)
                                                                <button class="btn btn-info"
                                                                        type="submit">Public
                                                                </button>
                                                            @else
                                                                <button class="btn btn-danger"
                                                                        type="submit">Cancel
                                                                </button>
                                                            @endif
                                                        </form>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            @endif
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

@endsection