@extends('web.game.game-form')

@section('title')
    Upload a game
@endsection

@section('postAction'){{route('upload-game')}}@endsection

@section('submitButton')
  <input type="submit" value="Upload" class="btn-good">
@endsection
