@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Phase & Question & Options</div>
                    <div class="card-body row">
                        @foreach($questionnaires as $questionnaire)
                            <div class="card my-1 col-md-6">
                                <h5 class="card-header">{{ $questionnaire->name }}</h5>
                                <div class="card-body">
                                    <h5 class="card-title">Category : {{ $questionnaire->category->name }}</h5>
                                    <p>{{ $questionnaire->detail }}</p>
                                    <ul>
                                        <li class="">Status :
                                            @if($questionnaire->count_public() > 0)
                                                เผยแพร่แล้ว {{$questionnaire->count_public()}} ด้าน
                                            @else
                                                ยังไม่ได้เผยแแพร่
                                            @endif</li>
                                    </ul>
                                    <div>
                                        <a href="{{ route('phase_questionnaire.show', $questionnaire->id) }}"
                                           class="btn btn-primary mt-1">1) Phase & Option & Question</a>
                                        <a href="{{ route('measurement_phase_questionnaire.show', $questionnaire->id) }}"
                                           class="btn btn-primary mt-1  @if($questionnaire->phase_questionnaires->isEmpty()) disabled @endif">2)
                                            Measurement</a>
                                        <a href="{{ route('publish_questionnaire.show', $questionnaire->id) }}"
                                           class="btn btn-primary mt-1 @if($questionnaire->phase_questionnaires->isEmpty()) disabled @endif">3)
                                            Publish</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{ $questionnaires->links() }}

                </div>
            </div>
        </div>
@endsection
