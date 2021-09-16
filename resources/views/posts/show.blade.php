@extends('layouts.app')

@section('title', 'Posts Index')

@section('content')

    <h3>{{ $posts->title }}</h3>
    <p>{{ $posts->content }}</p>
    <p>Added {{ $posts->created_at->diffForHumans() }}</p>

    @if(now()->diffInMinutes($posts->created_at) < 15)
        @component('components.badge', ['type' => 'primary'])
            This is a new post!
        @endcomponent
    @endif

    <h4>Comments</h4>
    @forelse($posts->comments as $comment)
        <p>{{$comment->content}}, added: {{$comment->created_at->diffForHumans()}}</p>
    @empty
        <p>No comments yet.</p>
    @endforelse

@endsection
