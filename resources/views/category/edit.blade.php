@extends('layouts.app',['activePage' => 'category', 'titlePage' => __('ข้อสอบแบบตัวเลือก')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">แก้ไขชื่อวิชา</h4>
                </div>
                    <div class="card-body">
                        <form action="{{ route('category.update',$category->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Category name" name="name"
                                       value="{{ isset($category) ? $category->name : '' }}">
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
