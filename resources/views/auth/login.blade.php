@extends('layouts.app')
@section('content')
   <p>This is login form</p>

   <form method="POST" action="{{route('login')}}">
       @csrf
       <div class="form-group">
           <label>Email</label>
           <input name="email" type="text" value="{{old("email")}}" required
                  class="form-control {{$errors->has('email')  ? 'is-invalid' : ''}}">
           @if($errors->has('email'))
               <span class="invalid-feedback">
                    <strong>{{$errors->first('email')}}</strong>
                </span>
           @endif
       </div>

       <div class="form-group">
           <label>Password</label>
           <input name="password" type="password" value="" required
                  class="form-control {{$errors->has('password')  ? 'is-invalid' : ''}}">
           @if($errors->has('password'))
               <span class="invalid-feedback">
                    <strong>{{$errors->first('password')}}</strong>
                </span>
           @endif
       </div>

       <div class="form-group">
           <div class="form-check">
               <label for="" class="form-check-input">Remember me</label>
               <input type="checkbox" class="form-check-input" name="remember" value="{{old('remember') ? 'checked' : ''}}">
           </div>
       </div>

            <button type="submit" class="btn btn-primary btn-block">Login</button>
       
   </form>
@endsection('content')
