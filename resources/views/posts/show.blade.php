@extends('layouts.app')

@section('title', 'Posts Index')

@section('content')
    <h1> Post  </h1>
    <p>{{$posts['title']}}</p></br>
    <p>{{$posts['content']}}</p></br>

{{--    @foreach($posts as $posts)--}}
{{--        <p>{{$posts['title']}}</p></br>--}}
{{--        <p>{{$posts['content']}}</p></br>--}}
{{--    @endforeach--}}
@endsection
