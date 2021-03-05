@extends('web.layouts.form')

@section('title')
    Register
@endsection

@section('form')
  <form action="{{route('register')}}" method="post">
    @csrf

    <label>Name
      <input name="name" type="text" value="{{old('name')}}" placeholder="Bob Jones" class="form-field @error('name') border-red-500 @enderror"/>
    </label>
      @error('name')
        <div class="text-red-500">{{$message}}</div>
      @enderror
    <label>Username
      <input name="username" type="text" value="{{old('username')}}" placeholder="" class="form-field @error('username') border-red-500 @enderror"/>
    </label>
    @error('username')
      <div class="text-red-500">{{$message}}</div>
    @enderror
    <label>Email
      <input name="email" type="email" value="{{old('email')}}" placeholder="example@email.com" class="form-field @error('email') border-red-500 @enderror"/>
    </label>
    @error('email')
      <div class="text-red-500">{{$message}}</div>
    @enderror
    <label>Password
      <input name="password" type="password" class="form-field @error('password') border-red-500 @enderror"/>
    </label>
    @error('password')
      <div class="text-red-500">{{$message}}</div>
    @enderror
    <label>Confirm Password
      <input name="password_confirmation" type="password" class="form-field @error('password_confirmation') border-red-500 @enderror"/>
    </label>
    @error('password_confirmation')
      <div class="text-red-500">{{$message}}</div>
    @enderror
    <label>Are you a game developer <input type="checkbox" name="isDev"></label>
    <input type="submit" value="Sign Up" class="btn-good">
    <a href="{{route('login')}}" class="btn-neutral block">Already have an Account</a>
  </form>
@endsection