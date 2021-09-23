@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @include('posts.partials.form')
        <div>
            <input class="btn btn-primary btn-block" type="submit" value="Create"></input>
        </div>
        @csrf
    </form>
@endsection
