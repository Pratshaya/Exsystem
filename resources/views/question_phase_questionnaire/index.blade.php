@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Phase & Options</div>
                    <div class="card-body row">
                        @foreach($questionnaires as $questionnaire)
                            <div class="card my-1 col-md-6">
                                <h5 class="card-header">{{ $questionnaire->name }}</h5>
                                <div class="card-body">
                                    <h5 class="card-title">Category : {{ $questionnaire->category->name }}</h5>
                                    <p>{{ $questionnaire->detail }}</p>
                                    <ul>
                                        <li class="">Amount : </li>
                                    </ul>
                                    <a href="{{ route('question_phase_questionnaire.show', $questionnaire->id) }}" class="btn btn-primary">Question</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{ $questionnaires->links() }}

                </div>
            </div>
        </div>
    </div>
@endsection
