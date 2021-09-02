@extends('layouts.app')
@section('content')
    <form method="POST" action="{{route('register')}}">
        @csrf
        <div class="form-group">
            <label>Name</label>
            <input name="name" value="{{old("name")}}" required class="">
        </div>

        <div class="form-group">
            <label>Email</label>
            <input name="email" value="{{old("email")}}" required class="">
        </div>

        <div class="form-group">
            <label>Password</label>
            <input name="password" value="" required class="">
        </div>

        <div class="form-group">
            <label>Retype password</label>
            <input name="password_confirmation" value="" required class="">
        </div>

        <bitton type="submit" class="btn btn-primary btn-block">Register</bitton>
    </form>

@endsection('content')
