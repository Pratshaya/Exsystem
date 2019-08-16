@extends('layouts.student')
@section('content')

    <main class="container">
        <div class="row">
            <div class="col-md-12 card pb-5">
                <h2 class="text-center mt-3">
                    Article</h2>
                <div class="row">
                    @forelse ($posts as $post)
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title"><a
                                                href="{{route('student.post', $post->id)}}">{{ $post->title }}</a>
                                    </h3>
                                    <p class="card-text text-right">
                                        <strong>Tagged</strong>
                                        @if($post->tags->count() > 0)
                                            @foreach($post->tags as  $tag)
                                                {{$tag->name}}
                                                @if($loop->iteration != $post->tags->count())
                                                    ,
                                                @endif
                                            @endforeach |
                                        @endif
                                        <span class="fas fa-user"></span> {{ $post->source }} <span
                                                class="fas fa-calendar"></span> {{ $post->created_date }}
                                    </p>

                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center">
                            No result found for query <strong> </strong>
                        </p>
                    @endforelse
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </main>

@endsection
@section('script')

@endsection
