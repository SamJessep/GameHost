<div class="bg-gray-900">
  <div class="w-5/6 bg-gray-200">
    <h1 class="text-2xl text-center text-green-700 w-full">Your Game Is Ready</h1>
    <p class="w-full">{{$game->name}} has been uploaded successfully and is now publicly accessable</p>
    <img class=" h-40 m-auto" src="{{env('GAME_STORE_URL').$game->thumbnailImage}}"/>
    <a href="{{route('load-game',['gameName'=>$game->name])}}" class="btn-good block w-5/6">Click here to view your game</a>
  </div>
</div>