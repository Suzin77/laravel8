@extends('layouts.app')

@section('title', 'Posts Index')

@section('content')
    <div class="row">
        <div class="col-8">
            @include('posts.partials._background-image', ['posts' => $posts])
            <p>{{ $posts->content }}</p>
            <p>Added {{ $posts->created_at->diffForHumans() }}</p>
            @tag(['tags' => $posts->tags])@endtag

            @include('comments.create')
            <h4>Comments</h4>
            @forelse($posts->comments as $comment)
                <p>{{$comment->content}}</p>
                @updated(['date' => $comment->created_at, 'name' => $comment->user->name])
                    Dodano
                @endupdated
                @updated(['date' => $comment->updated_at])
                    Zaktualizowano
                @endupdated
            @empty
                <p>No comments yet.</p>
            @endforelse
            <p>Number of viewers: {{$counter}}</p>
        </div>
        <div class="col-4">
            @include('posts.partials.activity')
        </div>
    </div>

@endsection
