@extends('web.layouts.form')

@section('title')
    My Games
@endsection

@section('form')
  <a class="link" href="{{route('upload-game')}}">Upload Game</a>

  @foreach ($myGames as $game)
    <x-game.card :game="$game" :user="Auth::user()"/>
  @endforeach  
@endsection