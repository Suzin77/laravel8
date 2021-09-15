@extends('layouts.app')

@section('title','Contact')

@section('content')
    <h1> contct</h1>

    @can('home.secret')
        <p>Tajne/poufne</p>
        <a href="{{route('home.secret')}}">Follow the rabbit</a>
    @endcan
@endsection
