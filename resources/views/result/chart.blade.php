@extends('layouts.app',['activePage' => 'quiz_q', 'titlePage' => __('รายการข้อสอบที่มีภายในห้อง')])
@section('css')
    {!! Charts::assets() !!}
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{ __('คะแนนสอบของนักเรียน') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="card-header">
                                <div class="d-flex align-item-center">
                                    ผลการสอบ
                                </div>
                            </div>
                            <div class="card-body">
                                @if(!empty($chart))

                                    {!! $chart->render() !!}
                                @else
                                    <h4 class="text-center">ยังไม่มีคะแนนสอบ</h4>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')

@endsection