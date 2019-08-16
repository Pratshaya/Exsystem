@extends('layouts.student')
@section('content')
    <main class="container">
        <div class="section bg-gray">
            <div class="row">
                <div class="col-md-8 col-xl-9 card ">
                    @if(isset($category))
                        <h2 class="text-center mt-3">{{ $category->name }}</h2>
                    @else
                        <h2 class="text-center mt-3">ALL</h2>
                    @endif
                    <div class="row">
                        @forelse ($quizzes as $quiz)
                            <div class="col-md-6">
                                <div class="card mx-1 mt-2">
                                    <h5 class="card-header">{{ $quiz->name }}</h5>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $quiz->category->name }}</h5>
                                        <h6>{{ $quiz->name }}</h6>
                                        <ul>
                                            <li class="">Amount : {{ $quiz->questions()->count() }}</li>
                                        </ul>
                                        <div class="text-center">
                                            <a href="{{ route('student.show', $quiz->id) }}"
                                               class="btn btn-primary">START</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <h3 class="mx-auto">
                                No Quiz of Category<strong> </strong>
                            </h3>
                        @endforelse
                        {{ $quizzes->links() }}
                    </div>
                </div>
                @include('partials.sidebar')
            </div>
        </div>

    </main>

@endsection
@section('script')

@endsection
