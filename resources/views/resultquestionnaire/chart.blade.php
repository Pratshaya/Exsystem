@extends('layouts.app')
@section('css')
    {!! Charts::assets() !!}
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-item-center">
                            Test Score
                        </div>
                    </div>
                    <div class="card-body">
                        @if(!empty($chart))

                            {!! $chart->render() !!}
                        @else
                            <h4 class="text-center">Not test score</h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')

@endsection