@extends('layouts.app',['activePage' => 'questionnaire_mng', 'titlePage' => __('แบบสอบถาม')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">แก้ไขแบบสอบถาม</h4>
                </div>
                    <div class="card-body">
                        <form action="{{ route('questionnaire.update',$questionnaire->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <h4> ชื่อแบบสอบถาม (คลิกเพื่อแก้ไข)</h4>
                                <input type="text" class="form-control" placeholder="ชือแบบสอบถาม" name="name"
                                       value="{{ isset($questionnaire) ? $questionnaire->name : '' }}">
                            </div>
                            <div class="form-group">
                                <h4> รายละเอียดแบบสอบถาม (คลิกเพื่อแก้ไข)</h4>
                                <input type="text" class="form-control" placeholder="รายละเอียดแบบสอบถาม" name="detail"
                                       value="{{ isset($questionnaire) ? $questionnaire->detail : '' }}">
                            </div>
                            <div class="form-group">
                                <h4> กลุ่มของแบบสอบถาม (คลิกเพื่อแก้ไข)</h4>
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
                                <button class="btn btn-primary">บันทึก</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
