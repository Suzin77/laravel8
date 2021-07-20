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
        @include('posts.partials.form')
        <div>
            <input type="submit" value="create"></input>
        </div>
        @csrf
    </form>
@endsection
