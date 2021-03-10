@extends('web.layouts.app')

@section('title')
    GAME NAME
@endsection

@section('content')
  <iframe src="{{env('GAME_STORE_URL').$game->gameUrl}}" frameborder="0" class="w-full h-full"></iframe>
@endsection