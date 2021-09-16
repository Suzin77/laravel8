@extends('layouts.app')

@section('title', 'Posts Index')

@section('content')

    <h3>
        {{ $posts->title }}

        @badge(['show' => now()->diffInMinutes($posts->created_at) < 20])
            This is a new post!
        @endbadge

    </h3>
    <p>{{ $posts->content }}</p>
    <p>Added {{ $posts->created_at->diffForHumans() }}</p>

    <h4>Comments</h4>
    @forelse($posts->comments as $comment)

        <p>{{$comment->content}}</p>
        @updated(['date' => $comment->created_at])
            Dodano
        @endupdated
        @updated(['date' => $comment->updated_at])
            Zaktualizowano
        @endupdated

    @empty
        <p>No comments yet.</p>
    @endforelse

@endsection
