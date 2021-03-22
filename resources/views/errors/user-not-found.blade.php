@extends('web.layouts.error')

@section('title')
  User not found
@endsection

@section('error-body')
<h1 class="text-lg text-center">Opps user not found {{$username}}</h1>
@endsection