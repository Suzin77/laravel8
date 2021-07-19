@extends('layouts.app')

@section('title', 'Create Post')

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
    <form action="{{ route('posts.store') }}" method="POST">
        <div>
            <input type="text" name="title" value="{{ old('title') }}">
        </div>
        @error('title')
            <div>{{$message}}</div>
        @enderror
        <div>
            <textarea name="content" id="" cols="30" rows="5">{{ old('content') }}</textarea>
        </div>
        @error('content')
            <div>{{$message}}</div>
        @enderror
        <div>
            <input type="submit" value="create"></input>
        </div>
        @csrf
    </form>
@endsection
