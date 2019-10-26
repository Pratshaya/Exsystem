@extends('layouts.app',['activePage' => 'faculty', 'titlePage' => __('ภาควิชา')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">แก้ไขภาควิชา {{ $department->name }}</h4>
                </div>
                    <div class="card-body">
                        <form action="{{ route('department.update',$department->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Department name" name="name"
                                       value="{{ isset($department) ? $department->name : '' }}">
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
