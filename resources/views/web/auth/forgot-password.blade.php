@extends('web.layouts.form')

@section('title')
    Forgot Password
@endsection

@section('form')
<form action="{{route('store-reset-email')}}" method="POST">
  @csrf
  <x-form.input label="Email" name="email" type="email" placeholder="example@email.com"/>
  <input type="submit" value="Send Reset Email" class="btn-good">
</form>
@endsection