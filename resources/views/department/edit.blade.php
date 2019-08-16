@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit Department</div>
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
