<div class="flex select-none">
  <button id="back-btn" class="group focus:outline-none hover:bg-gray-500 rounded">
    <x-icons.left class="player-btn"></x-icons.left>
  </button>
  <div id="slider" class="flex-grow h-96 flex justify-center">
    @foreach (explode("; ",$game->gallaryImages) as $imgUrl)
      <img class="object-contain max-h-full hidden gallaryImage " src="{{env('GAME_STORE_URL').$imgUrl}}" alt="{{$game->name."'s gallary image"}}">
    @endforeach          
  </div>
  <button id="next-btn" class="group focus:outline-none hover:bg-gray-500 rounded">
    <x-icons.right class="player-btn"></x-icons.right>
  </button>
</div>
<div id="previewButtons" class="flex h-16 w-full select-none">
  @foreach (explode("; ",$game->gallaryImages) as $imgUrl)
  <x-underline-card class="flex-1 mx-1 cursor-pointer gallaryPreviewButton">
    <img class="object-contain w-full h-full" src="{{env('GAME_STORE_URL').$imgUrl}}" alt="previewer quick link">
  </x-underline-card>
  @endforeach  
</div>