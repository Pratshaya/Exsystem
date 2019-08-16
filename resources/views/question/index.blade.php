@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Question & Options</div>
                    <div class="card-body row">
                            @foreach($quizzes as $quiz)
                                <div class="card my-1 col-md-6">
                                    <h5 class="card-header">{{ $quiz->name }}</h5>
                                    <div class="card-body">
                                        <h5 class="card-title">Category : {{ $quiz->category->name }}</h5>
                                        <p>{{ $quiz->detail }}</p>
                                        <ul>
                                            <li class="">Amount : {{ $quiz->questions()->count() }}</li>
                                        </ul>
                                        <a href="{{ route('question.show', $quiz->id) }}" class="btn btn-primary">คำถาม</a>
                                    </div>
                                </div>
                            @endforeach
                    </div>
                    {{ $quizzes->links() }}

                </div>
            </div>
        </div>
@endsection
