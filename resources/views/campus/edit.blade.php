@extends('layouts.app',['activePage' => 'campus', 'titlePage' => __('วิทยาเขต')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">แก้ไขวิทยาเขต</h4>
                </div>
                    <div class="card-body">
                        <form action="{{ route('campus.update',$campus->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="คลิ้กเพื่อแก้ไข" name="name"
                                       value="{{ isset($campus) ? $campus->name : ''  }}">
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
