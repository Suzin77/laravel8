@extends('layouts.app')

@section('title', 'Posts Index')

@section('content')
    <h1> Post  </h1>
    <p>{{$post['title']}}</p></br>
    <p>{{$post['content']}}</p></br>

{{--    @foreach($posts as $post)--}}
{{--        <p>{{$post['title']}}</p></br>--}}
{{--        <p>{{$post['content']}}</p></br>--}}
{{--    @endforeach--}}
@endsection
