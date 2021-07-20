@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    @if($errors->any())
        <div class="">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('posts.update', ['post' => $post->id]) }}" method="POST">
        @method('PUT')
        @include('posts.partials.form')
        <div>
            <input type="submit" value="update"/>
        </div>
        @csrf
    </form>
@endsection
