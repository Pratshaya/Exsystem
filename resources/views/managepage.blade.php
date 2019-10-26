@extends('layouts.app', ['activePage' => 'manager', 'titlePage' => __('การจัดการเกี่ยวกับภายใน')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">รายการห้องสอบ
                    </h4>
                    กรุณาเลือกรายการที่ต้องการจัดการ
                </div>
                <center><div class="card col-lg-4 col-md-6 col-sm-8">
                    <div class="card-header card-header-success">
                            <a href="{{ route('campus.index') }}">
                                <h4 class="card-title">วิทยาเขต</h4>
                            </a>
                    </div>
                </div>
                <div class="card col-lg-4 col-md-6 col-sm-8">
                    <div class="card-header card-header-danger">
                        <a href="{{ route('faculty.index') }}">
                            <h4 class="card-title">คณะ</h4>
                        </a>
                    </div>
                </div>
                <div class="card col-lg-4 col-md-6 col-sm-8">
                    <div class="card-header card-header-info">
                        <a href="{{ route('department.index') }}">
                            <h4 class="card-title">ภาควิชา</h4>
                        </a>
                    </div>
                </div>
                <div class="card col-lg-4 col-md-6 col-sm-8">
                    <div class="card-header card-header-warning">
                        <a href="{{ route('branch.index') }}">
                            <h4 class="card-title">สาขาวิชา</h4>
                        </a>
                    </div>
                </div>
                </center>
            </div>
        </div>
    </div>
@endsection
