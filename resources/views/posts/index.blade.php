@extends('layouts.app')

@section('title', 'Posts index')

@section('content')
    <h1> Posts</h1>

        @if(!empty($posts))
            <p>No posts yet</p>
        @endif
        @foreach($posts as $key => $post)
            @include('posts.partials.post')
        @endforeach
@endsection
