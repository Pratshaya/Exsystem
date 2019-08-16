@extends('layouts.student')
@section('header')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('library/FlipClock-master/compiled/flipclock.css')}}">
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><a href="{{route('student.index')}}">Home</a> /<a
                                href="{{route('student.posts')}}"> Article </a>/ {{ $post->title }}</div>
                    <div class="card-body">
                        <h2 class="text-center">{{ $post->title}}</h2>
                        <div class="card-body">
                            <p>
                                {!! $post->detail !!}
                            </p>
                            <hr>
                            <p class="text-right"><strong>วันที่ลง : </strong>{{ $post->created_date }}</p>
                            <p class="text-right"><strong>ที่มา : </strong>{{ $post->source }}</p>
                            <p class="text-right">
                                <strong>Tagged : </strong>
                                @if($post->tags->count() > 0)
                                    @foreach($post->tags as  $tag)
                                        {{$tag->name}}
                                        @if($loop->iteration != $post->tags->count())
                                            ,
                                        @endif
                                    @endforeach
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

@endsection

