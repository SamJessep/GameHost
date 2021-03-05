@extends('web.layouts.form')

@section('title')
    Login
@endsection

@section('form')
  <form action="" method="post">
    @csrf
    <label>Username
      <input name="username" type="text" class="form-field @error('username') border-red-500 @enderror"/>
    </label>
    @error('username')
        <div class="text-red-500">{{$message}}</div>
    @enderror
    <label>Password
      <input name="password" type="password" class="form-field @error('password') border-red-500 @enderror"/>
    </label>
    @error('password')
        <div class="text-red-500">{{$message}}</div>
      @enderror
    <label class="block">
      Remember Me <input type="checkbox" name="rememberMe" class="mb-3"/>
    </label>
    Dont have an account <a href="{{route('register')}}" class="link mb-3">Click here</a> to sign up
    <input type="submit" value="Login" class="btn-good">
    <a href="/RestPassword" class="btn-bad">Forgot my password</a>
  </form>
@endsection