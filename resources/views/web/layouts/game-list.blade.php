@extends('web.layouts.titledApp')

@section('title')
    $title
@endsection


@section('content')
  @foreach ($games as $game)
  <div class="h-96 p-3 m-5 bg-gray-900 flex flex-col">
    <h2 class="text-white text-center text-lg">{{$game->name}}</h2>
    <img class="bg-green-600 flex-grow mx-10" src="{{env('GAME_STORE_URL').$game->name}}"/>
    <div class="flex flex-row justify-between">
      <p class="text-white">Creator: <a href="{{route("user", $game->author)}}">{{$game->author}}</a></p>
      <small class="text-gray-400">{{$game->post_date}}</small>
    </div>
  </div>
  @endforeach
@endsection