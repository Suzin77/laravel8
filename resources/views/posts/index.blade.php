@extends('layouts.app')

@section('title', 'Posts index')

@section('content')
    <h1> Posts</h1>

        @foreach($posts as $key => $post)
            @include('posts.partials.post')
        @endforeach
@endsection
