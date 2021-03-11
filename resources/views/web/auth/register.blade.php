@extends('web.layouts.form')

@section('title')
    Register
@endsection

@section('form')
  <form action="{{route('register')}}" method="post">
    @csrf

    <x-form-input label="Name" name="name" type="text" placeholder="Bob Jones"/>
    <x-form-input label="Username" name="username" type="text"/>
    <x-form-input label="Email" name="email" type="email" placeholder="example@email.com"/>
    <x-form-input label="Password" name="password" type="password"/>
    <x-form-input label="Confirm password" name="password_confirmation" type="password"/>
    <label>Are you a game developer <input type="checkbox" name="isDev"></label>
    <input type="submit" value="Sign Up" class="btn-good">
    <a href="{{route('login')}}" class="btn-neutral block">Already have an Account</a>
  </form>
@endsection