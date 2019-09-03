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
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-12">
                <ul id="progressbar">
                    <li class="active">Category</li>
                    <li>Questionnaire</li>
                    <li>Phase Questionnaire</li>
                    <li>Public</li>
                </ul>
                <div class="card">
                    <div class="card-header">Create Questionnaire</div>
                    <div class="card-body">
                        <form action="{{ route('step_questionnaire.store_first') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Questionnaire Name" name="name"
                                       value="{{ old('name') }}" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Questionnaire Detail"
                                       name="detail" value="{{ old('detail') }}" required>
                            </div>
                            <div class="form-group">
                                <select name="category_questionnaire_id" class="form-control">
                                    <option value="0">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="type" class="form-control">
                                    <option value="0">Select Type</option>
                                    <option value="S">วัดผลเฉพาะคะแนนรวม</option>
                                    <option value="P">วัดผลเฉพาะคะแนนแต่ละด้าน</option>
                                    <option value="SP">วัดผลคะแนนรวมและคะแนนแต่ละด้าน</option>
                                </select>
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-primary">Next</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

@endsection