@extends('web.game.game-form')

@section('title')
    Edit {{$game->name}}
@endsection
@section('postAction'){{route('update-game',["gameName"=>$game->name])}}@endsection
@section('submitButton')
  <input type="submit" value="Update" class="btn-good">
@endsection