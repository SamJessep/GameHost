@extends('web.layouts.error')

@section('title')
  Game not found
@endsection

@section('error-body')
<h1 class="text-lg text-center">Opps game not found with name {{$gameName}}</h1>
<p class="text text-center">If you just uploaded your game wait 5 mins and check back</p>
@endsection