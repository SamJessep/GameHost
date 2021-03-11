@extends('web.game.game-form')

@section('title')
    Edit {{$game->name}}
@endsection
@section('postAction'){{route('update-game',["gameName"=>$game->name])}}@endsection

@section('form')
@parent
<button onclick="ShowDeleteConfirmation()" class="btn-bad">Delete Game</button>
<div id="deleteConfirmation" class="bg-gray-800 bg-opacity-75 fixed top-0 left-0 w-full h-screen hidden">
  <div class="bg-white w-3/4 m-auto p-6">
    <form action="{{route('delete-game', ['gameName'=>$game->name])}}" method="POST">
      <h2 class="text-xl text-center">Are you sure you want delete {{$game->name}}</h2>
      @csrf
      <input class="btn-bad" type="submit" value="Delete"/>
    </form>
    <button class="btn-good" onclick="HideDeleteConfirmation()">Cancel</button>
  </div>
</div>
<div id="oldThumbnail" class="hidden">
  <img src="{{env('GAME_STORE_URL').$game->thumbnailImage}}">
</div>
<div id="oldGallary" class="hidden">
  @foreach (explode("; ",$game->gallaryImages) as $imgUrl)
      <img src="{{env('GAME_STORE_URL').$imgUrl}}">
  @endforeach
</div>
@endsection

@section('before-form')
<x-form.back/>    
@endsection

@section('footer-scripts')
    @parent
    @include('scripts.edit-game-script') 
@endsection

@section('submitButton')
  <input type="submit" value="Update" class="btn-good">
@endsection