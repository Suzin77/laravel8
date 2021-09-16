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
            <div class="container">
                <div class="row">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Most Popular Posts</h5>
                            <h6 class="card-subtitle mb-2 text-muted">What's the fuzz ?</h6>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach($most_popular as $post)
                                <li class="list-group-item">
                                    <a href="{{ route('posts.show', ['post' => $post->id]) }}">
                                        {{ substr($post->title, 0, 30) }} ...
                                    </a>
                                    ({{$post->comments_count}})
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="card mt-4" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Users</h5>
                            <h6 class="card-subtitle mb-2 text-muted">What's the fuzz ?</h6>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach($mostActiveUsers as $user)
                                <li class="list-group-item">
                                    {{$user->name}}
                                    ({{$user->blog_posts_count}})
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
