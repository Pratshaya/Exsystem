@extends('layouts.app',['activePage' => 'faculty', 'titlePage' => __('คณะ')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">แก้ไขวัตถุประสงค์</h4>
                </div>
                    <div class="card-body">
                        <form action="{{ route('objective.update',$objective->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="ชื่อวัตถุประสงค์" name="name"
                                       value="{{ isset($objective) ? $objective->name : '' }}">
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
