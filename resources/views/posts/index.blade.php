@extends('layouts.app')

@section('title', 'Posts index')

@section('content')
    <h1> Posts</h1>

        @foreach($posts as $posts)
            <p>{{$posts['title']}}</p>
            <p>{{$posts['content']}}</p>
        @endforeach
@endsection
