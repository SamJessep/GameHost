@extends('web.layouts.form')

@section('title')
    Login
@endsection

@section('form')
  <form action="" method="post">
    @csrf
    <x-form.input label="Username or Email" name="userId" type="text"/>
    <x-form.input label="Password" name="password" type="password"/>
    <label class="block">
      Remember Me <input type="checkbox" name="remember" class="mb-3"/>
    </label>
    Dont have an account <a href="{{route('register')}}" class="link mb-3">Click here</a> to sign up
    <input type="submit" value="Login" class="btn-good">
    <a href="{{route('forgot-password')}}" class="btn-bad block">Forgot my password</a>
  </form>
@endsection