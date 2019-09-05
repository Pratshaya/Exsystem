@extends('layouts.app',['activePage' => 'room', 'titlePage' => __('ผลการทำแบบสอบถาม')])
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
                            <h4 class="card-title ">{{ __('ผลการทำแบบสอบถามของนักเรียน') }}</h4>
                            <p class="card-category"> {{ __('') }}</p>
                        </div>
                    <div class="card-body">
                        @if(!empty($chart))
                            {!! $chart->render() !!}
                        @else
                            <h4 class="text-center">Not Test</h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')
    <script>

    </script>
@endsection