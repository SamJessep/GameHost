@extends('web.layouts.form')

@section('title')
    My Games
@endsection

@section('form')
  <a class="link" href="{{route('upload-game')}}">Upload Game</a>

  @foreach ($myGames as $game)
    <x-game-card title="{{$game->name}}" thumbnailImg="{{asset($game->thumbnailImage)}}"/>
  @endforeach
{{-- 
  @foreach ($myGames as $game)
    <x-game-card title="{{dd($game->title)}}" thumbnailImg="{{$game->thumbnailImages}}"/>
  @endforeach --}}

  
@endsection