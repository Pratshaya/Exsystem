@extends('layouts.app',['activePage' => 'quiz', 'titlePage' => __('ข้อสอบแบบตัวเลือก')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">แก้ไขชื่อและรายละเอียดของข้อสอบ</h4>
                </div>
                    <div class="card-body">
                        <form action="{{ route('quiz.update',$quiz->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Quiz Name" name="name"
                                       value="{{ isset($quiz) ? $quiz->name : '' }}">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Quiz Detail" name="detail"
                                       value="{{ isset($quiz) ? $quiz->detail : '' }}">
                            </div>
                            <div class="form-group">
                                <select name="category_id" class="form-control">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                                @if(isset($quiz))
                                                @if($category->id === $quiz->category_id)
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
