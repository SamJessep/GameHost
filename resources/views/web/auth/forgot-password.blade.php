@extends('web.layouts.form')

@section('title')
    Forgot Password
@endsection

@section('form')
<form action="{{route('store-reset-email')}}" method="POST">
  @csrf
  <label>Email
    <input name="email" type="email" value="{{old('email')}}" placeholder="example@email.com" class="form-field @error('email') border-red-500 @enderror"/>
  </label>
  @error('email')
    <div class="text-red-500">{{$message}}</div>
  @enderror
  <input type="submit" value="Send Reset Email" class="btn-good">
</form>
@endsection