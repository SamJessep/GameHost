@extends('web.layouts.app')

@section('title')
    GAME NAME
@endsection

@section('content')
  <iframe src="{{env('GAME_STORE_URL').$game->gameUrl}}" frameborder="0" class="mt-5"></iframe>
  <div>
    <h1 class="text-xl">{{$game->name}}</h1>
    <x-game.author :author="$game->authorUser()" />
    <div class="flex">
      @foreach (explode("; ",$game->gallaryImages) as $imgUrl)
          <img src="{{env('GAME_STORE_URL').$imgUrl}}" alt="{{$game->name."'s gallary image"}}">
      @endforeach
    </div>
    <p>{{$game->description}}</p>
  </div>
@endsection