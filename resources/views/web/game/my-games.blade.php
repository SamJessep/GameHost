@extends('web.layouts.form')

@section('title')
    My Games
@endsection

@section('form')
  <a class="link" href="{{route('upload-game')}}">Upload Game</a>
@endsection