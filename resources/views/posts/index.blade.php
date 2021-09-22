@extends('layouts.app')

@section('title', 'Posts index')

@section('content')
    <div class="row">
        <div class="col-8">
            <h1> Posts</h1>

            @if(!empty($posts))
                <p>No posts yet</p>
            @endif
            @foreach($posts as $key => $post)
                @include('posts.partials.post')
            @endforeach
        </div>

{{--        Karta most popular posts.--}}
        <div class="col-4">
            @include('posts.partials.activity')
        </div>
    </div>
@endsection
