@extends('layouts.app')

@section('title', 'Posts Index')

@section('content')

    <h3>{{ $posts->title }}</h3>
    <p>{{ $posts->content }}</p>
    <p>Added {{ $posts->created_at->diffForHumans() }}</p>

    @if(now()->diffInMinutes($posts->created_at) < 5)
    <p class="alert alert-info">This is a new post</p>
    @endif
@endsection
