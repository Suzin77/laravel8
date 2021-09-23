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
    <form action="{{ route('posts.update', ['post' => $post->id]) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @include('posts.partials.form')
        <div>
            <input class="btn btn-primary btn-block" type="submit" value="update"/>
        </div>
        @csrf
    </form>
@endsection
