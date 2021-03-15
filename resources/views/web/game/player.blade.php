@extends('web.layouts.app')

@section('title')
    {{$game->name}}
@endsection

@section('content')
<section class="bg-gray-700 sm:mx-24 p-4">
  <div class="h-screen flex flex-col">
    <h1 class="text-3xl text-center text-green-400">{{$game->name}}</h1>
    <iframe 
      id="game-window"
      src="{{route('cloud',['target'=>$game->gameUrl])}}/index.html" 
      class="mt-5 m-auto w-full pt-4 flex-grow"
    >
    </iframe>
    <div id="controlBar" class="flex bg-gray-600 rounded mb-5">
      <x-game.audioSlider class="flex-grow"></x-game.audioSlider>
      <div class="px-6 py-2">
        <x-icons.fullscreen class="player-btn" id="fullscreen-btn"></x-icons.fullscreen>
      </div>
    </div>
    <x-game.author :author="$game->authorUser()" class="mb-5"/>
  </div>
    <div>
    <p class="text-white text-lg">{{$game->description}}</p>
    @include('web.game.player.gallary-preview')
    </div>
</section>
  
@endsection


@section('footer-scripts')
  @parent
  @include('scripts.audio-slider')
  @include('scripts.fullscreen')
  @include('scripts.gallary-slider')
  @include('scripts.prevent-kb-scroll')
@endsection