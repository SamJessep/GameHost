@extends('web.layouts.form')

@section('title')
    Reset Password
@endsection

@section('form')
<form action="{{route('password-update')}}" method="POST">
  @csrf
  <label>Email
    <input name="email" type="email" hidden value="{{$_GET['email']}}" placeholder="example@email.com" class="form-field @error('email') border-red-500 @enderror"/>
    <input name="email" type="email" disabled value="{{$_GET['email']}}" placeholder="example@email.com" class="form-field @error('email') border-red-500 @enderror"/>
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
  <input type="hidden" name="token" value="{{$token}}">
  <input type="submit" value="Change Password" class="btn-good">
</form>
@endsection