@extends('web.layouts.form')

@section('title')
    Reset Password
@endsection

@section('form')
<form action="{{route('password-update')}}" method="POST">
  @csrf
  <label>Email
    <input name="email" type="email" hidden value="{{$_GET['email']}}"/>
    <input name="email" type="email" disabled value="{{$_GET['email']}}" class="form-field"/>
  </label>
  <x-form-input label="Password" name="password" type="password"/>
  <x-form-input label="Confirm password" name="password_confirmation" type="password"/>
  <input type="hidden" name="token" value="{{$token}}">
  <input type="submit" value="Change Password" class="btn-good">
</form>
@endsection