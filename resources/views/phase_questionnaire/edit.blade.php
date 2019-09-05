@extends('layouts.app',['activePage' => 'questionnaire_mng', 'titlePage' => __('แบบสอบถาม')])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit Questionnaire</div>
                    <div class="card-body">
                        <form action="{{ route('questionnaire.update',$questionnaire->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Questionnaire Name" name="name"
                                       value="{{ isset($questionnaire) ? $questionnaire->name : '' }}">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Questionnaire Detail" name="detail"
                                       value="{{ isset($questionnaire) ? $questionnaire->detail : '' }}">
                            </div>
                            <div class="form-group">
                                <select name="category_id" class="form-control">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                                @if(isset($questionnaire))
                                                @if($category->id === $questionnaire->category_id)
                                                selected
                                                @endif
                                                @endif
                                        >
                                            {{$category->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
